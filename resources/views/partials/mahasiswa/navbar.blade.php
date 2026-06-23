<header class="topbar">
    <div style="display:flex;align-items:center;gap:12px;min-width:0;">
        <button type="button" class="mobile-menu-btn" id="sidebarToggle" aria-label="Buka menu">=</button>
        <div class="topbar-title">
            <strong>@yield('page_title', 'Dashboard Mahasiswa')</strong>
            <span>@yield('page_subtitle', 'Kelola laporan dan pantau tindak lanjut pengaduan.')</span>
        </div>
    </div>

    <div class="topbar-actions">
        <div class="notification-pill" title="Notifikasi belum dibaca">
            <span>Notifikasi</span>
            <span class="notification-count">{{ $unreadNotifications ?? 0 }}</span>
        </div>
        <a href="{{ route('mahasiswa.profile') }}" class="btn-secondary">Profil</a>
        <form id="mahasiswaLogoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
        <button type="button" class="btn-logout" id="btnTriggerMahasiswaLogout">Keluar</button>
    </div>
</header>
