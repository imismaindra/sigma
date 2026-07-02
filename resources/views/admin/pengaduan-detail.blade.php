@extends('layouts.admin')

@section('title', 'Detail Pengaduan Admin')

@section('content')
    <!-- Breadcrumbs -->
    <nav class="flex text-[10px] font-extrabold text-slate-450 tracking-wider uppercase" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1.5">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-650 transition-colors">Dashboard</a></li>
            <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
            <li><span class="text-slate-800">Detail Pengaduan</span></li>
        </ol>
    </nav>

    <!-- Hero Section: Title and Status Badges -->
    <section class="bg-white/80 backdrop-blur-sm border border-slate-200/80 rounded-2xl p-6 lg:p-7 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 hover:shadow-md transition-all duration-300">
        <div class="space-y-3 max-w-4xl">
            <div class="flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-md border border-slate-200 shadow-3xs">
                    <i data-lucide="hash" class="w-3 h-3"></i>
                    {{ $pengaduan->ticket_number ?? 'PGD' }}
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
                        'darurat' => 'bg-red-50 text-red-700 border-red-200',
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
            <div class="min-w-0" title="Detail Pengirim">
                <p class="font-extrabold text-slate-900 text-xs truncate leading-tight">{{ $pengaduan->user->nama }}</p>
                <p class="text-[10px] text-slate-450 font-bold mt-0.5 truncate uppercase tracking-wider">{{ $pengaduan->user->nim_nip }}</p>
            </div>
        </div>
    </section>

    <!-- Information Metric Cards Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
        
        <!-- Card Pelapor -->
        <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
            <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-blue-500 to-indigo-500 text-white shadow-sm shadow-indigo-500/15 flex-shrink-0">
                <i data-lucide="user" class="w-4 h-4"></i>
            </div>
            <div class="min-w-0 space-y-0.5">
                <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Pelapor</p>
                <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->user->nama }}</p>
                <p class="text-[9px] text-slate-550 font-semibold truncate">{{ $pengaduan->user->nim_nip }}</p>
            </div>
        </div>

        <!-- Card Kategori -->
        <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
            <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-indigo-500 to-violet-500 text-white shadow-sm shadow-violet-500/15 flex-shrink-0">
                <i data-lucide="tag" class="w-4 h-4"></i>
            </div>
            <div class="min-w-0 space-y-0.5">
                <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Kategori</p>
                <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->kategori->nama_kategori }}</p>
                <p class="text-[9px] text-slate-550 font-semibold">Keluhan Kampus</p>
            </div>
        </div>

        <!-- Card Status -->
        <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
            <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-violet-500 to-purple-500 text-white shadow-sm shadow-purple-500/15 flex-shrink-0">
                <i data-lucide="info" class="w-4 h-4"></i>
            </div>
            <div class="min-w-0 space-y-0.5">
                <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Status</p>
                <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</p>
                <p class="text-[9px] text-slate-550 font-semibold truncate">Prioritas: {{ $priorityLabels[$pengaduan->priority] ?? $pengaduan->priority }}</p>
            </div>
        </div>

        <!-- Card SLA/Tanggal -->
        <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
            <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-purple-500 to-rose-500 text-white shadow-sm shadow-rose-500/15 flex-shrink-0">
                <i data-lucide="calendar" class="w-4 h-4"></i>
            </div>
            <div class="min-w-0 space-y-0.5">
                <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Tanggal Masuk</p>
                <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->created_at->format('d M Y') }}</p>
                <p class="text-[9px] text-slate-550 font-semibold">Jam: {{ $pengaduan->created_at->format('H:i') }} WIB</p>
            </div>
        </div>

        <!-- Card Durasi Penyelesaian (Total) -->
        <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
            <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-teal-500 to-emerald-500 text-white shadow-sm shadow-teal-500/15 flex-shrink-0">
                <i data-lucide="timer" class="w-4 h-4"></i>
            </div>
            <div class="min-w-0 space-y-0.5">
                <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Selesai</p>
                <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->durasi_penyelesaian }}</p>
                <p class="text-[9px] text-slate-550 font-semibold truncate">Sejak pertama lapor</p>
            </div>
        </div>

        <!-- Card Durasi Pengerjaan -->
        @if($pengaduan->waktu_proses)
            @php
                $durationBorder = in_array($pengaduan->status, ['selesai', 'ditolak']) ? 'border-l-emerald-500' : 'border-l-indigo-600';
            @endphp
            <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 border-l-4 {{ $durationBorder }} hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-rose-500 to-amber-500 text-white shadow-sm shadow-amber-500/15 flex-shrink-0">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Proses</p>
                    <p class="text-xs font-bold text-slate-900 truncate leading-snug">{{ $pengaduan->durasi_proses }}</p>
                    <p class="text-[9px] text-slate-500 font-medium truncate">Mulai: {{ $pengaduan->waktu_proses->format('d M, H:i') }}</p>
                </div>
            </div>
        @else
            <div class="bg-white border border-slate-250/70 shadow-3xs rounded-xl p-4 flex items-center gap-3.5 hover:scale-[1.02] hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200/50 hover:bg-white transition-all duration-300 cursor-default">
                <div class="flex items-center justify-center p-2.5 rounded-lg bg-gradient-to-tr from-slate-400 to-slate-550 text-white shadow-sm flex-shrink-0">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                </div>
                <div class="min-w-0 space-y-0.5">
                    <p class="text-[9px] text-slate-450 font-extrabold uppercase tracking-wider leading-none">Durasi Proses</p>
                    <p class="text-xs font-bold text-slate-400 truncate leading-snug">Belum diproses</p>
                    <p class="text-[9px] text-slate-500 font-semibold truncate">Menunggu pengerjaan</p>
                </div>
            </div>
        @endif

    </section>

    <!-- Main Content Area: Left & Right Column -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start relative z-10">
        
        <!-- Left Column: Details, Attachments, Logs (span 2) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Isi Laporan -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Detail Keluhan Pengaduan</h3>
                </div>
                <div class="bg-slate-50 border border-slate-150/75 rounded-xl p-5 text-sm leading-relaxed text-slate-750 whitespace-pre-wrap select-text font-medium">
                    {{ $pengaduan->isi_pengaduan }}
                </div>
            </article>

            <!-- Card Lampiran -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="paperclip" class="w-4.5 h-4.5 text-indigo-655"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Lampiran Dokumen Bukti</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @forelse($pengaduan->lampiran as $file)
                        <div class="flex items-center justify-between gap-3 p-3 bg-white border border-slate-200 rounded-xl hover:shadow-md hover:border-indigo-200/50 transition-all shadow-3xs group">
                            <div class="flex items-center gap-3 min-w-0">
                                @if(Str::startsWith($file->tipe_file, 'image/'))
                                    <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-200 bg-slate-50 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-350">
                                    </div>
                                @else
                                    @php
                                        $ext = pathinfo($file->nama_file, PATHINFO_EXTENSION) ?: 'FILE';
                                    @endphp
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-[10px] font-black text-slate-500 flex-shrink-0">
                                        {{ strtoupper($ext) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate" title="{{ $file->nama_file }}">{{ $file->nama_file }}</p>
                                    <p class="text-[9px] text-slate-450 font-bold uppercase tracking-wider">{{ explode('/', $file->tipe_file)[1] ?? 'File' }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 flex-shrink-0 transition-colors" title="Buka Berkas">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </div>
                    @empty
                        <div class="sm:col-span-2 text-center py-8 bg-slate-50/50 border border-dashed border-slate-200 rounded-xl">
                            <i data-lucide="info" class="w-6 h-6 text-slate-350 mx-auto mb-1.5"></i>
                            <p class="text-[11px] text-slate-500 font-semibold">Tidak ada lampiran berkas untuk aduan ini.</p>
                        </div>
                    @endforelse
                </div>
            </article>

            <!-- Card Audit Aktivitas -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="history" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Aktivitas Sistem & Audit Data</h3>
                </div>
                
                <div class="relative border-l-2 border-slate-150 ml-3.5 pl-6 space-y-6 py-1">
                    @forelse($pengaduan->activities as $activity)
                        <div class="relative">
                            <span class="absolute -left-[31px] top-1.5 flex items-center justify-center w-4 h-4 rounded-full bg-white border-2 border-indigo-600 shadow-3xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-650"></span>
                            </span>
                            
                            <div class="space-y-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider text-[11px]">
                                        {{ str_replace('_', ' ', $activity->action) }}
                                    </span>
                                    <span class="text-[9px] font-bold text-slate-400">•</span>
                                    <span class="text-[10px] font-bold text-slate-450">
                                        {{ $activity->created_at->format('d M Y, H:i') }} WIB
                                    </span>
                                </div>
                                <p class="text-xs text-slate-650 leading-relaxed font-semibold">
                                    {{ $activity->description }}
                                </p>
                                <p class="text-[10px] text-slate-400 font-bold">
                                    Oleh: {{ $activity->user?->nama ?? 'Sistem' }}
                                    @if($activity->ip_address) • IP: {{ $activity->ip_address }} @endif
                                </p>
                                
                                @if($activity->before_data || $activity->after_data)
                                    <details class="mt-2 text-[10px] font-bold text-slate-500">
                                        <summary class="cursor-pointer hover:text-indigo-600 outline-none list-none inline-flex items-center gap-1 select-none">
                                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 transform transition-transform details-arrow"></i>
                                            Detail Perubahan Data
                                        </summary>
                                        <div class="mt-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200 font-mono text-[9px] space-y-1.5 overflow-x-auto">
                                            @if($activity->before_data)
                                                <div><span class="text-rose-600 font-extrabold">Sebelum:</span> {{ json_encode($activity->before_data, JSON_UNESCAPED_UNICODE) }}</div>
                                            @endif
                                            @if($activity->after_data)
                                                <div><span class="text-emerald-650 font-extrabold">Sesudah:</span> {{ json_encode($activity->after_data, JSON_UNESCAPED_UNICODE) }}</div>
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
                    
                    <!-- Tabs Header -->
                    <div class="bg-slate-100/80 backdrop-blur-xs p-1.5 flex gap-1 border-b border-slate-200/50">
                        <button type="button" class="tab-btn active flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-extrabold rounded-lg transition-all cursor-pointer" data-tab="tab-status">
                            <i data-lucide="check-square" class="w-3.5 h-3.5"></i>
                            Status
                        </button>
                        <button type="button" class="tab-btn flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-extrabold rounded-lg text-slate-550 hover:text-slate-905 transition-all cursor-pointer" data-tab="tab-tanggapan">
                            <i data-lucide="send" class="w-3.5 h-3.5"></i>
                            Tanggapan
                        </button>
                        <button type="button" class="tab-btn flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-extrabold rounded-lg text-slate-550 hover:text-slate-905 transition-all cursor-pointer" data-tab="tab-komentar">
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
                                    <select name="status" id="status" class="block w-full text-xs font-medium rounded-lg border border-slate-200 bg-white px-3 h-10 outline-none focus:border-indigo-650 transition-all cursor-pointer" required>
                                        @foreach($statusLabels as $status => $label)
                                            <option value="{{ $status }}" {{ $pengaduan->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5" for="catatan">Catatan Perubahan</label>
                                    <textarea name="catatan" id="catatan" rows="3" class="block w-full text-xs font-medium rounded-lg border border-slate-200 bg-white px-3 py-2 outline-none focus:border-indigo-650 transition-all resize-none" placeholder="Tuliskan catatan alasan pengubahan status tiket..."></textarea>
                                </div>
                                <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-indigo-650 hover:bg-indigo-755 text-xs font-bold text-white shadow-md shadow-indigo-500/15 transition-all cursor-pointer">
                                    <i data-lucide="save" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Perbarui Status
                                </button>
                            </form>
                        </div>

                        <!-- Form 2: Kirim Tanggapan Resmi -->
                        <div id="tab-tanggapan" class="tab-content space-y-4 hidden">
                            <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Kirim Tanggapan Resmi</h4>
                            <p class="text-[10.5px] text-slate-500 leading-snug">Tanggapan resmi akan langsung terkirim dan dapat dilihat oleh mahasiswa pelapor di akun mereka.</p>
                            <form action="{{ route('admin.pengaduan.tanggapan.store', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5" for="isi_tanggapan">Pesan Tanggapan Resmi</label>
                                    <textarea name="isi_tanggapan" id="isi_tanggapan" rows="4" class="block w-full text-xs font-medium rounded-lg border border-slate-200 bg-white px-3 py-2 outline-none focus:border-indigo-650 transition-all" required placeholder="Tulis respon resmi, solusi, atau arahan untuk pelapor..."></textarea>
                                </div>
                                <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-indigo-650 hover:bg-indigo-755 text-xs font-bold text-white shadow-md shadow-indigo-500/15 transition-all cursor-pointer">
                                    <i data-lucide="send" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Kirim Tanggapan
                                </button>
                            </form>
                        </div>

                        <!-- Form 3: Komentar Lanjutan / Diskusi Internal -->
                        <div id="tab-komentar" class="tab-content space-y-4 hidden">
                            <h4 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider mb-2">Diskusi Lanjutan</h4>
                            
                            <div class="max-h-[220px] overflow-y-auto space-y-2.5 pr-1 border border-slate-100 p-2.5 rounded-xl bg-slate-50 shadow-3xs">
                                @forelse($pengaduan->comments as $comment)
                                    <div class="bg-white rounded-xl border border-slate-150 p-3 shadow-3xs space-y-1">
                                        <div class="flex items-center justify-between gap-2 border-b border-slate-100 pb-1 mb-1">
                                            <p class="text-[10px] font-extrabold text-slate-800 leading-none">{{ $comment->user->nama }}</p>
                                            <p class="text-[9px] text-slate-400 font-bold">{{ $comment->created_at->format('d M, H:i') }}</p>
                                        </div>
                                        <p class="text-xs text-slate-650 leading-snug font-semibold">
                                            {{ $comment->message }}
                                        </p>
                                    </div>
                                @empty
                                    <p class="text-[10px] text-slate-400 text-center py-6 font-bold">Belum ada diskusi komentar.</p>
                                @endforelse
                            </div>

                            <form action="{{ route('admin.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-4 pt-2 border-t border-slate-100">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5" for="message">Tambah Komentar Lanjutan</label>
                                    <textarea name="message" id="message" rows="3" class="block w-full text-xs font-medium rounded-lg border border-slate-200 bg-white px-3 py-2 outline-none focus:border-indigo-650 transition-all resize-none" required placeholder="Tulis komentar atau respon diskusi lanjutan..."></textarea>
                                </div>
                                <button type="submit" class="w-full inline-flex h-10 items-center justify-center rounded-lg bg-indigo-650 hover:bg-indigo-755 text-xs font-bold text-white shadow-md shadow-indigo-500/15 transition-all cursor-pointer">
                                    <i data-lucide="plus" class="w-3.5 h-3.5 mr-1.5"></i>
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>

                    </div>
                </article>
            @endif

            <!-- Card Riwayat Transisi Status -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="git-commit" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Perjalanan Log Status</h3>
                </div>
                
                <div class="relative border-l-2 border-slate-200 ml-2 pl-5 space-y-5 py-1">
                    @forelse($pengaduan->statusLogs as $log)
                        <div class="relative text-xs">
                            <span class="absolute -left-[29px] top-1.5 w-3 h-3 rounded-full bg-indigo-500 border-2 border-white shadow-xs animate-pulse"></span>
                            <div class="space-y-1">
                                <p class="font-bold text-slate-900 leading-none">
                                    Dari <span class="text-slate-400 font-semibold text-[10px] line-through">{{ $log->status_lama ?: 'awal' }}</span> 
                                    &rarr; 
                                    <span class="text-indigo-600 font-extrabold">{{ $log->status_baru }}</span>
                                </p>
                                
                                @if($log->catatan)
                                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200 text-[11px] text-slate-605 italic font-medium">
                                        "{{ $log->catatan }}"
                                    </div>
                                @endif
                                
                                <p class="text-[9px] text-slate-400 font-bold">
                                    Oleh: {{ $log->creator->nama }} • {{ $log->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 font-semibold py-1">Belum ada transisi status log.</p>
                    @endforelse
                </div>
            </article>

            <!-- Card Riwayat Tanggapan Resmi -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="message-square-quote" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Tanggapan Resmi Admin</h3>
                </div>
                
                <div class="space-y-3.5">
                    @forelse($pengaduan->tanggapan as $reply)
                        <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2.5">
                            <div class="flex items-center justify-between gap-2 border-b border-slate-200 pb-1.5">
                                <div class="flex items-center gap-1.5">
                                    <div class="w-5.5 h-5.5 rounded-md bg-gradient-to-tr from-indigo-500 to-violet-500 text-white text-[10px] font-black flex items-center justify-center shadow-3xs">
                                        {{ strtoupper(substr($reply->admin->nama, 0, 2)) }}
                                    </div>
                                    <span class="text-xs font-extrabold text-slate-800">{{ $reply->admin->nama }}</span>
                                </div>
                                <span class="text-[9px] text-slate-400 font-bold">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed whitespace-pre-wrap select-text font-semibold">
                                {{ $reply->isi_tanggapan }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-6 bg-slate-50/50 border border-dashed border-slate-200 rounded-xl">
                            <i data-lucide="message-square" class="w-6 h-6 text-slate-350 mx-auto mb-1"></i>
                            <p class="text-xs text-slate-450 font-bold">Belum ada tanggapan resmi dikeluarkan.</p>
                        </div>
                    @endforelse
                </div>
            </article>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Tab Switcher
            const tabButtons = document.querySelectorAll(".tab-btn");
            const tabContents = document.querySelectorAll(".tab-content");

            tabButtons.forEach(btn => {
                btn.addEventListener("click", () => {
                    const targetTabId = btn.getAttribute("data-tab");

                    tabButtons.forEach(b => {
                        b.classList.remove("active", "bg-indigo-600", "text-white", "shadow-md", "shadow-indigo-500/10", "font-bold");
                        b.classList.add("text-slate-550", "hover:text-slate-905");
                    });
                    btn.classList.add("active", "bg-indigo-600", "text-white", "shadow-md", "shadow-indigo-500/10", "font-bold");
                    btn.classList.remove("text-slate-550", "hover:text-slate-905");

                    tabContents.forEach(content => {
                        if (content.id === targetTabId) {
                            content.classList.remove("hidden");
                        } else {
                            content.classList.add("hidden");
                        }
                    });
                    
                    if (window.lucide) {
                        window.lucide.createIcons();
                    }
                });
            });

            // Set initial active tab
            const activeTab = document.querySelector(".tab-btn.active");
            if (activeTab) {
                activeTab.classList.add("bg-indigo-600", "text-white", "shadow-md", "shadow-indigo-500/10", "font-bold");
                activeTab.classList.remove("text-slate-550", "hover:text-slate-905");
            }

            // Details arrows rotation
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
@endsection
