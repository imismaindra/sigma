<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan Admin - SIPMA</title>
    
    <!-- Vite Assets (Tailwind CSS v4 & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Plus Jakarta Sans for extreme modern layout -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;650;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        /* Custom scrollbar for high-end feel */
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="min-h-full flex flex-col text-slate-800 antialiased selection:bg-indigo-500 selection:text-white bg-slate-55/40 relative">

    <!-- Background Decorative Glowing Lights (Mesh Glow) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[40%] -left-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-tr from-indigo-200/35 to-violet-200/35 blur-[120px]"></div>
        <div class="absolute -bottom-[40%] -right-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-br from-blue-200/25 to-purple-200/25 blur-[120px]"></div>
    </div>

    <!-- Top Navigation Bar (Translucent Glassmorphism) -->
    <nav class="sticky top-0 z-40 backdrop-blur-md bg-white/75 border-b border-slate-200/60 px-4 sm:px-8 py-3 flex items-center justify-between shadow-xs shadow-slate-100/50">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-violet-600 to-purple-650 flex items-center justify-center text-white font-extrabold text-xs shadow-lg shadow-indigo-500/25 transform group-hover:rotate-6 transition-all duration-300">
                    SP
                </div>
                <div>
                    <h2 class="text-xs font-extrabold text-slate-900 leading-tight tracking-tight">SIPMA</h2>
                    <p class="text-[9px] text-indigo-600 font-bold uppercase tracking-wider">Dashboard Admin</p>
                </div>
            </a>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex h-8 items-center gap-1.5 px-3 rounded-lg border border-slate-200 bg-white/80 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-slate-950 transition-all shadow-xs hover:border-slate-350">
                <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                Dashboard
            </a>
            
            <div class="h-5 w-px bg-slate-200"></div>
            
            <div class="hidden sm:flex flex-col text-right">
                <p class="text-xs font-extrabold text-slate-900 leading-none">{{ Auth::user()->nama }}</p>
                <p class="text-[9px] text-slate-450 font-bold mt-0.5 uppercase tracking-wide">Administrator</p>
            </div>
            
            <button type="button" class="inline-flex h-8 items-center gap-1.5 px-3 rounded-lg bg-rose-50 border border-rose-200/70 text-xs font-bold text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-all shadow-xs cursor-pointer" id="btnTriggerLogout">
                <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                Keluar
            </button>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="relative z-10 flex-1 max-w-[1500px] w-full mx-auto p-4 sm:p-6 lg:p-8 space-y-6">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-[10px] font-extrabold text-slate-450 tracking-wider uppercase" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1.5">
                <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
                <li><span class="text-slate-800">Detail Pengaduan</span></li>
            </ol>
        </nav>

        <!-- Hero Section: Title and Glowing Badges -->
        <section class="bg-white/85 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-6 lg:p-7 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 hover:shadow-md transition-all duration-300">
            <div class="space-y-3 max-w-4xl">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-md border border-slate-200 shadow-3xs">
                        <i data-lucide="hash" class="w-3 h-3"></i>
                        {{ $pengaduan->ticket_number ?? 'Belum tersedia' }}
                    </span>
                    
                    @php
                        $badgeClasses = [
                            'pending' => 'bg-amber-50/70 text-amber-700 border-amber-200 shadow-amber-500/5',
                            'proses' => 'bg-blue-50/70 text-blue-700 border-blue-200 shadow-blue-500/5',
                            'menunggu_klarifikasi' => 'bg-purple-50/70 text-purple-700 border-purple-200 shadow-purple-500/5',
                            'menunggu_verifikasi_mahasiswa' => 'bg-indigo-50/70 text-indigo-700 border-indigo-200 shadow-indigo-500/5',
                            'ditindaklanjuti' => 'bg-teal-50/70 text-teal-700 border-teal-200 shadow-teal-500/5',
                            'selesai' => 'bg-emerald-50/70 text-emerald-700 border-emerald-200 shadow-emerald-500/5',
                            'ditolak' => 'bg-rose-50/70 text-rose-700 border-rose-200 shadow-rose-500/5',
                        ];
                        $badgeColor = $badgeClasses[$pengaduan->status] ?? 'bg-slate-50 text-slate-800 border-slate-200';
                    @endphp
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-md border shadow-3xs {{ $badgeColor }}">
                        <span class="relative flex h-1.5 w-1.5">
                            <span class="animate-pulse absolute inline-flex h-full w-full rounded-full bg-current opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-current"></span>
                        </span>
                        {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                    </span>

                    @php
                        $priorityColor = [
                            'rendah' => 'bg-slate-50 text-slate-600 border-slate-200',
                            'sedang' => 'bg-blue-50/50 text-blue-600 border-blue-200/50',
                            'tinggi' => 'bg-orange-50 text-orange-700 border-orange-200',
                            'mendesak' => 'bg-red-50 text-red-700 border-red-200',
                        ][$pengaduan->priority] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                    @endphp
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-md border shadow-3xs {{ $priorityColor }}">
                        <i data-lucide="flag" class="w-3 h-3"></i>
                        {{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}
                    </span>
                </div>

                <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight leading-snug text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-950 to-violet-900">
                    {{ $pengaduan->judul }}
                </h1>

                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                    Kategori: <strong class="text-slate-800 font-bold">{{ $pengaduan->kategori->nama_kategori }}</strong> 
                    • Dilaporkan: <strong class="text-slate-800 font-bold">{{ $pengaduan->created_at->format('d M Y, H:i') }} WIB</strong>
                    @if($pengaduan->due_at)
                    • Batas SLA: <strong class="text-slate-800 font-bold">{{ $pengaduan->due_at->format('d M Y, H:i') }} WIB</strong>
                    @endif
                </p>
            </div>
            
            <div class="hidden md:block h-12 w-px bg-slate-200"></div>

            <div class="flex items-center gap-2.5 min-w-[220px] bg-slate-50/60 p-3 rounded-xl border border-slate-200/80 shadow-3xs">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-500/10">
                    {{ strtoupper(substr($pengaduan->user->nama, 0, 2)) }}
                </div>
                <div class="min-w-0 filter blur-sm hover:blur-none transition-all duration-300 select-none hover:select-text cursor-pointer" title="Arahkan kursor untuk melihat nama pelapor">
                    <p class="font-extrabold text-slate-900 text-xs truncate leading-tight">{{ $pengaduan->user->nama }}</p>
                    <p class="text-[10px] text-slate-450 font-bold mt-0.5 truncate uppercase tracking-wider">{{ $pengaduan->user->nim_nip }}</p>
                </div>
            </div>
        </section>

        <!-- Information Metric Cards Grid (Dynamic hover style) -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
            
            <!-- Card Pelapor -->
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-blue-500 to-indigo-500 text-white shadow-sm shadow-indigo-500/15 flex-shrink-0">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Pelapor</p>
                    <div class="filter blur-sm hover:blur-none transition-all duration-300 select-none hover:select-text cursor-pointer" title="Arahkan kursor untuk melihat nama pelapor">
                        <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->user->nama }}</p>
                        <p class="text-[9px] text-slate-500 font-semibold truncate">{{ $pengaduan->user->nim_nip }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Kategori -->
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 text-white shadow-sm shadow-violet-500/15 flex-shrink-0">
                    <i data-lucide="tag" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Kategori</p>
                    <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->kategori->nama_kategori }}</p>
                    <p class="text-[9px] text-slate-500 font-semibold">Keluhan Kampus</p>
                </div>
            </div>

            <!-- Card Status -->
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-violet-500 to-purple-500 text-white shadow-sm shadow-purple-500/15 flex-shrink-0">
                    <i data-lucide="info" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Status & Prioritas</p>
                    <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</p>
                    <p class="text-[9px] text-slate-500 font-semibold truncate">Prioritas: {{ $priorityLabels[$pengaduan->priority] ?? $pengaduan->priority }}</p>
                </div>
            </div>

            <!-- Card SLA/Tanggal -->
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-purple-500 to-rose-500 text-white shadow-sm shadow-rose-500/15 flex-shrink-0">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Tanggal Masuk</p>
                    <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->created_at->format('d M Y') }}</p>
                    <p class="text-[9px] text-slate-500 font-semibold">Jam: {{ $pengaduan->created_at->format('H:i') }} WIB</p>
                </div>
            </div>

            <!-- Card Durasi Penyelesaian (Total dari pertama lapor) -->
            <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-teal-500 to-emerald-500 text-white shadow-sm shadow-teal-500/15 flex-shrink-0">
                    <i data-lucide="timer" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Penyelesaian</p>
                    <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->durasi_penyelesaian }}</p>
                    <p class="text-[9px] text-slate-500 font-semibold truncate">Sejak pertama lapor</p>
                </div>
            </div>

            <!-- Card Durasi Pengerjaan -->
            @if($pengaduan->waktu_proses)
                @php
                    $durationBorder = in_array($pengaduan->status, ['selesai', 'ditolak']) ? 'border-l-emerald-500' : 'border-l-indigo-600';
                @endphp
                <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 border-l-4 {{ $durationBorder }} hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                    <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-rose-500 to-amber-500 text-white shadow-sm shadow-amber-500/15 flex-shrink-0">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <div class="min-w-0 space-y-0.5">
                        <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Proses</p>
                        <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->durasi_proses }}</p>
                        <p class="text-[9px] text-slate-505 font-medium truncate">Mulai: {{ $pengaduan->waktu_proses->format('d M, H:i') }}</p>
                    </div>
                </div>
            @else
                <div class="bg-white/80 backdrop-blur-sm border border-slate-200 shadow-xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                    <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-slate-400 to-slate-500 text-white shadow-sm flex-shrink-0">
                        <i data-lucide="clock-alert" class="w-4 h-4"></i>
                    </div>
                    <div class="min-w-0 space-y-0.5">
                        <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Proses</p>
                        <p class="text-xs font-bold text-slate-450 truncate leading-snug">Belum diproses</p>
                        <p class="text-[9px] text-slate-500 font-semibold truncate">Menunggu pengerjaan</p>
                    </div>
                </div>
            @endif

        </section>

        <!-- Main Content Area: Left & Right Column -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <!-- Left Column: Details, Attachments, Logs (span 2) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Card Isi Laporan -->
                <article class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <i data-lucide="file-text" class="w-4 h-4 text-indigo-600"></i>
                        <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Isi Laporan / Detail Pengaduan</h3>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/50 via-slate-50 to-indigo-50/15 border border-slate-100 rounded-xl p-5 text-sm leading-relaxed text-slate-750 whitespace-pre-wrap select-text">
                        {{ $pengaduan->isi_pengaduan }}
                    </div>
                </article>

                <!-- Card Lampiran -->
                <article class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <i data-lucide="paperclip" class="w-4 h-4 text-indigo-600"></i>
                        <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Lampiran Dokumen</h3>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @forelse($pengaduan->lampiran as $file)
                            <div class="flex items-center gap-3 p-2.5 bg-white border border-slate-200 rounded-xl hover:shadow-md hover:-translate-y-0.5 hover:border-indigo-200 transition-all duration-250 shadow-3xs group">
                                @if(Str::startsWith($file->tipe_file, 'image/'))
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-150 bg-white flex-shrink-0 relative">
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                @else
                                    @php
                                        $ext = pathinfo($file->nama_file, PATHINFO_EXTENSION) ?: 'FILE';
                                    @endphp
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-[9px] font-extrabold text-slate-500 flex-shrink-0">
                                        {{ strtoupper($ext) }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1 space-y-0.5">
                                    <p class="text-xs font-bold text-slate-805 truncate group-hover:text-indigo-650 transition-colors" title="{{ $file->nama_file }}">
                                        {{ $file->nama_file }}
                                    </p>
                                    <p class="text-[9px] text-slate-400 font-extrabold uppercase tracking-wider">
                                        {{ explode('/', $file->tipe_file)[1] ?? 'File' }}
                                    </p>
                                </div>
                                <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-650 hover:bg-indigo-100 hover:scale-105 transition-all shadow-3xs flex-shrink-0" title="Lihat Berkas">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                            </div>
                        @empty
                            <div class="sm:col-span-2 text-center py-6 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                                <i data-lucide="folder-open" class="w-6 h-6 text-slate-400 mx-auto mb-1.5 animate-bounce"></i>
                                <p class="text-[11px] text-slate-500 font-semibold">Tidak ada lampiran dokumen untuk pengaduan ini.</p>
                            </div>
                        @endforelse
                    </div>
                </article>

                <!-- Card Audit Aktivitas -->
                <article class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <i data-lucide="history" class="w-4 h-4 text-indigo-600"></i>
                        <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Audit Aktivitas Sistem</h3>
                    </div>
                    
                    <div class="relative border-l-2 border-indigo-100 ml-2.5 pl-6 space-y-6 py-1">
                        @forelse($pengaduan->activities as $activity)
                            <div class="relative">
                                <!-- Marker dot (pulsing indicator) -->
                                <span class="absolute -left-[31px] top-1.5 flex items-center justify-center w-4 h-4 rounded-full bg-white border-2 border-indigo-500 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                                </span>
                                
                                <div class="space-y-1">
                                    <div class="flex flex-wrap items-center gap-1.5">
                                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wide text-[11px]">
                                            {{ str_replace('_', ' ', $activity->action) }}
                                        </span>
                                        <span class="text-[10px] font-semibold text-slate-300">•</span>
                                        <span class="text-[10px] font-semibold text-slate-450">
                                            {{ $activity->created_at->format('d M Y, H:i') }} WIB
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-650 leading-relaxed">
                                        {{ $activity->description }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-semibold">
                                        Oleh: 
                                        @if($activity->user && $activity->user->role === 'mahasiswa')
                                            <span class="inline-block filter blur-sm hover:blur-none transition-all duration-300 select-none hover:select-text cursor-pointer" title="Arahkan kursor untuk melihat nama">
                                                {{ $activity->user->nama }}
                                            </span>
                                        @else
                                            {{ $activity->user?->nama ?? 'Sistem' }}
                                        @endif
                                        @if($activity->ip_address) • IP: {{ $activity->ip_address }} @endif
                                    </p>
                                    
                                    @if($activity->before_data || $activity->after_data)
                                        <details class="mt-2 text-[10px] font-semibold text-slate-500">
                                            <summary class="cursor-pointer hover:text-indigo-600 outline-none list-none inline-flex items-center gap-1 select-none">
                                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 transform transition-transform details-arrow"></i>
                                                Detail Perubahan Data
                                            </summary>
                                            <div class="mt-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200 font-mono text-[9px] space-y-1.5 overflow-x-auto">
                                                @if($activity->before_data)
                                                    <div><span class="text-rose-600 font-bold">Sebelum:</span> {{ json_encode($activity->before_data, JSON_UNESCAPED_UNICODE) }}</div>
                                                @endif
                                                @if($activity->after_data)
                                                    <div><span class="text-emerald-600 font-bold">Sesudah:</span> {{ json_encode($activity->after_data, JSON_UNESCAPED_UNICODE) }}</div>
                                                @endif
                                            </div>
                                        </details>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-slate-400 text-xs font-semibold">
                                Belum ada riwayat aktivitas sistem.
                            </div>
                        @endforelse
                    </div>
                </article>

            </div>

            <!-- Right Column: Interactive Tab Action Panel & Timelines -->
            <div class="space-y-6">
                
                @if(Auth::user()->role !== 'pimpinan')
                    <!-- Card Panel Aksi (Tabs) -->
                    <article class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden hover:shadow-md transition-shadow duration-300">
                        
                        <!-- Tabs Header (TabsList style) -->
                        <div class="bg-slate-100/80 backdrop-blur-xs p-1.5 flex gap-1 border-b border-slate-200/50">
                            <button type="button" class="tab-btn active flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-bold rounded-lg transition-all cursor-pointer" data-tab="tab-status">
                                <i data-lucide="check-square" class="w-3.5 h-3.5"></i>
                                Status
                            </button>
                            <button type="button" class="tab-btn flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-bold rounded-lg text-slate-550 hover:text-slate-905 transition-all cursor-pointer" data-tab="tab-tanggapan">
                                <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                Tanggapan
                            </button>
                            <button type="button" class="tab-btn flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-bold rounded-lg text-slate-550 hover:text-slate-905 transition-all cursor-pointer" data-tab="tab-komentar">
                                <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                                Komentar
                            </button>
                        </div>

                        <!-- Tab Content Body -->
                        <div class="p-6">
                            
                            <!-- Form 1: Update Status -->
                            <div id="tab-status" class="tab-content space-y-4">
                                <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Update Status Pengaduan</h4>
                                <form action="{{ route('admin.pengaduan.status.update', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5" for="status">Pilih Status Baru</label>
                                        <select name="status" id="status" class="block w-full text-xs font-medium rounded-lg border border-slate-250 bg-white px-3 h-10 shadow-3xs outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/20 focus-visible:border-indigo-500 transition-all cursor-pointer" required>
                                            @foreach($statusLabels as $status => $label)
                                                <option value="{{ $status }}" {{ $pengaduan->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5" for="catatan">Catatan / Alasan Perubahan</label>
                                        <textarea name="catatan" id="catatan" rows="3" class="block w-full text-xs font-medium rounded-lg border border-slate-250 bg-white px-3 py-2 shadow-3xs outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/20 focus-visible:border-indigo-500 transition-all resize-none" placeholder="Tulis catatan atau alasan pengubahan status tiket di sini..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-gradient-to-r from-indigo-600 via-indigo-650 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-xs font-bold text-white shadow-md shadow-indigo-500/15 hover:scale-[1.01] active:scale-[0.99] hover:shadow-lg transition-all duration-200 cursor-pointer">
                                        <i data-lucide="save" class="w-3.5 h-3.5 mr-1.5 animate-pulse"></i>
                                        Perbarui Status
                                    </button>
                                </form>
                            </div>

                            <!-- Form 2: Kirim Tanggapan Resmi -->
                            <div id="tab-tanggapan" class="tab-content space-y-4 hidden">
                                <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Kirim Tanggapan Resmi</h4>
                                <p class="text-[11px] text-slate-500 leading-snug">Tanggapan resmi akan langsung terkirim dan dapat dilihat oleh mahasiswa pelapor di akun mereka.</p>
                                <form action="{{ route('admin.pengaduan.tanggapan.store', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5" for="isi_tanggapan">Pesan Tanggapan</label>
                                        <textarea name="isi_tanggapan" id="isi_tanggapan" rows="4" class="block w-full text-xs font-medium rounded-lg border border-slate-250 bg-white px-3 py-2 shadow-3xs outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/20 focus-visible:border-indigo-500 transition-all" required placeholder="Tulis respon resmi, solusi, atau arahan untuk pelapor..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-gradient-to-r from-indigo-600 via-indigo-650 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-xs font-bold text-white shadow-md shadow-indigo-500/15 hover:scale-[1.01] active:scale-[0.99] hover:shadow-lg transition-all duration-200 cursor-pointer">
                                        <i data-lucide="send" class="w-3.5 h-3.5 mr-1.5 animate-pulse"></i>
                                        Kirim Tanggapan
                                    </button>
                                </form>
                            </div>

                            <!-- Form 3: Komentar Lanjutan / Internal -->
                            <div id="tab-komentar" class="tab-content space-y-4 hidden">
                                <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Komentar & Diskusi Internal</h4>
                                
                                <div class="max-h-[200px] overflow-y-auto space-y-3 pr-1 border border-slate-100 p-2 rounded-xl bg-slate-50/50 shadow-3xs">
                                    @forelse($pengaduan->comments as $comment)
                                        <div class="bg-white rounded-lg border border-slate-150 p-2.5 shadow-3xs space-y-1">
                                            <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-1 mb-1">
                                                @if($comment->user->role === 'mahasiswa')
                                                    <div class="filter blur-sm hover:blur-none transition-all duration-300 select-none hover:select-text cursor-pointer" title="Arahkan kursor untuk melihat nama">
                                                        <p class="text-[10px] font-bold text-slate-800 leading-none">{{ $comment->user->nama }}</p>
                                                    </div>
                                                @else
                                                    <p class="text-[10px] font-bold text-slate-800 leading-none">{{ $comment->user->nama }}</p>
                                                @endif
                                                <p class="text-[9px] text-slate-400 font-semibold">{{ $comment->created_at->format('d M, H:i') }}</p>
                                            </div>
                                            <p class="text-[11px] text-slate-650 leading-snug">
                                                {{ $comment->message }}
                                            </p>
                                        </div>
                                    @empty
                                        <p class="text-[10px] text-slate-450 text-center py-4 font-bold">Belum ada diskusi komentar.</p>
                                    @endforelse
                                </div>

                                <form action="{{ route('admin.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-4 pt-2 border-t border-slate-100">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5" for="message">Tambah Komentar Lanjutan</label>
                                        <textarea name="message" id="message" rows="3" class="block w-full text-xs font-medium rounded-lg border border-slate-250 bg-white px-3 py-2 shadow-3xs outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/20 focus-visible:border-indigo-500 transition-all resize-none" required placeholder="Tulis komentar atau diskusi internal di sini..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-gradient-to-r from-indigo-600 via-indigo-650 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-xs font-bold text-white shadow-md shadow-indigo-500/15 hover:scale-[1.01] active:scale-[0.99] hover:shadow-lg transition-all duration-200 cursor-pointer">
                                        <i data-lucide="plus" class="w-3.5 h-3.5 mr-1.5 animate-pulse"></i>
                                        Kirim Komentar
                                    </button>
                                </form>
                            </div>

                        </div>
                    </article>
                @endif

                <!-- Card Riwayat Transisi Status -->
                <article class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <i data-lucide="route" class="w-4 h-4 text-indigo-600"></i>
                        <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Riwayat Perubahan Status</h3>
                    </div>
                    
                    <div class="relative border-l-2 border-slate-200 ml-2 pl-5 space-y-5 py-1">
                        @forelse($pengaduan->statusLogs as $log)
                            <div class="relative text-xs">
                                <span class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-indigo-550 border-2 border-white shadow-xs"></span>
                                <div class="space-y-1">
                                    <p class="font-bold text-slate-900 leading-none">
                                        Status: <span class="text-slate-400 font-semibold text-[10px] line-through">{{ $log->status_lama ?: 'awal' }}</span> 
                                        <i data-lucide="arrow-right" class="w-3 h-3 inline text-slate-350"></i> 
                                        <span class="text-indigo-600 font-bold">{{ $log->status_baru }}</span>
                                    </p>
                                    
                                    @if($log->catatan)
                                        <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200 text-[11px] text-slate-650 italic">
                                            "{{ $log->catatan }}"
                                        </div>
                                    @endif
                                    
                                    <p class="text-[10px] text-slate-400 font-semibold">
                                        Oleh: {{ $log->creator->nama }} • {{ $log->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-450 font-semibold py-1">Belum ada perubahan status.</p>
                        @endforelse
                    </div>
                </article>

                <!-- Card Riwayat Tanggapan Resmi -->
                <article class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 hover:shadow-md transition-shadow duration-300 space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <i data-lucide="message-square-quote" class="w-4 h-4 text-indigo-600"></i>
                        <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Riwayat Tanggapan Resmi</h3>
                    </div>
                    
                    <div class="space-y-3.5">
                        @forelse($pengaduan->tanggapan as $reply)
                            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/60 space-y-2">
                                <div class="flex items-center justify-between gap-2 border-b border-slate-150 pb-1.5">
                                    <div class="flex items-center gap-1.5">
                                        <div class="w-5 h-5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 text-white text-[10px] font-extrabold flex items-center justify-center">
                                            {{ strtoupper(substr($reply->admin->nama, 0, 1)) }}
                                        </div>
                                        <span class="text-xs font-bold text-slate-805">{{ $reply->admin->nama }}</span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-semibold">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <p class="text-xs text-slate-650 leading-relaxed whitespace-pre-wrap select-text">
                                    {{ $reply->isi_tanggapan }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-6 bg-slate-50/50 border border-dashed border-slate-200 rounded-xl">
                                <i data-lucide="message-square-text" class="w-6 h-6 text-slate-400 mx-auto mb-1"></i>
                                <p class="text-xs text-slate-500 font-semibold">Belum ada respon atau tanggapan resmi.</p>
                            </div>
                        @endforelse
                    </div>
                </article>

            </div>

        </div>

    </main>

    <!-- Logout Confirmation Modal (Dynamic Animation Style) -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs opacity-0 pointer-events-none transition-all duration-200" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="w-full max-w-sm bg-white border border-slate-200 rounded-2xl p-6 shadow-xl transform scale-95 transition-transform duration-200" id="logoutModalContent">
            
            <div class="text-center space-y-4">
                <div class="w-11 h-11 rounded-full bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center mx-auto shadow-xs">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </div>
                
                <div class="space-y-1.5">
                    <h3 class="text-sm font-extrabold text-slate-950" id="modalTitle">Konfirmasi Keluar</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">Apakah Anda yakin ingin keluar dari Panel Administrasi SIPMA?</p>
                </div>

                <div class="grid grid-cols-2 gap-2.5 pt-2">
                    <button type="button" class="inline-flex h-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-slate-950 transition-colors shadow-3xs cursor-pointer" id="btnCancelLogout">
                        Batal
                    </button>
                    <button type="button" class="inline-flex h-9 items-center justify-center rounded-lg bg-zinc-900 hover:bg-zinc-800 text-xs font-bold text-white transition-colors cursor-pointer shadow-sm shadow-zinc-900/10" id="btnConfirmLogout">
                        Keluar
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
            // Lucide Icons Initialization
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // Tab Switcher Logic
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content");

            tabButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    const targetTabId = btn.getAttribute("data-tab");

                    // Set buttons classes (dynamic gradient style active tabs)
                    tabButtons.forEach(b => {
                        b.classList.remove("active", "bg-gradient-to-r", "from-indigo-600", "to-violet-600", "text-white", "shadow-md", "shadow-indigo-500/20", "font-bold", "scale-[1.01]");
                        b.classList.add("text-slate-550", "hover:text-slate-905");
                    });
                    btn.classList.add("active", "bg-gradient-to-r", "from-indigo-600", "to-violet-600", "text-white", "shadow-md", "shadow-indigo-500/20", "font-bold", "scale-[1.01]");
                    btn.classList.remove("text-slate-550", "hover:text-slate-905");

                    // Toggle contents visibility with dynamic transition effect
                    tabContents.forEach(content => {
                        if (content.id === targetTabId) {
                            content.classList.remove("hidden");
                            content.classList.add("animate-fade-in");
                        } else {
                            content.classList.add("hidden");
                            content.classList.remove("animate-fade-in");
                        }
                    });
                    
                    // Refresh Lucide Icons in tabs
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                });
            });

            // Set Initial Active Tab styling
            const activeTab = document.querySelector(".tab-btn.active");
            if (activeTab) {
                activeTab.classList.add("bg-gradient-to-r", "from-indigo-600", "to-violet-600", "text-white", "shadow-md", "shadow-indigo-500/20", "font-bold", "scale-[1.01]");
                activeTab.classList.remove("text-slate-550", "hover:text-slate-905");
            }

            // Logout Modal Toggle Logic
            const btnTrigger = document.getElementById('btnTriggerLogout');
            const modal = document.getElementById('logoutModal');
            const modalContent = document.getElementById('logoutModalContent');
            const btnCancel = document.getElementById('btnCancelLogout');
            const btnConfirm = document.getElementById('btnConfirmLogout');
            const form = document.getElementById('logoutForm');

            const openModal = () => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            };

            const closeModal = () => {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modalContent.classList.remove('scale-100');
                modalContent.classList.add('scale-95');
            };

            btnTrigger?.addEventListener('click', openModal);
            btnCancel?.addEventListener('click', closeModal);
            modal?.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });
            btnConfirm?.addEventListener('click', () => form?.submit());

            // Details arrows rotation effect
            const detailsElements = document.querySelectorAll('details');
            detailsElements.forEach(details => {
                const summary = details.querySelector('summary');
                const arrow = summary.querySelector('.details-arrow');
                
                details.addEventListener('toggle', () => {
                    if (details.open) {
                        arrow?.classList.add('rotate-90');
                    } else {
                        arrow?.classList.remove('rotate-90');
                    }
                });
            });
        });
    </script>
    
    <!-- Include Global Toast partial -->
    @include('partials.toast')
</body>
</html>
