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
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="flex items-center py-1 group" title="PERSIS PERS">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-11 sm:h-13 w-auto object-contain transition-transform duration-200 group-hover:scale-105" />
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
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-brand-900 rounded-lg flex items-center justify-center text-white shrink-0">
                            <i class="fa-solid fa-book-open-reader text-lg text-emerald-400"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-extrabold text-brand-300 uppercase tracking-widest block">IAI PERSIS</span>
                            <h4 class="font-extrabold text-lg text-white font-heading leading-tight">PRESS</h4>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Penerbitan & Percetakan Resmi Institut Agama Islam Persatuan Islam (IAI PERSIS) Bandung. Melayani penerbitan buku ber-ISBN, modul ajar, jurnal ilmiah, dan percetakan berkualitas tinggi.
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
</body>
</html>
