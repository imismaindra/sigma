@extends('layouts.mahasiswa')

@section('title', 'Riwayat Pengaduan')
@section('page_title', 'Riwayat Pengaduan')
@section('page_subtitle', 'Pantau semua pengaduan, status, prioritas, dan progres tindak lanjut.')

@section('styles')
    .history-grid {
        display: grid;
        gap: 14px;
    }

    .history-card {
        border: 1px solid var(--border);
        border-radius: 12px;
        background: #ffffff;
        padding: 16px;
        box-shadow: 0 10px 26px rgba(15, 23, 42, .05);
    }

    .history-top {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 12px;
        align-items: start;
    }

    .ticket-code {
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .03em;
        margin-bottom: 6px;
    }

    .progress-mini {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 6px;
        margin: 14px 0 10px;
    }

    .progress-mini span {
        height: 7px;
        border-radius: 999px;
        background: #e2e8f0;
    }

    .progress-mini span.done,
    .progress-mini span.active {
        background: linear-gradient(135deg, var(--primary), #38bdf8);
    }

    .history-actions {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    @media (max-width: 640px) {
        .history-top {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    <section class="filter-panel" aria-label="Filter riwayat pengaduan">
        <div class="panel-head">
            <div>
                <div class="panel-title">Filter Riwayat</div>
                <p class="panel-subtitle">Cari berdasarkan judul, isi laporan, nomor tiket, status, kategori, prioritas, dan tanggal.</p>
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

    <section class="panel">
        <div class="panel-head">
            <div>
                <div class="panel-title">Daftar Riwayat</div>
                <p class="panel-subtitle">{{ $pengaduans->total() }} pengaduan terdaftar. Buka detail untuk melihat progress bar lengkap.</p>
            </div>
        </div>

        @if($pengaduans->count() === 0)
            <div class="empty-state">Belum ada pengaduan yang cocok dengan filter saat ini.</div>
        @else
            <div class="history-grid">
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
                    <article class="history-card">
                        <div class="history-top">
                            <div>
                                <div class="ticket-code">{{ $p->ticket_number ?? 'Belum tersedia' }}</div>
                                <div class="complaint-title">{{ $p->judul }}</div>
                                <div class="complaint-meta" style="margin-top:8px;">
                                    <span>Kategori: <strong>{{ $p->kategori->nama_kategori }}</strong></span>
                                    <span>Tanggal: <strong>{{ $p->created_at->format('d M Y, H:i') }}</strong></span>
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
                        <div class="progress-mini" aria-label="Progress pengaduan">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="{{ $i < $progressIndex ? 'done' : ($i === $progressIndex ? 'active' : '') }}"></span>
                            @endfor
                        </div>
                        <p class="complaint-body">{{ Str::limit($p->isi_pengaduan, 190) }}</p>
                        <div class="history-actions">
                            <span class="panel-subtitle">Tanggapan: {{ $p->tanggapan->count() }} · Lampiran: {{ $p->lampiran->count() }}</span>
                            <a href="{{ route('mahasiswa.pengaduan.show', $p->id_pengaduan) }}" class="btn-soft">Lihat Detail & Progress</a>
                        </div>
                    </article>
                @endforeach
            </div>
            @include('partials.simple-pagination', ['paginator' => $pengaduans])
        @endif
    </section>
@endsection
