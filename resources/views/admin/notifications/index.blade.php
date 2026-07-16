@extends('layouts.admin')

@section('title', 'Notifikasi Admin')

@section('content')
    <!-- Header -->
    <section class="bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 lg:p-8 shadow-sm relative overflow-hidden mb-6">
        <div class="absolute -right-24 -bottom-24 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650 uppercase mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Notifikasi Panel
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">Notifikasi Admin</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Pantau semua pemberitahuan terkait pengaduan masuk dan aktivitas sistem.
            </p>
        </div>
    </section>

    @php
        $unreadCount = $notifications->whereNull('read_at')->count();
    @endphp

    <div class="flex items-center justify-between gap-4 mb-5 flex-wrap">
        <div class="flex items-center gap-3">
            <h2 class="text-sm font-extrabold text-slate-900">Notifikasi</h2>
            @if($unreadCount > 0)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650" id="adminNotifBadge">
                    {{ $unreadCount }} belum dibaca
                </span>
            @endif
        </div>
        @if($unreadCount > 0)
            <form action="{{ route('admin.notifications.read-all') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 h-8 px-3 rounded-lg border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors cursor-pointer">
                    <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    <div class="space-y-3">
        @forelse($notifications as $notif)
            @php
                $isUnread = is_null($notif->read_at);
                $targetUrl = $notif->id_pengaduan
                    ? route('admin.pengaduan.show', $notif->id_pengaduan)
                    : '#';
            @endphp
            <div class="bg-white border border-slate-200/80 rounded-xl p-4 {{ $isUnread ? 'border-l-4 border-l-indigo-500 bg-indigo-50/30' : '' }} transition-colors" data-notif-id="{{ $notif->id_notification }}">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <h4 class="text-sm font-extrabold text-slate-900 {{ $isUnread ? 'text-indigo-700' : '' }}">{{ $notif->title }}</h4>
                            @if($isUnread)
                                <span class="w-2 h-2 rounded-full bg-indigo-600 flex-shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed mb-2">{{ $notif->message }}</p>
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] text-slate-400 font-bold">{{ $notif->created_at->diffForHumans() }}</span>
                            @if($isUnread)
                                <button type="button" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 transition-colors" data-mark-read="{{ $notif->id_notification }}" data-route="{{ route('admin.notifications.read', $notif->id_notification) }}">
                                    Tandai dibaca
                                </button>
                            @endif
                            @if($notif->id_pengaduan)
                                <a href="{{ $targetUrl }}" class="text-[10px] font-bold text-slate-600 hover:text-indigo-600 transition-colors">
                                    Lihat pengaduan &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white/80 border border-dashed border-slate-300 rounded-xl p-12 text-center">
                <div class="w-12 h-12 rounded-full bg-slate-50 border border-slate-200 flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="bell-off" class="w-5 h-5 text-slate-400"></i>
                </div>
                <p class="text-xs text-slate-500 font-medium">Tidak ada notifikasi saat ini.</p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="flex items-center justify-between gap-4 flex-wrap border-t border-slate-200 pt-4 mt-6">
            <div class="text-xs text-slate-500 font-semibold">
                Halaman {{ $notifications->currentPage() }} dari {{ $notifications->lastPage() }}
                <span class="text-slate-400 font-medium">({{ $notifications->total() }} notifikasi)</span>
            </div>
            <div class="flex gap-2">
                @if($notifications->previousPageUrl())
                    <a href="{{ $notifications->previousPageUrl() }}" class="h-8 px-3 rounded-lg border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-1">
                        <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i> Sebelumnya
                    </a>
                @endif
                @if($notifications->nextPageUrl())
                    <a href="{{ $notifications->nextPageUrl() }}" class="h-8 px-3 rounded-lg border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 transition-colors flex items-center gap-1">
                        Selanjutnya <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                @endif
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-mark-read]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const route = this.dataset.route;
                    const item = this.closest('[data-notif-id]');
                    fetch(route, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(() => {
                        item.classList.remove('border-l-indigo-500', 'bg-indigo-50/30');
                        item.querySelector('.w-2.h-2')?.remove();
                        this.remove();
                        const badge = document.getElementById('adminNotifBadge');
                        if (badge) {
                            const count = parseInt(badge.textContent);
                            if (count <= 1) badge.remove();
                            else badge.textContent = (count - 1) + ' belum dibaca';
                        }
                    });
                });
            });
        });
    </script>
@endsection
