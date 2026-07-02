@php
    $activeRoute = request()->route()?->getName();
@endphp

<aside class="sidebar" id="appSidebar">
    <div class="sidebar-head">
        <a href="{{ route('mahasiswa.dashboard') }}" class="brand" data-close-sidebar>
            <span class="brand-mark">SP</span>
            <span>
                <strong>SIPMA</strong>
                <span>Sistem Informasi Pengaduan Mahasiswa</span>
            </span>
        </a>

        <div class="sidebar-user">
            <div class="sidebar-user-name">{{ Auth::user()->nama }}</div>
            <div class="sidebar-user-meta">Mahasiswa<br>{{ Auth::user()->nim_nip }}</div>
        </div>
    </div>

    <nav class="sidebar-nav" aria-label="Navigasi mahasiswa">
        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ $activeRoute === 'mahasiswa.dashboard' ? 'is-active' : '' }}" data-close-sidebar>
            <i data-lucide="layout-dashboard" class="nav-icon"></i>
            Dashboard
        </a>
        <a href="{{ route('mahasiswa.pengaduan.create') }}" class="nav-link {{ $activeRoute === 'mahasiswa.pengaduan.create' ? 'is-active' : '' }}" data-close-sidebar>
            <i data-lucide="file-plus" class="nav-icon"></i>
            Buat Pengaduan
        </a>
        <a href="{{ route('mahasiswa.pengaduan.index') }}" class="nav-link {{ str_starts_with($activeRoute ?? '', 'mahasiswa.pengaduan.') && $activeRoute !== 'mahasiswa.pengaduan.create' ? 'is-active' : '' }}" data-close-sidebar>
            <i data-lucide="clipboard-list" class="nav-icon"></i>
            Riwayat Pengaduan
        </a>
        <a href="{{ route('mahasiswa.profile') }}" class="nav-link {{ str_starts_with($activeRoute ?? '', 'mahasiswa.profile') ? 'is-active' : '' }}" data-close-sidebar>
            <i data-lucide="user" class="nav-icon"></i>
            Profil Mahasiswa
        </a>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-200/60 bg-slate-50/30">
        <button type="button" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-xs font-bold text-rose-600 bg-rose-50/50 hover:bg-rose-50 border border-rose-100/40 hover:border-rose-200/50 transition-all cursor-pointer" id="btnTriggerMahasiswaLogout">
            <i data-lucide="log-out" class="w-4 h-4"></i>
            Keluar Panel
        </button>
    </div>
</aside>
