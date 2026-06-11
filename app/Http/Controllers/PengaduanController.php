<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Lampiran;
use App\Models\Pengaduan;
use App\Models\StatusLog;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Dashboard Mahasiswa - Tampilkan pengaduan milik sendiri & form kirim.
     */
    public function mahasiswaDashboard()
    {
        $user = Auth::user();
        
        // Ambil pengaduan milik mahasiswa saat ini beserta relasinya, diurutkan terbaru
        $pengaduans = Pengaduan::with(['kategori', 'lampiran', 'statusLogs', 'tanggapan'])
            ->where('id_user', $user->id_user)
            ->latest()
            ->get();

        // Ambil kategori pengaduan yang aktif untuk pilihan di form
        $kategoris = KategoriPengaduan::where('status_aktif', true)->get();

        return view('mahasiswa.dashboard', compact('pengaduans', 'kategoris'));
    }

    /**
     * Kirim Pengaduan Baru (Mahasiswa).
     */
    public function storePengaduan(Request $request)
    {
        // 1. Validasi Input dan Pembatasan Upload File
        $request->validate([
            'id_kategori' => 'required|exists:kategori_pengaduan,id_kategori',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png|max:2048', // Batasan: PDF, DOCX, JPG, PNG maks 2MB
        ], [
            'id_kategori.required' => 'Kategori pengaduan wajib dipilih.',
            'id_kategori.exists' => 'Kategori pengaduan tidak valid atau tidak aktif.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul pengaduan maksimal 255 karakter.',
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
                'judul' => $request->judul,
                'isi_pengaduan' => $request->isi_pengaduan,
                'status' => 'pending',
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
        // Ambil semua pengaduan beserta relasinya untuk kebutuhan panel admin
        $pengaduans = Pengaduan::with(['user', 'kategori', 'lampiran', 'statusLogs', 'tanggapan'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('pengaduans'));
    }

    /**
     * Update Status Pengaduan & Catat Riwayat Perubahan (Status Log).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
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

            DB::commit();
            return back()->with('success', "Status pengaduan berhasil diperbarui menjadi {$statusBaru}.");

        } catch (\Exception $e) {
            DB::rollBack();
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

        return back()->with('success', 'Tanggapan Anda berhasil dikirim.');
    }
}
