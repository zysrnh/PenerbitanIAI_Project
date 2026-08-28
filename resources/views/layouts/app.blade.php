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

        const isCurrentlyHidden = drawer.style.display === 'none' || drawer.classList.contains('hidden') || (window.getComputedStyle && window.getComputedStyle(drawer).display === 'none');

        if (isCurrentlyHidden) {
            drawer.style.display = 'block';
            drawer.style.display = 'block';
                drawer.classList.remove('hidden');
            if (icon) {
                icon.className = 'fa-solid fa-xmark text-lg pointer-events-none';
            }
        } else {
            drawer.style.display = 'none';
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
            drawer.style.display = 'none';
                drawer.classList.add('hidden');
        }
        if (icon) {
            icon.className = 'fa-solid fa-bars text-lg pointer-events-none';
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        if (btn) {
            btn.onclick = window.toggleMobileMenu;
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
    <header class="sticky top-0 z-[100] bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all duration-300">
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

                <!-- Header Action Buttons (Spacious & Touch-Friendly) -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    @auth
                        @if(Auth::user()->role === 'member')
                            {{-- Shopping Cart Button (Hanya Muncul Jika Sudah Login Sebagai Member) --}}
                            <button type="button" 
                                    onclick="window.openCartDrawer()" 
                                    class="user-nav-btn relative w-10 h-10 rounded-full flex items-center justify-center bg-white hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-600 text-slate-700 hover:text-emerald-800 shadow-2xs hover:shadow-md cursor-pointer transition shrink-0"
                                    title="Keranjang Belanja">
                                <i class="fa-solid fa-cart-shopping text-sm pointer-events-none"></i>
                                <span id="navCartBadge" class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 bg-[#006830] text-white rounded-full text-[10px] font-black flex items-center justify-center border-2 border-white shadow-xs pointer-events-none">
                                    0
                                </span>
                            </button>

                            {{-- Member Profile Pill --}}
                            <div class="relative" id="memberUserDropdownContainer">
                                <button type="button" 
                                        id="memberUserDropdownBtn"
                                        onclick="window.toggleMemberDropdown(event)" 
                                        class="user-nav-btn flex items-center gap-1.5 sm:gap-2 pl-1.5 sm:pl-2 pr-2 sm:pr-3 py-1 sm:py-1.5 rounded-full border border-emerald-200/90 bg-white hover:bg-emerald-50/70 hover:border-emerald-500 shadow-2xs cursor-pointer">
                                    <div class="relative">
                                        @if(Auth::user()->avatar_url)
                                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-full object-cover shadow-xs border border-emerald-500" />
                                        @else
                                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-[#032c21] to-emerald-600 flex items-center justify-center text-white text-[11px] font-black shadow-xs">
                                                {{ Auth::user()->initials }}
                                            </div>
                                        @endif
                                        <span class="absolute -bottom-0.5 -right-0.5 w-2 h-2 bg-emerald-500 border-2 border-white rounded-full"></span>
                                    </div>
                                    <span class="hidden sm:inline text-xs font-bold text-slate-800 group-hover:text-emerald-800 max-w-[90px] sm:max-w-[120px] truncate transition">
                                        {{ explode(' ', Auth::user()->name)[0] }}
                                    </span>
                                    <i id="memberDropdownChevron" class="fa-solid fa-chevron-down text-[8px] text-slate-400 group-hover:text-emerald-700 transition-transform duration-200"></i>
                                </button>

                                <!-- Dropdown Menu -->
                                <div id="memberUserDropdownMenu" class="absolute right-0 top-full pt-2 hidden w-56 z-50">
                                    <div class="auth-dropdown-panel bg-white border border-slate-200 rounded-sm shadow-2xl p-2 animate-fade-in-up">
                                        <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                            <p class="text-xs font-extrabold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                            <p class="text-[10.5px] text-emerald-700 font-medium truncate">{{ Auth::user()->email }}</p>
                                        </div>
                                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-gauge-high text-emerald-600 text-xs w-4"></i> Dashboard
                                        </a>
                                        <a href="{{ route('member.profile') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition">
                                            <i class="fa-solid fa-user text-slate-400 text-xs w-4"></i> Profil Saya
                                        </a>
                                        <button type="button" onclick="window.openCartDrawer()" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-sm transition text-left">
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
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                            <a href="{{ route('admin.dashboard') }}" class="user-nav-btn px-3 py-1.5 sm:px-3.5 sm:py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-sm font-bold text-xs tracking-wider uppercase flex items-center gap-1.5 shadow-xs">
                                <i class="fa-solid fa-shield-halved text-emerald-400 text-xs"></i> <span class="hidden sm:inline">Admin</span>
                            </a>
                        @endif
                    @else
                        {{-- Desktop Only "Masuk" Button (Hidden on Mobile phone screen to avoid crowding) --}}
                        <a href="{{ route('member.login') }}" 
                           class="hidden sm:flex px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition-all duration-200 items-center gap-1.5 shadow-xs hover:shadow-md cursor-pointer select-none">
                            <i class="fa-solid fa-right-to-bracket text-xs text-emerald-300 pointer-events-none"></i>
                            <span>Masuk</span>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button (Hamburger - Standard 44x44 Touch Target) -->
                    <button id="mobile-menu-btn" 
                            type="button"
                            onclick="window.toggleMobileMenu(event)" 
                            class="lg:hidden w-11 h-11 rounded-sm border border-slate-200 bg-white text-slate-800 hover:bg-emerald-50 active:bg-emerald-100 hover:text-emerald-800 flex items-center justify-center focus:outline-none transition-all duration-150 cursor-pointer shadow-2xs shrink-0 touch-manipulation select-none"
                            aria-label="Buka Menu Navigasi">
                        <i id="mobileMenuIcon" class="fa-solid fa-bars text-lg pointer-events-none transition-transform duration-200"></i>
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
                    @if(Auth::user()->role === 'member')
                        <div class="px-3 py-2 bg-emerald-50 rounded-sm flex items-center gap-2.5 mb-2 border border-emerald-200">
                            @if(Auth::user()->avatar_url)
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-emerald-600 shrink-0" />
                            @else
                                <div class="w-8 h-8 rounded-full bg-emerald-700 flex items-center justify-center text-white text-xs font-black shrink-0">
                                    {{ Auth::user()->initials }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-emerald-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-500 font-mono">Member Aktif</p>
                            </div>
                        </div>
                        <a href="{{ route('member.dashboard') }}" class="w-full py-2.5 bg-[#006830] text-white rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-2xs">
                            <i class="fa-solid fa-gauge-high text-emerald-300"></i> Dashboard Saya
                        </a>
                        <form method="POST" action="{{ route('member.logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 border border-red-200 text-red-600 rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-red-50 cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket text-xs"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="w-full py-2.5 bg-slate-800 text-white rounded-sm font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-2xs">
                            <i class="fa-solid fa-shield-halved text-emerald-400 text-xs"></i> Admin Panel
                        </a>
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
    <!-- GLOBAL SHOPPING CART DRAWER (SLIDE-OVER) -->
    <!-- ========================================================================= -->
    <div id="globalCartDrawer" class="fixed inset-0 z-[9999] hidden" style="display: none;">
        <!-- Backdrop -->
        <div id="cartDrawerBackdrop" onclick="window.closeCartDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0"></div>

        <!-- Slide-over Panel -->
        <div id="cartDrawerPanel" class="fixed right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl z-10 flex flex-col transform translate-x-full transition-transform duration-300 ease-out">
            
            <!-- Drawer Header -->
            <div class="px-5 py-3.5 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-900 select-none">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xs bg-emerald-600/30 text-emerald-300 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm font-heading flex items-center gap-1.5">
                            Keranjang Belanja
                            <span id="cartDrawerCountBadge" class="text-xs font-semibold text-emerald-300 font-mono"></span>
                        </h3>
                        <p class="text-[10px] text-emerald-200/70">Koleksi Terbitan PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeCartDrawer()" class="w-7 h-7 rounded-xs text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Keranjang">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Drawer Body: Items List -->
            <div id="cartDrawerItemsList" class="flex-1 overflow-y-auto p-4 sm:p-5 space-y-3">
                <!-- Skeleton / Empty state injected via JS -->
            </div>

            <!-- Drawer Footer: Subtotal & Checkout -->
            <div id="cartDrawerFooter" class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50 space-y-3.5">
                <div class="space-y-1.5 text-xs">
                    <div class="flex justify-between text-slate-500">
                        <span>Total Jumlah Item:</span>
                        <span id="cartDrawerTotalItemsText" class="font-bold text-slate-800">0 Eksemplar</span>
                    </div>
                    <div class="flex justify-between text-slate-900 text-sm font-bold pt-1 border-t border-slate-200/80">
                        <span>Total Pembayaran:</span>
                        <span id="cartDrawerSubtotal" class="font-mono font-black text-emerald-700 text-base">Rp 0</span>
                    </div>
                </div>

                <!-- Drawer Actions (QRIS Auto & WhatsApp) -->
                <div class="space-y-2 select-none">
                    <!-- Tombol 1: Bayar Otomatis QRIS -->
                    <button type="button" 
                            onclick="window.openCheckoutModal()"
                            class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs sm:text-sm font-bold shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-qrcode text-sm text-lime-300"></i>
                        <span>Bayar Otomatis (QRIS Realtime)</span>
                    </button>

                    <!-- Tombol 2: Pesan Manual via WhatsApp -->
                    <button type="button" 
                            onclick="window.checkoutCartViaWhatsApp()"
                            class="w-full py-2 px-4 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-2xs">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i>
                        <span>Pesan Manual via WhatsApp</span>
                    </button>

                    <div class="flex items-center justify-between pt-1">
                        <button type="button" 
                                onclick="window.clearCart()" 
                                class="text-[11px] text-red-600 hover:text-red-800 font-medium flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-trash-can text-[9px]"></i>
                            <span>Kosongkan</span>
                        </button>

                        <button type="button" 
                                onclick="window.closeCartDrawer()" 
                                class="text-[11px] text-slate-500 hover:text-slate-800 font-medium cursor-pointer">
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
    <!-- CART TOAST NOTIFICATION -->
    <!-- ========================================================================= -->
    <div id="cartToastNotification" class="fixed top-20 right-6 z-[170] transform translate-y-[-150%] transition-all duration-300 opacity-0 pointer-events-none max-w-sm w-full">
        <div class="p-3.5 bg-slate-900 text-white rounded-sm shadow-2xl border-l-4 border-emerald-500 flex items-center justify-between gap-3 pointer-events-auto">
            <div class="flex items-center gap-2.5 min-w-0">
                <i id="cartToastIcon" class="fa-solid fa-circle-check text-emerald-400 text-lg shrink-0"></i>
                <p id="cartToastMsg" class="text-xs font-semibold text-slate-100 truncate">Buku berhasil ditambahkan!</p>
            </div>
            <button type="button" onclick="window.openCartDrawer()" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[10.5px] rounded-xs shrink-0 transition">
                Lihat
            </button>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- GLOBAL CART JAVASCRIPT ENGINE -->
    <!-- ========================================================================= -->
    <script>

        // ==========================================
        // ACCOUNT DROPDOWN (murni klik — buka/tutup + klik di luar buat nutup)
        // ==========================================
        window.toggleMemberDropdown = function(event) {
            if (event) event.stopPropagation();
            const menu = document.getElementById('memberUserDropdownMenu');
            const chevron = document.getElementById('memberDropdownChevron');
            if (menu) {
                const isHidden = menu.classList.contains('hidden');
                if (isHidden) {
                    menu.classList.remove('hidden');
                    if (chevron) chevron.classList.add('rotate-180');
                } else {
                    menu.classList.add('hidden');
                    if (chevron) chevron.classList.remove('rotate-180');
                }
            }
        };

        document.addEventListener('click', function(e) {
            const memberContainer = document.getElementById('memberUserDropdownContainer');
            const memberMenu = document.getElementById('memberUserDropdownMenu');
            const memberChevron = document.getElementById('memberDropdownChevron');
            if (memberContainer && !memberContainer.contains(e.target)) {
                if (memberMenu) memberMenu.classList.add('hidden');
                if (memberChevron) memberChevron.classList.remove('rotate-180');
            }
        });

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

        // Open & Close Modals with Smooth Animation
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

        // Open & Close Cart Drawer (Smooth slide-over, no annoying popup)
        window.openCartDrawer = function() {
            const drawer = document.getElementById('globalCartDrawer');
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
                drawer.style.display = 'block';
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-x-full');
                }, 10);
                if (window.PERSIS_CART.isLoggedIn) {
                    window.fetchCartData();
                } else {
                    window.renderCartDrawerUI({ items: [], count: 0, total: 0, formatted_total: 'Rp 0' });
                }
            }
        };
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
                drawer.style.display = 'block';
                drawer.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('translate-x-full');
                }, 10);
                window.fetchCartData();
            }
        };

        window.closeCartDrawer = function() {
            const drawer = document.getElementById('globalCartDrawer');
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
                backdrop.classList.add('opacity-0');
                panel.classList.add('translate-x-full');
                setTimeout(() => {
                    drawer.style.display = 'none';
                drawer.classList.add('hidden');
                }, 300);
            }
        };

        // Show Toast
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

            toast.classList.remove('translate-y-[-150%]', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-[-150%]', 'opacity-0');
            }, 3500);
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

        // Add to Cart Action (Instant & Smooth)
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
                if (data.success) {
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

        // Update Item Qty (0ms INSTANT OPTIMISTIC UI)
        window.updateCartItemQty = function(cartItemId, change) {
            if (!window.PERSIS_CART.data || !window.PERSIS_CART.data.items) return;
            const item = window.PERSIS_CART.data.items.find(i => i.id === cartItemId);
            if (!item) return;

            const newQty = item.quantity + change;
            if (newQty <= 0) {
                window.removeCartItem(cartItemId);
                return;
            }

            // 1. Instant local state update (Zero latency!)
            item.quantity = newQty;
            item.subtotal = (item.unit_price || 0) * newQty;
            item.formatted_subtotal = 'Rp ' + Number(item.subtotal).toLocaleString('id-ID');

            let totalCount = 0;
            let totalAmount = 0;
            window.PERSIS_CART.data.items.forEach(i => {
                totalCount += i.quantity;
                totalAmount += i.subtotal;
            });
            window.PERSIS_CART.data.count = totalCount;
            window.PERSIS_CART.data.total = totalAmount;
            window.PERSIS_CART.data.formatted_total = 'Rp ' + Number(totalAmount).toLocaleString('id-ID');

            // 2. Re-render UI immediately at 60fps
            window.updateCartBadges(totalCount);
            window.renderCartDrawerUI(window.PERSIS_CART.data);

            // 3. Sync to server in background
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
                if (data.success) {
                    window.PERSIS_CART.data = data;
                    window.updateCartBadges(data.count);
                    window.renderCartDrawerUI(data);
                }
            })
            .catch(err => console.error('Error updating cart qty:', err));
        };

        // Remove Item (0ms INSTANT OPTIMISTIC REMOVE)
        window.removeCartItem = function(cartItemId) {
            if (!window.PERSIS_CART.data || !window.PERSIS_CART.data.items) return;

            // 1. Instant local removal
            window.PERSIS_CART.data.items = window.PERSIS_CART.data.items.filter(i => i.id !== cartItemId);
            let totalCount = 0;
            let totalAmount = 0;
            window.PERSIS_CART.data.items.forEach(i => {
                totalCount += i.quantity;
                totalAmount += i.subtotal;
            });
            window.PERSIS_CART.data.count = totalCount;
            window.PERSIS_CART.data.total = totalAmount;
            window.PERSIS_CART.data.formatted_total = 'Rp ' + Number(totalAmount).toLocaleString('id-ID');

            window.updateCartBadges(totalCount);
            window.renderCartDrawerUI(window.PERSIS_CART.data);
            window.showCartToast('Item dihapus dari keranjang.');

            // 2. Sync to server in background
            fetch(window.PERSIS_CART.routes.remove + cartItemId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.PERSIS_CART.data = data;
                    window.updateCartBadges(data.count);
                    window.renderCartDrawerUI(data);
                }
            })
            .catch(err => console.error('Error removing cart item:', err));
        };

        // Clear Cart
        window.clearCart = function() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan seluruh isi keranjang belanja?')) return;

            // Instant clear locally
            window.PERSIS_CART.data.items = [];
            window.PERSIS_CART.data.count = 0;
            window.PERSIS_CART.data.total = 0;
            window.PERSIS_CART.data.formatted_total = 'Rp 0';
            window.updateCartBadges(0);
            window.renderCartDrawerUI(window.PERSIS_CART.data);
            window.showCartToast('Keranjang belanja telah dikosongkan.');

            fetch(window.PERSIS_CART.routes.clear, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.PERSIS_CART.data = data;
                    window.updateCartBadges(0);
                    window.renderCartDrawerUI(data);
                }
            });
        };

        // Render Cart UI (Clean, Polished & Modern)
        window.renderCartDrawerUI = function(data) {
            const list = document.getElementById('cartDrawerItemsList');
            const countBadge = document.getElementById('cartDrawerCountBadge');
            const totalItemsText = document.getElementById('cartDrawerTotalItemsText');
            const subtotalText = document.getElementById('cartDrawerSubtotal');
            const footer = document.getElementById('cartDrawerFooter');

            if (!list) return;

            if (countBadge) {
                countBadge.textContent = data.count > 0 ? `(${data.count})` : '';
            }
            if (totalItemsText) totalItemsText.textContent = `${data.count} Eksemplar`;
            if (subtotalText) subtotalText.textContent = data.formatted_total;

            if (!data.items || data.items.length === 0) {
                list.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-center p-6 space-y-3.5 my-auto select-none">
                        <div class="w-16 h-16 rounded-sm bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shadow-xs">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-slate-800 font-heading">Keranjang Masih Kosong</h4>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed max-w-xs">
                                Anda belum menambahkan koleksi buku ke keranjang. Jelajahi katalog sekarang!
                            </p>
                        </div>
                        <a href="{{ route('katalog') }}" onclick="window.closeCartDrawer()" class="px-5 py-2.5 bg-[#006830] text-white text-xs font-bold rounded-sm shadow-xs hover:bg-[#032c21] transition">
                            Buka Katalog Buku
                        </a>
                    </div>
                `;
                if (footer) footer.classList.add('opacity-50', 'pointer-events-none');
                return;
            }

            if (footer) footer.classList.remove('opacity-50', 'pointer-events-none');

            let html = '';
            data.items.forEach(item => {
                const cover = item.cover_url ? 
                    `<img src="${item.cover_url}" alt="${item.title}" class="w-full h-full object-cover" />` :
                    `<div class="w-full h-full bg-[#032c21] text-white flex items-center justify-center text-[8px] font-bold p-1 text-center">${item.category}</div>`;

                html += `
                    <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex gap-3 items-start transition hover:border-emerald-700">
                        <div class="w-14 h-19 aspect-[3/4.15] shrink-0 bg-slate-900 rounded-xs overflow-hidden border border-slate-200 shadow-2xs">
                            ${cover}
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] font-bold text-emerald-800 uppercase tracking-wider">${item.category}</span>
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug mt-0.5" title="${item.title}">${item.title}</h5>
                            <p class="text-[10px] text-slate-400 truncate mt-0.5">${item.author}</p>
                            
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100">
                                <div>
                                    <span class="font-mono font-bold text-xs text-emerald-800">${item.formatted_subtotal}</span>
                                    <span class="text-[9.5px] text-slate-400 block">@ ${item.formatted_price}</span>
                                </div>
                                <div class="flex items-center gap-1.5 bg-slate-50 p-0.5 rounded-xs border border-slate-200">
                                    <button type="button" onclick="window.updateCartItemQty(${item.id}, -1)" class="w-5 h-5 rounded-xs bg-white text-slate-700 hover:bg-emerald-700 hover:text-white flex items-center justify-center text-[10px] font-bold shadow-2xs transition cursor-pointer">
                                        <i class="fa-solid fa-minus text-[8px]"></i>
                                    </button>
                                    <span class="text-xs font-bold font-mono w-5 text-center text-slate-800 select-none">${item.quantity}</span>
                                    <button type="button" onclick="window.updateCartItemQty(${item.id}, 1)" class="w-5 h-5 rounded-xs bg-white text-slate-700 hover:bg-emerald-700 hover:text-white flex items-center justify-center text-[10px] font-bold shadow-2xs transition cursor-pointer">
                                        <i class="fa-solid fa-plus text-[8px]"></i>
                                    </button>
                                </div>
                                <button type="button" onclick="window.removeCartItem(${item.id})" class="text-slate-300 hover:text-red-600 transition p-1 cursor-pointer" title="Hapus item">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });

            list.innerHTML = html;
        };

        // Checkout via WhatsApp
        
        // ==========================================
        // CHECKOUT & PAKASIR QRIS REALTIME ENGINE
        // ==========================================
        let currentOrderNumber = null;
        let qrisPollInterval = null;
        let qrisTimerInterval = null;

        window.openCheckoutModal = function() {
            if (!window.PERSIS_CART.isLoggedIn) {
                window.closeCartDrawer();
                window.openLoginPromptModal();
                return;
            }

            if (!window.PERSIS_CART.data || !window.PERSIS_CART.data.items || window.PERSIS_CART.data.items.length === 0) {
                window.showCartToast('Keranjang belanja Anda masih kosong.', false);
                return;
            }

            window.closeCartDrawer();

            // Set Total Summary
            const sumEl = document.getElementById('chkTotalSummaryText');
            if (sumEl) sumEl.textContent = window.PERSIS_CART.data.formatted_total;

            // Reset to Step 1 (Form)
            document.getElementById('checkoutStepForm').classList.remove('hidden');
            document.getElementById('checkoutStepQris').classList.add('hidden');
            document.getElementById('checkoutModalTitle').textContent = 'Checkout & Pengiriman';

            const modal = document.getElementById('checkoutQrisModal');
            const card = document.getElementById('checkoutQrisModalCard');
            if (modal && card) {
                modal.classList.remove('hidden', 'pointer-events-none');
                modal.classList.add('flex');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.classList.add('opacity-100');
                    card.classList.remove('scale-95', 'translate-y-4', 'opacity-0');
                    card.classList.add('scale-100', 'translate-y-0', 'opacity-100');
                }, 10);
            }
        };

        window.closeCheckoutModal = function() {
            clearInterval(qrisPollInterval);
            clearInterval(qrisTimerInterval);

            const modal = document.getElementById('checkoutQrisModal');
            const card = document.getElementById('checkoutQrisModalCard');
            if (modal && card) {
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0');
                card.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
                card.classList.add('scale-95', 'translate-y-4', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden', 'pointer-events-none');
                    modal.classList.remove('flex');
                }, 280);
            }
        };

        window.submitCheckoutQris = function() {
            const name = document.getElementById('chkCustomerName')?.value.trim();
            const phone = document.getElementById('chkCustomerPhone')?.value.trim();
            const address = document.getElementById('chkCustomerAddress')?.value.trim();
            const email = document.getElementById('chkCustomerEmail')?.value.trim();
            const notes = document.getElementById('chkCustomerNotes')?.value.trim();

            if (!name || !phone || !address) {
                alert('Mohon lengkapi Nama, Nomor WhatsApp, dan Alamat Pengiriman.');
                return;
            }

            const btn = document.getElementById('btnProcessQris');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Menghubungkan ke QRIS Pakasir...</span>';
            }

            fetch(window.PERSIS_CART.routes.checkoutQris || '/member/cart/checkout/qris', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    customer_name: name,
                    customer_phone: phone,
                    customer_address: address,
                    customer_email: email,
                    notes: notes
                })
            })
            .then(res => res.json())
            .then(data => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-qrcode text-base text-lime-300"></i><span>Lanjut ke Pembayaran QRIS &rarr;</span>';
                }

                if (data.success) {
                    currentOrderNumber = data.order_number;
                    
                    // Render Step 2 (QRIS)
                    document.getElementById('qrisImageDisplay').src = data.qr_image_url;
                    document.getElementById('qrisOrderNumber').textContent = data.order_number;
                    document.getElementById('qrisSubtotalText').textContent = data.formatted_amount;
                    document.getElementById('qrisFeeText').textContent = data.formatted_fee;
                    document.getElementById('qrisTotalPaymentText').textContent = data.formatted_total;
                    document.getElementById('qrisInvoiceDirectBtn').href = data.invoice_url;

                    document.getElementById('checkoutStepForm').classList.add('hidden');
                    document.getElementById('checkoutStepQris').classList.remove('hidden');
                    document.getElementById('checkoutModalTitle').textContent = 'Scan QRIS untuk Bayar';

                    // Refresh cart badges
                    window.PERSIS_CART.data = { items: [], count: 0, total: 0, formatted_total: 'Rp 0' };
                    window.updateCartBadges(0);
                    window.renderCartDrawerUI(window.PERSIS_CART.data);

                    // Start Live Polling & Timer
                    window.startQrisPolling(data.order_number, data.invoice_url);
                    window.startQrisTimer(15 * 60);

                } else {
                    alert(data.message || 'Gagal memproses QRIS. Silakan coba lagi.');
                }
            })
            .catch(err => {
                console.error('Checkout error:', err);
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-qrcode text-base text-lime-300"></i><span>Lanjut ke Pembayaran QRIS &rarr;</span>';
                }
                alert('Terjadi kendala jaringan saat menghubungi payment gateway.');
            });
        };

        // Real-time Status Polling
        window.startQrisPolling = function(orderNumber, invoiceUrl) {
            clearInterval(qrisPollInterval);

            qrisPollInterval = setInterval(() => {
                fetch((window.PERSIS_CART.routes.orderStatus || '/order/status/') + orderNumber)
                    .then(res => res.json())
                    .then(res => {
                        if (res.success && res.payment_status === 'completed') {
                            clearInterval(qrisPollInterval);
                            clearInterval(qrisTimerInterval);

                            const banner = document.getElementById('qrisStatusBanner');
                            if (banner) {
                                banner.className = 'p-3 bg-emerald-500 text-white rounded-sm flex items-center justify-center gap-2 text-xs font-black shadow-md animate-bounce';
                                banner.innerHTML = '<i class="fa-solid fa-circle-check text-base"></i><span>PEMBAYARAN BERHASIL! Mengalihkan ke Invoice...</span>';
                            }

                            setTimeout(() => {
                                window.location.href = invoiceUrl || res.invoice_url;
                            }, 1200);
                        }
                    })
                    .catch(err => console.log('Polling status check:', err));
            }, 2500);
        };

        // Manual status check trigger
        window.manualCheckPaymentStatus = function() {
            if (!currentOrderNumber) return;
            fetch((window.PERSIS_CART.routes.orderStatus || '/order/status/') + currentOrderNumber)
                .then(res => res.json())
                .then(res => {
                    if (res.success && res.payment_status === 'completed') {
                        alert('Pembayaran berhasil dikonfirmasi! Mengalihkan ke invoice...');
                        window.location.href = res.invoice_url;
                    } else {
                        alert('Status pembayaran saat ini masih: ' + (res.payment_status || 'PENDING') + '. Silakan selesaikan scan QRIS terlebih dahulu.');
                    }
                });
        };

        // Countdown Timer
        window.startQrisTimer = function(durationSeconds) {
            clearInterval(qrisTimerInterval);
            let timer = durationSeconds;
            const timerEl = document.getElementById('qrisCountdownTimer');

            qrisTimerInterval = setInterval(() => {
                const minutes = parseInt(timer / 60, 10);
                const seconds = parseInt(timer % 60, 10);

                const displayMin = minutes < 10 ? '0' + minutes : minutes;
                const displaySec = seconds < 10 ? '0' + seconds : seconds;

                if (timerEl) timerEl.textContent = displayMin + ':' + displaySec;

                if (--timer < 0) {
                    clearInterval(qrisTimerInterval);
                    clearInterval(qrisPollInterval);
                    if (timerEl) timerEl.textContent = 'KADALUARSA';
                }
            }, 1000);
        };

        window.checkoutCartViaWhatsApp = function() {
            const data = window.PERSIS_CART.data;
            if (!data.items || data.items.length === 0) {
                alert('Keranjang belanja Anda masih kosong.');
                return;
            }

            let text = `Halo Redaksi PERSIS PERS, saya ingin memesan buku melalui *Keranjang Belanja* website persispers.com:\n\n`;
            if (window.PERSIS_CART.userName) {
                text += `*Nama Pemesan:* ${window.PERSIS_CART.userName}\n`;
            }
            text += `*Daftar Pesanan Buku:*\n`;

            data.items.forEach((item, index) => {
                text += `${index + 1}. *${item.title}* (${item.quantity}x) = ${item.formatted_subtotal}\n`;
            });

            text += `\n*Total Item:* ${data.count} Eksemplar`;
            text += `\n*Total Belanja:* ${data.formatted_total}`;
            text += `\n\nMohon info ketersediaan stok buku dan rincian ongkos kirim ke alamat saya ya kak. Terima kasih!`;

            const phone = window.PERSIS_CART.contactWa.replace(/[^0-9]/g, '') || '6282116116133';
            const url = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
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