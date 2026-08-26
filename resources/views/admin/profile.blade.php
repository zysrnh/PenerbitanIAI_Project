@extends('admin.layouts.app')

@section('title', 'Profil Saya')
@section('header_title', 'Pengaturan Profil & Keamanan Akun')

@section('content')
    <!-- Top Alert Banner -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm font-medium flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium space-y-1">
            @foreach($errors->all() as $error)
                <div>&bull; {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left: Edit Profile Info -->
        <div class="lg:col-span-6 bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="mb-5 border-b border-slate-100 pb-3.5 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Informasi Pribadi</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Perbarui nama lengkap, email, dan nomor WhatsApp Anda.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap &amp; Gelar</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $user->name) }}" 
                        required 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $user->email) }}" 
                        required 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. WhatsApp / HP</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone', $user->phone) }}" 
                        placeholder="Contoh: 08123456789" 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role Hak Akses</label>
                    <input 
                        type="text" 
                        value="{{ $user->role_label }}" 
                        disabled 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed font-medium"
                    />
                    <span class="text-[11px] text-slate-400 mt-1 block">Role hanya dapat diubah oleh sesama Super Admin.</span>
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold transition shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Change Password -->
        <div class="lg:col-span-6 bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="mb-5 border-b border-slate-100 pb-3.5 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Keamanan &amp; Kata Sandi</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Pastikan kata sandi akun Anda kuat dan selalu diperbarui.</p>
                </div>
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
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Minimal 6 karakter" 
                        required 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Ulangi kata sandi baru" 
                        required 
                        class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>

                <div class="pt-2">
                    <button type="submit" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-bold transition shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved"></i> Ganti Kata Sandi
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
