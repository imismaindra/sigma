<header class="topbar">
    <div style="display:flex;align-items:center;gap:12px;min-width:0;">
        <button type="button" class="mobile-menu-btn" id="sidebarToggle" aria-label="Buka menu">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <div class="topbar-title">
            <strong>@yield('page_title', 'Dashboard Mahasiswa')</strong>
            <span class="hidden sm:block">@yield('page_subtitle', 'Kelola laporan dan pantau tindak lanjut pengaduan.')</span>
        </div>
    </div>

    <div class="topbar-actions">
        <div class="notification-pill cursor-default" title="Notifikasi belum dibaca">
            <i data-lucide="bell" class="w-4 h-4 text-slate-500"></i>
            <span class="hidden md:inline">Notifikasi</span>
            <span class="notification-count">{{ $unreadNotifications ?? 0 }}</span>
        </div>
        <a href="{{ route('mahasiswa.profile') }}" class="btn-secondary" style="gap:6px;">
            <i data-lucide="user" class="w-4 h-4"></i>
            <span class="hidden sm:inline">Profil</span>
        </a>
        <button type="button" class="btn-logout" id="btnTriggerMahasiswaLogout" style="gap:6px;">
            <i data-lucide="log-out" class="w-4 h-4"></i>
            <span class="hidden sm:inline">Keluar</span>
        </button>
    </div>
</header>
