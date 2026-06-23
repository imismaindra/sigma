<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sistem Informasi Pengaduan Mahasiswa</title>
    <!-- Inter Font -->
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
            width: 100%;
            max-width: 1500px;
            margin: 30px auto;
            padding: 0 24px;
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

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
        .stat-card.ditolak { border-left: 4px solid var(--ditolak); }

        .filter-card,
        .analytics-card,
        .category-card,
        .activity-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 18px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            align-items: end;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: end;
            justify-content: flex-end;
        }

        .filter-actions .btn-small,
        .filter-actions .btn-secondary-small {
            min-width: 74px;
        }

        .btn-secondary-small,
        .btn-detail {
            min-height: 36px;
            border-radius: 6px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-secondary-small {
            border: 1px solid var(--border-color);
            color: var(--primary);
            background: #ffffff;
        }

        .btn-detail {
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            background: #eff6ff;
            margin-top: 10px;
        }

        .analytics-grid,
        .category-grid,
        .activity-list {
            display: grid;
            gap: 10px;
        }

        .analytics-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        }

        .analytics-item,
        .activity-item {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px;
            background: #f9fafb;
            font-size: 13px;
        }

        .category-row {
            display: grid;
            grid-template-columns: minmax(180px, .9fr) minmax(260px, 1.4fr) minmax(86px, auto) minmax(96px, auto);
            gap: 12px;
            align-items: center;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 14px;
            background: #f9fafb;
        }

        .category-row label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 0 10px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: #ffffff;
            color: var(--text-main);
            font-size: 12px;
            font-weight: 800;
        }

        .category-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .activity-meta {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 4px;
        }

        .sla-badge {
            display: inline-flex;
            align-items: center;
            min-height: 22px;
            padding: 0 8px;
            border-radius: 999px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 11px;
            font-weight: 800;
            margin-left: 8px;
        }

        .simple-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-top: 1px solid var(--border-color);
            padding-top: 14px;
            margin-top: 18px;
        }

        .page-button {
            min-height: 36px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #1e3a8a;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }

        .page-button.disabled {
            color: #94a3b8;
            background: #f8fafc;
            cursor: not-allowed;
        }

        .page-info {
            color: var(--text-muted);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: center;
        }

        .page-info span {
            font-size: 12px;
            font-weight: 600;
        }

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

        /* Section Panel */
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

        /* Complaint Item List */
        .complaint-list {
            display: flex;
            flex-direction: column;
            gap: 0;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            background: #ffffff;
        }

        .complaint-sheet-head {
            display: grid;
            grid-template-columns: minmax(180px, 1.2fr) minmax(120px, .75fr) minmax(160px, 1fr) minmax(120px, .7fr) minmax(135px, .8fr) minmax(120px, .65fr) 120px;
            gap: 12px;
            align-items: center;
            min-height: 42px;
            padding: 0 14px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .complaint-item {
            background: #ffffff;
            border: 0;
            border-bottom: 1px solid var(--border-color);
            border-radius: 0;
            padding: 0;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .complaint-item:last-child {
            border-bottom: 0;
        }

        .complaint-item:hover {
            background: #f8fafc;
        }

        .complaint-header {
            display: grid;
            grid-template-columns: minmax(180px, 1.2fr) minmax(120px, .75fr) minmax(160px, 1fr) minmax(120px, .7fr) minmax(135px, .8fr) minmax(120px, .65fr) 120px;
            align-items: center;
            gap: 12px;
            margin-bottom: 0;
            padding: 14px;
        }

        .complaint-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sheet-cell {
            min-width: 0;
            color: var(--text-main);
            font-size: 13px;
        }

        .sheet-cell-muted {
            color: var(--text-muted);
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .sheet-label {
            display: none;
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 5px;
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
        .badge-menunggu_klarifikasi,
        .badge-menunggu_verifikasi_mahasiswa { background: #ede9fe; color: #6d28d9; border-color: #ddd6fe; }
        .badge-ditindaklanjuti { background: #ccfbf1; color: #0f766e; border-color: #99f6e4; }
        .badge-selesai { background: #d1fae5; color: #047857; border-color: #a7f3d0; }
        .badge-ditolak { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }

        .complaint-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .complaint-meta strong {
            color: var(--text-main);
        }

        .complaint-body {
            font-size: 13.5px;
            color: #374151;
            line-height: 1.5;
        }

        /* Collapsible details */
        .complaint-details {
            border-top: 1px solid var(--border-color);
            padding: 16px;
            margin-top: 0;
            display: none;
            cursor: default;
            background: #ffffff;
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

        /* Actions Grid: Update Status & Tanggapi */
        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }

        @media (max-width: 768px) {
            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 1180px) {
            .complaint-sheet-head {
                display: none;
            }

            .complaint-header {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                align-items: start;
            }

            .sheet-label {
                display: block;
            }

            .btn-detail {
                width: 100%;
                margin-top: 0;
            }
        }

        @media (max-width: 760px) {
            .container {
                padding: 0 14px;
                margin: 18px auto;
            }

            .complaint-header {
                grid-template-columns: 1fr;
            }

            .filter-form,
            .category-row {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                display: grid;
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 12px 16px;
                align-items: flex-start;
                flex-direction: column;
            }

            .navbar-user {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }
        }

        /* Forms inside detail card */
        .form-group {
            margin-bottom: 12px;
        }

        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            min-height: 42px;
            background: #ffffff;
            border: 1px solid var(--input-border);
            border-radius: 8px;
            padding: 0 12px;
            font-size: 13px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.15s ease;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        }

        .form-textarea {
            padding-top: 10px;
            padding-bottom: 10px;
            resize: vertical;
            min-height: 80px;
        }

        .btn-small {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0 14px;
            min-height: 42px;
            font-size: 12.5px;
            font-weight: 800;
            cursor: pointer;
            transition: background 0.15s;
        }

        .category-row .btn-small {
            width: 100%;
        }

        .btn-small:hover {
            background: var(--primary-hover);
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

        /* Success Toast Styles */
        .success-toast {
            position: fixed;
            right: 24px;
            top: 24px;
            z-index: 1000;
            width: min(380px, calc(100vw - 32px));
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 12px;
            align-items: start;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid #bbf7d0;
            background: #ffffff;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.16);
            transform: translateY(-12px);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.24s ease, opacity 0.24s ease;
        }

        .success-toast.is-visible {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-success-icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f0fdf4;
            color: #16a34a;
            font-size: 16px;
            font-weight: 800;
        }

        .toast-success-title {
            display: block;
            color: #166534;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .toast-success-message {
            color: var(--text-muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .toast-success-close {
            width: 26px;
            height: 26px;
            border: 0;
            border-radius: 8px;
            background: #f8fafc;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 17px;
            line-height: 1;
        }

        .toast-success-close:hover {
            background: #eef2f7;
            color: var(--text-main);
        }

        @media (max-width: 640px) {
            .success-toast {
                left: 16px;
                right: 16px;
                top: 16px;
                width: auto;
            }
        }

        /* Logout Modal Styles */
        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
            padding: 16px;
        }

        .logout-modal.is-open {
            opacity: 1;
            pointer-events: auto;
        }

        .logout-modal-content {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 16px;
            padding: 24px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.18);
            transform: scale(0.95);
            transition: transform 0.2s ease;
            text-align: center;
        }

        .logout-modal.is-open .logout-modal-content {
            transform: scale(1);
        }

        .logout-modal-content h3 {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .logout-modal-content p {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.55;
            margin-bottom: 24px;
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-modal-cancel {
            min-height: 44px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: #f8fafc;
            color: var(--text-main);
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-modal-cancel:hover {
            background: #eef2f7;
        }

        .btn-modal-confirm {
            min-height: 44px;
            border: 0;
            border-radius: 8px;
            background: #dc2626;
            color: #ffffff;
            font-size: 13.5px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 16px rgba(220, 38, 38, 0.2);
            transition: background 0.15s, transform 0.15s;
        }

        .btn-modal-confirm:hover {
            background: #b91c1c;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-brand">Sistem Informasi Pengaduan Mahasiswa</a>
        <div class="navbar-user">
            @if(Auth::user()->role !== 'pimpinan')
                <a href="{{ route('admin.users.index') }}" class="btn-logout" style="background:rgba(255,255,255,.14);">Manajemen User</a>
            @endif
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->nama }}</div>
                <div class="user-role">Administrator ({{ Auth::user()->nim_nip }})</div>
            </div>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button type="button" class="btn-logout" id="btnTriggerLogout">Logout</button>
        </div>
    </nav>


    <!-- Main Content -->
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <h1>Panel Administrasi</h1>
            <p>Kelola data pengaduan masuk, lakukan peninjauan lampiran berkas, perbarui status pengaduan, dan kirim tanggapan resmi.</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-value">{{ $allPengaduans->count() }}</div>
                <div class="stat-label">Total Masuk</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-value" style="color: var(--pending);">{{ $allPengaduans->where('status', 'pending')->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-card proses">
                <div class="stat-value" style="color: var(--proses);">{{ $allPengaduans->where('status', 'proses')->count() }}</div>
                <div class="stat-label">Diproses</div>
            </div>
            <div class="stat-card selesai">
                <div class="stat-value" style="color: var(--selesai);">{{ $allPengaduans->where('status', 'selesai')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-card ditolak">
                <div class="stat-value" style="color: var(--ditolak);">{{ $allPengaduans->where('status', 'ditolak')->count() }}</div>
                <div class="stat-label">Ditolak</div>
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

        <div class="filter-card">
            <div class="section-title">Filter Pengaduan</div>
            <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                <div class="form-group" style="margin-bottom:0;">
                    <label for="q" class="form-label">Cari</label>
                    <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul atau isi laporan">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Semua</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="priority" class="form-label">Prioritas</label>
                    <select id="priority" name="priority" class="form-select">
                        <option value="">Semua</option>
                        @foreach($priorityLabels as $key => $label)
                            <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select id="kategori" name="kategori" class="form-select">
                        <option value="">Semua</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ (string) request('kategori') === (string) $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="tanggal_mulai" class="form-label">Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-input" value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="form-group" style="margin-bottom:0;">
                    <label for="tanggal_selesai" class="form-label">Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-input" value="{{ request('tanggal_selesai') }}">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-small">Filter</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn-secondary-small">Reset</a>
                    <a href="{{ route('admin.pengaduan.export', request()->query()) }}" class="btn-secondary-small">Export CSV</a>
                </div>
            </form>
        </div>

        <div class="analytics-card">
            <div class="section-title">Statistik per Kategori</div>
            <div class="analytics-grid">
                @foreach($categoryStats as $categoryName => $count)
                    <div class="analytics-item">
                        <strong>{{ $categoryName }}</strong>
                        <div class="activity-meta">{{ $count }} pengaduan</div>
                    </div>
                @endforeach
            </div>
        </div>

        @if(Auth::user()->role !== 'pimpinan')
            <div class="category-card">
                <div class="section-title">Manajemen Kategori</div>
                <form action="{{ route('admin.kategori.store') }}" method="POST" class="category-row" style="margin-bottom:12px;">
                    @csrf
                    <input type="text" name="nama_kategori" class="form-input" placeholder="Nama kategori baru" required>
                    <input type="text" name="deskripsi" class="form-input" placeholder="Deskripsi kategori">
                    <label><input type="checkbox" name="status_aktif" value="1" checked> Aktif</label>
                    <button type="submit" class="btn-small">Tambah</button>
                </form>
                <div class="category-grid">
                    @foreach($kategoris as $kategori)
                        <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST" class="category-row">
                            @csrf
                            @method('PUT')
                            <input type="text" name="nama_kategori" class="form-input" value="{{ $kategori->nama_kategori }}" required>
                            <input type="text" name="deskripsi" class="form-input" value="{{ $kategori->deskripsi }}">
                            <label><input type="checkbox" name="status_aktif" value="1" {{ $kategori->status_aktif ? 'checked' : '' }}> Aktif</label>
                            <button type="submit" class="btn-small">Simpan</button>
                        </form>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="activity-card">
            <div class="section-title">Riwayat Aktivitas Terbaru</div>
            <div class="activity-list">
                @forelse($activities as $activity)
                    <div class="activity-item">
                        <strong>{{ str_replace('_', ' ', $activity->action) }}</strong>
                        <div>{{ $activity->description }}</div>
                        <div class="activity-meta">
                            {{ $activity->user?->nama ?? 'Sistem' }} - {{ $activity->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                @empty
                    <div class="activity-item">Belum ada aktivitas tercatat.</div>
                @endforelse
            </div>
        </div>

        <!-- Main Panel List -->
        <div class="section-card">
            <div class="section-title">Daftar Pengaduan Masuk</div>

            @if($pengaduans->isEmpty())
                <div style="text-align: center; color: var(--text-muted); padding: 40px 0; font-size: 13.5px;">
                    Belum ada data pengaduan masuk dalam sistem database.
                </div>
            @else
                <div class="complaint-list">
                    <div class="complaint-sheet-head">
                        <div>Judul</div>
                        <div>Tiket</div>
                        <div>Pelapor</div>
                        <div>Kategori</div>
                        <div>Status</div>
                        <div>Prioritas</div>
                        <div>Aksi</div>
                    </div>
                    @foreach($pengaduans as $p)
                        <div class="complaint-item" onclick="toggleDetails(this)">
                            <div class="complaint-header">
                                <div class="sheet-cell">
                                    <span class="sheet-label">Judul</span>
                                    <div class="complaint-title" title="{{ $p->judul }}">{{ $p->judul }}</div>
                                    <div class="sheet-cell-muted">{{ Str::limit($p->isi_pengaduan, 70) }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Tiket</span>
                                    <strong>{{ $p->ticket_number ?? 'Belum tersedia' }}</strong>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Pelapor</span>
                                    <strong>{{ $p->user->nama }}</strong>
                                    <div class="sheet-cell-muted">{{ $p->user->nim_nip }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Kategori</span>
                                    <strong>{{ $p->kategori->nama_kategori }}</strong>
                                    <div class="sheet-cell-muted">{{ $p->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Status</span>
                                    @if($p->isOverdue())
                                        <span class="sla-badge">Lewat SLA</span>
                                    @endif
                                    <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Prioritas</span>
                                    <strong>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</strong>
                                    @if($p->due_at)
                                        <div class="sheet-cell-muted">SLA {{ $p->due_at->format('d M') }}</div>
                                    @endif
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Aksi</span>
                                    <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="btn-detail" onclick="event.stopPropagation()">Detail</a>
                                </div>
                            </div>

                            <!-- Detail Dropdown -->
                            <div class="complaint-details" onclick="event.stopPropagation()">
                                <div class="detail-section">
                                    <div class="detail-title">Detail Laporan</div>
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

                                <!-- Actions Grid -->
                                @if(Auth::user()->role !== 'pimpinan')
                                <div class="actions-grid">
                                    <!-- Aksi 1: Update Status -->
                                    <form action="{{ route('admin.pengaduan.status.update', $p->id_pengaduan) }}" method="POST">
                                        @csrf
                                        <div class="detail-title" style="margin-bottom: 12px; color: var(--text-main);">Update Status Pengaduan</div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="status-{{ $p->id_pengaduan }}">Status Baru</label>
                                            <select name="status" id="status-{{ $p->id_pengaduan }}" class="form-select" required>
                                                @foreach($statusLabels as $status => $label)
                                                    <option value="{{ $status }}" {{ $p->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="catatan-{{ $p->id_pengaduan }}">Catatan Perubahan</label>
                                            <textarea name="catatan" id="catatan-{{ $p->id_pengaduan }}" class="form-textarea" placeholder="Tambahkan catatan..."></textarea>
                                        </div>

                                        <button type="submit" class="btn-small">Update Status</button>
                                    </form>

                                    <!-- Aksi 2: Kirim Tanggapan / Feedback -->
                                    <form action="{{ route('admin.pengaduan.tanggapan.store', $p->id_pengaduan) }}" method="POST">
                                        @csrf
                                        <div class="detail-title" style="margin-bottom: 12px; color: var(--text-main);">Kirim Tanggapan Resmi</div>

                                        <div class="form-group">
                                            <label class="form-label" for="isi_tanggapan-{{ $p->id_pengaduan }}">Pesan Tanggapan</label>
                                            <textarea name="isi_tanggapan" id="isi_tanggapan-{{ $p->id_pengaduan }}" class="form-textarea" required placeholder="Tuliskan tanggapan resmi kepada pelapor..."></textarea>
                                        </div>

                                        <button type="submit" class="btn-small">Kirim Tanggapan</button>
                                    </form>
                                </div>
                                @endif

                                @if($p->tanggapan->isNotEmpty())
                                    <div class="detail-section">
                                        <div class="detail-title">Tanggapan Terkirim</div>
                                        <div class="complaint-list" style="gap: 10px;">
                                            @foreach($p->tanggapan as $reply)
                                                <div class="reply-box">
                                                    <div class="reply-header">Dijawab oleh: {{ $reply->admin->nama }} (Admin)</div>
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
                @include('partials.simple-pagination', ['paginator' => $pengaduans])
            @endif
        </div>
    </div>

    <script>
        function toggleDetails(element) {
            if (element.classList.contains('active')) {
                return;
            }
            document.querySelectorAll('.complaint-item').forEach(item => {
                if (item !== element) {
                    item.classList.remove('active');
                }
            });
            element.classList.toggle('active');
        }

        // Mencegah penutupan detail saat berinteraksi di formulir/form-group
        document.querySelectorAll('.complaint-details').forEach(detail => {
            detail.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Penanganan klik header untuk menutup item aktif
        document.querySelectorAll('.complaint-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.closest('.complaint-details')) {
                    if (this.classList.contains('active')) {
                        this.classList.remove('active');
                        e.stopPropagation();
                    }
                }
            });
        });

        (() => {
            // Success Toast Logic
            const toast = document.getElementById('successToast');
            if (toast) {
                const close = document.getElementById('successToastClose');
                window.setTimeout(() => toast.classList.add('is-visible'), 120);
                const hideToast = () => toast.classList.remove('is-visible');
                close?.addEventListener('click', hideToast);
                window.setTimeout(hideToast, 5200);
            }

            window.addEventListener('DOMContentLoaded', () => {
                const btnTrigger = document.getElementById('btnTriggerLogout');
                const modal = document.getElementById('logoutModal');
                const btnCancel = document.getElementById('btnCancelLogout');
                const btnConfirm = document.getElementById('btnConfirmLogout');
                const form = document.getElementById('logoutForm');

                btnTrigger?.addEventListener('click', () => {
                    modal?.classList.add('is-open');
                });

                btnCancel?.addEventListener('click', () => {
                    modal?.classList.remove('is-open');
                });

                modal?.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('is-open');
                    }
                });

                btnConfirm?.addEventListener('click', () => {
                    form?.submit();
                });
            });
        })();
    </script>

    <!-- Logout Confirmation Modal -->
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
