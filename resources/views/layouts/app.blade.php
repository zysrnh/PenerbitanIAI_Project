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
    </style>
</head>
<body class="antialiased text-slate-800 bg-white selection:bg-brand-800 selection:text-white flex flex-col min-h-screen">

    <!-- Top Sticky Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-brand-900 rounded-lg flex items-center justify-center text-white shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-sm">
                        <i class="fa-solid fa-book-open-reader text-lg text-emerald-400"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] font-extrabold text-brand-700 uppercase tracking-widest leading-none">PENERBITAN</span>
                        </div>
                        <h1 class="font-extrabold text-xl text-brand-950 font-heading leading-none tracking-tight mt-0.5">PERSIS PERS</h1>
                        <span class="text-[10px] text-slate-500 font-semibold block mt-0.5">Penerbitan & Percetakan</span>
                    </div>
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

                    <a href="{{ url('/#katalog') }}" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">KATALOG BUKU</a>
                    <a href="{{ url('/kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold' }} text-xs tracking-wider uppercase transition">KONTAK</a>
                </nav>

                <!-- Header CTA Button -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ url('/kontak') }}" class="px-5 py-2.5 bg-brand-900 hover:bg-brand-950 text-white rounded-lg font-bold text-xs tracking-wider uppercase transition flex items-center gap-2 shadow-xs hover:shadow-md hover:scale-102 transform duration-200">
                        <i class="fa-solid fa-cart-shopping text-emerald-400"></i> ORDER ONLINE
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex lg:hidden items-center gap-2">
                    <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="p-2.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 focus:outline-none">
                        <i class="fa-solid fa-bars text-lg"></i>
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
            <div class="pt-3 border-t border-slate-100">
                <a href="{{ url('/kontak') }}" class="w-full py-3 bg-brand-900 text-white rounded-lg font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2">
                    <i class="fa-solid fa-cart-shopping text-emerald-400"></i> ORDER ONLINE
                </a>
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
