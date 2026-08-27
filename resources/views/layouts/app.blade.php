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
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .user-nav-btn:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 20px -4px rgba(4, 120, 87, 0.25);
        }
        .user-nav-btn:hover i {
            transform: scale(1.12);
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
                            {{-- Member Profile Pill with Avatar & Pulse --}}
                            <div class="relative group">
                                <a href="{{ route('member.dashboard') }}" class="user-nav-btn flex items-center gap-1.5 sm:gap-2 pl-1.5 sm:pl-2 pr-2.5 sm:pr-3 py-1 sm:py-1.5 rounded-full border border-emerald-200/90 bg-white hover:bg-emerald-50/70 hover:border-emerald-500 shadow-2xs cursor-pointer">
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
                                    <i class="fa-solid fa-chevron-down text-[8px] text-slate-400 group-hover:text-emerald-700 group-hover:rotate-180 transition-transform duration-300"></i>
                                </a>

                                <!-- Animated Dropdown on Hover -->
                                <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-52 z-50">
                                    <div class="auth-dropdown-panel bg-white/95 backdrop-blur-md border border-slate-100 rounded-xl shadow-2xl p-2 animate-fade-in-up">
                                        <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                            <p class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                                            <p class="text-[10px] text-emerald-700 font-medium truncate">{{ Auth::user()->email }}</p>
                                        </div>
                                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-lg transition">
                                            <i class="fa-solid fa-gauge-high text-emerald-600 text-xs w-4"></i> Dashboard
                                        </a>
                                        <a href="{{ route('member.profile') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 rounded-lg transition">
                                            <i class="fa-solid fa-user text-slate-400 text-xs w-4"></i> Profil Saya
                                        </a>
                                        <div class="border-t border-slate-100 mt-1 pt-1">
                                            <form method="POST" action="{{ route('member.logout') }}">
                                                @csrf
                                                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-xs font-bold text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <i class="fa-solid fa-right-from-bracket text-xs w-4"></i> Keluar
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
                        {{-- Guest: Icon-Only Member Trigger with Animated Interactive Dropdown --}}
                        <div class="relative group">
                            <a href="{{ route('member.login') }}" 
                               aria-label="Akun Member"
                               class="user-nav-btn relative w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center bg-white hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-600 text-slate-700 hover:text-emerald-800 shadow-2xs hover:shadow-md cursor-pointer group">
                                <i class="fa-solid fa-user text-sm transition-transform duration-300"></i>
                                
                                <!-- Animated subtle green pulse ring -->
                                <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-60"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-600 border-2 border-white"></span>
                                </span>
                            </a>

                            <!-- Animated Dropdown Panel on Hover -->
                            <div class="absolute right-0 top-full pt-2 hidden group-hover:block w-56 z-50">
                                <div class="auth-dropdown-panel bg-white/95 backdrop-blur-md border border-slate-100 rounded-2xl shadow-2xl p-3 animate-fade-in-up">
                                    <div class="flex items-center gap-2 pb-2.5 mb-2.5 border-b border-slate-100">
                                        <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs font-bold shrink-0">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <h6 class="text-xs font-extrabold text-slate-900 truncate">Area Member</h6>
                                            <p class="text-[10px] text-slate-400 truncate">Penerbitan & Katalog</p>
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <a href="{{ route('member.login') }}" 
                                            class="w-full py-2 px-3 bg-[#006830] hover:bg-[#032c21] text-white rounded-lg text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs hover:shadow-sm">
                                            <i class="fa-solid fa-right-to-bracket text-[10px]"></i> Masuk Akun
                                        </a>
                                        <a href="{{ route('member.register') }}" 
                                            class="w-full py-2 px-3 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-300 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1.5">
                                            <i class="fa-solid fa-user-plus text-[10px] text-emerald-600"></i> Buat Akun Baru
                                        </a>
                                    </div>

                                    <div class="mt-2.5 pt-2 border-t border-slate-100 text-center">
                                        <a href="{{ url('/kontak') }}" class="text-[10px] font-medium text-slate-400 hover:text-emerald-700 transition flex items-center justify-center gap-1">
                                            <i class="fa-solid fa-circle-question text-[9px]"></i> Butuh bantuan?
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <div id="globalCartDrawer" class="fixed inset-0 z-[150] hidden">
        <!-- Backdrop -->
        <div id="cartDrawerBackdrop" onclick="window.closeCartDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0"></div>

        <!-- Slide-over Panel -->
        <div id="cartDrawerPanel" class="fixed right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl z-10 flex flex-col transform translate-x-full transition-transform duration-300 ease-out">
            
            <!-- Drawer Header -->
            <div class="px-5 py-4 bg-[#032c21] text-white flex items-center justify-between shadow-xs border-b border-emerald-900">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-sm bg-emerald-600/30 text-emerald-300 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-sm font-heading">Keranjang Belanja</h3>
                        <p class="text-[10.5px] text-emerald-200/80">Koleksi Terbitan PERSIS PERS</p>
                    </div>
                    <span id="cartDrawerCountBadge" class="ml-1.5 px-2 py-0.5 rounded-full bg-emerald-500 text-[#032c21] text-[10.5px] font-black">
                        0 Item
                    </span>
                </div>
                <button type="button" onclick="window.closeCartDrawer()" class="w-8 h-8 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition">
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
    <!-- FLOATING CART QUICK BUTTON (BOTTOM RIGHT) -->
    <!-- ========================================================================= -->
    <button type="button"
            id="floatingCartBtn"
            onclick="window.openCartDrawer()"
            class="fixed bottom-20 right-6 z-40 w-12 h-12 rounded-full bg-[#006830] hover:bg-[#032c21] text-white shadow-xl hover:shadow-2xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 border-2 border-white cursor-pointer group"
            title="Buka Keranjang Belanja">
        <i class="fa-solid fa-cart-shopping text-base group-hover:scale-110 transition-transform"></i>
        <span id="floatingCartBadge" class="hidden absolute -top-1.5 -right-1.5 min-w-[20px] h-[20px] px-1 bg-amber-500 text-slate-950 rounded-full text-[10px] font-black flex items-center justify-center border-2 border-white shadow-xs animate-bounce">
            0
        </span>
    </button>

    <!-- ========================================================================= -->
    <!-- LOGIN PROMPT MODAL (FOR GUEST USERS) -->
    <!-- ========================================================================= -->
    <div id="loginPromptModal" class="fixed inset-0 z-[160] hidden items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-sm border border-slate-200 shadow-2xl max-w-sm w-full p-6 text-center animate-fade-in space-y-4">
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
                   class="w-full py-2 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-sm transition border border-slate-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus text-xs text-emerald-700"></i>
                    <span>Daftar Akun Baru (Gratis)</span>
                </a>
                <button type="button" onclick="window.closeLoginPromptModal()" class="w-full py-1.5 text-xs text-slate-400 hover:text-slate-600 font-medium">
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

        // Open & Close Modals
        window.openLoginPromptModal = function() {
            const m = document.getElementById('loginPromptModal');
            if (m) {
                m.classList.remove('hidden');
                m.classList.add('flex');
            }
        };

        window.closeLoginPromptModal = function() {
            const m = document.getElementById('loginPromptModal');
            if (m) {
                m.classList.add('hidden');
                m.classList.remove('flex');
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

        // Add to Cart Action
        window.addToCart = function(bookId, quantity = 1) {
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
                    window.showCartToast(data.message || 'Buku berhasil ditambahkan ke keranjang!');
                    window.renderCartDrawerUI(data);
                }
            })
            .catch(err => {
                console.error('Error adding to cart:', err);
                window.showCartToast('Gagal menambahkan ke keranjang.', false);
            });
        };

        // Update Item Qty
        window.updateCartItemQty = function(cartItemId, change) {
            const item = window.PERSIS_CART.data.items.find(i => i.id === cartItemId);
            if (!item) return;

            const newQty = item.quantity + change;

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
            });
        };

        // Remove Item
        window.removeCartItem = function(cartItemId) {
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
                    window.showCartToast('Item dihapus dari keranjang.');
                }
            });
        };

        // Clear Cart
        window.clearCart = function() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan seluruh isi keranjang belanja?')) return;

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
                    window.showCartToast('Keranjang belanja berhasil dikosongkan.');
                }
            });
        };

        // Render Cart UI
        window.renderCartDrawerUI = function(data) {
            const list = document.getElementById('cartDrawerItemsList');
            const countBadge = document.getElementById('cartDrawerCountBadge');
            const totalItemsText = document.getElementById('cartDrawerTotalItemsText');
            const subtotalText = document.getElementById('cartDrawerSubtotal');
            const footer = document.getElementById('cartDrawerFooter');

            if (!list) return;

            if (countBadge) countBadge.textContent = `${data.count} Item`;
            if (totalItemsText) totalItemsText.textContent = `${data.count} Eksemplar`;
            if (subtotalText) subtotalText.textContent = data.formatted_total;

            if (!data.items || data.items.length === 0) {
                list.innerHTML = `
                    <div class="h-full flex flex-col items-center justify-center text-center p-6 space-y-3.5 my-auto">
                        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-basket-shopping"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-slate-800 font-heading">Keranjang Masih Kosong</h4>
                            <p class="text-xs text-slate-400 mt-1 leading-relaxed max-w-xs">
                                Anda belum menambahkan koleksi buku ke keranjang. Jelajahi katalog sekarang!
                            </p>
                        </div>
                        <a href="{{ route('katalog') }}" onclick="window.closeCartDrawer()" class="px-4 py-2 bg-[#006830] text-white text-xs font-bold rounded-sm shadow-xs hover:bg-[#032c21] transition">
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
                    <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex gap-3 items-start transition hover:border-emerald-600">
                        <div class="w-14 h-19 aspect-[3/4.15] shrink-0 bg-slate-900 rounded-xs overflow-hidden border border-slate-200 shadow-2xs">
                            ${cover}
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] font-bold text-emerald-800 uppercase tracking-wider">${item.category}</span>
                            <h5 class="text-xs font-bold text-slate-900 line-clamp-2 leading-snug mt-0.5" title="${item.title}">${item.title}</h5>
                            <p class="text-[10px] text-slate-400 truncate mt-0.5">${item.author}</p>
                            
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100">
                                <div>
                                    <span class="font-mono font-black text-xs text-emerald-700">${item.formatted_subtotal}</span>
                                    <span class="text-[9.5px] text-slate-400 block">@ ${item.formatted_price}</span>
                                </div>
                                <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-sm border border-slate-200">
                                    <button type="button" onclick="window.updateCartItemQty(${item.id}, -1)" class="w-5 h-5 rounded-xs bg-white text-slate-700 hover:bg-emerald-700 hover:text-white flex items-center justify-center text-[10px] font-bold shadow-2xs transition">
                                        <i class="fa-solid fa-minus text-[8px]"></i>
                                    </button>
                                    <span class="text-xs font-black font-mono w-5 text-center text-slate-800">${item.quantity}</span>
                                    <button type="button" onclick="window.updateCartItemQty(${item.id}, 1)" class="w-5 h-5 rounded-xs bg-white text-slate-700 hover:bg-emerald-700 hover:text-white flex items-center justify-center text-[10px] font-bold shadow-2xs transition">
                                        <i class="fa-solid fa-plus text-[8px]"></i>
                                    </button>
                                </div>
                                <button type="button" onclick="window.removeCartItem(${item.id})" class="text-slate-300 hover:text-red-600 transition p-1" title="Hapus item">
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
