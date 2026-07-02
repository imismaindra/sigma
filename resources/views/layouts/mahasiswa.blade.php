<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Mahasiswa') - SIPMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Plus Jakarta Sans for high-end look -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-soft: #eeebff;
            --accent: #0f766e;
            --accent-soft: #ccfbf1;
            --bg: #f8fafc;
            --surface: #ffffff;
            --surface-soft: #f1f5f9;
            --border: #e2e8f0;
            --text: #0f172a;
            --muted: #64748b;
            --pending: #d97706;
            --proses: #2563eb;
            --selesai: #16a34a;
            --ditolak: #dc2626;
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        html,
        body {
            width: 100%;
            min-height: 100%;
        }

        body {
            background:
                radial-gradient(circle at 10% 0%, rgba(79, 70, 229, 0.08), transparent 30%),
                radial-gradient(circle at 92% 8%, rgba(15, 118, 110, 0.06), transparent 24%),
                var(--bg);
            color: var(--text);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-shell {
            min-height: 100vh;
            display: flex;
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            z-index: 35;
            display: none;
            background: rgba(15, 23, 42, 0.3);
            backdrop-filter: blur(4px);
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
            border-right: 1px solid rgba(226, 232, 240, 0.8);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 1px 0 10px rgba(15, 23, 42, 0.02);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: -translate-x-full;
            }
            .sidebar.is-open {
                transform: translateX(0);
            }
        }

        .sidebar-head {
            padding: 24px;
            border-bottom: 1px solid var(--border);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text);
            text-decoration: none;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            flex: 0 0 auto;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .brand strong {
            display: block;
            font-size: 16px;
            font-weight: 800;
            line-height: 1.15;
        }

        .brand span span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.35;
        }

        .sidebar-user {
            margin-top: 18px;
            padding: 14px;
            border-radius: 12px;
            background: rgba(248, 250, 252, 0.7);
            border: 1px solid var(--border);
        }

        .sidebar-user-name {
            font-size: 13.5px;
            font-weight: 800;
            margin-bottom: 4px;
            color: var(--text);
            overflow-wrap: anywhere;
        }

        .sidebar-user-meta {
            color: var(--muted);
            font-size: 11.5px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .sidebar-nav {
            padding: 16px;
            display: grid;
            gap: 6px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .nav-link {
            min-height: 44px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 14px;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.is-active {
            color: var(--primary);
            background: var(--primary-soft);
            border-color: rgba(79, 70, 229, 0.15);
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
            padding: 0 16px;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
            border: 0;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .btn-logout {
            border: 1px solid #fecaca;
            background: #fff5f5;
            color: #b91c1c;
        }
        .btn-logout:hover {
            background: #fee2e2;
        }

        .btn-primary {
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.15);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(79, 70, 229, 0.25);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--text);
        }
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-soft {
            border: 1px solid #ddd6fe;
            background: var(--primary-soft);
            color: var(--primary);
        }
        .btn-soft:hover {
            background: #e0daff;
        }

        .btn-danger {
            background: var(--ditolak);
            color: #ffffff;
        }
        .btn-danger:hover {
            background: #b91c1c;
        }

        .app-main {
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            flex-grow: 1;
            padding-left: 280px;
            transition: padding 0.3s ease;
        }

        @media (max-width: 1024px) {
            .app-main {
                padding-left: 0;
            }
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
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(12px);
        }

        @media (max-width: 640px) {
            .topbar {
                padding: 0 16px;
            }
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
            font-weight: 700;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 1024px) {
            .mobile-menu-btn {
                display: inline-flex;
            }
        }

        .topbar-title {
            min-width: 0;
        }

        .topbar-title strong {
            display: block;
            font-size: 15px;
            font-weight: 800;
        }

        .topbar-title span {
            display: block;
            margin-top: 3px;
            color: var(--muted);
            font-size: 11.5px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .notification-pill {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: #ffffff;
            padding: 0 14px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
        }

        .notification-count {
            min-width: 20px;
            height: 20px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: var(--primary);
            color: #ffffff;
            font-size: 10px;
            font-weight: 800;
        }

        .content-wrap {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 28px 28px 48px;
            flex-grow: 1;
        }

        @media (max-width: 640px) {
            .content-wrap {
                padding: 16px 16px 36px;
            }
        }

        /* Shared Dashboard Panels & Cards styling */
        .page-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(260px, 360px);
            gap: 20px;
            align-items: stretch;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .page-hero {
                grid-template-columns: 1fr;
            }
        }

        .hero-card,
        .panel,
        .stat-card,
        .complaint-card,
        .notification-panel,
        .filter-panel {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero-card {
            padding: 30px;
            min-width: 0;
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
            background: rgba(79, 70, 229, 0.05);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 26px;
            padding: 0 10px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary);
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .eyebrow::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: var(--accent);
        }

        .hero-card h1 {
            font-size: clamp(24px, 3.5vw, 34px);
            font-weight: 850;
            line-height: 1.15;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
            color: var(--text);
        }

        .hero-card p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
            max-width: 640px;
        }

        .guide-card {
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 16px;
        }

        .guide-card strong {
            font-size: 14.5px;
            font-weight: 800;
            display: block;
            margin-bottom: 6px;
        }

        .guide-card p {
            color: var(--muted);
            font-size: 12.5px;
            line-height: 1.5;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            border-left: 4px solid var(--primary);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
        }

        .stat-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 850;
            color: var(--text);
            line-height: 1;
        }

        .stat-hint {
            font-size: 11px;
            color: var(--muted);
        }

        /* Filter Panel Styles */
        .filter-panel {
            padding: 20px;
            margin-bottom: 24px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 16px;
            margin-bottom: 18px;
        }

        .panel-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
        }

        .panel-subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            align-items: end;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text);
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            min-height: 40px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0 12px;
            font-size: 13px;
            color: var(--text);
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        .form-textarea {
            padding: 10px 12px;
            min-height: 120px;
            resize: vertical;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            min-height: 40px;
        }
        .filter-actions > * {
            flex: 1;
        }

        /* Notifikasi */
        .notification-panel {
            padding: 20px;
            margin-bottom: 24px;
        }

        .notification-list {
            display: grid;
            gap: 8px;
        }

        .notification-item {
            display: block;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(248, 250, 252, 0.5);
            transition: all 0.15s ease;
        }

        .notification-item:hover {
            border-color: #cbd5e1;
            background: #ffffff;
        }

        .notification-item.unread {
            border-color: rgba(79, 70, 229, 0.2);
            background: rgba(79, 70, 229, 0.02);
        }

        .notification-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 3px;
        }

        .notification-message {
            font-size: 12.5px;
            color: var(--muted);
            line-height: 1.4;
        }

        /* Riwayat Pengaduan / Panel list */
        .panel {
            padding: 24px;
            margin-bottom: 24px;
        }

        .empty-state {
            text-align: center;
            color: var(--muted);
            padding: 48px 0;
            font-size: 13.5px;
        }

        .complaint-list {
            display: grid;
            gap: 12px;
            margin-top: 14px;
        }

        .complaint-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 18px;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .complaint-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.02);
            transform: translateY(-1px);
        }

        .complaint-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 8px;
        }

        .complaint-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text);
            line-height: 1.35;
        }

        .complaint-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 11.5px;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .complaint-meta strong {
            color: var(--text);
        }

        .complaint-body {
            font-size: 13px;
            line-height: 1.55;
            color: #334155;
            margin-bottom: 14px;
        }

        .complaint-actions {
            display: flex;
            gap: 8px;
            border-top: 1px solid var(--border);
            padding-top: 12px;
            justify-content: flex-end;
        }

        .complaint-actions .btn-soft,
        .complaint-actions .btn-secondary {
            min-height: 34px;
            padding: 0 12px;
            font-size: 12px;
            border-radius: 8px;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 22px;
            padding: 0 8px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: 800;
            text-transform: uppercase;
            border: 1px solid transparent;
        }

        .badge-pending { background: #fffbeb; color: #b45309; border-color: #fde68a; }
        .badge-proses { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .badge-menunggu_klarifikasi,
        .badge-menunggu_verifikasi_mahasiswa { background: #faf5ff; color: #6d28d9; border-color: #ddd6fe; }
        .badge-ditindaklanjuti { background: #f0fdfa; color: #0f766e; border-color: #99f6e4; }
        .badge-selesai { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
        .badge-ditolak { background: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        .sla-badge {
            display: inline-flex;
            align-items: center;
            min-height: 22px;
            padding: 0 8px;
            border-radius: 6px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 10.5px;
            font-weight: 800;
            border: 1px solid #fca5a5;
        }

        /* Toast & Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            line-height: 1.45;
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

        .file-note {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }

        /* Modal styling */
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
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
            transform: scale(.95);
            transition: transform .2s ease;
        }

        .logout-modal.is-open .logout-modal-content {
            transform: scale(1);
        }

        .logout-modal-content h3 {
            font-size: 17px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 10px;
        }

        .logout-modal-content p {
            color: var(--muted);
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
            min-height: 42px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.15s;
        }

        .btn-modal-cancel {
            border: 1px solid var(--border);
            background: #f8fafc;
            color: var(--text);
        }
        .btn-modal-cancel:hover {
            background: #e2e8f0;
        }

        .btn-modal-confirm {
            border: 0;
            background: #dc2626;
            color: #ffffff;
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.15);
        }
        .btn-modal-confirm:hover {
            background: #b91c1c;
        }

        @yield('styles')
    </style>
</head>
<body class="min-h-full flex flex-col text-slate-800 antialiased selection:bg-indigo-500 selection:text-white relative bg-slate-50/30">

    <!-- Glowing lights background -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[40%] -left-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-tr from-indigo-200/20 to-violet-200/20 blur-[120px]"></div>
        <div class="absolute -bottom-[40%] -right-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-br from-blue-200/15 to-purple-200/15 blur-[120px]"></div>
    </div>

    <!-- Mobile Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="app-shell relative z-10 flex min-h-screen">
        
        <!-- Sidebar Navigation -->
        @include('partials.mahasiswa.sidebar')

        <!-- Main Wrapper -->
        <div class="app-main">
            
            <!-- Navbar Header -->
            @include('partials.mahasiswa.navbar')

            <!-- Content Panel -->
            <main class="content-wrap">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('partials.mahasiswa.footer')
        </div>
    </div>

    <!-- Student Logout Modal -->
    <div class="logout-modal" id="mahasiswaLogoutModal" role="dialog" aria-modal="true" aria-labelledby="mahasiswaLogoutTitle">
        <div class="logout-modal-content">
            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 border border-rose-100">
                <i data-lucide="log-out" class="w-6 h-6"></i>
            </div>
            <h3 id="mahasiswaLogoutTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari dashboard mahasiswa SIPMA?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelMahasiswaLogout">Batal</button>
                <form id="mahasiswaLogoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
                <button type="button" class="btn-modal-confirm" id="btnConfirmMahasiswaLogout">Keluar</button>
            </div>
        </div>
    </div>

    @include('partials.toast')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const toggle = document.getElementById('sidebarToggle');

            const openSidebar = () => {
                sidebar?.classList.add('is-open');
                backdrop?.classList.add('is-open');
            };

            const closeSidebar = () => {
                sidebar?.classList.remove('is-open');
                backdrop?.classList.remove('is-open');
            };

            toggle?.addEventListener('click', openSidebar);
            backdrop?.addEventListener('click', closeSidebar);
            document.querySelectorAll('[data-close-sidebar]').forEach((link) => {
                link.addEventListener('click', closeSidebar);
            });

            // Logout Modal controls
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

            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
