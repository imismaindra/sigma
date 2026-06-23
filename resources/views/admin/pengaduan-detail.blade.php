<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan Admin - SIPMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#2563eb; --dark:#1e3a8a; --bg:#f3f4f6; --card:#fff; --border:#e5e7eb; --text:#1f2937; --muted:#4b5563; --danger:#dc2626; }
        *{box-sizing:border-box;margin:0;padding:0;font-family:'Inter',-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}
        body{background:var(--bg);color:var(--text);min-height:100vh}
        .navbar{display:flex;align-items:center;justify-content:space-between;padding:14px 40px;background:var(--dark);color:#fff;position:sticky;top:0;z-index:100;box-shadow:0 1px 3px rgba(0,0,0,.1)}
        .navbar-brand{font-size:18px;font-weight:800;color:#fff;text-decoration:none;letter-spacing:-.4px}
        .navbar-user{display:flex;align-items:center;gap:16px}
        .user-info{text-align:right}
        .user-name{font-size:14px;font-weight:700}
        .user-role{font-size:12px;color:#93c5fd}
        .btn-nav{min-height:36px;border:1px solid rgba(255,255,255,.2);border-radius:6px;padding:0 12px;display:inline-flex;align-items:center;justify-content:center;background:rgba(255,255,255,.1);color:#fff;text-decoration:none;font-size:12px;font-weight:800;cursor:pointer}
        .btn-nav:hover{background:rgba(255,255,255,.16)}
        .btn-nav.danger:hover{background:rgba(239,68,68,.2);border-color:rgba(239,68,68,.35);color:#fecaca}
        .container{width:100%;max-width:1500px;margin:24px auto;padding:0 24px 44px}
        .hero,.card{background:var(--card);border:1px solid var(--border);border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
        .hero{padding:22px;margin-bottom:18px}
        h1{font-size:28px;line-height:1.15;margin-bottom:10px}
        .meta{display:flex;flex-wrap:wrap;gap:10px;color:var(--muted);font-size:13px}
        .badge{padding:4px 9px;border-radius:999px;font-size:11px;font-weight:800;text-transform:uppercase}
        .badge-pending{background:#fef3c7;color:#b45309}.badge-proses{background:#dbeafe;color:#1d4ed8}.badge-menunggu_klarifikasi,.badge-menunggu_verifikasi_mahasiswa{background:#ede9fe;color:#6d28d9}.badge-ditindaklanjuti{background:#ccfbf1;color:#0f766e}.badge-selesai{background:#d1fae5;color:#047857}.badge-ditolak{background:#fee2e2;color:#b91c1c}
        .grid{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(360px,.75fr);gap:20px;align-items:start}
        .card{padding:18px;margin-bottom:18px}
        .section-title{font-size:16px;font-weight:800;margin-bottom:12px}
        .body-text{white-space:pre-wrap;line-height:1.7;background:#f9fafb;border:1px solid var(--border);border-radius:8px;padding:16px;font-size:14px}
        .info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:10px;margin-top:14px}
        .info-item{border:1px solid var(--border);border-radius:8px;background:#f9fafb;padding:12px}
        .info-label{font-size:11px;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.04em;margin-bottom:5px}
        .info-value{font-size:13px;font-weight:800;color:var(--text)}
        .timeline{display:grid;gap:10px}.timeline-item{background:#f9fafb;border-left:3px solid var(--primary);border-radius:8px;padding:12px 14px;font-size:13px;line-height:1.55}.timeline-meta{color:var(--muted);font-size:12px;margin-top:4px}
        .attachment{display:block;border:1px solid var(--border);border-radius:6px;padding:10px;margin-bottom:10px;text-decoration:none;color:var(--primary);font-size:13px;font-weight:700;background:#fff}.attachment img{display:block;width:100%;max-height:240px;object-fit:cover;border-radius:6px;margin-top:8px}
        .form-label{display:block;font-size:12px;font-weight:800;margin-bottom:6px}.form-select,.form-textarea{width:100%;border:1px solid var(--border);border-radius:6px;background:#fff;padding:10px 12px;font-size:13px;margin-bottom:12px}.form-textarea{min-height:100px;resize:vertical}
        .btn{min-height:38px;border:0;border-radius:6px;background:var(--primary);color:#fff;padding:0 12px;font-weight:800;cursor:pointer}.btn-link{display:inline-flex;align-items:center;min-height:38px;border:1px solid var(--border);border-radius:6px;padding:0 12px;text-decoration:none;color:var(--dark);background:#fff;font-size:13px;font-weight:800}
        .logout-modal{position:fixed;inset:0;z-index:10000;background:rgba(15,23,42,.45);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s ease;padding:16px}
        .logout-modal.is-open{opacity:1;pointer-events:auto}
        .logout-modal-content{background:#fff;border:1px solid rgba(226,232,240,.9);border-radius:16px;padding:24px;width:100%;max-width:420px;box-shadow:0 24px 70px rgba(15,23,42,.18);transform:scale(.95);transition:transform .2s ease;text-align:center}
        .logout-modal.is-open .logout-modal-content{transform:scale(1)}
        .logout-modal-content h3{font-size:18px;font-weight:800;color:var(--text);margin-bottom:10px}
        .logout-modal-content p{font-size:14px;color:var(--muted);line-height:1.55;margin-bottom:24px}
        .logout-modal-actions{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .btn-modal-cancel{min-height:44px;border:1px solid var(--border);border-radius:8px;background:#f8fafc;color:var(--text);font-size:13.5px;font-weight:800;cursor:pointer}
        .btn-modal-confirm{min-height:44px;border:0;border-radius:8px;background:var(--danger);color:#fff;font-size:13.5px;font-weight:800;cursor:pointer;box-shadow:0 8px 16px rgba(220,38,38,.2)}
        @media(max-width:1180px){.grid{grid-template-columns:1fr}.container{max-width:980px}}
        @media(max-width:820px){.navbar{padding:12px 16px;align-items:flex-start;flex-direction:column}.navbar-user{width:100%;justify-content:space-between;flex-wrap:wrap}.user-info{text-align:left}.container{padding:0 16px 32px}.hero{padding:18px}h1{font-size:24px}}
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">Sistem Informasi Pengaduan Mahasiswa</a>
        <div class="navbar-user">
            <a href="{{ route('admin.dashboard') }}" class="btn-nav">Kembali ke Dashboard</a>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->nama }}</div>
                <div class="user-role">Administrator ({{ Auth::user()->nim_nip }})</div>
            </div>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
            <button type="button" class="btn-nav danger" id="btnTriggerLogout">Logout</button>
        </div>
    </nav>
    <main class="container">
        <section class="hero">
            <h1>{{ $pengaduan->judul }}</h1>
            <div class="meta">
                <span>Tiket: <strong>{{ $pengaduan->ticket_number ?? 'Belum tersedia' }}</strong></span>
                <span class="badge badge-{{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                <span>Prioritas: <strong>{{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}</strong></span>
                <span>Pelapor: {{ $pengaduan->user->nama }} ({{ $pengaduan->user->nim_nip }})</span>
                <span>Kategori: {{ $pengaduan->kategori->nama_kategori }}</span>
                <span>Dibuat: {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                @if($pengaduan->due_at)<span>SLA: {{ $pengaduan->due_at->format('d M Y, H:i') }}</span>@endif
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Pelapor</div>
                    <div class="info-value">{{ $pengaduan->user->nama }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">NIM/NIP</div>
                    <div class="info-value">{{ $pengaduan->user->nim_nip }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kategori</div>
                    <div class="info-value">{{ $pengaduan->kategori->nama_kategori }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status</div>
                    <div class="info-value">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Prioritas</div>
                    <div class="info-value">{{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}</div>
                </div>
            </div>
        </section>

        <div class="grid">
            <section>
                <article class="card">
                    <div class="section-title">Isi Laporan</div>
                    <div class="body-text">{{ $pengaduan->isi_pengaduan }}</div>
                </article>
                <article class="card">
                    <div class="section-title">Lampiran</div>
                    @forelse($pengaduan->lampiran as $file)
                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment">
                            {{ $file->nama_file }} <span style="color:var(--muted)">({{ $file->tipe_file }})</span>
                            @if(Str::startsWith($file->tipe_file, 'image/'))<img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}">@endif
                        </a>
                    @empty
                        <p style="color:var(--muted);font-size:13px">Tidak ada lampiran.</p>
                    @endforelse
                </article>
                <article class="card">
                    <div class="section-title">Audit Aktivitas</div>
                    <div class="timeline">
                        @forelse($pengaduan->activities as $activity)
                            <div class="timeline-item">
                                <strong>{{ str_replace('_', ' ', $activity->action) }}</strong>
                                <div>{{ $activity->description }}</div>
                                <div class="timeline-meta">{{ $activity->user?->nama ?? 'Sistem' }} - {{ $activity->created_at->format('d M Y, H:i') }}</div>
                                @if($activity->ip_address || $activity->before_data || $activity->after_data)
                                    <div class="timeline-meta">
                                        IP: {{ $activity->ip_address ?? '-' }}
                                        @if($activity->before_data)
                                            | Sebelum: {{ json_encode($activity->before_data, JSON_UNESCAPED_UNICODE) }}
                                        @endif
                                        @if($activity->after_data)
                                            | Sesudah: {{ json_encode($activity->after_data, JSON_UNESCAPED_UNICODE) }}
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p style="color:var(--muted);font-size:13px">Belum ada aktivitas.</p>
                        @endforelse
                    </div>
                </article>
            </section>
            <aside>
                @if(Auth::user()->role !== 'pimpinan')
                    <article class="card">
                        <div class="section-title">Update Status</div>
                        <form action="{{ route('admin.pengaduan.status.update', $pengaduan->id_pengaduan) }}" method="POST">
                            @csrf
                            <label class="form-label" for="status">Status Baru</label>
                            <select name="status" id="status" class="form-select" required>
                                @foreach($statusLabels as $status => $label)
                                    <option value="{{ $status }}" {{ $pengaduan->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <label class="form-label" for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-textarea"></textarea>
                            <button type="submit" class="btn">Update Status</button>
                        </form>
                    </article>
                    <article class="card">
                        <div class="section-title">Kirim Tanggapan</div>
                        <form action="{{ route('admin.pengaduan.tanggapan.store', $pengaduan->id_pengaduan) }}" method="POST">
                            @csrf
                            <label class="form-label" for="isi_tanggapan">Pesan</label>
                            <textarea name="isi_tanggapan" id="isi_tanggapan" class="form-textarea" required></textarea>
                            <button type="submit" class="btn">Kirim Tanggapan</button>
                        </form>
                    </article>
                    <article class="card">
                        <div class="section-title">Komentar Lanjutan</div>
                        <div class="timeline" style="margin-bottom:12px;">
                            @forelse($pengaduan->comments as $comment)
                                <div class="timeline-item">
                                    <strong>{{ $comment->user->nama }}</strong>
                                    <div>{{ $comment->message }}</div>
                                    <div class="timeline-meta">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            @empty
                                <p style="color:var(--muted);font-size:13px">Belum ada komentar lanjutan.</p>
                            @endforelse
                        </div>
                        <form action="{{ route('admin.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST">
                            @csrf
                            <label class="form-label" for="message">Komentar</label>
                            <textarea name="message" id="message" class="form-textarea" required placeholder="Tambahkan catatan lanjutan untuk mahasiswa..."></textarea>
                            <button type="submit" class="btn">Kirim Komentar</button>
                        </form>
                    </article>
                @endif
                <article class="card">
                    <div class="section-title">Riwayat Status</div>
                    <div class="timeline">
                        @foreach($pengaduan->statusLogs as $log)
                            <div class="timeline-item">
                                <div>{{ $log->status_lama ?: 'awal' }} menjadi <strong>{{ $log->status_baru }}</strong></div>
                                @if($log->catatan)<div>{{ $log->catatan }}</div>@endif
                                <div class="timeline-meta">{{ $log->creator->nama }} - {{ $log->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @endforeach
                    </div>
                </article>
                <article class="card">
                    <div class="section-title">Tanggapan</div>
                    <div class="timeline">
                        @forelse($pengaduan->tanggapan as $reply)
                            <div class="timeline-item">
                                <strong>{{ $reply->admin->nama }}</strong>
                                <div>{{ $reply->isi_tanggapan }}</div>
                                <div class="timeline-meta">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p style="color:var(--muted);font-size:13px">Belum ada tanggapan.</p>
                        @endforelse
                    </div>
                </article>
            </aside>
        </div>
    </main>
    <script>
        (() => {
            const btnTrigger = document.getElementById('btnTriggerLogout');
            const modal = document.getElementById('logoutModal');
            const btnCancel = document.getElementById('btnCancelLogout');
            const btnConfirm = document.getElementById('btnConfirmLogout');
            const form = document.getElementById('logoutForm');

            btnTrigger?.addEventListener('click', () => modal?.classList.add('is-open'));
            btnCancel?.addEventListener('click', () => modal?.classList.remove('is-open'));
            modal?.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.remove('is-open');
                }
            });
            btnConfirm?.addEventListener('click', () => form?.submit());
        })();
    </script>
    <div class="logout-modal" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="logout-modal-content">
            <h3 id="modalTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari Panel Administrasi SIPMA?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelLogout">Batal</button>
                <button type="button" class="btn-modal-confirm" id="btnConfirmLogout">Keluar</button>
            </div>
        </div>
    </div>
    @include('partials.toast')
</body>
</html>
