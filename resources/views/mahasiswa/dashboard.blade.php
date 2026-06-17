<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Sistem Informasi Pengaduan Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1d4ed8;
            --primary-dark: #1e3a8a;
            --primary-soft: #dbeafe;
            --accent: #0f766e;
            --accent-soft: #ccfbf1;
            --bg: #f5f7fb;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
            --pending: #d97706;
            --proses: #2563eb;
            --selesai: #16a34a;
            --ditolak: #dc2626;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 12% 0%, rgba(29, 78, 216, 0.12), transparent 28%),
                radial-gradient(circle at 92% 10%, rgba(15, 118, 110, 0.1), transparent 24%),
                var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 20;
            background: rgba(255, 255, 255, 0.92);
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            backdrop-filter: blur(18px);
        }

        .navbar-inner {
            max-width: 1240px;
            margin: 0 auto;
            min-height: 68px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text);
            text-decoration: none;
            min-width: 0;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .brand strong {
            display: block;
            font-size: 16px;
            line-height: 1.2;
        }

        .brand span {
            display: block;
            margin-top: 2px;
            color: var(--muted);
            font-size: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 0 0 auto;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 13px;
            font-weight: 800;
        }

        .user-role {
            margin-top: 2px;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-logout {
            min-height: 36px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fff7f7;
            color: #b91c1c;
            padding: 0 12px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #fee2e2;
        }

        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 26px 24px 44px;
        }

        .dashboard-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 24px;
            align-items: end;
            margin-bottom: 18px;
        }

        .hero-copy {
            min-width: 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 30px;
            padding: 0 11px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.14);
        }

        .dashboard-hero h1 {
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.08;
            letter-spacing: 0;
            margin-bottom: 8px;
        }

        .dashboard-hero p {
            max-width: 680px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
        }

        .quick-note {
            width: 280px;
            border-radius: 8px;
            padding: 14px;
            background: #ffffff;
            border: 1px solid var(--border);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .quick-note strong {
            display: block;
            color: var(--text);
            font-size: 13px;
            margin-bottom: 4px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat-card {
            position: relative;
            min-height: 112px;
            border-radius: 8px;
            padding: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 88px;
            height: 88px;
            right: -36px;
            bottom: -40px;
            border-radius: 50%;
            background: var(--primary-soft);
        }

        .stat-label {
            position: relative;
            z-index: 1;
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 10px;
        }

        .stat-value {
            position: relative;
            z-index: 1;
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
        }

        .stat-hint {
            position: relative;
            z-index: 1;
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-card.total .stat-value { color: var(--primary); }
        .stat-card.pending .stat-value { color: var(--pending); }
        .stat-card.proses .stat-value { color: var(--proses); }
        .stat-card.selesai .stat-value { color: var(--selesai); }
        .stat-card.pending::after { background: #fef3c7; }
        .stat-card.proses::after { background: #dbeafe; }
        .stat-card.selesai::after { background: #dcfce7; }

        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            line-height: 1.45;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .main-grid {
            display: grid;
            grid-template-columns: minmax(320px, 0.84fr) minmax(0, 1.5fr);
            gap: 18px;
            align-items: start;
        }

        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .section-head {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, #ffffff, #f8fafc);
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 800;
        }

        .section-title-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-soft);
            color: var(--primary-dark);
        }

        .section-subtitle {
            color: var(--muted);
            font-size: 12.5px;
            line-height: 1.45;
            margin-top: 6px;
        }

        .section-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 7px;
        }

        .form-select,
        .form-input,
        .form-textarea {
            width: 100%;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 11px 12px;
            font-size: 13.5px;
            color: var(--text);
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-select:focus,
        .form-input:focus,
        .form-textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.14);
        }

        .form-textarea {
            min-height: 128px;
            resize: vertical;
        }

        .file-info-label {
            margin-top: 6px;
            color: var(--muted);
            font-size: 11.5px;
            line-height: 1.45;
        }

        .btn-primary {
            width: 100%;
            min-height: 46px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(37, 99, 235, 0.22);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .complaint-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        .toolbar-caption {
            color: var(--muted);
            font-size: 12.5px;
        }

        .complaint-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .complaint-item {
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #ffffff;
            padding: 16px;
            cursor: pointer;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
        }

        .complaint-item:hover {
            border-color: #bfdbfe;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
            transform: translateY(-1px);
        }

        .complaint-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .complaint-title {
            min-width: 0;
            color: var(--text);
            font-size: 15px;
            font-weight: 800;
            line-height: 1.35;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            min-height: 24px;
            padding: 0 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
            border: 1px solid transparent;
            flex: 0 0 auto;
        }

        .badge-pending { background: #fef3c7; color: #92400e; border-color: #fde68a; }
        .badge-proses { background: #dbeafe; color: #1d4ed8; border-color: #bfdbfe; }
        .badge-selesai { background: #dcfce7; color: #166534; border-color: #bbf7d0; }
        .badge-ditolak { background: #fee2e2; color: #991b1b; border-color: #fecaca; }

        .complaint-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 12px;
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 10px;
        }

        .complaint-body {
            color: #334155;
            font-size: 13.5px;
            line-height: 1.55;
        }

        .complaint-details {
            display: none;
            border-top: 1px solid var(--border);
            margin-top: 16px;
            padding-top: 16px;
            cursor: default;
        }

        .complaint-item.active .complaint-details {
            display: block;
        }

        .detail-section {
            margin-bottom: 16px;
        }

        .detail-title {
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.45px;
            margin-bottom: 7px;
        }

        .detail-body {
            white-space: pre-wrap;
            color: #1f2937;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px;
            font-size: 13px;
            line-height: 1.55;
        }

        .attachments-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .attachment-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffffff;
            border: 1px solid var(--border);
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 12px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        .attachment-link:hover {
            background: #eff6ff;
        }

        .timeline {
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-left: 2px solid var(--border);
            padding-left: 16px;
            margin-left: 5px;
        }

        .timeline-item {
            position: relative;
            color: #475569;
            font-size: 12.5px;
            line-height: 1.45;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            left: -21px;
            top: 4px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
        }

        .timeline-meta {
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .reply-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            color: #334155;
            font-size: 13px;
            line-height: 1.55;
        }

        .reply-header {
            color: var(--primary-dark);
            font-size: 11.5px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .empty-state {
            display: grid;
            place-items: center;
            min-height: 250px;
            color: var(--muted);
            text-align: center;
            font-size: 13.5px;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            background: #f8fafc;
            padding: 28px;
        }

        @media (max-width: 980px) {
            .dashboard-hero {
                grid-template-columns: 1fr;
            }

            .quick-note {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            html,
            body {
                width: 100%;
                max-width: 100vw;
                overflow-x: hidden;
            }

            .navbar-inner {
                padding: 12px 16px;
                align-items: center;
                max-width: 100%;
                min-width: 0;
            }

            .btn-logout {
                min-height: 34px;
                padding: 0 10px;
                font-size: 11.5px;
            }

            .brand {
                min-width: 0;
            }

            .brand > span {
                min-width: 0;
            }

            .brand span span,
            .user-info {
                display: none;
            }

            .navbar-user {
                display: none;
            }

            .user-name {
                max-width: 120px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .container {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 20px 16px 32px;
                max-width: 100vw;
                overflow-x: hidden;
            }

            .dashboard-hero,
            .quick-note,
            .stats-grid,
            .main-grid,
            .section-card {
                width: min(100%, 300px);
                max-width: 300px;
                min-width: 0;
            }

            .quick-note,
            .dashboard-hero p,
            .complaint-body,
            .section-subtitle {
                overflow-wrap: anywhere;
            }

            .dashboard-hero h1 {
                font-size: 26px;
                max-width: 270px;
                overflow-wrap: normal;
                word-break: normal;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .section-head,
            .section-body {
                padding: 16px;
            }

            .complaint-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="#" class="brand">
                <span class="brand-mark">SP</span>
                <span>
                    <strong>SIPMA</strong>
                    <span>Sistem Informasi Pengaduan Mahasiswa</span>
                </span>
            </a>

            <div class="navbar-user">
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->nama }}</div>
                    <div class="user-role">Mahasiswa - {{ Auth::user()->nim_nip }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">
        <section class="dashboard-hero">
            <div class="hero-copy">
                <div class="eyebrow">Dashboard mahasiswa</div>
                <h1>Kelola pengaduan kampus Anda dalam satu tempat.</h1>
                <p>Ajukan laporan baru, pantau status tindak lanjut, dan lihat tanggapan admin secara terstruktur.</p>
            </div>
            <aside class="quick-note">
                <strong>Tips pengaduan</strong>
                Sertakan kronologi, lokasi, tanggal kejadian, dan lampiran pendukung agar laporan lebih mudah diproses.
            </aside>
        </section>

        <section class="stats-grid" aria-label="Ringkasan pengaduan">
            <div class="stat-card total">
                <div class="stat-label">Total Laporan</div>
                <div class="stat-value">{{ $pengaduans->count() }}</div>
                <div class="stat-hint">Semua laporan Anda</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-label">Pending</div>
                <div class="stat-value">{{ $pengaduans->where('status', 'pending')->count() }}</div>
                <div class="stat-hint">Menunggu verifikasi</div>
            </div>
            <div class="stat-card proses">
                <div class="stat-label">Proses</div>
                <div class="stat-value">{{ $pengaduans->where('status', 'proses')->count() }}</div>
                <div class="stat-hint">Sedang ditindaklanjuti</div>
            </div>
            <div class="stat-card selesai">
                <div class="stat-label">Selesai</div>
                <div class="stat-value">{{ $pengaduans->where('status', 'selesai')->count() }}</div>
                <div class="stat-hint">Sudah diselesaikan</div>
            </div>
        </section>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="padding-left: 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="main-grid">
            <article class="section-card">
                <div class="section-head">
                    <div class="section-title">
                        <span class="section-title-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                                <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        Buat Pengaduan Baru
                    </div>
                    <p class="section-subtitle">Lengkapi data pengaduan dengan jelas agar admin dapat menindaklanjuti lebih cepat.</p>
                </div>

                <div class="section-body">
                    <form action="{{ route('mahasiswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="id_kategori" class="form-label">Kategori Laporan</label>
                            <select name="id_kategori" id="id_kategori" class="form-select" required>
                                <option value="">Pilih kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul" class="form-label">Judul Laporan</label>
                            <input type="text" name="judul" id="judul" class="form-input" placeholder="Contoh: Lampu koridor lantai 2 mati" required value="{{ old('judul') }}">
                        </div>

                        <div class="form-group">
                            <label for="isi_pengaduan" class="form-label">Detail Pengaduan</label>
                            <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-textarea" placeholder="Jelaskan kronologi, lokasi, dan dampaknya secara ringkas..." required>{{ old('isi_pengaduan') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="lampiran" class="form-label">Lampiran <span style="color: var(--muted); font-weight: 600;">Opsional</span></label>
                            <input type="file" name="lampiran[]" id="lampiran" class="form-input" multiple>
                            <div class="file-info-label">Format: PDF, DOCX, JPG, PNG. Maksimal 2 MB per berkas.</div>
                        </div>

                        <button type="submit" class="btn-primary">Kirim Pengaduan</button>
                    </form>
                </div>
            </article>

            <article class="section-card">
                <div class="section-head">
                    <div class="section-title">
                        <span class="section-title-icon" aria-hidden="true">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                                <path d="M4 6h16M4 12h16M4 18h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </span>
                        Riwayat Pengaduan Saya
                    </div>
                    <p class="section-subtitle">Klik kartu laporan untuk melihat detail, lampiran, tanggapan, dan log status.</p>
                </div>

                <div class="section-body">
                    <div class="complaint-toolbar">
                        <div class="toolbar-caption">{{ $pengaduans->count() }} laporan terdaftar</div>
                    </div>

                    @if($pengaduans->isEmpty())
                        <div class="empty-state">
                            Belum ada riwayat pengaduan. Buat laporan pertama Anda melalui formulir di samping.
                        </div>
                    @else
                        <div class="complaint-list">
                            @foreach($pengaduans as $p)
                                <div class="complaint-item" onclick="toggleDetails(this)">
                                    <div class="complaint-header">
                                        <span class="complaint-title">{{ $p->judul }}</span>
                                        <span class="badge badge-{{ $p->status }}">{{ $p->status }}</span>
                                    </div>
                                    <div class="complaint-meta">
                                        <span>Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                        <span>Tanggal: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
                                    </div>
                                    <div class="complaint-body">
                                        {{ Str::limit($p->isi_pengaduan, 180) }}
                                    </div>

                                    <div class="complaint-details" onclick="event.stopPropagation()">
                                        <div class="detail-section">
                                            <div class="detail-title">Isi Laporan</div>
                                            <p class="detail-body">{{ $p->isi_pengaduan }}</p>
                                        </div>

                                        @if($p->lampiran->isNotEmpty())
                                            <div class="detail-section">
                                                <div class="detail-title">Lampiran Berkas ({{ $p->lampiran->count() }})</div>
                                                <div class="attachments-list">
                                                    @foreach($p->lampiran as $file)
                                                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment-link">
                                                            {{ $file->nama_file }}
                                                            <span style="color: var(--muted); font-size: 11px;">({{ $file->tipe_file }})</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if($p->tanggapan->isNotEmpty())
                                            <div class="detail-section">
                                                <div class="detail-title">Tanggapan Admin</div>
                                                <div class="complaint-list" style="gap: 10px;">
                                                    @foreach($p->tanggapan as $reply)
                                                        <div class="reply-box">
                                                            <div class="reply-header">Dijawab oleh: {{ $reply->admin->nama }}</div>
                                                            <div>{{ $reply->isi_tanggapan }}</div>
                                                            <div class="timeline-meta">Pada: {{ $reply->created_at->format('d M Y, H:i') }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if($p->statusLogs->isNotEmpty())
                                            <div class="detail-section">
                                                <div class="detail-title">Log Perubahan Status</div>
                                                <div class="timeline">
                                                    @foreach($p->statusLogs as $log)
                                                        <div class="timeline-item">
                                                            <div>Status berubah dari <strong>{{ $log->status_lama ?: 'null' }}</strong> menjadi <strong>{{ $log->status_baru }}</strong></div>
                                                            @if($log->catatan)
                                                                <div>Catatan: "{{ $log->catatan }}"</div>
                                                            @endif
                                                            <div class="timeline-meta">Oleh: {{ $log->creator->nama }} | {{ $log->created_at->format('d M Y, H:i') }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </article>
        </section>
    </main>

    <script>
        function toggleDetails(element) {
            element.classList.toggle('active');
        }
    </script>
</body>
</html>
