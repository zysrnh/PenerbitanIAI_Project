<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Masuk Admin | PERSIS PERS</title>

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
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            -webkit-tap-highlight-color: transparent;
        } 
        .input-focus {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-focus:focus { 
            border-color: #006830; 
            box-shadow: 0 0 0 3px rgba(0,104,48,0.18); 
            background-color: #ffffff;
            outline: none; 
        }
        
        /* Ultra Smooth Entrance Animation */
        @keyframes smoothFadeUp {
            0% {
                opacity: 0;
                transform: translateY(14px) scale(0.99);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .animate-smooth-in {
            animation: smoothFadeUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @media (max-width: 640px) {
            .auth-container {
                min-height: 100dvh;
            }
        }
    </style>
</head>
<body class="h-full antialiased auth-container flex flex-col items-center justify-center p-3.5 sm:p-6 bg-[#0a0f1d] text-slate-100 selection:bg-emerald-500 selection:text-white">

    <div class="w-full max-w-sm my-auto animate-smooth-in space-y-4">
        
        <!-- Official Logo Header -->
        <div class="text-center space-y-1.5">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-300 hover:scale-105 active:scale-95" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-12 sm:h-14 w-auto mx-auto object-contain" />
            </a>
            <p class="text-xs text-slate-400 font-medium tracking-tight">Panel Administrasi &amp; Redaksi</p>
        </div>

        <!-- Main Admin Login Card -->
        <div class="bg-white text-slate-800 rounded-sm shadow-2xl border border-slate-200 p-5 sm:p-7 space-y-4">
            
            @if(session('success'))
                <div class="p-3 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2.5 animate-fade-in">
                    <i class="fa-solid fa-circle-check text-emerald-600 shrink-0 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2.5 animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 shrink-0 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2.5 animate-fade-in">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 shrink-0 text-sm"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-3.5">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1">
                    <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            value="{{ old('email') }}" 
                            placeholder="admin@persispers.com" 
                            required 
                            autofocus
                            class="input-focus w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                        />
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1">
                    <label for="adminPassword" class="block text-xs font-bold text-slate-700">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="adminPassword"
                            placeholder="Masukkan kata sandi" 
                            required 
                            class="input-focus w-full pl-9 pr-10 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                        />
                        <button 
                            type="button" 
                            onclick="togglePass()" 
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-600 active:scale-90 transition rounded-sm cursor-pointer"
                            aria-label="Toggle Password Visibility"
                        >
                            <i id="eyeIcon" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs pt-0.5 select-none">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded-xs border-slate-300 text-emerald-700 focus:ring-emerald-700" />
                        <span class="text-xs">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-2.5 sm:py-2 bg-[#006830] hover:bg-[#032c21] active:scale-[0.98] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-2xs mt-2 flex items-center justify-center gap-2 cursor-pointer"
                >
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    <span>Masuk Admin</span>
                </button>
            </form>

            <div class="mt-4 pt-3.5 border-t border-slate-100 text-center">
                <a href="{{ url('/') }}" class="text-xs text-slate-400 hover:text-slate-700 transition inline-flex items-center gap-1.5 py-1">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
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
