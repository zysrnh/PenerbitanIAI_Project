<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Daftar Member | PERSIS PERS</title>

    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #f1f5f9;
            -webkit-tap-highlight-color: transparent;
        }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .input-focus {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .input-focus:focus { 
            border-color: #006830; 
            box-shadow: 0 0 0 3px rgba(0,104,48,0.14); 
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
<body class="min-h-screen auth-container flex flex-col items-center justify-center p-3.5 sm:p-6 py-6 sm:py-10 bg-slate-100 antialiased text-slate-800 selection:bg-emerald-600 selection:text-white">

    <div class="w-full max-w-sm my-auto animate-smooth-in space-y-4">
        
        <!-- Official Logo Header -->
        <div class="text-center space-y-1.5">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-300 hover:scale-105 active:scale-95" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-12 sm:h-14 w-auto mx-auto object-contain" />
            </a>
            <p class="text-xs text-slate-500 font-medium tracking-tight">Buat Akun Member Baru</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-sm shadow-xl border border-slate-200/90 p-5 sm:p-7 space-y-3.5">

            @if ($errors->any())
                <div class="p-3 bg-rose-50 border border-rose-200 rounded-sm text-xs text-rose-800 font-semibold animate-fade-in space-y-1">
                    <p class="flex items-center gap-1.5 font-bold">
                        <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                        <span>Mohon periksa data formulir:</span>
                    </p>
                    <ul class="ml-4 list-disc space-y-0.5 text-[11px] font-medium text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('member.register.submit') }}" class="space-y-3">
                @csrf
                @if(request('redirect'))
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                @endif

                <!-- Name Input -->
                <div class="space-y-1">
                    <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="text" 
                            name="name" 
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="Nama Lengkap Anda"
                            class="input-focus w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                            required 
                            autofocus
                        />
                    </div>
                </div>

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
                            placeholder="nama@email.com"
                            class="input-focus w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                            required
                        />
                    </div>
                </div>

                <!-- Phone Input -->
                <div class="space-y-1">
                    <label for="phone" class="block text-xs font-bold text-slate-700">No. WhatsApp <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <div class="relative">
                        <i class="fa-brands fa-whatsapp absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="text" 
                            name="phone" 
                            id="phone"
                            value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="input-focus w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                        />
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-1">
                    <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            placeholder="Minimal 8 karakter"
                            class="input-focus w-full pl-9 pr-10 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                            required
                        />
                        <button 
                            type="button" 
                            onclick="togglePassword('password', 'eye1')"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-600 active:scale-90 transition rounded-sm cursor-pointer"
                            aria-label="Toggle Password Visibility"
                        >
                            <i id="eye1" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Confirmation Input -->
                <div class="space-y-1">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation"
                            placeholder="Ulangi kata sandi"
                            class="input-focus w-full pl-9 pr-10 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                            required
                        />
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation', 'eye2')"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-600 active:scale-90 transition rounded-sm cursor-pointer"
                            aria-label="Toggle Confirm Password Visibility"
                        >
                            <i id="eye2" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-2.5 sm:py-2 bg-[#006830] hover:bg-[#032c21] active:scale-[0.98] text-white font-bold text-xs uppercase tracking-wider rounded-sm transition-all duration-200 flex items-center justify-center gap-2 shadow-2xs mt-3 cursor-pointer"
                >
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>Daftar Sekarang</span>
                </button>
            </form>

            <div class="mt-4 pt-3.5 border-t border-slate-100 text-center space-y-2">
                <p class="text-xs text-slate-500">
                    Sudah punya akun? 
                    <a href="{{ route('member.login') }}" class="font-bold text-emerald-700 hover:text-emerald-900 hover:underline transition">Masuk di Sini</a>
                </p>
                <div>
                    <a href="{{ url('/') }}" class="text-xs text-slate-400 hover:text-slate-700 transition inline-flex items-center gap-1.5 py-1">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
