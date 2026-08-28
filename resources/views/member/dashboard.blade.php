<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dashboard Anggota | PENERBIT PERSIS</title>
    <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CDN -->
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
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; -webkit-tap-highlight-color: transparent; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .brand-dark { background-color: #032c21; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) both; }

        /* Signature 3D Realistic Book Cover */
        .book-stage-3d { perspective: 600px; }
        .book-cover-3d {
            transform-style: preserve-3d;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            box-shadow: 2px 4px 10px -2px rgba(0, 0, 0, 0.25), 0 1px 2px rgba(0,0,0,0.1);
        }
        .book-spine-strip {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 4px;
            background: linear-gradient(90deg, rgba(255,255,255,0.35) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.4) 100%);
            border-right: 1px solid rgba(0,0,0,0.15);
            z-index: 10;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased bg-slate-100 flex flex-col lg:flex-row">

    <!-- Backdrop Overlay for Mobile Sidebar -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity duration-300"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside id="member-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 brand-dark text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-2xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        
        <div class="p-5">
            <!-- Brand Header (Clean Full Logo) -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-between lg:justify-center">
                <a href="{{ route('member.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-11 w-auto object-contain" />
                </a>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-sm hover:bg-white/10 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- User Profile Box -->
            <div class="p-3 bg-white/5 border border-white/10 rounded-sm mb-5 flex items-center gap-3">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-sm object-cover shrink-0 ring-1 ring-emerald-400/40" />
                @else
                    <div class="w-9 h-9 rounded-sm bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-xs shrink-0 shadow-xs ring-1 ring-emerald-500/30">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ $user->name }}</p>
                    <p class="text-[10.5px] text-emerald-300/80 truncate mt-0.5">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-5 text-xs">
                
                <!-- Section 1: Layanan Utama -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Menu Utama</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.dashboard') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('member.orders') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.orders*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-receipt w-4 text-center"></i>
                                <span>Pesanan Saya</span>
                            </div>
                            @php
                                $userOrdCount = \App\Models\Order::where('user_id', Auth::id())->orWhere('customer_email', Auth::user()->email)->count();
                            @endphp
                            @if($userOrdCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-[#032c21] font-mono">{{ $userOrdCount }}</span>
                            @endif
                        </a>

                        <a href="{{ route('katalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-book-open w-4 text-center"></i>
                            <span>Katalog Buku</span>
                        </a>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Akun & Kontak -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Akun &amp; Bantuan</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.profile') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-user-gear w-4 text-center"></i>
                            <span>Profil Saya</span>
                        </a>

                        <a href="javascript:void(0)" onclick="openAdminContactDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-headset w-4 text-center"></i>
                            <span>Hubungi Redaksi</span>
                        </a>

                        <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2 rounded-sm font-medium transition hover:bg-white/10 hover:text-white text-slate-400">
                            <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center text-slate-500"></i>
                            <span>Halaman Utama Web</span>
                        </a>
                    </div>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-sm text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition border border-red-500/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div id="main-content-wrapper" class="flex-1 flex flex-col min-w-0 min-h-screen transition-all duration-300 lg:pl-64">

        <!-- Top Header Bar -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-2.5 sm:py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            
            <!-- Left Header: Toggle & Branding -->
            <div class="flex items-center gap-3">
                <!-- Desktop Sidebar Toggle Button (Hidden on Mobile) -->
                <button type="button" onclick="toggleSidebar()" class="hidden lg:flex p-2 text-slate-600 hover:text-emerald-800 hover:bg-slate-100 rounded-sm border border-slate-200 transition items-center justify-center cursor-pointer" title="Buka / Tutup Menu Sidebar">
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                </button>

                <!-- Mobile Official Logo Brand -->
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2 lg:hidden transition hover:opacity-90">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="Logo" class="w-7 h-7 object-contain" />
                    <div>
                        <span class="font-black text-xs text-slate-900 tracking-tight block font-heading leading-none">PENERBIT PERSIS</span>
                        <span class="text-[9.5px] text-emerald-700 font-bold block leading-none mt-0.5">Portal Member</span>
                    </div>
                </a>

                <!-- Desktop Breadcrumb Title -->
                <div class="hidden lg:flex items-center gap-2 text-xs">
                    <span class="text-slate-400 font-medium">Portal Member</span>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                    <span class="font-bold text-slate-800">Dashboard Utama</span>
                </div>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ url('/') }}" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/50 transition">
                    <i class="fa-solid fa-house text-[10px] text-emerald-700"></i>
                    <span>Website Utama</span>
                </a>

                <a href="{{ route('katalog') }}" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition shadow-2xs">
                    <i class="fa-solid fa-book-open text-[10px]"></i>
                    <span>Katalog</span>
                </a>

                <!-- Member Notification Bell Dropdown -->
                <div class="relative" id="memberNotifContainer">
                    <button 
                        type="button" 
                        onclick="toggleMemberNotifDropdown(event)" 
                        id="memberBellBtn"
                        class="relative p-1.5 sm:p-2 text-slate-600 hover:text-emerald-800 hover:bg-emerald-50 active:bg-emerald-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer select-none"
                        title="Notifikasi Pesanan"
                    >
                        <i id="memberBellIcon" class="fa-regular fa-bell text-sm transition-transform duration-300"></i>
                        <span id="memberBellBadge" class="{{ ($memberActiveNotifCount ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 min-w-[17px] h-[17px] px-1 rounded-full bg-emerald-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono shadow-xs animate-pulse">
                            {{ $memberActiveNotifCount ?? 0 }}
                        </span>
                    </button>

                    <!-- Dropdown Content -->
                    <div id="memberNotifDropdown" class="hidden absolute top-full right-0 mt-2 w-80 sm:w-96 bg-white rounded-xl shadow-2xl border border-slate-200/90 overflow-hidden z-[9999] animate-fade-in select-none" style="display: none;">
                        
                        <!-- Header -->
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                                    <i class="fa-solid fa-bell text-[11px]"></i>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider font-heading">Notifikasi Pesanan</span>
                            </div>
                            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded-full font-mono font-bold">
                                {{ $memberActiveNotifCount ?? 0 }} Aktif
                            </span>
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100 text-xs">
                            @if(isset($memberNotifOrders) && $memberNotifOrders->count() > 0)
                                @foreach($memberNotifOrders as $nord)
                                    <a href="{{ route('order.invoice', $nord->order_number) }}" class="block p-3 hover:bg-slate-50 transition">
                                        <div class="flex items-start gap-2.5">
                                            @if($nord->shipping_status === 'dikirim')
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-truck-fast"></i>
                                                </div>
                                            @elseif($nord->payment_status === 'pending')
                                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-clock"></i>
                                                </div>
                                            @elseif($nord->shipping_status === 'selesai')
                                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                            @endif

                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between gap-1">
                                                    <span class="font-bold text-slate-900 truncate">#{{ $nord->order_number }}</span>
                                                    <span class="text-[10px] text-slate-400 font-mono shrink-0">{{ $nord->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-[11px] text-slate-600 truncate mt-0.5">
                                                    @if($nord->shipping_status === 'dikirim')
                                                        <span class="text-blue-700 font-semibold">Sedang Dikirim</span> &bull; Resi: {{ $nord->tracking_number ?: '-' }}
                                                    @elseif($nord->payment_status === 'pending')
                                                        <span class="text-amber-700 font-semibold">Menunggu Pembayaran QRIS</span>
                                                    @elseif($nord->shipping_status === 'selesai')
                                                        <span class="text-emerald-700 font-semibold">Pesanan Selesai / Diterima</span>
                                                    @else
                                                        <span class="text-indigo-700 font-semibold">Sedang Dipacking Redaksi</span>
                                                    @endif
                                                </p>
                                                <p class="text-[10px] text-slate-400 mt-0.5">
                                                    Total: <strong class="text-slate-700 font-mono">{{ $nord->formatted_payment }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="p-8 text-center text-slate-400 text-xs">
                                    <i class="fa-regular fa-bell-slash text-3xl mb-2 text-slate-300 block"></i>
                                    Belum ada notifikasi pesanan saat ini.
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('member.orders') }}" class="text-xs font-bold text-emerald-800 hover:text-emerald-950 transition flex items-center justify-center gap-1">
                                <span>Lihat Semua Riwayat Pesanan</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Profile Pill -->
                <a href="{{ route('member.profile') }}" 
                    class="flex items-center gap-2 pl-1 sm:pl-1.5 pr-2 sm:pr-2.5 py-1 rounded-sm bg-slate-100 hover:bg-slate-200 border border-slate-200 transition">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-6 h-6 rounded-sm object-cover" />
                    @else
                        <div class="w-6 h-6 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-[10px] font-black">
                            {{ $user->initials }}
                        </div>
                    @endif
                    <span class="text-xs font-bold text-slate-700 max-w-[90px] truncate hidden sm:inline">{{ explode(' ', $user->name)[0] }}</span>
                </a>
            </div>
        </header>

        <!-- Main Body (Clean, High-Utility Dashboard) -->
        <main class="flex-1 p-3.5 sm:p-6 lg:p-8 pb-24 lg:pb-8 animate-fade-in max-w-6xl w-full mx-auto space-y-4 sm:space-y-6">

            <!-- 1. Member Profile & Welcome Card -->
            <div class="bg-gradient-to-r from-[#032c21] via-[#064e3b] to-[#043d2f] text-white p-4 sm:p-6 rounded-sm shadow-xs relative overflow-hidden">
                <!-- Background Geometric Accents -->
                <div class="absolute -right-8 -top-8 w-40 h-40 bg-emerald-400/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute right-12 bottom-0 w-32 h-32 bg-amber-400/5 rounded-full blur-xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-13 h-13 sm:w-16 sm:h-16 rounded-sm object-cover ring-2 ring-emerald-400/40 shadow-xs shrink-0" />
                        @else
                            <div class="w-13 h-13 sm:w-16 sm:h-16 rounded-sm bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-black text-lg sm:text-2xl shrink-0 shadow-xs ring-2 ring-emerald-400/30">
                                {{ $user->initials }}
                            </div>
                        @endif
                        <div class="space-y-0.5">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="px-2 py-0.5 bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 rounded-xs text-[9.5px] font-extrabold uppercase tracking-wide">
                                    <i class="fa-solid fa-circle-check text-emerald-400"></i> Anggota Resmi
                                </span>
                                <span class="text-[10px] text-emerald-100/70 font-mono">PERSIS PERS Bandung</span>
                            </div>
                            <h1 class="text-base sm:text-xl font-black font-heading tracking-tight text-white leading-snug">
                                {{ $user->name }}
                            </h1>
                            <p class="text-[11px] text-emerald-200/80 truncate">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto pt-2 sm:pt-0 border-t sm:border-t-0 border-white/10">
                        <a href="{{ route('katalog') }}" class="flex-1 sm:flex-none px-3.5 py-2 bg-[#006830] hover:bg-[#032c21] text-white border border-emerald-400/30 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                            <i class="fa-solid fa-book-open text-xs"></i>
                            <span>Buka Katalog</span>
                        </a>
                        <a href="{{ route('member.profile') }}" class="px-3 py-2 bg-white/10 hover:bg-white/20 text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 border border-white/15">
                            <i class="fa-solid fa-user-gear text-xs"></i>
                            <span>Profil</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Interactive Order Status Hub (E-Commerce Style) -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-truck-ramp-box text-emerald-700 text-sm"></i>
                        <h2 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">Status Pesanan Saya</h2>
                    </div>
                    <a href="{{ route('member.orders') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Lihat Semua ({{ $totalUserOrders }})</span>
                        <i class="fa-solid fa-chevron-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 4 Quick Status Badges Grid -->
                <div class="grid grid-cols-4 gap-2 text-center select-none pt-1">
                    
                    <!-- 1. Menunggu Bayar -->
                    <a href="{{ route('member.orders', ['status' => 'pending']) }}" class="p-2.5 sm:p-3 rounded-sm bg-slate-50 hover:bg-amber-50/80 border border-slate-200 hover:border-amber-300 transition group flex flex-col items-center justify-center">
                        <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ $countPending > 0 ? 'text-amber-700' : '' }}">{{ $countPending }}</span>
                        <span class="text-[9.5px] sm:text-[11px] text-slate-500 font-semibold tracking-tight mt-0.5 truncate max-w-full">Menunggu Bayar</span>
                    </a>

                    <!-- 2. Sedang Dikemas -->
                    <a href="{{ route('member.orders', ['status' => 'diproses']) }}" class="p-2.5 sm:p-3 rounded-sm bg-slate-50 hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-300 transition group flex flex-col items-center justify-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ $countProcessing > 0 ? 'text-emerald-700' : '' }}">{{ $countProcessing }}</span>
                        <span class="text-[9.5px] sm:text-[11px] text-slate-500 font-semibold tracking-tight mt-0.5 truncate max-w-full">Dipacking</span>
                    </a>

                    <!-- 3. Dalam Pengiriman -->
                    <a href="{{ route('member.orders', ['status' => 'dikirim']) }}" class="p-2.5 sm:p-3 rounded-sm bg-slate-50 hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 transition group flex flex-col items-center justify-center">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ $countShipping > 0 ? 'text-blue-700' : '' }}">{{ $countShipping }}</span>
                        <span class="text-[9.5px] sm:text-[11px] text-slate-500 font-semibold tracking-tight mt-0.5 truncate max-w-full">Dikirim</span>
                    </a>

                    <!-- 4. Selesai / Diterima -->
                    <a href="{{ route('member.orders', ['status' => 'selesai']) }}" class="p-2.5 sm:p-3 rounded-sm bg-slate-50 hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-300 transition group flex flex-col items-center justify-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <span class="text-xs sm:text-sm font-black font-mono text-slate-900">{{ $countCompleted }}</span>
                        <span class="text-[9.5px] sm:text-[11px] text-slate-500 font-semibold tracking-tight mt-0.5 truncate max-w-full">Selesai</span>
                    </a>

                </div>
            </div>

            <!-- 3. Pesanan Terkini Snapshot (Jika ada pesanan) -->
            @if($latestOrder)
                <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs space-y-3">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="font-mono font-bold text-slate-900">#{{ $latestOrder->order_number }}</span>
                            <span class="text-slate-400">• {{ $latestOrder->created_at->diffForHumans() }}</span>
                        </div>
                        @if($latestOrder->payment_status === 'completed')
                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-xs text-[10px] font-bold uppercase">
                                Lunas (QRIS)
                            </span>
                        @else
                            <span class="px-2 py-0.5 bg-amber-100 text-amber-800 rounded-xs text-[10px] font-bold uppercase">
                                Menunggu Bayar
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between gap-3 text-xs">
                        <div class="space-y-0.5 min-w-0">
                            <p class="text-slate-500 text-[11px]">Total Tagihan:</p>
                            <p class="font-black font-mono text-sm sm:text-base text-emerald-900">{{ $latestOrder->formatted_payment }}</p>
                        </div>
                        <a href="{{ route('member.orders') }}" class="px-3.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                            <span>Lacak Status</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endif

            <!-- 4. Layanan Cepat Member (3 Clean Cards) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                
                <!-- Card 1: Katalog Publikasi -->
                <a href="{{ route('katalog') }}" class="p-4 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-sm shadow-2xs transition group flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 font-heading group-hover:text-emerald-800 transition">
                            Katalog Publikasi
                        </h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">Cari monograf riset, modul ajar, dan buku ber-ISBN resmi</p>
                    </div>
                </a>

                <!-- Card 2: Pengajuan Naskah -->
                <a href="javascript:void(0)" onclick="openAdminContactDrawer()" class="p-4 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-sm shadow-2xs transition group flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-sm bg-blue-50 text-blue-700 border border-blue-200 flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition">
                        <i class="fa-solid fa-feather-pointed"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 font-heading group-hover:text-blue-800 transition">
                            Pengajuan Naskah
                        </h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">Layanan konversi tesis/disertasi dan penerbitan buku baru</p>
                    </div>
                </a>

                <!-- Card 3: Konsultasi Redaksi -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PENERBIT PERSIS, saya member ' . $user->name . ' ingin berkonsultasi.') }}" target="_blank" class="p-4 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-sm shadow-2xs transition group flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-base shrink-0 group-hover:scale-105 transition">
                        <i class="fa-brands fa-whatsapp text-lg text-emerald-600"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="font-extrabold text-xs sm:text-sm text-slate-900 font-heading group-hover:text-emerald-800 transition">
                            Bantuan Redaksi
                        </h3>
                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-2">Chat langsung editor dan tim percetakan PERSIS PERS</p>
                    </div>
                </a>

            </div>

            <!-- 5. Rekomendasi Terbitan Terbaru (Fresh Books Grid) -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs space-y-3.5">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">Koleksi Terbitan Terbaru</h2>
                        <p class="text-[11px] text-slate-400">Riset dosen dan monograf ilmiah terbitan PERSIS PERS Bandung</p>
                    </div>
                    <a href="{{ route('katalog') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Semua Buku</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach($recentBooks as $rb)
                        @php
                            $coverExists = $rb->cover_image && (file_exists(public_path('storage/' . $rb->cover_image)) || file_exists(public_path('images/' . $rb->cover_image)));
                            $coverSrc = $coverExists ? (file_exists(public_path('storage/' . $rb->cover_image)) ? asset('storage/' . $rb->cover_image) : asset('images/' . $rb->cover_image)) : null;
                        @endphp
                        <a href="{{ route('katalog') }}" class="group flex flex-col justify-between bg-slate-50 hover:bg-slate-100/80 p-2 rounded-sm border border-slate-200/80 transition">
                            <div class="book-stage-3d mx-auto w-full aspect-[3/4.2] mb-2">
                                <div class="book-cover-3d relative w-full h-full bg-slate-900 rounded-xs overflow-hidden border border-slate-300">
                                    <div class="book-spine-strip"></div>
                                    @if($coverExists)
                                        <img src="{{ $coverSrc }}" alt="{{ $rb->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" />
                                    @else
                                        <div class="w-full h-full bg-[#032c21] p-1.5 flex flex-col justify-between text-white border-l border-emerald-400 text-center">
                                            <span class="text-[6px] font-mono text-emerald-300">PERSIS</span>
                                            <h6 class="text-[7.5px] font-bold line-clamp-3 leading-tight">{{ $rb->title }}</h6>
                                            <span class="text-[6px] text-slate-300 truncate">{{ $rb->author }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-0.5 text-left">
                                <h4 class="text-[11px] font-bold text-slate-900 line-clamp-2 leading-tight group-hover:text-emerald-800 transition">
                                    {{ $rb->title }}
                                </h4>
                                <p class="text-[10px] font-black font-mono text-emerald-900">{{ $rb->formatted_price }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </main>
    </div>

    <!-- ==================== MOBILE APP BOTTOM NAVIGATION BAR ==================== -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-2 py-1.5 flex items-center justify-around select-none">
        
        <!-- 1. Dashboard -->
        <a href="{{ route('member.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.dashboard') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-gauge-high text-base"></i>
                @if(request()->routeIs('member.dashboard'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Dashboard</span>
        </a>

        <!-- 2. Pesanan Saya (with Live Badge) -->
        <a href="{{ route('member.orders') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.orders*') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-receipt text-base"></i>
                @php
                    $navOrdCount = \App\Models\Order::where('user_id', Auth::id())->orWhere('customer_email', Auth::user()->email)->count();
                @endphp
                @if($navOrdCount > 0)
                    <span class="absolute -top-1.5 -right-2.5 px-1 min-w-[14px] h-[14px] rounded-full bg-emerald-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono">
                        {{ $navOrdCount }}
                    </span>
                @endif
                @if(request()->routeIs('member.orders*'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Pesanan</span>
        </a>

        <!-- 3. Katalog Buku -->
        <a href="{{ route('katalog') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-slate-800 font-medium">
            <div class="relative">
                <i class="fa-solid fa-book-open text-base"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Katalog</span>
        </a>

        <!-- 4. WhatsApp Redaksi -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PENERBIT PERSIS, saya member ' . $user->name . ' ingin berkonsultasi.') }}" target="_blank" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-emerald-700 font-medium">
            <div class="relative">
                <i class="fa-brands fa-whatsapp text-base text-emerald-600"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Redaksi</span>
        </a>

        <!-- 5. Profil Akun -->
        <a href="{{ route('member.profile') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.profile') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-user text-base"></i>
                @if(request()->routeIs('member.profile'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Akun</span>
        </a>

    </nav>

    <!-- Dropdown & Sidebar JS with Persistent Collapse Memory -->
    <script>
        if (window.innerWidth >= 1024) {
            const savedState = localStorage.getItem('persis_member_sidebar_collapsed');
            if (savedState === 'true') {
                collapseSidebarDesktop();
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('member-sidebar');
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
            const sidebar = document.getElementById('member-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.remove('lg:translate-x-0');
            sidebar.classList.add('lg:-translate-x-full');
            wrapper.classList.remove('lg:pl-64');
            wrapper.classList.add('lg:pl-0');
            localStorage.setItem('persis_member_sidebar_collapsed', 'true');
        }

        function expandSidebarDesktop() {
            const sidebar = document.getElementById('member-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.add('lg:translate-x-0');
            sidebar.classList.remove('lg:-translate-x-full');
            wrapper.classList.add('lg:pl-64');
            wrapper.classList.remove('lg:pl-0');
            localStorage.setItem('persis_member_sidebar_collapsed', 'false');
        }
    </script>
    <script>
        function toggleMemberNotifDropdown(e) {
            if (e) {
                try { e.preventDefault(); e.stopPropagation(); } catch(err) {}
            }
            const dropdown = document.getElementById('memberNotifDropdown');
            if (!dropdown) return;
            const isClosed = dropdown.classList.contains('hidden') || dropdown.style.display === 'none' || (window.getComputedStyle && window.getComputedStyle(dropdown).display === 'none');
            if (isClosed) {
                dropdown.style.display = 'block';
                dropdown.classList.remove('hidden');
            } else {
                dropdown.style.display = 'none';
                dropdown.classList.add('hidden');
            }
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('memberNotifDropdown');
            const container = document.getElementById('memberNotifContainer');
            if (dropdown && container && !container.contains(e.target)) {
                dropdown.style.display = 'none';
                dropdown.classList.add('hidden');
            }
        });
    </script>
<!-- ========================================================================= -->
    <!-- ADMIN CONTACTS & ORDER SERVICE SLIDE DRAWER (MATCHING CART DRAWER STYLE) -->
    <!-- ========================================================================= -->
    <div id="adminContactDrawer" class="fixed inset-0 z-[9999] hidden items-end sm:items-stretch sm:justify-end" style="display: none;">
        <!-- Backdrop -->
        <div id="adminContactDrawerBackdrop" onclick="closeAdminContactDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Panel (Mobile: Bottom Sheet, Desktop: Right Sidebar) -->
        <div id="adminContactDrawerPanel" class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl rounded-t-2xl sm:rounded-none flex flex-col max-h-[88vh] sm:max-h-full sm:h-full transform translate-y-full sm:translate-y-0 sm:translate-x-full transition-transform duration-300 ease-out border-t sm:border-t-0 sm:border-l border-slate-200">
            
            <!-- Mobile Pull Handle -->
            <div class="sm:hidden w-full pt-3 pb-1 flex justify-center cursor-pointer select-none" onclick="closeAdminContactDrawer()">
                <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
            </div>

            <!-- Drawer Header -->
            <div class="px-5 py-3.5 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-950 select-none rounded-t-xl sm:rounded-none">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-sm bg-white/10 p-1 flex items-center justify-center shrink-0 border border-white/15 shadow-xs">
                        <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="PERSIS PERS" class="w-full h-full object-contain" />
                    </div>
                    <div>
                        <h3 class="font-bold text-sm font-heading flex items-center gap-1.5">
                            Kontak Admin &amp; Layanan
                        </h3>
                        <p class="text-[10px] text-emerald-200/70">Penerbitan &amp; Percetakan Resmi PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="closeAdminContactDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Drawer Body -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-5 space-y-4">
                
                <!-- Selected Order Status Card (If Opened from Order) -->
                <div id="drawerSelectedOrderCard" class="hidden p-3.5 bg-emerald-50/70 border border-emerald-200 rounded-sm space-y-2 select-none">
                    <div class="flex items-center justify-between border-b border-emerald-200/80 pb-2">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-emerald-700 text-xs"></i>
                            <span id="drawerOrderNumberText" class="font-mono font-bold text-xs text-slate-900">#INV-...</span>
                        </div>
                        <span id="drawerShippingBadge" class="px-2 py-0.5 bg-emerald-700 text-white rounded-xs text-[10px] font-bold uppercase font-mono">
                            DIPROSES
                        </span>
                    </div>

                    <div id="drawerTrackingRow" class="text-xs text-slate-700 flex items-center justify-between pt-0.5">
                        <span class="text-slate-500">Nomor Resi:</span>
                        <span id="drawerTrackingNumberText" class="font-mono font-bold text-emerald-900">-</span>
                    </div>
                    <p class="text-[10.5px] text-slate-500 leading-snug">Pilih kontak admin spesialis di bawah untuk berkonsultasi mengenai pesanan ini:</p>
                </div>

                <!-- Section Title -->
                <div>
                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-1.5">
                        <i class="fa-solid fa-users text-emerald-700"></i>
                        <span>Daftar Kontak Admin Redaksi</span>
                    </h4>
                    <p class="text-[11px] text-slate-500 mt-0.5">Tim kami siap membantu Anda setiap hari kerja (08.00 - 17.00 WIB).</p>
                </div>

                <!-- 3 Admin Contact Cards -->
                <div class="space-y-3">
                    
                    <!-- ADMIN 1: Pengiriman & Gudang -->
                    <div class="p-3.5 bg-white border border-slate-200 hover:border-emerald-500 rounded-sm shadow-2xs transition-colors space-y-2.5">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-sm bg-gradient-to-tr from-blue-700 to-blue-500 text-white flex items-center justify-center text-sm font-black shrink-0 shadow-xs">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h5 class="text-xs font-bold text-slate-900 truncate">Admin Pengiriman &amp; Gudang</h5>
                                    <span class="inline-flex items-center gap-1 text-[9.5px] font-bold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
                                    </span>
                                </div>
                                <p class="text-[10.5px] font-semibold text-blue-700 mt-0.5">Divisi Logistik &amp; Resi Ekspedisi</p>
                                <p class="text-[10px] text-slate-500 mt-0.5">Cek status packing, kurir pengantar, &amp; kendala alamat.</p>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                            <span class="text-[11px] font-mono font-bold text-slate-700">0821-1611-6133</span>
                            <button type="button" 
                                    onclick="contactAdminViaWa('6282116116133', 'Admin Pengiriman & Gudang')"
                                    class="px-3 py-1.5 bg-[#25D366] hover:bg-[#1EBE5D] text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Chat WhatsApp</span>
                            </button>
                        </div>
                    </div>

                    <!-- ADMIN 2: Naskah & Penerbitan -->
                    <div class="p-3.5 bg-white border border-slate-200 hover:border-emerald-500 rounded-sm shadow-2xs transition-colors space-y-2.5">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-sm bg-gradient-to-tr from-emerald-800 to-emerald-600 text-white flex items-center justify-center text-sm font-black shrink-0 shadow-xs">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h5 class="text-xs font-bold text-slate-900 truncate">Admin Redaksi &amp; Naskah</h5>
                                    <span class="inline-flex items-center gap-1 text-[9.5px] font-bold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
                                    </span>
                                </div>
                                <p class="text-[10.5px] font-semibold text-emerald-700 mt-0.5">Divisi Penerbitan &amp; ISBN</p>
                                <p class="text-[10px] text-slate-500 mt-0.5">Pengajuan naskah baru, layout, cover, &amp; legalitas ISBN.</p>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                            <span class="text-[11px] font-mono font-bold text-slate-700">0851-1779-7487</span>
                            <button type="button" 
                                    onclick="contactAdminViaWa('6285117797487', 'Admin Redaksi & Naskah')"
                                    class="px-3 py-1.5 bg-[#25D366] hover:bg-[#1EBE5D] text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Chat WhatsApp</span>
                            </button>
                        </div>
                    </div>

                    <!-- ADMIN 3: Keuangan & Pembayaran -->
                    <div class="p-3.5 bg-white border border-slate-200 hover:border-emerald-500 rounded-sm shadow-2xs transition-colors space-y-2.5">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-sm bg-gradient-to-tr from-amber-700 to-amber-500 text-white flex items-center justify-center text-sm font-black shrink-0 shadow-xs">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <h5 class="text-xs font-bold text-slate-900 truncate">Admin Keuangan &amp; Faktur</h5>
                                    <span class="inline-flex items-center gap-1 text-[9.5px] font-bold text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Online
                                    </span>
                                </div>
                                <p class="text-[10.5px] font-semibold text-amber-800 mt-0.5">Divisi Billing &amp; Verifikasi QRIS</p>
                                <p class="text-[10px] text-slate-500 mt-0.5">Faktur pajak, bukti potong, &amp; kendala pembayaran QRIS.</p>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                            <span class="text-[11px] font-mono font-bold text-slate-700">0821-1611-6133</span>
                            <button type="button" 
                                    onclick="contactAdminViaWa('6282116116133', 'Admin Keuangan & Faktur')"
                                    class="px-3 py-1.5 bg-[#25D366] hover:bg-[#1EBE5D] text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Chat WhatsApp</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- In-App Quick Message Accordion -->
                <div class="pt-2 border-t border-slate-200">
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200 space-y-2">
                        <span class="text-xs font-bold text-slate-800 block">Kirim Pesan Internal ke Redaksi:</span>
                        <textarea id="drawerDirectMessageInput" rows="2" placeholder="Tuliskan pertanyaan Anda..." class="w-full px-3 py-2 bg-white border border-slate-300 rounded-xs text-xs text-slate-900 focus:border-emerald-600 outline-none transition"></textarea>
                        <button type="button" onclick="sendDrawerDirectMessage()" class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                            <i class="fa-solid fa-paper-plane text-xs text-lime-300"></i>
                            <span>Kirim Pesan ke Redaksi</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Drawer Footer -->
            <div class="p-3.5 bg-slate-50 border-t border-slate-200 text-center text-xs text-slate-500">
                <span>Kantor Redaksi PENERBIT PERSIS &bull; Jl. Ciganitri No.2, Bandung</span>
            </div>

        </div>
    </div>

    <script>
        let currentDrawerOrderNumber = null;
        let currentDrawerShippingStatus = null;
        let currentDrawerTrackingNumber = null;

        function openAdminContactDrawer(orderNumber = null, shippingStatus = null, trackingNumber = null) {
            currentDrawerOrderNumber = orderNumber;
            currentDrawerShippingStatus = shippingStatus;
            currentDrawerTrackingNumber = trackingNumber;

            const orderCard = document.getElementById('drawerSelectedOrderCard');
            if (orderNumber && orderCard) {
                orderCard.classList.remove('hidden');
                document.getElementById('drawerOrderNumberText').textContent = '#' + orderNumber;
                
                const statusBadge = document.getElementById('drawerShippingBadge');
                if (statusBadge) {
                    statusBadge.textContent = (shippingStatus || 'Diproses').replace('_', ' ');
                }

                const trackRow = document.getElementById('drawerTrackingRow');
                const trackText = document.getElementById('drawerTrackingNumberText');
                if (trackingNumber) {
                    trackRow.classList.remove('hidden');
                    trackText.textContent = trackingNumber;
                } else {
                    trackRow.classList.add('hidden');
                }
            } else if (orderCard) {
                orderCard.classList.add('hidden');
            }

            const drawer = document.getElementById('adminContactDrawer');
            const backdrop = document.getElementById('adminContactDrawerBackdrop');
            const panel = document.getElementById('adminContactDrawerPanel');

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

        function closeAdminContactDrawer() {
            const drawer = document.getElementById('adminContactDrawer');
            const backdrop = document.getElementById('adminContactDrawerBackdrop');
            const panel = document.getElementById('adminContactDrawerPanel');

            if (drawer && backdrop && panel) {
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-y-full', 'sm:translate-x-full');
                panel.classList.remove('translate-y-0', 'sm:translate-x-0');
                setTimeout(() => {
                    drawer.style.display = 'none';
                    drawer.classList.add('hidden');
                }, 300);
            }
        }

        function contactAdminViaWa(phone, adminRole) {
            let msg = `Halo ${adminRole}, saya ingin berkonsultasi mengenai layanan PENERBIT PERSIS`;
            if (currentDrawerOrderNumber) {
                msg += ` untuk pesanan *#${currentDrawerOrderNumber}*`;
                if (currentDrawerTrackingNumber) {
                    msg += ` (No. Resi: *${currentDrawerTrackingNumber}*)`;
                }
            }
            msg += `. Mohon informasinya ya. Terima kasih!`;

            const waUrl = `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;
            window.open(waUrl, '_blank');
        }

        function sendDrawerDirectMessage() {
            const input = document.getElementById('drawerDirectMessageInput');
            const msg = input.value.trim();
            if (!msg) {
                alert('Mohon tuliskan pesan terlebih dahulu.');
                return;
            }

            const targetUrl = currentDrawerOrderNumber 
                ? `/member/pesanan/${currentDrawerOrderNumber}/messages` 
                : `/kontak`;

            if (currentDrawerOrderNumber) {
                fetch(targetUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: msg })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message || 'Pesan berhasil dikirim ke Redaksi.');
                    input.value = '';
                    closeAdminContactDrawer();
                })
                .catch(err => alert('Gagal mengirim pesan. Silakan coba WhatsApp admin.'));
            } else {
                contactAdminViaWa('6282116116133', 'Admin Redaksi');
            }
        }
    </script>


</body>
</html>
