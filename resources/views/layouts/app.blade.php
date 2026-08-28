<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PERSIS PERS | Penerbitan & Percetakan Kampus')</title>

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

    <!-- Top Sticky Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 sm:h-24">
                
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="flex items-center py-1 group" title="PERSIS PERS">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-14 sm:h-16 lg:h-18 w-auto object-contain transition-transform duration-200 group-hover:scale-105" />
                </a>

                <!-- Desktop Nav Menu -->
                <nav class="hidden lg:flex items-center gap-7">
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">BERANDA</a>
                    <a href="{{ route('tentang') }}" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">TENTANG KAMI</a>
                    
                    <div class="relative group">
                        <button class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition flex items-center gap-1 py-2">
                            LAYANAN <i class="fa-solid fa-chevron-down text-[10px] opacity-70 group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <div class="absolute left-0 top-full hidden group-hover:block w-56 bg-white border border-slate-200 rounded-lg shadow-xl py-2 z-50 animate-fade-in-up">
                            <a href="{{ url('/#layanan') }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Penerbitan Buku</a>
                            <a href="{{ url('/#layanan') }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Percetakan Umum</a>
                            <a href="{{ url('/#layanan') }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Jurnal & Majalah</a>
                            <a href="{{ url('/#layanan') }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Konversi KTI ke Buku</a>
                            <a href="{{ url('/#layanan') }}" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Pengurusan ISBN</a>
                        </div>
                    </div>

                    <a href="{{ route('katalog') }}" class="{{ request()->routeIs('katalog') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">KATALOG BUKU</a>
                    <a href="{{ url('/kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">KONTAK</a>
                </nav>

                <!-- Header CTA Button + Auth (Icon-Only with Smooth Animations) -->
                <div class="flex items-center gap-2 sm:gap-3">
                        {{-- Shopping Cart Button --}}
                        <button type="button" 
                                onclick="window.openCartDrawer()" 
                                class="user-nav-btn relative w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center bg-white hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-600 text-slate-700 hover:text-emerald-800 shadow-2xs hover:shadow-md cursor-pointer transition shrink-0"
                                title="Keranjang Belanja">
                            <i class="fa-solid fa-cart-shopping text-sm transition-transform duration-300"></i>
                            <span id="navCartBadge" class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 bg-[#006830] text-white rounded-full text-[10px] font-black flex items-center justify-center border-2 border-white shadow-xs">
                                0
                            </span>
                        </button>
                    @auth
                        @if(Auth::user()->role === 'member')
                            {{-- Member Profile Pill — murni JS click-toggle, gak ada lagi CSS hover yang tabrakan --}}
                            <div class="relative group" id="memberUserDropdownContainer">
                                <button type="button" 
                                        id="memberUserDropdownBtn"
                                        onclick="window.toggleMemberDropdown(event)" 
                                        class="user-nav-btn flex items-center gap-1.5 sm:gap-2 pl-1.5 sm:pl-2 pr-2.5 sm:pr-3 py-1 sm:py-1.5 rounded-full border border-emerald-200/90 bg-white hover:bg-emerald-50/70 hover:border-emerald-500 shadow-2xs cursor-pointer">
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
                                    <span class="text-xs font-bold text-slate-800 group-hover:text-emerald-800 max-w-[90px] sm:max-w-[120px] truncate transition">
                                        {{ explode(' ', Auth::user()->name)[0] }}
                                    </span>
                                    <i id="memberDropdownChevron" class="fa-solid fa-chevron-down text-[8px] text-slate-400 group-hover:text-emerald-700 transition-transform duration-200"></i>
                                </button>

                                <!-- Dropdown Menu: full JS-controlled (klik buka/tutup + klik di luar buat nutup) -->
                                <div id="memberUserDropdownMenu" class="absolute right-0 top-full pt-2 hidden w-56 z-50">
                                    <div class="auth-dropdown-panel bg-white/95 backdrop-blur-md border border-slate-200 rounded-sm shadow-2xl p-2 animate-fade-in-up">
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
                                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-sm transition">
                                                    <i class="fa-solid fa-right-from-bracket text-xs w-4"></i> Keluar Akun
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                            <a href="{{ route('admin.dashboard') }}" class="user-nav-btn px-3.5 py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-lg font-bold text-xs tracking-wider uppercase flex items-center gap-2 shadow-xs">
                                <i class="fa-solid fa-shield-halved text-emerald-400 text-xs"></i> Admin
                            </a>
                        @endif
                    @else
                        {{-- Guest: Direct Clean "Masuk" Button --}}
                        <a href="{{ route('member.login') }}" 
                           class="px-3.5 sm:px-4 py-1.5 sm:py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-full text-xs font-bold transition-all duration-200 flex items-center gap-1.5 shadow-xs hover:shadow-md cursor-pointer select-none">
                            <i class="fa-solid fa-right-to-bracket text-xs text-emerald-300 pointer-events-none"></i>
                            <span class="pointer-events-none">Masuk</span>
                        </a>
                    @endauth

                    <!-- Mobile Menu Button (Hamburger) -->
                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 focus:outline-none transition">
                        <i class="fa-solid fa-bars text-base"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-drawer" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 animate-fade-in-up">
            <a href="{{ url('/') }}" class="block px-3 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->is('/') ? 'bg-emerald-50 text-brand-900' : 'text-slate-700 hover:bg-slate-50' }}">Beranda</a>
            <a href="{{ route('tentang') }}" class="block px-3 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">Tentang Kami</a>
            <a href="{{ url('/#layanan') }}" class="block px-3 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">Layanan Penerbitan</a>
            <a href="{{ url('/#katalog') }}" class="block px-3 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider text-slate-700 hover:bg-slate-50">Katalog Buku</a>
            <a href="{{ url('/kontak') }}" class="block px-3 py-2.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ request()->routeIs('kontak') ? 'bg-emerald-50 text-brand-900' : 'text-slate-700 hover:bg-slate-50' }}">Kontak Redaksi</a>
            <div class="pt-3 border-t border-slate-100 space-y-2">
                @auth
                    @if(Auth::user()->role === 'member')
                        <div class="px-1 py-2 bg-emerald-50 rounded-lg flex items-center gap-2 mb-2">
                            @if(Auth::user()->avatar_url)
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-7 h-7 rounded-full object-cover border border-emerald-600 shrink-0" />
                            @else
                                <div class="w-7 h-7 rounded-full bg-emerald-700 flex items-center justify-center text-white text-[10px] font-black shrink-0">
                                    {{ Auth::user()->initials }}
                                </div>
                            @endif
                            <div>
                                <p class="text-[11px] font-bold text-emerald-900">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-slate-500">Member Aktif</p>
                            </div>
                        </div>
                        <a href="{{ route('member.dashboard') }}" class="w-full py-2.5 bg-[#006830] text-white rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2">
                            <i class="fa-solid fa-gauge-high text-emerald-300"></i> Dashboard Saya
                        </a>
                        <form method="POST" action="{{ route('member.logout') }}">
                            @csrf
                            <button type="submit" class="w-full py-2.5 border border-red-200 text-red-600 rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-red-50">
                                <i class="fa-solid fa-right-from-bracket text-[10px]"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="w-full py-2.5 bg-slate-800 text-white rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2">
                            <i class="fa-solid fa-lock text-slate-400 text-[10px]"></i> Admin Panel
                        </a>
                    @endif
                @else
                    <a href="{{ route('member.login') }}" class="w-full py-2.5 border border-slate-200 text-slate-700 rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 hover:bg-slate-50">
                        <i class="fa-solid fa-right-to-bracket text-[10px]"></i> Masuk
                    </a>
                    <a href="{{ route('member.register') }}" class="w-full py-2.5 bg-[#006830] text-white rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2">
                        <i class="fa-solid fa-user-plus text-[10px]"></i> Daftar Member
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
    <div class="fixed bottom-6 right-6 z-50 group flex items-center gap-2">
        <a 
            href="{{ $waQuickUrl }}" 
            target="_blank" 
            title="Hubungi WhatsApp Redaksi"
            class="w-14 h-14 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-full flex items-center justify-center text-2xl shadow-xl hover:scale-110 active:scale-95 transition-all duration-300 animate-pulse-soft"
        >
            <i class="fa-brands fa-whatsapp text-3xl"></i>
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

                <!-- Services -->
                <div class="md:col-span-3 space-y-3">
                    <h5 class="text-xs font-bold text-white uppercase tracking-wider">Layanan Utama</h5>
                    <ul class="space-y-2 text-xs text-slate-400">
                        <li>Penerbitan Buku Ber-ISBN</li>
                        <li>Percetakan Buku & Majalah</li>
                        <li>Konversi Skripsi/Tesis ke Buku</li>
                        <li>Penerbitan Jurnal & Prosiding</li>
                        <li>Desain Cover & Layout Naskah</li>
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
                <p>&copy; {{ date('Y') }} PERSIS PERS. All Rights Reserved.</p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.login') }}" class="hover:text-emerald-400 transition flex items-center gap-1">
                        <i class="fa-solid fa-lock text-[10px]"></i> Login Admin
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-drawer');
            drawer.classList.toggle('hidden');
        }
    </script>

    <!-- ========================================================================= -->
    <!-- GLOBAL SHOPPING CART DRAWER (SLIDE-OVER) -->
    <!-- ========================================================================= -->
    <div id="globalCartDrawer" class="fixed inset-0 z-[9999] hidden">
        <!-- Backdrop -->
        <div id="cartDrawerBackdrop" onclick="window.closeCartDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0"></div>

        <!-- Slide-over Panel -->
        <div id="cartDrawerPanel" class="fixed right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl z-10 flex flex-col transform translate-x-full transition-transform duration-300 ease-out">
            
            <!-- Drawer Header (Clean & Modern, No Clunky Badge) -->
            <div class="px-5 py-4 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-900/60 select-none">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-emerald-600/30 text-emerald-300 flex items-center justify-center text-sm shadow-xs">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-sm font-heading flex items-center gap-1.5">
                            Keranjang Belanja
                            <span id="cartDrawerCountBadge" class="text-xs font-semibold text-emerald-300"></span>
                        </h3>
                        <p class="text-[10.5px] text-emerald-200/70">Koleksi Terbitan PERSIS PERS</p>
                    </div>
                </div>
                <button type="button" onclick="window.closeCartDrawer()" class="w-8 h-8 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Keranjang">
                    <i class="fa-solid fa-xmark text-base"></i>
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

                <div class="space-y-2">
                    <button type="button" 
                            onclick="window.checkoutCartViaWhatsApp()"
                            class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs sm:text-sm font-bold shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Pesan Semua via WhatsApp</span>
                    </button>

                    <div class="flex items-center justify-between pt-1">
                        <button type="button" 
                                onclick="window.clearCart()" 
                                class="text-[11px] text-red-600 hover:text-red-800 hover:underline font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                            <span>Kosongkan Keranjang</span>
                        </button>

                        <button type="button" 
                                onclick="window.closeCartDrawer()" 
                                class="text-[11px] text-slate-500 hover:text-slate-800 font-semibold">
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
    <div id="loginPromptModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none" onclick="if(event.target === this) window.closeLoginPromptModal()">
        <div id="loginPromptModalCard" class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-sm w-full p-6 text-center transform scale-95 translate-y-4 opacity-0 transition-all duration-300 ease-out space-y-4">
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
                   class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs rounded-xl transition shadow-xs flex items-center justify-center gap-2">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    <span>Masuk Akun Member</span>
                </a>
                <a href="{{ route('member.register') }}" 
                   class="w-full py-2.5 px-4 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-300 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2">
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
                    m.classList.add('hidden', 'pointer-events-none');
                    m.classList.remove('flex');
                }, 280);
            }
        };

        // Open & Close Cart Drawer
        window.openCartDrawer = function() {
            if (!window.PERSIS_CART.isLoggedIn) {
                window.openLoginPromptModal();
                return;
            }
            const drawer = document.getElementById('globalCartDrawer');
            const backdrop = document.getElementById('cartDrawerBackdrop');
            const panel = document.getElementById('cartDrawerPanel');
            if (drawer && backdrop && panel) {
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
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shadow-xs">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-slate-800 font-heading">Keranjang Masih Kosong</h4>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed max-w-xs">
                                Anda belum menambahkan koleksi buku ke keranjang. Jelajahi katalog sekarang!
                            </p>
                        </div>
                        <a href="{{ route('katalog') }}" onclick="window.closeCartDrawer()" class="px-5 py-2.5 bg-[#006830] text-white text-xs font-bold rounded-xl shadow-xs hover:bg-[#032c21] transition">
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
                    <div class="bg-white p-3.5 rounded-xl border border-slate-200/90 shadow-2xs flex gap-3.5 items-start transition hover:border-emerald-500 hover:shadow-xs">
                        <div class="w-14 h-19 aspect-[3/4.15] shrink-0 bg-slate-900 rounded-lg overflow-hidden border border-slate-200 shadow-2xs">
                            ${cover}
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] font-extrabold text-emerald-800 uppercase tracking-wider">${item.category}</span>
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug mt-0.5" title="${item.title}">${item.title}</h5>
                            <p class="text-[10.5px] text-slate-400 truncate mt-0.5">${item.author}</p>
                            
                            <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                                <div>
                                    <span class="text-xs font-black text-emerald-900 font-mono">${item.formatted_subtotal}</span>
                                    <span class="text-[9.5px] text-slate-400 block">${item.formatted_price} / eks</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden bg-slate-50/80 shadow-2xs">
                                        <button type="button" onclick="window.updateCartItemQty(${item.id}, -1)" class="w-7 h-7 flex items-center justify-center text-slate-600 hover:bg-slate-200/80 active:bg-slate-300 font-bold transition text-xs cursor-pointer">
                                            <i class="fa-solid fa-minus text-[9px]"></i>
                                        </button>
                                        <span class="w-7 text-center text-xs font-black text-slate-900 select-none">${item.quantity}</span>
                                        <button type="button" onclick="window.updateCartItemQty(${item.id}, 1)" class="w-7 h-7 flex items-center justify-center text-slate-600 hover:bg-slate-200/80 active:bg-slate-300 font-bold transition text-xs cursor-pointer">
                                            <i class="fa-solid fa-plus text-[9px]"></i>
                                        </button>
                                    </div>
                                    <button type="button" onclick="window.removeCartItem(${item.id})" class="text-slate-300 hover:text-red-500 p-1.5 transition text-xs cursor-pointer" title="Hapus dari keranjang">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            list.innerHTML = html;
        };

        // Checkout via WhatsApp
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

</body>
</html>