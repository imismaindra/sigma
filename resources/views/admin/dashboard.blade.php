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

    <!-- Top 5 Kategori & Recent Activities -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        <div class="lg:col-span-5 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs">
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

        <div class="lg:col-span-7 bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs flex flex-col">
            <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-indigo-650"></i> Aktivitas Terbaru
            </h3>
            <div class="space-y-3.5 flex-1 max-h-80 overflow-y-auto pr-1">
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
@endsection
