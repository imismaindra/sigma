@php
    $activeRoute = request()->route()?->getName();
@endphp

<nav class="mobile-bottom-nav" aria-label="Navigasi utama mobile">
    <a href="{{ route('mahasiswa.dashboard') }}" class="bottom-nav-item {{ $activeRoute === 'mahasiswa.dashboard' ? 'is-active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M4 5.5A1.5 1.5 0 0 1 5.5 4h4A1.5 1.5 0 0 1 11 5.5v4A1.5 1.5 0 0 1 9.5 11h-4A1.5 1.5 0 0 1 4 9.5v-4ZM13 5.5A1.5 1.5 0 0 1 14.5 4h4A1.5 1.5 0 0 1 20 5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4A1.5 1.5 0 0 1 13 9.5v-4ZM4 14.5A1.5 1.5 0 0 1 5.5 13h4a1.5 1.5 0 0 1 1.5 1.5v4A1.5 1.5 0 0 1 9.5 20h-4A1.5 1.5 0 0 1 4 18.5v-4ZM13 14.5a1.5 1.5 0 0 1 1.5-1.5h4a1.5 1.5 0 0 1 1.5 1.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a1.5 1.5 0 0 1-1.5-1.5v-4Z" stroke="currentColor" stroke-width="1.8"/>
        </svg>
        <span>Home</span>
    </a>
    <a href="{{ route('mahasiswa.pengaduan.index') }}" class="bottom-nav-item {{ str_starts_with($activeRoute ?? '', 'mahasiswa.pengaduan.') && $activeRoute !== 'mahasiswa.pengaduan.create' ? 'is-active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M7 5h10M7 9h10M7 13h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            <path d="M5.5 3.5h13A1.5 1.5 0 0 1 20 5v14a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 4 19V5a1.5 1.5 0 0 1 1.5-1.5Z" stroke="currentColor" stroke-width="1.6"/>
        </svg>
        <span>Riwayat</span>
    </a>
    <a href="{{ route('mahasiswa.pengaduan.create') }}" class="bottom-nav-item bottom-nav-primary {{ $activeRoute === 'mahasiswa.pengaduan.create' ? 'is-active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Buat</span>
    </a>
    <a href="{{ route('mahasiswa.profile') }}" class="bottom-nav-item {{ str_starts_with($activeRoute ?? '', 'mahasiswa.profile') ? 'is-active' : '' }}">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8"/>
            <path d="M4.5 20a7.5 7.5 0 0 1 15 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
        <span>Profil</span>
    </a>
    <button type="button" class="bottom-nav-item" data-mahasiswa-logout-trigger>
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M10 6H6.5A1.5 1.5 0 0 0 5 7.5v9A1.5 1.5 0 0 0 6.5 18H10M14 8l4 4-4 4M18 12H9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>Keluar</span>
    </button>
</nav>
