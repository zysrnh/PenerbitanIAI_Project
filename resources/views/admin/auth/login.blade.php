<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk Admin | PERSIS PERS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="h-full antialiased flex items-center justify-center p-4 bg-[#0a0f1d] selection:bg-emerald-500 selection:text-white">

    <div class="w-full max-w-sm">
        <!-- Brand Header -->
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-slate-900 border border-slate-800 rounded-xl flex items-center justify-center text-emerald-400 mx-auto mb-3 shadow-sm">
                <i class="fa-solid fa-book-open-reader text-xl"></i>
            </div>
            <h1 class="text-lg font-bold text-white tracking-tight">PERSIS PERS</h1>
            <p class="text-xs text-slate-400 mt-0.5">Masuk ke panel administrasi</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/80 p-6 sm:p-7">
            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-3.5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@iaipibandung.ac.id" 
                        required 
                        autofocus
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="••••••••" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-700" />
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-semibold uppercase tracking-wider transition shadow-xs mt-2"
                >
                    Masuk
                </button>
            </form>

            <div class="mt-5 pt-4 border-t border-slate-100 text-center text-xs text-slate-400">
                <a href="{{ url('/') }}" class="hover:text-slate-700 font-medium transition">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>

</body>
</html>
