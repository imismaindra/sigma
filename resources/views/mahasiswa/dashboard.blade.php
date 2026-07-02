@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')
@section('page_title', 'Dashboard Mahasiswa')
@section('page_subtitle', 'Ajukan laporan baru, pantau status pengerjaan, dan baca tanggapan resmi admin.')

@section('content')
    <!-- Hero Banner Portal -->
    <section class="page-hero">
        <article class="hero-card bg-gradient-to-tr from-white to-slate-50/50">
            <div class="eyebrow">Portal Layanan SIPMA</div>
            <h1>Kelola pengaduan kampus dengan lebih terarah.</h1>
            <p>Sampaikan kendala akademik, administrasi, fasilitas sarana prasarana, kebersihan, keamanan, dan sistem IT dalam satu dashboard terpadu yang transparan dan mudah dipantau.</p>
        </article>

        <aside class="guide-card panel bg-white/80">
            <div>
                <strong class="flex items-center gap-1.5 text-indigo-650"><i data-lucide="help-circle" class="w-4 h-4"></i> Tips Pengaduan</strong>
                <p>Sertakan kronologi kejadian secara runtut, lokasi fisik yang jelas, tanggal kejadian, dan berkas lampiran pendukung agar laporan Anda dapat langsung divalidasi admin.</p>
            </div>
            <div class="flex gap-2.5 flex-wrap">
                <a href="{{ route('mahasiswa.pengaduan.create') }}" class="btn-primary flex items-center gap-1.5"><i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Laporan</a>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-secondary flex items-center gap-1.5"><i data-lucide="history" class="w-4 h-4"></i> Riwayat</a>
            </div>
        </aside>
    </section>

    <!-- Stats Cards Summary Grid -->
    <section class="stats-grid" aria-label="Ringkasan pengaduan">
        <article class="stat-card border-l-4 border-slate-400 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Total Laporan</div>
                <i data-lucide="folder" class="w-4 h-4 text-slate-400"></i>
            </div>
            <div class="stat-value">{{ $summary['total'] }}</div>
            <div class="stat-hint">Seluruh laporan Anda</div>
        </article>
        
        <article class="stat-card border-l-4 border-amber-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Pending</div>
                <i data-lucide="clock" class="w-4 h-4 text-amber-500"></i>
            </div>
            <div class="stat-value text-amber-650">{{ $summary['pending'] }}</div>
            <div class="stat-hint">Menunggu verifikasi admin</div>
        </article>
        
        <article class="stat-card border-l-4 border-blue-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Proses</div>
                <i data-lucide="refresh-cw" class="w-4 h-4 text-blue-500 animate-spin" style="animation-duration: 8s;"></i>
            </div>
            <div class="stat-value text-blue-600">{{ $summary['proses'] }}</div>
            <div class="stat-hint">Sedang ditindaklanjuti</div>
        </article>
        
        <article class="stat-card border-l-4 border-emerald-500 bg-white/90">
            <div class="flex justify-between items-start w-full">
                <div class="stat-label">Selesai</div>
                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>
            </div>
            <div class="stat-value text-emerald-650">{{ $summary['selesai'] }}</div>
            <div class="stat-hint">Selesai ditangani</div>
        </article>
    </section>

    <!-- Alerts Messages -->
    @if(session('success'))
        <div class="alert alert-success flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger flex items-center gap-2">
            <i data-lucide="alert-octagon" class="w-4 h-4"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Interactive Filters Form panel -->
    <section class="filter-panel bg-white/80" aria-label="Filter pengaduan">
        <div class="panel-head">
            <div>
                <div class="panel-title flex items-center gap-1.5"><i data-lucide="search" class="w-4 h-4 text-indigo-600"></i> Pencarian & Penyaringan Laporan</div>
                <p class="panel-subtitle">Cari laporan berdasarkan kata kunci, status aduan, prioritas urgensi, dan rentang tanggal.</p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.dashboard') }}" method="GET" class="filter-form">
            <div>
                <label for="q" class="form-label">Kata Kunci</label>
                <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul atau isi pengaduan">
            </div>
            <div>
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="form-label">Prioritas</label>
                <select id="priority" name="priority" class="form-select">
                    <option value="">Semua Prioritas</option>
                    @foreach($priorityLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ (string) request('kategori') === (string) $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="tanggal_mulai" class="form-label">Mulai</label>
                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-input" value="{{ request('tanggal_mulai') }}">
            </div>
            <div>
                <label for="tanggal_selesai" class="form-label">Selesai</label>
                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-input" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn-primary flex items-center justify-center gap-1.5"><i data-lucide="filter" class="w-4 h-4"></i> Filter</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center justify-center gap-1.5"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Reset</a>
            </div>
        </form>
    </section>

    <!-- Student Notifications List -->
    @if($notifications->isNotEmpty())
        <section class="notification-panel bg-white/80" aria-label="Notifikasi terbaru">
            <div class="panel-head">
                <div>
                    <div class="panel-title flex items-center gap-1.5 text-indigo-650"><i data-lucide="bell" class="w-4.5 h-4.5 animate-bounce" style="animation-duration: 2.5s;"></i> Notifikasi Progres Laporan</div>
                    <p class="panel-subtitle">Terdapat {{ $unreadNotifications }} pemberitahuan yang belum dibaca dari administrator.</p>
                </div>
            </div>
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <a href="{{ $notification->pengaduan ? route('mahasiswa.pengaduan.show', $notification->pengaduan->id_pengaduan) : '#' }}" class="notification-item {{ $notification->read_at ? '' : 'unread' }} flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 {{ $notification->read_at ? 'bg-slate-300' : 'bg-indigo-600' }}"></div>
                        <div class="min-w-0 flex-1">
                            <div class="notification-title">{{ $notification->title }}</div>
                            <div class="notification-message">{{ $notification->message }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Recent Complaints History list -->
    <section>
        <article class="panel bg-white/90">
            <div class="panel-head">
                <div>
                    <div class="panel-title flex items-center gap-1.5"><i data-lucide="clipboard-list" class="w-4.5 h-4.5 text-indigo-600"></i> Riwayat Pengaduan Saya</div>
                    <p class="panel-subtitle">Menampilkan {{ $pengaduans->count() }} laporan terbaru. Gunakan halaman riwayat penuh untuk filter lebih spesifik.</p>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-soft flex items-center gap-1.5"><i data-lucide="list" class="w-4 h-4"></i> Buka Riwayat Lengkap</a>
            </div>

            @if($pengaduans->count() === 0)
                <div class="empty-state">
                    <i data-lucide="info" class="w-10 h-10 text-slate-300 mx-auto mb-2 animate-pulse"></i>
                    Belum ada pengaduan yang cocok dengan filter pencarian saat ini.
                </div>
            @else
                <div class="complaint-list">
                    @foreach($pengaduans as $p)
                        <article class="complaint-card hover:-translate-y-0.5">
                            <div class="complaint-top">
                                <div class="min-w-0">
                                    <h4 class="complaint-title truncate">{{ $p->judul }}</h4>
                                    <div class="complaint-meta mt-1.5">
                                        <span class="flex items-center gap-1"><i data-lucide="hash" class="w-3.5 h-3.5"></i> Tiket: <strong>{{ $p->ticket_number ?? 'PGD' }}</strong></span>
                                        <span class="flex items-center gap-1"><i data-lucide="flag" class="w-3.5 h-3.5"></i> Prioritas: <strong>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</strong></span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-1.5 justify-end">
                                    @if($p->isOverdue())
                                        <span class="sla-badge">Lewat SLA</span>
                                    @endif
                                    <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                </div>
                            </div>
                            <div class="complaint-meta">
                                <span class="flex items-center gap-1"><i data-lucide="tag" class="w-3.5 h-3.5"></i> Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> Dilaporkan: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
                            </div>
                            <p class="complaint-body">{{ Str::limit($p->isi_pengaduan, 180) }}</p>
                            <div class="complaint-actions">
                                <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="btn-soft flex items-center gap-1"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat Detail</a>
                                @if($p->isEditable())
                                    <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}#edit" class="btn-secondary flex items-center gap-1"><i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Edit</a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
                
                <div class="mt-4">
                    @include('partials.simple-pagination', ['paginator' => $pengaduans])
                </div>
            @endif
        </article>
    </section>
@endsection
