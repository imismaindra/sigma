<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan - SIPMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#1d4ed8; --primary-dark:#1e3a8a; --primary-soft:#dbeafe; --accent:#0f766e; --bg:#f5f7fb; --surface:#fff; --surface-soft:#f8fafc; --border:#e2e8f0; --text:#0f172a; --muted:#64748b; --danger:#dc2626; --shadow:0 18px 45px rgba(15,23,42,.08); }
        * { box-sizing:border-box; margin:0; padding:0; font-family:'Inter',-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; }
        body { min-height:100vh; background:radial-gradient(circle at 12% 0%,rgba(29,78,216,.12),transparent 28%),var(--bg); color:var(--text); }
        .navbar { background:rgba(255,255,255,.94); border-bottom:1px solid var(--border); position:sticky; top:0; z-index:10; }
        .navbar-inner { max-width:1120px; margin:0 auto; min-height:68px; padding:0 24px; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .brand { display:flex; align-items:center; gap:12px; color:var(--text); text-decoration:none; font-weight:800; }
        .brand-mark { width:42px; height:42px; border-radius:8px; display:grid; place-items:center; color:#fff; background:linear-gradient(135deg,var(--primary),var(--primary-dark)); }
        .btn-nav { min-height:38px; border:1px solid var(--border); border-radius:8px; padding:0 13px; display:inline-flex; align-items:center; text-decoration:none; color:var(--primary-dark); background:#fff; font-size:12px; font-weight:800; }
        .container { max-width:1120px; margin:0 auto; padding:26px 24px 44px; }
        .hero, .card { background:rgba(255,255,255,.94); border:1px solid var(--border); border-radius:12px; box-shadow:var(--shadow); }
        .hero { padding:24px; margin-bottom:18px; }
        .eyebrow { display:inline-flex; min-height:28px; align-items:center; border-radius:999px; background:var(--primary-soft); color:var(--primary-dark); padding:0 10px; font-size:12px; font-weight:800; margin-bottom:12px; }
        h1 { font-size:clamp(26px,4vw,40px); line-height:1.12; margin-bottom:10px; }
        .meta { display:flex; flex-wrap:wrap; gap:10px; color:var(--muted); font-size:13px; }
        .badge { padding:4px 9px; border-radius:999px; font-size:11px; font-weight:800; text-transform:uppercase; border:1px solid transparent; }
        .badge-pending { background:#fef3c7; color:#b45309; border-color:#fde68a; }
        .badge-proses { background:#dbeafe; color:#1d4ed8; border-color:#bfdbfe; }
        .badge-menunggu_klarifikasi, .badge-menunggu_verifikasi_mahasiswa { background:#ede9fe; color:#6d28d9; border-color:#ddd6fe; }
        .badge-ditindaklanjuti { background:#ccfbf1; color:#0f766e; border-color:#99f6e4; }
        .badge-selesai { background:#d1fae5; color:#047857; border-color:#a7f3d0; }
        .badge-ditolak { background:#fee2e2; color:#b91c1c; border-color:#fca5a5; }
        .progress-card { margin-top:18px; padding:18px; border:1px solid var(--border); border-radius:12px; background:#fff; }
        .progress-track { position:relative; display:grid; grid-template-columns:repeat(5,1fr); gap:8px; margin-top:14px; }
        .progress-step { position:relative; display:grid; gap:8px; justify-items:center; text-align:center; color:var(--muted); font-size:11px; font-weight:800; }
        .progress-dot { width:32px; height:32px; border-radius:999px; display:grid; place-items:center; border:2px solid #cbd5e1; background:#fff; color:#94a3b8; z-index:1; box-shadow:0 0 0 5px #fff; }
        .progress-check { width:18px; height:18px; display:none; }
        .progress-step.done .progress-dot, .progress-step.active .progress-dot { border-color:#16a34a; background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff; box-shadow:0 8px 18px rgba(22,163,74,.2),0 0 0 5px #fff; }
        .progress-step.done .progress-check, .progress-step.active .progress-check { display:block; }
        .progress-step.done .progress-number, .progress-step.active .progress-number { display:none; }
        .progress-step.done, .progress-step.active { color:#166534; }
        .progress-step.muted { opacity:.45; }
        .progress-line { position:absolute; top:15px; left:10%; right:10%; height:3px; background:#e2e8f0; border-radius:999px; }
        .progress-line-fill { height:100%; border-radius:999px; background:linear-gradient(135deg,#22c55e,#16a34a); width:{{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%; }
        .grid { display:grid; grid-template-columns:minmax(0,1fr) minmax(300px,380px); gap:18px; align-items:start; }
        .card { padding:20px; margin-bottom:18px; }
        .section-title { font-size:16px; font-weight:800; margin-bottom:12px; }
        .body-text { white-space:pre-wrap; color:#1f2937; line-height:1.65; font-size:14px; background:var(--surface-soft); border:1px solid var(--border); border-radius:10px; padding:14px; }
        .attachments { display:grid; gap:10px; }
        .attachment { border:1px solid var(--border); border-radius:10px; padding:10px; color:var(--primary-dark); text-decoration:none; font-size:13px; font-weight:700; background:#fff; }
        .attachment img { display:block; width:100%; max-height:220px; object-fit:cover; border-radius:8px; margin-top:8px; border:1px solid var(--border); }
        .timeline { display:grid; gap:10px; }
        .timeline-item { border-left:3px solid var(--primary); background:#f8fafc; padding:10px 12px; border-radius:8px; font-size:13px; line-height:1.5; }
        .timeline-meta { color:var(--muted); font-size:12px; margin-top:4px; }
        .form-grid { display:grid; gap:12px; }
        .form-label { display:block; font-size:12px; font-weight:800; margin-bottom:6px; }
        .form-input, .form-select, .form-textarea { width:100%; border:1px solid var(--border); border-radius:9px; background:#f8fafc; color:var(--text); padding:10px 12px; font-size:13px; outline:none; }
        .form-input, .form-select { min-height:42px; }
        .form-textarea { min-height:120px; resize:vertical; }
        .btn-primary, .btn-danger { min-height:42px; border:0; border-radius:9px; padding:0 14px; color:#fff; font-size:13px; font-weight:800; cursor:pointer; }
        .btn-primary { background:linear-gradient(135deg,var(--primary),#2563eb); }
        .btn-danger { background:var(--danger); width:100%; }
        .alert { border-radius:10px; padding:12px 14px; margin-bottom:16px; font-size:13px; }
        .alert-success { background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; }
        .alert-danger { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; }
        @media(max-width:820px){ .grid{grid-template-columns:1fr;} .navbar-inner{padding:12px 16px;} .container{padding:20px 16px 32px;} }
        @media(max-width:640px){
            .progress-track{grid-template-columns:1fr;gap:0;margin-top:16px;padding-left:0;}
            .progress-line{display:block;top:16px;bottom:16px;left:15px;right:auto;width:3px;height:auto;background:#e2e8f0;border-radius:999px;}
            .progress-line-fill{width:100%;height:{{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%;background:linear-gradient(180deg,#22c55e,#16a34a);}
            .progress-step{grid-template-columns:32px 1fr;justify-items:start;text-align:left;align-items:center;min-height:46px;gap:12px;}
            .progress-dot{box-shadow:0 0 0 3px #fff;}
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('mahasiswa.dashboard') }}" class="brand"><span class="brand-mark">SP</span><span>SIPMA</span></a>
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn-nav">Kembali ke Dashboard</a>
        </div>
    </nav>

    <main class="container">
        <section class="hero">
            <div class="eyebrow">{{ $pengaduan->kategori->nama_kategori }}</div>
            <h1>{{ $pengaduan->judul }}</h1>
            <div class="meta">
                <span>Tiket: <strong>{{ $pengaduan->ticket_number ?? 'Belum tersedia' }}</strong></span>
                <span class="badge badge-{{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                <span>Prioritas: <strong>{{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}</strong></span>
                <span>Dibuat: {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                @if($pengaduan->due_at)
                    <span>Batas tindak lanjut: {{ $pengaduan->due_at->format('d M Y, H:i') }}</span>
                @endif
            </div>
            <div class="progress-card" aria-label="Progress pengaduan">
                <div class="section-title" style="margin-bottom:4px;">Progress Pengaduan</div>
                <p style="color:var(--muted);font-size:13px;line-height:1.5;">Pantau posisi laporan Anda dari tahap pengajuan sampai penyelesaian.</p>
                <div class="progress-track">
                    <div class="progress-line"><div class="progress-line-fill"></div></div>
                    @foreach($progressSteps as $index => $step)
                        <div class="progress-step {{ $step['state'] }}">
                            <span class="progress-dot">
                                <svg class="progress-check" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12.5 4.2 4.2L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="progress-number">{{ $index + 1 }}</span>
                            </span>
                            <span>{{ $step['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger"><ul style="padding-left:16px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <div class="grid">
            <section>
                <article class="card">
                    <div class="section-title">Isi Laporan</div>
                    <div class="body-text">{{ $pengaduan->isi_pengaduan }}</div>
                </article>

                <article class="card">
                    <div class="section-title">Lampiran</div>
                    @if($pengaduan->lampiran->isEmpty())
                        <p style="color:var(--muted);font-size:13px;">Belum ada lampiran.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" style="margin-top:10px; display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:10px;">
                            @foreach($pengaduan->lampiran as $file)
                                <div class="flex items-center gap-3 p-2 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100/50 transition-colors" style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:10px; display:flex; align-items:center; gap:12px;">
                                    @if(Str::startsWith($file->tipe_file, 'image/'))
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}" class="w-10 h-10 rounded object-cover border border-slate-200" style="width:40px; height:40px; border-radius:6px; object-fit:cover; border:1px solid #e2e8f0; flex-shrink:0;">
                                    @else
                                        @php
                                            $ext = pathinfo($file->nama_file, PATHINFO_EXTENSION) ?: 'FILE';
                                        @endphp
                                        <div class="w-10 h-10 rounded bg-slate-200 border border-slate-350 flex items-center justify-center text-[10px] font-extrabold text-slate-600" style="width:40px; height:40px; border-radius:6px; background:#e2e8f0; border:1px solid #cbd5e1; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:800; color: #4b5563; flex-shrink:0;">{{ strtoupper($ext) }}</div>
                                    @endif
                                    <div style="min-width:0; flex:1;">
                                        <p style="font-size:12px; font-weight:700; color:#1f2937; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $file->nama_file }}">{{ $file->nama_file }}</p>
                                        <p style="font-size:10px; color:#6b7280; margin:3px 0 0 0;">{{ explode('/', $file->tipe_file)[1] ?? 'Dokumen' }}</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex items-center justify-center p-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 transition-colors" style="display:inline-flex; align-items:center; justify-content:center; padding:6px; border-radius:6px; background:#dbeafe; color:#1d4ed8; text-decoration:none; flex-shrink:0;" title="Lihat Berkas">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:16px; height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </article>

                <article class="card">
                    <div class="section-title">Komentar Lanjutan</div>
                    <div class="timeline" style="margin-bottom:14px;">
                        @forelse($pengaduan->comments as $comment)
                            <div class="timeline-item">
                                <strong>{{ $comment->user->nama }}</strong>
                                <div>{{ $comment->message }}</div>
                                <div class="timeline-meta">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p style="color:var(--muted);font-size:13px;">Belum ada komentar lanjutan.</p>
                        @endforelse
                    </div>
                    <form action="{{ route('mahasiswa.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                        @csrf
                        <textarea name="message" class="form-textarea" placeholder="Tambahkan informasi lanjutan atau balas komentar admin..." required></textarea>
                        <button type="submit" class="btn-primary">Kirim Komentar</button>
                    </form>
                </article>

                <article class="card">
                    <div class="section-title">Tanggapan Admin</div>
                    <div class="timeline">
                        @forelse($pengaduan->tanggapan as $reply)
                            <div class="timeline-item">
                                <strong>{{ $reply->admin->nama }}</strong>
                                <div>{{ $reply->isi_tanggapan }}</div>
                                <div class="timeline-meta">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p style="color:var(--muted);font-size:13px;">Belum ada tanggapan admin.</p>
                        @endforelse
                    </div>
                </article>
            </section>

            <aside>
                <article class="card">
                    <div class="section-title">Riwayat Status</div>
                    <div class="timeline">
                        @forelse($pengaduan->statusLogs as $log)
                            <div class="timeline-item">
                                <div><strong>{{ $log->status_lama ?: 'awal' }}</strong> menjadi <strong>{{ $log->status_baru }}</strong></div>
                                @if($log->catatan)<div>{{ $log->catatan }}</div>@endif
                                <div class="timeline-meta">{{ $log->creator->nama }} - {{ $log->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p style="color:var(--muted);font-size:13px;">Belum ada perubahan status.</p>
                        @endforelse
                    </div>
                </article>

                @if($pengaduan->isEditable())
                    <article class="card">
                        <div class="section-title">Edit Pengaduan Pending</div>
                        <form action="{{ route('mahasiswa.pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data" class="form-grid">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label" for="id_kategori">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-select" required>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ $pengaduan->id_kategori === $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="judul">Judul</label>
                                <input type="text" id="judul" name="judul" class="form-input" value="{{ old('judul', $pengaduan->judul) }}" required>
                            </div>
                            <div>
                                <label class="form-label" for="priority">Prioritas</label>
                                <select name="priority" id="priority" class="form-select" required>
                                    @foreach($priorityLabels as $key => $label)
                                        <option value="{{ $key }}" {{ old('priority', $pengaduan->priority ?? 'sedang') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="isi_pengaduan">Isi Pengaduan</label>
                                <textarea id="isi_pengaduan" name="isi_pengaduan" class="form-textarea" required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
                            </div>
                            <div>
                                <label class="form-label" for="lampiran">Tambah Lampiran</label>
                                <input type="file" id="lampiran" name="lampiran[]" class="form-input" multiple accept=".pdf,.docx,.jpg,.jpeg,.png">
                                <div id="filePreview" class="file-note" style="display:grid; gap:8px; margin-top:12px; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));"></div>
                            </div>
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </form>
                    </article>

                    <article class="card">
                        <div class="section-title">Batalkan Pengaduan</div>
                        <form action="{{ route('mahasiswa.pengaduan.cancel', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                            @csrf
                            <div>
                                <label class="form-label" for="cancel_reason">Alasan pembatalan</label>
                                <textarea id="cancel_reason" name="cancel_reason" class="form-textarea" placeholder="Opsional"></textarea>
                            </div>
                            <button type="submit" class="btn-danger">Batalkan Pengaduan</button>
                        </form>
                    </article>
                @endif

                @if(in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true) && !$pengaduan->completed_confirmed_at)
                    <article class="card">
                        <div class="section-title">Konfirmasi Penyelesaian</div>
                        <form action="{{ route('mahasiswa.pengaduan.confirm', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid" style="margin-bottom:12px;">
                            @csrf
                            <textarea name="completion_note" class="form-textarea" placeholder="Catatan opsional setelah masalah terselesaikan"></textarea>
                            <button type="submit" class="btn-primary">Konfirmasi Selesai</button>
                        </form>
                        <form action="{{ route('mahasiswa.pengaduan.reopen', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                            @csrf
                            <textarea name="message" class="form-textarea" placeholder="Jika belum selesai, jelaskan bagian yang masih perlu ditindaklanjuti" required></textarea>
                            <button type="submit" class="btn-danger">Buka Ulang</button>
                        </form>
                    </article>
                @elseif($pengaduan->completed_confirmed_at)
                    <article class="card">
                        <div class="section-title">Penyelesaian Dikonfirmasi</div>
                        <p style="color:var(--muted);font-size:13px;line-height:1.6;">Dikonfirmasi pada {{ $pengaduan->completed_confirmed_at->format('d M Y, H:i') }}.</p>
                    </article>
                @endif
            </aside>
        </div>
    </main>
    <script>
        document.getElementById('lampiran')?.addEventListener('change', function () {
            const preview = document.getElementById('filePreview');
            const files = Array.from(this.files || []);
            preview.innerHTML = files.length ? files.map((file) => {
                const size = (file.size / 1024 / 1024).toFixed(2);
                const isTooLarge = file.size > 2 * 1024 * 1024;
                const containerStyle = isTooLarge 
                    ? 'border:1px solid #fecaca; background:#fff5f5; color:#991b1b; padding:8px; border-radius:8px; display:flex; align-items:center; gap:10px; font-size:12px;' 
                    : 'border:1px solid #e2e8f0; background:#f8fafc; color:#374151; padding:8px; border-radius:8px; display:flex; align-items:center; gap:10px; font-size:12px;';
                
                let previewHtml = '';
                if (file.type.startsWith('image/')) {
                    const imgUrl = URL.createObjectURL(file);
                    previewHtml = `<img src="${imgUrl}" class="w-10 h-10 rounded object-cover border border-slate-250 bg-white" style="width:40px; height:40px; border-radius:6px; object-fit:cover; border:1px solid #cbd5e1; flex-shrink:0;" />`;
                } else {
                    let ext = file.name.split('.').pop().toUpperCase();
                    previewHtml = `<div class="w-10 h-10 rounded bg-slate-200 border border-slate-350 flex items-center justify-center text-[10px] font-extrabold text-slate-600" style="width:40px; height:40px; border-radius:6px; background:#e2e8f0; border:1px solid #cbd5e1; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:800; color:#4b5563; flex-shrink:0;">${ext}</div>`;
                }

                return `
                    <div style="${containerStyle}">
                        ${previewHtml}
                        <div style="min-width:0; flex:1;">
                            <p style="font-weight:700; color:#1f2937; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="${file.name}">${file.name}</p>
                            <p style="font-size:10px; color:#6b7280; margin:3px 0 0 0;">${size} MB ${isTooLarge ? '<span style="color:#dc2626; font-weight:800;">(Maksimal 2 MB)</span>' : ''}</p>
                        </div>
                    </div>
                `;
            }).join('') : '';
        });
    </script>
    @include('partials.toast')
</body>
</html>
