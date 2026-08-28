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
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ str_replace(["IAI Persis", "IAI"], ["PERSIS PERS", "PERSIS PERS"], Auth::user()->name) }}</p>
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
                        <a href="{{ route('admin.settings.home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('admin.settings.home') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-house-chimney w-4 text-center"></i>
                            <span>Kelola Halaman Beranda</span>
                        </a>

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
        <header class="h-14 bg-white border-b border-slate-200 px-3 sm:px-6 lg:px-8 sticky top-0 z-50 flex items-center justify-between shadow-2xs">
            
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

                <!-- Enhanced Live Notification Dropdown -->
                <div class="relative" id="notifDropdownContainer">
                    <button 
                        type="button" 
                        onclick="window.toggleNotifDropdown(event)" 
                        id="adminBellBtn"
                        class="relative p-1.5 sm:p-2 text-slate-600 hover:text-slate-900 hover:bg-emerald-50 active:bg-emerald-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer select-none"
                        title="Pusat Notifikasi Masuk"
                    >
                        <i id="adminBellIcon" class="fa-regular fa-bell text-sm transition-transform duration-300"></i>
                        <span id="adminBellBadge" class="{{ ($totalNotifCount ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 min-w-[17px] h-[17px] px-1 rounded-full bg-rose-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono shadow-xs animate-pulse">
                            {{ $totalNotifCount ?? 0 }}
                        </span>
                    </button>

                    <!-- Rich Dropdown Content -->
                    <div id="notifDropdown" class="hidden absolute top-full right-0 mt-2 w-80 sm:w-96 bg-white rounded-xl shadow-2xl border border-slate-200/90 overflow-hidden z-[9999] animate-fade-in select-none" style="display: none;">
                        
                        <!-- Header -->
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                                    <i class="fa-solid fa-bell text-[11px]"></i>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider font-heading">Notifikasi Masuk</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span id="notifHeaderBadge" class="text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded-full font-mono font-bold">
                                    {{ $totalNotifCount ?? 0 }} Baru
                                </span>
                                <button type="button" onclick="markAllNotificationsRead()" class="text-[10px] text-slate-400 hover:text-white transition underline cursor-pointer" title="Tandai semua pesan sudah dibaca">
                                    Tandai Dibaca
                                </button>
                            </div>
                        </div>

                        <!-- Notification List (Messages & Orders) -->
                        <div id="notifListContainer" class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            @php
                                $hasItems = ($latestMessages && $latestMessages->count() > 0) || ($latestOrders && $latestOrders->count() > 0);
                            @endphp

                            @if($hasItems)
                                {{-- Latest Messages --}}
                                @if($latestMessages && $latestMessages->count() > 0)
                                    <div class="px-3 py-1.5 bg-slate-50/80 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                        Pesan &amp; Pengajuan Naskah
                                    </div>
                                    @foreach($latestMessages as $msg)
                                        <a 
                                            href="{{ route('admin.messages.show', $msg) }}" 
                                            class="block p-3 hover:bg-slate-50 transition {{ $msg->status === 'pending' ? 'bg-emerald-50/50' : '' }}"
                                        >
                                            <div class="flex items-start gap-2.5">
                                                <div class="w-8 h-8 rounded-full {{ $msg->status === 'pending' ? 'bg-emerald-700 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-black text-xs shrink-0 mt-0.5">
                                                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-1">
                                                        <span class="text-xs font-bold text-slate-900 truncate">{{ $msg->name }}</span>
                                                        <span class="text-[10px] text-slate-400 shrink-0 font-mono">{{ $msg->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-[11px] text-slate-600 truncate leading-snug mt-0.5 font-medium">
                                                        {{ $msg->subject ?: Str::limit($msg->message, 45) }}
                                                    </p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="text-[9.5px] px-1.5 py-0.2 rounded bg-slate-100 text-slate-600 font-medium">
                                                            {{ $msg->service_category ?? 'Konsultasi' }}
                                                        </span>
                                                        @if($msg->status === 'pending')
                                                            <span class="text-[9.5px] font-bold text-amber-600 flex items-center gap-1">
                                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span> Belum Dihubungi
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif

                                {{-- Latest Orders --}}
                                @if($latestOrders && $latestOrders->count() > 0)
                                    <div class="px-3 py-1.5 bg-slate-50/80 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-t border-slate-100">
                                        Transaksi Buku Terbaru
                                    </div>
                                    @foreach($latestOrders as $ord)
                                        <a 
                                            href="{{ route('admin.orders.show', $ord->id) }}" 
                                            class="block p-3 hover:bg-slate-50 transition"
                                        >
                                            <div class="flex items-start gap-2.5">
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-receipt text-xs"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-1">
                                                        <span class="text-xs font-bold text-slate-900 truncate">#{{ $ord->order_number }}</span>
                                                        <span class="text-[10px] text-slate-400 shrink-0 font-mono">{{ $ord->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-[11px] text-slate-600 truncate mt-0.5">
                                                        {{ $ord->customer_name }} &bull; <strong class="text-slate-900 font-mono">Rp {{ number_format($ord->total_amount, 0, ',', '.') }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            @else
                                <div class="p-8 text-center text-slate-400 text-xs">
                                    <i class="fa-regular fa-bell-slash text-3xl mb-2 text-slate-300 block"></i>
                                    Belum ada notifikasi baru saat ini.
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                            <a href="{{ route('admin.messages.index') }}" class="text-slate-700 hover:text-emerald-800 transition flex items-center gap-1">
                                <span>Pesan &amp; Naskah</span>
                                <i class="fa-solid fa-arrow-right text-[9px]"></i>
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="text-emerald-800 hover:text-emerald-950 transition flex items-center gap-1">
                                <span>Kelola Pesanan</span>
                                <i class="fa-solid fa-arrow-right text-[9px]"></i>
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
    </script>

    <!-- Live Notification Floating Toast Container -->
    <div id="adminLiveToastContainer" class="fixed top-4 right-4 z-[9999] flex flex-col gap-2.5 max-w-sm w-full pointer-events-none"></div>

    <script>
        // Notification Dropdown Toggle
        window.toggleNotifDropdown = function(e) {
            if (e) {
                try { e.preventDefault(); e.stopPropagation(); } catch(err) {}
            }
            const notifDropdown = document.getElementById('notifDropdown');
            if (!notifDropdown) return;
            const isClosed = notifDropdown.classList.contains('hidden') || notifDropdown.style.display === 'none' || (window.getComputedStyle && window.getComputedStyle(notifDropdown).display === 'none');
            if (isClosed) {
                notifDropdown.style.display = 'block';
                notifDropdown.classList.remove('hidden');
            } else {
                notifDropdown.style.display = 'none';
                notifDropdown.classList.add('hidden');
            }
        };

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const notifDropdown = document.getElementById('notifDropdown');
            const notifContainer = document.getElementById('notifDropdownContainer');
            if (notifDropdown && notifContainer && !notifContainer.contains(e.target)) {
                notifDropdown.style.display = 'none';
                notifDropdown.classList.add('hidden');
            }
        });

        // Mark All Notifications as Read
        function markAllNotificationsRead() {
            fetch("{{ route('admin.notifications.mark_all_read') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const badge = document.getElementById('adminBellBadge');
                    const headerBadge = document.getElementById('notifHeaderBadge');
                    if (badge) badge.classList.add('hidden');
                    if (headerBadge) headerBadge.innerText = '0 Baru';
                }
            })
            .catch(err => console.error(err));
        }

        // Live Real-Time Polling & Toast Popup System
        (function() {
            let lastBadgeCount = {{ $totalNotifCount ?? 0 }};

            function checkLiveNotifications() {
                fetch("{{ route('admin.notifications.live') }}", {
                    headers: { "Accept": "application/json" }
                })
                .then(res => res.json())
                .then(data => {
                    const currentBadge = data.total_badge;
                    const badgeEl = document.getElementById('adminBellBadge');
                    const headerBadgeEl = document.getElementById('notifHeaderBadge');
                    const bellIcon = document.getElementById('adminBellIcon');

                    if (badgeEl) {
                        badgeEl.innerText = currentBadge;
                        if (currentBadge > 0) {
                            badgeEl.classList.remove('hidden');
                        } else {
                            badgeEl.classList.add('hidden');
                        }
                    }

                    if (headerBadgeEl) {
                        headerBadgeEl.innerText = currentBadge + ' Baru';
                    }

                    // If new notification arrived, show real-time animated popup toast & wiggle bell
                    if (currentBadge > lastBadgeCount) {
                        const newMessages = data.messages.filter(m => m.is_pending);
                        if (newMessages.length > 0) {
                            const latest = newMessages[0];
                            showLiveToast(
                                '🔔 Pesan & Naskah Baru Masuk!',
                                `${latest.name}: "${latest.subject}"`,
                                latest.url,
                                'fa-solid fa-inbox text-emerald-400'
                            );
                        }

                        // Bell wiggle animation
                        if (bellIcon) {
                            bellIcon.classList.add('animate-bounce', 'text-amber-500');
                            setTimeout(() => {
                                bellIcon.classList.remove('animate-bounce', 'text-amber-500');
                            }, 3000);
                        }
                    }

                    lastBadgeCount = currentBadge;
                })
                .catch(err => console.error("Notif poll error:", err));
            }

            // Show Toast Alert Popup
            function showLiveToast(title, desc, linkUrl, iconClass) {
                const container = document.getElementById('adminLiveToastContainer');
                if (!container) return;

                const toast = document.createElement('div');
                toast.className = 'pointer-events-auto p-3.5 bg-slate-900 text-white rounded-xl shadow-2xl border border-slate-700 flex items-start gap-3 transform transition-all duration-300 translate-x-full opacity-0 cursor-pointer hover:border-emerald-500';
                toast.onclick = () => window.location.href = linkUrl;

                toast.innerHTML = `
                    <div class="w-8 h-8 rounded-full bg-emerald-600/30 border border-emerald-500/40 flex items-center justify-center shrink-0">
                        <i class="${iconClass} text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white flex items-center justify-between">
                            <span>${title}</span>
                            <span class="text-[9.5px] text-emerald-400 font-mono">Baru saja</span>
                        </p>
                        <p class="text-[11px] text-slate-300 truncate mt-0.5">${desc}</p>
                        <span class="inline-block mt-1 text-[10px] text-emerald-400 font-bold underline">Buka Pesan &rarr;</span>
                    </div>
                    <button type="button" onclick="event.stopPropagation(); this.parentElement.remove();" class="text-slate-400 hover:text-white text-xs">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                `;

                container.appendChild(toast);

                // Animate in
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }, 50);

                // Auto remove after 7 seconds
                setTimeout(() => {
                    toast.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => toast.remove(), 400);
                }, 7000);
            }

            // Poll every 15 seconds
            setInterval(checkLiveNotifications, 15000);
        })();
    </script>


    @stack('scripts')

    <!-- ========================================================================= -->
    <!-- FLOATING FAST MESSAGE BUTTON & SLIDE-IN SIDEBAR DRAWER (MATCHING USER STYLE) -->
    <!-- ========================================================================= -->
    
    <!-- 1. The Floating Action Button (Bottom Right) -->
    <div class="fixed bottom-6 right-6 z-40 select-none">
        <button 
            type="button" 
            onclick="openAdminMessageDrawer()"
            id="adminFloatingChatBtn"
            class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-[#006830] hover:bg-[#032c21] text-white shadow-2xl ring-4 ring-emerald-500/25 flex items-center justify-center text-xl sm:text-2xl transition-all duration-300 transform hover:scale-105 active:scale-95 cursor-pointer relative group"
            title="Daftar Kontak &amp; Live Chat Diskusi Pesanan"
        >
            <i class="fa-solid fa-comments transition-transform group-hover:scale-110"></i>
            <span id="adminFloatingChatBadge" class="{{ ($unreadOrderMessagesCount ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 min-w-[22px] h-[22px] px-1 rounded-full bg-rose-600 text-white text-[10px] font-black flex items-center justify-center font-mono shadow-md animate-pulse">
                {{ $unreadOrderMessagesCount ?? 0 }}
            </span>
        </button>
    </div>

    <!-- 2. The Full-Height Slide-in Sidebar Drawer (Contacts List <-> Live Chat Thread Inside Drawer) -->
    <div id="adminMessageDrawer" class="fixed inset-0 z-[99999] hidden items-end sm:items-stretch sm:justify-end" style="display: none;">
        <!-- Backdrop -->
        <div id="adminMessageDrawerBackdrop" onclick="closeAdminMessageDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Panel (Mobile: Bottom Sheet, Desktop: Right Sidebar) -->
        <div id="adminMessageDrawerPanel" class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl rounded-t-2xl sm:rounded-none flex flex-col max-h-[90vh] sm:max-h-full sm:h-full transform translate-y-full sm:translate-y-0 sm:translate-x-full transition-transform duration-300 ease-out border-t sm:border-t-0 sm:border-l border-slate-200">
            
            <!-- Mobile Pull Handle -->
            <div class="sm:hidden w-full pt-3 pb-1 flex justify-center cursor-pointer select-none" onclick="closeAdminMessageDrawer()">
                <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
            </div>

            <!-- ========================================================================= -->
            <!-- SCREEN 1: CONTACTS LIST VIEW -->
            <!-- ========================================================================= -->
            <div id="adminDrawerContactsScreen" class="flex flex-col h-full">
                <!-- Header -->
                <div class="px-5 py-4 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-950 select-none rounded-t-xl sm:rounded-none shrink-0">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-sm bg-white/10 p-1 flex items-center justify-center shrink-0 border border-white/15 shadow-xs">
                            <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="PERSIS PERS" class="w-full h-full object-contain" />
                        </div>
                        <div>
                            <h3 class="font-bold text-sm font-heading flex items-center gap-1.5">
                                <span>Diskusi Pesanan</span>
                                <span class="text-xs font-mono text-emerald-300 font-bold bg-emerald-500/20 px-2 py-0.5 rounded-full border border-emerald-500/30">
                                    {{ $unreadOrderMessagesCount ?? 0 }} Baru
                                </span>
                            </h3>
                            <p class="text-[10px] text-emerald-200/70">Pusat Percakapan Pembeli PERSIS PERS</p>
                        </div>
                    </div>
                    <button type="button" onclick="closeAdminMessageDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Drawer">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>

                <!-- Subheader info -->
                <div class="p-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between text-xs select-none shrink-0">
                    <span class="text-slate-600 font-bold text-[11px] uppercase tracking-wider font-heading flex items-center gap-1">
                        <i class="fa-solid fa-address-book text-emerald-700"></i> Kontak Pembeli
                    </span>
                    <span class="text-slate-400 text-[10.5px]">Pilih kontak untuk chat langsung</span>
                </div>

                                <!-- Contacts List -->
                <div class="flex-1 overflow-y-auto divide-y divide-slate-100 text-xs">
                    @if(isset($orderConversations) && $orderConversations->count() > 0)
                        @foreach($orderConversations as $conv)
                            @php
                                $latestMsg = $conv->messages->first();
                                $hasUnread = $conv->messages->where('sender_type', 'customer')->where('is_read_by_admin', false)->count() > 0;
                                $unreadCount = $conv->messages->where('sender_type', 'customer')->where('is_read_by_admin', false)->count();
                                
                                $statusBg = 'bg-slate-100 text-slate-700';
                                if ($conv->shipping_status === 'diproses') $statusBg = 'bg-indigo-50 text-indigo-700 border border-indigo-200';
                                elseif ($conv->shipping_status === 'dikirim') $statusBg = 'bg-blue-50 text-blue-700 border border-blue-200';
                                elseif ($conv->shipping_status === 'selesai') $statusBg = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                            @endphp

                            <div class="p-3.5 hover:bg-slate-50/90 transition-colors {{ $hasUnread ? 'bg-emerald-50/70 border-l-4 border-emerald-600' : '' }}">
                                <div class="flex items-start gap-3">
                                    
                                    <!-- 1. Thumbnail Cover Buku yang Dibeli -->
                                    <div class="w-12 h-16 shrink-0 bg-slate-900 rounded-2xs overflow-hidden border border-slate-200 shadow-2xs relative">
                                        @if(!empty($conv->first_book_cover_url))
                                            <img src="{{ $conv->first_book_cover_url }}" alt="{{ $conv->first_book_title }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full bg-[#032c21] p-1 flex flex-col justify-between text-white border-l border-emerald-400">
                                                <span class="text-[4px] font-mono text-emerald-300">PERSIS</span>
                                                <span class="text-[5.5px] font-bold line-clamp-2 leading-none">{{ $conv->first_book_title ?? 'Buku' }}</span>
                                            </div>
                                        @endif
                                        @if($conv->total_items_count > 1)
                                            <span class="absolute bottom-0 right-0 bg-slate-950/90 text-white text-[8px] font-bold px-1 rounded-tl-xs font-mono">
                                                +{{ $conv->total_items_count - 1 }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- 2. Info Detail & Cuplikan Pesan -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-1">
                                            <h5 class="text-xs font-bold text-slate-900 truncate flex items-center gap-1.5">
                                                <span>{{ $conv->customer_name }}</span>
                                                @if($hasUnread)
                                                    <span class="w-2 h-2 rounded-full bg-rose-600 animate-ping"></span>
                                                @endif
                                            </h5>
                                            <span class="text-[10px] text-slate-400 font-mono shrink-0">
                                                {{ $latestMsg ? $latestMsg->created_at->diffForHumans() : $conv->created_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        <!-- Judul Buku yang Dibeli -->
                                        <p class="text-[11px] font-semibold text-slate-700 line-clamp-1 mt-0.5" title="{{ $conv->first_book_title }}">
                                            <i class="fa-solid fa-book text-emerald-700 text-[10px] mr-0.5"></i> {{ $conv->first_book_title }}
                                            <span class="text-slate-400 font-normal">({{ $conv->first_book_qty ?? 1 }} eks)</span>
                                        </p>

                                        <!-- Tags Metadata Pesanan -->
                                        <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                            <span class="font-mono text-[9.5px] font-bold text-emerald-800 bg-emerald-100/80 px-1.5 py-0.5 rounded-xs">
                                                #{{ $conv->order_number }}
                                            </span>
                                            <span class="text-[9px] px-1.5 py-0.5 rounded-xs font-bold uppercase {{ $statusBg }}">
                                                {{ str_replace('_', ' ', $conv->shipping_status) }}
                                            </span>
                                            <span class="text-[10px] text-slate-500 font-mono">
                                                {{ $conv->formatted_payment }}
                                            </span>
                                        </div>

                                        <!-- Preview Pesan Terakhir -->
                                        @if($latestMsg)
                                            <p class="text-[11px] text-slate-600 line-clamp-1 mt-1.5 bg-white p-1.5 rounded-xs border border-slate-200">
                                                <strong class="{{ $latestMsg->sender_type === 'admin' ? 'text-emerald-700' : 'text-slate-900' }}">
                                                    {{ $latestMsg->sender_type === 'admin' ? 'Saya: ' : 'Pembeli: ' }}
                                                </strong>
                                                {{ $latestMsg->message }}
                                            </p>
                                        @endif

                                        <!-- 3. Tombol Sederhana & Jelas -->
                                        <div class="flex items-center gap-2 mt-2.5 pt-1.5 border-t border-slate-100">
                                            <!-- Tombol Buka Chat (Langsung di Drawer) -->
                                            <button type="button" 
                                                    onclick="openAdminChatThread('{{ $conv->id }}')" 
                                                    class="flex-1 py-1.5 px-3 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                                <i class="fa-solid fa-comments text-xs text-lime-300"></i>
                                                <span>Buka Chat</span>
                                                @if($unreadCount > 0)
                                                    <span class="px-1.5 py-0.2 rounded-full bg-rose-600 text-white text-[9px] font-mono font-bold">{{ $unreadCount }}</span>
                                                @endif
                                            </button>

                                            <!-- Tombol WhatsApp Cepat -->
                                            @if(!empty($conv->customer_phone))
                                                @php
                                                    $cleanPhone = preg_replace('/[^0-9]/', '', $conv->customer_phone);
                                                    if (str_starts_with($cleanPhone, '0')) {
                                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                                    }
                                                    $waText = urlencode("Halo {$conv->customer_name}, kami dari Tim Redaksi PERSIS PERS terkait pesanan buku Anda #{$conv->order_number}.");
                                                @endphp
                                                <a href="https://wa.me/{{ $cleanPhone }}?text={{ $waText }}" target="_blank" class="py-1.5 px-3 bg-[#25D366] hover:bg-[#1EBE5D] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-1 shadow-2xs" title="Chat WhatsApp Pembeli">
                                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                                    <span>WA</span>
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="py-16 text-center text-slate-400 text-xs space-y-2 select-none">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xl mx-auto shadow-2xs">
                                <i class="fa-regular fa-comments"></i>
                            </div>
                            <p class="font-bold text-slate-700 text-sm">Belum Ada Percakapan Pesanan</p>
                            <p class="text-[11px] text-slate-500 max-w-xs mx-auto">Saat pembeli berdiskusi mengenai pesanannya, kontak pembeli akan otomatis muncul di sini.</p>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="p-3 bg-slate-50 border-t border-slate-200 text-center text-xs text-slate-500 shrink-0">
                    <a href="{{ route('admin.orders.index') }}" class="font-bold text-emerald-800 hover:text-emerald-950 transition flex items-center justify-center gap-1">
                        <span>Lihat Semua Daftar Pesanan Buku</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- ========================================================================= -->
            <!-- SCREEN 2: ACTIVE CHAT ROOM THREAD INSIDE DRAWER -->
            <!-- ========================================================================= -->
            <div id="adminDrawerChatScreen" class="hidden flex-col h-full" style="display: none;">
                <!-- Header with Back Button -->
                <div class="px-4 py-3 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-950 select-none rounded-t-xl sm:rounded-none shrink-0">
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="backToAdminContactsList()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Kembali ke Kontak">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                        </button>
                        <div>
                            <h4 id="adminChatCustomerName" class="font-bold text-xs sm:text-sm font-heading flex items-center gap-1.5 truncate">
                                Pembeli
                            </h4>
                            <p id="adminChatOrderBadge" class="text-[10.5px] font-mono text-lime-300">#INV-...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <a id="adminChatDirectWaBtn" href="#" target="_blank" class="w-7 h-7 rounded-sm bg-[#25D366] text-white hover:bg-[#1EBE5D] flex items-center justify-center transition shadow-2xs" title="Chat WhatsApp Pembeli">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                        <button type="button" onclick="closeAdminMessageDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Chat Stream Area -->
                <div id="adminDrawerChatStream" class="flex-1 overflow-y-auto p-4 bg-slate-50/70 space-y-3 min-h-[260px]">
                    <div class="py-12 text-center text-slate-400 text-xs">
                        <i class="fa-solid fa-spinner fa-spin text-xl text-emerald-600 mb-2 block"></i>
                        <span>Memuat percakapan...</span>
                    </div>
                </div>

                <!-- Quick Reply Template Chips -->
                <div class="px-3.5 py-2 bg-slate-100/90 border-t border-slate-200 flex items-center gap-1.5 overflow-x-auto no-scrollbar text-[11px] shrink-0">
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider shrink-0">Balasan:</span>
                    <button type="button" onclick="setAdminDrawerReply('Halo kak, terima kasih atas pesanannya. Buku sedang disiapkan dan segera kami packing ya!')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                        📦 Sedang Dipacking
                    </button>
                    <button type="button" onclick="setAdminDrawerReply('Halo kak, paket pesanan buku Anda telah kami serahkan ke kurir ekspedisi. Nomor resi pengiriman sudah tersedia ya kak. Terima kasih!')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                        🚚 Paket Dikirim
                    </button>
                    <button type="button" onclick="setAdminDrawerReply('Halo kak, apakah ada hal lain terkait naskah atau pesanan buku yang dapat kami bantu?')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                        ❓ Info Naskah
                    </button>
                </div>

                <!-- Message Input Footer -->
                <form id="adminDrawerChatForm" onsubmit="submitAdminDrawerMessage(event)" class="p-3 sm:p-4 bg-white border-t border-slate-200 shrink-0 space-y-2">
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            id="adminDrawerMessageInput" 
                            placeholder="Ketik balasan untuk pembeli..." 
                            class="flex-1 px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none transition" 
                            required 
                            autocomplete="off"
                        />
                        <button 
                            type="submit" 
                            id="btnSendAdminDrawerMsg"
                            class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer shrink-0"
                        >
                            <i class="fa-solid fa-paper-plane text-xs text-lime-300"></i>
                            <span class="hidden sm:inline">Kirim</span>
                        </button>
                    </div>

                    <!-- Share Status Checkbox -->
                    <div class="flex items-center justify-between text-[11px] pt-1">
                        <label class="flex items-center gap-1.5 text-slate-600 cursor-pointer">
                            <input type="checkbox" id="chkAdminDrawerShareStatus" onchange="toggleAdminDrawerShareInputs(this)" class="rounded-xs text-emerald-600">
                            <span class="font-semibold">Update Status Pengiriman</span>
                        </label>
                        <a id="adminChatViewFullOrderBtn" href="#" class="text-emerald-700 hover:text-emerald-900 font-bold">
                            Buka Detail Pesanan &rarr;
                        </a>
                    </div>

                    <div id="adminDrawerShareInputsContainer" class="hidden grid grid-cols-2 gap-2 pt-1 border-t border-slate-200">
                        <select id="adminDrawerShareStatusSelect" class="px-2 py-1 bg-white border border-slate-300 rounded-xs text-[11px] text-slate-800">
                            <option value="">-- Status --</option>
                            <option value="diproses">Sedang Dipacking</option>
                            <option value="dikirim">Sudah Dikirim</option>
                        </select>
                        <input type="text" id="adminDrawerShareResiInput" placeholder="No. Resi (JNE/...)" class="px-2 py-1 bg-white border border-slate-300 rounded-xs text-[11px] font-mono uppercase" />
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        let currentAdminActiveOrderId = null;
        let adminChatPollInterval = null;

        function openAdminMessageDrawer() {
            const drawer = document.getElementById('adminMessageDrawer');
            const backdrop = document.getElementById('adminMessageDrawerBackdrop');
            const panel = document.getElementById('adminMessageDrawerPanel');

            if (drawer && backdrop && panel) {
                drawer.style.display = 'flex';
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-y-full', 'sm:translate-x-full');
                    panel.classList.add('translate-y-0', 'sm:translate-x-0');
                }, 10);
            }
        }

        function closeAdminMessageDrawer() {
            if (adminChatPollInterval) clearInterval(adminChatPollInterval);
            currentAdminActiveOrderId = null;

            const drawer = document.getElementById('adminMessageDrawer');
            const backdrop = document.getElementById('adminMessageDrawerBackdrop');
            const panel = document.getElementById('adminMessageDrawerPanel');

            if (drawer && backdrop && panel) {
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-y-full', 'sm:translate-x-full');
                panel.classList.remove('translate-y-0', 'sm:translate-x-0');
                setTimeout(() => {
                    drawer.style.display = 'none';
                    drawer.classList.add('hidden');
                    backToAdminContactsList();
                }, 300);
            }
        }

        // Switch to Active Chat Screen
        function openAdminChatThread(orderId) {
            currentAdminActiveOrderId = orderId;

            const contactsScreen = document.getElementById('adminDrawerContactsScreen');
            const chatScreen = document.getElementById('adminDrawerChatScreen');

            if (contactsScreen && chatScreen) {
                contactsScreen.style.display = 'none';
                contactsScreen.classList.add('hidden');
                chatScreen.style.display = 'flex';
                chatScreen.classList.remove('hidden');
            }

            fetchAdminOrderChat(orderId, true);
            if (adminChatPollInterval) clearInterval(adminChatPollInterval);
            adminChatPollInterval = setInterval(() => {
                if (currentAdminActiveOrderId) {
                    fetchAdminOrderChat(currentAdminActiveOrderId, false);
                }
            }, 3500);
        }

        // Back to Contacts List
        function backToAdminContactsList() {
            if (adminChatPollInterval) clearInterval(adminChatPollInterval);
            currentAdminActiveOrderId = null;

            const contactsScreen = document.getElementById('adminDrawerContactsScreen');
            const chatScreen = document.getElementById('adminDrawerChatScreen');

            if (contactsScreen && chatScreen) {
                chatScreen.style.display = 'none';
                chatScreen.classList.add('hidden');
                contactsScreen.style.display = 'flex';
                contactsScreen.classList.remove('hidden');
            }
        }

        function setAdminDrawerReply(text) {
            const input = document.getElementById('adminDrawerMessageInput');
            if (input) {
                input.value = text;
                input.focus();
            }
        }

        function toggleAdminDrawerShareInputs(chk) {
            const container = document.getElementById('adminDrawerShareInputsContainer');
            if (container) {
                if (chk.checked) container.classList.remove('hidden');
                else container.classList.add('hidden');
            }
        }

        // Fetch Order Messages for Admin
        function fetchAdminOrderChat(orderId, showLoading = false) {
            const stream = document.getElementById('adminDrawerChatStream');
            if (!stream) return;

            fetch(`/admin/orders/${orderId}/messages-api`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.success) {
                        renderAdminChatThread(data.order, data.messages);
                    }
                })
                .catch(err => console.error('Admin chat fetch error:', err));
        }

        // Render Chat in Drawer
        function renderAdminChatThread(order, messages) {
            const stream = document.getElementById('adminDrawerChatStream');
            if (!stream) return;

            document.getElementById('adminChatCustomerName').textContent = order.customer_name;
            document.getElementById('adminChatOrderBadge').textContent = '#' + order.order_number;
            document.getElementById('adminChatViewFullOrderBtn').href = `/admin/orders/${order.id}`;

            // WhatsApp link
            if (order.customer_phone) {
                let cleanPhone = order.customer_phone.replace(/[^0-9]/g, '');
                if (cleanPhone.startsWith('0')) cleanPhone = '62' + cleanPhone.substring(1);
                const waMsg = encodeURIComponent(`Halo ${order.customer_name}, kami dari Tim Redaksi PERSIS PERS terkait pesanan #${order.order_number}.`);
                document.getElementById('adminChatDirectWaBtn').href = `https://wa.me/${cleanPhone}?text=${waMsg}`;
            }

            let html = '';

            // 1. Order snapshot card
            if (order.items && order.items.length > 0) {
                html += `
                    <div class="p-3 bg-white border border-slate-200 rounded-sm shadow-2xs space-y-2 select-none mb-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider font-heading flex items-center gap-1">
                                <i class="fa-solid fa-bag-shopping text-emerald-700 text-xs"></i> Buku Pesanan
                            </span>
                            <span class="text-[10px] font-bold font-mono text-emerald-800">${order.formatted_payment || ''}</span>
                        </div>
                        <div class="space-y-2">
                `;
                order.items.forEach(it => {
                    html += `
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-11 shrink-0 bg-slate-900 rounded-2xs overflow-hidden border border-slate-200 shadow-2xs">
                                ${it.cover_url ? `<img src="${it.cover_url}" alt="${it.title}" class="w-full h-full object-cover" />` : `
                                    <div class="w-full h-full bg-[#032c21] p-0.5 flex flex-col justify-between text-white border-l border-emerald-400">
                                        <span class="text-[3.5px] font-mono text-emerald-300">PERSIS</span>
                                        <span class="text-[4.5px] font-bold line-clamp-2 leading-none">${it.title}</span>
                                    </div>
                                `}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h6 class="text-xs font-bold text-slate-900 line-clamp-1 leading-snug">${it.title}</h6>
                                <p class="text-[10px] text-slate-500 truncate mt-0.5">${it.author} &bull; <strong class="font-mono text-slate-700">${it.quantity} eks</strong></p>
                            </div>
                        </div>
                    `;
                });
                html += `
                        </div>
                        <div class="pt-1.5 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-500">
                            <span>Status: <strong class="text-emerald-800 capitalize">${(order.shipping_status || 'Diproses').replace('_', ' ')}</strong></span>
                            ${order.tracking_number ? `<span class="font-mono font-bold text-slate-700">Resi: ${order.tracking_number}</span>` : ''}
                        </div>
                    </div>

                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-2 text-[9.5px] font-bold uppercase tracking-wider text-slate-400 font-mono">Percakapan Pesanan</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>
                `;
            }

            if (!messages || messages.length === 0) {
                html += `
                    <div class="py-8 text-center text-slate-400 text-xs space-y-1 select-none">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base mx-auto mb-1.5 shadow-2xs">
                            <i class="fa-regular fa-comments"></i>
                        </div>
                        <p class="font-bold text-slate-700 text-xs">Belum Ada Percakapan</p>
                        <p class="text-[10.5px] text-slate-500 max-w-xs mx-auto">Kirim pesan pertama kepada pembeli untuk mengabarkan status pesanan.</p>
                    </div>
                `;
                stream.innerHTML = html;
                return;
            }

            messages.forEach(msg => {
                if (msg.is_admin) {
                    // Admin Bubble (Right)
                    html += `
                        <div class="flex flex-col items-end select-none">
                            <div class="max-w-[88%] sm:max-w-md bg-[#006830] text-white p-3 rounded-sm rounded-tr-none shadow-2xs space-y-1">
                                <div class="flex items-center justify-between gap-3 text-[10px] text-emerald-200/80 pb-1 border-b border-emerald-700">
                                    <span class="font-bold"><i class="fa-solid fa-shield-halved text-[9px] text-lime-300"></i> ${msg.sender_name || 'Saya (Admin)'}</span>
                                    <span class="font-mono">${msg.created_at_formatted}</span>
                                </div>
                                <p class="text-xs leading-relaxed whitespace-pre-line">${msg.message}</p>
                                ${msg.shared_shipping_status ? `
                                    <div class="mt-1.5 p-2 bg-emerald-950/60 rounded-xs border border-emerald-600/40 text-[11px] text-emerald-100">
                                        <i class="fa-solid fa-truck-fast text-lime-300 mr-1"></i> Update: <strong class="capitalize">${msg.shared_shipping_status.replace('_', ' ')}</strong>
                                        ${msg.shared_tracking_number ? `&bull; Resi: <strong class="font-mono text-lime-300">${msg.shared_tracking_number}</strong>` : ''}
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                } else {
                    // Customer Bubble (Left)
                    html += `
                        <div class="flex flex-col items-start select-none">
                            <div class="max-w-[88%] sm:max-w-md bg-white border border-slate-200 text-slate-800 p-3 rounded-sm rounded-tl-none shadow-2xs space-y-1">
                                <div class="flex items-center justify-between gap-3 text-[10px] text-slate-400 pb-1 border-b border-slate-100">
                                    <span class="font-bold text-slate-800"><i class="fa-solid fa-user text-[9px] text-slate-500"></i> ${msg.sender_name || order.customer_name}</span>
                                    <span class="font-mono">${msg.created_at_formatted}</span>
                                </div>
                                <p class="text-xs text-slate-900 leading-relaxed whitespace-pre-line">${msg.message}</p>
                            </div>
                        </div>
                    `;
                }
            });

            stream.innerHTML = html;
            stream.scrollTop = stream.scrollHeight;
        }

        // Submit Admin Reply from Drawer
        function submitAdminDrawerMessage(e) {
            e.preventDefault();
            if (!currentAdminActiveOrderId) return;

            const input = document.getElementById('adminDrawerMessageInput');
            const msgText = input.value.trim();
            if (!msgText) return;

            const chkShare = document.getElementById('chkAdminDrawerShareStatus');
            const statusSelect = document.getElementById('adminDrawerShareStatusSelect');
            const resiInput = document.getElementById('adminDrawerShareResiInput');

            const payload = {
                message: msgText,
                share_shipping_status: (chkShare && chkShare.checked) ? statusSelect.value : null,
                share_tracking_number: (chkShare && chkShare.checked) ? resiInput.value.trim() : null,
            };

            const btn = document.getElementById('btnSendAdminDrawerMsg');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i>';

            fetch(`/admin/orders/${currentAdminActiveOrderId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                if (data && data.success) {
                    input.value = '';
                    if (chkShare) chkShare.checked = false;
                    toggleAdminDrawerShareInputs(chkShare);
                    fetchAdminOrderChat(currentAdminActiveOrderId, false);
                } else {
                    alert(data.message || 'Gagal mengirim balasan.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                console.error('Send reply error:', err);
                alert('Gagal mengirim balasan.');
            });
        }
    </script>
</body>