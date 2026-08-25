<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'IAI PERSIS PRESS | Penerbitan & Percetakan'); ?></title>

    <!-- Google Fonts Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CSS (CDN - Tanpa NPM) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#064e3b',
                            950: '#032c21',
                        },
                        limebrand: '#84cc16'
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
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-brand-900 selection:text-white">

    <!-- Header / Navbar -->
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand Logo -->
                <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-brand-900 rounded-md flex items-center justify-center text-white shrink-0">
                        <i class="fa-solid fa-book-open-reader text-lg text-lime-400"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="text-[11px] font-extrabold text-brand-700 uppercase tracking-widest leading-none">IAI PERSIS</span>
                        </div>
                        <h1 class="font-extrabold text-xl text-brand-950 leading-none tracking-tight mt-0.5">PRESS</h1>
                        <span class="text-[10px] text-slate-500 font-semibold block mt-0.5">Penerbitan & Percetakan</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center space-x-6">
                    <a href="<?php echo e(url('/')); ?>" class="<?php echo e(request()->is('/') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold'); ?> text-xs tracking-wider uppercase transition">BERANDA</a>
                    <a href="<?php echo e(url('/#tentang')); ?>" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">TENTANG KAMI</a>
                    
                    <!-- Dropdown Layanan -->
                    <div class="relative group">
                        <button class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition flex items-center gap-1 py-2">
                            LAYANAN <i class="fa-solid fa-chevron-down text-[9px] text-slate-400"></i>
                        </button>
                        <div class="absolute top-full left-0 mt-1 w-48 bg-white border border-slate-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 py-1.5">
                            <a href="<?php echo e(url('/#layanan')); ?>" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Penerbitan Buku</a>
                            <a href="<?php echo e(url('/#layanan')); ?>" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Percetakan Umum</a>
                            <a href="<?php echo e(url('/#layanan')); ?>" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Jurnal & Majalah</a>
                            <a href="<?php echo e(url('/#layanan')); ?>" class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-900">Pengurusan ISBN</a>
                        </div>
                    </div>

                    <a href="<?php echo e(url('/#layanan')); ?>" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">PENERBITAN</a>
                    <a href="<?php echo e(url('/#katalog')); ?>" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">KATALOG BUKU</a>
                    <a href="<?php echo e(url('/#portfolio')); ?>" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">PORTFOLIO</a>
                    <a href="<?php echo e(url('/#berita')); ?>" class="text-slate-700 hover:text-brand-900 font-semibold text-xs tracking-wider uppercase transition">BERITA</a>
                    <a href="<?php echo e(url('/kontak')); ?>" class="<?php echo e(request()->is('kontak') ? 'text-brand-900 font-bold border-b-2 border-brand-900 pb-1' : 'text-slate-700 hover:text-brand-900 font-semibold'); ?> text-xs tracking-wider uppercase transition">KONTAK</a>
                </nav>

                <!-- Action Button -->
                <div class="hidden lg:flex items-center">
                    <a href="<?php echo e(url('/kontak')); ?>" class="bg-brand-950 hover:bg-brand-900 text-white px-5 py-2.5 rounded-md font-bold text-xs uppercase tracking-wider transition flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-cart-shopping text-sm text-lime-400"></i> ORDER ONLINE
                    </a>
                </div>

                <!-- Mobile Toggle Button -->
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="lg:hidden p-2 text-slate-700 hover:text-brand-900 focus:outline-none" aria-label="Buka Menu">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div id="mobile-menu" class="hidden lg:hidden py-4 border-t border-slate-100 space-y-1">
                <a href="<?php echo e(url('/')); ?>" class="block px-3 py-2 <?php echo e(request()->is('/') ? 'text-brand-900 font-bold bg-brand-50' : 'text-slate-700 hover:bg-slate-50'); ?> rounded-md text-xs uppercase">BERANDA</a>
                <a href="<?php echo e(url('/#tentang')); ?>" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-md text-xs font-semibold uppercase">TENTANG KAMI</a>
                <a href="<?php echo e(url('/#layanan')); ?>" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-md text-xs font-semibold uppercase">LAYANAN</a>
                <a href="<?php echo e(url('/#katalog')); ?>" class="block px-3 py-2 text-slate-700 hover:bg-slate-50 rounded-md text-xs font-semibold uppercase">KATALOG BUKU</a>
                <a href="<?php echo e(url('/kontak')); ?>" class="block px-3 py-2 <?php echo e(request()->is('kontak') ? 'text-brand-900 font-bold bg-brand-50' : 'text-slate-700 hover:bg-slate-50'); ?> rounded-md text-xs uppercase">KONTAK</a>
                <div class="pt-2">
                    <a href="<?php echo e(url('/kontak')); ?>" class="block text-center bg-brand-950 text-white py-2.5 rounded-md font-bold text-xs uppercase">
                        <i class="fa-solid fa-cart-shopping mr-1.5 text-lime-400"></i> ORDER ONLINE
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Body Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Gawe\IAIPersis\penerbitan.iaibandung.ac.id\resources\views/layouts/app.blade.php ENDPATH**/ ?>