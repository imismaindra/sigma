<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Lampiran;
use App\Models\ActivityLog;
use App\Models\Notification;
use App\Models\Pengaduan;
use App\Models\User;
use App\Models\PengaduanComment;
use App\Models\StatusLog;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    protected array $statusLabels = [
        'pending' => 'Menunggu Verifikasi',
        'proses' => 'Diproses',
        'menunggu_klarifikasi' => 'Menunggu Klarifikasi',
        'ditindaklanjuti' => 'Ditindaklanjuti',
        'menunggu_verifikasi_mahasiswa' => 'Menunggu Konfirmasi Mahasiswa',
        'selesai' => 'Selesai',
        'ditolak' => 'Ditolak',
    ];

    protected array $priorityLabels = [
        'rendah' => 'Rendah',
        'sedang' => 'Sedang',
        'tinggi' => 'Tinggi',
        'darurat' => 'Darurat',
    ];

    /**
     * Dashboard Mahasiswa - Tampilkan pengaduan milik sendiri & form kirim.
     */
    public function mahasiswaDashboard()
    {
        $user = Auth::user();
        
        $filteredQuery = $this->filterPengaduanQuery(
            Pengaduan::with(['kategori', 'lampiran', 'statusLogs', 'tanggapan'])
                ->where('id_user', $user->id_user),
            request()
        );

        $summary = [
            'total' => Pengaduan::where('id_user', $user->id_user)->count(),
            'pending' => Pengaduan::where('id_user', $user->id_user)->where('status', 'pending')->count(),
            'proses' => Pengaduan::where('id_user', $user->id_user)->whereIn('status', ['proses', 'menunggu_klarifikasi', 'ditindaklanjuti', 'menunggu_verifikasi_mahasiswa'])->count(),
            'selesai' => Pengaduan::where('id_user', $user->id_user)->where('status', 'selesai')->count(),
        ];

        $pengaduans = $filteredQuery->latest()->paginate(6)->withQueryString();

        // Ambil kategori pengaduan yang aktif untuk pilihan di form
        $kategoris = KategoriPengaduan::where('status_aktif', true)->get();
        $notifications = $user->notifications()
            ->with('pengaduan')
            ->latest()
            ->limit(6)
            ->get();
        $unreadNotifications = $user->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.dashboard', [
            'pengaduans' => $pengaduans,
            'kategoris' => $kategoris,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications,
            'summary' => $summary,
            'statusLabels' => $this->statusLabels,
            'priorityLabels' => $this->priorityLabels,
        ]);
    }

    /**
     * Halaman form pengaduan baru mahasiswa.
     */
    public function createPengaduan()
    {
        $kategoris = KategoriPengaduan::where('status_aktif', true)->get();
        $unreadNotifications = Auth::user()->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.pengaduan-create', [
            'kategoris' => $kategoris,
            'unreadNotifications' => $unreadNotifications,
            'priorityLabels' => $this->priorityLabels,
        ]);
    }

    public function mahasiswaRiwayat()
    {
        $user = Auth::user();
        $pengaduans = $this->filterPengaduanQuery(
            Pengaduan::with(['kategori', 'lampiran', 'statusLogs', 'tanggapan'])
                ->where('id_user', $user->id_user),
            request()
        )->latest()->paginate(8)->withQueryString();

        $kategoris = KategoriPengaduan::where('status_aktif', true)->get();
        $unreadNotifications = $user->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.pengaduan-index', [
            'pengaduans' => $pengaduans,
            'kategoris' => $kategoris,
            'unreadNotifications' => $unreadNotifications,
            'statusLabels' => $this->statusLabels,
            'priorityLabels' => $this->priorityLabels,
        ]);
    }

    /**
     * Kirim Pengaduan Baru (Mahasiswa).
     */
    public function storePengaduan(Request $request)
    {
        // 1. Validasi Input dan Pembatasan Upload File
        $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'priority' => 'required|in:rendah,sedang,tinggi,darurat',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png|max:2048', // Batasan: PDF, DOCX, JPG, PNG maks 2MB
        ], [
            'id_kategori.required' => 'Kategori pengaduan wajib dipilih.',
            'id_kategori.exists' => 'Kategori pengaduan tidak valid atau tidak aktif.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul pengaduan maksimal 255 karakter.',
            'priority.required' => 'Prioritas pengaduan wajib dipilih.',
            'priority.in' => 'Prioritas pengaduan tidak valid.',
            'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
            'lampiran.*.mimes' => 'Format file lampiran harus berupa PDF, DOCX, JPG, JPEG, atau PNG.',
            'lampiran.*.max' => 'Ukuran file lampiran tidak boleh melebihi 2MB.',
        ]);

        DB::beginTransaction();
        try {
            // 2. Simpan Pengaduan
            $pengaduan = Pengaduan::create([
                'id_user' => Auth::user()->id_user,
                'id_kategori' => $request->id_kategori,
                'ticket_number' => $this->generateTicketNumber(),
                'judul' => $request->judul,
                'isi_pengaduan' => $request->isi_pengaduan,
                'status' => 'pending',
                'priority' => $request->priority,
                'due_at' => now()->addDays($this->priorityDueDays($request->priority)),
            ]);

            // 3. Proses Upload Lampiran (jika ada)
            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    // Simpan file ke storage (folder public/uploads/lampiran)
                    $path = $file->store('uploads/lampiran', 'public');
                    
                    Lampiran::create([
                        'id_pengaduan' => $pengaduan->id_pengaduan,
                        'nama_file' => $file->getClientOriginalName(),
                        'path_file' => $path,
                        'tipe_file' => $file->getClientMimeType(),
                    ]);
                }
            }

            $this->recordActivity('pengaduan_dibuat', 'Mahasiswa membuat pengaduan baru.', $pengaduan, null, $pengaduan->only(['ticket_number', 'status', 'priority']));

            // Notifikasi admin/pimpinan tentang pengaduan baru
            $adminUsers = User::whereIn('role', ['admin', 'super_admin', 'pimpinan'])->where('account_status', 'aktif')->get();
            foreach ($adminUsers as $admin) {
                Notification::create([
                    'id_user' => $admin->id_user,
                    'id_pengaduan' => $pengaduan->id_pengaduan,
                    'title' => 'Pengaduan baru masuk',
                    'message' => "Pengaduan baru '{$pengaduan->judul}' dari {$pengaduan->user->nama} membutuhkan verifikasi.",
                ]);
            }

            DB::commit();
            return back()->with('success', 'Pengaduan Anda berhasil dikirim dan akan segera diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan pengaduan: ' . $e->getMessage());
        }
    }

    /**
     * Dashboard Admin - Tampilkan seluruh pengaduan masuk.
     */
    public function adminDashboard()
    {
        $allPengaduans = Pengaduan::with('kategori')->get();
        $activities = ActivityLog::with(['user', 'pengaduan'])
            ->latest()
            ->limit(12)
            ->get();
        $categoryStats = $allPengaduans
            ->groupBy(fn ($item) => $item->kategori?->nama_kategori ?? 'Tanpa Kategori')
            ->map->count()
            ->sortDesc()
            ->take(5);

        return view('admin.dashboard', [
            'allPengaduans' => $allPengaduans,
            'activities' => $activities,
            'categoryStats' => $categoryStats,
            'statusLabels' => $this->statusLabels,
        ]);
    }

    public function adminPengaduanIndex()
    {
        $baseQuery = Pengaduan::with(['user', 'kategori', 'lampiran', 'statusLogs', 'tanggapan']);
        $pengaduans = $this->filterPengaduanQuery(clone $baseQuery, request())->latest()->paginate(10)->withQueryString();
        $kanbanPengaduans = $this->filterPengaduanQuery(clone $baseQuery, request())->latest()->get();
        $kategoris = KategoriPengaduan::orderBy('nama_kategori')->get();

        return view('admin.pengaduan-index', [
            'pengaduans' => $pengaduans,
            'kanbanPengaduans' => $kanbanPengaduans,
            'kategoris' => $kategoris,
            'statusLabels' => $this->statusLabels,
            'priorityLabels' => $this->priorityLabels,
        ]);
    }

    public function adminKategoriIndex()
    {
        $kategoris = KategoriPengaduan::withCount('pengaduan')->orderBy('nama_kategori')->get();
        $statusLabels = $this->statusLabels;
        $priorityLabels = $this->priorityLabels;

        return view('admin.kategori', compact('kategoris', 'statusLabels', 'priorityLabels'));
    }

    public function showMahasiswaPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'lampiran', 'statusLogs.creator', 'tanggapan.admin', 'comments.user'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);
        $kategoris = KategoriPengaduan::where('status_aktif', true)->get();

        Auth::user()->notifications()
            ->where('id_pengaduan', $pengaduan->id_pengaduan)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $unreadNotifications = Auth::user()->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.pengaduan-detail', [
            'pengaduan' => $pengaduan,
            'kategoris' => $kategoris,
            'statusLabels' => $this->statusLabels,
            'priorityLabels' => $this->priorityLabels,
            'progressSteps' => $this->progressSteps($pengaduan),
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    public function showAdminPengaduan($id)
    {
        $pengaduan = Pengaduan::with(['user', 'kategori', 'lampiran', 'statusLogs.creator', 'tanggapan.admin', 'activities.user', 'comments.user'])
            ->findOrFail($id);

        return view('admin.pengaduan-detail', [
            'pengaduan' => $pengaduan,
            'statusLabels' => $this->statusLabels,
            'priorityLabels' => $this->priorityLabels,
        ]);
    }

    public function updateMahasiswaPengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::where('id_user', Auth::id())->findOrFail($id);

        if (!$pengaduan->isEditable()) {
            return back()->with('error', 'Pengaduan hanya dapat diedit saat status masih pending.');
        }

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'priority' => 'required|in:rendah,sedang,tinggi,darurat',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $before = $pengaduan->only(['id_kategori', 'judul', 'isi_pengaduan', 'priority']);
            $pengaduan->update([
                'id_kategori' => $validated['id_kategori'],
                'judul' => $validated['judul'],
                'isi_pengaduan' => $validated['isi_pengaduan'],
                'priority' => $validated['priority'],
                'due_at' => now()->addDays($this->priorityDueDays($validated['priority'])),
            ]);

            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    $path = $file->store('uploads/lampiran', 'public');
                    Lampiran::create([
                        'id_pengaduan' => $pengaduan->id_pengaduan,
                        'nama_file' => $file->getClientOriginalName(),
                        'path_file' => $path,
                        'tipe_file' => $file->getClientMimeType(),
                    ]);
                }
            }

            $this->recordActivity('pengaduan_diedit', 'Mahasiswa memperbarui isi pengaduan pending.', $pengaduan, $before, $pengaduan->only(['id_kategori', 'judul', 'isi_pengaduan', 'priority']));
            DB::commit();

            return back()->with('success', 'Pengaduan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui pengaduan: ' . $e->getMessage());
        }
    }

    public function cancelMahasiswaPengaduan(Request $request, $id)
    {
        $pengaduan = Pengaduan::where('id_user', Auth::id())->findOrFail($id);

        if (!$pengaduan->isEditable()) {
            return back()->with('error', 'Pengaduan hanya dapat dibatalkan saat status masih pending.');
        }

        $validated = $request->validate([
            'cancel_reason' => 'nullable|string|max:500',
        ]);

        $pengaduan->update([
            'status' => 'ditolak',
            'cancelled_at' => now(),
            'cancel_reason' => $validated['cancel_reason'] ?? 'Dibatalkan oleh mahasiswa.',
        ]);

        StatusLog::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'status_lama' => 'pending',
            'status_baru' => 'ditolak',
            'catatan' => $pengaduan->cancel_reason,
            'created_by' => Auth::id(),
        ]);

        $this->recordActivity('pengaduan_dibatalkan', 'Mahasiswa membatalkan pengaduan pending.', $pengaduan);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengaduan berhasil dibatalkan.');
    }

    /**
     * Update Status Pengaduan & Catat Riwayat Perubahan (Status Log).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,menunggu_klarifikasi,ditindaklanjuti,menunggu_verifikasi_mahasiswa,selesai,ditolak',
            'catatan' => 'nullable|string',
        ], [
            'status.required' => 'Status baru wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $statusLama = $pengaduan->status;
        $statusBaru = $request->status;

        if ($statusLama === $statusBaru) {
            return back()->with('info', 'Status tidak berubah.');
        }

        DB::beginTransaction();
        try {
            // Update status pengaduan
            $pengaduan->update(['status' => $statusBaru]);

            // Catat perubahan ke dalam log status
            StatusLog::create([
                'id_pengaduan' => $pengaduan->id_pengaduan,
                'status_lama' => $statusLama,
                'status_baru' => $statusBaru,
                'catatan' => $request->catatan ?: "Perubahan status menjadi {$statusBaru}.",
                'created_by' => Auth::user()->id_user,
            ]);

            $this->notifyUser(
                $pengaduan,
                'Status pengaduan diperbarui',
                "Status pengaduan '{$pengaduan->judul}' berubah menjadi {$this->statusLabels[$statusBaru]}."
            );
            $this->recordActivity('status_diperbarui', "Status pengaduan diubah dari {$statusLama} menjadi {$statusBaru}.", $pengaduan, ['status' => $statusLama], ['status' => $statusBaru]);

             DB::commit();
             if ($request->wantsJson()) {
                 return response()->json([
                     'success' => true,
                     'message' => "Status aduan berhasil diperbarui menjadi {$this->statusLabels[$statusBaru]}."
                 ]);
             }
             return back()->with('success', "Status aduan berhasil diperbarui menjadi {$this->statusLabels[$statusBaru]}.");
 
         } catch (\Exception $e) {
             DB::rollBack();
             if ($request->wantsJson()) {
                 return response()->json([
                     'success' => false,
                     'message' => 'Gagal memperbarui status: ' . $e->getMessage()
                 ], 500);
             }
             return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
         }
     }

    /**
     * Kirim Tanggapan Baru (Admin).
     */
    public function storeTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string',
        ], [
            'isi_tanggapan.required' => 'Isi tanggapan tidak boleh kosong.',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        Tanggapan::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'id_admin' => Auth::user()->id_user,
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        $this->notifyUser(
            $pengaduan,
            'Tanggapan admin baru',
            "Admin memberikan tanggapan pada pengaduan '{$pengaduan->judul}'."
        );
        $this->recordActivity('tanggapan_dikirim', 'Admin mengirim tanggapan resmi kepada mahasiswa.', $pengaduan);

        return back()->with('success', 'Tanggapan Anda berhasil dikirim.');
    }

    public function storeKategori(Request $request)
    {
        if (Auth::user()->role === 'pimpinan') {
            abort(403);
        }

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori',
            'deskripsi' => 'nullable|string',
            'status_aktif' => 'nullable|boolean',
        ]);

        KategoriPengaduan::create([
            'nama_kategori' => $validated['nama_kategori'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status_aktif' => $request->boolean('status_aktif', true),
        ]);

        $this->recordActivity('kategori_ditambah', "Kategori {$validated['nama_kategori']} ditambahkan.");

        return back()->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, $id)
    {
        if (Auth::user()->role === 'pimpinan') {
            abort(403);
        }

        $kategori = KategoriPengaduan::findOrFail($id);
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori,' . $kategori->id_kategori . ',id_kategori',
            'deskripsi' => 'nullable|string',
            'status_aktif' => 'nullable|boolean',
        ]);

        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        $this->recordActivity('kategori_diperbarui', "Kategori {$kategori->nama_kategori} diperbarui.");

        return back()->with('success', 'Kategori pengaduan berhasil diperbarui.');
    }

    public function storeComment(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ], [
            'message.required' => 'Komentar tidak boleh kosong.',
            'message.max' => 'Komentar maksimal 2000 karakter.',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'mahasiswa' && (int) $pengaduan->id_user !== (int) $user->id_user) {
            abort(403);
        }

        PengaduanComment::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'id_user' => $user->id_user,
            'message' => $validated['message'],
        ]);

        if ($user->role !== 'mahasiswa') {
            $this->notifyUser($pengaduan, 'Komentar lanjutan baru', "Admin menambahkan komentar pada tiket {$pengaduan->ticket_number}.");
        }

        $this->recordActivity('komentar_ditambahkan', 'Komentar lanjutan ditambahkan pada pengaduan.', $pengaduan, null, ['message' => $validated['message']]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function confirmCompletion(Request $request, $id)
    {
        $validated = $request->validate([
            'completion_note' => 'nullable|string|max:1000',
        ]);

        $pengaduan = Pengaduan::where('id_user', Auth::id())->findOrFail($id);

        if (!in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true)) {
            return back()->with('warning', 'Pengaduan belum berada pada tahap konfirmasi penyelesaian.');
        }

        $before = $pengaduan->only(['status', 'completed_confirmed_at', 'completion_note']);
        $pengaduan->update([
            'status' => 'selesai',
            'completed_confirmed_at' => now(),
            'completion_note' => $validated['completion_note'] ?? 'Penyelesaian dikonfirmasi oleh mahasiswa.',
        ]);

        StatusLog::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'status_lama' => $before['status'],
            'status_baru' => 'selesai',
            'catatan' => $pengaduan->completion_note,
            'created_by' => Auth::id(),
        ]);

        $this->recordActivity('penyelesaian_dikonfirmasi', 'Mahasiswa mengonfirmasi pengaduan selesai.', $pengaduan, $before, $pengaduan->only(['status', 'completed_confirmed_at', 'completion_note']));

        return back()->with('success', 'Terima kasih, penyelesaian pengaduan sudah dikonfirmasi.');
    }

    public function reopenPengaduan(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ], [
            'message.required' => 'Alasan buka ulang wajib diisi.',
        ]);

        $pengaduan = Pengaduan::where('id_user', Auth::id())->findOrFail($id);

        if (!in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true)) {
            return back()->with('warning', 'Pengaduan belum dapat dibuka ulang.');
        }

        $before = $pengaduan->only(['status', 'reopened_at']);
        $pengaduan->update([
            'status' => 'ditindaklanjuti',
            'reopened_at' => now(),
            'completed_confirmed_at' => null,
        ]);

        StatusLog::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'status_lama' => $before['status'],
            'status_baru' => 'ditindaklanjuti',
            'catatan' => $validated['message'],
            'created_by' => Auth::id(),
        ]);

        PengaduanComment::create([
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'id_user' => Auth::id(),
            'message' => 'Buka ulang: ' . $validated['message'],
        ]);

        $this->recordActivity('pengaduan_dibuka_ulang', 'Mahasiswa meminta pengaduan ditindaklanjuti kembali.', $pengaduan, $before, $pengaduan->only(['status', 'reopened_at']));

        return back()->with('success', 'Pengaduan dibuka ulang dan masuk ke tahap tindak lanjut.');
    }

    public function exportPengaduan(Request $request)
    {
        $fileName = 'export-pengaduan-' . now()->format('Ymd-His') . '.csv';
        $pengaduans = $this->filterPengaduanQuery(
            Pengaduan::with(['user', 'kategori'])->latest(),
            $request
        )->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ];

        return response()->streamDownload(function () use ($pengaduans) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Tiket', 'Prioritas', 'Status', 'Kategori', 'Pelapor', 'NIM/NIP', 'Judul', 'Tanggal', 'Deadline']);

            foreach ($pengaduans as $item) {
                fputcsv($handle, [
                    $item->ticket_number,
                    $this->priorityLabels[$item->priority] ?? $item->priority,
                    $this->statusLabels[$item->status] ?? $item->status,
                    $item->kategori?->nama_kategori,
                    $item->user?->nama,
                    $item->user?->nim_nip,
                    $item->judul,
                    $item->created_at?->format('Y-m-d H:i:s'),
                    $item->due_at?->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, $fileName, $headers);
    }

    protected function filterPengaduanQuery($query, Request $request)
    {
        return $query
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;
                $query->where(function ($query) use ($q) {
                    $query->where('judul', 'like', "%{$q}%")
                        ->orWhere('isi_pengaduan', 'like', "%{$q}%")
                        ->orWhere('ticket_number', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('priority'), fn ($query) => $query->where('priority', $request->priority))
            ->when($request->filled('kategori'), fn ($query) => $query->where('id_kategori', $request->kategori))
            ->when($request->filled('tanggal_mulai'), fn ($query) => $query->whereDate('created_at', '>=', $request->tanggal_mulai))
            ->when($request->filled('tanggal_selesai'), fn ($query) => $query->whereDate('created_at', '<=', $request->tanggal_selesai));
    }

    protected function notifyUser(Pengaduan $pengaduan, string $title, string $message): void
    {
        Notification::create([
            'id_user' => $pengaduan->id_user,
            'id_pengaduan' => $pengaduan->id_pengaduan,
            'title' => $title,
            'message' => $message,
        ]);
    }

    protected function priorityDueDays(string $priority): int
    {
        return match ($priority) {
            'darurat' => 1,
            'tinggi' => 2,
            'rendah' => 5,
            default => 3,
        };
    }

    protected function generateTicketNumber(): string
    {
        $prefix = 'PGD-' . now()->format('Y') . '-';
        $sequence = Pengaduan::where('ticket_number', 'like', $prefix . '%')->count() + 1;

        do {
            $ticket = $prefix . str_pad((string) $sequence, 5, '0', STR_PAD_LEFT);
            $sequence++;
        } while (Pengaduan::where('ticket_number', $ticket)->exists());

        return $ticket;
    }

    protected function progressSteps(Pengaduan $pengaduan): array
    {
        $steps = [
            'pending' => 'Diajukan',
            'proses' => 'Diverifikasi',
            'ditindaklanjuti' => 'Ditindaklanjuti',
            'menunggu_verifikasi_mahasiswa' => 'Konfirmasi',
            'selesai' => 'Selesai',
        ];

        $statusOrder = [
            'pending' => 1,
            'proses' => 2,
            'menunggu_klarifikasi' => 2,
            'ditindaklanjuti' => 3,
            'menunggu_verifikasi_mahasiswa' => 4,
            'selesai' => 5,
            'ditolak' => 1,
        ];

        $current = $statusOrder[$pengaduan->status] ?? 1;

        return collect($steps)->map(function ($label, $status) use ($current, $pengaduan, $statusOrder) {
            $stepIndex = $statusOrder[$status];

            return [
                'status' => $status,
                'label' => $label,
                'state' => $pengaduan->status === 'ditolak' && $status !== 'pending'
                    ? 'muted'
                    : ($stepIndex < $current ? 'done' : ($stepIndex === $current ? 'active' : 'pending')),
            ];
        })->values()->all();
    }

    protected function recordActivity(string $action, ?string $description = null, ?Pengaduan $pengaduan = null, ?array $before = null, ?array $after = null): void
    {
        ActivityLog::create([
            'id_user' => Auth::id(),
            'id_pengaduan' => $pengaduan?->id_pengaduan,
            'action' => $action,
            'description' => $description,
            'ip_address' => request()?->ip(),
            'user_agent' => substr((string) request()?->userAgent(), 0, 1000),
            'before_data' => $before,
            'after_data' => $after,
        ]);
    }
}
