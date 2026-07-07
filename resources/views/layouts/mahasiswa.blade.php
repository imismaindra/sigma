<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Mahasiswa') - SIPMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<<<<<<< HEAD
    
    <!-- Google Fonts: Plus Jakarta Sans for high-end look -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

=======
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        (() => {
            const savedTheme = localStorage.getItem('sipma-theme') || 'dark';
            document.documentElement.dataset.theme = savedTheme;
        })();
    </script>
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            --shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
=======
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            --app-bg: #f5f7fb;
            --shell-bg: rgba(255, 255, 255, 0.94);
            --shell-soft: #f8fafc;
            --shell-border: rgba(226, 232, 240, 0.9);
            --topbar-bg: rgba(255, 255, 255, 0.88);
            --topbar-text: #0f172a;
            --footer-bg: rgba(255, 255, 255, 0.55);
            --watch-bg: #203a5b;
            --watch-panel: #1b2f4b;
            --watch-panel-soft: rgba(15, 23, 42, .18);
            --watch-line: rgba(148, 163, 184, .28);
            --watch-muted: #a8b7cb;
            --watch-text: #f8fafc;
            --watch-accent: #7cc6ff;
            --watch-green: #37bd7c;
            --watch-red: #ff6b73;
        }

        html[data-theme="dark"] {
            --primary: #7cc6ff;
            --primary-dark: #dbeafe;
            --primary-soft: rgba(124, 198, 255, .16);
            --accent: #37bd7c;
            --accent-soft: rgba(55, 189, 124, .16);
            --bg: #203a5b;
            --surface: #1b2f4b;
            --surface-soft: rgba(15, 23, 42, .18);
            --border: rgba(148, 163, 184, .24);
            --text: #f8fafc;
            --muted: #a8b7cb;
            --shadow: 0 20px 40px rgba(15, 23, 42, .22);
            --app-bg: #203a5b;
            --shell-bg: #172a44;
            --shell-soft: rgba(15, 23, 42, .22);
            --shell-border: rgba(148, 163, 184, .2);
            --topbar-bg: rgba(32, 58, 91, .92);
            --topbar-text: #f8fafc;
            --footer-bg: rgba(23, 42, 68, .92);
        }

        html[data-theme="light"] {
            --watch-bg: #eef4fb;
            --watch-panel: #ffffff;
            --watch-panel-soft: #f8fafc;
            --watch-line: #dbe3ee;
            --watch-muted: #64748b;
            --watch-text: #0f172a;
            --watch-accent: #2563eb;
            --watch-green: #16a34a;
            --watch-red: #dc2626;
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
                radial-gradient(circle at 10% 0%, rgba(79, 70, 229, 0.08), transparent 30%),
                radial-gradient(circle at 92% 8%, rgba(15, 118, 110, 0.06), transparent 24%),
                var(--bg);
=======
                radial-gradient(circle at 10% 0%, rgba(29, 78, 216, 0.12), transparent 30%),
                radial-gradient(circle at 92% 8%, rgba(15, 118, 110, 0.1), transparent 24%),
                var(--app-bg);
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
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
=======
            border-right: 1px solid var(--shell-border);
            background: var(--shell-bg);
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.12);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-head {
            padding: 22px;
            border-bottom: 1px solid var(--shell-border);
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            background: rgba(248, 250, 252, 0.7);
            border: 1px solid var(--border);
=======
            background: var(--shell-soft);
            border: 1px solid var(--shell-border);
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            border-color: rgba(79, 70, 229, 0.15);
=======
            border-color: rgba(124, 198, 255, .35);
        }

        .nav-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: currentColor;
            opacity: 0.7;
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            border: 1px solid #fecaca;
            background: #fff5f5;
            color: #b91c1c;
=======
            border: 1px solid rgba(239, 68, 68, .35);
            background: rgba(239, 68, 68, .12);
            color: #fecaca;
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
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
=======
            background: var(--shell-bg);
            color: var(--primary-dark);
        }

        .btn-soft {
            border: 1px solid rgba(124, 198, 255, .35);
            background: var(--primary-soft);
            color: var(--primary-dark);
>>>>>>> origin/Abiyyu-dev
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
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 30;
            min-height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 0 28px;
<<<<<<< HEAD
            background: rgba(255, 255, 255, 0.85);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            backdrop-filter: blur(12px);
        }

        @media (max-width: 640px) {
            .topbar {
                padding: 0 16px;
            }
=======
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--shell-border);
            backdrop-filter: blur(16px);
            color: var(--topbar-text);
>>>>>>> origin/Abiyyu-dev
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--shell-bg);
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
<<<<<<< HEAD
            background: #ffffff;
            padding: 0 14px;
=======
            background: var(--shell-bg);
            padding: 0 12px;
>>>>>>> origin/Abiyyu-dev
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

        .theme-toggle {
            min-height: 38px;
            border: 1px solid var(--shell-border);
            border-radius: 999px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--shell-soft);
            color: var(--topbar-text);
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
        }

        .theme-toggle-icon {
            width: 18px;
            height: 18px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 11px;
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
<<<<<<< HEAD
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
=======
            background: var(--surface);
            border: 1px solid var(--shell-border);
            border-radius: 14px;
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
=======
            border-color: #60a5fa;
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
>>>>>>> origin/Abiyyu-dev
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

<<<<<<< HEAD
        .file-note {
=======
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
            background: var(--surface-soft);
        }

        .notification-item.unread {
            border-color: #bfdbfe;
            background: var(--primary-soft);
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
            color: var(--muted);
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
>>>>>>> origin/Abiyyu-dev
            font-size: 11px;
            color: var(--muted);
<<<<<<< HEAD
            margin-top: 5px;
=======
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: var(--surface-soft);
            padding: 28px;
            font-size: 13px;
            line-height: 1.55;
        }

        .app-footer {
            margin-top: auto;
            border-top: 1px solid var(--shell-border);
            padding: 18px 28px;
            color: var(--muted);
            font-size: 12px;
            background: var(--footer-bg);
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
>>>>>>> origin/Abiyyu-dev
        }

        /* Modal styling */
        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
<<<<<<< HEAD
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(8px);
=======
            background:
                radial-gradient(circle at 50% 22%, rgba(109, 199, 255, .18), transparent 34%),
                rgba(3, 10, 20, .66);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
>>>>>>> origin/Abiyyu-dev
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
<<<<<<< HEAD
            max-width: 420px;
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.12);
            transform: scale(.95);
=======
            max-width: 430px;
            background:
                linear-gradient(145deg, var(--glass-highlight), transparent 44%),
                var(--glass-bg-strong);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 26px;
            text-align: left;
            box-shadow:
                0 30px 90px rgba(0, 0, 0, .34),
                inset 0 1px 0 rgba(255, 255, 255, .12);
            transform: translateY(14px) scale(.96);
>>>>>>> origin/Abiyyu-dev
            transition: transform .2s ease;
            color: var(--text);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .logout-modal.is-open .logout-modal-content {
            transform: translateY(0) scale(1);
        }

        .logout-modal-icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            margin-bottom: 16px;
            color: #03111f;
            background: linear-gradient(135deg, #8fd3ff, #35e0a8);
            box-shadow: 0 16px 30px rgba(51, 214, 159, .22);
        }

        .logout-modal-icon svg {
            width: 26px;
            height: 26px;
        }

        .logout-modal-content h3 {
<<<<<<< HEAD
            font-size: 17px;
=======
            font-size: 21px;
>>>>>>> origin/Abiyyu-dev
            font-weight: 900;
            color: var(--text);
            margin-bottom: 8px;
        }

        .logout-modal-content p {
            color: var(--muted);
<<<<<<< HEAD
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 22px;
=======
            font-size: 14px;
            line-height: 1.55;
            margin-bottom: 24px;
>>>>>>> origin/Abiyyu-dev
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
<<<<<<< HEAD
            min-height: 42px;
            border-radius: 10px;
=======
            min-height: 48px;
            border-radius: 16px;
>>>>>>> origin/Abiyyu-dev
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
<<<<<<< HEAD
            transition: all 0.15s;
=======
            transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
        }

        .btn-modal-cancel:hover,
        .btn-modal-confirm:hover {
            transform: translateY(-1px);
>>>>>>> origin/Abiyyu-dev
        }

        .btn-modal-cancel {
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text);
        }
        .btn-modal-cancel:hover {
            background: #e2e8f0;
        }

        .btn-modal-confirm {
            border: 0;
            background: linear-gradient(135deg, #ff6b7a, #dc2626);
            color: #ffffff;
<<<<<<< HEAD
            box-shadow: 0 6px 16px rgba(220, 38, 38, 0.15);
        }
        .btn-modal-confirm:hover {
            background: #b91c1c;
=======
            box-shadow: 0 14px 26px rgba(220, 38, 38, .24);
        }

        body.modal-open {
            overflow: hidden;
        }

        @media (max-width: 520px) {
            .logout-modal {
                align-items: flex-end;
                padding: 12px;
                padding-bottom: max(12px, env(safe-area-inset-bottom));
            }

            .logout-modal-content {
                max-width: none;
                border-radius: 28px;
                padding: 22px;
                transform: translateY(26px) scale(.98);
            }

            .logout-modal-actions {
                gap: 10px;
            }
        }

        html[data-theme="dark"] body {
            background:
                radial-gradient(circle at 16% 0%, rgba(0, 128, 255, .42), transparent 28%),
                radial-gradient(circle at 82% 14%, rgba(51, 214, 159, .22), transparent 26%),
                linear-gradient(160deg, #07111f 0%, #0b1728 46%, #102947 100%);
        }

        html[data-theme="light"] body {
            background:
                radial-gradient(circle at 14% 0%, rgba(37, 99, 235, .18), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(20, 184, 166, .14), transparent 26%),
                linear-gradient(160deg, #edf4ff 0%, #f8fbff 48%, #eef7ff 100%);
        }

        html[data-theme="dark"] {
            --glass-bg: rgba(11, 23, 40, .68);
            --glass-bg-strong: rgba(15, 31, 54, .78);
            --glass-border: rgba(255, 255, 255, .12);
            --glass-highlight: rgba(255, 255, 255, .08);
            --stock-green: #33d69f;
            --stock-red: #ff6b7a;
            --stock-blue: #6dc7ff;
        }

        html[data-theme="light"] {
            --glass-bg: rgba(255, 255, 255, .72);
            --glass-bg-strong: rgba(255, 255, 255, .86);
            --glass-border: rgba(30, 64, 175, .13);
            --glass-highlight: rgba(255, 255, 255, .58);
            --stock-green: #16a34a;
            --stock-red: #dc2626;
            --stock-blue: #2563eb;
        }

        .sidebar,
        .topbar,
        .app-footer,
        .hero-card,
        .panel,
        .stat-card,
        .complaint-card,
        .notification-panel,
        .filter-panel,
        .watch-panel,
        .notice-panel,
        .mobile-bottom-nav {
            background: linear-gradient(145deg, var(--glass-highlight), transparent 40%), var(--glass-bg);
            border-color: var(--glass-border);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            box-shadow: 0 22px 60px rgba(0, 0, 0, .18);
        }

        .sidebar {
            width: 292px;
            padding: 12px;
            border-right: 1px solid var(--glass-border);
        }

        .sidebar-head {
            border-bottom-color: var(--glass-border);
        }

        .brand-mark {
            border-radius: 16px;
            background: linear-gradient(135deg, #2d8cff, #33d69f);
            box-shadow: 0 12px 28px rgba(45, 140, 255, .26);
        }

        .sidebar-user {
            background: var(--glass-bg-strong);
            border-color: var(--glass-border);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .08);
        }

        .nav-link {
            min-height: 48px;
            border-radius: 16px;
            color: var(--muted);
        }

        .nav-link:hover,
        .nav-link.is-active {
            color: var(--text);
            background: linear-gradient(135deg, rgba(109, 199, 255, .22), rgba(51, 214, 159, .12));
            border-color: rgba(109, 199, 255, .28);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .08);
        }

        .app-main {
            margin-left: 292px;
        }

        .topbar {
            min-height: 76px;
            margin: 14px 18px 0;
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            top: 0;
            left: 292px;
            right: 0;
        }

        .content-wrap {
            width: min(100%, 1240px);
            padding-top: 112px;
            padding-bottom: 38px;
        }

        .theme-toggle,
        .notification-pill,
        .btn-secondary,
        .btn-logout,
        .mobile-menu-btn {
            background: var(--glass-bg-strong);
            border-color: var(--glass-border);
            backdrop-filter: blur(18px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
            color: #03111f;
        }

        .app-footer {
            margin: auto 18px 18px;
            border: 1px solid var(--glass-border);
            border-radius: 20px;
        }

        .mobile-bottom-nav {
            position: fixed;
            left: 50%;
            right: auto;
            bottom: max(14px, env(safe-area-inset-bottom));
            transform: translateX(-50%);
            z-index: 60;
            width: min(calc(100vw - 28px), 390px);
            min-height: 70px;
            display: none;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 3px;
            align-items: center;
            padding: 8px;
            border: 1px solid rgba(255, 255, 255, .18);
            border-radius: 30px;
            overflow: visible;
            background:
                linear-gradient(145deg, rgba(255, 255, 255, .22), rgba(255, 255, 255, .04) 42%, rgba(255, 255, 255, .08)),
                rgba(12, 23, 39, .58);
            backdrop-filter: blur(28px) saturate(170%);
            -webkit-backdrop-filter: blur(28px) saturate(170%);
            box-shadow:
                0 24px 60px rgba(0, 0, 0, .34),
                inset 0 1px 0 rgba(255, 255, 255, .24),
                inset 0 -1px 0 rgba(255, 255, 255, .06);
        }

        .bottom-nav-item {
            min-width: 0;
            width: 100%;
            min-height: 54px;
            border: 0;
            border-radius: 22px;
            background: transparent;
            color: rgba(226, 232, 240, .74);
            text-decoration: none;
            display: grid;
            place-items: center;
            align-content: center;
            gap: 4px;
            font-size: 9.5px;
            font-weight: 800;
            line-height: 1;
            cursor: pointer;
            position: relative;
            transition: color .18s ease, background .18s ease, transform .18s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .bottom-nav-item svg {
            width: 20px;
            height: 20px;
            display: block;
        }

        .bottom-nav-item span {
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .bottom-nav-item.is-active {
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .14);
        }

        .bottom-nav-item.is-active::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: 5px;
            width: 16px;
            height: 3px;
            border-radius: 999px;
            transform: translateX(-50%);
            background: var(--stock-green);
            box-shadow: 0 0 12px color-mix(in srgb, var(--stock-green) 60%, transparent);
        }

        .bottom-nav-primary {
            width: 58px;
            min-height: 58px;
            justify-self: center;
            border-radius: 24px;
            color: #03111f;
            background:
                radial-gradient(circle at 28% 18%, rgba(255, 255, 255, .7), transparent 24%),
                linear-gradient(135deg, #8fd3ff, #35e0a8);
            transform: translateY(-13px);
            box-shadow:
                0 18px 34px rgba(51, 214, 159, .28),
                inset 0 1px 0 rgba(255, 255, 255, .55);
        }

        .bottom-nav-primary span {
            display: none;
        }

        .bottom-nav-primary svg {
            width: 24px;
            height: 24px;
        }

        .bottom-nav-primary.is-active::after {
            background: rgba(3, 17, 31, .55);
            box-shadow: none;
        }

        html[data-theme="light"] .mobile-bottom-nav {
            border-color: rgba(30, 64, 175, .12);
            background:
                linear-gradient(145deg, rgba(255, 255, 255, .82), rgba(255, 255, 255, .36) 42%, rgba(255, 255, 255, .66)),
                rgba(255, 255, 255, .62);
            box-shadow:
                0 24px 60px rgba(30, 64, 175, .18),
                inset 0 1px 0 rgba(255, 255, 255, .8),
                inset 0 -1px 0 rgba(255, 255, 255, .45);
        }

        html[data-theme="light"] .bottom-nav-item {
            color: rgba(51, 65, 85, .74);
        }

        html[data-theme="light"] .bottom-nav-item.is-active {
            color: #0f172a;
            background: rgba(37, 99, 235, .09);
        }

        @media (max-width: 900px) {
            .sidebar,
            .sidebar-backdrop,
            .mobile-menu-btn {
                display: none !important;
            }

            .app-main {
                margin-left: 0;
            }

            .topbar {
                margin: 10px 12px 0;
                top: 0;
                left: 0;
                right: 0;
                min-height: 64px;
                border-radius: 22px;
                padding: 0 14px;
            }

            .topbar-actions .btn-secondary,
            .topbar-actions .btn-logout {
                display: none;
            }

            .theme-toggle {
                padding: 0 10px;
            }

            .theme-toggle span:last-child {
                display: none;
            }

            .content-wrap {
                padding: 92px 12px calc(116px + env(safe-area-inset-bottom));
            }

            .mobile-bottom-nav {
                display: grid;
            }

            .app-footer {
                display: none;
            }
>>>>>>> origin/Abiyyu-dev
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
    @include('partials.mahasiswa.bottom-nav')

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

<<<<<<< HEAD
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
=======
            const themeToggle = document.getElementById('themeToggle');
            const themeToggleText = document.getElementById('themeToggleText');
            const themeToggleIcon = document.getElementById('themeToggleIcon');
            const applyThemeLabel = () => {
                const theme = document.documentElement.dataset.theme || 'dark';
                if (themeToggleText) {
                    themeToggleText.textContent = theme === 'dark' ? 'Dark' : 'Light';
>>>>>>> origin/Abiyyu-dev
                }
                if (themeToggleIcon) {
                    themeToggleIcon.textContent = theme === 'dark' ? '☾' : '☀';
                }
            };

            applyThemeLabel();
            themeToggle?.addEventListener('click', () => {
                const current = document.documentElement.dataset.theme || 'dark';
                const next = current === 'dark' ? 'light' : 'dark';
                document.documentElement.dataset.theme = next;
                localStorage.setItem('sipma-theme', next);
                applyThemeLabel();
            });

            window.addEventListener('DOMContentLoaded', () => {
                const logoutModal = document.getElementById('mahasiswaLogoutModal');
                const logoutCancel = document.getElementById('btnCancelMahasiswaLogout');
                const logoutConfirm = document.getElementById('btnConfirmMahasiswaLogout');
                const logoutForm = document.getElementById('mahasiswaLogoutForm');
                const openLogoutModal = () => {
                    closeSidebar();
                    document.body.classList.add('modal-open');
                    logoutModal?.classList.add('is-open');
                };
                const closeLogoutModal = () => {
                    document.body.classList.remove('modal-open');
                    logoutModal?.classList.remove('is-open');
                };

                document.querySelectorAll('[data-mahasiswa-logout-trigger]').forEach((logoutTrigger) => logoutTrigger.addEventListener('click', openLogoutModal));

                logoutCancel?.addEventListener('click', closeLogoutModal);

                logoutModal?.addEventListener('click', (event) => {
                    if (event.target === logoutModal) {
                        closeLogoutModal();
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape' && logoutModal?.classList.contains('is-open')) {
                        closeLogoutModal();
                    }
                });

                logoutConfirm?.addEventListener('click', () => {
                    logoutForm?.submit();
                });
            });

            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
<<<<<<< HEAD
=======
    <div class="logout-modal" id="mahasiswaLogoutModal" role="dialog" aria-modal="true" aria-labelledby="mahasiswaLogoutTitle">
        <div class="logout-modal-content">
            <div class="logout-modal-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <path d="M16 17l5-5-5-5"/>
                    <path d="M21 12H9"/>
                </svg>
            </div>
            <h3 id="mahasiswaLogoutTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari dashboard mahasiswa SIPMA?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelMahasiswaLogout">Batal</button>
                <button type="button" class="btn-modal-confirm" id="btnConfirmMahasiswaLogout">Keluar</button>
            </div>
        </div>
    </div>
    @include('partials.toast')
>>>>>>> origin/Abiyyu-dev
    @yield('scripts')
</body>
</html>
