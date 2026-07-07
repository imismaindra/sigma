@extends('layouts.mahasiswa')

@section('title', 'Riwayat Pengaduan')
@section('page_title', 'Riwayat Pengaduan')
@section('page_subtitle', 'Pantau portofolio laporan, status, dan progress tindak lanjut.')

<<<<<<< HEAD
@section('content')
    <!-- Hero Header Card -->
    <section class="page-hero">
        <article class="hero-card bg-gradient-to-tr from-white to-slate-50/50">
            <div class="eyebrow">Daftar Pengaduan</div>
            <h1>Arsip & Riwayat Pengaduan Anda.</h1>
            <p>Telusuri kembali aduan-aduan terdahulu Anda, lihat proses penyelesaian dari petugas, atau berikan tanggapan masukan pada tiket yang aktif.</p>
        </article>

        <aside class="guide-card panel bg-white/85">
            <div>
                <strong class="flex items-center gap-1.5 text-indigo-650"><i data-lucide="info" class="w-4.5 h-4.5"></i> Ringkasan Riwayat</strong>
                <p>Klik tombol untuk mengajukan laporan kendala baru jika terdapat kendala perkuliahan yang saat ini Anda alami.</p>
            </div>
            <a href="{{ route('mahasiswa.pengaduan.create') }}" class="btn-primary flex items-center justify-center gap-1.5"><i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Laporan Baru</a>
        </aside>
    </section>

    <!-- Filter Panel -->
    <section class="filter-panel bg-white/80" aria-label="Filter riwayat pengaduan">
        <div class="panel-head">
            <div>
                <div class="panel-title flex items-center gap-1.5"><i data-lucide="search" class="w-4.5 h-4.5 text-indigo-600"></i> Cari & Saring Laporan</div>
                <p class="panel-subtitle">Gunakan penyaringan berikut untuk mencari tiket pengaduan spesifik.</p>
            </div>
        </div>
=======
@section('styles')
    .history-shell {
        display: grid;
        gap: 18px;
    }

    .history-hero {
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        padding: 22px;
        background:
            radial-gradient(circle at 12% 0%, color-mix(in srgb, var(--stock-blue) 34%, transparent), transparent 34%),
            linear-gradient(145deg, rgba(255,255,255,.12), transparent 42%),
            var(--glass-bg);
        backdrop-filter: blur(22px);
        box-shadow: 0 24px 70px rgba(0,0,0,.2);
        color: var(--text);
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 18px;
        align-items: end;
    }

    .history-title {
        font-size: clamp(28px, 4vw, 44px);
        line-height: 1.02;
        letter-spacing: -.04em;
        font-weight: 700;
    }

    .history-subtitle {
        color: var(--muted);
        margin-top: 10px;
        font-size: 14px;
        line-height: 1.65;
        max-width: 700px;
    }

    .history-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(96px, 1fr));
        gap: 10px;
    }

    .history-chip {
        min-width: 110px;
        border: 1px solid var(--glass-border);
        border-radius: 18px;
        padding: 12px;
        background: var(--glass-bg-strong);
    }

    .history-chip span {
        display: block;
        color: var(--muted);
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .history-chip strong {
        display: block;
        margin-top: 7px;
        font-size: 24px;
        line-height: 1;
        color: var(--text);
    }

    .filter-panel.history-filter,
    .history-list-panel {
        border-radius: 26px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.1), transparent 40%),
            var(--glass-bg);
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(22px);
    }

    .history-filter .filter-form {
        grid-template-columns: minmax(190px, 1.2fr) repeat(3, minmax(130px, .8fr)) repeat(2, minmax(128px, .7fr)) auto;
        gap: 10px;
    }

    .history-list {
        display: grid;
        gap: 12px;
    }

    .history-row {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(126px, .42fr) minmax(120px, .38fr) auto;
        gap: 14px;
        align-items: center;
        border: 1px solid var(--glass-border);
        border-radius: 22px;
        padding: 14px;
        background: var(--glass-bg-strong);
        text-decoration: none;
        color: inherit;
        transition: transform .16s ease, border-color .16s ease, background .16s ease;
    }

    .history-row:hover {
        transform: translateY(-1px);
        border-color: color-mix(in srgb, var(--stock-blue) 45%, transparent);
    }

    .asset-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .asset-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: grid;
        place-items: center;
        flex: 0 0 auto;
        color: #03111f;
        background:
            radial-gradient(circle at 28% 18%, rgba(255,255,255,.7), transparent 25%),
            linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        font-weight: 900;
        box-shadow: 0 14px 28px color-mix(in srgb, var(--stock-green) 18%, transparent);
    }

    .asset-title {
        color: var(--text);
        font-size: 15px;
        font-weight: 900;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .asset-meta {
        color: var(--muted);
        font-size: 12px;
        margin-top: 4px;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .market-value {
        color: var(--text);
        font-size: 13px;
        font-weight: 900;
        text-align: right;
    }

    .market-value span {
        display: block;
        color: var(--muted);
        font-size: 11px;
        font-weight: 700;
        margin-top: 4px;
    }

    .progress-market {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 4px;
    }

    .progress-market span {
        height: 8px;
        border-radius: 999px;
        background: color-mix(in srgb, var(--muted) 28%, transparent);
    }

    .progress-market span.done,
    .progress-market span.active {
        background: linear-gradient(135deg, var(--stock-blue), var(--stock-green));
        box-shadow: 0 0 12px color-mix(in srgb, var(--stock-green) 24%, transparent);
    }

    .row-action {
        min-width: 40px;
        height: 40px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        background: rgba(255,255,255,.1);
        color: var(--text);
        font-weight: 900;
    }

    @media (max-width: 980px) {
        .history-hero,
        .history-row {
            grid-template-columns: 1fr;
        }

        .history-filter .filter-form {
            grid-template-columns: 1fr 1fr;
        }

        .market-value {
            text-align: left;
        }
    }

    @media (max-width: 640px) {
        .history-hero {
            padding: 18px;
            border-radius: 24px;
        }

        .history-summary,
        .history-filter .filter-form {
            grid-template-columns: 1fr;
        }

        .history-row {
            border-radius: 20px;
        }

        .row-action {
            width: 100%;
        }
    }
@endsection

@section('content')
    @php
        $collection = $pengaduans->getCollection();
        $activeCount = $collection->filter(fn ($item) => !in_array($item->status, ['selesai', 'ditolak'], true))->count();
        $doneCount = $collection->where('status', 'selesai')->count();
    @endphp
>>>>>>> origin/Abiyyu-dev

    <section class="history-shell">
        <div class="history-hero">
            <div>
<<<<<<< HEAD
                <label for="q" class="form-label">Cari Pengaduan</label>
                <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul, isi, atau nomor tiket">
            </div>
            <div>
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select font-semibold cursor-pointer">
                    <option value="">Semua Status</option>
                    @foreach($statusLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="priority" class="form-label">Prioritas</label>
                <select id="priority" name="priority" class="form-select font-semibold cursor-pointer">
                    <option value="">Semua Prioritas</option>
                    @foreach($priorityLabels as $key => $label)
                        <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" class="form-select font-semibold cursor-pointer">
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
                <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-secondary flex items-center justify-center gap-1.5"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Reset</a>
            </div>
        </form>
    </section>

    <!-- Complaints history listing -->
    <section class="panel bg-white/90">
        <div class="panel-head">
            <div>
                <div class="panel-title flex items-center gap-1.5"><i data-lucide="list" class="w-4.5 h-4.5 text-indigo-650"></i> Daftar Laporan Aduan Saya</div>
                <p class="panel-subtitle">Ditemukan {{ $pengaduans->total() }} aduan terdaftar atas nama Anda.</p>
            </div>
        </div>

        @if($pengaduans->count() === 0)
            <div class="empty-state">
                <i data-lucide="folder-open" class="w-10 h-10 text-slate-300 mx-auto mb-2 animate-pulse"></i>
                Belum ada pengaduan yang cocok dengan kriteria pencarian saat ini.
            </div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($pengaduans as $p)
                    @php
                        $progressIndex = [
                            'pending' => 1,
                            'proses' => 2,
                            'menunggu_klarifikasi' => 2,
                            'ditindaklanjuti' => 3,
                            'menunggu_verifikasi_mahasiswa' => 4,
                            'selesai' => 5,
                            'ditolak' => 1,
                        ][$p->status] ?? 1;
                    @endphp
                    <article class="complaint-card hover:-translate-y-0.5 transition-all">
                        
                        <div class="complaint-top">
                            <div class="min-w-0">
                                <span class="text-[10px] font-black text-indigo-650 flex items-center gap-0.5 mb-1 uppercase tracking-wider">
                                    <i data-lucide="hash" class="w-3 h-3"></i> Tiket: {{ $p->ticket_number ?? 'PGD' }}
                                </span>
                                <h4 class="complaint-title truncate text-[14px] sm:text-base font-extrabold text-slate-800">{{ $p->judul }}</h4>
                                
                                <div class="complaint-meta mt-1.5 flex flex-wrap gap-x-4 gap-y-1 text-slate-500">
                                    <span class="flex items-center gap-1"><i data-lucide="tag" class="w-3.5 h-3.5"></i> Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                    <span class="flex items-center gap-1"><i data-lucide="calendar" class="w-3.5 h-3.5"></i> Dilaporkan: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
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

                        <!-- Progress Mini indicator bar layout -->
                        <div class="flex items-center gap-1 my-3.5 w-full bg-slate-100/50 p-1.5 rounded-lg border border-slate-150/70" aria-label="Progress bar mini">
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $stepColor = 'bg-slate-200';
                                    if ($i < $progressIndex) {
                                        $stepColor = 'bg-emerald-500';
                                    } elseif ($i === $progressIndex) {
                                        $stepColor = $p->status === 'ditolak' ? 'bg-rose-500' : 'bg-indigo-600';
                                    }
                                @endphp
                                <span class="h-1.5 flex-1 rounded-full {{ $stepColor }} transition-all duration-300"></span>
                            @endfor
                        </div>

                        <p class="complaint-body text-xs text-slate-655 leading-relaxed">{{ Str::limit($p->isi_pengaduan, 190) }}</p>
                        
                        <div class="complaint-actions flex items-center justify-between border-t border-slate-100 pt-3 mt-3">
                            <span class="text-[10px] font-extrabold text-slate-450 uppercase flex items-center gap-2">
                                <span class="flex items-center gap-1"><i data-lucide="message-square" class="w-3.5 h-3.5"></i> {{ $p->comments->count() }} Diskusi</span>
                                <span>•</span>
                                <span class="flex items-center gap-1"><i data-lucide="message-square-quote" class="w-3.5 h-3.5"></i> {{ $p->tanggapan->count() }} Respon</span>
                                <span>•</span>
                                <span class="flex items-center gap-1"><i data-lucide="paperclip" class="w-3.5 h-3.5"></i> {{ $p->lampiran->count() }} Berkas</span>
                            </span>
                            
                            <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="btn-soft flex items-center gap-1 text-[11px] h-8"><i data-lucide="eye" class="w-3.5 h-3.5"></i> Lihat Detail & Progress</a>
                        </div>

                    </article>
                @endforeach
            </div>
            
            <div class="mt-4">
                @include('partials.simple-pagination', ['paginator' => $pengaduans])
            </div>
        @endif
=======
                <div class="history-title">Complaint Portfolio</div>
                <p class="history-subtitle">Semua pengaduan Anda ditampilkan seperti portofolio laporan: mudah dipindai, cepat dibuka, dan jelas progresnya.</p>
            </div>
            <div class="history-summary">
                <div class="history-chip"><span>Total</span><strong>{{ $pengaduans->total() }}</strong></div>
                <div class="history-chip"><span>Aktif</span><strong>{{ $activeCount }}</strong></div>
                <div class="history-chip"><span>Selesai</span><strong>{{ $doneCount }}</strong></div>
            </div>
        </div>

        <section class="filter-panel history-filter" aria-label="Filter riwayat pengaduan">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Market Filter</div>
                    <p class="panel-subtitle">Cari laporan berdasarkan tiket, kategori, status, prioritas, dan tanggal.</p>
                </div>
                <a href="{{ route('mahasiswa.pengaduan.create') }}" class="btn-primary">Buat Pengaduan</a>
            </div>

            <form action="{{ route('mahasiswa.pengaduan.index') }}" method="GET" class="filter-form">
                <div>
                    <label for="q" class="form-label">Cari</label>
                    <input type="text" id="q" name="q" class="form-input" value="{{ request('q') }}" placeholder="Judul, isi, atau nomor tiket">
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
                    <a href="{{ route('mahasiswa.pengaduan.index') }}" class="btn-secondary">Reset</a>
                </div>
            </form>
        </section>

        <section class="panel history-list-panel">
            <div class="panel-head">
                <div>
                    <div class="panel-title">Daftar Riwayat</div>
                    <p class="panel-subtitle">{{ $pengaduans->total() }} pengaduan terdaftar. Buka detail untuk melihat timeline lengkap.</p>
                </div>
            </div>

            @if($pengaduans->count() === 0)
                <div class="empty-state">Belum ada pengaduan yang cocok dengan filter saat ini.</div>
            @else
                <div class="history-list">
                    @foreach($pengaduans as $p)
                        @php
                            $progressIndex = [
                                'pending' => 1,
                                'proses' => 2,
                                'menunggu_klarifikasi' => 2,
                                'ditindaklanjuti' => 3,
                                'menunggu_verifikasi_mahasiswa' => 4,
                                'selesai' => 5,
                                'ditolak' => 1,
                            ][$p->status] ?? 1;
                            $initial = Str::upper(Str::substr($p->kategori->nama_kategori, 0, 2));
                        @endphp
                        <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="history-row">
                            <div class="asset-cell">
                                <div class="asset-icon">{{ $initial }}</div>
                                <div style="min-width:0;">
                                    <div class="asset-title">{{ $p->judul }}</div>
                                    <div class="asset-meta">
                                        <span>{{ $p->ticket_number ?? 'Belum tersedia' }}</span>
                                        <span>{{ $p->kategori->nama_kategori }}</span>
                                        <span>{{ $p->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="market-value">
                                {{ $statusLabels[$p->status] ?? $p->status }}
                                <span>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</span>
                            </div>
                            <div class="progress-market" aria-label="Progress pengaduan">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i < $progressIndex ? 'done' : ($i === $progressIndex ? 'active' : '') }}"></span>
                                @endfor
                            </div>
                            <div class="row-action">›</div>
                        </a>
                    @endforeach
                </div>
                @include('partials.simple-pagination', ['paginator' => $pengaduans])
            @endif
        </section>
>>>>>>> origin/Abiyyu-dev
    </section>
@endsection
