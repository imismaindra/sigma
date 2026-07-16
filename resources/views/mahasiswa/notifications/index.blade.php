@extends('layouts.mahasiswa')

@section('title', 'Notifikasi Saya')
@section('page_title', 'Notifikasi')
@section('page_subtitle', 'Pantau semua pembaruan dan pemberitahuan pengaduan Anda.')

@section('styles')
    .notif-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .notif-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .notif-badge {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        border-radius: 999px;
        padding: 0 12px;
        font-size: 11px;
        font-weight: 800;
        background: var(--primary-soft);
        color: var(--primary-dark);
        border: 1px solid rgba(124, 198, 255, .35);
    }

    .notif-list {
        display: grid;
        gap: 10px;
    }

    .notif-item {
        display: block;
        text-decoration: none;
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        padding: 16px;
        background: var(--glass-bg);
        transition: transform .15s ease, border-color .15s ease;
        position: relative;
    }

    .notif-item:hover {
        transform: translateY(-1px);
        border-color: color-mix(in srgb, var(--stock-blue) 45%, var(--glass-border));
    }

    .notif-item.unread {
        border-color: rgba(124, 198, 255, .4);
        background: linear-gradient(135deg, rgba(109, 199, 255, .08), rgba(51, 214, 159, .04));
    }

    .notif-item.unread::before {
        content: "";
        position: absolute;
        top: 18px;
        left: 8px;
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: var(--stock-blue);
        box-shadow: 0 0 10px color-mix(in srgb, var(--stock-blue) 50%, transparent);
    }

    .notif-item-inner {
        padding-left: 20px;
    }

    .notif-title {
        font-size: 14px;
        font-weight: 800;
        color: var(--text);
    }

    .notif-item.unread .notif-title {
        color: var(--stock-blue);
    }

    .notif-message {
        margin-top: 5px;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.5;
    }

    .notif-time {
        margin-top: 8px;
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
    }

    .notif-read-btn {
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 999px;
        border: 1px solid var(--glass-border);
        background: var(--glass-bg-strong);
        color: var(--muted);
        font-size: 10px;
        font-weight: 800;
        cursor: pointer;
        transition: all .15s ease;
    }

    .notif-read-btn:hover {
        border-color: var(--stock-blue);
        color: var(--stock-blue);
    }

    .empty-notif {
        border-radius: 20px;
        padding: 48px 20px;
        text-align: center;
        background: var(--glass-bg);
        border: 1px dashed var(--glass-border);
        color: var(--muted);
        font-size: 13px;
        line-height: 1.55;
    }

    .empty-notif-icon {
        width: 48px;
        height: 48px;
        border-radius: 999px;
        display: grid;
        place-items: center;
        margin: 0 auto 14px;
        background: var(--glass-bg-strong);
        border: 1px solid var(--glass-border);
        color: var(--muted);
    }

    .empty-notif-icon svg {
        width: 22px;
        height: 22px;
    }

    @media (max-width: 640px) {
        .notif-item {
            padding: 14px;
        }
        .notif-item-inner {
            padding-left: 16px;
        }
        .notif-item.unread::before {
            left: 6px;
            top: 16px;
        }
    }
@endsection

@section('content')
    @php
        $unreadCount = $notifications->whereNull('read_at')->count();
    @endphp

    <div class="notif-header">
        <div class="notif-header-left">
            <span class="section-title" style="margin:0;">Notifikasi</span>
            @if($unreadCount > 0)
                <span class="notif-badge">{{ $unreadCount }} belum dibaca</span>
            @endif
        </div>
        @if($unreadCount > 0)
            <form action="{{ route('mahasiswa.notifications.read-all') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="quick-action" style="cursor:pointer;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    Tandai Semua Dibaca
                </button>
            </form>
        @endif
    </div>

    <div class="notif-list">
        @forelse($notifications as $notif)
            @php
                $isUnread = is_null($notif->read_at);
                $targetUrl = $notif->id_pengaduan
                    ? route('mahasiswa.pengaduan.show', $notif->id_pengaduan)
                    : '#';
            @endphp
            <div class="notif-item {{ $isUnread ? 'unread' : '' }}" data-notif-id="{{ $notif->id_notification }}">
                <div class="notif-item-inner">
                    <div class="notif-title">{{ $notif->title }}</div>
                    <div class="notif-message">{{ $notif->message }}</div>
                    <div class="notif-time">{{ $notif->created_at->diffForHumans() }}</div>
                    @if($isUnread)
                        <button type="button" class="notif-read-btn" data-mark-read="{{ $notif->id_notification }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;"><path d="m5 13 4 4L19 7"/></svg>
                            Tandai dibaca
                        </button>
                    @endif
                    @if($notif->id_pengaduan)
                        <a href="{{ $targetUrl }}" class="notif-read-btn" style="text-decoration:none;margin-left:6px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px;"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6"/><path d="M10 14 21 3"/></svg>
                            Lihat pengaduan
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-notif">
                <div class="empty-notif-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                <p>Tidak ada notifikasi saat ini. Semua pembaruan pengaduan akan muncul di sini.</p>
            </div>
        @endforelse
    </div>

    @if($notifications->hasPages())
        <div class="simple-pagination">
            <div class="page-info">
                Halaman {{ $notifications->currentPage() }} dari {{ $notifications->lastPage() }}
                <span>{{ $notifications->total() }} notifikasi</span>
            </div>
            <div style="display:flex;gap:8px;">
                @if($notifications->previousPageUrl())
                    <a href="{{ $notifications->previousPageUrl() }}" class="page-button">← Sebelumnya</a>
                @else
                    <span class="page-button disabled">← Sebelumnya</span>
                @endif
                @if($notifications->nextPageUrl())
                    <a href="{{ $notifications->nextPageUrl() }}" class="page-button">Selanjutnya →</a>
                @else
                    <span class="page-button disabled">Selanjutnya →</span>
                @endif
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        document.querySelectorAll('[data-mark-read]').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.markRead;
                const item = this.closest('.notif-item');
                fetch('{{ route('mahasiswa.notifications.read', '') }}/' + id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                }).then(() => {
                    item.classList.remove('unread');
                    this.remove();
                    const badge = document.querySelector('.notif-badge');
                    if (badge) {
                        const count = parseInt(badge.textContent);
                        if (count <= 1) badge.remove();
                        else badge.textContent = (count - 1) + ' belum dibaca';
                    }
                });
            });
        });
    </script>
@endsection
