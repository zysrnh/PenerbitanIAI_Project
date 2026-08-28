<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak | PERSIS PERS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
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
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 text-slate-800">
    <div class="max-w-md w-full bg-white rounded-sm border border-slate-200 shadow-xl p-6 sm:p-8 text-center space-y-5">
        
        <div class="w-16 h-16 rounded-full bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center text-2xl mx-auto shadow-xs">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <div class="space-y-1.5">
            <span class="text-xs font-mono font-bold text-rose-600 uppercase tracking-widest block">Error 403 • Akses Terbatas</span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">
                Akses Ditolak
            </h1>
            <p class="text-xs text-slate-500 leading-relaxed">
                {{ $exception->getMessage() ?: 'Anda tidak memiliki izin atau wewenang untuk mengakses halaman ini.' }}
            </p>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row gap-2">
            @if(Auth::check() && Auth::user()->role === 'member')
                <a href="{{ route('member.dashboard') }}" class="flex-1 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Dashboard Member</span>
                </a>
            @elseif(Auth::check() && in_array(Auth::user()->role, ['admin', 'super_admin']))
                <a href="{{ route('admin.dashboard') }}" class="flex-1 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    <span>Kembali ke Dashboard Admin</span>
                </a>
            @else
                <a href="{{ route('home') }}" class="flex-1 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-xs">
                    <i class="fa-solid fa-house text-xs"></i>
                    <span>Kembali ke Beranda Utama</span>
                </a>
            @endif
        </div>
    </div>
</body>
</html>
