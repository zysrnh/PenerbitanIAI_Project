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
                <a href="{{ url('/kontak') }}" class="p-4 bg-white hover:bg-slate-50 border border-slate-200/90 rounded-sm shadow-2xs transition group flex items-start gap-3.5">
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
</body>
</html>
