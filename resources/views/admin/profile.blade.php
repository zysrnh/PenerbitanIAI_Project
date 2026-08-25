@extends('admin.layouts.app')

@section('title', 'Profil Saya')
@section('header_title', 'Pengaturan Profil & Keamanan')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Edit Profile Info -->
        <div class="lg:col-span-6 bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="mb-5 border-b border-slate-100 pb-3.5">
                <h3 class="text-sm font-bold text-slate-900">Informasi Pribadi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Perbarui nama lengkap, email, dan nomor WhatsApp Anda.</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <div>&bull; {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap & Gelar</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. WhatsApp / HP</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone', $user->phone) }}" 
                        placeholder="Contoh: 08123456789" 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role Hak Akses</label>
                    <input 
                        type="text" 
                        value="{{ $user->role_label }}" 
                        disabled 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed"
                    />
                    <span class="text-[11px] text-slate-400 mt-1 block">Role hanya dapat diubah oleh sesama Super Admin.</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-semibold transition">
                        Simpan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Change Password -->
        <div class="lg:col-span-6 bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="mb-5 border-b border-slate-100 pb-3.5">
                <h3 class="text-sm font-bold text-slate-900">Keamanan & Kata Sandi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Pastikan kata sandi akun Anda kuat dan selalu diperbarui.</p>
            </div>

            <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                    <input 
                        type="password" 
                        name="current_password" 
                        placeholder="••••••••" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Minimal 6 karakter" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Ulangi kata sandi baru" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-semibold transition">
                        Ganti Kata Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
