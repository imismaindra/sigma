<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - SIPMA</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Badge styles */
        .badge {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            border-radius: 999px;
            padding: 0 9px;
            font-size: 11px;
            font-weight: 800;
            text-transform: capitalize;
            white-space: nowrap;
        }
        .badge-pending { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
        .badge-proses { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .badge-selesai { background: #d1fae5; color: #047857; border: 1px solid #a7f3d0; }
        .badge-ditolak { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
        .badge-menunggu_klarifikasi { background: #f3e8ff; color: #7c3aed; border: 1px solid #e9d5ff; }
        .badge-ditindaklanjuti { background: #ccfbf1; color: #0f766e; border: 1px solid #99f6e4; }
        .badge-menunggu_verifikasi_mahasiswa { background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; }
        .sla-badge {
            display: inline-flex;
            align-items: center;
            min-height: 26px;
            border-radius: 999px;
            padding: 0 9px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .simple-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            border-top: 1px solid #e2e8f0;
            padding-top: 14px;
            margin-top: 18px;
        }
        .page-button {
            min-height: 38px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #4338ca;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }
        .page-button.disabled {
            color: #94a3b8;
            background: #f8fafc;
            cursor: not-allowed;
        }
        .page-info {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            flex-direction: column;
            gap: 2px;
            text-align: center;
        }
        .page-info span {
            font-size: 12px;
            font-weight: 600;
        }

        /* Optimize scrolling performance for elements with backdrop-filter or backdrop-blur */
        [class*="backdrop-blur-"],
        .backdrop-blur,
        #appSidebar,
        nav.sticky,
        .fixed.pointer-events-none.z-0 > div {
            transform: translate3d(0, 0, 0);
            -webkit-transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            will-change: transform;
        }
        .admin-notif-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            min-width: 16px;
            height: 16px;
            border-radius: 999px;
            display: none;
            place-items: center;
            font-size: 8px;
            font-weight: 900;
            background: #ef4444;
            color: #fff;
            border: 2px solid #fff;
            line-height: 1;
            padding: 0 3px;
        }
        .admin-notif-badge.has-unread {
            display: grid;
        }
        .admin-notif-panel-item {
            display: block;
            padding: 10px 14px;
            text-decoration: none;
            border-bottom: 1px solid #f1f5f9;
            transition: background .12s ease;
            cursor: pointer;
        }
        .admin-notif-panel-item:hover {
            background: #f8fafc;
        }
        .admin-notif-panel-item.unread {
            background: #eef2ff;
            border-left: 3px solid #6366f1;
        }
        .admin-notif-panel-item-title {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .admin-notif-panel-item.unread .admin-notif-panel-item-title {
            color: #4f46e5;
        }
        .admin-notif-panel-item-message {
            font-size: 10px;
            color: #64748b;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .admin-notif-panel-item-time {
            font-size: 9px;
            color: #94a3b8;
            font-weight: 700;
            margin-top: 3px;
        }
    </style>
    @yield('styles')
</head>
<body class="min-h-full flex flex-col text-slate-800 antialiased selection:bg-indigo-500 selection:text-white relative bg-slate-50/30">

    <!-- Decorative background glow -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-[40%] -left-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-tr from-indigo-200/25 to-violet-200/25 blur-[120px]"></div>
        <div class="absolute -bottom-[40%] -right-[20%] w-[90%] h-[90%] rounded-full bg-gradient-to-br from-blue-200/20 to-purple-200/20 blur-[120px]"></div>
    </div>

    <!-- Mobile Sidebar Backdrop -->
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-30 hidden transition-opacity duration-300" id="sidebarBackdrop"></div>

    <div class="relative z-10 flex min-h-screen">
        
        <!-- Sidebar Navigation -->
        <aside class="fixed inset-y-0 left-0 z-40 w-72 bg-white/90 backdrop-blur-md border-r border-slate-200/60 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xs" id="appSidebar">
            <!-- Sidebar Head -->
            <div class="p-6 border-b border-slate-200/60 flex flex-col gap-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-violet-600 to-purple-650 flex items-center justify-center text-white font-extrabold text-sm shadow-md shadow-indigo-500/20 group-hover:rotate-6 transition-transform duration-300">
                        SP
                    </div>
                    <div>
                        <h2 class="text-sm font-extrabold text-slate-900 leading-tight tracking-tight">SIPMA Admin</h2>
                        <p class="text-[10px] text-indigo-600 font-bold uppercase tracking-wider">Sistem Pengaduan</p>
                    </div>
                </a>

                <div class="p-3.5 bg-slate-50/80 rounded-xl border border-slate-200/50 mt-1">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
                        </div>
                        <div class="min-width-0 flex-1">
                            <p class="text-xs font-bold text-slate-900 truncate leading-none mb-1">{{ Auth::user()->nama }}</p>
                            <p class="text-[10px] text-slate-500 truncate leading-none capitalize font-semibold">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Nav Links -->
            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                @php $currentRoute = request()->route()?->getName(); @endphp
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ $currentRoute === 'admin.dashboard' ? 'bg-indigo-50 text-indigo-650 border border-indigo-100/50 shadow-3xs shadow-indigo-500/5' : 'text-slate-655 hover:bg-slate-50 hover:text-slate-950 border border-transparent' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard Admin
                </a>

                <a href="{{ route('admin.pengaduan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ str_starts_with($currentRoute, 'admin.pengaduan.') ? 'bg-indigo-50 text-indigo-650 border border-indigo-100/50 shadow-3xs shadow-indigo-500/5' : 'text-slate-655 hover:bg-slate-50 hover:text-slate-950 border border-transparent' }}">
                    <i data-lucide="file-text" class="w-4 h-4"></i>
                    Daftar Pengaduan
                </a>

                <a href="{{ route('admin.notifications.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ str_starts_with($currentRoute, 'admin.notifications') ? 'bg-indigo-50 text-indigo-650 border border-indigo-100/50 shadow-3xs shadow-indigo-500/5' : 'text-slate-655 hover:bg-slate-50 hover:text-slate-950 border border-transparent' }}">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    Notifikasi
                </a>

                @if(Auth::user()->role !== 'pimpinan')
                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ $currentRoute === 'admin.kategori.index' ? 'bg-indigo-50 text-indigo-650 border border-indigo-100/50 shadow-3xs shadow-indigo-500/5' : 'text-slate-655 hover:bg-slate-50 hover:text-slate-950 border border-transparent' }}">
                        <i data-lucide="tag" class="w-4 h-4"></i>
                        Manajemen Kategori
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold transition-all {{ $currentRoute === 'admin.users.index' ? 'bg-indigo-50 text-indigo-650 border border-indigo-100/50 shadow-3xs shadow-indigo-500/5' : 'text-slate-655 hover:bg-slate-50 hover:text-slate-950 border border-transparent' }}">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        Manajemen User
                    </a>
                @endif
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-200/60 bg-slate-50/30">
                <button type="button" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl text-xs font-bold text-rose-600 bg-rose-50/50 hover:bg-rose-50 border border-rose-100/40 hover:border-rose-200/50 transition-all cursor-pointer" id="btnTriggerSidebarLogout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    Keluar Panel
                </button>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col lg:pl-72 min-w-0">
            
            <!-- Navbar Header -->
            <nav class="sticky top-0 z-30 backdrop-blur-md bg-white/75 border-b border-slate-200/60 px-4 sm:px-8 py-3.5 flex items-center justify-between shadow-xs shadow-slate-100/40">
                <div class="flex items-center gap-3">
                    <button type="button" class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 lg:hidden cursor-pointer" id="sidebarToggle">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full border border-slate-200/60 bg-slate-50 text-[10px] font-bold text-slate-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Admin Server Connected
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="admin-notif-dropdown relative" id="adminNotifDropdown">
                        <button type="button" class="relative inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all cursor-pointer" id="adminNotifTrigger" aria-label="Notifikasi">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                            @php $adminUnreadCount = Auth::user()->notifications()->whereNull('read_at')->count(); @endphp
                            <span class="admin-notif-badge {{ $adminUnreadCount > 0 ? 'has-unread' : '' }}" id="adminNotifBellCount">{{ $adminUnreadCount }}</span>
                        </button>
                        <div class="admin-notif-panel hidden absolute top-full right-0 mt-2 w-80 bg-white border border-slate-200 rounded-xl shadow-xl z-50 overflow-hidden" id="adminNotifPanel">
                            <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                                <span class="text-xs font-extrabold text-slate-900">Notifikasi</span>
                                <button type="button" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 transition-colors cursor-pointer" id="adminNotifMarkAllRead" style="{{ $adminUnreadCount > 0 ? '' : 'display:none;' }}">Tandai dibaca</button>
                            </div>
                            <div class="max-h-72 overflow-y-auto" id="adminNotifPanelList">
                                <div class="p-4 text-center text-xs text-slate-400">Memuat...</div>
                            </div>
                            <a href="{{ route('admin.notifications.index') }}" class="block text-center py-3 text-xs font-bold text-indigo-600 hover:bg-slate-50 border-t border-slate-100 transition-colors">
                                Lihat Semua Notifikasi
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col text-right">
                        <p class="text-xs font-extrabold text-slate-900 leading-none">{{ Auth::user()->nama }}</p>
                        <p class="text-[9px] text-slate-500 font-bold mt-0.5 uppercase tracking-wide">Administrator</p>
                    </div>
                    
                    <div class="h-6 w-px bg-slate-200"></div>

                    <button type="button" class="inline-flex h-8 items-center gap-1.5 px-3 rounded-lg bg-rose-50 border border-rose-200/50 text-xs font-bold text-rose-600 hover:bg-rose-100 hover:text-rose-700 transition-all shadow-3xs cursor-pointer" id="btnTriggerHeaderLogout">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        Keluar
                    </button>
                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8 space-y-6">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="p-6 border-t border-slate-200/40 text-center text-[11px] text-slate-450 font-medium">
                <p>&copy; 2026 MPTI Kelompok Sigma - Sistem Informasi Pengaduan Mahasiswa.</p>
            </footer>
        </div>
    </div>

    <!-- Global Logout Confirmation Modal -->
    <div class="fixed inset-0 z-50 overflow-y-auto hidden items-center justify-center p-4 bg-slate-900/45 backdrop-blur-xs transition-opacity duration-300" id="logoutModal" role="dialog" aria-modal="true">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 w-full max-w-sm shadow-xl transform scale-95 transition-transform duration-300 text-center" id="logoutModalContent">
            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 border border-rose-100">
                <i data-lucide="log-out" class="w-6 h-6"></i>
            </div>
            <h3 class="text-base font-extrabold text-slate-900 mb-2">Konfirmasi Keluar</h3>
            <p class="text-xs text-slate-500 leading-relaxed mb-6">Apakah Anda yakin ingin keluar dari Panel Administrasi SIPMA?</p>
            <div class="flex gap-3">
                <button type="button" class="flex-1 h-9.5 rounded-xl border border-slate-200 bg-slate-50 text-xs font-bold text-slate-700 hover:bg-slate-100 transition-colors cursor-pointer" id="btnCancelLogout">Batal</button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full h-9.5 rounded-xl bg-rose-600 text-xs font-bold text-white hover:bg-rose-700 shadow-md shadow-rose-500/10 transition-colors cursor-pointer">Keluar</button>
                </form>
            </div>
        </div>
    </div>

    @include('partials.toast')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar responsiveness
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const toggle = document.getElementById('sidebarToggle');

            const openSidebar = () => {
                sidebar?.classList.remove('-translate-x-full');
                backdrop?.classList.remove('hidden');
                backdrop?.classList.add('flex');
            };

            const closeSidebar = () => {
                sidebar?.classList.add('-translate-x-full');
                backdrop?.classList.add('hidden');
                backdrop?.classList.remove('flex');
            };

            toggle?.addEventListener('click', openSidebar);
            backdrop?.addEventListener('click', closeSidebar);

            // Logout Modal controls
            const logoutModal = document.getElementById('logoutModal');
            const btnCancelLogout = document.getElementById('btnCancelLogout');
            const btnTriggerSidebarLogout = document.getElementById('btnTriggerSidebarLogout');
            const btnTriggerHeaderLogout = document.getElementById('btnTriggerHeaderLogout');

            const showLogoutModal = () => {
                closeSidebar();
                logoutModal?.classList.remove('hidden');
                logoutModal?.classList.add('flex');
                setTimeout(() => {
                    document.getElementById('logoutModalContent')?.classList.remove('scale-95');
                }, 50);
            };

            const hideLogoutModal = () => {
                document.getElementById('logoutModalContent')?.classList.add('scale-95');
                setTimeout(() => {
                    logoutModal?.classList.add('hidden');
                    logoutModal?.classList.remove('flex');
                }, 200);
            };

            btnTriggerSidebarLogout?.addEventListener('click', showLogoutModal);
            btnTriggerHeaderLogout?.addEventListener('click', showLogoutModal);
            btnCancelLogout?.addEventListener('click', hideLogoutModal);

            logoutModal?.addEventListener('click', (e) => {
                if (e.target === logoutModal) hideLogoutModal();
            });

            // Admin Notification Dropdown
            const adminTrigger = document.getElementById('adminNotifTrigger');
            const adminPanel = document.getElementById('adminNotifPanel');
            const adminNotifList = document.getElementById('adminNotifPanelList');
            const adminBellCount = document.getElementById('adminNotifBellCount');
            const adminMarkAllBtn = document.getElementById('adminNotifMarkAllRead');

            if (adminTrigger) {
                adminTrigger.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = adminPanel.classList.contains('hidden');
                    if (!isHidden) { adminPanel.classList.add('hidden'); return; }
                    adminPanel.classList.remove('hidden');
                    if (adminNotifList) {
                        adminNotifList.innerHTML = '<div class="p-4 text-center text-xs text-slate-400">Memuat...</div>';
                        fetch('{{ route('admin.notifications.latest') }}', {
                            headers: { 'Accept': 'application/json' }
                        })
                        .then(r => r.json())
                        .then(data => {
                            if (data.notifications.length === 0) {
                                adminNotifList.innerHTML = '<div class="p-4 text-center text-xs text-slate-400">Tidak ada notifikasi</div>';
                                return;
                            }
                            adminNotifList.innerHTML = data.notifications.map(n => `
                                <a href="${n.url}" class="admin-notif-panel-item ${n.is_unread ? 'unread' : ''}" data-notif-id="${n.id}">
                                    <div class="admin-notif-panel-item-title">${n.title}</div>
                                    <div class="admin-notif-panel-item-message">${n.message}</div>
                                    <div class="admin-notif-panel-item-time">${n.created_at}</div>
                                </a>
                            `).join('');
                            adminNotifList.querySelectorAll('.admin-notif-panel-item.unread').forEach(item => {
                                item.addEventListener('click', function() {
                                    const id = this.dataset.notifId;
                                    fetch('{{ route('admin.notifications.read', '') }}/' + id, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                        },
                                    });
                                });
                            });
                            if (adminMarkAllBtn) {
                                adminMarkAllBtn.style.display = data.unread_count > 0 ? '' : 'none';
                            }
                        })
                        .catch(() => {
                            adminNotifList.innerHTML = '<div class="p-4 text-center text-xs text-slate-400">Gagal memuat</div>';
                        });
                    }
                });

                document.addEventListener('click', function(e) {
                    const dropdown = document.getElementById('adminNotifDropdown');
                    if (dropdown && !dropdown.contains(e.target)) {
                        adminPanel.classList.add('hidden');
                    }
                });

                adminMarkAllBtn?.addEventListener('click', function() {
                    fetch('{{ route('admin.notifications.read-all') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    }).then(() => {
                        document.querySelectorAll('.admin-notif-panel-item.unread').forEach(el => el.classList.remove('unread'));
                        if (adminBellCount) {
                            adminBellCount.textContent = '0';
                            adminBellCount.classList.remove('has-unread');
                        }
                        adminMarkAllBtn.style.display = 'none';
                    });
                });

                // Poll every 30s
                setInterval(function() {
                    fetch('{{ route('admin.notifications.unread-count') }}', {
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (adminBellCount) {
                            adminBellCount.textContent = data.count;
                            adminBellCount.classList.toggle('has-unread', data.count > 0);
                        }
                    })
                    .catch(() => {});
                }, 30000);
            }

            // Initialize Lucide Icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
