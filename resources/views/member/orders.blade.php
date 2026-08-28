<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pesanan & Transaksi Saya | Portal Member PENERBIT PERSIS</title>
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

        /* Hide scrollbars for clean mobile tab scrolling */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Signature 3D Realistic Book Cover */
        .book-stage-3d {
            perspective: 600px;
        }
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
            width: 5px;
            background: linear-gradient(90deg, rgba(255,255,255,0.35) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.4) 100%);
            border-right: 1px solid rgba(0,0,0,0.15);
            z-index: 10;
        }
        .book-paper-edge {
            position: absolute;
            top: 1px;
            bottom: 1px;
            right: 0;
            width: 2px;
            background: repeating-linear-gradient(180deg, #fdfbf7, #fdfbf7 1px, #e2dcd0 1px, #e2dcd0 2px);
            border-left: 1px solid rgba(0,0,0,0.15);
            z-index: 5;
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

                        <a href="{{ url('/kontak') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
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
                    <a href="{{ route('member.dashboard') }}" class="text-slate-400 hover:text-emerald-700 transition">Portal Member</a>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                    <span class="font-bold text-slate-800">Pesanan & Transaksi Saya</span>
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

        <!-- Main Body Content (App-like Mobile Experience) -->
        <main class="flex-1 p-3.5 sm:p-6 lg:p-8 pb-24 lg:pb-8 animate-fade-in max-w-6xl w-full mx-auto space-y-3.5 sm:space-y-5">

            <!-- Success Alert Notification -->
            @if(session('success'))
                <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-sm flex items-start gap-2.5 text-xs sm:text-sm text-emerald-900 font-semibold shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- App Title Bar for Mobile -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-3.5 sm:p-5 shadow-2xs space-y-3">
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-xs bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <h1 class="text-sm sm:text-lg font-extrabold text-slate-900 font-heading leading-tight">
                                Riwayat Pesanan Saya
                            </h1>
                            <p class="text-[11px] text-slate-500 hidden sm:block mt-0.5">Pantau status transaksi QRIS dan pengiriman buku resmi Anda</p>
                        </div>
                    </div>
                    <span class="text-[11px] font-bold font-mono text-emerald-800 bg-emerald-50 px-2 py-0.5 border border-emerald-200 rounded-xs">
                        {{ $countAll }} Order
                    </span>
                </div>

                <!-- Modern Touch-Friendly Horizontal Status Tabs -->
                <div class="flex items-center gap-1.5 overflow-x-auto no-scrollbar pb-0.5 text-xs select-none -mx-1 px-1">
                    <a href="{{ route('member.orders') }}" 
                        class="px-3 py-1.5 rounded-sm transition whitespace-nowrap {{ !$statusFilter ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                        Semua ({{ $countAll }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'diproses']) }}" 
                        class="px-3 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'diproses' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                        <i class="fa-solid fa-box-archive text-[10px] mr-1"></i> Dipacking ({{ $countProcessing }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'dikirim']) }}" 
                        class="px-3 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'dikirim' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                        <i class="fa-solid fa-truck-fast text-[10px] mr-1"></i> Dikirim ({{ $countShipping }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'selesai']) }}" 
                        class="px-3 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'selesai' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                        <i class="fa-solid fa-circle-check text-[10px] mr-1"></i> Selesai ({{ $countCompleted }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'pending']) }}" 
                        class="px-3 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'pending' ? 'bg-amber-600 text-white shadow-2xs font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium' }}">
                        <i class="fa-solid fa-clock text-[10px] mr-1"></i> Belum Bayar ({{ $countPending }})
                    </a>
                </div>
            </div>

            <!-- Orders Cards Grid (Clean Native App Style) -->
            @if($orders->count() > 0)
                <div class="space-y-3.5 sm:space-y-4">
                    @foreach($orders as $ord)
                        <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden transition hover:border-slate-300">
                            
                            <!-- Card Top Bar: Invoice, Date, and Status Badge -->
                            <div class="px-3.5 py-2.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between gap-2 text-xs">
                                <div class="min-w-0">
                                    <span class="font-mono font-bold text-slate-900 text-xs sm:text-sm block truncate">
                                        #{{ $ord->order_number }}
                                    </span>
                                    <span class="text-[10.5px] text-slate-400 block mt-0.5">
                                        {{ $ord->created_at->format('d M Y, H:i') }} WIB • <span class="font-mono uppercase">{{ $ord->payment_method }}</span>
                                    </span>
                                </div>

                                <div class="shrink-0">
                                    @if($ord->payment_status === 'completed')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-xs text-[10px] font-bold uppercase border border-emerald-300">
                                            <i class="fa-solid fa-check text-[9px]"></i> Lunas
                                        </span>
                                    @elseif($ord->payment_status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 text-amber-900 rounded-xs text-[10px] font-bold uppercase border border-amber-300 animate-pulse">
                                            <i class="fa-solid fa-clock text-[9px]"></i> Menunggu Bayar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-100 text-red-800 rounded-xs text-[10px] font-bold uppercase">
                                            {{ strtoupper($ord->payment_status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Middle: Book Items List (App Layout) -->
                            <div class="p-3.5 sm:p-4 space-y-3">
                                @if(!empty($ord->items_json))
                                    @foreach($ord->items_json as $it)
                                        @php
                                            $coverPath = $it['cover_image'] ?? null;
                                            if (!$coverPath && !empty($it['book_id'])) {
                                                $b = \App\Models\Book::find($it['book_id']);
                                                $coverPath = $b ? $b->cover_image : null;
                                            }
                                            $hasImage = $coverPath && (file_exists(public_path('storage/' . $coverPath)) || file_exists(public_path('images/' . $coverPath)));
                                            $imageSrc = $hasImage ? (file_exists(public_path('storage/' . $coverPath)) ? asset('storage/' . $coverPath) : asset('images/' . $coverPath)) : null;
                                        @endphp

                                        <div class="flex items-start gap-3 py-1">
                                            
                                            <!-- 3D Miniature Book Cover -->
                                            <div class="book-stage-3d shrink-0">
                                                <div class="book-cover-3d relative w-14 sm:w-20 aspect-[3/4.2] bg-slate-900 rounded-xs overflow-hidden border border-slate-300 select-none">
                                                    <div class="book-spine-strip"></div>
                                                    <div class="book-paper-edge"></div>
                                                    
                                                    @if($hasImage)
                                                        <img src="{{ $imageSrc }}" alt="{{ $it['title'] ?? 'Buku' }}" class="w-full h-full object-cover" />
                                                    @else
                                                        <div class="w-full h-full bg-[#032c21] p-1 flex flex-col justify-between text-white border-l border-emerald-400">
                                                            <div class="text-[5px] font-mono text-emerald-300 uppercase">PERSIS</div>
                                                            <div class="my-auto text-center">
                                                                <h5 class="text-[6.5px] font-bold text-white leading-tight line-clamp-2">{{ $it['title'] ?? 'Buku' }}</h5>
                                                            </div>
                                                            <div class="text-[5px] text-slate-300 truncate border-t border-white/10 pt-0.5">
                                                                {{ $it['author'] ?? '-' }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Book Info -->
                                            <div class="flex-1 min-w-0 space-y-0.5 text-xs">
                                                <span class="inline-block px-1.5 py-0.2 bg-emerald-50 text-emerald-700 text-[9px] font-bold rounded-xs uppercase border border-emerald-200">
                                                    {{ $it['category'] ?? 'Penerbitan' }}
                                                </span>
                                                <h3 class="font-bold text-slate-900 text-xs sm:text-sm leading-snug line-clamp-2">
                                                    {{ $it['title'] ?? 'Judul Buku' }}
                                                </h3>
                                                <p class="text-[10.5px] text-slate-500 truncate">
                                                    {{ $it['author'] ?? 'Penulis PERSIS PERS' }}
                                                </p>
                                                <div class="pt-1 flex items-center justify-between text-xs">
                                                    <span class="text-[11px] text-slate-500 font-mono">{{ $it['quantity'] ?? 1 }}x @ {{ $it['formatted_price'] ?? 'Rp 0' }}</span>
                                                    <span class="font-bold font-mono text-slate-900 text-xs sm:text-sm">{{ $it['formatted_subtotal'] ?? 'Rp 0' }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Card Summary Strip (Status Pengiriman & Total) -->
                            <div class="mx-3.5 mb-3.5 p-2.5 bg-slate-50 border border-slate-200 rounded-sm flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="text-[10.5px] font-bold text-slate-400 uppercase">Pengiriman:</span>
                                    @if($ord->shipping_status === 'selesai')
                                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 uppercase">
                                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Diterima
                                        </span>
                                    @elseif($ord->shipping_status === 'dikirim')
                                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-blue-100 text-blue-800 border border-blue-300 uppercase">
                                            <i class="fa-solid fa-truck-fast text-blue-600"></i> Sedang Dikirim
                                        </span>
                                        @if($ord->tracking_number)
                                            <span class="text-[10px] font-mono text-emerald-800 font-bold bg-white px-1.5 py-0.2 border border-slate-200 rounded-xs">
                                                Resi: {{ $ord->tracking_number }}
                                            </span>
                                        @endif
                                    @elseif($ord->shipping_status === 'diproses')
                                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300 uppercase">
                                            <i class="fa-solid fa-box-archive text-amber-600"></i> Sedang Dipacking
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-slate-200 text-slate-700 uppercase">
                                            <i class="fa-solid fa-hourglass-start text-slate-500"></i> Menunggu Antrean
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between sm:justify-end gap-3 pt-1.5 sm:pt-0 border-t sm:border-t-0 border-slate-200">
                                    <span class="text-slate-500 text-[11px]">Total Bayar:</span>
                                    <span class="font-black font-mono text-sm sm:text-base text-emerald-900">{{ $ord->formatted_payment }}</span>
                                </div>
                            </div>

                            <!-- Card Bottom Actions Footer -->
                            <div class="px-3.5 py-2.5 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs">
                                <div class="text-[10.5px] text-slate-500 truncate max-w-full sm:max-w-xs text-center sm:text-left">
                                    Tujuan: <strong class="text-slate-700">{{ $ord->customer_name }}</strong> ({{ $ord->customer_phone }})
                                </div>

                                <div class="w-full sm:w-auto flex items-center gap-2">
                                    <!-- Tombol Konfirmasi Diterima (Jika status dikirim) -->
                                    @if($ord->shipping_status === 'dikirim')
                                        <form method="POST" action="{{ route('member.orders.confirm_received', $ord->order_number) }}" onsubmit="return confirm('Apakah Anda yakin paket buku telah sampai dan diterima dengan baik?')" class="flex-1 sm:flex-none">
                                            @csrf
                                            <button type="submit" class="w-full sm:w-auto px-3 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                                <i class="fa-solid fa-circle-check text-lime-300"></i>
                                                <span>Terima Paket</span>
                                            </button>
                                        </form>
                                    @endif

                                    @if($ord->payment_status === 'pending')
                                        <!-- Tombol Bayar Sekarang (QRIS) -->
                                        <a href="{{ route('order.invoice', $ord->order_number) }}" class="flex-1 sm:flex-none px-3.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs animate-pulse">
                                            <i class="fa-solid fa-qrcode text-lime-300 text-xs"></i>
                                            <span>Bayar Sekarang (QRIS)</span>
                                        </a>
                                    @endif

                                    <!-- Tombol Diskusi Pesanan (Slide Drawer Chat Interaktif) -->
                                    <button type="button" 
                                            onclick="openOrderDiscussionDrawer('{{ $ord->order_number }}', '{{ $ord->shipping_status }}', '{{ $ord->tracking_number ?? '' }}')" 
                                            class="relative flex-1 sm:flex-none px-3 py-1.5 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-300 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                        <i class="fa-solid fa-comments text-emerald-700 text-xs"></i>
                                        <span>Diskusi Pesanan</span>
                                        @if($ord->unreadMessagesForCustomerCount() > 0)
                                            <span class="w-2 h-2 rounded-full bg-rose-600 animate-ping"></span>
                                        @endif
                                    </button>

                                    <!-- Tombol Lihat Invoice -->
                                    <a href="{{ route('order.invoice', $ord->order_number) }}" target="_blank" class="flex-1 sm:flex-none px-3 py-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-semibold transition flex items-center justify-center gap-1 shadow-2xs">
                                        <i class="fa-solid fa-file-invoice text-emerald-700"></i>
                                        <span>Invoice</span>
                                    </a>

                                    <!-- Tombol WhatsApp Redaksi -->
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PENERBIT PERSIS, saya ingin menanyakan pesanan #' . $ord->order_number . ' atas nama ' . $ord->customer_name . '.') }}" target="_blank" class="px-2.5 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-sm text-xs font-semibold transition flex items-center justify-center gap-1 shrink-0" title="Hubungi WhatsApp">
                                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                        <span class="hidden sm:inline">WhatsApp</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="pt-2">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="p-8 text-center bg-white rounded-sm border border-slate-200/90 space-y-3 shadow-2xs">
                    <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-xl">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 font-heading">Tidak Ada Pesanan</h3>
                        <p class="text-xs text-slate-500 mt-0.5 max-w-xs mx-auto">
                            @if($statusFilter)
                                Tidak ada transaksi buku dengan status ini.
                            @else
                                Anda belum memiliki riwayat pembelian buku.
                            @endif
                        </p>
                    </div>
                    <div class="pt-1">
                        <a href="{{ route('katalog') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-2xs">
                            <i class="fa-solid fa-book-open text-xs"></i>
                            <span>Buka Katalog Buku</span>
                        </a>
                    </div>
                </div>
            @endif

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
    <!-- ORDER DISCUSSION & REALTIME CHAT SLIDE DRAWER (SLIDE-OVER FROM RIGHT) -->
    <!-- ========================================================================= -->
    <div id="orderDiscussionDrawer" class="fixed inset-0 z-[9999] hidden items-end sm:items-stretch sm:justify-end" style="display: none;">
        <!-- Backdrop -->
        <div id="orderDiscussionBackdrop" onclick="closeOrderDiscussionDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Panel (Mobile: Bottom Sheet, Desktop: Right Sidebar) -->
        <div id="orderDiscussionPanel" class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl rounded-t-2xl sm:rounded-none flex flex-col max-h-[90vh] sm:max-h-full sm:h-full transform translate-y-full sm:translate-y-0 sm:translate-x-full transition-transform duration-300 ease-out border-t sm:border-t-0 sm:border-l border-slate-200">
            
            <!-- Mobile Pull Handle -->
            <div class="sm:hidden w-full pt-3 pb-1 flex justify-center cursor-pointer select-none" onclick="closeOrderDiscussionDrawer()">
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
                            <span>Diskusi Pesanan</span>
                            <span id="drawerOrderInvoiceBadge" class="text-xs font-mono text-lime-300 font-bold">#INV-...</span>
                        </h3>
                        <p class="text-[10px] text-emerald-200/70">Penerbitan &amp; Percetakan Resmi PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="closeOrderDiscussionDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Diskusi">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Order Status Banner Bar -->
            <div class="p-3 bg-slate-100 border-b border-slate-200 flex items-center justify-between text-xs shrink-0 select-none">
                <div class="flex items-center gap-2">
                    <span class="text-slate-500 text-[11px]">Status:</span>
                    <span id="drawerStatusText" class="px-2 py-0.5 bg-emerald-700 text-white rounded-xs text-[10px] font-bold uppercase font-mono">
                        DIPROSES
                    </span>
                </div>
                <div id="drawerResiContainer" class="text-[11px] text-slate-600">
                    Resi: <strong id="drawerResiText" class="font-mono text-emerald-800">-</strong>
                </div>
            </div>

            <!-- Chat Stream Area -->
            <div id="orderDiscussionMessagesStream" class="flex-1 overflow-y-auto p-4 bg-slate-50/70 space-y-3 min-h-[260px]">
                <div class="py-12 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-spinner fa-spin text-xl text-emerald-600 mb-2 block"></i>
                    <span>Memuat percakapan...</span>
                </div>
            </div>

            <!-- Quick Template Chips -->
            <div class="px-3.5 py-2 bg-slate-100/90 border-t border-slate-200 flex items-center gap-1.5 overflow-x-auto no-scrollbar text-[11px] shrink-0">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider shrink-0">Template:</span>
                <button type="button" onclick="setDiscussionQuickText('Halo Admin PERSIS PERS, apakah pesanan buku saya sudah selesai dipacking?')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                    📦 Status Packing
                </button>
                <button type="button" onclick="setDiscussionQuickText('Halo kak, mohon informasi nomor resi dan ekspedisi pengirimannya ya. Terima kasih!')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                    🚚 Info No. Resi
                </button>
                <button type="button" onclick="setDiscussionQuickText('Alhamdulillah buku telah saya terima dengan baik dan rapi. Terima kasih banyak PERSIS PERS!')" class="px-2.5 py-1 bg-white hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 rounded-xs transition shrink-0 cursor-pointer shadow-2xs">
                    ⭐ Konfirmasi Terima
                </button>
            </div>

            <!-- Message Input & Actions Footer -->
            <div class="p-3 sm:p-4 bg-white border-t border-slate-200 shrink-0 space-y-2">
                <form id="orderDiscussionForm" onsubmit="submitDiscussionMessage(event)" class="flex gap-2">
                    <input 
                        type="text" 
                        id="orderDiscussionMessageInput" 
                        placeholder="Tuliskan pesan ke Admin Redaksi..." 
                        class="flex-1 px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none transition" 
                        required 
                        autocomplete="off"
                    />
                    <button 
                        type="submit" 
                        id="btnSendDiscussion"
                        class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer shrink-0"
                    >
                        <i class="fa-solid fa-paper-plane text-xs text-lime-300"></i>
                        <span class="hidden sm:inline">Kirim</span>
                    </button>
                </form>

                <div class="flex items-center justify-between text-[11px] pt-1">
                    <span class="text-slate-400">Dibalas langsung oleh tim admin resmi</span>
                    <button type="button" onclick="openDirectWhatsAppForOrder()" class="text-emerald-700 hover:text-emerald-900 font-bold flex items-center gap-1 transition cursor-pointer">
                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                        <span>Chat via WhatsApp &rarr;</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        let currentDiscussionOrderNumber = null;
        let currentDiscussionShippingStatus = null;
        let currentDiscussionTrackingNumber = null;
        let discussionPollInterval = null;

        // Open Discussion Slide Drawer
        function openOrderDiscussionDrawer(orderNumber, shippingStatus = null, trackingNumber = null) {
            currentDiscussionOrderNumber = orderNumber;
            currentDiscussionShippingStatus = shippingStatus;
            currentDiscussionTrackingNumber = trackingNumber;

            document.getElementById('drawerOrderInvoiceBadge').textContent = '#' + orderNumber;
            
            const statusTextEl = document.getElementById('drawerStatusText');
            if (statusTextEl) {
                statusTextEl.textContent = (shippingStatus || 'Diproses').replace('_', ' ');
            }

            const resiContainer = document.getElementById('drawerResiContainer');
            const resiText = document.getElementById('drawerResiText');
            if (trackingNumber && trackingNumber !== '-') {
                resiContainer.classList.remove('hidden');
                resiText.textContent = trackingNumber;
            } else {
                resiText.textContent = 'Belum Ada';
            }

            const drawer = document.getElementById('orderDiscussionDrawer');
            const backdrop = document.getElementById('orderDiscussionBackdrop');
            const panel = document.getElementById('orderDiscussionPanel');

            if (drawer && backdrop && panel) {
                drawer.style.display = 'flex';
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-y-full', 'sm:translate-x-full');
                    panel.classList.add('translate-y-0', 'sm:translate-x-0');
                }, 10);
            }

            // Initial fetch & start auto-poll every 3.5s
            fetchDiscussionMessages(orderNumber);
            if (discussionPollInterval) clearInterval(discussionPollInterval);
            discussionPollInterval = setInterval(() => {
                if (currentDiscussionOrderNumber) {
                    fetchDiscussionMessages(currentDiscussionOrderNumber, false);
                }
            }, 3500);
        }

        // Close Discussion Slide Drawer
        function closeOrderDiscussionDrawer() {
            if (discussionPollInterval) clearInterval(discussionPollInterval);
            currentDiscussionOrderNumber = null;

            const drawer = document.getElementById('orderDiscussionDrawer');
            const backdrop = document.getElementById('orderDiscussionBackdrop');
            const panel = document.getElementById('orderDiscussionPanel');

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

        // Set Quick Text Template
        function setDiscussionQuickText(text) {
            const input = document.getElementById('orderDiscussionMessageInput');
            if (input) {
                input.value = text;
                input.focus();
            }
        }

        // Fetch Messages
        function fetchDiscussionMessages(orderNumber, showLoading = true) {
            const stream = document.getElementById('orderDiscussionMessagesStream');
            if (!stream) return;

            fetch(`/member/pesanan/${orderNumber}/messages`)
                .then(res => res.json())
                .then(data => {
                    if (data && data.success) {
                        renderDiscussionMessages(data.messages, data.order);
                    }
                })
                .catch(err => console.error('Error loading messages:', err));
        }

        // Render Chat Bubbles with Admin Real Names & Roles + Items Card
        function renderDiscussionMessages(messages, orderInfo) {
            const stream = document.getElementById('orderDiscussionMessagesStream');
            if (!stream) return;

            let html = '';

            // 1. Render Order Products Snapshot Header inside Stream
            if (orderInfo && orderInfo.items && orderInfo.items.length > 0) {
                html += `
                    <div class="p-3 bg-white border border-slate-200 rounded-sm shadow-2xs space-y-2 select-none mb-3">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-1.5">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider font-heading flex items-center gap-1">
                                <i class="fa-solid fa-bag-shopping text-emerald-700 text-xs"></i> Produk Buku Dipesan
                            </span>
                            <span class="text-[10px] font-bold font-mono text-emerald-800">${orderInfo.formatted_payment || ''}</span>
                        </div>
                        <div class="space-y-2">
                `;

                orderInfo.items.forEach(it => {
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
                            <span>Status: <strong class="text-emerald-800 capitalize">${(orderInfo.shipping_status || 'Diproses').replace('_', ' ')}</strong></span>
                            ${orderInfo.tracking_number ? `<span class="font-mono font-bold text-slate-700">Resi: ${orderInfo.tracking_number}</span>` : ''}
                        </div>
                    </div>

                    <!-- Divider: Riwayat Diskusi -->
                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-2 text-[9.5px] font-bold uppercase tracking-wider text-slate-400 font-mono">Riwayat Percakapan</span>
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
                        <p class="text-[10.5px] text-slate-500 max-w-xs mx-auto">Tuliskan pesan atau pertanyaan mengenai pesanan buku Anda di bawah.</p>
                    </div>
                `;
                stream.innerHTML = html;
                return;
            }

            messages.forEach(msg => {
                if (msg.is_admin) {
                    // Admin Reply Bubble (Left) - Displaying Specific Admin Name
                    const adminName = msg.sender_name || 'Admin Redaksi';
                    html += `
                        <div class="flex flex-col items-start select-none">
                            <div class="max-w-[88%] sm:max-w-md bg-white border border-emerald-300/80 text-slate-800 p-3 rounded-sm rounded-tl-none shadow-2xs space-y-1">
                                <div class="flex items-center justify-between gap-3 text-[10px] pb-1 border-b border-emerald-100">
                                    <span class="font-bold text-emerald-800 flex items-center gap-1 truncate">
                                        <i class="fa-solid fa-shield-halved text-[9px] text-emerald-600"></i> ${adminName}
                                    </span>
                                    <span class="text-slate-400 font-mono shrink-0">${msg.created_at_formatted}</span>
                                </div>
                                <p class="text-xs text-slate-900 leading-relaxed whitespace-pre-line">${msg.message}</p>
                                ${msg.shared_shipping_status ? `
                                    <div class="mt-1.5 p-2 bg-emerald-50 rounded-xs border border-emerald-200 text-[11px] text-emerald-900">
                                        <i class="fa-solid fa-truck-fast text-emerald-600 mr-1"></i> Status: <strong class="capitalize">${msg.shared_shipping_status.replace('_', ' ')}</strong>
                                        ${msg.shared_tracking_number ? `&bull; No. Resi: <strong class="font-mono text-emerald-800">${msg.shared_tracking_number}</strong>` : ''}
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                    `;
                } else {
                    // Customer Message Bubble (Right)
                    html += `
                        <div class="flex flex-col items-end select-none">
                            <div class="max-w-[88%] sm:max-w-md bg-[#006830] text-white p-3 rounded-sm rounded-tr-none shadow-2xs space-y-1">
                                <div class="flex items-center justify-between gap-3 text-[10px] text-emerald-200/80 pb-1 border-b border-emerald-700">
                                    <span class="font-bold">Saya (Pembeli)</span>
                                    <span class="font-mono">${msg.created_at_formatted}</span>
                                </div>
                                <p class="text-xs leading-relaxed whitespace-pre-line">${msg.message}</p>
                            </div>
                        </div>
                    `;
                }
            });

            stream.innerHTML = html;
            stream.scrollTop = stream.scrollHeight;
        }

        // Submit Message Action
        function submitDiscussionMessage(e) {
            e.preventDefault();
            if (!currentDiscussionOrderNumber) return;

            const input = document.getElementById('orderDiscussionMessageInput');
            const msgText = input.value.trim();
            if (!msgText) return;

            const btn = document.getElementById('btnSendDiscussion');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i>';

            fetch(`/member/pesanan/${currentDiscussionOrderNumber}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: msgText })
            })
            .then(res => res.json())
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                if (data && data.success) {
                    input.value = '';
                    fetchDiscussionMessages(currentDiscussionOrderNumber, false);
                } else {
                    alert(data.message || 'Gagal mengirim pesan.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                console.error('Send message error:', err);
                alert('Gagal mengirim pesan. Silakan coba kembali.');
            });
        }

        // Direct WhatsApp Helper
        function openDirectWhatsAppForOrder() {
            if (!currentDiscussionOrderNumber) return;
            const waNumber = '6282116116133';
            const msg = `Halo Admin PERSIS PERS, saya ingin berdiskusi mengenai pesanan saya dengan No. Invoice *#${currentDiscussionOrderNumber}*. Mohon bantuannya ya kak. Terima kasih!`;
            window.open(`https://wa.me/${waNumber}?text=${encodeURIComponent(msg)}`, '_blank');
        }
    </script>

</body>
</html>
