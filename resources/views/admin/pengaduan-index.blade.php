@extends('layouts.admin')

@section('title', 'Daftar Pengaduan')

@section('content')
    <section class="bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 lg:p-8 shadow-sm relative overflow-hidden mb-6">
        <div class="absolute -right-24 -bottom-24 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650 uppercase mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Data Pengaduan
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">Daftar Laporan Pengaduan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Kelola, filter, dan export seluruh laporan pengaduan yang masuk ke sistem SIPMA.
            </p>
        </div>
    </section>

    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs mb-6">
        <div>
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="filter" class="w-4 h-4 text-indigo-650"></i> Filter Pengaduan
            </h3>
            <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="q" class="block text-[11px] font-bold text-slate-700 mb-1">Kata Kunci</label>
                    <input type="text" id="q" name="q" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" value="{{ request('q') }}" placeholder="Cari judul/isi aduan">
                </div>
                <div>
                    <label for="status" class="block text-[11px] font-bold text-slate-700 mb-1">Status</label>
                    <select id="status" name="status" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                        <option value="">Semua Status</option>
                        @foreach($statusLabels as $key => $label)
                            <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="priority" class="block text-[11px] font-bold text-slate-700 mb-1">Prioritas</label>
                    <select id="priority" name="priority" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                        <option value="">Semua Prioritas</option>
                        @foreach($priorityLabels as $key => $label)
                            <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kategori" class="block text-[11px] font-bold text-slate-700 mb-1">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ (string) request('kategori') === (string) $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tanggal_mulai" class="block text-[11px] font-bold text-slate-700 mb-1">Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" value="{{ request('tanggal_mulai') }}">
                </div>
                <div>
                    <label for="tanggal_selesai" class="block text-[11px] font-bold text-slate-700 mb-1">Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="w-full h-9.5 text-xs border border-slate-200 rounded-lg px-3 bg-slate-50/50 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" value="{{ request('tanggal_selesai') }}">
                </div>
        </div>
        <div class="flex flex-wrap gap-2.5 justify-end mt-4 pt-4 border-t border-slate-100">
            <button type="submit" class="h-9 px-4 rounded-lg bg-indigo-600 text-xs font-bold text-white hover:bg-indigo-750 shadow-3xs transition-colors cursor-pointer">Terapkan Filter</button>
            <a href="{{ route('admin.pengaduan.index') }}" class="h-9 px-4 rounded-lg border border-slate-200 text-xs font-bold text-slate-750 hover:bg-slate-50 transition-colors flex items-center justify-center">Reset</a>
            <a href="{{ route('admin.pengaduan.export', request()->query()) }}" class="h-9 px-4 rounded-lg border border-emerald-250 bg-emerald-50/50 text-xs font-bold text-emerald-700 hover:bg-emerald-50 transition-colors flex items-center justify-center gap-1.5">
                <i data-lucide="download" class="w-3.5 h-3.5"></i> Export CSV
            </a>
        </div>
        </form>
    </section>

    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <div class="border-b border-slate-100 pb-4 mb-5 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-indigo-600"></i> Daftar Laporan Pengaduan
                </h2>
                <button type="button" onclick="toggleReporterNames()" id="toggleReporterNamesBtn" class="inline-flex h-7.5 items-center gap-1 px-3 border border-slate-200 hover:bg-slate-50 rounded-lg text-[10.5px] font-extrabold text-slate-600 shadow-3xs cursor-pointer transition-all">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Unhide Nama</span>
                </button>
            </div>
            <div class="flex bg-slate-100 border border-slate-200/50 p-1 rounded-xl">
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-650 cursor-pointer transition-all active-view-btn" id="btn-list-view" onclick="switchView('list')">
                    <i data-lucide="list" class="w-3.5 h-3.5"></i> List View
                </button>
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-655 cursor-pointer transition-all" id="btn-kanban-view" onclick="switchView('kanban')">
                    <i data-lucide="kanban" class="w-3.5 h-3.5"></i> Kanban View
                </button>
            </div>
        </div>

        <div id="list-view" class="space-y-4">
            @if($pengaduans->isEmpty())
                <div class="text-center py-16 text-slate-450 border border-slate-200/60 border-dashed rounded-2xl flex flex-col items-center gap-2">
                    <i data-lucide="folder-open" class="w-10 h-10 text-slate-300"></i>
                    <p class="text-sm font-semibold">Tidak ada data pengaduan masuk.</p>
                </div>
            @else
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden bg-white">
                    <div class="hidden xl:grid xl:grid-cols-12 gap-4 items-center bg-slate-50 border-b border-slate-200/80 px-4.5 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <div class="col-span-3">Judul Pengaduan</div>
                        <div class="col-span-1.5">No Tiket</div>
                        <div class="col-span-2">Pelapor</div>
                        <div class="col-span-2">Kategori & Tanggal</div>
                        <div class="col-span-2">Status & SLA</div>
                        <div class="col-span-1.5 text-right">Aksi</div>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($pengaduans as $p)
                            <div class="complaint-item cursor-pointer transition-colors hover:bg-slate-50/60" onclick="toggleDetails(this)">
                                <div class="grid grid-cols-1 xl:grid-cols-12 gap-3.5 xl:gap-4 items-center p-4.5">
                                    <div class="xl:col-span-3 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Judul Pengaduan</div>
                                        <h4 class="text-sm font-extrabold text-slate-800 leading-snug truncate" title="{{ $p->judul }}">{{ $p->judul }}</h4>
                                        <p class="text-xs text-slate-450 truncate mt-1">{{ Str::limit($p->isi_pengaduan, 75) }}</p>
                                    </div>
                                    <div class="xl:col-span-1.5">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">No Tiket</div>
                                        <span class="inline-flex text-[10.5px] font-bold text-slate-850 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md leading-none shadow-3xs">{{ $p->ticket_number ?? 'PGD' }}</span>
                                    </div>
                                    <div class="xl:col-span-2 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Pelapor</div>
                                        <div class="reporter-name-container blur-sm select-none pointer-events-none transition-all duration-300">
                                            <p class="text-xs font-bold text-slate-800 truncate">{{ $p->user->nama }}</p>
                                            <p class="text-[10px] text-slate-500 font-bold truncate mt-0.5">{{ $p->user->nim_nip }}</p>
                                        </div>
                                    </div>
                                    <div class="xl:col-span-2 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Kategori & Tanggal</div>
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $p->kategori->nama_kategori }}</p>
                                        <p class="text-[10px] text-slate-450 font-bold truncate mt-0.5">{{ $p->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    <div class="xl:col-span-2 flex flex-wrap items-center gap-1.5">
                                        <div class="xl:hidden w-full text-[9px] font-bold text-slate-400 uppercase mb-0.5">Status & SLA</div>
                                        <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                        @if($p->isOverdue())
                                            <span class="sla-badge">Lewat SLA</span>
                                        @endif
                                        @if($p->due_at)
                                            <span class="text-[10px] text-slate-450 font-bold w-full xl:block xl:mt-1">SLA: {{ $p->due_at->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                    <div class="xl:col-span-1.5 text-left xl:text-right" onclick="event.stopPropagation()">
                                        <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="inline-flex h-8 items-center gap-1 px-3 border border-indigo-100 bg-indigo-50/50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-bold transition-all shadow-3xs">
                                            Detail <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="complaint-details overflow-hidden border-t border-slate-100 bg-slate-50/30 p-0 max-h-0 opacity-0 transition-all duration-300 pointer-events-none" onclick="event.stopPropagation()">
                                    <div class="p-6 space-y-6">
                                        <div class="space-y-2">
                                            <h5 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wide">Detail Laporan</h5>
                                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed bg-white border border-slate-200/80 rounded-xl p-4 shadow-3xs white-space-pre-wrap font-medium">
                                                {{ $p->isi_pengaduan }}
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                                            <div class="border border-teal-200 bg-teal-50/30 rounded-xl p-3">
                                                <div class="text-[9px] font-bold text-teal-650 uppercase tracking-wider mb-1">Durasi Penyelesaian (Total)</div>
                                                <div class="text-xs font-extrabold text-teal-800">{{ $p->durasi_penyelesaian }}</div>
                                            </div>
                                            @if($p->waktu_proses)
                                                <div class="border border-slate-200 bg-white rounded-xl p-3">
                                                    <div class="text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1">Mulai Diproses</div>
                                                    <div class="text-xs font-extrabold text-slate-800">{{ $p->waktu_proses->format('d M Y, H:i') }}</div>
                                                </div>
                                                @if(in_array($p->status, ['selesai', 'ditolak']))
                                                    <div class="border border-slate-200 bg-white rounded-xl p-3">
                                                        <div class="text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1">Waktu Selesai</div>
                                                        <div class="text-xs font-extrabold text-slate-800">{{ $p->waktu_selesai_ditolak ? $p->waktu_selesai_ditolak->format('d M Y, H:i') : '-' }}</div>
                                                    </div>
                                                    <div class="border border-emerald-200 bg-emerald-50/30 rounded-xl p-3">
                                                        <div class="text-[9px] font-bold text-emerald-650 uppercase tracking-wider mb-1">Durasi Proses</div>
                                                        <div class="text-xs font-extrabold text-emerald-800">{{ $p->durasi_proses }}</div>
                                                    </div>
                                                @else
                                                    <div class="border-2 border-indigo-150 bg-indigo-50/20 rounded-xl p-3">
                                                        <div class="text-[9px] font-bold text-indigo-600 uppercase tracking-wider mb-1">Sedang Berjalan</div>
                                                        <div class="text-xs font-extrabold text-indigo-850">{{ $p->durasi_proses }}</div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="border border-slate-200 bg-white rounded-xl p-3 col-span-3">
                                                    <div class="text-[9px] font-bold text-slate-450 uppercase tracking-wider mb-1">Durasi Proses</div>
                                                    <div class="text-xs font-bold text-slate-400">Menunggu verifikasi admin untuk memulai pemrosesan aduan.</div>
                                                </div>
                                            @endif
                                        </div>
                                        @if($p->lampiran->isNotEmpty())
                                            <div class="space-y-2.5">
                                                <h5 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wide">Lampiran Berkas ({{ $p->lampiran->count() }})</h5>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($p->lampiran as $file)
                                                        <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="inline-flex h-9 items-center gap-1.5 px-3 border border-slate-200 bg-white hover:bg-slate-50 text-xs font-bold text-indigo-650 rounded-lg shadow-3xs transition-colors">
                                                            <i data-lucide="file" class="w-4 h-4 text-slate-400"></i> {{ $file->nama_file }}
                                                            <span class="text-[10px] text-slate-400 font-semibold uppercase">({{ $file->tipe_file }})</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if($p->tanggapan->isNotEmpty())
                                            <div class="space-y-2.5">
                                                <h5 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wide">Tanggapan Terkirim</h5>
                                                <div class="space-y-2.5">
                                                    @foreach($p->tanggapan as $reply)
                                                        <div class="border border-slate-200 rounded-2xl p-4 bg-white shadow-3xs max-w-2xl relative">
                                                            <div class="absolute right-4 top-4 text-[9px] text-slate-400 font-bold">{{ $reply->created_at->format('d M Y, H:i') }}</div>
                                                            <div class="text-[10px] font-extrabold text-indigo-650 flex items-center gap-1.5 mb-1.5">
                                                                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Tanggapan Resmi ({{ $reply->admin->nama }})
                                                            </div>
                                                            <p class="text-xs text-slate-700 leading-relaxed font-semibold">{{ $reply->isi_tanggapan }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if($p->statusLogs->isNotEmpty())
                                            <div class="space-y-3">
                                                <h5 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wide">Log Perubahan Status</h5>
                                                <div class="relative pl-6 border-l-2 border-slate-100 space-y-4">
                                                    @foreach($p->statusLogs as $log)
                                                        <div class="relative">
                                                            <div class="absolute -left-8.5 top-0.5 w-5 h-5 rounded-full bg-slate-150 border-4 border-slate-50 flex items-center justify-center"></div>
                                                            <div class="text-xs font-bold text-slate-800 leading-snug">
                                                                Status dirubah dari <span class="text-slate-450">{{ $log->status_lama ?: 'belum ada' }}</span> menjadi <span class="text-indigo-600 font-extrabold">{{ $log->status_baru }}</span>
                                                            </div>
                                                            @if($log->catatan)
                                                                <p class="text-xs text-slate-500 italic mt-1">"{{ $log->catatan }}"</p>
                                                            @endif
                                                            <div class="text-[10px] text-slate-400 font-bold mt-1">Oleh: {{ $log->creator->nama }} | {{ $log->created_at->format('d M Y, H:i') }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    @include('partials.simple-pagination', ['paginator' => $pengaduans])
                </div>
            @endif
        </div>

        <div id="kanban-view" class="hidden overflow-x-auto py-2">
            <div class="flex gap-4.5 pb-3 min-w-max items-start">
                @foreach($statusLabels as $statusKey => $statusLabel)
                    <div class="flex-shrink-0 w-72 bg-slate-50 border border-slate-200/80 rounded-2xl flex flex-col max-h-[640px] shadow-3xs kanban-column" data-status="{{ $statusKey }}">
                        <div class="p-3.5 border-b-2 bg-slate-100/50 rounded-t-2xl flex justify-between items-center text-xs font-bold text-slate-900 border-slate-200/80
                            {{ $statusKey==='pending'?'border-b-amber-500 bg-amber-50/20':'' }}
                            {{ $statusKey==='proses'?'border-b-blue-500 bg-blue-50/20':'' }}
                            {{ $statusKey==='menunggu_klarifikasi'?'border-b-purple-500 bg-purple-50/20':'' }}
                            {{ $statusKey==='ditindaklanjuti'?'border-b-teal-500 bg-teal-50/20':'' }}
                            {{ $statusKey==='menunggu_verifikasi_mahasiswa'?'border-b-violet-500 bg-violet-50/20':'' }}
                            {{ $statusKey==='selesai'?'border-b-emerald-500 bg-emerald-50/20':'' }}
                            {{ $statusKey==='ditolak'?'border-b-rose-500 bg-rose-50/20':'' }}
                        ">
                            <span>{{ $statusLabel }}</span>
                            <span class="bg-slate-200 text-slate-700 px-2 py-0.5 rounded-full text-[10px] font-extrabold kanban-count">{{ $kanbanPengaduans->where('status', $statusKey)->count() }}</span>
                        </div>
                        <div class="p-3.5 space-y-3 overflow-y-auto flex-grow min-h-[300px] rounded-b-2xl bg-slate-50/20 kanban-cards" ondragover="allowDrop(event)" ondrop="drop(event)">
                            @forelse($kanbanPengaduans->where('status', $statusKey) as $p)
                                <div class="bg-white border border-slate-200/85 hover:border-slate-350 hover:shadow-md transition-all rounded-xl p-3.5 cursor-grab active:cursor-grabbing relative shadow-3xs" draggable="true" ondragstart="drag(event)" id="card-{{ $p->id_pengaduan }}" data-id="{{ $p->id_pengaduan }}">
                                    <div class="absolute left-0 top-0.5 bottom-0.5 w-1 rounded-r-md
                                        {{ $p->priority==='darurat'?'bg-rose-600':'' }}
                                        {{ $p->priority==='tinggi'?'bg-rose-500':'' }}
                                        {{ $p->priority==='sedang'?'bg-amber-500':'' }}
                                        {{ $p->priority==='rendah'?'bg-indigo-500':'' }}
                                    "></div>
                                    <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 mb-2 pl-1.5">
                                        <span>{{ $p->ticket_number ?? 'PGD' }}</span>
                                        <span class="px-1.5 py-0.5 rounded text-[8px] uppercase tracking-wider font-extrabold
                                            {{ $p->priority==='darurat'?'bg-rose-50 text-rose-600 border border-rose-100':'' }}
                                            {{ $p->priority==='tinggi'?'bg-rose-50 text-rose-650 border border-rose-100/50':'' }}
                                            {{ $p->priority==='sedang'?'bg-amber-50 text-amber-600 border border-amber-100':'' }}
                                            {{ $p->priority==='rendah'?'bg-indigo-50 text-indigo-600 border border-indigo-100':'' }}
                                        ">{{ $priorityLabels[$p->priority] ?? $p->priority }}</span>
                                    </div>
                                    <h4 class="text-xs font-extrabold text-slate-800 line-clamp-2 pl-1.5 leading-snug">{{ $p->judul }}</h4>
                                    <p class="text-[11px] text-slate-450 mt-1.5 pl-1.5 line-clamp-2 leading-relaxed">{{ $p->isi_pengaduan }}</p>
                                    <div class="mt-3.5 pt-2.5 border-t border-slate-100 flex justify-between items-center text-[10px] pl-1.5">
                                        <div class="reporter-name-container blur-sm select-none pointer-events-none transition-all duration-300">
                                            <span class="font-extrabold text-slate-850">{{ $p->user->nama }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-slate-450 font-bold whitespace-nowrap">
                                            <span>{{ $p->created_at->format('d M') }}</span>
                                            <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="text-indigo-650 hover:underline inline-flex items-center">Detail &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-16 text-slate-350 text-[11px] border border-dashed border-slate-200 rounded-xl flex flex-col items-center gap-1">
                                    <i data-lucide="circle-slash" class="w-5 h-5 text-slate-300"></i>
                                    Kosong
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let showReporterNames = false;
        function toggleReporterNames() {
            showReporterNames = !showReporterNames;
            document.querySelectorAll('.reporter-name-container').forEach(el => {
                if (showReporterNames) {
                    el.classList.remove('blur-sm', 'select-none', 'pointer-events-none');
                    el.setAttribute('title', 'Nama pelapor terlihat');
                } else {
                    el.classList.add('blur-sm', 'select-none', 'pointer-events-none');
                    el.setAttribute('title', 'Nama pelapor disembunyikan (klik tombol Unhide di atas)');
                }
            });
            const btn = document.getElementById('toggleReporterNamesBtn');
            if (btn) {
                btn.innerHTML = showReporterNames
                    ? '<i data-lucide="eye-off" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Mask Nama</span>'
                    : '<i data-lucide="eye" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Unhide Nama</span>';
                if (typeof lucide !== 'undefined') lucide.createIcons();
            }
        }

        function switchView(view) {
            const listView = document.getElementById('list-view');
            const kanbanView = document.getElementById('kanban-view');
            const btnList = document.getElementById('btn-list-view');
            const btnKanban = document.getElementById('btn-kanban-view');

            if (view === 'list') {
                listView.style.display = 'block';
                kanbanView.style.display = 'none';
                btnList.classList.add('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnList.classList.remove('text-slate-655');
                btnKanban.classList.remove('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnKanban.classList.add('text-slate-655');
                localStorage.setItem('admin_pengaduan_view', 'list');
            } else {
                listView.style.display = 'none';
                kanbanView.style.display = 'block';
                btnList.classList.remove('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnList.classList.add('text-slate-655');
                btnKanban.classList.add('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnKanban.classList.remove('text-slate-655');
                localStorage.setItem('admin_pengaduan_view', 'kanban');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedView = localStorage.getItem('admin_pengaduan_view');
            if (savedView === 'kanban') {
                switchView('kanban');
            } else {
                switchView('list');
            }
        });

        function drag(ev) {
            ev.dataTransfer.setData("text/plain", ev.target.id);
            ev.target.style.opacity = '0.6';
        }

        document.addEventListener('dragend', (ev) => {
            if (ev.target.classList.contains('cursor-grab')) {
                ev.target.style.opacity = '1';
            }
        });

        function allowDrop(ev) {
            ev.preventDefault();
            const cardsContainer = ev.target.closest('.kanban-cards');
            if (cardsContainer) cardsContainer.classList.add('bg-slate-200/50');
        }

        document.addEventListener('dragleave', (ev) => {
            if (ev.target.classList.contains('kanban-cards')) {
                ev.target.classList.remove('bg-slate-200/50');
            }
        });

        function drop(ev) {
            ev.preventDefault();
            document.querySelectorAll('.kanban-cards').forEach(c => c.classList.remove('bg-slate-200/50'));

            const cardId = ev.dataTransfer.getData("text/plain");
            const card = document.getElementById(cardId);
            if (!card) return;

            const targetColumn = ev.target.closest('.kanban-cards');
            if (!targetColumn) return;

            const newStatus = targetColumn.closest('.kanban-column')?.dataset.status;
            if (!newStatus) return;

            const pengaduanId = card.dataset.id;
            if (!pengaduanId) return;

            fetch(`/admin/pengaduan/${pengaduanId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ status: newStatus, catatan: 'Dipindahkan via papan Kanban.' })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    targetColumn.appendChild(card);
                    updateKanbanCounts();
                } else {
                    alert('Gagal: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(() => alert('Gagal memperbarui status.'));
        }

        function updateKanbanCounts() {
            document.querySelectorAll('.kanban-column').forEach(col => {
                const count = col.querySelectorAll('.cursor-grab').length;
                col.querySelector('.kanban-count').textContent = count;
            });
        }

        function toggleDetails(header) {
            const details = header.querySelector('.complaint-details');
            if (!details) return;
            const isOpen = details.classList.contains('max-h-0');
            document.querySelectorAll('.complaint-details.max-h-\[500px\]').forEach(el => {
                if (el !== details) {
                    el.classList.remove('max-h-[500px]', 'opacity-100', 'pointer-events-auto');
                    el.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
                }
            });
            if (isOpen) {
                details.classList.remove('max-h-0', 'opacity-0', 'pointer-events-none');
                details.classList.add('max-h-[500px]', 'opacity-100', 'pointer-events-auto');
            } else {
                details.classList.remove('max-h-[500px]', 'opacity-100', 'pointer-events-auto');
                details.classList.add('max-h-0', 'opacity-0', 'pointer-events-none');
            }
        }
    </script>
@endsection