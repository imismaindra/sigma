<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Mahasiswa') - SIPMA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        (() => {
            const savedTheme = localStorage.getItem('sipma-theme') || 'dark';
            document.documentElement.dataset.theme = savedTheme;
        })();
    </script>
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
                var(--app-bg);
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
            border-right: 1px solid var(--shell-border);
            background: var(--shell-bg);
            box-shadow: 10px 0 30px rgba(15, 23, 42, 0.12);
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar-head {
            padding: 22px;
            border-bottom: 1px solid var(--shell-border);
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
            background: var(--shell-soft);
            border: 1px solid var(--shell-border);
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
            border-color: rgba(124, 198, 255, .35);
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
            border: 1px solid rgba(239, 68, 68, .35);
            background: rgba(239, 68, 68, .12);
            color: #fecaca;
        }

        .btn-primary {
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            box-shadow: 0 12px 22px rgba(37, 99, 235, 0.2);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            background: var(--shell-bg);
            color: var(--primary-dark);
        }

        .btn-soft {
            border: 1px solid rgba(124, 198, 255, .35);
            background: var(--primary-soft);
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
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--shell-border);
            backdrop-filter: blur(16px);
            color: var(--topbar-text);
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
            background: var(--shell-bg);
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
            background: var(--surface);
            border: 1px solid var(--shell-border);
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
            background: var(--surface);
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

        .notif-dropdown {
            position: relative;
        }

        .notif-trigger {
            min-height: 38px;
            min-width: 38px;
            border: 1px solid var(--glass-border);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--glass-bg-strong);
            color: var(--text);
            cursor: pointer;
            position: relative;
            backdrop-filter: blur(18px);
            transition: border-color .15s ease;
        }

        .notif-trigger:hover {
            border-color: var(--stock-blue);
        }

        .notif-bell-count {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 18px;
            height: 18px;
            border-radius: 999px;
            display: none;
            place-items: center;
            font-size: 9px;
            font-weight: 900;
            background: var(--stock-red);
            color: #ffffff;
            border: 2px solid var(--topbar-bg);
            line-height: 1;
            padding: 0 4px;
        }

        .notif-bell-count.has-unread {
            display: grid;
        }

        .notif-panel {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 360px;
            max-width: calc(100vw - 32px);
            background: var(--glass-bg-strong);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            backdrop-filter: blur(28px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, .34);
            z-index: 100;
            display: none;
            overflow: hidden;
        }

        .notif-panel.is-open {
            display: block;
        }

        .notif-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border-bottom: 1px solid var(--glass-border);
        }

        .notif-panel-title {
            font-size: 13px;
            font-weight: 900;
            color: var(--text);
        }

        .notif-mark-all-btn {
            background: none;
            border: none;
            color: var(--stock-blue);
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 8px;
            transition: background .15s ease;
        }

        .notif-mark-all-btn:hover {
            background: var(--primary-soft);
        }

        .notif-panel-list {
            max-height: 320px;
            overflow-y: auto;
        }

        .notif-panel-loading,
        .notif-panel-empty {
            padding: 24px 16px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .notif-panel-item {
            display: block;
            padding: 12px 16px;
            text-decoration: none;
            border-bottom: 1px solid var(--glass-border);
            transition: background .12s ease;
            cursor: pointer;
        }

        .notif-panel-item:hover {
            background: var(--glass-highlight);
        }

        .notif-panel-item.unread {
            background: rgba(109, 199, 255, .06);
            border-left: 3px solid var(--stock-blue);
        }

        .notif-panel-item-title {
            font-size: 12px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 3px;
        }

        .notif-panel-item.unread .notif-panel-item-title {
            color: var(--stock-blue);
        }

        .notif-panel-item-message {
            font-size: 11px;
            color: var(--muted);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .notif-panel-item-time {
            font-size: 10px;
            color: var(--muted);
            font-weight: 700;
            margin-top: 4px;
        }

        .notif-panel-footer {
            display: block;
            text-align: center;
            padding: 12px;
            font-size: 12px;
            font-weight: 800;
            color: var(--stock-blue);
            text-decoration: none;
            border-top: 1px solid var(--glass-border);
            transition: background .12s ease;
        }

        .notif-panel-footer:hover {
            background: var(--glass-highlight);
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
        }

        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 10000;
            background:
                radial-gradient(circle at 50% 22%, rgba(109, 199, 255, .18), transparent 34%),
                rgba(3, 10, 20, .66);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
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
            font-size: 21px;
            font-weight: 900;
            color: var(--text);
            margin-bottom: 8px;
        }

        .logout-modal-content p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
            margin-bottom: 24px;
        }

        .logout-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-modal-cancel,
        .btn-modal-confirm {
            min-height: 48px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 900;
            cursor: pointer;
            transition: transform .16s ease, box-shadow .16s ease, border-color .16s ease;
        }

        .btn-modal-cancel:hover,
        .btn-modal-confirm:hover {
            transform: translateY(-1px);
        }

        .btn-modal-cancel {
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text);
        }

        .btn-modal-confirm {
            border: 0;
            background: linear-gradient(135deg, #ff6b7a, #dc2626);
            color: #ffffff;
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
        }

        /* Optimize scroll and paint performance for glassmorphism elements */
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
        .mobile-bottom-nav,
        .theme-toggle,
        .notification-pill,
        .btn-secondary,
        .btn-logout,
        .mobile-menu-btn,
        .logout-modal,
        .logout-modal-content,
        .balance-card,
        .metric-card,
        .portfolio-panel,
        .case-card,
        .activity-panel,
        .activity-row,
        .connected-mini,
        .detail-hero,
        .history-hero,
        .history-item,
        .profile-hero,
        .profile-card {
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            will-change: transform;
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
    @include('partials.mahasiswa.bottom-nav')

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

            const themeToggle = document.getElementById('themeToggle');
            const themeToggleText = document.getElementById('themeToggleText');
            const themeToggleIcon = document.getElementById('themeToggleIcon');
            const applyThemeLabel = () => {
                const theme = document.documentElement.dataset.theme || 'dark';
                if (themeToggleText) {
                    themeToggleText.textContent = theme === 'dark' ? 'Dark' : 'Light';
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

            function initNotifications() {
                const trigger = document.getElementById('notifTrigger');
                const panel = document.getElementById('notifPanel');
                const list = document.getElementById('notifPanelList');
                const bellCount = document.getElementById('notifBellCount');
                const markAllBtn = document.getElementById('notifMarkAllRead');

                if (!trigger) return;

                function closePanel() { panel?.classList.remove('is-open'); }

                trigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = panel?.classList.contains('is-open');
                    if (isOpen) { closePanel(); return; }
                    panel?.classList.add('is-open');
                    if (list) {
                        list.innerHTML = '<div class="notif-panel-loading">Memuat...</div>';
                        fetch('{{ route('mahasiswa.notifications.latest') }}', {
                            headers: { 'Accept': 'application/json' }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.notifications.length === 0) {
                                list.innerHTML = '<div class="notif-panel-empty">Tidak ada notifikasi</div>';
                                return;
                            }
                            list.innerHTML = data.notifications.map(n => `
                                <a href="${n.url}" class="notif-panel-item ${n.is_unread ? 'unread' : ''}" data-notif-id="${n.id}">
                                    <div class="notif-panel-item-title">${n.title}</div>
                                    <div class="notif-panel-item-message">${n.message}</div>
                                    <div class="notif-panel-item-time">${n.created_at}</div>
                                </a>
                            `).join('');

                            list.querySelectorAll('.notif-panel-item.unread').forEach(item => {
                                item.addEventListener('click', function(e) {
                                    const id = this.dataset.notifId;
                                    fetch('{{ route('mahasiswa.notifications.read', '') }}/' + id, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                        },
                                    });
                                });
                            });

                            if (markAllBtn) {
                                markAllBtn.style.display = data.unread_count > 0 ? '' : 'none';
                            }
                        })
                        .catch(() => {
                            list.innerHTML = '<div class="notif-panel-loading">Gagal memuat notifikasi</div>';
                        });
                    }
                });

                document.addEventListener('click', function(e) {
                    if (!trigger.contains(e.target) && !panel?.contains(e.target)) {
                        closePanel();
                    }
                });

                markAllBtn?.addEventListener('click', function() {
                    fetch('{{ route('mahasiswa.notifications.read-all') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(() => {
                        document.querySelectorAll('.notif-panel-item.unread').forEach(el => el.classList.remove('unread'));
                        if (bellCount) {
                            bellCount.textContent = '0';
                            bellCount.classList.remove('has-unread');
                        }
                        markAllBtn.style.display = 'none';
                    });
                });

                // Poll for new notifications every 30 seconds
                setInterval(function() {
                    fetch('{{ route('mahasiswa.notifications.unread-count') }}', {
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (bellCount) {
                            bellCount.textContent = data.count;
                            bellCount.classList.toggle('has-unread', data.count > 0);
                        }
                        if (markAllBtn) {
                            markAllBtn.style.display = data.count > 0 ? '' : 'none';
                        }
                    })
                    .catch(() => {});
                }, 30000);
            }

            window.addEventListener('DOMContentLoaded', () => {
                initNotifications();

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
        })();
    </script>
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
    @yield('scripts')
</body>
</html>
