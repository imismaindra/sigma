<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Sistem Informasi Pengaduan Mahasiswa</title>
    <!-- Inter Font (Standard & Clean) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f3f4f6;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-main: #1f2937;
            --text-muted: #4b5563;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --input-border: #d1d5db;
            
            --pending: #d97706;
            --proses: #2563eb;
            --selesai: #16a34a;
            --ditolak: #dc2626;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* Navbar */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 40px;
            background: #1e3a8a; /* Solid Deep Blue */
            color: #ffffff;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: #93c5fd;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s ease;
        }

        .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .dashboard-header {
            margin-bottom: 24px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .dashboard-header h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .dashboard-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card.total { border-left: 4px solid var(--primary); }
        .stat-card.pending { border-left: 4px solid var(--pending); }
        .stat-card.proses { border-left: 4px solid var(--proses); }
        .stat-card.selesai { border-left: 4px solid var(--selesai); }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13.5px;
            margin-bottom: 24px;
            line-height: 1.4;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        /* Main Grid: Form & List */
        .main-grid {
            display: grid;
            grid-template-columns: 1fr 1.6fr;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Section Cards */
        .section-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
            color: var(--text-main);
        }

        /* Forms */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-select, .form-input, .form-textarea {
            width: 100%;
            background: #ffffff;
            border: 1px solid var(--input-border);
            border-radius: 4px;
            padding: 10px 12px;
            font-size: 13.5px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.15s ease-in-out;
        }

        .form-select:focus, .form-input:focus, .form-textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .file-info-label {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 4px;
            line-height: 1.4;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 11px 20px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        /* Complaint Item List */
        .complaint-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .complaint-item {
            background: #f9fafb;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 18px;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .complaint-item:hover {
            background: #ffffff;
            border-color: #cbd5e1;
        }

        .complaint-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 8px;
        }

        .complaint-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-main);
        }

        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid transparent;
        }

        .badge-pending { background: #fef3c7; color: #b45309; border-color: #fde68a; }
        .badge-proses { background: #dbeafe; color: #1d4ed8; border-color: #bfdbfe; }
        .badge-selesai { background: #d1fae5; color: #047857; border-color: #a7f3d0; }
        .badge-ditolak { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }

        .complaint-meta {
            display: flex;
            gap: 12px;
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .complaint-body {
            font-size: 13.5px;
            color: #374151;
            line-height: 1.5;
        }

        /* Collapsible details */
        .complaint-details {
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
            margin-top: 16px;
            display: none;
            cursor: default;
        }

        .complaint-item.active .complaint-details {
            display: block;
        }

        .detail-section {
            margin-bottom: 16px;
        }

        .detail-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        /* Lampiran files */
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
            border: 1px solid var(--border-color);
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .attachment-link:hover {
            background: #f3f4f6;
            text-decoration: underline;
        }

        /* Logs and replies */
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-left: 2px solid var(--border-color);
            padding-left: 15px;
            margin-left: 5px;
        }

        .timeline-item {
            position: relative;
            font-size: 12.5px;
            color: #4b5563;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -21px;
            top: 4px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #9ca3af;
        }

        .timeline-item.active::before {
            background: var(--primary);
        }

        .timeline-meta {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .reply-box {
            background: #f9fafb;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px 14px;
            font-size: 13px;
            line-height: 1.5;
        }

        .reply-header {
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 4px;
            font-size: 11.5px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">Sistem Informasi Pengaduan Mahasiswa</a>
        <div class="navbar-user">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->nama }}</div>
                <div class="user-role">Mahasiswa ({{ Auth::user()->nim_nip }})</div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Dashboard Pengaduan</h1>
            <p>Selamat datang di platform penampung aspirasi, pelaporan sarana, keluhan, dan kritik mahasiswa.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-value">{{ $pengaduans->count() }}</div>
                <div class="stat-label">Total Laporan</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-value" style="color: var(--pending);">{{ $pengaduans->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card proses">
                <div class="stat-value" style="color: var(--proses);">{{ $pengaduans->where('status', 'proses')->count() }}</div>
                <div class="stat-label">Proses</div>
            </div>
            <div class="stat-card selesai">
                <div class="stat-value" style="color: var(--selesai);">{{ $pengaduans->where('status', 'selesai')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- Notification Alerts -->
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

        <!-- Main Grid Layout -->
        <div class="main-grid">
            <!-- Left: Form Kirim Pengaduan -->
            <div class="section-card">
                <div class="section-title">Buat Pengaduan Baru</div>
                
                <form action="{{ route('mahasiswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="id_kategori" class="form-label">Kategori Laporan</label>
                        <select name="id_kategori" id="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul" class="form-label">Judul Laporan</label>
                        <input type="text" name="judul" id="judul" class="form-input" placeholder="Masukkan judul laporan" required value="{{ old('judul') }}">
                    </div>

                    <div class="form-group">
                        <label for="isi_pengaduan" class="form-label">Detail Pengaduan</label>
                        <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-textarea" placeholder="Jelaskan detail pengaduan secara terperinci..." required>{{ old('isi_pengaduan') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="lampiran" class="form-label">Lampiran Dokumen/Gambar (Opsional)</label>
                        <input type="file" name="lampiran[]" id="lampiran" class="form-input" multiple>
                        <div class="file-info-label">
                            Format: PDF, DOCX, JPG, PNG. Maksimal 2 MB per berkas.
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">Kirim Pengaduan</button>
                </form>
            </div>

            <!-- Right: List Pengaduan -->
            <div class="section-card">
                <div class="section-title">Riwayat Pengaduan Saya</div>

                @if($pengaduans->isEmpty())
                    <div style="text-align: center; color: var(--text-muted); padding: 40px 0; font-size: 13.5px;">
                        Belum ada riwayat pengaduan yang diajukan.
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

                                <!-- Detail Dropdown -->
                                <div class="complaint-details" onclick="event.stopPropagation()">
                                    <div class="detail-section">
                                        <div class="detail-title">Isi Laporan</div>
                                        <p style="white-space: pre-wrap; font-size: 13.5px; line-height: 1.5; color: #1f2937; background: #f3f4f6; padding: 12px; border-radius: 4px; border: 1px solid var(--border-color);">{{ $p->isi_pengaduan }}</p>
                                    </div>

                                    @if($p->lampiran->isNotEmpty())
                                        <div class="detail-section">
                                            <div class="detail-title">Lampiran Berkas ({{ $p->lampiran->count() }})</div>
                                            <div class="attachments-list">
                                                @foreach($p->lampiran as $file)
                                                    <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment-link">
                                                        📁 {{ $file->nama_file }} 
                                                        <span style="color: var(--text-muted); font-size: 11px;">({{ $file->tipe_file }})</span>
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
                                                        <div class="timeline-meta" style="margin-top: 4px;">Pada: {{ $reply->created_at->format('d M Y, H:i') }}</div>
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
                                                            <div style="color: #4b5563; margin-top: 2px;">Catatan: "{{ $log->catatan }}"</div>
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
        </div>
    </div>

    <script>
        function toggleDetails(element) {
            element.classList.toggle('active');
        }
    </script>
</body>
</html>
