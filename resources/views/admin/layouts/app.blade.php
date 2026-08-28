<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel | PERSIS PERS')</title>

    <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    <!-- Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Pro Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#064e3b',
                            950: '#032c21',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; background-color: #f1f5f9; -webkit-tap-highlight-color: transparent; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .brand-dark { background-color: #032c21; }
        [x-cloak] { display: none !important; }

        /* Smooth Sidebar Collapse Transition */
        #admin-sidebar {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        #main-content-wrapper {
            transition: padding-left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) both; }
    </style>
</head>
<body class="min-h-screen antialiased text-slate-800 bg-slate-100 flex flex-col selection:bg-emerald-600 selection:text-white">

    @php
        $latestMessages = \App\Models\ContactMessage::latest()->take(6)->get();
        $unreadMessagesCount = \App\Models\ContactMessage::where('status', 'pending')->count();
        $pendingOrdersCount = \App\Models\Order::where('payment_status', 'completed')->where('shipping_status', 'menunggu_proses')->count();
    @endphp

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden transition-opacity"></div>

    <!-- Sidebar (Collapsible w-64) -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 brand-dark text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-2xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        <div class="p-5">
            <!-- Brand Header -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-between lg:justify-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-11 w-auto object-contain" />
                </a>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-sm hover:bg-white/10 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- User Admin Profile Box -->
            <div class="p-3 bg-white/5 border border-white/10 rounded-sm mb-5 flex items-center gap-3">
                @if(Auth::user()->avatar_url)
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-9 h-9 rounded-sm object-cover shrink-0 ring-1 ring-emerald-400/40" />
                @else
                    <div class="w-9 h-9 rounded-sm bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-xs shrink-0 shadow-xs ring-1 ring-emerald-500/30">
                        {{ Auth::user()->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-emerald-300/80 uppercase font-mono tracking-wider">Superadmin</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-5 text-xs">
                
                <!-- Section 1: Overview -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Overview</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.messages.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-inbox w-4 text-center"></i>
                                <span>Pesan &amp; Naskah</span>
                            </div>
                            @if($unreadMessagesCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500 text-slate-950 font-mono">{{ $unreadMessagesCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-user-shield w-4 text-center"></i>
                            <span>Manajemen Pengguna</span>
                        </a>
                    </div>
                </div>

                <!-- Section 2: Penjualan & Penerbitan -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Transaksi &amp; Katalog</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-receipt w-4 text-center"></i>
                                <span>Pesanan Buku</span>
                            </div>
                            @if($pendingOrdersCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-[#032c21] font-mono">{{ $pendingOrdersCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.books.*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-book-bookmark w-4 text-center"></i>
                            <span>Katalog Buku &amp; ISBN</span>
                        </a>
                    </div>
                </div>

                <!-- Section 3: Pengaturan Web -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Pengaturan Web</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.settings.catalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.settings.catalog') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-sliders w-4 text-center"></i>
                            <span>Kelola Halaman Katalog</span>
                        </a>

                        <a href="{{ route('admin.settings.about') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.settings.about') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-circle-info w-4 text-center"></i>
                            <span>Kelola Tentang Kami</span>
                        </a>

                        <a href="{{ route('admin.settings.contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.settings.contact') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-address-book w-4 text-center"></i>
                            <span>Kelola Kontak &amp; Web</span>
                        </a>
                    </div>
                </div>

            </nav>
        </div>

        <!-- Logout Section in Sidebar -->
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-sm font-bold text-xs text-rose-300 hover:bg-rose-900/40 hover:text-rose-100 transition border border-rose-500/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div id="main-content-wrapper" class="flex-1 flex flex-col min-w-0 min-h-screen lg:pl-64">
        
        <!-- Top Navigation Header -->
        <header class="h-14 bg-white border-b border-slate-200 px-3 sm:px-6 lg:px-8 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            
            <!-- Left: Toggle Sidebar & Clean Title -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                <button 
                    id="sidebarToggleBtn"
                    type="button" 
                    onclick="toggleSidebar()" 
                    class="p-1.5 sm:p-2 rounded-sm bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 transition border border-slate-200 flex items-center justify-center cursor-pointer" 
                    title="Buka / Tutup Sidebar Navigasi"
                >
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                </button>
                
                <!-- Clean Title / Breadcrumb (No Redundant Emblem on mobile) -->
                <div class="flex items-center gap-1.5 text-xs">
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-emerald-700 transition hidden sm:inline">Admin</a>
                    <i class="fa-solid fa-chevron-right text-[8px] text-slate-300 hidden sm:inline"></i>
                    <span class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">@yield('header_title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Right Actions: Web Preview (Desktop only), Notif & User Avatar -->
            <div class="flex items-center gap-2 sm:gap-3">
                
                <!-- Web Portal Link (Hidden on mobile to eliminate clutter) -->
                <a href="{{ url('/') }}" target="_blank" class="hidden sm:flex px-3 py-1.5 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/50 rounded-sm border border-slate-200 transition items-center gap-1.5 shadow-2xs">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                    <span>Lihat Web</span>
                </a>

                <!-- Notification Dropdown -->
                <div class="relative" id="notifDropdownContainer">
                    <button 
                        type="button" 
                        onclick="toggleNotifDropdown()" 
                        class="relative p-1.5 sm:p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer"
                        title="Notifikasi Masuk"
                    >
                        <i class="fa-regular fa-bell text-sm"></i>
                        @if($unreadMessagesCount > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono animate-pulse">
                                {{ $unreadMessagesCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Content -->
                    <div id="notifDropdown" class="hidden absolute right-0 mt-2 w-72 sm:w-96 bg-white rounded-sm shadow-2xl border border-slate-200 overflow-hidden z-50 animate-fade-in">
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-emerald-400 text-xs"></i>
                                <span class="text-xs font-bold uppercase tracking-wider font-heading">Notifikasi Masuk</span>
                            </div>
                            <span class="text-[10px] bg-slate-800 text-emerald-300 px-2 py-0.5 rounded-xs font-mono font-bold">
                                {{ $unreadMessagesCount }} Baru
                            </span>
                        </div>

                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            @forelse($latestMessages as $msg)
                                <a 
                                    href="{{ route('admin.messages.show', $msg) }}" 
                                    class="block p-3 hover:bg-slate-50 transition {{ $msg->status === 'pending' ? 'bg-emerald-50/40' : '' }}"
                                >
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-7 h-7 rounded-sm {{ $msg->status === 'pending' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-1">
                                                <span class="text-xs font-bold text-slate-900 truncate">{{ $msg->name }}</span>
                                                <span class="text-[10px] text-slate-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-[11px] text-slate-500 truncate leading-snug mt-0.5">
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
                                <span>Buka Kotak Masuk Lengkap</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Profile Pill -->
                <div class="flex items-center gap-1.5 sm:gap-2 pl-1 sm:pl-1.5 pr-2 sm:pr-2.5 py-1 rounded-sm bg-slate-100 border border-slate-200">
                    @if(Auth::user()->avatar_url)
                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-6 h-6 rounded-sm object-cover" />
                    @else
                        <div class="w-6 h-6 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-[10px] font-black">
                            {{ Auth::user()->initials }}
                        </div>
                    @endif
                    <span class="text-xs font-bold text-slate-700 max-w-[90px] truncate hidden sm:inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                </div>

            </div>
        </header>

        <!-- Main Content Canvas (Consistent with Member Layout) -->
        <main class="flex-1 p-3.5 sm:p-6 lg:p-8 pb-24 lg:pb-8 animate-fade-in max-w-7xl w-full mx-auto space-y-4 sm:space-y-5">
            @yield('content')
        </main>

        <!-- Footer Desktop -->
        <footer class="hidden lg:block bg-white border-t border-slate-200 py-3 px-4 sm:px-8 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} PERSIS PERS • Sistem Manajemen Penerbitan & Percetakan • PENERBIT PERSIS
        </footer>
    </div>

    <!-- ==================== MOBILE APP BOTTOM NAVIGATION BAR ==================== -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-2 py-1.5 flex items-center justify-around select-none">
        
        <!-- 1. Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xs transition {{ request()->routeIs('admin.dashboard') ? 'text-emerald-800 font-extrabold' : 'text-slate-500 hover:text-slate-800' }}">
            <div class="w-6 h-6 flex items-center justify-center text-base {{ request()->routeIs('admin.dashboard') ? 'text-emerald-700 scale-110' : '' }}">
                <i class="fa-solid fa-gauge-high"></i>
            </div>
            <span class="text-[10px] tracking-tight">Dashboard</span>
        </a>

        <!-- 2. Orders -->
        <a href="{{ route('admin.orders.index') }}" class="relative flex flex-col items-center gap-0.5 px-2 py-1 rounded-xs transition {{ request()->routeIs('admin.orders.*') ? 'text-emerald-800 font-extrabold' : 'text-slate-500 hover:text-slate-800' }}">
            <div class="w-6 h-6 flex items-center justify-center text-base {{ request()->routeIs('admin.orders.*') ? 'text-emerald-700 scale-110' : '' }}">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <span class="text-[10px] tracking-tight">Pesanan</span>
            @if($pendingOrdersCount > 0)
                <span class="absolute top-0.5 right-2 w-4 h-4 bg-emerald-600 text-white rounded-full text-[8.5px] font-bold flex items-center justify-center font-mono animate-pulse">
                    {{ $pendingOrdersCount }}
                </span>
            @endif
        </a>

        <!-- 3. Books -->
        <a href="{{ route('admin.books.index') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xs transition {{ request()->routeIs('admin.books.*') ? 'text-emerald-800 font-extrabold' : 'text-slate-500 hover:text-slate-800' }}">
            <div class="w-6 h-6 flex items-center justify-center text-base {{ request()->routeIs('admin.books.*') ? 'text-emerald-700 scale-110' : '' }}">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <span class="text-[10px] tracking-tight">Katalog</span>
        </a>

        <!-- 4. Messages / Naskah -->
        <a href="{{ route('admin.messages.index') }}" class="relative flex flex-col items-center gap-0.5 px-2 py-1 rounded-xs transition {{ request()->routeIs('admin.messages.*') ? 'text-emerald-800 font-extrabold' : 'text-slate-500 hover:text-slate-800' }}">
            <div class="w-6 h-6 flex items-center justify-center text-base {{ request()->routeIs('admin.messages.*') ? 'text-emerald-700 scale-110' : '' }}">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <span class="text-[10px] tracking-tight">Pesan</span>
            @if($unreadMessagesCount > 0)
                <span class="absolute top-0.5 right-2 w-4 h-4 bg-amber-500 text-slate-950 rounded-full text-[8.5px] font-bold flex items-center justify-center font-mono">
                    {{ $unreadMessagesCount }}
                </span>
            @endif
        </a>

        <!-- 5. Users -->
        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center gap-0.5 px-2 py-1 rounded-xs transition {{ request()->routeIs('admin.users.*') ? 'text-emerald-800 font-extrabold' : 'text-slate-500 hover:text-slate-800' }}">
            <div class="w-6 h-6 flex items-center justify-center text-base {{ request()->routeIs('admin.users.*') ? 'text-emerald-700 scale-110' : '' }}">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <span class="text-[10px] tracking-tight">Pengguna</span>
        </a>

    </nav>

    <!-- Dropdown & Sidebar JS with Persistent Collapse Memory -->
    <script>
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
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
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
            const notifDropdown = document.getElementById('notifDropdown');
            if (notifDropdown) {
                notifDropdown.classList.toggle('hidden');
            }
        }

        document.addEventListener('click', function(e) {
            const notifDropdown = document.getElementById('notifDropdown');
            const notifContainer = document.getElementById('notifDropdownContainer');
            if (notifDropdown && notifContainer && !notifContainer.contains(e.target)) {
                notifDropdown.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
