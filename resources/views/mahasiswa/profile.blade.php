<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - Sistem Informasi Pengaduan Mahasiswa</title>
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
            --success: #16a34a;
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
            max-width: 1180px;
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

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 0 0 auto;
        }

        .btn-nav,
        .btn-logout {
            min-height: 36px;
            border-radius: 8px;
            padding: 0 12px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav {
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--primary-dark);
        }

        .btn-nav:hover {
            background: #eff6ff;
        }

        .btn-logout {
            border: 1px solid #fecaca;
            background: #fff7f7;
            color: #b91c1c;
        }

        .btn-logout:hover {
            background: #fee2e2;
        }

        .container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 26px 24px 44px;
        }

        .profile-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 22px;
            align-items: stretch;
            margin-bottom: 18px;
        }

        .hero-card,
        .identity-card,
        .form-card {
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 14px;
            box-shadow: var(--shadow);
        }

        .hero-card {
            padding: 26px;
            display: flex;
            gap: 18px;
            align-items: center;
            min-width: 0;
        }

        .avatar {
            width: 76px;
            height: 76px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
            flex: 0 0 auto;
        }

        .hero-copy {
            min-width: 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        h1 {
            font-size: clamp(28px, 3.6vw, 42px);
            line-height: 1.08;
            letter-spacing: 0;
            margin-bottom: 8px;
        }

        .hero-copy p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .summary-card {
            min-width: 310px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .summary-item {
            padding: 16px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid var(--border);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .summary-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .summary-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(280px, 360px) minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .identity-card {
            padding: 20px;
        }

        .section-title {
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .section-subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
            margin-bottom: 18px;
        }

        .profile-list {
            display: grid;
            gap: 12px;
        }

        .profile-item {
            padding: 13px;
            border-radius: 12px;
            background: var(--surface-soft);
            border: 1px solid var(--border);
        }

        .profile-item span {
            display: block;
            color: var(--muted);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0;
            margin-bottom: 5px;
        }

        .profile-item strong {
            display: block;
            font-size: 13px;
            color: var(--text);
            overflow-wrap: anywhere;
        }

        .form-card {
            padding: 22px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            color: var(--text);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 7px;
        }

        .form-input {
            width: 100%;
            min-height: 44px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface-soft);
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            padding: 0 12px;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        .form-input:focus {
            border-color: #60a5fa;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.12);
        }

        .password-note {
            grid-column: 1 / -1;
            padding: 12px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 12px;
            line-height: 1.55;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 18px;
        }

        .btn-primary,
        .btn-secondary {
            min-height: 44px;
            border-radius: 10px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-primary {
            border: 0;
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), #2563eb);
            box-shadow: 0 12px 22px rgba(37, 99, 235, 0.22);
        }

        .btn-secondary {
            border: 1px solid var(--border);
            color: var(--primary-dark);
            background: #ffffff;
        }

        .logout-modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            display: none;
            place-items: center;
            background: rgba(15, 23, 42, 0.46);
            padding: 18px;
        }

        .logout-modal.is-open {
            display: grid;
        }

        .logout-modal-content {
            width: min(100%, 380px);
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid var(--border);
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.24);
            padding: 22px;
        }

        .logout-modal-content h3 {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .logout-modal-content p {
            font-size: 14px;
            color: var(--muted);
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
            min-height: 44px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 800;
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
        }

        @media (max-width: 900px) {
            .profile-hero,
            .profile-grid {
                grid-template-columns: 1fr;
            }

            .summary-card {
                min-width: 0;
            }
        }

        @media (max-width: 640px) {
            .navbar-inner {
                min-height: auto;
                padding: 12px 16px;
                align-items: flex-start;
            }

            .brand span {
                white-space: normal;
            }

            .navbar-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .btn-nav,
            .btn-logout {
                min-height: 34px;
                padding: 0 10px;
            }

            .container {
                padding: 18px 16px 28px;
            }

            .hero-card {
                padding: 18px;
                align-items: flex-start;
            }

            .avatar {
                width: 58px;
                height: 58px;
                border-radius: 14px;
                font-size: 18px;
            }

            .summary-card,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-card,
            .identity-card {
                padding: 18px;
            }

            .form-actions {
                display: grid;
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('mahasiswa.dashboard') }}" class="brand">
                <span class="brand-mark">SP</span>
                <span>
                    <strong>SIPMA</strong>
                    <span>Sistem Informasi Pengaduan Mahasiswa</span>
                </span>
            </a>

            <div class="navbar-actions">
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-nav">Dashboard</a>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="btn-logout" id="btnTriggerLogout">Logout</button>
            </div>
        </div>
    </nav>

    <main class="container">
        <section class="profile-hero">
            <article class="hero-card">
                <div class="avatar">{{ strtoupper(\Illuminate\Support\Str::substr($user->nama, 0, 1)) }}</div>
                <div class="hero-copy">
                    <div class="eyebrow">Profil mahasiswa</div>
                    <h1>{{ $user->nama }}</h1>
                    <p>Kelola identitas akun yang digunakan untuk membuat dan memantau pengaduan kampus.</p>
                </div>
            </article>

            <aside class="summary-card" aria-label="Ringkasan pengaduan">
                <div class="summary-item">
                    <div class="summary-label">Total</div>
                    <div class="summary-value">{{ $summary['total'] }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Pending</div>
                    <div class="summary-value">{{ $summary['pending'] }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Proses</div>
                    <div class="summary-value">{{ $summary['proses'] }}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Selesai</div>
                    <div class="summary-value">{{ $summary['selesai'] }}</div>
                </div>
            </aside>
        </section>

        <section class="profile-grid">
            <aside class="identity-card">
                <div class="section-title">Data Saat Ini</div>
                <p class="section-subtitle">Informasi ini tampil sebagai identitas pelapor di sistem.</p>

                <div class="profile-list">
                    <div class="profile-item">
                        <span>NIM</span>
                        <strong>{{ $user->nim_nip ?: '-' }}</strong>
                    </div>
                    <div class="profile-item">
                        <span>Nama Lengkap</span>
                        <strong>{{ $user->nama }}</strong>
                    </div>
                    <div class="profile-item">
                        <span>Email</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div class="profile-item">
                        <span>Nomor Telepon</span>
                        <strong>{{ $user->nomor_telepon ?: '-' }}</strong>
                    </div>
                    <div class="profile-item">
                        <span>Jurusan</span>
                        <strong>{{ $user->jurusan ?: '-' }}</strong>
                    </div>
                </div>
            </aside>

            <article class="form-card">
                <div class="section-title">Edit Profil</div>
                <p class="section-subtitle">Perbarui data mahasiswa. Kosongkan bagian password jika tidak ingin mengganti password.</p>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <form action="{{ route('mahasiswa.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div>
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" id="nim" name="nim" class="form-input" value="{{ old('nim', $user->nim_nip) }}" placeholder="06.2023.1.07661" required pattern="\d{2}\.\d{4}\.\d\.\d{5}" title="Format NIM: 06.2023.1.07661">
                        </div>

                        <div>
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-input" value="{{ old('nama', $user->nama) }}" required>
                        </div>

                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div>
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="tel" id="nomor_telepon" name="nomor_telepon" class="form-input" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" placeholder="081234567890" required>
                        </div>

                        <div class="field-full">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" class="form-input" value="{{ old('jurusan', $user->jurusan) }}" placeholder="Teknik Informatika" required>
                        </div>

                        <div class="password-note">
                            Untuk mengganti password, isi password saat ini, password baru, dan konfirmasi password baru.
                        </div>

                        <div>
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" class="form-input" autocomplete="current-password">
                        </div>

                        <div>
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-input" autocomplete="new-password">
                        </div>

                        <div class="field-full">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Kembali</a>
                        <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </article>
        </section>
    </main>

    <div class="logout-modal" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="logout-modal-content">
            <h3 id="modalTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari Sistem Informasi Pengaduan Mahasiswa?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelLogout">Batal</button>
                <button type="button" class="btn-modal-confirm" id="btnConfirmLogout">Keluar</button>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const btnTrigger = document.getElementById('btnTriggerLogout');
            const modal = document.getElementById('logoutModal');
            const btnCancel = document.getElementById('btnCancelLogout');
            const btnConfirm = document.getElementById('btnConfirmLogout');
            const form = document.getElementById('logoutForm');

            if (!btnTrigger || !modal || !form) {
                return;
            }

            btnTrigger.addEventListener('click', () => modal.classList.add('is-open'));
            btnCancel?.addEventListener('click', () => modal.classList.remove('is-open'));
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.classList.remove('is-open');
                }
            });
            btnConfirm?.addEventListener('click', () => form.submit());
        })();
    </script>
    @include('partials.toast')
</body>
</html>
