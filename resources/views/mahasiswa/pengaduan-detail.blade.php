@extends('layouts.mahasiswa')

@section('title', 'Detail Pengaduan')
@section('page_title', 'Detail Pengaduan')
@section('page_subtitle', $pengaduan->ticket_number ?? 'Pantau detail dan progress laporan.')

@section('styles')
    .detail-shell {
        display: grid;
        gap: 18px;
    }

    .detail-hero {
        border: 1px solid var(--glass-border);
        border-radius: 30px;
        padding: 24px;
        background:
            radial-gradient(circle at 16% 0%, color-mix(in srgb, var(--stock-blue) 34%, transparent), transparent 34%),
            radial-gradient(circle at 86% 10%, color-mix(in srgb, var(--stock-green) 20%, transparent), transparent 28%),
            linear-gradient(145deg, rgba(255,255,255,.12), transparent 42%),
            var(--glass-bg);
        backdrop-filter: blur(24px);
        box-shadow: 0 26px 76px rgba(0, 0, 0, .22);
        color: var(--text);
    }

    .detail-nav {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .detail-kicker {
        display: inline-flex;
        min-height: 32px;
        align-items: center;
        border-radius: 999px;
        padding: 0 12px;
        background: var(--primary-soft);
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 900;
    }

    .detail-title {
        font-size: clamp(31px, 5vw, 54px);
        line-height: 1.02;
        letter-spacing: -.05em;
        font-weight: 650;
        margin-bottom: 13px;
    }

    .detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 14px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .market-badge {
        min-height: 28px;
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 0 10px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .market-badge.pending,
    .market-badge.menunggu_klarifikasi,
    .market-badge.menunggu_verifikasi_mahasiswa {
        background: rgba(251, 191, 36, .16);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, .28);
    }

    .market-badge.proses,
    .market-badge.ditindaklanjuti {
        background: rgba(109, 199, 255, .16);
        color: var(--stock-blue);
        border: 1px solid rgba(109, 199, 255, .28);
    }

    .market-badge.selesai {
        background: rgba(51, 214, 159, .16);
        color: var(--stock-green);
        border: 1px solid rgba(51, 214, 159, .28);
    }

    .market-badge.ditolak {
        background: rgba(255, 107, 122, .16);
        color: var(--stock-red);
        border: 1px solid rgba(255, 107, 122, .28);
    }

    .progress-card {
        margin-top: 22px;
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 18px;
        background: var(--glass-bg-strong);
        backdrop-filter: blur(20px);
    }

    .progress-head {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 900;
        color: var(--text);
    }

    .section-subtitle {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
        margin-top: 5px;
    }

    .progress-track {
        position: relative;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        margin-top: 12px;
    }

    .progress-line {
        position: absolute;
        top: 16px;
        left: 10%;
        right: 10%;
        height: 4px;
        border-radius: 999px;
        background: color-mix(in srgb, var(--muted) 22%, transparent);
    }

    .progress-line-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        width: {{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%;
    }

    .progress-step {
        position: relative;
        display: grid;
        gap: 8px;
        justify-items: center;
        text-align: center;
        color: var(--muted);
        font-size: 11px;
        font-weight: 900;
    }

    .progress-dot {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        border: 2px solid color-mix(in srgb, var(--muted) 36%, transparent);
        background: var(--glass-bg-strong);
        color: var(--muted);
        z-index: 1;
        box-shadow: 0 0 0 5px color-mix(in srgb, var(--glass-bg) 86%, transparent);
    }

    .progress-check {
        width: 18px;
        height: 18px;
        display: none;
    }

    .progress-step.done,
    .progress-step.active {
        color: var(--stock-green);
    }

    .progress-step.done .progress-dot,
    .progress-step.active .progress-dot {
        border-color: var(--stock-green);
        background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        color: #03111f;
        box-shadow: 0 12px 24px color-mix(in srgb, var(--stock-green) 24%, transparent), 0 0 0 5px color-mix(in srgb, var(--glass-bg) 86%, transparent);
    }

    .progress-step.done .progress-check,
    .progress-step.active .progress-check {
        display: block;
    }

    .progress-step.done .progress-number,
    .progress-step.active .progress-number {
        display: none;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(320px, .75fr);
        gap: 18px;
        align-items: start;
    }

    .detail-card {
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 18px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.1), transparent 44%),
            var(--glass-bg);
        backdrop-filter: blur(22px);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .18);
        margin-bottom: 18px;
    }

    .body-text {
        white-space: pre-wrap;
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 15px;
        background: var(--glass-bg-strong);
    }

    .attachments,
    .activity-feed {
        display: grid;
        gap: 10px;
    }

    .attachment,
    .feed-item {
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 13px;
        background: var(--glass-bg-strong);
        color: var(--text);
        text-decoration: none;
        font-size: 13px;
        line-height: 1.55;
    }

    .attachment img {
        display: block;
        width: 100%;
        max-height: 240px;
        object-fit: cover;
        border-radius: 14px;
        margin-top: 10px;
        border: 1px solid var(--glass-border);
    }

    .feed-meta {
        color: var(--muted);
        font-size: 12px;
        margin-top: 5px;
    }

    .form-grid {
        display: grid;
        gap: 12px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 6px;
        color: var(--text);
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        background: var(--glass-bg-strong);
        color: var(--text);
        padding: 11px 12px;
        font-size: 13px;
        outline: none;
    }

    .form-input,
    .form-select {
        min-height: 44px;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    @media (max-width: 960px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .detail-hero,
        .detail-card,
        .progress-card {
            border-radius: 22px;
            padding: 16px;
        }

        .detail-nav,
        .progress-head {
            display: grid;
        }

        .progress-track {
            grid-template-columns: 1fr;
            gap: 0;
            margin-top: 16px;
        }

        .progress-line {
            top: 17px;
            bottom: 17px;
            left: 16px;
            right: auto;
            width: 4px;
            height: auto;
        }

        .progress-line-fill {
            width: 100%;
            height: {{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%;
            background: linear-gradient(180deg, var(--stock-blue), var(--stock-green));
        }

        .progress-step {
            grid-template-columns: 34px 1fr;
            justify-items: start;
            text-align: left;
            align-items: center;
            min-height: 50px;
            gap: 12px;
        }

        .progress-dot {
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--glass-bg) 88%, transparent);
        }
    }
@endsection

@section('content')
    <section class="detail-shell">
        <article class="detail-hero">
            <div class="detail-nav">
                <div>
                    <div class="detail-kicker">{{ $pengaduan->kategori->nama_kategori }}</div>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-soft">Kembali ke Riwayat</a>
            </div>

            <h1 class="detail-title">{{ $pengaduan->judul }}</h1>
            <div class="detail-meta">
                <span>Tiket: <strong>{{ $pengaduan->ticket_number ?? 'Belum tersedia' }}</strong></span>
                <span class="market-badge {{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                <span>Prioritas: <strong>{{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}</strong></span>
                <span>Dibuat: {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                @if($pengaduan->due_at)
                    <span>SLA: {{ $pengaduan->due_at->format('d M Y, H:i') }}</span>
                @endif
            </div>

            <div class="progress-card" aria-label="Progress pengaduan">
                <div class="progress-head">
                    <div>
                        <div class="section-title">Progress Pengaduan</div>
                        <p class="section-subtitle">Pantau posisi laporan Anda dari tahap pengajuan sampai penyelesaian.</p>
                    </div>
                    <span class="market-badge {{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                </div>
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
        </article>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger"><ul style="padding-left:16px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <div class="detail-grid">
            <section>
                <article class="detail-card">
                    <div class="section-title">Isi Laporan</div>
                    <div class="body-text">{{ $pengaduan->isi_pengaduan }}</div>
                </article>

                <article class="detail-card">
                    <div class="section-title">Lampiran</div>
                    @if($pengaduan->lampiran->isEmpty())
                        <p class="section-subtitle">Belum ada lampiran.</p>
                    @else
                        <div class="attachments">
                            @foreach($pengaduan->lampiran as $file)
                                <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment">
                                    {{ $file->nama_file }} <span style="color:var(--muted);font-weight:600;">({{ $file->tipe_file }})</span>
                                    @if(Str::startsWith($file->tipe_file, 'image/'))
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </article>

                <article class="detail-card">
                    <div class="section-title">Komentar Lanjutan</div>
                    <div class="activity-feed" style="margin-bottom:14px;">
                        @forelse($pengaduan->comments as $comment)
                            <div class="feed-item">
                                <strong>{{ $comment->user->nama }}</strong>
                                <div>{{ $comment->message }}</div>
                                <div class="feed-meta">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada komentar lanjutan.</p>
                        @endforelse
                    </div>
                    <form action="{{ route('mahasiswa.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                        @csrf
                        <textarea name="message" class="form-textarea" placeholder="Tambahkan informasi lanjutan atau balas komentar admin..." required></textarea>
                        <button type="submit" class="btn-primary">Kirim Komentar</button>
                    </form>
                </article>

                <article class="detail-card">
                    <div class="section-title">Tanggapan Admin</div>
                    <div class="activity-feed">
                        @forelse($pengaduan->tanggapan as $reply)
                            <div class="feed-item">
                                <strong>{{ $reply->admin->nama }}</strong>
                                <div>{{ $reply->isi_tanggapan }}</div>
                                <div class="feed-meta">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada tanggapan admin.</p>
                        @endforelse
                    </div>
                </article>
            </section>

            <aside>
                <article class="detail-card">
                    <div class="section-title">Riwayat Status</div>
                    <div class="activity-feed">
                        @forelse($pengaduan->statusLogs as $log)
                            <div class="feed-item">
                                <div><strong>{{ $log->status_lama ?: 'awal' }}</strong> menjadi <strong>{{ $log->status_baru }}</strong></div>
                                @if($log->catatan)<div>{{ $log->catatan }}</div>@endif
                                <div class="feed-meta">{{ $log->creator->nama }} - {{ $log->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada perubahan status.</p>
                        @endforelse
                    </div>
                </article>

                @if($pengaduan->isEditable())
                    <article class="detail-card">
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
                                <input type="file" id="lampiran" name="lampiran[]" class="form-input" multiple>
                            </div>
                            <button type="submit" class="btn-primary">Simpan Perubahan</button>
                        </form>
                    </article>

                    <article class="detail-card">
                        <div class="section-title">Batalkan Pengaduan</div>
                        <form action="{{ route('mahasiswa.pengaduan.cancel', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                            @csrf
                            <textarea id="cancel_reason" name="cancel_reason" class="form-textarea" placeholder="Alasan pembatalan, opsional"></textarea>
                            <button type="submit" class="btn-danger">Batalkan Pengaduan</button>
                        </form>
                    </article>
                @endif

                @if(in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true) && !$pengaduan->completed_confirmed_at)
                    <article class="detail-card">
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
                    <article class="detail-card">
                        <div class="section-title">Penyelesaian Dikonfirmasi</div>
                        <p class="section-subtitle">Dikonfirmasi pada {{ $pengaduan->completed_confirmed_at->format('d M Y, H:i') }}.</p>
                    </article>
                @endif
            </aside>
        </div>
    </section>
@endsection
