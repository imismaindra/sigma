@extends('layouts.mahasiswa')

@section('title', 'Detail Pengaduan')
@section('page_title', 'Detail Pengaduan')
@section('page_subtitle', 'Pantau rincian detail, lampiran berkas, timeline progress, dan respon resmi dari pihak kampus.')

@section('content')
    <!-- Breadcrumb -->
    <nav class="flex text-[10px] font-extrabold text-slate-450 tracking-wider uppercase mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1.5">
            <li><a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a></li>
            <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
            <li><span class="text-slate-800">Detail Pengaduan</span></li>
        </ol>
    </nav>

    <!-- Hero Card header -->
    <section class="bg-white/80 border border-slate-200/80 rounded-2xl p-6 lg:p-7 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden mb-6">
        <div class="space-y-3 max-w-4xl relative z-10">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-md border border-slate-200 shadow-3xs">
                    <i data-lucide="hash" class="w-3 h-3"></i>
                    {{ $pengaduan->ticket_number ?? 'PGD' }}
                </span>
                
                @php
                    $badgeClasses = [
                        'pending' => 'bg-amber-50/70 text-amber-700 border-amber-200 shadow-amber-500/5',
                        'proses' => 'bg-blue-50/70 text-blue-700 border-blue-200 shadow-blue-500/5',
                        'menunggu_klarifikasi' => 'bg-purple-50/70 text-purple-700 border-purple-200 shadow-purple-500/5',
                        'menunggu_verifikasi_mahasiswa' => 'bg-indigo-50/70 text-indigo-700 border-indigo-200 shadow-indigo-500/5',
                        'ditindaklanjuti' => 'bg-teal-50/70 text-teal-700 border-teal-200 shadow-teal-500/5',
                        'selesai' => 'bg-emerald-50/70 text-emerald-700 border-emerald-200 shadow-emerald-500/5',
                        'ditolak' => 'bg-rose-50/70 text-rose-700 border-rose-200 shadow-rose-500/5',
                    ];
                    $badgeColor = $badgeClasses[$pengaduan->status] ?? 'bg-slate-50 text-slate-800 border-slate-200';
                @endphp
                <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-md border shadow-3xs {{ $badgeColor }}">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-current opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-current"></span>
                    </span>
                    {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                </span>

                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-650 px-2.5 py-0.5 rounded-md border border-indigo-100 shadow-3xs">
                    <i data-lucide="flag" class="w-3 h-3"></i>
                    Prioritas: {{ $priorityLabels[$pengaduan->priority] ?? $pengaduan->priority }}
                </span>
            </div>

            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight leading-snug text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-950 to-violet-900">
                {{ $pengaduan->judul }}
            </h1>

            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                Kategori: <strong class="text-slate-800 font-bold">{{ $pengaduan->kategori->nama_kategori }}</strong> 
                • Dilaporkan: <strong class="text-slate-800 font-bold">{{ $pengaduan->created_at->format('d M Y, H:i') }} WIB</strong>
                @if($pengaduan->due_at)
                • Target Selesai (SLA): <strong class="text-slate-800 font-bold">{{ $pengaduan->due_at->format('d M Y, H:i') }} WIB</strong>
                @endif
            </p>
        </div>

        <!-- Progress Tracker Block -->
        <div class="bg-white border border-slate-200 rounded-xl p-4.5 min-w-[280px] shadow-3xs z-10 space-y-3">
            <h4 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wider">Progress Penanganan</h4>
            
            <div class="relative flex items-center justify-between gap-1 w-full pt-1.5">
                <!-- Line indicator -->
                <div class="absolute top-[15px] left-3 right-3 h-1 bg-slate-100 rounded-full z-0">
                    @php
                        $doneStepsCount = collect($progressSteps)->whereIn('state', ['done', 'active'])->count();
                        $fillWidth = (($doneStepsCount - 1) / 4) * 100;
                    @endphp
                    <div class="h-full bg-emerald-500 rounded-full transition-all duration-700" style="width: {{ max(0, min(100, $fillWidth)) }}%"></div>
                </div>

                @foreach($progressSteps as $index => $step)
                    @php
                        $stepBg = 'border-slate-300 bg-white text-slate-400';
                        $iconHtml = '<span class="text-[10px] font-extrabold">' . ($index + 1) . '</span>';
                        
                        if ($step['state'] === 'done') {
                            $stepBg = 'border-emerald-500 bg-emerald-500 text-white';
                            $iconHtml = '<i data-lucide="check" class="w-3.5 h-3.5"></i>';
                        } elseif ($step['state'] === 'active') {
                            $stepBg = 'border-indigo-600 bg-indigo-600 text-white ring-4 ring-indigo-100';
                            $iconHtml = '<i data-lucide="clock" class="w-3.5 h-3.5 animate-spin" style="animation-duration:6s;"></i>';
                        }
                    @endphp
                    <div class="flex flex-col items-center z-10 group cursor-help" title="{{ $step['label'] }}">
                        <div class="w-7.5 h-7.5 rounded-full border-2 flex items-center justify-center transition-all duration-300 shadow-3xs {{ $stepBg }}">
                            {!! $iconHtml !!}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-[10.5px] text-slate-500 font-bold text-center">
                Tahapan Saat ini: <span class="text-indigo-600">
                    @php
                        $activeStep = collect($progressSteps)->where('state', 'active')->first() ?? collect($progressSteps)->where('state', 'done')->last();
                        echo $activeStep ? $activeStep['label'] : 'Pending';
                    @endphp
                </span>
            </div>
        </div>
    </section>

    <!-- Two Columns Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start relative z-10">
        
        <!-- Left Column: Details & Comments -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Detail Keluhan -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Isi Laporan / Detail Pengaduan</h3>
                </div>
                <div class="bg-slate-50 border border-slate-150 rounded-xl p-5 text-xs sm:text-sm text-slate-750 leading-relaxed whitespace-pre-wrap select-text font-medium">
                    {{ $pengaduan->isi_pengaduan }}
                </div>
            </article>

            <!-- Card Lampiran -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="paperclip" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Berkas Lampiran Pendukung</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    @forelse($pengaduan->lampiran as $file)
                        <div class="flex items-center justify-between gap-3 p-3 bg-white border border-slate-200 rounded-xl hover:shadow-md hover:border-indigo-200/50 transition-all shadow-3xs group">
                            <div class="flex items-center gap-3 min-w-0">
                                @if(Str::startsWith($file->tipe_file, 'image/'))
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-200 bg-slate-50 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-350">
                                    </div>
                                @else
                                    @php
                                        $ext = pathinfo($file->nama_file, PATHINFO_EXTENSION) ?: 'FILE';
                                    @endphp
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 flex-shrink-0">
                                        {{ strtoupper($ext) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate" title="{{ $file->nama_file }}">{{ $file->nama_file }}</p>
                                    <p class="text-[9px] text-slate-450 font-bold uppercase tracking-wider">{{ explode('/', $file->tipe_file)[1] ?? 'File' }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-650 hover:bg-indigo-100 flex-shrink-0 transition-colors" title="Buka Berkas">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </div>
                    @empty
                        <div class="sm:col-span-2 text-center py-6 bg-slate-50/50 border border-dashed border-slate-200 rounded-xl">
                            <i data-lucide="info" class="w-5 h-5 text-slate-350 mx-auto mb-1"></i>
                            <p class="text-[11px] text-slate-500 font-semibold">Tidak ada lampiran dokumen untuk pengaduan ini.</p>
                        </div>
                    @endforelse
                </div>
            </article>

            <!-- Card Komentar Diskusi Lanjutan -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="message-square" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Komentar & Diskusi Lanjutan</h3>
                </div>

                <!-- Chat bubble style list -->
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1">
                    @forelse($pengaduan->comments as $comment)
                        @php
                            $isMe = $comment->id_user === Auth::id();
                        @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%] rounded-2xl px-4 py-2.5 shadow-3xs text-xs font-semibold leading-relaxed border
                                {{ $isMe ? 'bg-indigo-650 border-indigo-700 text-white rounded-br-none' : 'bg-slate-50 border-slate-200/80 text-slate-800 rounded-bl-none' }}
                            ">
                                <div class="flex items-center gap-2 border-b border-white/10 pb-1 mb-1 text-[9.5px] font-bold opacity-80 justify-between">
                                    <span>{{ $isMe ? 'Saya' : $comment->user->nama }}</span>
                                    <span>{{ $comment->created_at->format('d M, H:i') }}</span>
                                </div>
                                <p>{{ $comment->message }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-450 font-bold py-6 text-[11px]">Belum ada komentar diskusi lanjutan.</p>
                    @endforelse
                </div>

                <!-- Comment Form -->
                <form action="{{ route('mahasiswa.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="pt-4 border-t border-slate-100 space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1" for="message">Tambah Komentar Diskusi</label>
                        <textarea name="message" id="message" rows="3" class="form-textarea font-semibold" placeholder="Tulis pesan komentar atau tambahan informasi laporan..." required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary flex items-center gap-1.5 h-9 text-xs"><i data-lucide="send" class="w-3.5 h-3.5"></i> Kirim Komentar</button>
                    </div>
                </form>
            </article>
        </div>

        <!-- Right Column: Audit Logs & Action forms (reopen/cancel) -->
        <div class="space-y-6">
            
            <!-- Card Riwayat Status Log -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="route" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Perjalanan Log Status</h3>
                </div>
                
                <div class="relative border-l-2 border-slate-200 ml-2 pl-4 space-y-5 py-1">
                    @forelse($pengaduan->statusLogs as $log)
                        <div class="relative text-xs">
                            <span class="absolute -left-[28px] top-1.5 w-3 h-3 rounded-full bg-slate-300 border-2 border-white shadow-xs"></span>
                            <div class="space-y-1">
                                <p class="font-extrabold text-slate-900 leading-none">
                                    Dari <span class="text-slate-400 font-semibold text-[10px] line-through">{{ $log->status_lama ?: 'awal' }}</span> 
                                    &rarr; 
                                    <span class="text-indigo-600 font-bold">{{ $log->status_baru }}</span>
                                </p>
                                
                                @if($log->catatan)
                                    <div class="p-2 bg-slate-50 border border-slate-150 text-[10.5px] text-slate-650 italic font-semibold rounded-lg">
                                        "{{ $log->catatan }}"
                                    </div>
                                @endif
                                
                                <p class="text-[9px] text-slate-400 font-bold">
                                    {{ $log->creator->nama }} • {{ $log->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-450 font-semibold py-1">Belum ada perubahan status log.</p>
                    @endforelse
                </div>
            </article>

            <!-- Card Riwayat Tanggapan Resmi -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="message-square-quote" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Tanggapan Resmi Admin</h3>
                </div>
                
                <div class="space-y-3">
                    @forelse($pengaduan->tanggapan as $reply)
                        <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                            <div class="flex items-center justify-between gap-2 border-b border-slate-150 pb-1.5">
                                <span class="text-[11px] font-extrabold text-indigo-650 flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Admin: {{ $reply->admin->nama }}</span>
                                <span class="text-[9.5px] text-slate-400 font-bold">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed font-semibold">
                                {{ $reply->isi_tanggapan }}
                            </p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-450 font-semibold text-center py-4">Belum ada respon tanggapan resmi admin.</p>
                    @endforelse
                </div>
            </article>

            <!-- Action Panel: Edit / Cancel / Confirm / Reopen Forms -->
            @if($pengaduan->isEditable())
                <!-- Edit & Cancel panel -->
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 space-y-5">
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3.5 flex items-center gap-1.5"><i data-lucide="edit-3" class="w-4 h-4 text-indigo-650"></i> Edit Pengaduan</h4>
                        <form action="{{ route('mahasiswa.pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data" class="space-y-3.5">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label" for="id_kategori">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-select font-semibold" required>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ $pengaduan->id_kategori === $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="judul">Judul Laporan</label>
                                <input type="text" id="judul" name="judul" class="form-input font-semibold" value="{{ old('judul', $pengaduan->judul) }}" required>
                            </div>
                            <div>
                                <label class="form-label" for="priority">Prioritas</label>
                                <select name="priority" id="priority" class="form-select font-semibold" required>
                                    @foreach($priorityLabels as $key => $label)
                                        <option value="{{ $key }}" {{ old('priority', $pengaduan->priority ?? 'sedang') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="isi_pengaduan">Isi Pengaduan</label>
                                <textarea id="isi_pengaduan" name="isi_pengaduan" class="form-textarea font-semibold" required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
                            </div>
                            <div>
                                <label class="form-label" for="lampiran">Tambah Lampiran Berkas</label>
                                <input type="file" id="lampiran" name="lampiran[]" class="form-input" multiple accept=".pdf,.docx,.jpg,.jpeg,.png">
                                <div id="filePreview" class="file-note mt-2.5 grid gap-2 grid-cols-1"></div>
                            </div>
                            <button type="submit" class="btn-primary w-full text-xs">Simpan Perubahan</button>
                        </form>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3.5 flex items-center gap-1.5"><i data-lucide="x-circle" class="w-4 h-4 text-rose-600"></i> Batalkan Pengaduan</h4>
                        <form action="{{ route('mahasiswa.pengaduan.cancel', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
                            @csrf
                            <div>
                                <label class="form-label" for="cancel_reason">Alasan Pembatalan</label>
                                <textarea id="cancel_reason" name="cancel_reason" rows="2" class="form-textarea font-semibold" placeholder="Opsional..."></textarea>
                            </div>
                            <button type="submit" class="btn-danger w-full text-xs cursor-pointer shadow-md shadow-rose-500/10">Batalkan Pengaduan</button>
                        </form>
                    </div>
                </article>
            @endif

            @if(in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true) && !$pengaduan->completed_confirmed_at)
                <!-- Completion verification and reopen forms -->
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 space-y-5">
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3 flex items-center gap-1.5 text-emerald-650"><i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Penyelesaian</h4>
                        <p class="text-[10.5px] text-slate-500 mb-3">Jika masalah sudah teratasi dengan benar, silakan lakukan konfirmasi selesai.</p>
                        <form action="{{ route('mahasiswa.pengaduan.confirm', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
                            @csrf
                            <div>
                                <label class="form-label" for="completion_note">Catatan Penyelesaian</label>
                                <textarea name="completion_note" id="completion_note" rows="2" class="form-textarea font-semibold" placeholder="Catatan opsional setelah masalah terselesaikan..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full text-xs bg-emerald-600 hover:bg-emerald-700 border border-emerald-650 shadow-md shadow-emerald-500/10 cursor-pointer">Konfirmasi Selesai</button>
                        </form>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3 flex items-center gap-1.5 text-rose-600"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Buka Ulang Tiket</h4>
                        <p class="text-[10.5px] text-slate-500 mb-3">Buka kembali jika masalah belum terselesaikan secara tuntas.</p>
                        <form action="{{ route('mahasiswa.pengaduan.reopen', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
                            @csrf
                            <div>
                                <label class="form-label" for="reopen_message">Alasan Buka Ulang</label>
                                <textarea name="message" id="reopen_message" rows="2.5" class="form-textarea font-semibold" placeholder="Jelaskan bagian mana yang masih bermasalah dan belum ditindaklanjuti secara tuntas..." required></textarea>
                            </div>
                            <button type="submit" class="btn-danger w-full text-xs cursor-pointer shadow-md shadow-rose-500/10">Buka Ulang Laporan</button>
                        </form>
                    </div>
                </article>
            @elseif($pengaduan->completed_confirmed_at)
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 border-l-4 border-l-emerald-500 space-y-2">
                    <h4 class="text-xs font-extrabold text-emerald-700 uppercase flex items-center gap-1.5"><i data-lucide="check-circle" class="w-4.5 h-4.5"></i> Penyelesaian Dikonfirmasi</h4>
                    <p class="text-xs text-slate-650 font-semibold leading-relaxed">
                        Laporan pengaduan ini telah selesai ditangani dan konfirmasi penutupan tiket disetujui pada tanggal <strong class="text-slate-800">{{ $pengaduan->completed_confirmed_at->format('d M Y, H:i') }} WIB</strong>.
                    </p>
                </article>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Live file attachments preview logic inside edit panel
            document.getElementById('lampiran')?.addEventListener('change', function () {
                const preview = document.getElementById('filePreview');
                if(!preview) return;

                const files = Array.from(this.files || []);
                preview.innerHTML = ''; // Reset

                if (files.length === 0) return;

                files.forEach((file) => {
                    const sizeInMb = (file.size / (1024 * 1024)).toFixed(2);
                    const isTooLarge = file.size > 2 * 1024 * 1024;
                    const containerClass = isTooLarge
                        ? 'border border-rose-200 bg-rose-50/50 text-rose-750 p-2.5 rounded-lg flex items-center justify-between gap-3 text-xs shadow-3xs'
                        : 'border border-slate-200 bg-white text-slate-700 p-2.5 rounded-lg flex items-center justify-between gap-3 text-xs shadow-3xs hover:border-indigo-250 transition-all';
                    
                    const fileCard = document.createElement('div');
                    fileCard.className = containerClass;
                    
                    let previewIcon = '<i data-lucide="file-text" class="w-4 h-4 flex-shrink-0 text-slate-400"></i>';
                    if (file.type.startsWith('image/')) {
                        previewIcon = '<i data-lucide="image" class="w-4 h-4 flex-shrink-0 text-indigo-600"></i>';
                    }

                    fileCard.innerHTML = `
                        <div class="flex items-center gap-2 min-w-0">
                            ${previewIcon}
                            <div class="min-w-0">
                                <p class="font-bold truncate text-slate-800 text-[11px]" title="${file.name}">${file.name}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">${sizeInMb} MB ${isTooLarge ? '• UKURAN MELEBIHI BATAS!' : ''}</p>
                            </div>
                        </div>
                        ${isTooLarge ? '<i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-rose-600 flex-shrink-0"></i>' : '<i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 flex-shrink-0"></i>'}
                    `;
                    
                    preview.appendChild(fileCard);
                });

                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });
    </script>
@endsection
