@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
    <!-- Header Card -->
    <section class="bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 shadow-sm relative overflow-hidden mb-6">
        <div class="absolute -right-24 -bottom-24 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650 uppercase mb-3">
                <i data-lucide="users" class="w-3.5 h-3.5"></i>
                Kontrol Pengguna
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">Manajemen Akun User</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Kelola akun mahasiswa, administrator, pimpinan, dan status verifikasi akun yang diperbolehkan mengakses sistem SIPMA.
            </p>
        </div>
    </section>

    <!-- Error/Validation Warnings -->
    @if($errors->any())
        <div class="p-4 mb-6 text-xs font-semibold text-rose-700 bg-rose-50 border border-rose-100 rounded-xl space-y-1.5 shadow-3xs">
            <strong class="block text-rose-800 text-[13px]">Gagal memproses data:</strong>
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 flex-shrink-0"></span>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Add & Filter Panels Grid -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        
        <!-- Add User Form -->
        <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="user-plus" class="w-4.5 h-4.5 text-indigo-650"></i> Tambah User Baru
            </h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">NIM / NIP</label>
                    <input type="text" name="nim_nip" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Role</label>
                    <select name="role" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                        @foreach($roles as $role)
                            <option value="{{ $role }}">{{ Str::title(str_replace('_',' ', $role)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Verifikasi</label>
                    <select name="account_status" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                </div>
                <div class="sm:col-span-2 flex justify-end pt-2 border-t border-slate-100 mt-2">
                    <button type="submit" class="h-9 px-5 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer shadow-3xs flex items-center gap-1.5">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Akun
                    </button>
                </div>
            </form>
        </div>

        <!-- Filter Users Panel -->
        <div class="lg:col-span-5 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="filter" class="w-4.5 h-4.5 text-indigo-650"></i> Filter Akun
                </h3>
                <form action="{{ route('admin.users.index') }}" method="GET" class="space-y-3.5">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Cari Pengguna</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Nama, email, atau NIM/NIP..." class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Filter Role</label>
                            <select name="role" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-slate-50/50 focus:bg-white focus:border-indigo-650 outline-none transition-all font-semibold">
                                <option value="">Semua</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ request('role') === $role ? 'selected' : '' }}>{{ Str::title(str_replace('_',' ', $role)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Verif</label>
                            <select name="account_status" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-slate-50/50 focus:bg-white focus:border-indigo-650 outline-none transition-all font-semibold">
                                <option value="">Semua</option>
                                @foreach($statuses as $key => $label)
                                    <option value="{{ $key }}" {{ request('account_status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="flex gap-2.5 justify-end pt-4 border-t border-slate-100 mt-4">
                <button type="submit" class="h-9 px-4 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer shadow-3xs">Terapkan</button>
                <a href="{{ route('admin.users.index') }}" class="h-9 px-4 rounded-lg border border-slate-200 text-xs font-bold text-slate-750 hover:bg-slate-50 transition-colors flex items-center justify-center">Reset</a>
            </div>
            </form>
        </div>
    </section>

    <!-- Users Spreadsheet list Table -->
    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
        <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3.5 mb-4 flex items-center gap-2">
            <i data-lucide="list" class="w-4.5 h-4.5 text-indigo-600"></i> Daftar Akun Pengguna ({{ $users->total() }} Akun)
        </h3>

        <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-white">
            <!-- Table Header -->
            <div class="hidden lg:grid lg:grid-cols-12 gap-3.5 items-center bg-slate-50 border-b border-slate-200/85 px-4.5 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <div class="col-span-2.5">Nama Lengkap</div>
                <div class="col-span-1.5">NIM / NIP</div>
                <div class="col-span-2">Email</div>
                <div class="col-span-1.5">Peran (Role)</div>
                <div class="col-span-1.5">Status Akun</div>
                <div class="col-span-2.5">Ubah Password & Simpan</div>
            </div>

            <!-- Table Rows (Form Sheet Layout) -->
            <div class="divide-y divide-slate-150/60">
                @forelse($users as $user)
                    <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-3 p-4.5 items-center hover:bg-slate-50/40 transition-colors">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="col-span-2.5">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-2 rounded-sm outline-none transition-all font-bold text-slate-800" value="{{ $user->nama }}" required>
                        </div>

                        <!-- NIM/NIP -->
                        <div class="col-span-1.5">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">NIM / NIP</label>
                            <input type="text" name="nim_nip" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-2 rounded-sm outline-none transition-all font-bold text-slate-700" value="{{ $user->nim_nip }}" required>
                        </div>

                        <!-- Email -->
                        <div class="col-span-2">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Email</label>
                            <input type="email" name="email" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-2 rounded-sm outline-none transition-all font-semibold text-slate-600" value="{{ $user->email }}" required>
                        </div>

                        <!-- Role -->
                        <div class="col-span-1.5">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Peran (Role)</label>
                            <select name="role" required class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-1.5 rounded-sm outline-none transition-all font-bold text-slate-700">
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ Str::title(str_replace('_',' ', $role)) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Account Status badge / select -->
                        <div class="col-span-1.5">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Status Verifikasi</label>
                            @php
                                $badgeStyle = 'bg-slate-100 text-slate-600 border-slate-200';
                                if($user->account_status === 'aktif') $badgeStyle = 'bg-emerald-50 text-emerald-700 border-emerald-150';
                                if($user->account_status === 'nonaktif') $badgeStyle = 'bg-rose-50 text-rose-700 border-rose-150';
                                if($user->account_status === 'menunggu_verifikasi') $badgeStyle = 'bg-amber-50 text-amber-700 border-amber-150';
                            @endphp
                            <div class="relative flex items-center">
                                <select name="account_status" required class="w-full h-8.5 text-xs border border-slate-250/70 focus:border-indigo-650 px-2.5 rounded-lg outline-none transition-all font-bold tracking-wide {{ $badgeStyle }}">
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ ($user->account_status ?? 'aktif') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Password & save action -->
                        <div class="col-span-2.5 flex items-center gap-2">
                            <div class="flex-1">
                                <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Ganti Password</label>
                                <input type="password" name="password" placeholder="Kosongkan jika tetap" class="w-full h-8.5 text-xs border border-slate-200 rounded-lg px-2 bg-slate-50 focus:bg-white focus:border-indigo-650 outline-none transition-all font-medium">
                            </div>
                            <button type="submit" class="w-8.5 h-8.5 rounded-lg bg-indigo-50 border border-indigo-150/40 text-indigo-600 hover:bg-indigo-100 flex items-center justify-center transition-colors flex-shrink-0 cursor-pointer" title="Simpan Perubahan User">
                                <i data-lucide="save" class="w-4 h-4"></i>
                            </button>
                        </div>

                    </form>
                @empty
                    <div class="text-center py-12 text-slate-450 flex flex-col items-center gap-2">
                        <i data-lucide="users" class="w-8 h-8 text-slate-350 animate-pulse"></i>
                        <span>Belum ada user terdaftar atau cocok dengan filter.</span>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            @include('partials.simple-pagination', ['paginator' => $users])
        </div>
    </section>
@endsection
