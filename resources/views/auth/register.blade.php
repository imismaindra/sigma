<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa - Sistem Informasi Pengaduan Mahasiswa</title>
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
            --shadow: 0 18px 42px rgba(15, 23, 42, 0.1);
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
            height: 100%;
            overflow: hidden;
        }

        body {
            height: 100dvh;
            color: var(--text);
            background:
                linear-gradient(135deg, #eef4ff 0%, var(--bg) 48%, #f6fbfa 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
            overflow: hidden;
        }

        .register-page {
            width: min(100%, 1120px);
            height: min(680px, calc(100dvh - 64px));
            min-height: 0;
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(430px, 500px);
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .info-panel {
            position: relative;
            min-height: 0;
            padding: clamp(26px, 3.5vw, 40px);
            color: #ffffff;
            background: linear-gradient(145deg, #1e3a8a, #2563eb);
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
            background: rgba(204, 251, 241, 0.14);
        }

        .brand,
        .hero-copy,
        .feature-list {
            position: relative;
            z-index: 1;
        }

        .brand {
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
            max-width: 520px;
            margin: clamp(32px, 6vh, 62px) 0;
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
            font-size: clamp(32px, 4vw, 50px);
            line-height: 1.02;
            letter-spacing: 0;
            margin-bottom: 14px;
        }

        .lead {
            color: rgba(255, 255, 255, 0.78);
            font-size: 14px;
            line-height: 1.6;
        }

        .feature-list {
            display: grid;
            gap: 10px;
        }

        .feature-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 12px;
            border-radius: 14px;
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
            flex: 0 0 auto;
        }

        .feature-item strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .feature-item span {
            display: block;
            color: rgba(255, 255, 255, 0.68);
            font-size: 12px;
            line-height: 1.45;
        }

        .form-panel {
            background: var(--surface);
            min-height: 0;
            overflow: hidden;
            padding: clamp(26px, 3.3vw, 38px);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 16px;
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
            font-weight: 800;
            margin-bottom: 10px;
        }

        .form-header h2 {
            font-size: 26px;
            line-height: 1.2;
            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.45;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            line-height: 1.45;
            margin-bottom: 16px;
            background: var(--danger-soft);
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px 12px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .field {
            min-width: 0;
        }

        .form-label {
            display: block;
            color: var(--text);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 44px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface-soft);
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .input-wrap:focus-within {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
        }

        .input-icon {
            width: 17px;
            height: 17px;
            margin-left: 12px;
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
            font-size: 13px;
            font-weight: 500;
            padding: 0 12px 0 9px;
        }

        .form-input:-webkit-autofill,
        .form-input:-webkit-autofill:hover, 
        .form-input:-webkit-autofill:focus, 
        .form-input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px var(--surface-soft) inset !important;
            -webkit-text-fill-color: var(--text) !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .input-wrap:focus-within .form-input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .btn-submit {
            width: 100%;
            min-height: 44px;
            border: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            color: #ffffff;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 18px rgba(37, 99, 235, 0.2);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            margin-top: 14px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 22px rgba(37, 99, 235, 0.24);
        }

        .auth-switch {
            margin-top: 12px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.55;
        }

        .auth-switch a {
            color: var(--primary-dark);
            font-weight: 800;
            text-decoration: none;
        }

        .auth-switch a:hover {
            text-decoration: underline;
        }

        .support-box {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 11px;
            line-height: 1.45;
        }

        .support-box strong {
            color: var(--text);
        }

        @media (max-width: 920px) {
            html {
                overflow: auto;
                height: auto;
            }

            body {
                height: auto;
                min-height: 100dvh;
                padding: 24px 16px;
                overflow-y: auto;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .register-page {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
                width: 100%;
                max-width: 500px;
                height: auto;
                border-radius: 20px;
                border: 1px solid rgba(226, 232, 240, 0.9);
                box-shadow: var(--shadow);
                position: relative;
                inset: auto;
            }

            .info-panel {
                padding: 32px 24px;
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                justify-content: center;
                min-height: auto;
                width: 100%;
                max-width: 100%;
            }

            .info-panel::after {
                display: none;
            }

            .brand {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 8px;
                width: 100%;
            }

            .brand-mark {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                font-size: 16px;
            }

            .brand-title {
                font-size: 17px;
            }

            .brand-caption {
                font-size: 11px;
            }

            .hero-copy {
                margin: 20px 0 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                max-width: 100%;
            }

            .eyebrow {
                align-self: center;
                min-height: 26px;
                padding: 0 10px;
                font-size: 11px;
                margin-bottom: 12px;
            }

            h1 {
                font-size: 24px;
                line-height: 1.15;
                margin-bottom: 10px;
                text-align: center;
                max-width: 100%;
            }

            .lead {
                font-size: 13px;
                line-height: 1.5;
                text-align: center;
                max-width: 100%;
            }

            .feature-list {
                display: none;
            }

            .form-panel {
                padding: 32px 24px;
                align-items: center;
                justify-content: center;
                width: 100%;
                max-width: 100%;
                background: var(--surface);
            }

            .form-header,
            .alert,
            .form-panel form,
            .support-box,
            .auth-switch {
                width: 100%;
                max-width: 100%;
            }

            .form-header {
                margin-bottom: 18px;
            }

            .form-badge {
                min-height: 24px;
                font-size: 11px;
                margin-bottom: 10px;
            }

            .form-header h2 {
                font-size: 22px;
                line-height: 1.2;
                margin-bottom: 6px;
            }

            .form-header p {
                font-size: 13px;
                line-height: 1.5;
            }

            .form-grid {
                gap: 10px 12px;
            }

            .alert {
                padding: 10px 12px;
                font-size: 12.5px;
                margin-bottom: 12px;
            }

            .field {
                margin-bottom: 2px;
            }

            .form-label {
                font-size: 12.5px;
                margin-bottom: 6px;
            }

            .input-wrap {
                min-height: 44px;
                border-radius: 11px;
            }

            .btn-submit {
                min-height: 46px;
            }

            .support-box {
                margin-top: 14px;
                padding: 10px 12px;
                font-size: 12px;
                line-height: 1.45;
            }
        }

        @media (max-width: 620px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .form-header p {
                display: none;
            }
        }
    </style>
</head>
<body>
    <main class="register-page">
        <section class="info-panel" aria-labelledby="page-title">
            <div class="brand">
                <div class="brand-mark">SP</div>
                <div>
                    <div class="brand-title">SIPMA</div>
                    <span class="brand-caption">Sistem Informasi Pengaduan Mahasiswa</span>
                </div>
            </div>

            <div class="hero-copy">
                <div class="eyebrow">Registrasi mahasiswa</div>
                <h1 id="page-title">Buat akun untuk mulai melapor.</h1>
                <p class="lead">
                    Lengkapi data akademik Anda agar setiap pengaduan tercatat dengan identitas yang jelas dan mudah ditindaklanjuti oleh pihak kampus.
                </p>
            </div>

            <div class="feature-list" aria-label="Alur registrasi">
                <div class="feature-item">
                    <div class="feature-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <strong>Identitas lengkap</strong>
                        <span>NIM, nama, email, telepon, dan jurusan tersimpan dalam profil akun.</span>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M12 3 4 7v6c0 4 3 7 8 8 5-1 8-4 8-8V7l-8-4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <strong>Akun mahasiswa</strong>
                        <span>Setelah daftar, akses langsung diarahkan ke dashboard pengaduan mahasiswa.</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="form-panel" aria-labelledby="register-title">
            <div class="form-header">
                <span class="form-badge">Daftar akun</span>
                <h2 id="register-title">Registrasi mahasiswa</h2>
                <p>Gunakan data yang sesuai dengan identitas akademik Anda.</p>
            </div>

            @if($errors->any())
                <div class="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <div class="field">
                        <label for="nim" class="form-label">NIM</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 4h10v16H7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M10 8h4M10 12h4M10 16h2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <input type="text" id="nim" name="nim" class="form-input" placeholder="06.2023.1.07661" value="{{ old('nim') }}" required autocomplete="username" inputmode="numeric" pattern="\d{2}\.\d{4}\.\d\.\d{5}" title="Format NIM: 06.2023.1.07661">
                        </div>
                    </div>

                    <div class="field">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM4 21a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <input type="text" id="nama" name="nama" class="form-input" placeholder="Nama sesuai data kampus" value="{{ old('nama') }}" required autocomplete="name">
                        </div>
                    </div>

                    <div class="field field-full">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 7.5A2.5 2.5 0 0 1 6.5 5h11A2.5 2.5 0 0 1 20 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 16.5v-9Z" stroke="currentColor" stroke-width="2"/>
                                <path d="m6 8 6 5 6-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="email" id="email" name="email" class="form-input" placeholder="nama@student.ac.id" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="field">
                        <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 4h10v16H7V4Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M11 17h2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <input type="tel" id="nomor_telepon" name="nomor_telepon" class="form-input" placeholder="081234567890" value="{{ old('nomor_telepon') }}" required autocomplete="tel">
                        </div>
                    </div>

                    <div class="field">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M4 10 12 5l8 5-8 5-8-5Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="M6 12v4c2 2 10 2 12 0v-4" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                            <input type="text" id="jurusan" name="jurusan" class="form-input" placeholder="Teknik Informatika" value="{{ old('jurusan') }}" required autocomplete="organization-title">
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
                            <input type="password" id="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="field">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M7 10V8a5 5 0 0 1 10 0v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M6 10h12v9H6v-9Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                <path d="m10 15 1.5 1.5L15 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Ulangi password" required autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Daftar sebagai Mahasiswa</button>
            </form>

            <div class="auth-switch">
                Sudah punya akun?
                <a href="{{ route('login') }}">Masuk ke sistem</a>
            </div>

            <div class="support-box">
                <strong>Catatan:</strong> Akun baru otomatis menggunakan peran mahasiswa dan dapat langsung membuat pengaduan setelah registrasi berhasil.
            </div>
        </section>
    </main>
    @include('partials.toast')
</body>
</html>
