<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
        .brand-green { color: #006830; }
        .brand-btn { background-color: #006830; }
        .brand-btn:hover { background-color: #032c21; }
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 3px rgba(0,104,48,0.12); outline: none; }
        @keyframes slideUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:none; } }
        .slide-up { animation: slideUp 0.45s cubic-bezier(.16,1,.3,1) both; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 py-8 bg-slate-50">

    <div class="w-full max-w-sm slide-up">
        <!-- Official Logo (PERSIS PERS) -->
        <div class="text-center mb-6">
            <a href="{{ url('/') }}" class="inline-block transition-transform duration-200 hover:scale-105" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v={{ time() }}" alt="PERSIS PERS" class="h-14 sm:h-16 w-auto mx-auto object-contain" />
            </a>
            <p class="text-xs text-slate-500 mt-2 font-medium">Buat Akun Member Baru</p>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/80 p-6 sm:p-7">

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-xs text-red-700 font-medium">
                    <p class="flex items-center gap-1 font-bold mb-1"><i class="fa-solid fa-circle-exclamation"></i> Terdapat kesalahan:</p>
                    <ul class="ml-4 list-disc space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('member.register.submit') }}" class="space-y-3.5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Nama Lengkap Anda"
                            class="input-focus w-full pl-9 pr-4 py-2 text-xs sm:text-sm border border-slate-200 rounded-lg transition @error('name') border-red-400 @enderror"
                            required autofocus>
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email</label>
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="input-focus w-full pl-9 pr-4 py-2 text-xs sm:text-sm border border-slate-200 rounded-lg transition @error('email') border-red-400 @enderror"
                            required>
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp <span class="text-slate-400 font-normal">(opsional)</span></label>
                    <div class="relative">
                        <i class="fa-brands fa-whatsapp absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="input-focus w-full pl-9 pr-4 py-2 text-xs sm:text-sm border border-slate-200 rounded-lg transition">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="password" name="password" id="password"
                            placeholder="Minimal 8 karakter"
                            class="input-focus w-full pl-9 pr-10 py-2 text-xs sm:text-sm border border-slate-200 rounded-lg transition @error('password') border-red-400 @enderror"
                            required>
                        <button type="button" onclick="togglePassword('password', 'eye1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <i id="eye1" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="password" name="password_confirmation" id="passconf"
                            placeholder="Ulangi kata sandi"
                            class="input-focus w-full pl-9 pr-10 py-2 text-xs sm:text-sm border border-slate-200 rounded-lg transition"
                            required>
                        <button type="button" onclick="togglePassword('passconf', 'eye2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                            <i id="eye2" class="fa-solid fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <p class="text-[11px] text-slate-400 leading-relaxed pt-1">
                    Dengan mendaftar, Anda menyetujui ketentuan penggunaan layanan PERSIS PERS.
                </p>

                <!-- Submit -->
                <button type="submit"
                    class="brand-btn w-full py-2.5 text-white font-bold text-xs sm:text-sm rounded-lg transition flex items-center justify-center gap-2 shadow-xs">
                    <i class="fa-solid fa-user-plus text-xs"></i> Buat Akun
                </button>
            </form>
        </div>

        <!-- Login link -->
        <p class="text-center text-xs text-slate-500 mt-5">
            Sudah punya akun?
            <a href="{{ route('member.login') }}" class="brand-green font-bold hover:underline">Masuk di sini</a>
        </p>
        <p class="text-center text-xs text-slate-400 mt-2">
            <a href="{{ url('/') }}" class="hover:text-slate-600 transition flex items-center justify-center gap-1">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Beranda
            </a>
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
