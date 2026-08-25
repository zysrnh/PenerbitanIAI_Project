@extends('admin.layouts.app')

@section('title', 'Edit Admin')
@section('header_title', 'Edit Data Admin')

@section('content')
    <div class="max-w-xl bg-white rounded-xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
        <div class="mb-5 border-b border-slate-100 pb-3.5">
            <h3 class="text-sm font-bold text-slate-900">Perbarui Data Admin</h3>
            <p class="text-xs text-slate-500 mt-0.5">Edit informasi akun atau ganti kata sandi admin.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                />
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                />
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Role Akses <span class="text-rose-500">*</span></label>
                <select name="role" required class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 bg-white text-slate-700">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin Biasa (Operator)</option>
                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin (Akses Penuh)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru (Opsional)</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Kosongkan jika tidak ingin mengganti kata sandi" 
                    class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                />
                <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengubah password saat ini.</span>
            </div>

            <div class="pt-3 flex items-center gap-2.5">
                <button type="submit" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-semibold transition">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
