@extends('layouts.mahasiswa')
<<<<<<< HEAD

@section('title', 'Detail Pengaduan')
@section('page_title', 'Detail Pengaduan')
@section('page_subtitle', 'Pantau rincian detail, lampiran berkas, timeline progress, dan respon resmi dari pihak kampus.')

@section('content')
    <!-- Breadcrumb -->
    <nav class="flex text-[10px] font-extrabold text-slate-450 tracking-wider uppercase mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1.5">
            <li><a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a></li>
            <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-300"></i></li>
            <li><span class="text-slate-800">Detail Pengaduan</span></li>
        </ol>
    </nav>

    <!-- Hero Card header -->
    <section class="bg-white/80 border border-slate-200/80 rounded-2xl p-6 lg:p-7 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden mb-6">
        <div class="space-y-3 max-w-4xl relative z-10">
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

                <span class="inline-flex items-center gap-1 text-[10px] font-extrabold uppercase tracking-wider bg-indigo-50 text-indigo-650 px-2.5 py-0.5 rounded-md border border-indigo-100 shadow-3xs">
                    <i data-lucide="flag" class="w-3 h-3"></i>
                    Prioritas: {{ $priorityLabels[$pengaduan->priority] ?? $pengaduan->priority }}
                </span>
            </div>

            <h1 class="text-xl sm:text-2xl lg:text-3xl font-extrabold tracking-tight leading-snug text-transparent bg-clip-text bg-gradient-to-r from-slate-900 via-indigo-950 to-violet-900">
                {{ $pengaduan->judul }}
            </h1>

            <p class="text-xs text-slate-500 font-medium leading-relaxed">
                Kategori: <strong class="text-slate-800 font-bold">{{ $pengaduan->kategori->nama_kategori }}</strong> 
                • Dilaporkan: <strong class="text-slate-800 font-bold">{{ $pengaduan->created_at->format('d M Y, H:i') }} WIB</strong>
                @if($pengaduan->due_at)
                • Target Selesai (SLA): <strong class="text-slate-800 font-bold">{{ $pengaduan->due_at->format('d M Y, H:i') }} WIB</strong>
                @endif
            </p>
        </div>

        <!-- Progress Tracker Block -->
        <div class="bg-white border border-slate-200 rounded-xl p-4.5 min-w-[280px] shadow-3xs z-10 space-y-3">
            <h4 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wider">Progress Penanganan</h4>
            
            <div class="relative flex items-center justify-between gap-1 w-full pt-1.5">
                <!-- Line indicator -->
                <div class="absolute top-[15px] left-3 right-3 h-1 bg-slate-100 rounded-full z-0">
                    @php
                        $doneStepsCount = collect($progressSteps)->whereIn('state', ['done', 'active'])->count();
                        $fillWidth = (($doneStepsCount - 1) / 4) * 100;
                    @endphp
                    <div class="h-full bg-emerald-500 rounded-full transition-all duration-700" style="width: {{ max(0, min(100, $fillWidth)) }}%"></div>
                </div>

                @foreach($progressSteps as $index => $step)
                    @php
                        $stepBg = 'border-slate-300 bg-white text-slate-400';
                        $iconHtml = '<span class="text-[10px] font-extrabold">' . ($index + 1) . '</span>';
                        
                        if ($step['state'] === 'done') {
                            $stepBg = 'border-emerald-500 bg-emerald-500 text-white';
                            $iconHtml = '<i data-lucide="check" class="w-3.5 h-3.5"></i>';
                        } elseif ($step['state'] === 'active') {
                            $stepBg = 'border-indigo-600 bg-indigo-600 text-white ring-4 ring-indigo-100';
                            $iconHtml = '<i data-lucide="clock" class="w-3.5 h-3.5 animate-spin" style="animation-duration:6s;"></i>';
                        }
                    @endphp
                    <div class="flex flex-col items-center z-10 group cursor-help" title="{{ $step['label'] }}">
                        <div class="w-7.5 h-7.5 rounded-full border-2 flex items-center justify-center transition-all duration-300 shadow-3xs {{ $stepBg }}">
                            {!! $iconHtml !!}
                        </div>
=======

@section('title', 'Detail Pengaduan')
@section('page_title', 'Detail Pengaduan')
@section('page_subtitle', $pengaduan->ticket_number ?? 'Pantau detail dan progress laporan.')

@section('styles')
    .detail-shell {
        display: grid;
        gap: 18px;
    }

    .detail-hero {
        border: 1px solid var(--glass-border);
        border-radius: 30px;
        padding: 24px;
        background:
            radial-gradient(circle at 16% 0%, color-mix(in srgb, var(--stock-blue) 34%, transparent), transparent 34%),
            radial-gradient(circle at 86% 10%, color-mix(in srgb, var(--stock-green) 20%, transparent), transparent 28%),
            linear-gradient(145deg, rgba(255,255,255,.12), transparent 42%),
            var(--glass-bg);
        backdrop-filter: blur(24px);
        box-shadow: 0 26px 76px rgba(0, 0, 0, .22);
        color: var(--text);
    }

    .detail-nav {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .detail-kicker {
        display: inline-flex;
        min-height: 32px;
        align-items: center;
        border-radius: 999px;
        padding: 0 12px;
        background: var(--primary-soft);
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 900;
    }

    .detail-title {
        font-size: clamp(31px, 5vw, 54px);
        line-height: 1.02;
        letter-spacing: -.05em;
        font-weight: 650;
        margin-bottom: 13px;
    }

    .detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px 14px;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.6;
    }

    .market-badge {
        min-height: 28px;
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 0 10px;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
    }

    .market-badge.pending,
    .market-badge.menunggu_klarifikasi,
    .market-badge.menunggu_verifikasi_mahasiswa {
        background: rgba(251, 191, 36, .16);
        color: #fbbf24;
        border: 1px solid rgba(251, 191, 36, .28);
    }

    .market-badge.proses,
    .market-badge.ditindaklanjuti {
        background: rgba(109, 199, 255, .16);
        color: var(--stock-blue);
        border: 1px solid rgba(109, 199, 255, .28);
    }

    .market-badge.selesai {
        background: rgba(51, 214, 159, .16);
        color: var(--stock-green);
        border: 1px solid rgba(51, 214, 159, .28);
    }

    .market-badge.ditolak {
        background: rgba(255, 107, 122, .16);
        color: var(--stock-red);
        border: 1px solid rgba(255, 107, 122, .28);
    }

    .progress-card {
        margin-top: 22px;
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 18px;
        background: var(--glass-bg-strong);
        backdrop-filter: blur(20px);
    }

    .progress-head {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 900;
        color: var(--text);
    }

    .section-subtitle {
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
        margin-top: 5px;
    }

    .progress-track {
        position: relative;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        margin-top: 12px;
    }

    .progress-line {
        position: absolute;
        top: 16px;
        left: 10%;
        right: 10%;
        height: 4px;
        border-radius: 999px;
        background: color-mix(in srgb, var(--muted) 22%, transparent);
    }

    .progress-line-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        width: {{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%;
    }

    .progress-step {
        position: relative;
        display: grid;
        gap: 8px;
        justify-items: center;
        text-align: center;
        color: var(--muted);
        font-size: 11px;
        font-weight: 900;
    }

    .progress-dot {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        border: 2px solid color-mix(in srgb, var(--muted) 36%, transparent);
        background: var(--glass-bg-strong);
        color: var(--muted);
        z-index: 1;
        box-shadow: 0 0 0 5px color-mix(in srgb, var(--glass-bg) 86%, transparent);
    }

    .progress-check {
        width: 18px;
        height: 18px;
        display: none;
    }

    .progress-step.done,
    .progress-step.active {
        color: var(--stock-green);
    }

    .progress-step.done .progress-dot,
    .progress-step.active .progress-dot {
        border-color: var(--stock-green);
        background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        color: #03111f;
        box-shadow: 0 12px 24px color-mix(in srgb, var(--stock-green) 24%, transparent), 0 0 0 5px color-mix(in srgb, var(--glass-bg) 86%, transparent);
    }

    .progress-step.done .progress-check,
    .progress-step.active .progress-check {
        display: block;
    }

    .progress-step.done .progress-number,
    .progress-step.active .progress-number {
        display: none;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(320px, .75fr);
        gap: 18px;
        align-items: start;
    }

    .detail-card {
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 18px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.1), transparent 44%),
            var(--glass-bg);
        backdrop-filter: blur(22px);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .18);
        margin-bottom: 18px;
    }

    .body-text {
        white-space: pre-wrap;
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 15px;
        background: var(--glass-bg-strong);
    }

    .attachments,
    .activity-feed {
        display: grid;
        gap: 10px;
    }

    .attachment,
    .feed-item {
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 13px;
        background: var(--glass-bg-strong);
        color: var(--text);
        text-decoration: none;
        font-size: 13px;
        line-height: 1.55;
    }

    .attachment img {
        display: block;
        width: 100%;
        max-height: 240px;
        object-fit: cover;
        border-radius: 14px;
        margin-top: 10px;
        border: 1px solid var(--glass-border);
    }

    .feed-meta {
        color: var(--muted);
        font-size: 12px;
        margin-top: 5px;
    }

    .form-grid {
        display: grid;
        gap: 12px;
    }

    .form-label {
        display: block;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 6px;
        color: var(--text);
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        background: var(--glass-bg-strong);
        color: var(--text);
        padding: 11px 12px;
        font-size: 13px;
        outline: none;
    }

    .form-input,
    .form-select {
        min-height: 44px;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    @media (max-width: 960px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .detail-hero,
        .detail-card,
        .progress-card {
            border-radius: 22px;
            padding: 16px;
        }

        .detail-nav,
        .progress-head {
            display: grid;
        }

        .progress-track {
            grid-template-columns: 1fr;
            gap: 0;
            margin-top: 16px;
        }

        .progress-line {
            top: 17px;
            bottom: 17px;
            left: 16px;
            right: auto;
            width: 4px;
            height: auto;
        }

        .progress-line-fill {
            width: 100%;
            height: {{ max(0, min(100, ((collect($progressSteps)->whereIn('state', ['done', 'active'])->count() - 1) / 4) * 100)) }}%;
            background: linear-gradient(180deg, var(--stock-blue), var(--stock-green));
        }

        .progress-step {
            grid-template-columns: 34px 1fr;
            justify-items: start;
            text-align: left;
            align-items: center;
            min-height: 50px;
            gap: 12px;
        }

        .progress-dot {
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--glass-bg) 88%, transparent);
        }
    }
@endsection

@section('content')
    <section class="detail-shell">
        <article class="detail-hero">
            <div class="detail-nav">
                <div>
                    <div class="detail-kicker">{{ $pengaduan->kategori->nama_kategori }}</div>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-soft">Kembali ke Riwayat</a>
            </div>

            <h1 class="detail-title">{{ $pengaduan->judul }}</h1>
            <div class="detail-meta">
                <span>Tiket: <strong>{{ $pengaduan->ticket_number ?? 'Belum tersedia' }}</strong></span>
                <span class="market-badge {{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                <span>Prioritas: <strong>{{ $priorityLabels[$pengaduan->priority] ?? ucfirst($pengaduan->priority ?? 'sedang') }}</strong></span>
                <span>Dibuat: {{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                @if($pengaduan->due_at)
                    <span>SLA: {{ $pengaduan->due_at->format('d M Y, H:i') }}</span>
                @endif
            </div>

            <div class="progress-card" aria-label="Progress pengaduan">
                <div class="progress-head">
                    <div>
                        <div class="section-title">Progress Pengaduan</div>
                        <p class="section-subtitle">Pantau posisi laporan Anda dari tahap pengajuan sampai penyelesaian.</p>
                    </div>
                    <span class="market-badge {{ $pengaduan->status }}">{{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}</span>
                </div>
                <div class="progress-track">
                    <div class="progress-line"><div class="progress-line-fill"></div></div>
                    @foreach($progressSteps as $index => $step)
                        <div class="progress-step {{ $step['state'] }}">
                            <span class="progress-dot">
                                <svg class="progress-check" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12.5 4.2 4.2L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="progress-number">{{ $index + 1 }}</span>
                            </span>
                            <span>{{ $step['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </article>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
        @if($errors->any())
            <div class="alert alert-danger"><ul style="padding-left:16px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <div class="detail-grid">
            <section>
                <article class="detail-card">
                    <div class="section-title">Isi Laporan</div>
                    <div class="body-text">{{ $pengaduan->isi_pengaduan }}</div>
                </article>

                <article class="detail-card">
                    <div class="section-title">Lampiran</div>
                    @if($pengaduan->lampiran->isEmpty())
                        <p class="section-subtitle">Belum ada lampiran.</p>
                    @else
                        <div class="attachments">
                            @foreach($pengaduan->lampiran as $file)
                                <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment">
                                    {{ $file->nama_file }} <span style="color:var(--muted);font-weight:600;">({{ $file->tipe_file }})</span>
                                    @if(Str::startsWith($file->tipe_file, 'image/'))
                                        <img src="{{ asset('storage/' . $file->path_file) }}" alt="{{ $file->nama_file }}">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </article>

                <article class="detail-card">
                    <div class="section-title">Komentar Lanjutan</div>
                    <div class="activity-feed" style="margin-bottom:14px;">
                        @forelse($pengaduan->comments as $comment)
                            <div class="feed-item">
                                <strong>{{ $comment->user->nama }}</strong>
                                <div>{{ $comment->message }}</div>
                                <div class="feed-meta">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada komentar lanjutan.</p>
                        @endforelse
>>>>>>> origin/Abiyyu-dev
                    </div>
                @endforeach
            </div>
            
            <div class="text-[10.5px] text-slate-500 font-bold text-center">
                Tahapan Saat ini: <span class="text-indigo-600">
                    @php
                        $activeStep = collect($progressSteps)->where('state', 'active')->first() ?? collect($progressSteps)->where('state', 'done')->last();
                        echo $activeStep ? $activeStep['label'] : 'Pending';
                    @endphp
                </span>
            </div>
        </div>
    </section>

<<<<<<< HEAD
    <!-- Two Columns Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start relative z-10">
        
        <!-- Left Column: Details & Comments -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Detail Keluhan -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Isi Laporan / Detail Pengaduan</h3>
                </div>
                <div class="bg-slate-50 border border-slate-150 rounded-xl p-5 text-xs sm:text-sm text-slate-750 leading-relaxed whitespace-pre-wrap select-text font-medium">
                    {{ $pengaduan->isi_pengaduan }}
                </div>
            </article>

            <!-- Card Lampiran -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="paperclip" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Berkas Lampiran Pendukung</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
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
                            <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-650 hover:bg-indigo-100 flex-shrink-0 transition-colors" title="Buka Berkas">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                            </a>
                        </div>
                    @empty
                        <div class="sm:col-span-2 text-center py-6 bg-slate-50/50 border border-dashed border-slate-200 rounded-xl">
                            <i data-lucide="info" class="w-5 h-5 text-slate-350 mx-auto mb-1"></i>
                            <p class="text-[11px] text-slate-500 font-semibold">Tidak ada lampiran dokumen untuk pengaduan ini.</p>
                        </div>
                    @endforelse
                </div>
            </article>

            <!-- Card Komentar Diskusi Lanjutan -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-6 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="message-square" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Komentar & Diskusi Lanjutan</h3>
                </div>

                <!-- Chat bubble style list -->
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-1">
                    @forelse($pengaduan->comments as $comment)
                        @php
                            $isMe = $comment->id_user === Auth::id();
                        @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%] rounded-2xl px-4 py-2.5 shadow-3xs text-xs font-semibold leading-relaxed border
                                {{ $isMe ? 'bg-indigo-650 border-indigo-700 text-white rounded-br-none' : 'bg-slate-50 border-slate-200/80 text-slate-800 rounded-bl-none' }}
                            ">
                                <div class="flex items-center gap-2 border-b border-white/10 pb-1 mb-1 text-[9.5px] font-bold opacity-80 justify-between">
                                    <span>{{ $isMe ? 'Saya' : $comment->user->nama }}</span>
                                    <span>{{ $comment->created_at->format('d M, H:i') }}</span>
                                </div>
                                <p>{{ $comment->message }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-450 font-bold py-6 text-[11px]">Belum ada komentar diskusi lanjutan.</p>
                    @endforelse
                </div>

                <!-- Comment Form -->
                <form action="{{ route('mahasiswa.pengaduan.comment', $pengaduan->id_pengaduan) }}" method="POST" class="pt-4 border-t border-slate-100 space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1" for="message">Tambah Komentar Diskusi</label>
                        <textarea name="message" id="message" rows="3" class="form-textarea font-semibold" placeholder="Tulis pesan komentar atau tambahan informasi laporan..." required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary flex items-center gap-1.5 h-9 text-xs"><i data-lucide="send" class="w-3.5 h-3.5"></i> Kirim Komentar</button>
                    </div>
                </form>
            </article>
        </div>

        <!-- Right Column: Audit Logs & Action forms (reopen/cancel) -->
        <div class="space-y-6">
            
            <!-- Card Riwayat Status Log -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="route" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Perjalanan Log Status</h3>
                </div>
                
                <div class="relative border-l-2 border-slate-200 ml-2 pl-4 space-y-5 py-1">
                    @forelse($pengaduan->statusLogs as $log)
                        <div class="relative text-xs">
                            <span class="absolute -left-[28px] top-1.5 w-3 h-3 rounded-full bg-slate-300 border-2 border-white shadow-xs"></span>
                            <div class="space-y-1">
                                <p class="font-extrabold text-slate-900 leading-none">
                                    Dari <span class="text-slate-400 font-semibold text-[10px] line-through">{{ $log->status_lama ?: 'awal' }}</span> 
                                    &rarr; 
                                    <span class="text-indigo-600 font-bold">{{ $log->status_baru }}</span>
                                </p>
                                
                                @if($log->catatan)
                                    <div class="p-2 bg-slate-50 border border-slate-150 text-[10.5px] text-slate-650 italic font-semibold rounded-lg">
                                        "{{ $log->catatan }}"
                                    </div>
                                @endif
                                
                                <p class="text-[9px] text-slate-400 font-bold">
                                    {{ $log->creator->nama }} • {{ $log->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-450 font-semibold py-1">Belum ada perubahan status log.</p>
                    @endforelse
                </div>
            </article>

            <!-- Card Riwayat Tanggapan Resmi -->
            <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 hover:shadow-sm transition-shadow duration-300 space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i data-lucide="message-square-quote" class="w-4.5 h-4.5 text-indigo-650"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">Tanggapan Resmi Admin</h3>
                </div>
                
                <div class="space-y-3">
                    @forelse($pengaduan->tanggapan as $reply)
                        <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                            <div class="flex items-center justify-between gap-2 border-b border-slate-150 pb-1.5">
                                <span class="text-[11px] font-extrabold text-indigo-650 flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Admin: {{ $reply->admin->nama }}</span>
                                <span class="text-[9.5px] text-slate-400 font-bold">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <p class="text-xs text-slate-700 leading-relaxed font-semibold">
                                {{ $reply->isi_tanggapan }}
                            </p>
                        </div>
                    @empty
                        <p class="text-xs text-slate-450 font-semibold text-center py-4">Belum ada respon tanggapan resmi admin.</p>
                    @endforelse
                </div>
            </article>

            <!-- Action Panel: Edit / Cancel / Confirm / Reopen Forms -->
            @if($pengaduan->isEditable())
                <!-- Edit & Cancel panel -->
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 space-y-5">
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3.5 flex items-center gap-1.5"><i data-lucide="edit-3" class="w-4 h-4 text-indigo-650"></i> Edit Pengaduan</h4>
                        <form action="{{ route('mahasiswa.pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data" class="space-y-3.5">
=======
                <article class="detail-card">
                    <div class="section-title">Tanggapan Admin</div>
                    <div class="activity-feed">
                        @forelse($pengaduan->tanggapan as $reply)
                            <div class="feed-item">
                                <strong>{{ $reply->admin->nama }}</strong>
                                <div>{{ $reply->isi_tanggapan }}</div>
                                <div class="feed-meta">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada tanggapan admin.</p>
                        @endforelse
                    </div>
                </article>
            </section>

            <aside>
                <article class="detail-card">
                    <div class="section-title">Riwayat Status</div>
                    <div class="activity-feed">
                        @forelse($pengaduan->statusLogs as $log)
                            <div class="feed-item">
                                <div><strong>{{ $log->status_lama ?: 'awal' }}</strong> menjadi <strong>{{ $log->status_baru }}</strong></div>
                                @if($log->catatan)<div>{{ $log->catatan }}</div>@endif
                                <div class="feed-meta">{{ $log->creator->nama }} - {{ $log->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        @empty
                            <p class="section-subtitle">Belum ada perubahan status.</p>
                        @endforelse
                    </div>
                </article>

                @if($pengaduan->isEditable())
                    <article class="detail-card">
                        <div class="section-title">Edit Pengaduan Pending</div>
                        <form action="{{ route('mahasiswa.pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST" enctype="multipart/form-data" class="form-grid">
>>>>>>> origin/Abiyyu-dev
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="form-label" for="id_kategori">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-select font-semibold" required>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id_kategori }}" {{ $pengaduan->id_kategori === $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="judul">Judul Laporan</label>
                                <input type="text" id="judul" name="judul" class="form-input font-semibold" value="{{ old('judul', $pengaduan->judul) }}" required>
                            </div>
                            <div>
                                <label class="form-label" for="priority">Prioritas</label>
                                <select name="priority" id="priority" class="form-select font-semibold" required>
                                    @foreach($priorityLabels as $key => $label)
                                        <option value="{{ $key }}" {{ old('priority', $pengaduan->priority ?? 'sedang') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="isi_pengaduan">Isi Pengaduan</label>
                                <textarea id="isi_pengaduan" name="isi_pengaduan" class="form-textarea font-semibold" required>{{ old('isi_pengaduan', $pengaduan->isi_pengaduan) }}</textarea>
                            </div>
                            <div>
                                <label class="form-label" for="lampiran">Tambah Lampiran Berkas</label>
                                <input type="file" id="lampiran" name="lampiran[]" class="form-input" multiple accept=".pdf,.docx,.jpg,.jpeg,.png">
                                <div id="filePreview" class="file-note mt-2.5 grid gap-2 grid-cols-1"></div>
                            </div>
                            <button type="submit" class="btn-primary w-full text-xs">Simpan Perubahan</button>
                        </form>
                    </div>

<<<<<<< HEAD
                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3.5 flex items-center gap-1.5"><i data-lucide="x-circle" class="w-4 h-4 text-rose-600"></i> Batalkan Pengaduan</h4>
                        <form action="{{ route('mahasiswa.pengaduan.cancel', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
                            @csrf
                            <div>
                                <label class="form-label" for="cancel_reason">Alasan Pembatalan</label>
                                <textarea id="cancel_reason" name="cancel_reason" rows="2" class="form-textarea font-semibold" placeholder="Opsional..."></textarea>
                            </div>
                            <button type="submit" class="btn-danger w-full text-xs cursor-pointer shadow-md shadow-rose-500/10">Batalkan Pengaduan</button>
=======
                    <article class="detail-card">
                        <div class="section-title">Batalkan Pengaduan</div>
                        <form action="{{ route('mahasiswa.pengaduan.cancel', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid">
                            @csrf
                            <textarea id="cancel_reason" name="cancel_reason" class="form-textarea" placeholder="Alasan pembatalan, opsional"></textarea>
                            <button type="submit" class="btn-danger">Batalkan Pengaduan</button>
>>>>>>> origin/Abiyyu-dev
                        </form>
                    </div>
                </article>
            @endif

<<<<<<< HEAD
            @if(in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true) && !$pengaduan->completed_confirmed_at)
                <!-- Completion verification and reopen forms -->
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 space-y-5">
                    <div>
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3 flex items-center gap-1.5 text-emerald-650"><i data-lucide="check-circle" class="w-4 h-4"></i> Konfirmasi Penyelesaian</h4>
                        <p class="text-[10.5px] text-slate-500 mb-3">Jika masalah sudah teratasi dengan benar, silakan lakukan konfirmasi selesai.</p>
                        <form action="{{ route('mahasiswa.pengaduan.confirm', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
=======
                @if(in_array($pengaduan->status, ['selesai', 'menunggu_verifikasi_mahasiswa'], true) && !$pengaduan->completed_confirmed_at)
                    <article class="detail-card">
                        <div class="section-title">Konfirmasi Penyelesaian</div>
                        <form action="{{ route('mahasiswa.pengaduan.confirm', $pengaduan->id_pengaduan) }}" method="POST" class="form-grid" style="margin-bottom:12px;">
>>>>>>> origin/Abiyyu-dev
                            @csrf
                            <div>
                                <label class="form-label" for="completion_note">Catatan Penyelesaian</label>
                                <textarea name="completion_note" id="completion_note" rows="2" class="form-textarea font-semibold" placeholder="Catatan opsional setelah masalah terselesaikan..."></textarea>
                            </div>
                            <button type="submit" class="btn-primary w-full text-xs bg-emerald-600 hover:bg-emerald-700 border border-emerald-650 shadow-md shadow-emerald-500/10 cursor-pointer">Konfirmasi Selesai</button>
                        </form>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-extrabold text-slate-900 uppercase border-b border-slate-100 pb-2 mb-3 flex items-center gap-1.5 text-rose-600"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Buka Ulang Tiket</h4>
                        <p class="text-[10.5px] text-slate-500 mb-3">Buka kembali jika masalah belum terselesaikan secara tuntas.</p>
                        <form action="{{ route('mahasiswa.pengaduan.reopen', $pengaduan->id_pengaduan) }}" method="POST" class="space-y-3.5">
                            @csrf
                            <div>
                                <label class="form-label" for="reopen_message">Alasan Buka Ulang</label>
                                <textarea name="message" id="reopen_message" rows="2.5" class="form-textarea font-semibold" placeholder="Jelaskan bagian mana yang masih bermasalah dan belum ditindaklanjuti secara tuntas..." required></textarea>
                            </div>
                            <button type="submit" class="btn-danger w-full text-xs cursor-pointer shadow-md shadow-rose-500/10">Buka Ulang Laporan</button>
                        </form>
<<<<<<< HEAD
                    </div>
                </article>
            @elseif($pengaduan->completed_confirmed_at)
                <article class="bg-white border border-slate-200/80 shadow-3xs rounded-2xl p-5 border-l-4 border-l-emerald-500 space-y-2">
                    <h4 class="text-xs font-extrabold text-emerald-700 uppercase flex items-center gap-1.5"><i data-lucide="check-circle" class="w-4.5 h-4.5"></i> Penyelesaian Dikonfirmasi</h4>
                    <p class="text-xs text-slate-650 font-semibold leading-relaxed">
                        Laporan pengaduan ini telah selesai ditangani dan konfirmasi penutupan tiket disetujui pada tanggal <strong class="text-slate-800">{{ $pengaduan->completed_confirmed_at->format('d M Y, H:i') }} WIB</strong>.
                    </p>
                </article>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Live file attachments preview logic inside edit panel
            document.getElementById('lampiran')?.addEventListener('change', function () {
                const preview = document.getElementById('filePreview');
                if(!preview) return;

                const files = Array.from(this.files || []);
                preview.innerHTML = ''; // Reset

                if (files.length === 0) return;

                files.forEach((file) => {
                    const sizeInMb = (file.size / (1024 * 1024)).toFixed(2);
                    const isTooLarge = file.size > 2 * 1024 * 1024;
                    const containerClass = isTooLarge
                        ? 'border border-rose-200 bg-rose-50/50 text-rose-750 p-2.5 rounded-lg flex items-center justify-between gap-3 text-xs shadow-3xs'
                        : 'border border-slate-200 bg-white text-slate-700 p-2.5 rounded-lg flex items-center justify-between gap-3 text-xs shadow-3xs hover:border-indigo-250 transition-all';
                    
                    const fileCard = document.createElement('div');
                    fileCard.className = containerClass;
                    
                    let previewIcon = '<i data-lucide="file-text" class="w-4 h-4 flex-shrink-0 text-slate-400"></i>';
                    if (file.type.startsWith('image/')) {
                        previewIcon = '<i data-lucide="image" class="w-4 h-4 flex-shrink-0 text-indigo-600"></i>';
                    }

                    fileCard.innerHTML = `
                        <div class="flex items-center gap-2 min-w-0">
                            ${previewIcon}
                            <div class="min-w-0">
                                <p class="font-bold truncate text-slate-800 text-[11px]" title="${file.name}">${file.name}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase">${sizeInMb} MB ${isTooLarge ? '• UKURAN MELEBIHI BATAS!' : ''}</p>
                            </div>
                        </div>
                        ${isTooLarge ? '<i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-rose-600 flex-shrink-0"></i>' : '<i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600 flex-shrink-0"></i>'}
                    `;
                    
                    preview.appendChild(fileCard);
                });

                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });
    </script>
=======
                    </article>
                @elseif($pengaduan->completed_confirmed_at)
                    <article class="detail-card">
                        <div class="section-title">Penyelesaian Dikonfirmasi</div>
                        <p class="section-subtitle">Dikonfirmasi pada {{ $pengaduan->completed_confirmed_at->format('d M Y, H:i') }}.</p>
                    </article>
                @endif
            </aside>
        </div>
    </section>
>>>>>>> origin/Abiyyu-dev
@endsection
