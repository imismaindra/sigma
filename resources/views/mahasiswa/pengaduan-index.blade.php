@extends('layouts.mahasiswa')

@section('title', 'Riwayat Pengaduan')
@section('page_title', 'Riwayat Pengaduan')
@section('page_subtitle', 'Pantau semua pengaduan, status, prioritas, dan progres tindak lanjut.')

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

        <form action="{{ route('mahasiswa.pengaduan.index') }}" method="GET" class="filter-form">
            <div>
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
    </section>
@endsection
