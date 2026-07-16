<header class="topbar">
    <div style="display:flex;align-items:center;gap:12px;min-width:0;">
        <button type="button" class="mobile-menu-btn" id="sidebarToggle" aria-label="Buka menu">=</button>
        <div class="topbar-title">
            <strong>@yield('page_title', 'Dashboard Mahasiswa')</strong>
            <span>@yield('page_subtitle', 'Kelola laporan dan pantau tindak lanjut pengaduan.')</span>
        </div>
    </div>

    <div class="topbar-actions">
        <div class="notif-dropdown" id="notifDropdown">
            <button type="button" class="notif-trigger" id="notifTrigger" aria-label="Notifikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span class="notif-bell-count {{ ($unreadNotifications ?? 0) > 0 ? 'has-unread' : '' }}" id="notifBellCount">{{ $unreadNotifications ?? 0 }}</span>
            </button>
            <div class="notif-panel" id="notifPanel">
                <div class="notif-panel-head">
                    <span class="notif-panel-title">Notifikasi</span>
                    <button type="button" class="notif-mark-all-btn" id="notifMarkAllRead" style="{{ ($unreadNotifications ?? 0) > 0 ? '' : 'display:none;' }}">Tandai dibaca</button>
                </div>
                <div class="notif-panel-list" id="notifPanelList">
                    <div class="notif-panel-loading">Memuat...</div>
                </div>
                <a href="{{ route('mahasiswa.notifications.index') }}" class="notif-panel-footer">Lihat Semua Notifikasi</a>
            </div>
        </div>
        <button type="button" class="theme-toggle" id="themeToggle" aria-label="Ubah tema">
            <span class="theme-toggle-icon" id="themeToggleIcon">☾</span>
            <span id="themeToggleText">Dark</span>
        </button>
        <a href="{{ route('mahasiswa.profile') }}" class="btn-secondary">Profil</a>
        <form id="mahasiswaLogoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
        <button type="button" class="btn-logout" id="btnTriggerMahasiswaLogout" data-mahasiswa-logout-trigger>Keluar</button>
    </div>
</header>
