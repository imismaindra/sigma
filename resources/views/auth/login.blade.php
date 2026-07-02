<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/60">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Pengaduan Mahasiswa</title>
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

    <!-- Login Page Card Container -->
    <main class="relative z-10 w-full max-w-5xl bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:grid md:grid-cols-12 min-h-[600px] transform hover:shadow-indigo-500/5 transition-all duration-500">
        
        <!-- Left Panel: Information & Features (Mesh background gradient) -->
        <section class="md:col-span-6 bg-gradient-to-br from-indigo-900 via-indigo-950 to-violet-950 p-8 sm:p-12 text-white flex flex-col justify-between relative overflow-hidden">
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
            <div class="relative z-10 my-12 md:my-0 flex-1 flex flex-col justify-center max-w-md">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold tracking-wider uppercase w-fit mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-300 animate-pulse"></span>
                    Portal Layanan Kampus
                </span>
                <h1 class="text-2xl sm:text-3.5xl font-extrabold leading-tight tracking-tight mb-4">
                    Laporkan kendala kampus dengan lebih terarah.
                </h1>
                <p class="text-xs sm:text-sm text-indigo-200/90 leading-relaxed font-medium">
                    SIPMA membantu mahasiswa menyampaikan kendala akademik, fasilitas, administrasi, dan IT dalam satu alur yang terpusat, rapi, dan mudah dipantau penyelesaiannya.
                </p>
            </div>

            <!-- Features list (Hidden on small mobile height if screen gets super short) -->
            <div class="relative z-10 space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-indigo-200 flex-shrink-0 mt-0.5 border border-white/5">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white mb-0.5">Ajukan Laporan Mudah</h4>
                        <p class="text-[11px] text-indigo-200/80">Kirim laporan dengan kategori yang sesuai serta dukung dengan lampiran dokumen.</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center text-indigo-200 flex-shrink-0 mt-0.5 border border-white/5">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white mb-0.5">Notifikasi & Log Progres</h4>
                        <p class="text-[11px] text-indigo-200/80">Dapatkan tanggapan real-time dan lacak pemindahan status laporan Anda secara transparan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Right Panel: Login Form -->
        <section class="md:col-span-6 p-8 sm:p-12 flex flex-col justify-center bg-white/50 backdrop-blur-md">
            <div class="w-full max-w-sm mx-auto">
                <div class="mb-8">
                    <span class="text-[10px] font-extrabold text-indigo-600 uppercase tracking-widest bg-indigo-50 border border-indigo-100 px-2.5 py-0.5 rounded-md">MASUK SISTEM</span>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-3">Selamat datang kembali</h2>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Gunakan kredensial akun terdaftar untuk mengakses dashboard pengaduan.</p>
                </div>

                <!-- Alert Messages -->
                @if(session('success'))
                    <div class="p-3.5 mb-4 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3.5 mb-4 text-xs font-semibold text-rose-700 bg-rose-50 border border-rose-100 rounded-xl flex items-center gap-2">
                        <i data-lucide="alert-octagon" class="w-4 h-4 flex-shrink-0"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

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

                <!-- Login Form -->
                <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </div>
                            <input type="email" id="email" name="email" class="block w-full h-11 pl-10 pr-4 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="nama@mahasiswa.ac.id" value="{{ old('email') }}" required autocomplete="email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-650 transition-colors">
                                <i data-lucide="lock" class="w-4 h-4"></i>
                            </div>
                            <input type="password" id="password" name="password" class="block w-full h-11 pl-10 pr-10 text-xs bg-slate-50/50 border border-slate-200 rounded-xl focus:bg-white focus:border-indigo-600 focus:ring-3 focus:ring-indigo-500/10 outline-none text-slate-900 transition-all font-medium" placeholder="••••••••" required autocomplete="current-password">
                            
                            <!-- Toggle Show Password -->
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition-colors cursor-pointer" id="togglePasswordBtn">
                                <i data-lucide="eye" class="w-4 h-4" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-1">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 accent-indigo-600">
                            <span class="text-[11.5px] text-slate-650 font-bold">Ingat saya</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full h-11 rounded-xl bg-indigo-600 text-xs font-bold text-white hover:bg-indigo-750 shadow-md shadow-indigo-650/15 hover:shadow-lg hover:shadow-indigo-650/20 active:translate-y-px transition-all cursor-pointer">
                        Masuk
                    </button>
                </form>

                <!-- Help details & redirects -->
                <div class="mt-6 p-3.5 bg-slate-50/70 border border-slate-200/50 rounded-xl text-[11px] text-slate-500 leading-relaxed font-medium">
                    <strong class="text-slate-800 flex items-center gap-1.5 mb-0.5"><i data-lucide="help-circle" class="w-3.5 h-3.5 text-indigo-600"></i> Butuh bantuan?</strong>
                    Hubungi admin akademik jika akun Anda belum diverifikasi atau lupa password login.
                </div>

                <div class="mt-8 text-center text-xs font-medium text-slate-650">
                    Belum punya akun mahasiswa?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-extrabold hover:underline">Daftar sekarang</a>
                </div>

                <div class="mt-8 text-center text-[10px] text-slate-400 space-y-1">
                    <p>&copy; 2026 MPTI Kelompok Sigma.</p>
                    <p>Demo Akun: <code class="bg-slate-100 text-slate-600 px-1 rounded">mahasiswa@example.com</code> / <code class="bg-slate-100 text-slate-600 px-1 rounded">password</code></p>
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

            // Show/Hide Password
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePasswordBtn?.addEventListener('click', () => {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                // Toggle Lucide icon attribute
                if (isPassword) {
                    eyeIcon.setAttribute('data-lucide', 'eye-off');
                } else {
                    eyeIcon.setAttribute('data-lucide', 'eye');
                }
                
                // Re-draw lucide icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        });
    </script>
</body>
</html>
