<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
    <title>@yield('title', 'PENERBIT PERSIS | Penerbitan & Percetakan IAI Persis Bandung')</title>

    <!-- Google Fonts Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            // Bikin semua utility hover: cuma aktif di device yang beneran punya
            // hover (mouse/trackpad). Ini yang nyegah tombol "nyangkut" dalam
            // kondisi hover abis di-tap di HP/tablet.
            future: {
                hoverOnlyWhenSupported: true,
            },
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
                        },
                        wa: {
                            500: '#25D366',
                            600: '#20bd5a',
                            700: '#128C7E',
                            800: '#075E54',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.06)', opacity: '0.9' },
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'pulse-soft': 'pulseSoft 2.5s infinite ease-in-out',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .hero-bg-overlay {
            background: linear-gradient(105deg, rgba(3, 44, 33, 0.95) 0%, rgba(3, 44, 33, 0.85) 55%, rgba(3, 44, 33, 0.60) 100%);
        }
        .reveal-card {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
        }
    
        /* User Icon & Auth Animations */
        @keyframes subtlePulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.15); opacity: 0.8; }
        }
        .animate-subtle-pulse {
            animation: subtlePulse 2.5s infinite ease-in-out;
        }
        .user-nav-btn {
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease, transform 0.15s ease;
        }
        .user-nav-btn i {
            transition: transform 0.2s ease;
        }
        /* Efek hover custom cuma jalan di device yang beneran punya hover
           (mouse/trackpad), biar ga nyangkut kepencet-terus di HP/tablet. */
        @media (hover: hover) and (pointer: fine) {
            .user-nav-btn:hover {
                box-shadow: 0 4px 12px rgba(0, 104, 48, 0.15);
            }
            .user-nav-btn:hover i {
                transform: scale(1.1);
            }
        }
        /* Feedback tekan instan di semua device (termasuk HP) biar tombol
           kerasa responsif pas ditap, ga cuma ngandelin hover. */
        .user-nav-btn:active {
            transform: scale(0.93);
        }
        .auth-dropdown-panel {
            transform-origin: top right;
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-white selection:bg-brand-800 selection:text-white flex flex-col min-h-screen">
<script>
    window.toggleMobileMenu = function(e) {
        if (e) {
            try { e.preventDefault(); e.stopPropagation(); } catch(err) {}
        }
        const drawer = document.getElementById('mobile-drawer');
        const icon = document.getElementById('mobileMenuIcon');
        if (!drawer) return;

        const isClosed = drawer.classList.contains('hidden') || drawer.style.display === 'none' || (window.getComputedStyle && window.getComputedStyle(drawer).display === 'none');

        if (isClosed) {
            drawer.style.display = 'block';
            drawer.classList.remove('hidden');
            if (icon) {
                icon.className = 'fa-solid fa-xmark text-lg pointer-events-none';
            }
        } else {
            drawer.style.display = 'none';
            drawer.classList.add('hidden');
            if (icon) {
                icon.className = 'fa-solid fa-bars text-lg pointer-events-none';
            }
        }
    };

    window.closeMobileMenu = function() {
        const drawer = document.getElementById('mobile-drawer');
        const icon = document.getElementById('mobileMenuIcon');
        if (drawer) {
            drawer.style.display = 'none';
            drawer.classList.add('hidden');
        }
        if (icon) {
            icon.className = 'fa-solid fa-bars text-lg pointer-events-none';
        }
    };

    
        // Admin Nav Dropdown Handler
        window.toggleAdminNavDropdown = function(e) {
            if (e) { e.preventDefault(); e.stopPropagation(); }
            const menu = document.getElementById('adminUserDropdownMenu');
            const chev = document.getElementById('adminDropdownChevron');
            if (!menu) return;

            const isHidden = menu.style.display === 'none' || menu.classList.contains('hidden');
            if (isHidden) {
                menu.style.display = 'block';
                menu.classList.remove('hidden');
                if (chev) chev.style.transform = 'rotate(180deg)';
            } else {
                menu.style.display = 'none';
                menu.classList.add('hidden');
                if (chev) chev.style.transform = 'rotate(0deg)';
            }
        };

        // Close Admin dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const container = document.getElementById('adminUserDropdownContainer');
            const menu = document.getElementById('adminUserDropdownMenu');
            const chev = document.getElementById('adminDropdownChevron');
            if (container && menu && !container.contains(e.target)) {
                menu.style.display = 'none';
                menu.classList.add('hidden');
                if (chev) chev.style.transform = 'rotate(0deg)';
            }
        });

        window.toggleMemberDropdown = function(e) {
        if (e) {
            try { e.preventDefault(); e.stopPropagation(); } catch(err) {}
        }
        const menu = document.getElementById('memberUserDropdownMenu');
        const chevron = document.getElementById('memberDropdownChevron');
        if (!menu) return;

        const isClosed = menu.classList.contains('hidden') || menu.style.display === 'none' || (window.getComputedStyle && window.getComputedStyle(menu).display === 'none');

        if (isClosed) {
            menu.style.display = 'block';
            menu.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
        } else {
            menu.style.display = 'none';
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    };

    document.addEventListener('click', function(e) {
        const memberContainer = document.getElementById('memberUserDropdownContainer');
        const memberMenu = document.getElementById('memberUserDropdownMenu');
        const memberChevron = document.getElementById('memberDropdownChevron');
        if (memberContainer && memberMenu && !memberContainer.contains(e.target)) {
            memberMenu.style.display = 'none';
            memberMenu.classList.add('hidden');
            if (memberChevron) memberChevron.classList.remove('rotate-180');
        }
    });
</script>


@php
    $navServicesRaw = \App\Models\SiteSetting::get('home_services_json', null);
    $navServices = $navServicesRaw ? json_decode($navServicesRaw, true) : [
        ['icon' => 'fa-solid fa-book-open', 'title' => 'Penerbitan Buku', 'link' => url('/#layanan')],
        ['icon' => 'fa-solid fa-copy', 'title' => 'Percetakan Umum', 'link' => url('/#layanan')],
        ['icon' => 'fa-solid fa-newspaper', 'title' => 'Jurnal & Majalah', 'link' => url('/#layanan')],
        ['icon' => 'fa-solid fa-graduation-cap', 'title' => 'Konversi KTI', 'link' => url('/#layanan')],
        ['icon' => 'fa-solid fa-barcode', 'title' => 'Pengurusan ISBN', 'link' => url('/#layanan')],
        ['icon' => 'fa-solid fa-box-open', 'title' => 'Cetak Custom', 'link' => url('/#layanan')],
    ];
    if (!is_array($navServices) || empty($navServices)) {
        $navServices = [
            ['icon' => 'fa-solid fa-book-open', 'title' => 'Penerbitan Buku', 'link' => url('/#layanan')],
            ['icon' => 'fa-solid fa-copy', 'title' => 'Percetakan Umum', 'link' => url('/#layanan')],
            ['icon' => 'fa-solid fa-newspaper', 'title' => 'Jurnal & Majalah', 'link' => url('/#layanan')],
            ['icon' => 'fa-solid fa-graduation-cap', 'title' => 'Konversi KTI', 'link' => url('/#layanan')],
            ['icon' => 'fa-solid fa-barcode', 'title' => 'Pengurusan ISBN', 'link' => url('/#layanan')],
            ['icon' => 'fa-solid fa-box-open', 'title' => 'Cetak Custom', 'link' => url('/#layanan')],
        ];
    }
@endphp


    <!-- Top Sticky Header -->
    <header class="sticky top-0 z-[1000] bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="flex items-center py-1 group" title="PERSIS PERS">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-10 sm:h-14 lg:h-16 w-auto object-contain transition-transform duration-200 group-hover:scale-105" />
                </a>

                <!-- Desktop Nav Menu -->
                <nav class="hidden lg:flex items-center gap-7">
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">BERANDA</a>
                    <a href="{{ route('tentang') }}" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">TENTANG KAMI</a>
                    
                    <div class="relative group">
                        <button class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition flex items-center gap-1 py-2 cursor-pointer">
                            LAYANAN <i class="fa-solid fa-chevron-down text-[10px] opacity-70 group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <div class="absolute left-0 top-full hidden group-hover:block w-64 bg-white border border-slate-200/90 rounded-sm shadow-xl py-1.5 z-50 animate-fade-in-up select-none">
                            @foreach($navServices as $ns)
                                <a href="{{ !empty($ns['link']) ? (str_starts_with($ns['link'], 'http') || str_starts_with($ns['link'], '/') ? $ns['link'] : url('/' . $ns['link'])) : url('/#layanan') }}" 
                                   class="flex items-center gap-2.5 px-3.5 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-emerald-900 transition">
                                    <i class="{{ $ns['icon'] ?? 'fa-solid fa-circle-check' }} text-emerald-600 text-xs w-4 shrink-0 text-center"></i>
                                    <span class="truncate">{{ $ns['title'] ?? 'Layanan' }}</span>
                                </a>
                            @endforeach
                            <div class="border-t border-slate-100 mt-1 pt-1 px-3.5 py-1.5 bg-slate-50">
                                <a href="{{ url('/#layanan') }}" class="text-[10.5px] font-bold text-emerald-700 hover:text-emerald-900 flex items-center justify-between">
                                    <span>Lihat Semua Layanan &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">KATALOG BUKU</a>
                    <a href="{{ url('/kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">KONTAK</a>
                </nav>

                <!-- Header Action Buttons (100% Unified Clean Style for All Logged-in Users) -->
                <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                    @auth
                        {{-- 1. Shopping Cart Button --}}
                        <button type="button" 
                                onclick="window.openCartDrawer()" 
                                class="user-nav-btn relative w-10 h-10 rounded-sm flex items-center justify-center bg-white hover:bg-emerald-50 active:bg-emerald-100 border border-slate-200 hover:border-emerald-600 text-slate-700 hover:text-emerald-800 shadow-2xs cursor-pointer transition select-none shrink-0"
                                title="Keranjang Belanja">
                            <i class="fa-solid fa-cart-shopping text-sm pointer-events-none text-emerald-800"></i>
                            <span id="navCartBadge" class="hidden absolute -top-1 -right-1 min-w-[17px] h-[17px] px-1 bg-[#006830] text-white rounded-full text-[9px] font-black flex items-center justify-center border border-white shadow-xs pointer-events-none">
                                0
                            </span>
                        </button>

                        {{-- 2. Clean User / Admin Profile Button (Identical Light Pill Style) --}}
                        <div class="relative group" id="memberUserDropdownContainer">
                            <button type="button" 
                                    id="memberUserDropdownBtn"
                                    onclick="window.toggleMemberDropdown(event)" 
                                    class="user-nav-btn w-10 sm:w-auto h-10 rounded-sm flex items-center justify-center sm:justify-start gap-2 px-0 sm:px-2.5 bg-white hover:bg-emerald-50 active:bg-emerald-100 border border-slate-200 hover:border-emerald-600 shadow-2xs cursor-pointer transition select-none shrink-0"
                                    title="Menu Akun">
                                <div class="w-6 h-6 rounded-full overflow-hidden shrink-0 border border-emerald-600 shadow-2xs pointer-events-none">
                                    @if(Auth::user()->avatar_url)
                                        <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover pointer-events-none" />
                                    @else
                                        <div class="w-full h-full bg-[#006830] flex items-center justify-center text-white text-[9.5px] font-black pointer-events-none">
                                            {{ Auth::user()->initials }}
                                        </div>
                                    @endif
                                </div>
                                <span class="hidden sm:inline text-xs font-bold text-slate-800 max-w-[90px] truncate leading-tight pointer-events-none">
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </span>
                                <i id="memberDropdownChevron" class="hidden sm:inline fa-solid fa-chevron-down text-[8px] text-slate-400 group-hover:text-emerald-700 transition-transform duration-200 pointer-events-none"></i>
                            </button>

                            <!-- Clean Dropdown Menu for Both Member & Admin -->
                            <div id="memberUserDropdownMenu" class="absolute right-0 top-full pt-2 hidden w-56 z-50" style="display: none;">
                                <div class="auth-dropdown-panel bg-white border border-slate-200 rounded-sm shadow-2xl p-2 animate-fade-in-up select-none">
                                    <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                        <p class="text-xs font-extrabold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-[10px] text-emerald-700 font-medium truncate">{{ Auth::user()->email }}</p>
                                    </div>

                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-gauge-high text-emerald-600 text-xs w-4"></i> Dashboard Admin
                                        </a>
                                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-user text-slate-400 text-xs w-4"></i> Profil Saya
                                        </a>
                                        <button type="button" onclick="window.openCartDrawer()" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition text-left cursor-pointer">
                                            <i class="fa-solid fa-cart-shopping text-emerald-600 text-xs w-4"></i> Keranjang Belanja
                                        </button>
                                        <div class="border-t border-slate-100 mt-1 pt-1">
                                            <form method="POST" action="{{ route('admin.logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-sm transition cursor-pointer">
                                                    <i class="fa-solid fa-right-from-bracket text-xs w-4"></i> Keluar Akun
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-gauge-high text-emerald-600 text-xs w-4"></i> Dashboard
                                        </a>
                                        <a href="{{ route('member.profile') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-user text-slate-400 text-xs w-4"></i> Profil Saya
                                        </a>
                                        <button type="button" onclick="window.openCartDrawer()" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition text-left cursor-pointer">
                                            <i class="fa-solid fa-cart-shopping text-emerald-600 text-xs w-4"></i> Keranjang Belanja
                                        </button>
                                        <div class="border-t border-slate-100 mt-1 pt-1">
                                            <form method="POST" action="{{ route('member.logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-sm transition cursor-pointer">
                                                    <i class="fa-solid fa-right-from-bracket text-xs w-4"></i> Keluar Akun
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Desktop Only "Masuk" Button (Hidden on Mobile phone screen) --}}
                        <a href="{{ route('member.login') }}" 
                           class="hidden sm:flex h-10 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition-all duration-200 items-center gap-1.5 shadow-xs hover:shadow-md cursor-pointer select-none">
                            <i class="fa-solid fa-right-to-bracket text-xs text-emerald-300 pointer-events-none"></i>
                            <span>Masuk</span>
                        </a>
                    @endauth

                    <!-- 3. Mobile Menu Button (Hamburger - Identical 40x40 Square Box) -->
                    <button id="mobile-menu-btn" 
                            type="button"
                            onclick="window.toggleMobileMenu(event)" 
                            class="lg:hidden w-10 h-10 rounded-sm border border-slate-200 bg-white text-slate-800 hover:bg-emerald-50 active:bg-emerald-100 hover:text-emerald-800 flex items-center justify-center focus:outline-none transition-colors cursor-pointer shadow-2xs shrink-0 select-none"
                            aria-label="Buka Menu Navigasi">
                        <i id="mobileMenuIcon" class="fa-solid fa-bars text-base pointer-events-none text-slate-800"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-drawer" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 animate-fade-in-up shadow-lg">
            <a href="{{ url('/') }}" onclick="window.closeMobileMenu()" class="block px-3.5 py-2.5 rounded-sm text-xs font-bold uppercase tracking-wider {{ request()->is('/') ? 'bg-emerald-50 text-brand-900' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-house text-emerald-700 text-xs mr-2 w-4"></i> Beranda
            </a>
            <a href="{{ route('tentang') }}" onclick="window.closeMobileMenu()" class="block px-3.5 py-2.5 rounded-sm text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">
                <i class="fa-solid fa-building text-emerald-700 text-xs mr-2 w-4"></i> Tentang Kami
            </a>
            <a href="{{ url('/#layanan') }}" onclick="window.closeMobileMenu()" class="block px-3.5 py-2.5 rounded-sm text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">
                <i class="fa-solid fa-list-check text-emerald-700 text-xs mr-2 w-4"></i> Layanan Penerbitan
            </a>
            <a href="{{ route('katalog') }}" onclick="window.closeMobileMenu()" class="block px-3.5 py-2.5 rounded-sm text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">
                <i class="fa-solid fa-book-open text-emerald-700 text-xs mr-2 w-4"></i> Katalog Buku
            </a>
            <a href="{{ url('/kontak') }}" onclick="window.closeMobileMenu()" class="block px-3.5 py-2.5 rounded-sm text-xs font-bold uppercase tracking-wider {{ request()->routeIs('kontak') ? 'bg-emerald-50 text-brand-900' : 'text-slate-700 hover:bg-slate-50' }}">
                <i class="fa-solid fa-headset text-emerald-700 text-xs mr-2 w-4"></i> Kontak Redaksi
            </a>

            <div class="pt-3 border-t border-slate-100 space-y-2">
                @auth
                    <div class="px-3 py-2 bg-emerald-50 rounded-sm flex items-center gap-2.5 mb-2 border border-emerald-200">
                        @if(Auth::user()->avatar_url)
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-emerald-600 shrink-0" />
                        @else
                            <div class="w-8 h-8 rounded-full bg-[#006830] flex items-center justify-center text-white text-xs font-black shrink-0">
                                {{ Auth::user()->initials }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-emerald-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 font-medium">{{ Auth::user()->role === 'member' ? 'Member Aktif' : Auth::user()->role_label }}</p>
                        </div>
                    </div>
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                        <a href="{{ route('admin.dashboard') }}" class="w-full py-2.5 bg-[#006830] text-white rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-2xs">
                            <i class="fa-solid fa-gauge-high text-emerald-300"></i> Dashboard Admin
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 border border-red-200 text-red-600 rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-red-50 cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket text-xs"></i> Keluar Akun
                            </button>
                        </form>
                    @else
                        <a href="{{ route('member.dashboard') }}" class="w-full py-2.5 bg-[#006830] text-white rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-2xs">
                            <i class="fa-solid fa-gauge-high text-emerald-300"></i> Dashboard Saya
                        </a>
                        <form method="POST" action="{{ route('member.logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 border border-red-200 text-red-600 rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-red-50 cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket text-xs"></i> Keluar Akun
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('member.login') }}" class="w-full py-2.5 border border-slate-300 text-slate-700 rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-slate-50 shadow-2xs">
                        <i class="fa-solid fa-right-to-bracket text-xs text-emerald-700"></i> Masuk Akun
                    </a>
                    <a href="{{ route('member.register') }}" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-2xs">
                        <i class="fa-solid fa-user-plus text-xs text-lime-300"></i> Daftar Member Baru
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Floating WhatsApp Button -->
    @php
        $waNum = \App\Models\SiteSetting::get('contact_whatsapp', '082116116133');
        $cleanWa = preg_replace('/[^0-9]/', '', $waNum);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }
        $waQuickUrl = "https://wa.me/{$cleanWa}?text=" . urlencode("Halo Tim Redaksi PERSIS PERS, saya ingin konsultasi penerbitan/percetakan.");
    @endphp
    <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 group flex items-center gap-2">
        <a 
            href="{{ $waQuickUrl }}" 
            target="_blank" 
            title="Hubungi WhatsApp Redaksi"
            class="w-11 h-11 sm:w-14 sm:h-14 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-full flex items-center justify-center text-2xl shadow-xl hover:scale-110 active:scale-95 transition-all duration-300 animate-pulse-soft"
        >
            <i class="fa-brands fa-whatsapp text-2xl sm:text-3xl"></i>
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-brand-950 text-slate-300 pt-16 pb-12 border-t border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-slate-800">
                
                <!-- Brand Info -->
                <div class="md:col-span-4 space-y-4">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" title="PENERBIT PERSIS">
                            <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-14 sm:h-16 w-auto object-contain" />
                        </a>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Penerbitan & Percetakan Resmi PENERBIT PERSIS. Melayani penerbitan buku ber-ISBN resmi, modul ajar perkuliahan, monograf riset, jurnal ilmiah, dan percetakan standar UNESCO berkualitas tinggi.
                    </p>
                </div>

                <!-- Navigation -->
                <div class="md:col-span-2 space-y-3">
                    <h5 class="text-xs font-bold text-white uppercase tracking-wider">Navigasi</h5>
                    <ul class="space-y-2 text-xs text-slate-400">
                        <li><a href="{{ url('/') }}" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                        <li><a href="{{ url('/#layanan') }}" class="hover:text-emerald-400 transition">Layanan</a></li>
                        <li><a href="{{ url('/#katalog') }}" class="hover:text-emerald-400 transition">Katalog Buku</a></li>
                        <li><a href="{{ url('/kontak') }}" class="hover:text-emerald-400 transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services (Dynamic from Settings) -->
                <div class="md:col-span-3 space-y-3">
                    <h5 class="text-xs font-bold text-white uppercase tracking-wider">Layanan Utama</h5>
                    <ul class="space-y-2 text-xs text-slate-400">
                        @foreach(array_slice($navServices, 0, 5) as $ns)
                            <li>
                                <a href="{{ !empty($ns['link']) ? (str_starts_with($ns['link'], 'http') || str_starts_with($ns['link'], '/') ? $ns['link'] : url('/' . $ns['link'])) : url('/#layanan') }}" class="hover:text-emerald-400 transition flex items-center gap-1.5">
                                    <i class="fa-solid fa-angle-right text-[9px] text-emerald-500"></i>
                                    <span>{{ $ns['title'] ?? 'Layanan' }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="md:col-span-3 space-y-3">
                    <h5 class="text-xs font-bold text-white uppercase tracking-wider">Kontak Redaksi</h5>
                    <div class="space-y-2 text-xs text-slate-400">
                        <p class="flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-emerald-400 mt-1 shrink-0"></i>
                            <span>{{ \App\Models\SiteSetting::get('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung') }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-400 shrink-0"></i>
                            <span>{{ \App\Models\SiteSetting::get('contact_whatsapp', '+62 821-1611-6133') }}</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-emerald-400 shrink-0"></i>
                            <span>{{ \App\Models\SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id') }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} PENERBIT PERSIS - Penerbitan &amp; Percetakan IAI PERSIS Bandung. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-400 transition flex items-center gap-1">
                        <i class="fa-solid fa-lock text-[10px]"></i> Login Admin
                    </a>
                </div>
            </div>
        </div>
    </footer>

    

    <!-- ========================================================================= -->
    <!-- GLOBAL SHOPPING CART (BOTTOM-SHEET ON MOBILE, SIDE-DRAWER ON DESKTOP) -->
    <!-- ========================================================================= -->
    <div id="globalCartDrawer" class="fixed inset-0 z-[9999] hidden items-end sm:items-stretch sm:justify-end" style="display: none;">
        <!-- Backdrop -->
        <div id="cartDrawerBackdrop" onclick="window.closeCartDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>

        <!-- Panel (Mobile: Bottom Sheet with rounded top, Desktop: Right Sidebar) -->
        <div id="cartDrawerPanel" class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl rounded-t-2xl sm:rounded-none flex flex-col max-h-[85vh] sm:max-h-full sm:h-full transform translate-y-full sm:translate-y-0 sm:translate-x-full transition-transform duration-300 ease-out border-t sm:border-t-0 sm:border-l border-slate-200">
            
            <!-- Mobile Pull Handle -->
            <div class="sm:hidden w-full pt-3 pb-1 flex justify-center cursor-pointer select-none" onclick="window.closeCartDrawer()">
                <div class="w-10 h-1 bg-slate-300 rounded-full"></div>
            </div>

            <!-- Drawer Header -->
            <div class="px-5 py-3.5 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-950 select-none rounded-t-xl sm:rounded-none">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-sm bg-emerald-600/30 text-emerald-300 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm font-heading flex items-center gap-1.5">
                            Keranjang Belanja
                            <span id="cartDrawerCountBadge" class="text-xs font-semibold text-emerald-300 font-mono"></span>
                        </h3>
                        <p class="text-[10px] text-emerald-200/70">Koleksi Terbitan PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeCartDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Keranjang">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Drawer Body: Items List -->
            <div id="cartDrawerItemsList" class="flex-1 overflow-y-auto p-4 sm:p-5 space-y-3">
                <!-- Items Injected by renderCartDrawerUI -->
            </div>

            <!-- Drawer Footer: Subtotal & Professional Actions -->
            <div id="cartDrawerFooter" class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50 space-y-3">
                <div class="space-y-1.5 text-xs">
                    <div class="flex justify-between text-slate-500">
                        <span>Total Jumlah Item:</span>
                        <span id="cartDrawerTotalItemsText" class="font-bold text-slate-800">0 Eksemplar</span>
                    </div>
                    <div class="flex justify-between text-slate-900 text-sm font-bold pt-1.5 border-t border-slate-200">
                        <span>Total Pembayaran:</span>
                        <span id="cartDrawerSubtotal" class="font-mono font-black text-emerald-800 text-base">Rp 0</span>
                    </div>
                </div>

                <!-- Professional Action Buttons -->
                <div class="space-y-2 select-none">
                    <!-- Tombol 1: Checkout & Pembayaran Resmi -->
                    <button type="button" 
                            onclick="window.openCheckoutModal()"
                            class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs sm:text-sm font-bold shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-shield-check text-sm text-lime-300"></i>
                        <span>Lanjut ke Pembayaran</span>
                    </button>

                    <!-- Tombol 2: Konsultasi via WhatsApp -->
                    <button type="button" 
                            onclick="window.checkoutCartViaWhatsApp()"
                            class="w-full py-2 px-4 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-2xs">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i>
                        <span>Pesan via WhatsApp</span>
                    </button>

                    <div class="flex items-center justify-between pt-1">
                        <button type="button" 
                                onclick="window.clearCart()" 
                                class="text-[11px] text-red-600 hover:text-red-800 font-medium flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-trash-can text-[9px]"></i>
                            <span>Kosongkan Keranjang</span>
                        </button>

                        <button type="button" 
                                onclick="window.closeCartDrawer()" 
                                class="text-[11px] text-slate-500 hover:text-emerald-800 font-medium cursor-pointer">
                            Lanjut Pilih Buku &rarr;
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- LOGIN PROMPT MODAL (FOR GUEST USERS) WITH ULTRA-SMOOTH ANIMATION -->
    <!-- ========================================================================= -->
    <div id="loginPromptModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none" style="display: none;" onclick="if(event.target === this) window.closeLoginPromptModal()">
        <div id="loginPromptModalCard" class="bg-white rounded-sm border border-slate-100 shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 translate-y-4 opacity-0 transition-all duration-300 ease-out space-y-4">
            <div class="w-14 h-14 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-2xl mx-auto shadow-2xs">
                <i class="fa-solid fa-user-lock"></i>
            </div>
            <div>
                <h3 class="font-extrabold text-slate-900 text-base font-heading">Perlu Masuk Akun Member</h3>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Silakan masuk ke akun member Anda terlebih dahulu untuk menambahkan buku ke keranjang belanja dan melakukan pemesanan.
                </p>
            </div>
            <div class="space-y-2 pt-2">
                <a href="{{ route('member.login') }}?redirect={{ urlencode(request()->fullUrl()) }}" 
                   class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs rounded-sm transition shadow-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    <span>Masuk Akun Member</span>
                </a>
                <a href="{{ route('member.register') }}" 
                   class="w-full py-2.5 px-4 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-300 font-bold text-xs rounded-sm transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus text-xs text-emerald-700"></i>
                    <span>Daftar Akun Baru (Gratis)</span>
                </a>
                <button type="button" onclick="window.closeLoginPromptModal()" class="w-full py-1.5 text-xs text-slate-400 hover:text-slate-600 font-medium transition cursor-pointer">
                    Nanti Saja
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- CART TOAST NOTIFICATION (Clean bottom placement, never blocks header) -->
    <!-- ========================================================================= -->
    <div id="cartToastNotification" class="fixed bottom-6 left-4 right-4 sm:left-auto sm:right-6 z-[999] transform translate-y-8 transition-all duration-300 opacity-0 pointer-events-none max-w-sm hidden" style="display: none;">
        <div class="p-3.5 bg-slate-900 text-white rounded-sm shadow-2xl border-l-4 border-emerald-500 flex items-center justify-between gap-3 pointer-events-auto">
            <div class="flex items-center gap-2.5 min-w-0">
                <i id="cartToastIcon" class="fa-solid fa-circle-check text-emerald-400 text-lg shrink-0"></i>
                <p id="cartToastMsg" class="text-xs font-semibold text-slate-100 truncate">Buku berhasil ditambahkan!</p>
            </div>
            <button type="button" onclick="window.openCartDrawer()" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10.5px] rounded-xs shrink-0 transition cursor-pointer">
                Lihat
            </button>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- GLOBAL CART & MODAL JAVASCRIPT ENGINE -->
    <!-- ========================================================================= -->
    <script>
        window.PERSIS_CART = {
            isLoggedIn: @json(Auth::check()),
            userName: @json(Auth::check() ? Auth::user()->name : ''),
            contactWa: @json(\App\Models\SiteSetting::get('contact_whatsapp', '6282116116133')),
            routes: {
                get: @json(Auth::check() ? route('member.cart.index') : null),
                add: @json(Auth::check() ? route('member.cart.add') : null),
                update: '/member/cart/update/',
                remove: '/member/cart/remove/',
                clear: @json(Auth::check() ? route('member.cart.clear') : null),
                checkoutQris: @json(Auth::check() ? route('member.cart.checkout.qris') : null),
                orderStatus: '/order/status/',
            },
            data: {
                count: 0,
                total: 0,
                formatted_total: 'Rp 0',
                items: []
            }
        };

        // Open & Close Login Prompt Modal
        window.openLoginPromptModal = function() {
            const m = document.getElementById('loginPromptModal');
            const card = document.getElementById('loginPromptModalCard');
            if (m && card) {
                m.style.display = 'flex';
                m.classList.remove('hidden', 'pointer-events-none');
                m.classList.add('flex');
                setTimeout(() => {
                    m.classList.remove('opacity-0');
                    m.classList.add('opacity-100');
                    card.classList.remove('scale-95', 'translate-y-4', 'opacity-0');
                    card.classList.add('scale-100', 'translate-y-0', 'opacity-100');
                }, 10);
            }
        };

        window.closeLoginPromptModal = function() {
            const m = document.getElementById('loginPromptModal');
            const card = document.getElementById('loginPromptModalCard');
            if (m && card) {
                m.classList.remove('opacity-100');
                m.classList.add('opacity-0');
                card.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
                card.classList.add('scale-95', 'translate-y-4', 'opacity-0');
                setTimeout(() => {
                    m.style.display = 'none';
                    m.classList.add('hidden', 'pointer-events-none');
                    m.classList.remove('flex');
                }, 280);
            }
        };

        // Open & Close Cart Drawer (Bottom-sheet on mobile, Side-drawer on desktop)
        window.openCartDrawer = function() {
            const drawer = document.getElementById('globalCartDrawer');
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
                drawer.style.display = 'flex';
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-y-full', 'sm:translate-x-full');
                    panel.classList.add('translate-y-0', 'sm:translate-x-0');
                }, 10);
                if (window.PERSIS_CART.isLoggedIn) {
                    window.fetchCartData();
                } else {
                    window.renderCartDrawerUI({ items: [], count: 0, total: 0, formatted_total: 'Rp 0' });
                }
            }
        };

        window.closeCartDrawer = function() {
            const drawer = document.getElementById('globalCartDrawer');
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-y-full', 'sm:translate-x-full');
                panel.classList.remove('translate-y-0', 'sm:translate-x-0');
                setTimeout(() => {
                    drawer.style.display = 'none';
                    drawer.classList.add('hidden');
                }, 300);
            }
        };

        // Show Toast (Safe bottom pop-in)
        window.showCartToast = function(msg, isSuccess = true) {
            const toast = document.getElementById('cartToastNotification');
            const toastMsg = document.getElementById('cartToastMsg');
            const toastIcon = document.getElementById('cartToastIcon');
            if (!toast || !toastMsg) return;

            toastMsg.textContent = msg;
            if (isSuccess) {
                toastIcon.className = 'fa-solid fa-circle-check text-emerald-400 text-lg shrink-0';
            } else {
                toastIcon.className = 'fa-solid fa-circle-exclamation text-amber-400 text-lg shrink-0';
            }

            toast.style.display = 'block';
            toast.classList.remove('hidden', 'translate-y-8', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-8', 'opacity-0');
                setTimeout(() => {
                    toast.style.display = 'none';
                    toast.classList.add('hidden');
                }, 300);
            }, 3000);
        };

        // Fetch Cart Data
        window.fetchCartData = function() {
            if (!window.PERSIS_CART.isLoggedIn || !window.PERSIS_CART.routes.get) return;

            fetch(window.PERSIS_CART.routes.get)
                .then(res => res.json())
                .then(data => {
                    if (data && data.success) {
                        window.PERSIS_CART.data = data;
                        window.renderCartDrawerUI(data);
                        window.updateCartBadges(data.count);
                    }
                })
                .catch(err => console.error('Error fetching cart:', err));
        };

        // Update Badges
        window.updateCartBadges = function(count) {
            const navBadge = document.getElementById('navCartBadge');
            const floatingBadge = document.getElementById('floatingCartBadge');

            if (navBadge) {
                if (count > 0) {
                    navBadge.textContent = count;
                    navBadge.classList.remove('hidden');
                } else {
                    navBadge.classList.add('hidden');
                }
            }

            if (floatingBadge) {
                if (count > 0) {
                    floatingBadge.textContent = count;
                    floatingBadge.classList.remove('hidden');
                } else {
                    floatingBadge.classList.add('hidden');
                }
            }
        };

        // Render Cart Drawer HTML UI (Flawless item cards rendering)
        window.renderCartDrawerUI = function(data) {
            const listContainer = document.getElementById('cartDrawerItemsList');
            const footerContainer = document.getElementById('cartDrawerFooter');
            const subtotalText = document.getElementById('cartDrawerSubtotal');
            const totalItemsText = document.getElementById('cartDrawerTotalItemsText');
            const countBadge = document.getElementById('cartDrawerCountBadge');

            if (!listContainer) return;

            if (countBadge) {
                countBadge.textContent = data.count > 0 ? `(${data.count})` : '';
            }
            if (totalItemsText) {
                totalItemsText.textContent = `${data.count || 0} Eksemplar`;
            }
            if (subtotalText) {
                subtotalText.textContent = data.formatted_total || 'Rp 0';
            }

            if (!data.items || data.items.length === 0) {
                listContainer.innerHTML = `
                    <div class="py-12 px-4 text-center space-y-3">
                        <div class="w-14 h-14 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-2xs border border-emerald-100">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-800">Keranjang Belanja Masih Kosong</h4>
                            <p class="text-xs text-slate-500 mt-1">Temukan buku terbitan terbaik PERSIS PERS di katalog.</p>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('katalog') }}" onclick="window.closeCartDrawer()" class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-xs">
                                <i class="fa-solid fa-book-open text-xs text-emerald-300"></i>
                                <span>Lihat Katalog Buku</span>
                            </a>
                        </div>
                    </div>
                `;
                if (footerContainer) footerContainer.classList.add('hidden');
                return;
            }

            if (footerContainer) footerContainer.classList.remove('hidden');

            let html = '';
            data.items.forEach(item => {
                const cover = item.cover_url || (item.book && item.book.cover_image ? `/storage/${item.book.cover_image}` : 'https://placehold.co/100x140?text=No+Cover');
                const title = item.title || (item.book ? item.book.title : 'Buku Terbitan');
                const author = item.author || (item.book && item.book.author ? item.book.author : 'Penulis PERSIS');
                const price = item.formatted_price;
                const subtotal = item.formatted_subtotal;

                html += `
                <div class="p-3 bg-white border border-slate-200 rounded-sm hover:border-emerald-500 transition-colors shadow-2xs flex gap-3 group relative select-none">
                    <img src="${cover}" alt="${title}" class="w-14 h-20 object-cover rounded-xs shadow-xs border border-slate-200 shrink-0 bg-slate-100" />
                    <div class="flex-grow min-w-0 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="font-bold text-xs text-slate-800 line-clamp-1 group-hover:text-emerald-800 transition" title="${title}">${title}</h4>
                                <button type="button" onclick="window.removeCartItem(${item.id})" class="text-slate-400 hover:text-red-500 text-xs p-1 -mr-1 transition cursor-pointer" title="Hapus">
                                    <i class="fa-solid fa-trash-can pointer-events-none"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-slate-500 font-mono mt-0.5 truncate">${author}</p>
                            <p class="text-xs font-black text-emerald-700 mt-1 font-mono">${price}</p>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100 mt-2">
                            <div class="flex items-center border border-slate-200 rounded-xs bg-slate-50">
                                <button type="button" onclick="window.updateCartItemQty(${item.id}, -1)" class="w-6 h-6 flex items-center justify-center text-slate-600 hover:bg-slate-200 text-xs transition active:scale-95 cursor-pointer" title="Kurang">-</button>
                                <span id="cart-item-qty-${item.id}" class="w-7 text-center font-bold text-xs font-mono text-slate-800">${item.quantity}</span>
                                <button type="button" onclick="window.updateCartItemQty(${item.id}, 1)" class="w-6 h-6 flex items-center justify-center text-slate-600 hover:bg-slate-200 text-xs transition active:scale-95 cursor-pointer" title="Tambah">+</button>
                            </div>
                            <span id="cart-item-subtotal-${item.id}" class="text-xs font-extrabold text-slate-900 font-mono">${subtotal}</span>
                        </div>
                    </div>
                </div>
                `;
            });

            listContainer.innerHTML = html;
        };

        // Add to Cart Action
        window.addToCart = function(bookId, quantity = 1, autoOpen = true) {
            if (!window.PERSIS_CART.isLoggedIn) {
                window.openLoginPromptModal();
                return;
            }

            fetch(window.PERSIS_CART.routes.add, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    book_id: bookId,
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    window.PERSIS_CART.data = data;
                    window.updateCartBadges(data.count);
                    window.renderCartDrawerUI(data);
                    window.showCartToast(data.message || 'Buku berhasil ditambahkan ke keranjang!');
                    if (autoOpen) {
                        window.openCartDrawer();
                    }
                } else {
                    window.showCartToast(data.message || 'Gagal menambahkan ke keranjang.', false);
                }
            })
            .catch(err => {
                console.error('Error adding to cart:', err);
                window.showCartToast('Gagal menambahkan ke keranjang.', false);
            });
        };

        // Update Item Qty (Optimistic UI)
        window.updateCartItemQty = function(cartItemId, change) {
            if (!window.PERSIS_CART.data || !window.PERSIS_CART.data.items) return;
            const item = window.PERSIS_CART.data.items.find(i => i.id === cartItemId);
            if (!item) return;

            const newQty = item.quantity + change;
            if (newQty <= 0) {
                window.removeCartItem(cartItemId);
                return;
            }

            item.quantity = newQty;
            const qtyElem = document.getElementById(`cart-item-qty-${cartItemId}`);
            if (qtyElem) qtyElem.textContent = newQty;

            fetch(window.PERSIS_CART.routes.update + cartItemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQty })
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    window.PERSIS_CART.data = data;
                    window.renderCartDrawerUI(data);
                    window.updateCartBadges(data.count);
                }
            })
            .catch(err => {
                console.error('Error updating item qty:', err);
                window.fetchCartData();
            });
        };

        // Remove Item (Instant & Reliable)
        window.removeCartItem = function(cartItemId) {
            fetch(window.PERSIS_CART.routes.remove + cartItemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'DELETE'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    window.PERSIS_CART.data = data;
                    window.renderCartDrawerUI(data);
                    window.updateCartBadges(data.count);
                    window.showCartToast('Item berhasil dihapus dari keranjang.');
                } else {
                    window.fetchCartData();
                }
            })
            .catch(err => {
                console.error('Error removing item:', err);
                window.fetchCartData();
            });
        };

        // Clear All Items (Instant & Reliable)
        window.clearCart = function() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan seluruh keranjang belanja?')) return;

            fetch(window.PERSIS_CART.routes.clear, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-HTTP-Method-Override': 'DELETE'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    window.PERSIS_CART.data = data;
                    window.renderCartDrawerUI(data);
                    window.updateCartBadges(0);
                    window.showCartToast('Keranjang belanja telah dikosongkan.');
                } else {
                    window.fetchCartData();
                }
            })
            .catch(err => {
                console.error('Error clearing cart:', err);
                window.fetchCartData();
            });
        };

        // Auto load cart badge on page ready
        document.addEventListener('DOMContentLoaded', function() {
            if (window.PERSIS_CART.isLoggedIn) {
                window.fetchCartData();
            }
        });
    </script>

    <!-- ========================================================================= -->
    <!-- CHECKOUT & LIVE QRIS AUTO-PAYMENT MODAL (CLEAN & FORMAL) -->
    <!-- ========================================================================= -->
    <div id="checkoutQrisModal" class="fixed inset-0 z-[99999] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-xs transition-opacity duration-200 opacity-0 pointer-events-none" style="display: none;">
        <div id="checkoutQrisModalCard" class="bg-white rounded-sm border border-slate-300 shadow-xl max-w-md w-full overflow-hidden transform scale-98 opacity-0 transition-all duration-200 ease-out flex flex-col max-h-[92vh]">
            
            <!-- Modal Header -->
            <div class="px-5 py-3 bg-[#032c21] text-white flex items-center justify-between border-b border-emerald-950 shrink-0 select-none">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-xs bg-emerald-600/30 text-emerald-300 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <h4 id="checkoutModalTitle" class="text-sm font-bold font-heading">Checkout Pengiriman</h4>
                        <p id="checkoutModalSubtitle" class="text-[10px] text-emerald-200/70">Penerbitan Resmi PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeCheckoutModal()" class="w-7 h-7 rounded-xs text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- STEP 1: FORM DATA PEMESAN & ALAMAT -->
            <div id="checkoutStepForm" class="p-5 overflow-y-auto space-y-3 flex-1 text-xs">
                <div class="border-b border-slate-200 pb-2">
                    <h5 class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Data Penerima Buku</h5>
                    <p class="text-[10.5px] text-slate-400">Pastikan nomor WhatsApp dan alamat pengiriman sudah lengkap.</p>
                </div>

                <div class="space-y-2.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nama Lengkap Penerima <span class="text-red-500">*</span></label>
                        <input type="text" id="chkCustomerName" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Nama penerima paket" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition" required />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">No. WhatsApp <span class="text-red-500">*</span></label>
                            <input type="tel" id="chkCustomerPhone" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition" required />
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Email <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input type="email" id="chkCustomerEmail" value="{{ Auth::check() ? Auth::user()->email : '' }}" placeholder="email@contoh.com" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Alamat Lengkap Pengiriman <span class="text-red-500">*</span></label>
                        <textarea id="chkCustomerAddress" rows="2" placeholder="Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition" required></textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Catatan Tambahan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" id="chkCustomerNotes" placeholder="Contoh: Titip di satpam / pos perumahan" class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-xs text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition" />
                    </div>
                </div>

                <!-- Order Total Summary -->
                <div class="p-3 bg-slate-50 rounded-xs border border-slate-200 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Total Belanja</p>
                        <p id="chkTotalSummaryText" class="text-sm font-bold text-slate-900 font-mono">Rp 0</p>
                    </div>
                    <span class="text-[10.5px] font-semibold text-emerald-800 flex items-center gap-1">
                        <i class="fa-solid fa-qrcode text-emerald-700"></i> QRIS Realtime
                    </span>
                </div>

                <div class="pt-1">
                    <button type="button" 
                            id="btnProcessQris"
                            onclick="window.submitCheckoutQris()" 
                            class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-qrcode text-sm text-lime-300"></i>
                        <span>Lanjut ke Pembayaran QRIS &rarr;</span>
                    </button>
                </div>
            </div>

            <!-- STEP 2: LIVE DYNAMIC QRIS SCREEN -->
            <div id="checkoutStepQris" class="p-5 overflow-y-auto space-y-3 flex-1 hidden text-center text-xs">
                
                <!-- Status Banner -->
                <div id="qrisStatusBanner" class="p-2.5 bg-emerald-50 border border-emerald-200 rounded-xs flex items-center justify-center gap-2 text-xs font-semibold text-emerald-900">
                    <i class="fa-solid fa-spinner fa-spin text-emerald-700"></i>
                    <span>Menunggu pembayaran... (Terdeteksi otomatis)</span>
                </div>

                <!-- QRIS Box -->
                <div class="bg-white p-3.5 rounded-xs border border-slate-300 shadow-2xs inline-block mx-auto max-w-[250px] w-full">
                    <div class="flex items-center justify-between mb-1 pb-1 border-b border-slate-100">
                        <span class="text-[10px] font-bold text-slate-800 font-heading">QRIS RESMI</span>
                        <span class="text-[9px] font-bold text-emerald-800">PERSIS PERS</span>
                    </div>
                    
                    <div class="relative aspect-square w-full bg-slate-50 rounded-xs overflow-hidden flex items-center justify-center border border-slate-200">
                        <img id="qrisImageDisplay" src="" alt="QRIS Code" class="w-full h-full object-contain p-1" />
                    </div>

                    <div class="mt-1.5 text-center">
                        <p class="text-[9.5px] text-slate-500">Scan via BCA, Mandiri, BRI, BNI, BSI, DANA, GoPay, OVO, ShopeePay</p>
                    </div>
                </div>

                <!-- Amount Details -->
                <div class="p-3 bg-slate-50 rounded-xs border border-slate-200 text-left space-y-1 text-xs max-w-xs mx-auto">
                    <div class="flex justify-between text-slate-600">
                        <span>No. Invoice:</span>
                        <span id="qrisOrderNumber" class="font-bold font-mono text-slate-800">-</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Subtotal:</span>
                        <span id="qrisSubtotalText" class="font-mono text-slate-800">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-600">
                        <span>Biaya QRIS:</span>
                        <span id="qrisFeeText" class="font-mono text-slate-800">Rp 0</span>
                    </div>
                    <div class="pt-1.5 border-t border-slate-200 flex justify-between items-center text-slate-900">
                        <span class="font-bold text-xs">Total Tagihan:</span>
                        <span id="qrisTotalPaymentText" class="font-bold font-mono text-sm text-emerald-900">Rp 0</span>
                    </div>
                </div>

                <!-- Countdown Timer -->
                <div class="text-center text-[11px] text-slate-400">
                    Batas waktu pembayaran: <span id="qrisCountdownTimer" class="font-bold font-mono text-slate-800">15:00</span>
                </div>

                <!-- Action Buttons -->
                <div class="pt-1 flex items-center justify-center gap-2">
                    <button type="button" onclick="window.manualCheckPaymentStatus()" class="px-3 py-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-medium transition cursor-pointer shadow-2xs">
                        <i class="fa-solid fa-arrows-rotate mr-1 text-slate-400"></i> Cek Status
                    </button>
                    <a id="qrisInvoiceDirectBtn" href="#" class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-sm text-xs font-semibold transition">
                        <i class="fa-solid fa-file-invoice mr-1 text-emerald-600"></i> Lihat Invoice
                    </a>
                </div>

            </div>

        </div>
    </div>

    @stack('scripts')
</body>
</html>