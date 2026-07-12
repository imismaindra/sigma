@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')
@section('page_title', 'Profil Mahasiswa')
@section('page_subtitle', 'Kelola identitas pelapor dan keamanan akun.')

@section('styles')
    .profile-shell {
        display: grid;
        gap: 18px;
    }

    .profile-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(260px, .6fr);
        gap: 18px;
        align-items: stretch;
    }

    .profile-card,
    .summary-grid,
    .identity-card,
    .form-card {
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.11), transparent 42%),
            var(--glass-bg);
        backdrop-filter: blur(22px);
        box-shadow: 0 24px 70px rgba(0,0,0,.2);
    }

    .profile-card {
        padding: 24px;
        display: flex;
        gap: 18px;
        align-items: center;
    }

    .avatar {
        width: 82px;
        height: 82px;
        border-radius: 26px;
        display: grid;
        place-items: center;
        flex: 0 0 auto;
        color: #03111f;
        background:
            radial-gradient(circle at 28% 18%, rgba(255,255,255,.7), transparent 25%),
            linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        font-size: 28px;
        font-weight: 900;
        box-shadow: 0 18px 36px color-mix(in srgb, var(--stock-green) 20%, transparent);
    }

    .profile-kicker {
        display: inline-flex;
        min-height: 30px;
        align-items: center;
        border-radius: 999px;
        padding: 0 11px;
        background: var(--primary-soft);
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 10px;
    }

    .profile-title {
        font-size: clamp(30px, 4.5vw, 48px);
        line-height: 1.02;
        letter-spacing: -.05em;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 8px;
    }

    .profile-subtitle {
        color: var(--muted);
        line-height: 1.6;
        font-size: 14px;
    }

    .summary-grid {
        padding: 14px;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .summary-item {
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 14px;
        background: var(--glass-bg-strong);
    }

    .summary-item span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .summary-item strong {
        display: block;
        margin-top: 8px;
        color: var(--text);
        font-size: 27px;
        line-height: 1;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: minmax(280px, 360px) minmax(0, 1fr);
        gap: 18px;
        align-items: start;
    }

    .identity-card,
    .form-card {
        padding: 20px;
    }

    .section-title {
        font-size: 17px;
        font-weight: 900;
        color: var(--text);
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
        gap: 11px;
    }

    .profile-item {
        padding: 13px;
        border-radius: 18px;
        background: var(--glass-bg-strong);
        border: 1px solid var(--glass-border);
    }

    .profile-item span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 5px;
    }

    .profile-item strong {
        display: block;
        font-size: 13px;
        color: var(--text);
        overflow-wrap: anywhere;
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
        font-weight: 900;
        margin-bottom: 7px;
    }

    .form-input {
        width: 100%;
        min-height: 46px;
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        background: var(--glass-bg-strong);
        color: var(--text);
        font-size: 13px;
        font-weight: 700;
        padding: 0 12px;
        outline: none;
    }

    .form-input:focus {
        border-color: color-mix(in srgb, var(--stock-blue) 56%, transparent);
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--stock-blue) 16%, transparent);
    }

    .password-note {
        grid-column: 1 / -1;
        padding: 13px;
        border-radius: 18px;
        background: var(--glass-bg-strong);
        border: 1px solid var(--glass-border);
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

    @media (max-width: 980px) {
        .profile-hero,
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .profile-card {
            align-items: flex-start;
            padding: 18px;
            border-radius: 24px;
        }

        .avatar {
            width: 62px;
            height: 62px;
            border-radius: 20px;
            font-size: 20px;
        }

        .summary-grid,
        .form-grid {
            grid-template-columns: 1fr;
        }

        .identity-card,
        .form-card {
            padding: 18px;
            border-radius: 24px;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    <section class="profile-shell">
        <section class="profile-hero">
            <article class="profile-card">
                <div class="avatar">{{ strtoupper(\Illuminate\Support\Str::substr($user->nama, 0, 1)) }}</div>
                <div>
                    <div class="profile-kicker">Account Settings</div>
                    <h1 class="profile-title">{{ $user->nama }}</h1>
                    <p class="profile-subtitle">Kelola identitas akun yang digunakan untuk membuat dan memantau pengaduan kampus.</p>
                </div>
            </article>

            <aside class="summary-grid" aria-label="Ringkasan pengaduan">
                <div class="summary-item"><span>Total</span><strong>{{ $summary['total'] }}</strong></div>
                <div class="summary-item"><span>Pending</span><strong>{{ $summary['pending'] }}</strong></div>
                <div class="summary-item"><span>Proses</span><strong>{{ $summary['proses'] }}</strong></div>
                <div class="summary-item"><span>Selesai</span><strong>{{ $summary['selesai'] }}</strong></div>
            </aside>
        </section>

        <section class="profile-grid">
            <aside class="identity-card">
                <div class="section-title">Data Saat Ini</div>
                <p class="section-subtitle">Informasi ini tampil sebagai identitas pelapor di sistem.</p>

                <div class="profile-list">
                    <div class="profile-item"><span>NIM</span><strong>{{ $user->nim_nip ?: '-' }}</strong></div>
                    <div class="profile-item"><span>Nama Lengkap</span><strong>{{ $user->nama }}</strong></div>
                    <div class="profile-item"><span>Email</span><strong>{{ $user->email }}</strong></div>
                    <div class="profile-item"><span>Nomor Telepon</span><strong>{{ $user->nomor_telepon ?: '-' }}</strong></div>
                    <div class="profile-item"><span>Jurusan</span><strong>{{ $user->jurusan ?: '-' }}</strong></div>
                </div>
            </aside>

            <article class="form-card">
                <div class="section-title">Edit Profil</div>
                <p class="section-subtitle">Perbarui data mahasiswa. Kosongkan password jika tidak ingin mengganti password.</p>

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

                        <div class="password-note">Untuk mengganti password, isi password saat ini, password baru, dan konfirmasi password baru.</div>

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
    </section>
@endsection
