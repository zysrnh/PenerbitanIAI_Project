<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f4f1; }
        .brand-dark { background-color: #032c21; }
        .brand-green { color: #006830; }
        .brand-btn { background-color: #006830; }
        .brand-btn:hover { background-color: #032c21; }
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 3px rgba(0,104,48,0.12); outline: none; }
        @keyframes slideUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:none; } }
        .slide-up { animation: slideUp 0.5s cubic-bezier(.16,1,.3,1) both; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-sm slide-up">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 mb-3">
                <div class="brand-dark rounded-lg p-2 flex items-center justify-center">
                    <i class="fa-solid fa-book-open text-emerald-400 text-lg"></i>
                </div>
                <div class="text-left">
                    <div class="text-[10px] font-bold text-slate-500 tracking-widest uppercase leading-none">IAI PERSIS</div>
                    <div class="text-xl font-extrabold text-slate-900 leading-tight">PERSIS <span class="brand-green">PERS</span></div>
                </div>
            </a>
            <p class="text-xs text-slate-500 mt-1">Masuk ke akun member Anda</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-7">
            
            @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-lg flex items-center gap-2 text-xs text-emerald-800 font-medium">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2 text-xs text-red-700 font-medium">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i> {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('member.login.submit') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="email" name="email" id="email"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="input-focus w-full pl-9 pr-4 py-2.5 text-sm border border-slate-200 rounded-lg transition @error('email') border-red-400 bg-red-50 @enderror"
                            required autofocus>
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="password" name="password" id="password"
                            placeholder="Masukkan kata sandi"
                            class="input-focus w-full pl-9 pr-10 py-2.5 text-sm border border-slate-200 rounded-lg transition"
                            required>
                        <button type="button" onclick="togglePassword('password', 'eyeIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <i id="eyeIcon" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600 w-3.5 h-3.5">
                        <span class="text-xs text-slate-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="brand-btn w-full py-2.5 text-white font-bold text-sm rounded-lg transition flex items-center justify-center gap-2 mt-1">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i> Masuk
                </button>
            </form>
        </div>

        <!-- Register link -->
        <p class="text-center text-xs text-slate-500 mt-5">
            Belum punya akun?
            <a href="{{ route('member.register') }}" class="brand-green font-bold hover:underline">Daftar sekarang</a>
        </p>
        <p class="text-center text-xs text-slate-400 mt-2">
            <a href="{{ url('/') }}" class="hover:text-slate-600 transition"><i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Beranda</a>
        </p>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fa-solid fa-eye-slash text-xs';
            } else {
                input.type = 'password';
                icon.className = 'fa-solid fa-eye text-xs';
            }
        }
    </script>
</body>
</html>
