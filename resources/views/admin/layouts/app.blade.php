<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">
    <title>@yield('title', 'Admin Panel') | PERSIS PERS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            800: '#143d2c',
                            900: '#0d281d',
                            950: '#091c14',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; }
        [x-cloak] { display: none !important; }

        /* Smooth Sidebar Collapse Transition */
        #admin-sidebar {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #main-content-wrapper {
            transition: padding-left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="min-h-screen antialiased text-slate-800 bg-[#f8fafc] flex flex-col">

    @php
        $latestMessages = \App\Models\ContactMessage::latest()->take(6)->get();
        $unreadMessagesCount = \App\Models\ContactMessage::where('status', 'pending')->count();
    @endphp

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden transition-opacity"></div>

        <!-- Sidebar (Collapsible w-64) -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f172a] text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-slate-800 shadow-xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        <div class="p-5">
            <!-- Brand Header (Clean Full Logo) -->
            <div class="pb-4 mb-4 border-b border-slate-800 flex items-center justify-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-12 w-auto object-contain" />
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-6 text-xs">
                <!-- Section 1: Overview -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-slate-500 uppercase block mb-2">Overview</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-gauge w-4 text-center"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.messages.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-inbox w-4 text-center"></i>
                                <span>Pesan &amp; Naskah</span>
                            </div>
                            @if($unreadMessagesCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-slate-950 font-mono">{{ $unreadMessagesCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-user-shield w-4 text-center"></i>
                            <span>Manajemen Admin</span>
                        </a>
                    </div>
                </div>

                <!-- Section 2: Penjualan & Penerbitan -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-slate-500 uppercase block mb-2">Transaksi &amp; Katalog</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-receipt w-4 text-center"></i>
                            <span>Pesanan Buku</span>
                            @php
                                $pendingOrdersCount = \App\Models\Order::where('payment_status', 'completed')->where('shipping_status', 'menunggu_proses')->count();
                            @endphp
                            @if($pendingOrdersCount > 0)
                                <span class="ml-auto px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-[#032c21]">{{ $pendingOrdersCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.books.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-book-bookmark w-4 text-center"></i>
                            <span>Katalog Buku &amp; ISBN</span>
                        </a>
                    </div>
                </div>

                <!-- Section 3: Pengaturan Web -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-slate-500 uppercase block mb-2">Pengaturan</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.settings.catalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.settings.catalog') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-sliders w-4 text-center"></i>
                            <span>Kelola Halaman Katalog</span>
                        </a>

                        <a href="{{ route('admin.settings.about') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.settings.about') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-circle-info w-4 text-center"></i>
                            <span>Kelola Tentang Kami</span>
                        </a>

                        <a href="{{ route('admin.settings.contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition {{ request()->routeIs('admin.settings.contact') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-slate-800 hover:text-white' }}">
                            <i class="fa-solid fa-address-book w-4 text-center"></i>
                            <span>Kelola Kontak &amp; Web</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Logout Section in Sidebar -->
        <div class="p-4 border-t border-slate-800">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl font-bold text-xs text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition border border-rose-500/20">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper (Adjusts padding dynamically on desktop) -->
    <div id="main-content-wrapper" class="flex-1 flex flex-col min-w-0 min-h-screen lg:pl-64">
        
        <!-- Top Navigation Header with Toggle Button -->
        <header class="h-16 bg-white border-b border-slate-200/80 sticky top-0 z-30 flex items-center justify-between px-4 sm:px-6 lg:px-8 shrink-0">
            
            <!-- Left: Toggle Sidebar Button & Page Header Title -->
            <div class="flex items-center gap-3 sm:gap-4">
                <button 
                    id="sidebarToggleBtn"
                    type="button" 
                    onclick="toggleSidebar()" 
                    class="p-2 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 transition border border-slate-200 flex items-center justify-center" 
                    title="Buka / Tutup Sidebar Navigasi"
                >
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                </button>
                
                <div>
                    <h1 class="text-sm sm:text-base font-extrabold text-slate-900 leading-tight">
                        @yield('header_title', 'Dashboard Panel')
                    </h1>
                </div>
            </div>

            <!-- Right: Notification Center & Web Preview -->
            <div class="flex items-center gap-3">
                
                <!-- Notification Center Dropdown -->
                <div class="relative" id="notifDropdownContainer">
                    <button 
                        type="button" 
                        onclick="toggleNotifDropdown()" 
                        class="relative p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl border border-slate-200 transition flex items-center justify-center"
                        title="Notifikasi Masuk"
                    >
                        <i class="fa-regular fa-bell text-sm"></i>
                        @if($unreadMessagesCount > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[9px] font-bold flex items-center justify-center font-mono animate-pulse">
                                {{ $unreadMessagesCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Content -->
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200/80 overflow-hidden z-50 animate-fade-in-up">
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-emerald-400 text-xs"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Notifikasi Masuk</span>
                            </div>
                            <span class="text-[10px] bg-slate-800 text-emerald-300 px-2 py-0.5 rounded-full font-bold">
                                {{ $unreadMessagesCount }} Baru
                            </span>
                        </div>

                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            @forelse($latestMessages as $msg)
                                <a 
                                    href="{{ route('admin.messages.show', $msg) }}" 
                                    class="block p-3.5 hover:bg-slate-50 transition {{ $msg->status === 'pending' ? 'bg-emerald-50/40' : '' }}"
                                >
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full {{ $msg->status === 'pending' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-1 mb-0.5">
                                                <span class="text-xs font-bold text-slate-900 truncate">{{ $msg->name }}</span>
                                                <span class="text-[10px] text-slate-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-[11px] text-slate-500 truncate leading-snug">
                                                {{ $msg->subject ?: Str::limit($msg->message, 45) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-6 text-center text-slate-400 text-xs">
                                    <i class="fa-regular fa-bell-slash text-2xl mb-1 text-slate-300 block"></i>
                                    Belum ada notifikasi pesan masuk.
                                </div>
                            @endforelse
                        </div>

                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition flex items-center justify-center gap-1.5 py-1">
                                <span>Buka Kotak Masuk Pesan Lengkap</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Web Portal Link -->
                <a href="{{ url('/') }}" target="_blank" class="px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl border border-slate-200 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i>
                    <span class="hidden sm:inline">Lihat Web</span>
                </a>
            </div>
        </header>

        <!-- Page Body -->
        <main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-8 w-full max-w-full">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-8 border-t border-slate-200/80 text-center text-xs text-slate-400 bg-white shrink-0">
            &copy; {{ date('Y') }} PERSIS PERS &bull; Sistem Manajemen Penerbitan
        </footer>
    </div>

    <!-- Dropdown & Sidebar JS with Persistent Collapse Memory -->
    <script>
        let sidebarOpen = window.innerWidth >= 1024;

        // Check stored desktop preference
        if (window.innerWidth >= 1024) {
            const savedState = localStorage.getItem('persis_admin_sidebar_collapsed');
            if (savedState === 'true') {
                collapseSidebarDesktop();
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth < 1024) {
                // Mobile behavior (Off-canvas drawer)
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
                // Desktop behavior (Collapsible Full / Hidden toggle)
                if (sidebar.classList.contains('lg:translate-x-0')) {
                    collapseSidebarDesktop();
                } else {
                    expandSidebarDesktop();
                }
            }
        }

        function collapseSidebarDesktop() {
            const sidebar = document.getElementById('admin-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.remove('lg:translate-x-0');
            sidebar.classList.add('lg:-translate-x-full');
            wrapper.classList.remove('lg:pl-64');
            wrapper.classList.add('lg:pl-0');
            localStorage.setItem('persis_admin_sidebar_collapsed', 'true');
        }

        function expandSidebarDesktop() {
            const sidebar = document.getElementById('admin-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.add('lg:translate-x-0');
            sidebar.classList.remove('lg:-translate-x-full');
            wrapper.classList.add('lg:pl-64');
            wrapper.classList.remove('lg:pl-0');
            localStorage.setItem('persis_admin_sidebar_collapsed', 'false');
        }

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notifDropdown');
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const container = document.getElementById('notifDropdownContainer');
            const dropdown = document.getElementById('notifDropdown');
            if (container && !container.contains(e.target) && dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
