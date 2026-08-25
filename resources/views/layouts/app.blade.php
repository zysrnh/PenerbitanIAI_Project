<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Penerbitan & Persis Press | IAI PERSIS Bandung')</title>

    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS (CDN - Tanpa Perlu NPM) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        },
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                            950: '#451a03',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-800 selection:text-white">

    <!-- Top Bar Header -->
    <div class="bg-emerald-950 text-emerald-100 text-xs py-2.5 px-4 hidden md:block border-b border-emerald-900/60">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span><i class="fa-solid fa-envelope text-amber-500 mr-1.5"></i> penerbitan@iaipibandung.ac.id</span>
                <span><i className="fa-solid fa-phone text-amber-500 mr-1.5"></i> (022) 5441951</span>
                <span><i class="fa-solid fa-location-dot text-amber-500 mr-1.5"></i> Bojongsoang, Bandung</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-emerald-300/90 font-medium">Layanan Penerbitan Buku & Jurnal Ilmiah</span>
                <div class="flex items-center space-x-3">
                    <a href="#" class="hover:text-amber-400 transition"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-amber-400 transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-amber-400 transition"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo & Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 bg-emerald-900 rounded-xl flex items-center justify-center text-white shadow-md group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-book-open text-xl text-amber-400"></i>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-base sm:text-lg text-emerald-950 leading-tight">PERSIS PRESS</h1>
                        <span class="text-[11px] text-emerald-700 font-bold tracking-wider block uppercase">Penerbitan IAI PERSIS Bandung</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center space-x-7">
                    <a href="{{ url('/') }}" class="text-emerald-900 font-semibold border-b-2 border-emerald-800 px-1 py-1 text-sm">Beranda</a>
                    <a href="#katalog" class="text-slate-600 hover:text-emerald-800 font-medium px-1 py-1 text-sm transition">Katalog Buku</a>
                    <a href="#layanan" class="text-slate-600 hover:text-emerald-800 font-medium px-1 py-1 text-sm transition">Layanan ISBN</a>
                    <a href="#jurnal" class="text-slate-600 hover:text-emerald-800 font-medium px-1 py-1 text-sm transition">E-Journal</a>
                    <a href="#panduan" class="text-slate-600 hover:text-emerald-800 font-medium px-1 py-1 text-sm transition">Panduan Penulis</a>
                    <a href="#kontak" class="text-slate-600 hover:text-emerald-800 font-medium px-1 py-1 text-sm transition">Kontak</a>
                    
                    <a href="#kirim-naskah" class="bg-emerald-800 hover:bg-emerald-900 text-white px-5 py-2.5 rounded-lg font-bold text-sm shadow-md shadow-emerald-900/10 transition flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up text-amber-400"></i> Kirim Naskah
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="lg:hidden p-2 text-slate-700 hover:text-emerald-800 focus:outline-none">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden lg:hidden py-4 border-t border-slate-100 space-y-2">
                <a href="{{ url('/') }}" class="block px-3 py-2 text-emerald-900 font-bold bg-emerald-50 rounded-lg">Beranda</a>
                <a href="#katalog" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-lg">Katalog Buku</a>
                <a href="#layanan" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-lg">Layanan ISBN</a>
                <a href="#jurnal" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-lg">E-Journal</a>
                <a href="#panduan" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-lg">Panduan Penulis</a>
                <a href="#kontak" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-lg">Kontak</a>
                <div class="pt-2">
                    <a href="#kirim-naskah" class="block text-center bg-emerald-800 text-white py-3 rounded-lg font-bold">
                        <i class="fa-solid fa-cloud-arrow-up mr-1 text-amber-400"></i> Kirim Naskah
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-emerald-950 text-emerald-200 py-16 border-t border-emerald-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3.5 mb-5">
                        <div class="w-10 h-10 bg-emerald-800 rounded-xl flex items-center justify-center text-white">
                            <i class="fa-solid fa-book-open text-amber-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-extrabold text-white tracking-wider">PERSIS PRESS</h3>
                            <p class="text-xs text-emerald-400 font-semibold">Penerbitan IAI PERSIS Bandung</p>
                        </div>
                    </div>
                    <p class="text-sm text-emerald-200/80 leading-relaxed mb-6">
                        Pusat penerbitan buku ilmiah, buku ajar, monograf, dan publikasi jurnal akademik di lingkungan Institut Agama Islam Persatuan Islam (IAI PERSIS) Bandung.
                    </p>
                    <div class="flex items-center space-x-3">
                        <a href="#" class="w-9 h-9 bg-emerald-900 hover:bg-emerald-800 flex items-center justify-center text-emerald-100 hover:text-amber-400 transition rounded-lg"><i class="fa-brands fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-emerald-900 hover:bg-emerald-800 flex items-center justify-center text-emerald-100 hover:text-amber-400 transition rounded-lg"><i class="fa-brands fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-emerald-900 hover:bg-emerald-800 flex items-center justify-center text-emerald-100 hover:text-amber-400 transition rounded-lg"><i class="fa-brands fa-youtube text-sm"></i></a>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-white font-bold mb-5 text-sm tracking-widest uppercase">Layanan & Menu</h4>
                    <ul class="space-y-3 text-sm text-emerald-200/80">
                        <li><a href="#katalog" class="hover:text-amber-400 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px]"></i> Katalog Buku Terbaru</a></li>
                        <li><a href="#layanan" class="hover:text-amber-400 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px]"></i> Pengajuan ISBN & HKI</a></li>
                        <li><a href="#panduan" class="hover:text-amber-400 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px]"></i> Template Naskah</a></li>
                        <li><a href="#jurnal" class="hover:text-amber-400 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px]"></i> Portal E-Journal</a></li>
                        <li><a href="https://iaipibandung.ac.id" target="_blank" class="hover:text-amber-400 transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px]"></i> Website Utama Kampus</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-white font-bold mb-5 text-sm tracking-widest uppercase">Kantor Redaksi</h4>
                    <ul class="space-y-3.5 text-sm text-emerald-200/80">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot mt-1 text-amber-500"></i>
                            <span>Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Cipagalo, Bojongsoang, Bandung, Jawa Barat 40287</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-amber-500"></i>
                            <span>penerbitan@iaipibandung.ac.id</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-amber-500"></i>
                            <span>(022) 5441951 / +62 821-1611-6133</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-emerald-900 mt-12 pt-8 text-center text-xs text-emerald-300/60">
                &copy; {{ date('Y') }} Penerbitan & Persis Press - IAI PERSIS Bandung. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
