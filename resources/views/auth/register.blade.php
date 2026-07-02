<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/60">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa - Sistem Informasi Pengaduan Mahasiswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="min-h-full flex items-center justify-center p-4 sm:p-6 lg:p-8 relative overflow-x-hidden">

    <!-- Glowing lights background (Mesh Glow) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[30%] -left-[20%] w-[80%] h-[80%] rounded-full bg-gradient-to-tr from-indigo-200/30 to-violet-200/35 blur-[130px]"></div>
        <div class="absolute -bottom-[30%] -right-[20%] w-[80%] h-[80%] rounded-full bg-gradient-to-br from-blue-200/25 to-purple-200/30 blur-[130px]"></div>
    </div>

    <!-- Register Page Card Container -->
    <main class="relative z-10 w-full max-w-5xl bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:grid md:grid-cols-12 min-h-[620px] transform hover:shadow-indigo-500/5 transition-all duration-500">
        
        <!-- Left Panel: Information & Features (Mesh background gradient) -->
        <section class="md:col-span-5 bg-gradient-to-br from-indigo-900 via-indigo-950 to-violet-950 p-8 sm:p-12 text-white flex flex-col justify-between relative overflow-hidden">
            <!-- Background grids -->
            <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)] bg-[size:32px_32px]"></div>
            <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>

            <!-- Brand Header -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-white to-indigo-100 text-indigo-950 flex items-center justify-center font-black text-base shadow-lg shadow-black/10">
                    SP
                </div>
                <div>
                    <h2 class="text-sm font-extrabold tracking-tight leading-none">SIPMA</h2>
                    <p class="text-[9px] text-indigo-300 font-bold tracking-wider uppercase mt-1">Sistem Pengaduan Mahasiswa</p>
                </div>
            </div>

            <!-- Hero Headline -->
            <div class="relative z-10 my-12 md:my-0 flex-1 flex flex-col justify-center max-w-sm">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold tracking-wider uppercase w-fit mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-300 animate-pulse"></span>
                    Registrasi Akun Baru
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold leading-tight tracking-tight mb-4">
                    Buat akun untuk mulai melapor.
                </h1>
                <p class="text-xs sm:text-sm text-indigo-200/90 leading-relaxed font-medium">
                    Lengkapi data akademik Anda agar setiap pengaduan tercatat dengan identitas pelapor yang sah dan memudahkan koordinasi pemecahan masalah dengan unit kerja kampus.
                </p>
            </div>

            <!-- Features list -->
            <div class="relative z-10 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-indigo-200 flex-shrink-0 border border-white/5">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs text-indigo-100 font-bold">Data Akademik Terverifikasi</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-indigo-200 flex-shrink-0 border border-white/5">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs text-indigo-100 font-bold">Akses Instan ke Portal Dashboard</span>
                </div>
            </div>
        </section>

        <!-- Right Panel: Registration Form -->
        <section class="md:col-span-7 p-8 sm:p-12 flex flex-col justify-center bg-white/50 backdrop-blur-md">
            <div class="w-full">
                <div class="mb-6">
                    <span class="text-[10px] font-extrabold text-indigo-600 uppercase tracking-widest bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-md">DAFTAR MAHASISWA</span>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-3">Registrasi Akun Mahasiswa</h2>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Gunakan data yang valid sesuai dengan identitas akademik Anda di kampus.</p>
                </div>

                @if($errors->any())
                    <div class="p-3.5 mb-4 text-xs font-semibold text-rose-700 bg-rose-50 border border-rose-100 rounded-xl space-y-1">
                        @foreach ($errors->all() as $error)
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600 flex-shrink-0"></span>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Register Form -->
                <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nim" class="block text-xs font-bold text-slate-700 mb-1.5">NIM (Nomor Induk Mahasiswa)</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="nim" name="nim" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="06.2023.1.07661" value="{{ old('nim') }}" required autocomplete="username" inputmode="numeric" pattern="\d{2}\.\d{4}\.\d\.\d{5}" title="Format NIM: 06.2023.1.07661">
                            </div>
                        </div>

                        <div>
                            <label for="nama" class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="user" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="nama" name="nama" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="Nama Lengkap" value="{{ old('nama') }}" required autocomplete="name">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_telepon" class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Telepon</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                </div>
                                <input type="tel" id="nomor_telepon" name="nomor_telepon" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="081234567890" value="{{ old('nomor_telepon') }}" required autocomplete="tel">
                            </div>
                        </div>

                        <div>
                            <label for="jurusan" class="block text-xs font-bold text-slate-700 mb-1.5">Jurusan</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </div>
                                <input type="text" id="jurusan" name="jurusan" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="Teknik Informatika" value="{{ old('jurusan') }}" required autocomplete="organization-title">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">Email Akademik</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <input type="email" id="email" name="email" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="nama@student.ac.id" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="lock" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="password" name="password" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="Min. 8 karakter" required autocomplete="new-password">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 mb-1.5">Konfirmasi Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="Ulangi password" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full h-11 rounded-xl bg-indigo-600 text-xs font-bold text-white hover:bg-indigo-750 shadow-md shadow-indigo-650/15 hover:shadow-lg hover:shadow-indigo-650/20 active:translate-y-px transition-all cursor-pointer">
                        Daftar Akun
                    </button>
                </form>

                <div class="mt-6 text-center text-xs font-medium text-slate-650">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-extrabold hover:underline">Masuk sekarang</a>
                </div>

                <div class="mt-8 text-center text-[10px] text-slate-400 space-y-1">
                    <p>&copy; 2026 MPTI Kelompok Sigma - Sistem Informasi Pengaduan Mahasiswa.</p>
                </div>
            </div>
        </section>
    </main>

    @include('partials.toast')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
