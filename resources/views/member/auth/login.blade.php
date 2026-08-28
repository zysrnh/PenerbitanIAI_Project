<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Member &amp; Pembaca | PERSIS PERS</title>

    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 2px rgba(0,104,48,0.15); outline: none; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-slate-100 text-slate-800 antialiased">

    <div class="w-full max-w-sm space-y-4">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-200 hover:scale-105" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-12 sm:h-14 w-auto mx-auto object-contain" />
            </a>
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 border border-emerald-200 rounded-full text-[10.5px] font-extrabold uppercase tracking-wider text-emerald-800 font-mono">
                <i class="fa-solid fa-user-check text-emerald-700"></i>
                <span>Portal Member &amp; Pembaca</span>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-sm shadow-xl border border-slate-200/90 p-6 sm:p-7 space-y-4">
            
            <div>
                <h1 class="text-lg font-black text-slate-900 font-heading">Masuk Akun Member</h1>
                <p class="text-xs text-slate-500 mt-0.5">Akses riwayat pesanan buku, resi pengiriman, dan naskah publikasi.</p>
            </div>

            @if(session('success'))
                <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-sm flex items-center gap-2 text-xs text-emerald-800 font-semibold">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-sm flex items-center gap-2 text-xs text-rose-800 font-semibold">
                    <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-sm flex items-center gap-2 text-xs text-rose-800 font-semibold">
                    <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('member.login.submit') }}" class="space-y-3.5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="email" name="email" id="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="input-focus w-full pl-9 pr-3 py-2.5 text-xs rounded-sm border border-slate-300 transition bg-slate-50/50"
                            required autofocus>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="password" name="password" id="password"
                            placeholder="••••••••"
                            class="input-focus w-full pl-9 pr-10 py-2.5 text-xs rounded-sm border border-slate-300 transition bg-slate-50/50"
                            required>
                        <button type="button" onclick="togglePassMember()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <i id="eyeIconMember" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                        <input type="checkbox" name="remember" class="rounded-xs border-slate-300 text-emerald-700 focus:ring-emerald-700">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs uppercase tracking-wider rounded-sm transition flex items-center justify-center gap-2 shadow-xs mt-1 cursor-pointer">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    <span>Masuk ke Akun Member</span>
                </button>
            </form>

            <div class="pt-3 border-t border-slate-100 text-center space-y-2">
                <p class="text-xs text-slate-500">
                    Belum punya akun member? 
                    <a href="{{ route('member.register') }}" class="font-bold text-emerald-700 hover:underline">Daftar Sekarang</a>
                </p>
                <div class="pt-1">
                    <a href="{{ route('admin.login') }}" class="text-[11px] font-semibold text-slate-500 hover:text-emerald-800 inline-flex items-center gap-1">
                        <i class="fa-solid fa-shield-halved text-[10px]"></i>
                        <span>Pengelola Redaksi? Masuk Panel Admin di sini &rarr;</span>
                    </a>
                </div>
            </div>

        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="text-xs text-slate-500 hover:text-slate-800 transition inline-flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Beranda Utama</span>
            </a>
        </div>

    </div>

    <script>
        function togglePassMember() {
            const pass = document.getElementById('password');
            const icon = document.getElementById('eyeIconMember');
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pass.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
