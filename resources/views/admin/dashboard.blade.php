@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Welcome Header Card -->
    <section class="bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 lg:p-8 shadow-sm relative overflow-hidden mb-6">
        <div class="absolute -right-24 -bottom-24 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-4xl">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650 uppercase mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Panel Kontrol Utama
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">Panel Administrasi SIPMA</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Kelola data pengaduan masuk, lakukan peninjauan lampiran berkas, perbarui status pengaduan, dan kirim tanggapan resmi kepada pelapor.
            </p>
        </div>
    </section>

    <!-- Balanced Statistics Grid (Total + 7 Statuses) -->
    <section class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white/95 border-l-4 border-slate-400 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-slate-500 uppercase tracking-wider mb-1">Total Masuk</div>
            <div class="text-2xl font-black text-slate-900">{{ $allPengaduans->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-amber-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-amber-600 uppercase tracking-wider mb-1">Pending</div>
            <div class="text-2xl font-black text-amber-650">{{ $allPengaduans->where('status', 'pending')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-blue-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-blue-600 uppercase tracking-wider mb-1">Diproses</div>
            <div class="text-2xl font-black text-blue-600">{{ $allPengaduans->where('status', 'proses')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-purple-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-purple-600 uppercase tracking-wider mb-1">Klarifikasi</div>
            <div class="text-2xl font-black text-purple-650">{{ $allPengaduans->where('status', 'menunggu_klarifikasi')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-teal-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-teal-600 uppercase tracking-wider mb-1">Tindaklanjut</div>
            <div class="text-2xl font-black text-teal-650">{{ $allPengaduans->where('status', 'ditindaklanjuti')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-violet-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-violet-600 uppercase tracking-wider mb-1">Verif Mhs</div>
            <div class="text-2xl font-black text-violet-650">{{ $allPengaduans->where('status', 'menunggu_verifikasi_mahasiswa')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-emerald-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-emerald-600 uppercase tracking-wider mb-1">Selesai</div>
            <div class="text-2xl font-black text-emerald-650">{{ $allPengaduans->where('status', 'selesai')->count() }}</div>
        </div>

        <div class="bg-white/95 border-l-4 border-rose-500 border border-slate-200/80 rounded-xl p-4 shadow-3xs hover:shadow-md transition-all duration-200">
            <div class="text-[10px] font-extrabold text-rose-600 uppercase tracking-wider mb-1">Ditolak</div>
            <div class="text-2xl font-black text-rose-650">{{ $allPengaduans->where('status', 'ditolak')->count() }}</div>
        </div>
    </section>

    <!-- Filters, Charts & Categories Wrapper -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        
        <!-- Filters Form -->
        <div class="lg:col-span-8 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs flex flex-col justify-between">
            <div>
                <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i data-lucide="filter" class="w-4 h-4 text-indigo-650"></i> Filter Pengaduan
                </h3>
                <form action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
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
                <a href="{{ route('admin.dashboard') }}" class="h-9 px-4 rounded-lg border border-slate-200 text-xs font-bold text-slate-750 hover:bg-slate-50 transition-colors flex items-center justify-center">Reset</a>
                <a href="{{ route('admin.pengaduan.export', request()->query()) }}" class="h-9 px-4 rounded-lg border border-emerald-250 bg-emerald-50/50 text-xs font-bold text-emerald-700 hover:bg-emerald-50 transition-colors flex items-center justify-center gap-1.5">
                    <i data-lucide="download" class="w-3.5 h-3.5"></i> Export CSV
                </a>
            </div>
            </form>
        </div>

        <!-- Top 5 Masalah: Horizontal Visual Charts -->
        <div class="lg:col-span-4 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="bar-chart-2" class="w-4 h-4 text-indigo-650"></i> Top 5 Kategori Terbanyak
            </h3>
            <div class="space-y-4">
                @php
                    $maxCount = $categoryStats->max();
                    $rank = 1;
                @endphp
                @forelse($categoryStats as $categoryName => $count)
                    @php
                        $percentage = $maxCount > 0 ? ($count / $maxCount) * 100 : 0;
                    @endphp
                    <div class="space-y-1">
                        <div class="flex justify-between items-center text-xs font-bold text-slate-800">
                            <span class="truncate flex items-center gap-1.5">
                                <span class="w-4.5 h-4.5 rounded bg-indigo-50 border border-indigo-150 flex items-center justify-center text-[9px] text-indigo-600 font-extrabold flex-shrink-0">#{{ $rank++ }}</span>
                                {{ $categoryName }}
                            </span>
                            <span class="text-indigo-600 font-extrabold flex-shrink-0">{{ $count }} Laporan</span>
                        </div>
                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-indigo-650 h-full rounded-full transition-all duration-700" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 text-xs py-8">Belum ada data aduan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Categories & Recent Activities Layout -->
    @if(Auth::user()->role !== 'pimpinan')
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        
        <!-- Category Management (Spreadsheet Grid design) -->
        <div class="lg:col-span-8 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="tag" class="w-4 h-4 text-indigo-650"></i> Manajemen Kategori Pengaduan
            </h3>

            <!-- Add Kategori Form -->
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-4 p-3 bg-slate-50 border border-slate-200/60 rounded-xl">
                @csrf
                <div class="sm:col-span-4">
                    <input type="text" name="nama_kategori" class="w-full h-8.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" placeholder="Nama Kategori Baru" required>
                </div>
                <div class="sm:col-span-5">
                    <input type="text" name="deskripsi" class="w-full h-8.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" placeholder="Deskripsi Singkat Kategori">
                </div>
                <div class="sm:col-span-3 flex items-center justify-between gap-2.5">
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" name="status_aktif" value="1" checked class="sr-only peer">
                        <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-indigo-600"></div>
                        <span class="ml-1.5 text-[10px] font-bold text-slate-650">Aktif</span>
                    </label>
                    <button type="submit" class="h-8.5 px-3 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer flex items-center gap-1">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah
                    </button>
                </div>
            </form>

            <!-- Categories Scroll List -->
            <div class="max-h-60 overflow-y-auto space-y-2 pr-1">
                @foreach($kategoris as $kategori)
                    <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center border border-slate-200/50 p-2 bg-slate-50/20 hover:bg-slate-50/70 rounded-xl transition-all">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-4">
                            <input type="text" name="nama_kategori" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-1.5 rounded-sm outline-none transition-all font-bold text-slate-800" value="{{ $kategori->nama_kategori }}" required>
                        </div>
                        <div class="sm:col-span-5">
                            <input type="text" name="deskripsi" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-1.5 rounded-sm outline-none transition-all font-semibold text-slate-650" value="{{ $kategori->deskripsi }}" placeholder="Belum ada deskripsi">
                        </div>
                        <div class="sm:col-span-3 flex items-center justify-between gap-2.5">
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="status_aktif" value="1" {{ $kategori->status_aktif ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-indigo-650"></div>
                                <span class="ml-1.5 text-[10px] font-bold text-slate-650">Aktif</span>
                            </label>
                            <button type="submit" class="w-7 h-7 rounded-lg bg-indigo-50 border border-indigo-150/40 text-indigo-600 hover:bg-indigo-100 flex items-center justify-center transition-colors cursor-pointer" title="Simpan Perubahan">
                                <i data-lucide="save" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity Logs -->
        <div class="lg:col-span-4 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs flex flex-col">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-indigo-650"></i> Aktivitas Terbaru
            </h3>
            <div class="space-y-3.5 flex-1 max-h-72 overflow-y-auto pr-1">
                @forelse($activities as $activity)
                    <div class="border border-slate-150/80 rounded-xl p-3 bg-slate-50/40 hover:bg-slate-50 transition-colors">
                        <div class="flex justify-between items-start gap-2">
                            <span class="text-[10px] font-extrabold text-indigo-600 uppercase bg-indigo-50 border border-indigo-100/50 px-2 py-0.5 rounded leading-none truncate">{{ str_replace('_', ' ', $activity->action) }}</span>
                            <span class="text-[9px] text-slate-400 font-bold whitespace-nowrap">{{ $activity->created_at->format('d M, H:i') }}</span>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed font-semibold mt-2">{{ $activity->description }}</p>
                        <div class="text-[9px] text-slate-500 font-bold text-right mt-1.5">Oleh: {{ $activity->user?->nama ?? 'Sistem' }}</div>
                    </div>
                @empty
                    <div class="text-center text-slate-450 text-xs py-12 flex flex-col items-center gap-2">
                        <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i> Belum ada aktivitas log.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- Main Complaints Panel (List View & Kanban View) -->
    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-sm">
        <!-- Panel Header & View Switcher -->
        <div class="border-b border-slate-100 pb-4 mb-5 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <h2 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4.5 h-4.5 text-indigo-600"></i> Daftar Laporan Pengaduan
                </h2>
                <!-- Global Privacy Name Mask Toggle -->
                <button type="button" onclick="toggleReporterNames()" id="toggleReporterNamesBtn" class="inline-flex h-7.5 items-center gap-1 px-3 border border-slate-200 hover:bg-slate-50 rounded-lg text-[10.5px] font-extrabold text-slate-600 shadow-3xs cursor-pointer transition-all">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Unhide Nama</span>
                </button>
            </div>

<<<<<<< HEAD
            <!-- Tabs buttons -->
            <div class="flex bg-slate-100 border border-slate-200/50 p-1 rounded-xl">
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-650 cursor-pointer transition-all active-view-btn" id="btn-list-view" onclick="switchView('list')">
                    <i data-lucide="list" class="w-3.5 h-3.5"></i> List View
                </button>
                <button class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-655 cursor-pointer transition-all" id="btn-kanban-view" onclick="switchView('kanban')">
                    <i data-lucide="kanban" class="w-3.5 h-3.5"></i> Kanban View
                </button>
=======
            @if($pengaduans->isEmpty())
                <div style="text-align: center; color: var(--text-muted); padding: 40px 0; font-size: 13.5px;">
                    Belum ada data pengaduan masuk dalam sistem database.
                </div>
            @else
                <div class="complaint-list">
                    <div class="complaint-sheet-head">
                        <div>Judul</div>
                        <div>Tiket</div>
                        <div>Pelapor</div>
                        <div>Kategori</div>
                        <div>Status</div>
                        <div>Prioritas</div>
                        <div>Aksi</div>
                    </div>
                    @foreach($pengaduans as $p)
                        <div class="complaint-item" onclick="toggleDetails(this)">
                            <div class="complaint-header">
                                <div class="sheet-cell">
                                    <span class="sheet-label">Judul</span>
                                    <div class="complaint-title" title="{{ $p->judul }}">{{ $p->judul }}</div>
                                    <div class="sheet-cell-muted">{{ Str::limit($p->isi_pengaduan, 70) }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Tiket</span>
                                    <strong>{{ $p->ticket_number ?? 'Belum tersedia' }}</strong>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Pelapor</span>
                                    <strong>{{ $p->user->nama }}</strong>
                                    <div class="sheet-cell-muted">{{ $p->user->nim_nip }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Kategori</span>
                                    <strong>{{ $p->kategori->nama_kategori }}</strong>
                                    <div class="sheet-cell-muted">{{ $p->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Status</span>
                                    @if($p->isOverdue())
                                        <span class="sla-badge">Lewat SLA</span>
                                    @endif
                                    <span class="badge badge-{{ $p->status }}">{{ $statusLabels[$p->status] ?? $p->status }}</span>
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Prioritas</span>
                                    <strong>{{ $priorityLabels[$p->priority] ?? ucfirst($p->priority ?? 'sedang') }}</strong>
                                    @if($p->due_at)
                                        <div class="sheet-cell-muted">SLA {{ $p->due_at->format('d M') }}</div>
                                    @endif
                                </div>
                                <div class="sheet-cell">
                                    <span class="sheet-label">Aksi</span>
                                    <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="btn-detail" onclick="event.stopPropagation()">Detail</a>
                                </div>
                            </div>

                            <!-- Detail Dropdown -->
                            <div class="complaint-details" onclick="event.stopPropagation()">
                                <div class="detail-section">
                                    <div class="detail-title">Detail Laporan</div>
                                    <p style="white-space: pre-wrap; font-size: 13.5px; line-height: 1.5; color: #1f2937; background: #f3f4f6; padding: 12px; border-radius: 4px; border: 1px solid var(--border-color);">{{ $p->isi_pengaduan }}</p>
                                </div>

                                @if($p->lampiran->isNotEmpty())
                                    <div class="detail-section">
                                        <div class="detail-title">Lampiran Berkas ({{ $p->lampiran->count() }})</div>
                                        <div class="attachments-list">
                                            @foreach($p->lampiran as $file)
                                                <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" class="attachment-link">
                                                    📁 {{ $file->nama_file }} 
                                                    <span style="color: var(--text-muted); font-size: 11px;">({{ $file->tipe_file }})</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- Actions Grid -->
                                @if(Auth::user()->role !== 'pimpinan')
                                <div class="actions-grid">
                                    <!-- Aksi 1: Update Status -->
                                    <form action="{{ route('admin.pengaduan.status.update', $p->id_pengaduan) }}" method="POST">
                                        @csrf
                                        <div class="detail-title" style="margin-bottom: 12px; color: var(--text-main);">Update Status Pengaduan</div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="status-{{ $p->id_pengaduan }}">Status Baru</label>
                                            <select name="status" id="status-{{ $p->id_pengaduan }}" class="form-select" required>
                                                @foreach($statusLabels as $status => $label)
                                                    <option value="{{ $status }}" {{ $p->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="catatan-{{ $p->id_pengaduan }}">Catatan Perubahan</label>
                                            <textarea name="catatan" id="catatan-{{ $p->id_pengaduan }}" class="form-textarea" placeholder="Tambahkan catatan..."></textarea>
                                        </div>

                                        <button type="submit" class="btn-small">Update Status</button>
                                    </form>

                                    <!-- Aksi 2: Kirim Tanggapan / Feedback -->
                                    <form action="{{ route('admin.pengaduan.tanggapan.store', $p->id_pengaduan) }}" method="POST">
                                        @csrf
                                        <div class="detail-title" style="margin-bottom: 12px; color: var(--text-main);">Kirim Tanggapan Resmi</div>

                                        <div class="form-group">
                                            <label class="form-label" for="isi_tanggapan-{{ $p->id_pengaduan }}">Pesan Tanggapan</label>
                                            <textarea name="isi_tanggapan" id="isi_tanggapan-{{ $p->id_pengaduan }}" class="form-textarea" required placeholder="Tuliskan tanggapan resmi kepada pelapor..."></textarea>
                                        </div>

                                        <button type="submit" class="btn-small">Kirim Tanggapan</button>
                                    </form>
                                </div>
                                @endif

                                @if($p->tanggapan->isNotEmpty())
                                    <div class="detail-section">
                                        <div class="detail-title">Tanggapan Terkirim</div>
                                        <div class="complaint-list" style="gap: 10px;">
                                            @foreach($p->tanggapan as $reply)
                                                <div class="reply-box">
                                                    <div class="reply-header">Dijawab oleh: {{ $reply->admin->nama }} (Admin)</div>
                                                    <div>{{ $reply->isi_tanggapan }}</div>
                                                    <div class="timeline-meta" style="margin-top: 4px;">Pada: {{ $reply->created_at->format('d M Y, H:i') }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if($p->statusLogs->isNotEmpty())
                                    <div class="detail-section">
                                        <div class="detail-title">Log Perubahan Status</div>
                                        <div class="timeline">
                                            @foreach($p->statusLogs as $log)
                                                <div class="timeline-item">
                                                    <div>Status berubah dari <strong>{{ $log->status_lama ?: 'null' }}</strong> menjadi <strong>{{ $log->status_baru }}</strong></div>
                                                    @if($log->catatan)
                                                        <div style="color: #4b5563; margin-top: 2px;">Catatan: "{{ $log->catatan }}"</div>
                                                    @endif
                                                    <div class="timeline-meta">Oleh: {{ $log->creator->nama }} | {{ $log->created_at->format('d M Y, H:i') }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @include('partials.simple-pagination', ['paginator' => $pengaduans])
            @endif
        </div>
    </div>

    <script>
        function toggleDetails(element) {
            if (element.classList.contains('active')) {
                return;
            }
            document.querySelectorAll('.complaint-item').forEach(item => {
                if (item !== element) {
                    item.classList.remove('active');
                }
            });
            element.classList.toggle('active');
        }

        // Mencegah penutupan detail saat berinteraksi di formulir/form-group
        document.querySelectorAll('.complaint-details').forEach(detail => {
            detail.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });

        // Penanganan klik header untuk menutup item aktif
        document.querySelectorAll('.complaint-item').forEach(item => {
            item.addEventListener('click', function(e) {
                if (!e.target.closest('.complaint-details')) {
                    if (this.classList.contains('active')) {
                        this.classList.remove('active');
                        e.stopPropagation();
                    }
                }
            });
        });

        (() => {
            // Success Toast Logic
            const toast = document.getElementById('successToast');
            if (toast) {
                const close = document.getElementById('successToastClose');
                window.setTimeout(() => toast.classList.add('is-visible'), 120);
                const hideToast = () => toast.classList.remove('is-visible');
                close?.addEventListener('click', hideToast);
                window.setTimeout(hideToast, 5200);
            }

            document.addEventListener('click', (event) => {
                const modal = document.getElementById('logoutModal');

                if (event.target.closest('#btnTriggerLogout')) {
                    modal?.classList.add('is-open');
                }

                if (event.target.closest('#btnCancelLogout')) {
                    modal?.classList.remove('is-open');
                }

                if (event.target === modal) {
                    modal.classList.remove('is-open');
                }

                if (event.target.closest('#btnConfirmLogout')) {
                    document.getElementById('logoutForm')?.submit();
                }
            });
        })();
    </script>

    <!-- Logout Confirmation Modal -->
    <div class="logout-modal" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="logout-modal-content">
            <h3 id="modalTitle">Konfirmasi Keluar</h3>
            <p>Apakah Anda yakin ingin keluar dari Panel Administrasi SIPMA?</p>
            <div class="logout-modal-actions">
                <button type="button" class="btn-modal-cancel" id="btnCancelLogout">Batal</button>
                <button type="button" class="btn-modal-confirm" id="btnConfirmLogout">Keluar</button>
>>>>>>> origin/Abiyyu-dev
            </div>
        </div>

        <!-- 1. List View Section -->
        <div id="list-view" class="space-y-4">
            @if($pengaduans->isEmpty())
                <div class="text-center py-16 text-slate-450 border border-slate-200/60 border-dashed rounded-2xl flex flex-col items-center gap-2">
                    <i data-lucide="folder-open" class="w-10 h-10 text-slate-300"></i>
                    <p class="text-sm font-semibold">Tidak ada data pengaduan masuk.</p>
                </div>
            @else
                <!-- Responsive Sheet Layout -->
                <div class="border border-slate-200/80 rounded-2xl overflow-hidden bg-white">
                    <!-- Head Column -->
                    <div class="hidden xl:grid xl:grid-cols-12 gap-4 items-center bg-slate-50 border-b border-slate-200/80 px-4.5 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                        <div class="col-span-3">Judul Pengaduan</div>
                        <div class="col-span-1.5">No Tiket</div>
                        <div class="col-span-2">Pelapor</div>
                        <div class="col-span-2">Kategori & Tanggal</div>
                        <div class="col-span-2">Status & SLA</div>
                        <div class="col-span-1.5 text-right">Aksi</div>
                    </div>

                    <!-- Items Body -->
                    <div class="divide-y divide-slate-100">
                        @foreach($pengaduans as $p)
                            <div class="complaint-item cursor-pointer transition-colors hover:bg-slate-50/60" onclick="toggleDetails(this)">
                                
                                <!-- Accordion Row Header -->
                                <div class="grid grid-cols-1 xl:grid-cols-12 gap-3.5 xl:gap-4 items-center p-4.5">
                                    
                                    <!-- Title -->
                                    <div class="xl:col-span-3 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Judul Pengaduan</div>
                                        <h4 class="text-sm font-extrabold text-slate-800 leading-snug truncate" title="{{ $p->judul }}">{{ $p->judul }}</h4>
                                        <p class="text-xs text-slate-450 truncate mt-1">{{ Str::limit($p->isi_pengaduan, 75) }}</p>
                                    </div>

                                    <!-- Ticket -->
                                    <div class="xl:col-span-1.5">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">No Tiket</div>
                                        <span class="inline-flex text-[10.5px] font-bold text-slate-850 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-md leading-none shadow-3xs">{{ $p->ticket_number ?? 'PGD' }}</span>
                                    </div>

                                    <!-- Pelapor -->
                                    <div class="xl:col-span-2 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Pelapor</div>
                                        <div class="reporter-name-container blur-sm select-none pointer-events-none transition-all duration-300">
                                            <p class="text-xs font-bold text-slate-800 truncate">{{ $p->user->nama }}</p>
                                            <p class="text-[10px] text-slate-500 font-bold truncate mt-0.5">{{ $p->user->nim_nip }}</p>
                                        </div>
                                    </div>

                                    <!-- Kategori & Tanggal -->
                                    <div class="xl:col-span-2 min-w-0">
                                        <div class="xl:hidden text-[9px] font-bold text-slate-400 uppercase mb-0.5">Kategori & Tanggal</div>
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $p->kategori->nama_kategori }}</p>
                                        <p class="text-[10px] text-slate-450 font-bold truncate mt-0.5">{{ $p->created_at->format('d M Y, H:i') }}</p>
                                    </div>

                                    <!-- Status & SLA -->
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

                                    <!-- Aksi button -->
                                    <div class="xl:col-span-1.5 text-left xl:text-right" onclick="event.stopPropagation()">
                                        <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}" class="inline-flex h-8 items-center gap-1 px-3 border border-indigo-100 bg-indigo-50/50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-bold transition-all shadow-3xs">
                                            Detail <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Accordion Collapsible Detail (Animated with transition-all) -->
                                <div class="complaint-details overflow-hidden border-t border-slate-100 bg-slate-50/30 p-0 max-h-0 opacity-0 transition-all duration-300 pointer-events-none" onclick="event.stopPropagation()">
                                    <div class="p-6 space-y-6">
                                        
                                        <!-- Detail Description -->
                                        <div class="space-y-2">
                                            <h5 class="text-[10px] font-extrabold text-slate-450 uppercase tracking-wide">Detail Laporan</h5>
                                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed bg-white border border-slate-200/80 rounded-xl p-4 shadow-3xs white-space-pre-wrap font-medium">
                                                {{ $p->isi_pengaduan }}
                                            </div>
                                        </div>

                                        <!-- Performance & SLA Metrics -->
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

                                        <!-- Attachments -->
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

                                        <!-- Main Updates Actions -->
                                        @if(Auth::user()->role !== 'pimpinan')
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white border border-slate-250/60 rounded-2xl p-5 shadow-3xs">
                                            
                                            <!-- Action 1: Status Updates -->
                                            <form action="{{ route('admin.pengaduan.status.update', $p->id_pengaduan) }}" method="POST" class="space-y-3.5">
                                                @csrf
                                                <h4 class="text-xs font-extrabold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-1.5"><i data-lucide="refresh-cw" class="w-4 h-4 text-indigo-650"></i> Update Status Pengaduan</h4>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pilih Status Baru</label>
                                                    <select name="status" class="w-full h-9 text-xs border border-slate-200 rounded-lg px-2.5 bg-slate-50 focus:bg-white focus:border-indigo-600 outline-none transition-all font-semibold">
                                                        @foreach($statusLabels as $status => $label)
                                                            <option value="{{ $status }}" {{ $p->status === $status ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Catatan Perubahan</label>
                                                    <textarea name="catatan" class="w-full h-20 text-xs border border-slate-200 rounded-lg p-2 bg-slate-50 focus:bg-white focus:border-indigo-600 outline-none transition-all resize-none font-medium" placeholder="Alasan perubahan status..."></textarea>
                                                </div>
                                                <button type="submit" class="h-8.5 px-4 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer shadow-3xs">Simpan Status</button>
                                            </form>

                                            <!-- Action 2: Tanggapan Resmi -->
                                            <form action="{{ route('admin.pengaduan.tanggapan.store', $p->id_pengaduan) }}" method="POST" class="space-y-3.5">
                                                @csrf
                                                <h4 class="text-xs font-extrabold text-slate-900 border-b border-slate-100 pb-2 flex items-center gap-1.5"><i data-lucide="message-square" class="w-4 h-4 text-indigo-650"></i> Kirim Tanggapan Resmi</h4>
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Pesan Tanggapan Resmi</label>
                                                    <textarea name="isi_tanggapan" class="w-full h-32 text-xs border border-slate-200 rounded-lg p-2.5 bg-slate-50 focus:bg-white focus:border-indigo-600 outline-none transition-all resize-none font-medium" placeholder="Tuliskan tanggapan penyelesaian aduan secara formal kepada pelapor..." required></textarea>
                                                </div>
                                                <button type="submit" class="h-8.5 px-4 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer shadow-3xs">Kirim Tanggapan</button>
                                            </form>
                                        </div>
                                        @endif

                                        <!-- Sent Feedbacks / Replies -->
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

                                        <!-- Log Logs History -->
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

                <!-- Paginate footer link -->
                <div class="mt-4">
                    @include('partials.simple-pagination', ['paginator' => $pengaduans])
                </div>
            @endif
        </div>

        <!-- 2. Kanban Board View Section (Hidden by default) -->
        <div id="kanban-view" class="hidden overflow-x-auto py-2">
            <div class="flex gap-4.5 pb-3 min-w-max items-start">
                @foreach($statusLabels as $statusKey => $statusLabel)
                    <div class="flex-shrink-0 w-72 bg-slate-50 border border-slate-200/80 rounded-2xl flex flex-col max-h-[640px] shadow-3xs kanban-column" data-status="{{ $statusKey }}">
                        
                        <!-- Column Header -->
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

                        <!-- Column Drop Area -->
                        <div class="p-3.5 space-y-3 overflow-y-auto flex-grow min-h-[300px] rounded-b-2xl bg-slate-50/20 kanban-cards" ondragover="allowDrop(event)" ondrop="drop(event)">
                            @forelse($kanbanPengaduans->where('status', $statusKey) as $p)
                                <div class="bg-white border border-slate-200/85 hover:border-slate-350 hover:shadow-md transition-all rounded-xl p-3.5 cursor-grab active:cursor-grabbing relative shadow-3xs" draggable="true" ondragstart="drag(event)" id="card-{{ $p->id_pengaduan }}" data-id="{{ $p->id_pengaduan }}">
                                    <!-- Priority Indicator line -->
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
                                    
                                    <!-- Reporter & date info -->
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
        // Global privacy mask toggle
        let showReporterNames = false;
        function toggleReporterNames() {
            showReporterNames = !showReporterNames;
            document.querySelectorAll('.reporter-name-container').forEach(el => {
                if (showReporterNames) {
                    el.classList.remove('blur-sm', 'select-none', 'pointer-events-none');
                    el.setAttribute('title', 'Nama pelapor terlihat');
                } else {
                    el.classList.add('blur-sm', 'select-none', 'pointer-events-none');
                    el.setAttribute('title', 'Nama pelapor disembunyikan (klik tombol Mask di atas)');
                }
            });
            const btn = document.getElementById('toggleReporterNamesBtn');
            if (btn) {
                btn.innerHTML = showReporterNames 
                    ? '<i data-lucide="eye-off" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Mask Nama</span>'
                    : '<i data-lucide="eye" class="w-3.5 h-3.5"></i> <span class="hidden sm:inline">Unhide Nama</span>';
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }

        // View Toggler (List vs Kanban)
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
                localStorage.setItem('admin_dashboard_view', 'list');
            } else {
                listView.style.display = 'none';
                kanbanView.style.display = 'block';
                btnList.classList.remove('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnList.classList.add('text-slate-655');
                btnKanban.classList.add('active-view-btn', 'bg-white', 'text-indigo-650', 'shadow-3xs');
                btnKanban.classList.remove('text-slate-655');
                localStorage.setItem('admin_dashboard_view', 'kanban');
            }
        }

        // Keep view selection on refresh
        document.addEventListener('DOMContentLoaded', () => {
            const savedView = localStorage.getItem('admin_dashboard_view');
            if (savedView === 'kanban') {
                switchView('kanban');
            } else {
                switchView('list');
            }
        });

        // Drag and Drop Logic
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
            if (cardsContainer) {
                cardsContainer.classList.add('bg-slate-200/50');
            }
        }

        // Remove highlights on leave
        document.addEventListener('dragleave', (ev) => {
            if (ev.target.classList.contains('kanban-cards')) {
                ev.target.classList.remove('bg-slate-200/50');
            }
        });

        function drop(ev) {
            ev.preventDefault();
            const cardsContainer = ev.target.closest('.kanban-cards');
            if (!cardsContainer) return;
            
            cardsContainer.classList.remove('bg-slate-200/50');
            
            const cardId = ev.dataTransfer.getData("text/plain");
            const cardElement = document.getElementById(cardId);
            if (!cardElement) return;

            const targetColumn = cardsContainer.closest('.kanban-column');
            const targetStatus = targetColumn.dataset.status;
            const complaintId = cardElement.dataset.id;
            
            // Check if status is actually changing
            const sourceColumn = cardElement.closest('.kanban-column');
            const sourceStatus = sourceColumn.dataset.status;
            
            if (sourceStatus === targetStatus) return;

            // Move the card elements visually first
            cardsContainer.appendChild(cardElement);
            
            // Update counter for source and target columns
            updateColumnCounters();

            // Send AJAX to update status
            updateComplaintStatus(complaintId, targetStatus, sourceColumn, cardElement);
        }

        function updateColumnCounters() {
            document.querySelectorAll('.kanban-column').forEach(column => {
                const count = column.querySelectorAll('[draggable="true"]').length;
                const counter = column.querySelector('.kanban-count');
                if (counter) counter.textContent = count;
            });
        }

        function updateComplaintStatus(id, status, sourceColumn, cardElement) {
            // Show dynamic AJAX Toast
            showAJAXToast('Mengubah status aduan...', 'info');

            fetch(`/admin/pengaduan/${id}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: status,
                    catatan: 'Dipindahkan via papan Kanban.'
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal memperbarui status di database.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showAJAXToast(data.message, 'success');
                } else {
                    throw new Error(data.message || 'Gagal memperbarui status.');
                }
            })
            .catch(error => {
                showAJAXToast(error.message, 'error');
                // Revert card movement
                sourceColumn.querySelector('.kanban-cards').appendChild(cardElement);
                updateColumnCounters();
            });
        }

        // Custom AJAX Toast
        function showAJAXToast(message, type = 'success') {
            const existing = document.getElementById('ajax-toast');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.id = 'ajax-toast';
            
            let color = '#4f46e5';
            let bg = '#eeebff';
            let border = 'rgba(79, 70, 229, 0.2)';
            let icon = 'info';

            if (type === 'error') {
                color = '#dc2626';
                bg = '#fef2f2';
                border = 'rgba(220, 38, 38, 0.2)';
                icon = 'alert-octagon';
            } else if (type === 'success') {
                color = '#16a34a';
                bg = '#f0fdf4';
                border = 'rgba(22, 163, 74, 0.2)';
                icon = 'check-circle';
            }

            toast.style.cssText = `
                position: fixed;
                right: 24px;
                top: 24px;
                z-index: 99999;
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 14px 18px;
                border-radius: 16px;
                border: 1px solid ${border};
                background: ${bg};
                color: ${color};
                font-weight: 800;
                font-size: 13px;
                box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
                transition: opacity 0.3s, transform 0.3s;
                transform: translateY(-10px);
                opacity: 0;
            `;

            toast.innerHTML = `<i data-lucide="${icon}" class="w-4 h-4 flex-shrink-0"></i> <span>${message}</span>`;
            document.body.appendChild(toast);

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            setTimeout(() => {
                toast.style.transform = 'translateY(0)';
                toast.style.opacity = '1';
            }, 50);

            if (type !== 'info') {
                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(-10px)';
                    setTimeout(() => toast.remove(), 300);
                }, 3500);
            }
        }

        // Accordion Toggle function (Fixed to allow closing active ones correctly)
        function toggleDetails(rowElement) {
            const detailContainer = rowElement.querySelector('.complaint-details');
            if (!detailContainer) return;

            const isOpen = rowElement.classList.contains('active');

            // Close all other rows
            document.querySelectorAll('.complaint-item').forEach(item => {
                if (item !== rowElement) {
                    item.classList.remove('active');
                    const details = item.querySelector('.complaint-details');
                    if (details) {
                        details.style.maxHeight = '0';
                        details.style.opacity = '0';
                        details.style.pointerEvents = 'none';
                    }
                }
            });

            // Toggle clicked row
            if (isOpen) {
                rowElement.classList.remove('active');
                detailContainer.style.maxHeight = '0';
                detailContainer.style.opacity = '0';
                detailContainer.style.pointerEvents = 'none';
            } else {
                rowElement.classList.add('active');
                // Set height dynamically based on scrollHeight
                detailContainer.style.maxHeight = detailContainer.scrollHeight + 'px';
                detailContainer.style.opacity = '1';
                detailContainer.style.pointerEvents = 'auto';
            }
        }
    </script>
@endsection
