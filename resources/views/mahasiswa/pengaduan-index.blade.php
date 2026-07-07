@extends('layouts.mahasiswa')

@section('title', 'Riwayat Pengaduan')
@section('page_title', 'Riwayat Pengaduan')
@section('page_subtitle', 'Pantau portofolio laporan, status, dan progress tindak lanjut.')

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

    <section class="history-shell">
        <div class="history-hero">
            <div>
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
    </section>
@endsection
