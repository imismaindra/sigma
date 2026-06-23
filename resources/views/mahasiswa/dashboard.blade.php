@extends('layouts.mahasiswa')

@section('title', 'Dashboard Mahasiswa')
@section('page_title', 'Dashboard Mahasiswa')
@section('page_subtitle', 'Ajukan laporan, pantau status, dan baca tanggapan admin.')

@section('content')
    <section class="page-hero">
        <article class="hero-card">
            <div class="eyebrow">Portal layanan kampus</div>
            <h1>Kelola pengaduan kampus dengan lebih terarah.</h1>
            <p>Sampaikan kendala akademik, administrasi, fasilitas, kebersihan, keamanan, dan sistem IT dalam satu dashboard yang rapi dan mudah dipantau.</p>
        </article>

        <aside class="guide-card panel">
            <div>
                <strong>Tips pengaduan</strong>
                <p>Sertakan kronologi, lokasi, tanggal kejadian, dan lampiran pendukung agar laporan lebih cepat diverifikasi.</p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <a href="{{ route('mahasiswa.pengaduan.create') }}" class="btn-primary">Buat Pengaduan</a>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-secondary">Riwayat Pengaduan</a>
            </div>
        </aside>
    </section>

    <section class="stats-grid" aria-label="Ringkasan pengaduan">
        <article class="stat-card">
            <div class="stat-label">Total Laporan</div>
            <div class="stat-value">{{ $summary['total'] }}</div>
            <div class="stat-hint">Semua laporan Anda</div>
        </article>
        <article class="stat-card">
            <div class="stat-label">Pending</div>
            <div class="stat-value" style="color:var(--pending);">{{ $summary['pending'] }}</div>
            <div class="stat-hint">Menunggu verifikasi</div>
        </article>
        <article class="stat-card">
            <div class="stat-label">Proses</div>
            <div class="stat-value" style="color:var(--proses);">{{ $summary['proses'] }}</div>
            <div class="stat-hint">Sedang ditindaklanjuti</div>
        </article>
        <article class="stat-card">
            <div class="stat-label">Selesai</div>
            <div class="stat-value" style="color:var(--selesai);">{{ $summary['selesai'] }}</div>
            <div class="stat-hint">Sudah diselesaikan</div>
        </article>
    </section>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="padding-left:16px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="filter-panel" aria-label="Filter pengaduan">
        <div class="panel-head">
            <div>
                <div class="panel-title">Filter Pengaduan</div>
                <p class="panel-subtitle">Cari laporan berdasarkan kata kunci, status, kategori, dan tanggal.</p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.dashboard') }}" method="GET" class="filter-form">
            <div>
                <label for="q" class="form-label">Cari</label>
                <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul atau isi laporan">
            </div>
            <div>
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">Semua</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="form-label">Prioritas</label>
                <select id="priority" name="priority" class="form-select">
                    <option value="">Semua</option>
                    @foreach($priorityLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select">
                    <option value="">Semua</option>
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
                <button type="submit" class="btn-primary">Filter</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Reset</a>
            </div>
        </form>
    </section>

    @if($notifications->isNotEmpty())
        <section class="notification-panel" aria-label="Notifikasi terbaru">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Notifikasi</div>
                    <p class="panel-subtitle">{{ $unreadNotifications }} notifikasi belum dibaca.</p>
                </div>
            </div>
            <div class="notification-list">
                @foreach($notifications as $notification)
                    <a href="{{ $notification->pengaduan ? route('mahasiswa.pengaduan.show', $notification->pengaduan->id_pengaduan) : '#' }}" class="notification-item {{ $notification->read_at ? '' : 'unread' }}">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-message">{{ $notification->message }}</div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <section>
        <article class="panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Riwayat Pengaduan Saya</div>
                    <p class="panel-subtitle">{{ $pengaduans->total() }} laporan terbaru. Halaman riwayat menyediakan filter dan progress yang lebih lengkap.</p>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-soft">Buka Riwayat Lengkap</a>
            </div>

            @if($pengaduans->count() === 0)
                <div class="empty-state">
                    Belum ada pengaduan yang cocok dengan filter saat ini.
                </div>
            @else
                <div class="complaint-list">
                    @foreach($pengaduans as $p)
                        <article class="complaint-card">
                            <div class="complaint-top">
                                <div>
                                    <div class="complaint-title">{{ $p->judul }}</div>
                                    <div class="complaint-meta" style="margin-top:6px;">
                                        <span>Tiket: <strong>{{ $p->ticket_number ?? 'Belum tersedia' }}</strong></span>
                                        <span>Prioritas: <strong>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</strong></span>
                                    </div>
                                </div>
                                <div style="display:flex;gap:6px;flex-wrap:wrap;justify-content:flex-end;">
                                    @if($p->isOverdue())
                                        <span class="sla-badge">Lewat SLA</span>
                                    @endif
                                    <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                </div>
                            </div>
                            <div class="complaint-meta">
                                <span>Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                <span>Tanggal: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
                            </div>
                            <p class="complaint-body">{{ Str::limit($p->isi_pengaduan, 180) }}</p>
                            <div class="complaint-actions">
                                <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="btn-soft">Lihat Detail</a>
                                @if($p->isEditable())
                                    <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}#edit" class="btn-secondary">Edit</a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
                @include('partials.simple-pagination', ['paginator' => $pengaduans])
            @endif
        </article>
    </section>
@endsection
