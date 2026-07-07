@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')
@section('page_title', 'Dashboard Mahasiswa')
<<<<<<< HEAD
@section('page_subtitle', 'Ajukan laporan baru, pantau status pengerjaan, dan baca tanggapan resmi admin.')

@section('content')
    <!-- Hero Banner Portal -->
    <section class="page-hero">
        <article class="hero-card bg-gradient-to-tr from-white to-slate-50/50">
            <div class="eyebrow">Portal Layanan SIPMA</div>
            <h1>Kelola pengaduan kampus dengan lebih terarah.</h1>
            <p>Sampaikan kendala akademik, administrasi, fasilitas sarana prasarana, kebersihan, keamanan, dan sistem IT dalam satu dashboard terpadu yang transparan dan mudah dipantau.</p>
        </article>

        <aside class="guide-card panel bg-white/80">
            <div>
                <strong class="flex items-center gap-1.5 text-indigo-650"><i data-lucide="help-circle" class="w-4 h-4"></i> Tips Pengaduan</strong>
                <p>Sertakan kronologi kejadian secara runtut, lokasi fisik yang jelas, tanggal kejadian, dan berkas lampiran pendukung agar laporan Anda dapat langsung divalidasi admin.</p>
            </div>
            <div class="flex gap-2.5 flex-wrap">
                <a href="{{ route('mahasiswa.pengaduan.create') }}" class="btn-primary flex items-center gap-1.5"><i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Laporan</a>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-secondary flex items-center gap-1.5"><i data-lucide="history" class="w-4 h-4"></i> Riwayat</a>
            </div>
        </aside>
    </section>

    <!-- Stats Cards Summary Grid -->
    <section class="stats-grid" aria-label="Ringkasan pengaduan">
        <article class="stat-card border-l-4 border-slate-400 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Total Laporan</div>
                <i data-lucide="folder" class="w-4 h-4 text-slate-400"></i>
            </div>
            <div class="stat-value">{{ $summary['total'] }}</div>
            <div class="stat-hint">Seluruh laporan Anda</div>
        </article>
        
        <article class="stat-card border-l-4 border-amber-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Pending</div>
                <i data-lucide="clock" class="w-4 h-4 text-amber-500"></i>
            </div>
            <div class="stat-value text-amber-650">{{ $summary['pending'] }}</div>
            <div class="stat-hint">Menunggu verifikasi admin</div>
        </article>
        
        <article class="stat-card border-l-4 border-blue-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Proses</div>
                <i data-lucide="refresh-cw" class="w-4 h-4 text-blue-500 animate-spin" style="animation-duration: 8s;"></i>
            </div>
            <div class="stat-value text-blue-600">{{ $summary['proses'] }}</div>
            <div class="stat-hint">Sedang ditindaklanjuti</div>
        </article>
        
        <article class="stat-card border-l-4 border-emerald-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Selesai</div>
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <div class="stat-value text-emerald-650">{{ $summary['selesai'] }}</div>
            <div class="stat-hint">Selesai ditangani</div>
        </article>
    </section>

    <!-- Alerts Messages -->
    @if(session('success'))
        <div class="alert alert-success flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger flex items-center gap-2">
            <i data-lucide="alert-octagon" class="w-4 h-4"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Interactive Filters Form panel -->
    <section class="filter-panel bg-white/80" aria-label="Filter pengaduan">
        <div class="panel-head">
            <div>
                <div class="panel-title flex items-center gap-1.5"><i data-lucide="search" class="w-4 h-4 text-indigo-600"></i> Pencarian & Penyaringan Laporan</div>
                <p class="panel-subtitle">Cari laporan berdasarkan kata kunci, status aduan, prioritas urgensi, dan rentang tanggal.</p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.dashboard') }}" method="GET" class="filter-form">
            <div>
                <label for="q" class="form-label">Kata Kunci</label>
                <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul atau isi pengaduan">
            </div>
            <div>
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="form-label">Prioritas</label>
                <select id="priority" name="priority" class="form-select">
                    <option value="">Semua Prioritas</option>
                    @foreach($priorityLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ (string) request('kategori') === (string) $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tanggal_mulai" class="form-label">Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-input" value="{{ request('tanggal_mulai') }}">
            </div>
            <div>
                <label for="tanggal_selesai" class="form-label">Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-input" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn-primary flex items-center justify-center gap-1.5"><i data-lucide="filter" class="w-4 h-4"></i> Filter</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center justify-center gap-1.5"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Reset</a>
            </div>
        </form>
    </section>

    <!-- Student Notifications List -->
    @if($notifications->isNotEmpty())
        <section class="notification-panel bg-white/80" aria-label="Notifikasi terbaru">
            <div class="panel-head">
                <div>
                    <div class="panel-title flex items-center gap-1.5 text-indigo-650"><i data-lucide="bell" class="w-4.5 h-4.5 animate-bounce" style="animation-duration: 2.5s;"></i> Notifikasi Progres Laporan</div>
                    <p class="panel-subtitle">Terdapat {{ $unreadNotifications }} pemberitahuan yang belum dibaca dari administrator.</p>
                </div>
            </div>
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <a href="{{ $notification->pengaduan ? route('mahasiswa.pengaduan.show', $notification->pengaduan->id_pengaduan) : '#' }}" class="notification-item {{ $notification->read_at ? '' : 'unread' }} flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 {{ $notification->read_at ? 'bg-slate-300' : 'bg-indigo-600' }}"></div>
                        <div class="min-w-0 flex-1">
                            <div class="notification-title">{{ $notification->title }}</div>
                            <div class="notification-message">{{ $notification->message }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Recent Complaints History list -->
    <section>
        <article class="panel bg-white/90">
            <div class="panel-head">
                <div>
                    <div class="panel-title flex items-center gap-1.5"><i data-lucide="clipboard-list" class="w-4.5 h-4.5 text-indigo-600"></i> Riwayat Pengaduan Saya</div>
                    <p class="panel-subtitle">Menampilkan {{ $pengaduans->count() }} laporan terbaru. Gunakan halaman riwayat penuh untuk filter lebih spesifik.</p>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-soft flex items-center gap-1.5"><i data-lucide="list" class="w-4 h-4"></i> Buka Riwayat Lengkap</a>
            </div>

            @if($pengaduans->count() === 0)
                <div class="empty-state">
                    <i data-lucide="info" class="w-10 h-10 text-slate-300 mx-auto mb-2 animate-pulse"></i>
                    Belum ada pengaduan yang cocok dengan filter pencarian saat ini.
                </div>
            @else
                <div class="complaint-list">
                    @foreach($pengaduans as $p)
                        <article class="complaint-card hover:-translate-y-0.5">
                            <div class="complaint-top">
                                <div class="min-w-0">
                                    <h4 class="complaint-title truncate">{{ $p->judul }}</h4>
                                    <div class="complaint-meta mt-1.5">
                                        <span class="flex items-center gap-1"><i data-lucide="hash" class="w-3.5 h-3.5"></i> Tiket: <strong>{{ $p->ticket_number ?? 'PGD' }}</strong></span>
                                        <span class="flex items-center gap-1"><i data-lucide="flag" class="w-3.5 h-3.5"></i> Prioritas: <strong>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</strong></span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-1.5 justify-end">
                                    @if($p->isOverdue())
                                        <span class="sla-badge">Lewat SLA</span>
                                    @endif
                                    <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                </div>
                            </div>
                            <div class="complaint-meta">
                                <span class="flex items-center gap-1"><i data-lucide="tag" class="w-3.5 h-3.5"></i> Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> Dilaporkan: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
                            </div>
                            <p class="complaint-body">{{ Str::limit($p->isi_pengaduan, 180) }}</p>
                            <div class="complaint-actions">
                                <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="btn-soft flex items-center gap-1"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat Detail</a>
                                @if($p->isEditable())
                                    <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}#edit" class="btn-secondary flex items-center gap-1"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit</a>
=======
@section('page_subtitle', 'Pantau pengaduan dan status tindak lanjut Anda.')

@section('styles')
    .dashboard-shell {
        display: grid;
        gap: 18px;
        color: var(--text);
    }

    .balance-card,
    .metric-card,
    .portfolio-panel,
    .case-card,
    .activity-panel,
    .activity-row,
    .connected-mini {
        background: linear-gradient(145deg, var(--glass-highlight), transparent 42%), var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(22px);
        -webkit-backdrop-filter: blur(22px);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .18);
    }

    .balance-card {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: clamp(22px, 4vw, 34px);
        min-height: 312px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 26px;
    }

    .balance-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 22% 0%, rgba(45, 140, 255, .5), transparent 34%),
            radial-gradient(circle at 88% 18%, rgba(51, 214, 159, .26), transparent 30%);
        opacity: .9;
        pointer-events: none;
    }

    .balance-content,
    .balance-actions {
        position: relative;
        z-index: 1;
    }

    .balance-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 900;
    }

    .balance-chip {
        min-height: 32px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 999px;
        padding: 0 12px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .14);
        color: var(--text);
    }

    .balance-dot {
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--stock-green);
        box-shadow: 0 0 18px color-mix(in srgb, var(--stock-green) 70%, transparent);
    }

    .balance-label {
        margin-top: 30px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .balance-value {
        margin-top: 6px;
        font-size: clamp(44px, 8vw, 76px);
        line-height: .95;
        font-weight: 800;
        letter-spacing: -.03em;
        color: var(--text);
    }

    .balance-trend {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 12px;
        color: var(--muted);
        font-size: 13px;
        font-weight: 700;
    }

    .trend-positive {
        color: var(--stock-green);
        font-weight: 900;
    }

    .sparkline-wrap {
        margin-top: 24px;
        height: 90px;
        opacity: .9;
    }

    .sparkline {
        width: 100%;
        height: 100%;
        display: block;
    }

    .sparkline path {
        fill: none;
        stroke: color-mix(in srgb, var(--text) 72%, transparent);
        stroke-width: 3;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .sparkline circle {
        fill: var(--stock-green);
        stroke: var(--text);
        stroke-width: 3;
    }

    .balance-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .quick-action {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 999px;
        padding: 0 15px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, .14);
        background: rgba(3, 17, 31, .28);
        color: var(--text);
        font-size: 12px;
        font-weight: 900;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    }

    .quick-action.primary {
        color: #03111f;
        background: linear-gradient(135deg, #8fd3ff, #35e0a8);
        border-color: transparent;
    }

    .quick-action svg,
    .case-icon svg,
    .activity-status svg {
        width: 18px;
        height: 18px;
    }

    .metric-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }

    .metric-card {
        border-radius: 22px;
        padding: 18px;
        min-width: 0;
    }

    .metric-label {
        color: var(--muted);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .metric-value {
        margin-top: 10px;
        font-size: 34px;
        line-height: 1;
        font-weight: 900;
        color: var(--text);
    }

    .metric-hint {
        margin-top: 8px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 700;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(310px, .8fr);
        gap: 18px;
        align-items: start;
    }

    .portfolio-panel,
    .activity-panel {
        border-radius: 26px;
        padding: 20px;
        min-width: 0;
    }

    .section-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 900;
        color: var(--text);
    }

    .section-subtitle {
        margin-top: 4px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.45;
    }

    .section-link {
        color: var(--stock-blue);
        text-decoration: none;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .case-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .case-card {
        border-radius: 20px;
        padding: 16px;
        min-width: 0;
        text-decoration: none;
        transition: transform .18s ease, border-color .18s ease;
    }

    .case-card:hover {
        transform: translateY(-2px);
        border-color: color-mix(in srgb, var(--stock-blue) 45%, var(--glass-border));
    }

    .case-top {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .case-icon {
        width: 44px;
        height: 44px;
        flex: 0 0 auto;
        border-radius: 16px;
        display: grid;
        place-items: center;
        color: #03111f;
        background: linear-gradient(135deg, #8fd3ff, #35e0a8);
        box-shadow: 0 14px 28px rgba(51, 214, 159, .2);
    }

    .case-title {
        color: var(--text);
        font-size: 15px;
        font-weight: 900;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .case-code {
        margin-top: 3px;
        color: var(--muted);
        font-size: 11px;
        font-weight: 800;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .case-meta {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 18px;
        color: var(--muted);
        font-size: 12px;
        font-weight: 800;
    }

    .case-meta strong {
        color: var(--text);
    }

    .case-progress {
        margin-top: 12px;
        height: 7px;
        border-radius: 999px;
        overflow: hidden;
        background: rgba(148, 163, 184, .22);
    }

    .case-progress span {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, var(--stock-blue), var(--stock-green));
    }

    .activity-list {
        display: grid;
        gap: 10px;
    }

    .activity-row {
        border-radius: 18px;
        padding: 13px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 12px;
        align-items: center;
        text-decoration: none;
    }

    .activity-title {
        color: var(--text);
        font-size: 14px;
        font-weight: 900;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .activity-meta {
        margin-top: 4px;
        color: var(--muted);
        font-size: 11px;
        font-weight: 800;
    }

    .activity-status {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        color: #ffffff;
        background: var(--stock-green);
        box-shadow: 0 10px 24px color-mix(in srgb, var(--stock-green) 28%, transparent);
    }

    .activity-status.warn {
        background: var(--stock-red);
        box-shadow: 0 10px 24px color-mix(in srgb, var(--stock-red) 25%, transparent);
    }

    .connected-mini {
        margin-top: 14px;
        border-radius: 22px;
        padding: 22px;
        text-align: center;
    }

    .connected-ring {
        width: 94px;
        height: 94px;
        margin: 0 auto 14px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        color: var(--stock-green);
        border: 8px solid currentColor;
        box-shadow: 0 0 34px color-mix(in srgb, var(--stock-green) 35%, transparent);
    }

    .connected-ring svg {
        width: 46px;
        height: 46px;
    }

    .connected-title {
        color: var(--stock-green);
        font-size: 20px;
        font-weight: 900;
        letter-spacing: .04em;
    }

    .connected-desc {
        margin-top: 7px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .empty-state {
        border-radius: 20px;
        padding: 20px;
        background: var(--glass-bg-strong);
        border: 1px dashed var(--glass-border);
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
    }

    html[data-theme="light"] .quick-action {
        background: rgba(255, 255, 255, .58);
        border-color: rgba(30, 64, 175, .14);
    }

    @media (max-width: 1080px) {
        .metric-grid,
        .dashboard-grid {
            grid-template-columns: 1fr 1fr;
        }

        .activity-panel {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 760px) {
        .dashboard-shell {
            gap: 14px;
        }

        .balance-card {
            min-height: 430px;
            border-radius: 30px;
            padding: 22px;
        }

        .balance-top {
            align-items: flex-start;
        }

        .balance-label {
            margin-top: 28px;
        }

        .balance-value {
            font-size: 48px;
        }

        .sparkline-wrap {
            height: 86px;
        }

        .balance-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .quick-action {
            width: 100%;
            min-height: 44px;
        }

        .metric-grid,
        .dashboard-grid,
        .case-grid {
            grid-template-columns: 1fr;
        }

        .metric-card {
            border-radius: 20px;
            padding: 16px;
        }

        .metric-value {
            font-size: 30px;
        }

        .portfolio-panel,
        .activity-panel {
            border-radius: 24px;
            padding: 16px;
        }

        .section-head {
            align-items: flex-start;
        }

        .case-card {
            border-radius: 20px;
        }
    }
@endsection

@section('content')
    @php
        $complaints = $pengaduans->getCollection();
        $activeComplaints = $complaints->filter(fn ($item) => !in_array($item->status, ['selesai', 'ditolak'], true))->take(4);
        $recentComplaints = $complaints->take(5);
        $activeTotal = ($summary['pending'] ?? 0) + ($summary['proses'] ?? 0);
        $doneTotal = $summary['selesai'] ?? 0;
        $progressMap = [
            'pending' => 20,
            'diproses' => 45,
            'proses' => 45,
            'ditindaklanjuti' => 68,
            'menunggu_konfirmasi' => 82,
            'selesai' => 100,
            'ditolak' => 100,
        ];
    @endphp

    <section class="dashboard-shell">
        <article class="balance-card">
            <div class="balance-content">
                <div class="balance-top">
                    <span class="balance-chip"><span class="balance-dot"></span> SIPMA Live Desk</span>
                    <span>{{ now()->format('d M Y') }}</span>
                </div>

                <div class="balance-label">Total pengaduan Anda</div>
                <div class="balance-value">{{ number_format($summary['total'] ?? 0) }}</div>
                <div class="balance-trend">
                    <span class="trend-positive">+{{ $activeTotal }} aktif</span>
                    <span>{{ $doneTotal }} selesai tersinkron</span>
                </div>

                <div class="sparkline-wrap" aria-hidden="true">
                    <svg class="sparkline" viewBox="0 0 560 120" preserveAspectRatio="none">
                        <path d="M0 76 C36 64 52 84 80 62 C112 38 138 48 166 70 C196 96 230 36 270 54 C312 74 330 34 364 42 C406 52 408 92 442 76 C474 60 492 82 524 54 C542 40 550 46 560 38"></path>
                        <circle cx="442" cy="76" r="6"></circle>
                    </svg>
                </div>
            </div>

            <div class="balance-actions">
                <a href="{{ route('mahasiswa.pengaduan.create') }}" class="quick-action primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Buat Laporan
                </a>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="quick-action">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h10"/></svg>
                    Riwayat
                </a>
                <a href="{{ route('mahasiswa.profile') }}" class="quick-action">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/></svg>
                    Profil
                </a>
            </div>
        </article>

        <div class="metric-grid">
            <div class="metric-card">
                <div class="metric-label">Menunggu</div>
                <div class="metric-value">{{ $summary['pending'] ?? 0 }}</div>
                <div class="metric-hint">Butuh verifikasi admin</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Diproses</div>
                <div class="metric-value">{{ $summary['proses'] ?? 0 }}</div>
                <div class="metric-hint">Sedang ditindaklanjuti</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Selesai</div>
                <div class="metric-value">{{ $summary['selesai'] ?? 0 }}</div>
                <div class="metric-hint">Laporan telah beres</div>
            </div>
            <div class="metric-card">
                <div class="metric-label">Notifikasi</div>
                <div class="metric-value">{{ $unreadNotifications ?? 0 }}</div>
                <div class="metric-hint">Update belum dibaca</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <article class="portfolio-panel">
                <div class="section-head">
                    <div>
                        <div class="section-title">Portofolio Pengaduan</div>
                        <div class="section-subtitle">Laporan aktif yang perlu Anda pantau.</div>
                    </div>
                    <a href="{{ route('mahasiswa.pengaduan.index') }}" class="section-link">Lihat semua</a>
                </div>

                <div class="case-grid">
                    @forelse($activeComplaints as $item)
                        @php
                            $progress = $progressMap[$item->status] ?? 35;
                        @endphp
                        <a href="{{ route('mahasiswa.pengaduan.show', $item->id_pengaduan) }}" class="case-card">
                            <div class="case-top">
                                <div class="case-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                </div>
                                <div style="min-width: 0;">
                                    <div class="case-title">{{ $item->judul }}</div>
                                    <div class="case-code">{{ $item->ticket_number ?? 'Tiket dibuat otomatis' }}</div>
                                </div>
                            </div>
                            <div class="case-meta">
                                <span>{{ $statusLabels[$item->status] ?? $item->status }}</span>
                                <strong>{{ $progress }}%</strong>
                            </div>
                            <div class="case-progress"><span style="width: {{ $progress }}%;"></span></div>
                        </a>
                    @empty
                        <div class="empty-state">
                            Belum ada pengaduan aktif. Buat laporan baru jika ada kendala akademik, fasilitas, atau layanan kampus yang perlu ditindaklanjuti.
                        </div>
                    @endforelse
                </div>
            </article>

            <aside class="activity-panel">
                <div class="section-head">
                    <div>
                        <div class="section-title">Status Terkini</div>
                        <div class="section-subtitle">Update terbaru dari laporan Anda.</div>
                    </div>
                </div>

                <div class="activity-list">
                    @forelse($recentComplaints as $item)
                        @php
                            $isGood = in_array($item->status, ['selesai', 'menunggu_konfirmasi'], true);
                        @endphp
                        <a href="{{ route('mahasiswa.pengaduan.show', $item->id_pengaduan) }}" class="activity-row">
                            <div>
                                <div class="activity-title">{{ $item->judul }}</div>
                                <div class="activity-meta">
                                    {{ $item->kategori->nama_kategori ?? 'Kategori belum tersedia' }} · {{ $item->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="activity-status {{ $isGood ? '' : 'warn' }}">
                                @if($isGood)
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="m5 13 4 4L19 7"/></svg>
                                @else
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 8v5"/><path d="M12 17h.01"/></svg>
>>>>>>> origin/Abiyyu-dev
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="empty-state">
                            Belum ada aktivitas laporan. Semua update dari admin akan muncul di area ini.
                        </div>
                    @endforelse
                </div>
<<<<<<< HEAD
                
                <div class="mt-4">
                    @include('partials.simple-pagination', ['paginator' => $pengaduans])
                </div>
            @endif
        </article>
=======

                <div class="connected-mini">
                    <div class="connected-ring">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><path d="m5 13 4 4L19 7"/></svg>
                    </div>
                    <div class="connected-title">CONNECTED</div>
                    <div class="connected-desc">Akun {{ Auth::user()->nama }} tersambung ke layanan pengaduan SIPMA.</div>
                </div>
            </aside>
        </div>
>>>>>>> origin/Abiyyu-dev
    </section>
@endsection
