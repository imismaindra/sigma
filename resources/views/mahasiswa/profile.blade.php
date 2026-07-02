@extends('layouts.mahasiswa')

@section('title', 'Profil Mahasiswa')
@section('page_title', 'Profil Mahasiswa')
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
                </div>

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

                <div class="flex gap-2.5 justify-end pt-4 border-t border-slate-100 mt-5">
                    <button type="submit" class="btn-primary flex items-center justify-center gap-1.5 text-xs h-9 px-5"><i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan</button>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center justify-center gap-1.5 text-xs h-9 px-5">Kembali</a>
                </div>
            </form>
        </article>
    </section>
@endsection
