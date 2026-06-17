<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Pengaduan Mahasiswa</title>
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
            --danger: #dc2626;
            --danger-soft: #fef2f2;
            --success: #16a34a;
            --success-soft: #f0fdf4;
            --shadow: 0 24px 70px rgba(15, 23, 42, 0.12);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        html {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            width: 100%;
            height: 100dvh;
            color: var(--text);
            background:
                radial-gradient(circle at 14% 18%, rgba(29, 78, 216, 0.12), transparent 28%),
                radial-gradient(circle at 86% 10%, rgba(15, 118, 110, 0.12), transparent 24%),
                linear-gradient(135deg, #eef4ff 0%, var(--bg) 48%, #f6fbfa 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            overflow: hidden;
        }

        .login-page {
            width: min(100%, 1120px);
            max-width: 100%;
            height: min(680px, calc(100dvh - 64px));
            min-height: 0;
            display: grid;
            grid-template-columns: minmax(0, 1.08fr) minmax(360px, 440px);
            background: rgba(255, 255, 255, 0.82);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .info-panel {
            position: relative;
            min-width: 0;
            padding: clamp(28px, 4vw, 42px);
            color: #ffffff;
            background:
                linear-gradient(145deg, rgba(30, 58, 138, 0.92), rgba(29, 78, 216, 0.84)),
                linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                linear-gradient(0deg, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
            background-size: auto, 44px 44px, 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .info-panel::after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            right: -120px;
            bottom: -110px;
            border-radius: 50%;
            background: rgba(204, 251, 241, 0.18);
        }

        .brand {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-mark {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.26);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 800;
        }

        .brand-title {
            font-size: 18px;
            font-weight: 800;
            line-height: 1.15;
        }

        .brand-caption {
            display: block;
            margin-top: 3px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
        }

        .hero-copy {
            position: relative;
            z-index: 1;
            max-width: 520px;
            margin: clamp(34px, 7vh, 64px) 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 30px;
            padding: 0 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.13);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-size: 12px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.86);
            margin-bottom: 18px;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #5eead4;
            box-shadow: 0 0 0 4px rgba(94, 234, 212, 0.16);
        }

        h1 {
            font-size: clamp(32px, 4.5vw, 54px);
            line-height: 1.02;
            letter-spacing: 0;
            margin-bottom: 18px;
            overflow-wrap: anywhere;
        }

        .lead {
            max-width: 480px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 15px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .feature-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .feature-card {
            min-width: 0;
            min-height: 108px;
            border-radius: 16px;
            padding: 14px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .feature-icon {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.16);
            margin-bottom: 12px;
        }

        .feature-card strong {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .feature-card span {
            display: block;
            color: rgba(255, 255, 255, 0.68);
            font-size: 12px;
            line-height: 1.45;
        }

        .form-panel {
            background: var(--surface);
            padding: clamp(28px, 4vw, 42px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 0;
            min-width: 0;
        }

        .form-header {
            margin-bottom: 22px;
        }

        .form-badge {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .form-header h2 {
            font-size: 28px;
            line-height: 1.2;
            letter-spacing: 0;
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.55;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.45;
            margin-bottom: 16px;
            border: 1px solid transparent;
        }

        .alert-danger {
            background: var(--danger-soft);
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert-success {
            background: var(--success-soft);
            border-color: #bbf7d0;
            color: #166534;
        }

        .field {
            margin-bottom: 14px;
        }

        .form-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 48px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface-soft);
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .input-wrap:focus-within {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.16);
        }

        .input-icon {
            width: 18px;
            height: 18px;
            margin-left: 14px;
            color: var(--muted);
            flex: 0 0 auto;
        }

        .form-input {
            width: 100%;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: var(--text);
            font-size: 14px;
            font-weight: 500;
            padding: 0 14px 0 10px;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin: 2px 0 18px;
        }

        .checkbox-container {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 13px;
            cursor: pointer;
        }

        .checkbox-container input {
            width: 15px;
            height: 15px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            min-height: 48px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 14px 24px rgba(37, 99, 235, 0.24);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(37, 99, 235, 0.28);
        }

        .support-box {
            margin-top: 18px;
            padding: 12px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.55;
        }

        .support-box strong {
            color: var(--text);
        }

        .footer-info {
            margin-top: 18px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
            line-height: 1.6;
        }

        .footer-info code {
            color: var(--primary-dark);
            background: #eff6ff;
            padding: 1px 5px;
            border-radius: 5px;
            font-size: 11.5px;
        }

        .auth-toast {
            position: fixed;
            right: 24px;
            top: 24px;
            z-index: 10;
            width: min(380px, calc(100vw - 32px));
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 12px;
            align-items: start;
            padding: 14px;
            border-radius: 14px;
            border: 1px solid #fecaca;
            background: #ffffff;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.16);
            transform: translateY(-12px);
            opacity: 0;
            pointer-events: none;
            transition: transform 0.24s ease, opacity 0.24s ease;
        }

        .auth-toast.is-visible {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }

        .toast-icon {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--danger-soft);
            color: var(--danger);
            font-size: 16px;
            font-weight: 800;
        }

        .toast-title {
            display: block;
            color: #991b1b;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .toast-message {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .toast-close {
            width: 26px;
            height: 26px;
            border: 0;
            border-radius: 8px;
            background: #f8fafc;
            color: var(--muted);
            cursor: pointer;
            font-size: 17px;
            line-height: 1;
        }

        .toast-close:hover {
            background: #eef2f7;
            color: var(--text);
        }

        @media (max-width: 920px) {
            body {
                padding: 18px;
                align-items: center;
            }

            .login-page {
                grid-template-columns: 1fr;
                grid-template-rows: 36% 64%;
                height: calc(100dvh - 36px);
                min-height: 0;
            }

            .info-panel {
                padding: 24px 30px;
            }

            .hero-copy {
                margin: 26px 0 0;
            }

            .feature-grid {
                display: none;
            }

            .feature-card {
                min-height: auto;
            }

            .form-panel {
                padding: 28px 30px;
                justify-content: flex-start;
            }
        }

        @media (max-width: 520px) {
            body {
                padding: 0;
                background: var(--surface);
            }

            .login-page {
                position: fixed;
                inset: 0;
                width: 100%;
                max-width: 100vw;
                height: 100dvh;
                grid-template-rows: 32% 68%;
                border-radius: 0;
                border: 0;
                box-shadow: none;
            }

            .info-panel {
                padding: 18px 24px 14px;
                overflow: hidden;
                width: 100%;
                max-width: 100vw;
                justify-content: flex-start;
            }

            .form-panel,
            .form-header,
            .form-panel form,
            .support-box {
                width: 100%;
                max-width: 344px;
                min-width: 0;
            }

            .hero-copy,
            .feature-grid {
                width: 100%;
                max-width: 344px;
            }

            .feature-card {
                width: 100%;
                max-width: 100%;
            }

            .brand-mark {
                width: 38px;
                height: 38px;
                border-radius: 11px;
                font-size: 15px;
            }

            .brand-title {
                font-size: 16px;
            }

            .brand-caption {
                font-size: 11px;
            }

            .hero-copy {
                margin: 16px 0 0;
            }

            .eyebrow {
                min-height: 26px;
                padding: 0 10px;
                font-size: 11px;
                margin-bottom: 12px;
            }

            h1 {
                font-size: clamp(23px, 6.8vw, 29px);
                line-height: 1.12;
                max-width: 344px;
                margin-bottom: 8px;
            }

            .lead {
                font-size: 12px;
                line-height: 1.42;
                max-width: 344px;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .feature-card span {
                overflow-wrap: anywhere;
            }

            .form-panel {
                padding: 20px 24px 24px;
                overflow: hidden;
                align-items: center;
                justify-content: flex-start;
            }

            .form-panel,
            .form-header,
            .form-panel form {
                width: 100%;
                max-width: 344px;
            }

            .form-header {
                margin-bottom: 15px;
            }

            .form-badge {
                min-height: 24px;
                font-size: 11px;
                margin-bottom: 10px;
            }

            .form-header h2 {
                font-size: 22px;
                line-height: 1.18;
                margin-bottom: 6px;
            }

            .form-header p {
                font-size: 12.5px;
                line-height: 1.45;
                overflow-wrap: anywhere;
            }

            .alert {
                padding: 10px 12px;
                font-size: 12px;
                margin-bottom: 10px;
            }

            .field {
                margin-bottom: 11px;
            }

            .form-label {
                font-size: 12px;
                margin-bottom: 6px;
            }

            .input-wrap {
                min-height: 44px;
                border-radius: 11px;
                width: 100%;
                max-width: 100%;
            }

            .remember-row {
                margin: 0 0 15px;
            }

            .btn-submit {
                min-height: 46px;
            }

            .support-box {
                display: block;
                width: 100%;
                max-width: 344px;
                margin-top: 14px;
                padding: 10px 12px;
                font-size: 11.5px;
                line-height: 1.4;
                overflow: hidden;
            }

            .footer-info {
                display: none;
            }

            .auth-toast {
                left: 16px;
                right: 16px;
                top: 16px;
                width: auto;
            }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <section class="info-panel" aria-labelledby="page-title">
            <div class="brand">
                <div class="brand-mark">SP</div>
                <div>
                    <div class="brand-title">SIPMA</div>
                    <span class="brand-caption">Sistem Informasi Pengaduan Mahasiswa</span>
                </div>
            </div>

            <div class="hero-copy">
                <div class="eyebrow">Portal layanan kampus</div>
                <h1 id="page-title">Laporkan kendala kampus dengan lebih terarah.</h1>
                <p class="lead">
                    SIPMA membantu mahasiswa menyampaikan pengaduan akademik, administrasi, fasilitas, dan layanan kampus dalam satu alur yang rapi, tercatat, dan mudah dipantau.
                </p>
            </div>

            <div class="feature-grid" aria-label="Keunggulan sistem">
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M12 5v14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <strong>Ajukan laporan</strong>
                    <span>Pengaduan tersimpan lengkap dengan kategori dan lampiran.</span>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M4 6h16M4 12h10M4 18h7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <strong>Pantau status</strong>
                    <span>Setiap progres tindak lanjut dapat dipantau dari dashboard.</span>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 3 4 7v6c0 4 3 7 8 8 5-1 8-4 8-8V7l-8-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <strong>Akses aman</strong>
                    <span>Hak akses dipisahkan untuk mahasiswa, admin, dan pimpinan.</span>
                </div>
            </div>
        </section>

        <section class="form-panel" aria-labelledby="login-title">
            <div class="form-header">
                <span class="form-badge">Masuk ke sistem</span>
                <h2 id="login-title">Selamat datang kembali</h2>
                <p>Gunakan akun yang sudah terdaftar untuk mengakses dashboard pengaduan sesuai peran Anda.</p>
            </div>

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
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z" stroke="currentColor" stroke-width="2"/>
                            <path d="m6 8 6 5 6-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="email" id="email" name="email" class="form-input" placeholder="mahasiswa@example.com" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M6 10h12v9H6v-9Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M12 14v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan password" required autocomplete="current-password">
                    </div>
                </div>

                <div class="remember-row">
                    <label class="checkbox-container">
                        <input type="checkbox" name="remember">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit">Masuk</button>
            </form>

            <div class="support-box">
                <strong>Butuh bantuan?</strong> Hubungi admin akademik jika akun belum aktif atau Anda lupa kredensial login.
            </div>

            <div class="footer-info">
                <p>&copy; 2026 MPTI Kelompok Sigma.</p>
                <p>Uji coba: <code>mahasiswa@example.com</code> / <code>password</code></p>
            </div>
        </section>
    </main>

    @if(session('error') || $errors->any())
        <div class="auth-toast" id="authToast" role="alert" aria-live="assertive">
            <div class="toast-icon" aria-hidden="true">!</div>
            <div>
                <span class="toast-title">Login gagal</span>
                <div class="toast-message">
                    @if(session('error'))
                        {{ session('error') }}
                    @else
                        {{ $errors->first() }}
                    @endif
                </div>
            </div>
            <button type="button" class="toast-close" id="toastClose" aria-label="Tutup notifikasi">&times;</button>
        </div>
    @endif

    <script>
        (() => {
            const toast = document.getElementById('authToast');
            if (!toast) {
                return;
            }

            const close = document.getElementById('toastClose');
            window.setTimeout(() => toast.classList.add('is-visible'), 120);
            const hideToast = () => toast.classList.remove('is-visible');
            close?.addEventListener('click', hideToast);
            window.setTimeout(hideToast, 5200);
        })();
    </script>
</body>
</html>
