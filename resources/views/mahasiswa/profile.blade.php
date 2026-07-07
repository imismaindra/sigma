@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')
@section('page_title', 'Profil Mahasiswa')
<<<<<<< HEAD
@section('page_subtitle', 'Perbarui informasi akademik, nomor telepon, dan ubah password akun Anda.')

@section('content')
    <!-- Profile Hero Card -->
    <section class="profile-hero bg-gradient-to-tr from-white to-slate-50/50 border border-slate-200/80 rounded-2xl p-6 lg:p-7 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative overflow-hidden mb-6">
        <div class="absolute -right-20 -bottom-20 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        
        <div class="flex items-center gap-4.5 relative z-10">
            <div class="w-16 h-16 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-extrabold text-2xl shadow-lg shadow-indigo-500/20">
                {{ strtoupper(substr($user->nama, 0, 2)) }}
            </div>
            <div>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-indigo-50 border border-indigo-100 text-[9px] font-extrabold text-indigo-650 uppercase mb-1">
                    <i data-lucide="user" class="w-3 h-3"></i>
                    Pelapor Aktif
                </span>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight">{{ $user->nama }}</h1>
                <p class="text-xs text-slate-450 font-bold tracking-wide uppercase mt-0.5">{{ $user->nim_nip ?: 'NIM Belum Terdaftar' }}</p>
            </div>
        </div>

        <aside class="summary-card flex gap-4.5 bg-white border border-slate-200/80 rounded-xl p-4.5 shadow-3xs z-10" aria-label="Ringkasan pengaduan">
            <div class="text-center px-3.5">
                <div class="summary-label text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Laporan</div>
                <div class="summary-value text-lg font-black text-slate-800">{{ $summary['total'] }}</div>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div class="text-center px-3.5">
                <div class="summary-label text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pending</div>
                <div class="summary-value text-lg font-black text-amber-600">{{ $summary['pending'] }}</div>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div class="text-center px-3.5">
                <div class="summary-label text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Diproses</div>
                <div class="summary-value text-lg font-black text-blue-600">{{ $summary['proses'] }}</div>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div class="text-center px-3.5">
                <div class="summary-label text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Selesai</div>
                <div class="summary-value text-lg font-black text-emerald-650">{{ $summary['selesai'] }}</div>
            </div>
        </aside>
    </section>

    <!-- Error/Success Alerts -->
    @if(session('success'))
        <div class="alert alert-success flex items-center gap-2 mb-6">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
=======
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
>>>>>>> origin/Abiyyu-dev

    @if($errors->any())
        <div class="alert alert-danger flex flex-col gap-1.5 mb-6">
            <div class="font-extrabold flex items-center gap-1.5"><i data-lucide="alert-octagon" class="w-4 h-4"></i> Periksa kembali isian form Anda:</div>
            <ul class="pl-5 list-disc text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<<<<<<< HEAD
    <!-- Profile Grid Columns -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 relative z-10">
        
        <!-- Left: Current Profile Details -->
        <aside class="lg:col-span-4 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs space-y-4">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <i data-lucide="info" class="w-4.5 h-4.5 text-indigo-650"></i> Identitas Saat Ini
            </h3>
            
            <div class="space-y-3.5">
                <div class="p-3 bg-slate-50 border border-slate-150/70 rounded-xl space-y-0.5">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Nomor Induk Mahasiswa (NIM)</span>
                    <p class="text-xs font-bold text-slate-800">{{ $user->nim_nip ?: '-' }}</p>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-150/70 rounded-xl space-y-0.5">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Nama Lengkap Pelapor</span>
                    <p class="text-xs font-bold text-slate-800">{{ $user->nama }}</p>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-150/70 rounded-xl space-y-0.5">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Alamat Email Kampus</span>
                    <p class="text-xs font-bold text-slate-800">{{ $user->email }}</p>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-150/70 rounded-xl space-y-0.5">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Nomor Handphone Aktif</span>
                    <p class="text-xs font-bold text-slate-800">{{ $user->nomor_telepon ?: '-' }}</p>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-150/70 rounded-xl space-y-0.5">
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Jurusan / Program Studi</span>
                    <p class="text-xs font-bold text-slate-800">{{ $user->jurusan ?: '-' }}</p>
                </div>
            </div>
        </aside>

        <!-- Right: Edit Profile Form -->
        <article class="lg:col-span-8 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4.5 flex items-center gap-2">
                <i data-lucide="edit-3" class="w-4.5 h-4.5 text-indigo-650"></i> Formulir Perbarui Data
            </h3>

            <form action="{{ route('mahasiswa.profile.update') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nim" class="form-label">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" id="nim" name="nim" class="form-input font-semibold" value="{{ old('nim', $user->nim_nip) }}" placeholder="Contoh: 06.2023.1.07661" required pattern="\d{2}\.\d{4}\.\d\.\d{5}" title="Format NIM: 06.2023.1.07661">
                    </div>

                    <div>
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-input font-semibold" value="{{ old('nama', $user->nama) }}" required>
                    </div>

                    <div>
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" id="email" name="email" class="form-input font-semibold" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div>
                        <label for="nomor_telepon" class="form-label">Nomor Telepon WA</label>
                        <input type="tel" id="nomor_telepon" name="nomor_telepon" class="form-input font-semibold" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" placeholder="Contoh: 081234567890" required>
                    </div>
=======
                <div class="profile-list">
                    <div class="profile-item"><span>NIM</span><strong>{{ $user->nim_nip ?: '-' }}</strong></div>
                    <div class="profile-item"><span>Nama Lengkap</span><strong>{{ $user->nama }}</strong></div>
                    <div class="profile-item"><span>Email</span><strong>{{ $user->email }}</strong></div>
                    <div class="profile-item"><span>Nomor Telepon</span><strong>{{ $user->nomor_telepon ?: '-' }}</strong></div>
                    <div class="profile-item"><span>Jurusan</span><strong>{{ $user->jurusan ?: '-' }}</strong></div>
>>>>>>> origin/Abiyyu-dev
                </div>

<<<<<<< HEAD
                <div>
                    <label for="jurusan" class="form-label">Jurusan / Program Studi</label>
                    <input type="text" id="jurusan" name="jurusan" class="form-input font-semibold" value="{{ old('jurusan', $user->jurusan) }}" placeholder="Contoh: Teknik Informatika" required>
                </div>

                <!-- Password block separator -->
                <div class="pt-4 border-t border-slate-100 mt-5">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-3">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                        Ubah Password Akun
                    </span>
                    <p class="text-[10.5px] text-slate-500 mb-4 leading-normal">Untuk mengganti password, isi password lama saat ini beserta password baru dan konfirmasi password baru secara lengkap. Kosongkan isian di bawah jika tetap menggunakan password saat ini.</p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label for="current_password" class="form-label">Password Lama Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" class="form-input font-medium" autocomplete="current-password" placeholder="Masukkan password saat ini">
=======
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
>>>>>>> origin/Abiyyu-dev
                        </div>

                        <div>
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-input font-medium" autocomplete="new-password" placeholder="Min. 8 karakter">
                        </div>

                        <div>
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input font-medium" autocomplete="new-password" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
                <div class="flex gap-2.5 justify-end pt-4 border-t border-slate-100 mt-5">
                    <button type="submit" class="btn-primary flex items-center justify-center gap-1.5 text-xs h-9 px-5"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center justify-center gap-1.5 text-xs h-9 px-5">Kembali</a>
                </div>
            </form>
        </article>
=======
                    <div class="form-actions">
                        <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Kembali</a>
                        <button type="submit" class="btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </article>
        </section>
>>>>>>> origin/Abiyyu-dev
    </section>
@endsection
