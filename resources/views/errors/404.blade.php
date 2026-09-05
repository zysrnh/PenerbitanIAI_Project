<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | PERSIS PERS</title>
    
    <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 text-slate-800 select-none">
    <div class="max-w-md w-full bg-white rounded-sm border border-slate-200 shadow-xl p-6 sm:p-8 text-center space-y-5">
        
        <div class="w-16 h-16 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-2xl mx-auto shadow-xs">
            <i class="fa-solid fa-book-bookmark"></i>
        </div>

        <div class="space-y-1.5">
            <span class="text-xs font-mono font-bold text-emerald-800 uppercase tracking-widest block">Error 404 • Tidak Ditemukan</span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-xs text-slate-500 leading-relaxed">
                Maaf, halaman atau buku yang Anda tuju tidak ditemukan, telah dipindahkan, atau tautan yang Anda akses kurang tepat.
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row gap-2">
            <a href="{{ route('home') }}" class="flex-1 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs">
                <i class="fa-solid fa-house text-xs"></i>
                <span>Beranda Utama</span>
            </a>
            <a href="{{ route('catalog.index') }}" class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-300 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs">
                <i class="fa-solid fa-book-open text-xs text-emerald-700"></i>
                <span>Katalog Buku</span>
            </a>
        </div>
    </div>
</body>
</html>
