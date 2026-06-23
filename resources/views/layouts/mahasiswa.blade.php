<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Mahasiswa') - SIPMA</title>
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

        html,
        body {
            width: 100%;
            min-height: 100%;
            overflow-x: hidden;
        }

        body {
            background:
                radial-gradient(circle at 10% 0%, rgba(29, 78, 216, 0.12), transparent 30%),
                radial-gradient(circle at 92% 8%, rgba(15, 118, 110, 0.1), transparent 24%),
                var(--bg);
            color: var(--text);
        }

        a {
            color: inherit;
        }

        .app-shell {
            min-height: 100vh;
            display: block;
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            z-index: 35;
            display: none;
            background: rgba(15, 23, 42, 0.38);
        }

        .sidebar-backdrop.is-open {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 280px;
            height: 100vh;
            z-index: 40;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(226, 232, 240, 0.9);
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.04);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-head {
            padding: 22px;
            border-bottom: 1px solid var(--border);
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
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .brand strong {
            display: block;
            font-size: 17px;
            line-height: 1.15;
        }

        .brand span span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.35;
        }

        .sidebar-user {
            margin-top: 18px;
            padding: 14px;
            border-radius: 12px;
            background: var(--surface-soft);
            border: 1px solid var(--border);
        }

        .sidebar-user-name {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 4px;
            overflow-wrap: anywhere;
        }

        .sidebar-user-meta {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .sidebar-nav {
            padding: 16px;
            display: grid;
            gap: 8px;
        }

        .nav-link {
            min-height: 42px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            border: 1px solid transparent;
        }

        .nav-link:hover,
        .nav-link.is-active {
            color: var(--primary-dark);
            background: var(--primary-soft);
            border-color: #bfdbfe;
        }

        .nav-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: currentColor;
            opacity: 0.7;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            flex: 0 0 auto;
            color: currentColor;
        }

        .btn-logout,
        .btn-primary,
        .btn-secondary,
        .btn-soft,
        .btn-danger {
            min-height: 42px;
            border-radius: 10px;
            padding: 0 14px;
            font-size: 13px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            border: 0;
            white-space: nowrap;
        }

        .btn-logout {
            border: 1px solid #fecaca;
            background: #fff7f7;
            color: #b91c1c;
        }

        .btn-primary {
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            box-shadow: 0 12px 22px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--primary-dark);
        }

        .btn-soft {
            border: 1px solid #bfdbfe;
            background: #eff6ff;
            color: var(--primary-dark);
        }

        .btn-danger {
            background: var(--ditolak);
            color: #ffffff;
        }

        .app-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 280px;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 0 28px;
            background: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            backdrop-filter: blur(16px);
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #ffffff;
            color: var(--text);
            cursor: pointer;
            font-size: 20px;
            font-weight: 800;
        }

        .topbar-title {
            min-width: 0;
        }

        .topbar-title strong {
            display: block;
            font-size: 15px;
        }

        .topbar-title span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 12px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-actions form {
            display: flex;
        }

        .notification-pill {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: #ffffff;
            padding: 0 12px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
        }

        .notification-count {
            min-width: 22px;
            height: 22px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: var(--primary);
            color: #ffffff;
            font-size: 11px;
        }

        .content-wrap {
            width: min(100%, 1180px);
            margin: 0 auto;
            padding: 26px 28px 34px;
        }

        .page-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(260px, 360px);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 18px;
        }

        .page-hero > *,
        .dashboard-grid > *,
        .stats-grid > *,
        .filter-form > * {
            min-width: 0;
        }

        .hero-card,
        .panel,
        .stat-card,
        .complaint-card,
        .notification-panel,
        .filter-panel {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 14px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero-card {
            padding: clamp(22px, 4vw, 34px);
            min-width: 0;
            overflow: hidden;
            position: relative;
        }

        .hero-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -90px;
            bottom: -130px;
            border-radius: 50%;
            background: rgba(29, 78, 216, 0.08);
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
            position: relative;
            z-index: 1;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .hero-card h1 {
            position: relative;
            z-index: 1;
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.08;
            letter-spacing: 0;
            max-width: 720px;
            margin-bottom: 12px;
        }

        .hero-card p {
            position: relative;
            z-index: 1;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
            max-width: 640px;
        }

        .guide-card {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 18px;
        }

        .guide-card strong {
            font-size: 15px;
            display: block;
            margin-bottom: 8px;
        }

        .guide-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .stat-card {
            padding: 18px;
            min-width: 0;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 30px;
            font-weight: 800;
            color: var(--primary-dark);
            line-height: 1;
        }

        .stat-hint {
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
        }

        .panel {
            padding: 20px;
        }

        .panel-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 16px;
        }

        .panel-title {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .panel-subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: minmax(300px, 410px) minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .form-grid,
        .filter-form {
            display: grid;
            gap: 12px;
        }

        .filter-form {
            grid-template-columns: minmax(180px, 1fr) repeat(4, minmax(128px, auto)) auto;
            align-items: end;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .form-label {
            display: block;
            color: var(--text);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface-soft);
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .form-input,
        .form-select {
            min-height: 44px;
            padding: 0 12px;
        }

        .form-textarea {
            min-height: 128px;
            padding: 12px;
            resize: vertical;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
        }

        .file-note {
            margin-top: 6px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.45;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.45;
            margin-bottom: 16px;
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

        .notification-panel,
        .filter-panel {
            padding: 16px;
            margin-bottom: 18px;
        }

        .notification-list,
        .complaint-list {
            display: grid;
            gap: 12px;
        }

        .notification-item {
            display: block;
            text-decoration: none;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            background: #f8fafc;
        }

        .notification-item.unread {
            border-color: #bfdbfe;
            background: #eff6ff;
        }

        .notification-title,
        .complaint-title {
            font-size: 14px;
            font-weight: 800;
            color: var(--text);
            overflow-wrap: anywhere;
        }

        .notification-message {
            margin-top: 5px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.45;
        }

        .complaint-card {
            padding: 16px;
            min-width: 0;
            transition: transform 0.15s ease, border-color 0.15s ease;
        }

        .complaint-card:hover {
            transform: translateY(-1px);
            border-color: #bfdbfe;
        }

        .complaint-top {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .complaint-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px 14px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .complaint-body {
            color: #334155;
            font-size: 13px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .complaint-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .badge,
        .sla-badge {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            border-radius: 999px;
            padding: 0 9px;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .badge-pending { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .badge-proses { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .badge-selesai { background: #d1fae5; color: #047857; border: 1px solid #a7f3d0; }
        .badge-ditolak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

        .sla-badge {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .empty-state {
            min-height: 220px;
            display: grid;
            place-items: center;
            text-align: center;
            color: var(--muted);
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            padding: 28px;
            font-size: 13px;
            line-height: 1.55;
        }

        .app-footer {
            margin-top: auto;
            border-top: 1px solid rgba(226, 232, 240, 0.9);
            padding: 18px 28px;
            color: var(--muted);
            font-size: 12px;
            background: rgba(255, 255, 255, 0.55);
        }

        .app-footer-inner {
            width: min(100%, 1180px);
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        @media (max-width: 1120px) {
            .app-shell {
                display: block;
            }

            .sidebar {
                inset: 0 auto 0 0;
                width: min(84vw, 300px);
                transform: translateX(-104%);
                transition: transform 0.2s ease;
            }

            .app-main {
                margin-left: 0;
            }

            .sidebar.is-open {
                transform: translateX(0);
            }

            .mobile-menu-btn {
                display: grid;
                place-items: center;
            }
        }

        @media (max-width: 900px) {
            .page-hero,
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .filter-form {
                grid-template-columns: 1fr 1fr;
            }

            .filter-actions {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                min-height: 62px;
                padding: 0 16px;
            }

            .topbar-title span,
            .notification-pill span:first-child {
                display: none;
            }

            .topbar-actions .btn-secondary {
                display: none;
            }

            .topbar-actions .btn-logout {
                min-height: 38px;
                padding: 0 10px;
                font-size: 12px;
            }

            .notification-pill {
                padding: 0 8px;
            }

            .content-wrap {
                padding: 18px 16px 28px;
                overflow: hidden;
            }

            .hero-card,
            .panel,
            .notification-panel,
            .filter-panel,
            .complaint-card,
            .stat-card {
                border-radius: 12px;
                width: 100%;
                max-width: 100%;
                min-width: 0;
            }

            .hero-card {
                padding: 20px;
            }

            .hero-card h1 {
                font-size: 28px;
            }

            .stats-grid,
            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-actions,
            .complaint-actions {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .btn-primary,
            .btn-secondary,
            .btn-soft,
            .btn-danger {
                width: 100%;
                max-width: 100%;
            }

            .panel-head,
            .complaint-top {
                flex-direction: column;
            }

            .app-footer {
                padding: 16px;
            }
        }

        .simple-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-top: 1px solid var(--border);
            padding-top: 14px;
            margin-top: 18px;
        }

        .page-button {
            min-height: 38px;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: var(--primary-dark);
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
            color: var(--muted);
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

        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            background: rgba(15, 23, 42, .45);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
            padding: 16px;
        }

        .logout-modal.is-open {
            opacity: 1;
            pointer-events: auto;
        }

        .logout-modal-content {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, .9);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
            transform: scale(.96);
            transition: transform .2s ease;
        }

        .logout-modal.is-open .logout-modal-content {
            transform: scale(1);
        }

        .logout-modal-content h3 {
            font-size: 18px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 10px;
        }

        .logout-modal-content p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
            margin-bottom: 22px;
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
            min-height: 44px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
        }

        .btn-modal-cancel {
            border: 1px solid var(--border);
            background: #f8fafc;
            color: var(--text);
        }

        .btn-modal-confirm {
            border: 0;
            background: #dc2626;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(220, 38, 38, .18);
        }

        @yield('styles')
    </style>
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <div class="app-shell">
        @include('partials.mahasiswa.sidebar')

        <div class="app-main">
            @include('partials.mahasiswa.navbar')

            <main class="content-wrap">
                @yield('content')
            </main>

            @include('partials.mahasiswa.footer')
        </div>
    </div>

    <script>
        (() => {
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const toggle = document.getElementById('sidebarToggle');
            const closeSidebar = () => {
                sidebar?.classList.remove('is-open');
                backdrop?.classList.remove('is-open');
            };

            toggle?.addEventListener('click', () => {
                sidebar?.classList.toggle('is-open');
                backdrop?.classList.toggle('is-open');
            });

            backdrop?.addEventListener('click', closeSidebar);
            document.querySelectorAll('[data-close-sidebar]').forEach((link) => {
                link.addEventListener('click', closeSidebar);
            });

            const logoutTrigger = document.getElementById('btnTriggerMahasiswaLogout');
            const logoutModal = document.getElementById('mahasiswaLogoutModal');
            const logoutCancel = document.getElementById('btnCancelMahasiswaLogout');
            const logoutConfirm = document.getElementById('btnConfirmMahasiswaLogout');
            const logoutForm = document.getElementById('mahasiswaLogoutForm');

            logoutTrigger?.addEventListener('click', () => {
                closeSidebar();
                logoutModal?.classList.add('is-open');
            });

            logoutCancel?.addEventListener('click', () => {
                logoutModal?.classList.remove('is-open');
            });

            logoutModal?.addEventListener('click', (event) => {
                if (event.target === logoutModal) {
                    logoutModal.classList.remove('is-open');
                }
            });

            logoutConfirm?.addEventListener('click', () => {
                logoutForm?.submit();
            });
        })();
    </script>
    <div class="logout-modal" id="mahasiswaLogoutModal" role="dialog" aria-modal="true" aria-labelledby="mahasiswaLogoutTitle">
        <div class="logout-modal-content">
            <h3 id="mahasiswaLogoutTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari dashboard mahasiswa SIPMA?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelMahasiswaLogout">Batal</button>
                <button type="button" class="btn-modal-confirm" id="btnConfirmMahasiswaLogout">Keluar</button>
            </div>
        </div>
    </div>
    @include('partials.toast')
    @yield('scripts')
</body>
</html>
