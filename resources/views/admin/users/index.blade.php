@extends('admin.layouts.app')

@section('title', 'Manajemen Admin')
@section('header_title', 'Manajemen Admin & Pengguna')

@section('content')
    <!-- Section Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Admin</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola akun dan pembagian hak akses sistem penerbitan.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-3.5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-semibold transition flex items-center gap-2 shadow-xs">
            <i class="fa-solid fa-plus text-[11px]"></i> Tambah Admin Baru
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-3.5 mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <!-- Search Input -->
            <div class="sm:col-span-6 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama atau email admin..." 
                    class="w-full pl-9 pr-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition bg-slate-50/50"
                />
            </div>

            <!-- Role Select -->
            <div class="sm:col-span-4">
                <select name="role" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 bg-slate-50/50 text-slate-700">
                    <option value="">Semua Role</option>
                    <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin Biasa</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg transition">
                    Cari
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium rounded-lg transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50/75 text-slate-500 uppercase text-[10px] font-bold border-b border-slate-200/80 tracking-wider">
                    <tr>
                        <th class="px-5 py-3">Nama Lengkap</th>
                        <th class="px-5 py-3">Alamat Email</th>
                        <th class="px-5 py-3">Role</th>
                        <th class="px-5 py-3">Dibuat Pada</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-5 py-3.5 font-semibold text-slate-900 flex items-center gap-3">
                                <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-[11px] ring-1 ring-slate-200 shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="truncate">{{ $user->name }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-slate-600 font-normal">{{ $user->email }}</td>
                            <td class="px-5 py-3.5">
                                @if($user->role === 'super_admin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-semibold bg-rose-50 text-rose-700 ring-1 ring-rose-200/70">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/70">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-slate-500 text-[11px]">{{ $user->created_at ? $user->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="px-5 py-3.5 text-right space-x-1.5">
                                <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition border border-slate-200">
                                    <i class="fa-solid fa-pen text-[9px] mr-1 text-slate-400"></i> Edit
                                </a>
                                @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block" onsubmit="return confirm('Hapus admin ini dari sistem?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-2 py-1 rounded-md text-[11px] font-medium text-rose-600 hover:text-rose-800 hover:bg-rose-50 transition border border-rose-200/60">
                                            <i class="fa-solid fa-trash text-[9px] mr-1"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-400">
                                Belum ada data admin ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-5 py-3 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
