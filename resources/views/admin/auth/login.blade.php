<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator | PERSIS PERS</title>

    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        .font-heading { font-family: 'Outfit', sans-serif; }
        .input-focus:focus { border-color: #10b981; box-shadow: 0 0 0 2px rgba(16,185,129,0.2); outline: none; }
    </style>
</head>
<body class="min-h-screen antialiased flex items-center justify-center p-4 bg-gradient-to-br from-[#032c21] via-[#043d2f] to-[#021d16] text-slate-100 selection:bg-emerald-500 selection:text-white relative overflow-hidden">

    <!-- Background Accents -->
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-sm relative z-10 space-y-4">
        
        <!-- Official Logo Header -->
        <div class="text-center space-y-2">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-200 hover:scale-105" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-14 sm:h-16 w-auto mx-auto object-contain" />
            </a>
            
            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 border border-white/15 rounded-full text-[10.5px] font-extrabold uppercase tracking-wider text-emerald-300 font-mono">
                <i class="fa-solid fa-shield-halved text-emerald-400"></i>
                <span>Portal Khusus Pengelola Redaksi</span>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white text-slate-800 rounded-sm shadow-2xl border border-white/20 p-6 sm:p-7 space-y-4">
            
            <div>
                <h1 class="text-lg font-black text-slate-900 font-heading">Login Administrator</h1>
                <p class="text-xs text-slate-500 mt-0.5">Masukkan kredensial staf redaksi untuk mengelola transaksi &amp; katalog.</p>
            </div>

            @if(session('success'))
                <div class="p-3 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-3.5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Administrator</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="admin@iaipibandung.ac.id" 
                            required 
                            autofocus
                            class="input-focus w-full pl-9 pr-3 py-2.5 text-xs rounded-sm border border-slate-300 transition bg-slate-50/50"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="adminPassword"
                            placeholder="••••••••" 
                            required 
                            class="input-focus w-full pl-9 pr-10 py-2.5 text-xs rounded-sm border border-slate-300 transition bg-slate-50/50"
                        />
                        <button type="button" onclick="togglePass()" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i id="eyeIcon" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded-xs border-slate-300 text-emerald-700 focus:ring-emerald-700" />
                        <span>Ingat sesi admin</span>
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-xs mt-1 flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-shield-halved text-xs"></i>
                    <span>Masuk Panel Admin</span>
                </button>
            </form>

            <!-- Switcher to Member Portal -->
            <div class="pt-3 border-t border-slate-100 text-center">
                <a href="{{ route('member.login') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 hover:underline inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-user text-[11px]"></i>
                    <span>Bukan admin? Masuk sebagai Member / Pembaca &rarr;</span>
                </a>
            </div>

        </div>

        <!-- Back to Website -->
        <div class="text-center">
            <a href="{{ url('/') }}" class="text-xs text-emerald-200/80 hover:text-white transition inline-flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Kembali ke Beranda Utama</span>
            </a>
        </div>

    </div>

    <script>
        function togglePass() {
            const pass = document.getElementById('adminPassword');
            const icon = document.getElementById('eyeIcon');
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
