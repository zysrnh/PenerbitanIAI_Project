<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Setel Ulang Kata Sandi | PERSIS PERS</title>

    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">

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
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-3.5 sm:p-6 bg-slate-100 antialiased text-slate-800 selection:bg-emerald-600 selection:text-white">

    <div class="w-full max-w-sm my-auto animate-smooth-in space-y-4">
        
        <!-- Official Logo Header -->
        <div class="text-center space-y-1.5">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-300 hover:scale-105 active:scale-95" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-12 sm:h-14 w-auto mx-auto object-contain" />
            </a>
            <p class="text-xs text-slate-500 font-medium tracking-tight">Setel Ulang Kata Sandi Akun</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-sm shadow-xl border border-slate-200/90 p-5 sm:p-7 space-y-4">
            
            <div class="space-y-1">
                <h1 class="text-base sm:text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-[#006830]"></i>
                    <span>Kata Sandi Baru</span>
                </h1>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Buat kata sandi baru untuk akun Anda.
                </p>
            </div>

            @if(session('error'))
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 shrink-0 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 shrink-0 text-sm"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('member.password.update') }}" class="space-y-3.5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}" />

                <!-- Email Input -->
                <div class="space-y-1">
                    <label for="email" class="block text-xs font-bold text-slate-700">Email Akun</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            value="{{ old('email', $email) }}" 
                            required 
                            readonly
                            class="w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-slate-100 text-slate-600 font-medium cursor-not-allowed"
                        />
                    </div>
                </div>

                <!-- New Password Input -->
                <div class="space-y-1">
                    <label for="newPassword" class="block text-xs font-bold text-slate-700">Kata Sandi Baru</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="newPassword"
                            placeholder="Minimal 8 karakter" 
                            required 
                            autofocus
                            class="input-focus w-full pl-9 pr-10 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                        />
                        <button 
                            type="button" 
                            onclick="toggleNewPassMember()" 
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center text-slate-400 hover:text-slate-600 active:scale-90 transition rounded-sm cursor-pointer"
                            aria-label="Toggle Password Visibility"
                        >
                            <i id="eyeNewIconMember" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm New Password Input -->
                <div class="space-y-1">
                    <label for="newPasswordConfirm" class="block text-xs font-bold text-slate-700">Ulangi Kata Sandi Baru</label>
                    <div class="relative">
                        <i class="fa-solid fa-check-double absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="newPasswordConfirm"
                            placeholder="Ketik ulang kata sandi baru" 
                            required 
                            class="input-focus w-full pl-9 pr-3.5 py-2.5 sm:py-2 text-xs sm:text-sm rounded-sm border border-slate-300 transition bg-slate-50/60"
                        />
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-2.5 sm:py-2 bg-[#006830] hover:bg-[#032c21] active:scale-[0.98] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-2xs mt-2 flex items-center justify-center gap-2 cursor-pointer"
                >
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan &amp; Masuk</span>
                </button>
            </form>

            <div class="mt-4 pt-3.5 border-t border-slate-100 text-center">
                <a href="{{ route('member.login') }}" class="text-xs text-slate-400 hover:text-slate-700 transition inline-flex items-center gap-1.5 py-1">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Halaman Masuk</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleNewPassMember() {
            const pass = document.getElementById('newPassword');
            const icon = document.getElementById('eyeNewIconMember');
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
