@extends('admin.layouts.app')

@section('title', 'Manajemen Admin | PERSIS PERS')
@section('header_title', 'Manajemen Admin & Pengguna')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Section Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    MANAJEMEN PENGGUNA
                </span>
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• {{ $users->total() }} Akun Terdaftar</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Daftar Administrator &amp; Redaksi
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Kelola akun pengelola redaksi, hak akses operator, dan perizinan sistem penerbitan.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="px-3.5 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs shrink-0 cursor-pointer">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Admin Baru</span>
        </a>
    </div>

    <!-- Filter Bar with Custom Enterprise Dropdowns -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-3.5">
        <form method="GET" action="{{ route('admin.users.index') }}" id="userFilterForm" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2.5 items-center">
            
            <!-- Search Input -->
            <div class="sm:col-span-2 lg:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama, email, no whatsapp..." 
                    class="w-full pl-9 pr-3.5 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition bg-slate-50/50"
                />
            </div>

            <!-- Custom Role Filter Dropdown -->
            <div class="lg:col-span-3 relative" id="userRoleFilterContainer">
                <input type="hidden" name="role" id="userRoleInput" value="{{ request('role') }}" />
                <button 
                    type="button" 
                    id="userRoleBtn"
                    class="w-full px-3 py-2 bg-slate-50/50 border border-slate-300 rounded-sm text-xs font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 transition cursor-pointer"
                >
                    <span id="userRoleLabel">
                        @if(request('role') === 'super_admin')
                            Super Admin
                        @elseif(request('role') === 'admin')
                            Admin Biasa
                        @else
                            Semua Role
                        @endif
                    </span>
                    <i id="userRoleChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                </button>

                <div id="userRoleMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                    <button type="button" data-val="" data-lbl="Semua Role" class="user-role-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <span>Semua Role</span>
                        @if(!request('role')) <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" data-val="super_admin" data-lbl="Super Admin" class="user-role-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user-shield text-amber-500 text-xs"></i>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Super Admin</p>
                                <p class="text-[10px] text-slate-400">Hak akses mutlak &amp; sistem</p>
                            </div>
                        </div>
                        @if(request('role') === 'super_admin') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" data-val="admin" data-lbl="Admin Biasa" class="user-role-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user-gear text-emerald-600 text-xs"></i>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Admin Biasa</p>
                                <p class="text-[10px] text-slate-400">Kelola naskah, buku, &amp; pesanan</p>
                            </div>
                        </div>
                        @if(request('role') === 'admin') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                </div>
            </div>

            <!-- Custom Status Filter Dropdown -->
            <div class="lg:col-span-2 relative" id="userStatusFilterContainer">
                <input type="hidden" name="status" id="userStatusInput" value="{{ request('status') }}" />
                <button 
                    type="button" 
                    id="userStatusBtn"
                    class="w-full px-3 py-2 bg-slate-50/50 border border-slate-300 rounded-sm text-xs font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 transition cursor-pointer"
                >
                    <span id="userStatusLabel">
                        @if(request('status') === 'active')
                            Aktif
                        @elseif(request('status') === 'inactive')
                            Nonaktif
                        @else
                            Semua Status
                        @endif
                    </span>
                    <i id="userStatusChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                </button>

                <div id="userStatusMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                    <button type="button" data-val="" data-lbl="Semua Status" class="user-status-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <span>Semua Status</span>
                        @if(!request('status')) <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" data-val="active" data-lbl="Aktif" class="user-status-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Aktif</p>
                                <p class="text-[10px] text-slate-400">Akun dapat login</p>
                            </div>
                        </div>
                        @if(request('status') === 'active') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" data-val="inactive" data-lbl="Nonaktif" class="user-status-opt w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-xmark text-rose-500 text-xs"></i>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Nonaktif</p>
                                <p class="text-[10px] text-slate-400">Akses ditangguhkan</p>
                            </div>
                        </div>
                        @if(request('status') === 'inactive') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="lg:col-span-2 flex gap-1.5">
                <button type="submit" class="flex-1 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-1 shadow-2xs cursor-pointer">
                    <i class="fa-solid fa-filter text-[10px]"></i>
                    <span>Filter</span>
                </button>
                @if(request('search') || request('role') || request('status'))
                    <a href="{{ route('admin.users.index') }}" class="px-2.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-sm transition flex items-center justify-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Users Table & Mobile Card Stream -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden w-full">
        
        <!-- 1. MOBILE NATIVE USERS CARDS (Visible on mobile < 640px) -->
        <div class="block sm:hidden divide-y divide-slate-100">
            @forelse($users as $user)
                <div class="p-3.5 space-y-2.5 hover:bg-slate-50/80 transition">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="w-8 h-8 rounded-xs bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs ring-1 ring-slate-200 shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="font-bold text-slate-900 text-xs truncate">{{ $user->name }}</p>
                                @if($user->id === Auth::id())
                                    <span class="text-[9.5px] text-emerald-700 font-bold">(Akun Anda)</span>
                                @endif
                            </div>
                        </div>

                        <div>
                            @if($user->role === 'super_admin')
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-rose-50 text-rose-800 border border-rose-200">
                                    <i class="fa-solid fa-shield-halved text-[8px]"></i> Super Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    <i class="fa-solid fa-user-gear text-[8px]"></i> Admin
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-1 text-xs">
                        <p class="text-slate-600 text-[11.5px] font-medium truncate">{{ $user->email }}</p>
                        @if($user->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="text-emerald-700 hover:underline flex items-center gap-1 text-[11px] font-mono font-bold">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                <span>{{ $user->phone }}</span>
                            </a>
                        @endif
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                        <div>
                            @if($user->is_active)
                                <span class="inline-flex items-center gap-1 text-[10px] text-emerald-700 font-bold">
                                    <i class="fa-solid fa-circle-check text-[9px]"></i> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-[10px] text-slate-400 font-semibold">
                                    <i class="fa-solid fa-circle-xmark text-[9px]"></i> Nonaktif
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.users.edit', $user) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                <span>Edit</span>
                            </a>

                            @if($user->id !== Auth::id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akun admin {{ $user->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 px-2 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xs text-xs transition" title="Hapus Akun">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-users text-2xl mb-1 text-slate-300 block"></i>
                    Belum ada akun admin yang sesuai filter.
                </div>
            @endforelse
        </div>

        <!-- 2. DESKTOP WIDE TABLE (Visible on tablets & desktop >= 640px) -->
        <div class="hidden sm:block overflow-x-auto w-full">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-600 uppercase text-[10px] font-bold border-b border-slate-200 tracking-wider">
                    <tr>
                        <th class="px-5 py-3">Nama Lengkap</th>
                        <th class="px-5 py-3">Email &amp; Kontak</th>
                        <th class="px-5 py-3">Role</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Dibuat Pada</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/70 transition">
                            <!-- Name & Initial -->
                            <td class="px-5 py-3.5 font-semibold text-slate-900 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xs bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs ring-1 ring-slate-200 shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="block truncate">{{ $user->name }}</span>
                                        @if($user->id === Auth::id())
                                            <span class="text-[10px] text-emerald-700 font-bold">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Email & Phone -->
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                <span class="text-slate-800 block">{{ $user->email }}</span>
                                @if($user->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="text-[11px] text-emerald-700 hover:underline flex items-center gap-1 font-mono mt-0.5">
                                        <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                        <span>{{ $user->phone }}</span>
                                    </a>
                                @endif
                            </td>

                            <!-- Role Badge -->
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                @if($user->role === 'super_admin')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-rose-50 text-rose-800 border border-rose-200 font-mono">
                                        <i class="fa-solid fa-shield-halved text-[8px]"></i> Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 font-mono">
                                        <i class="fa-solid fa-user-gear text-[8px]"></i> Admin
                                    </span>
                                @endif
                            </td>

                            <!-- Status Active -->
                            <td class="px-5 py-3.5 whitespace-nowrap">
                                @if($user->is_active)
                                    <span class="inline-flex items-center gap-1 text-[11px] text-emerald-700 font-bold">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] text-slate-400 font-semibold">
                                        <i class="fa-solid fa-circle-xmark text-[9px]"></i> Nonaktif
                                    </span>
                                @endif
                            </td>

                            <!-- Created Date -->
                            <td class="px-5 py-3.5 text-slate-500 whitespace-nowrap font-mono text-xs">
                                {{ $user->created_at->format('d M Y, H:i') }}
                            </td>

                            <!-- Actions -->
                            <td class="px-5 py-3.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition flex items-center gap-1 shadow-2xs">
                                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                        <span>Edit</span>
                                    </a>

                                    @if($user->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akun admin {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2.5 py-1 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xs text-xs font-bold transition flex items-center gap-1 shadow-2xs">
                                                <i class="fa-solid fa-trash-can text-[10px]"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-xl mb-2">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 font-heading">Tidak Ada Pengguna Ditemukan</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Belum ada akun admin atau operator yang sesuai filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-3 border-t border-slate-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Dropdown Scripts with Bulletproof Event Listeners -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rBtn = document.getElementById('userRoleBtn');
        const rMenu = document.getElementById('userRoleMenu');
        const rChev = document.getElementById('userRoleChevron');
        const rInput = document.getElementById('userRoleInput');
        const rLabel = document.getElementById('userRoleLabel');

        const sBtn = document.getElementById('userStatusBtn');
        const sMenu = document.getElementById('userStatusMenu');
        const sChev = document.getElementById('userStatusChevron');
        const sInput = document.getElementById('userStatusInput');
        const sLabel = document.getElementById('userStatusLabel');

        const form = document.getElementById('userFilterForm');

        if (rBtn && rMenu) {
            rBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (sMenu) { sMenu.classList.add('hidden'); sChev.classList.remove('rotate-180'); }
                rMenu.classList.toggle('hidden');
                rChev.classList.toggle('rotate-180');
            });
        }

        document.querySelectorAll('.user-role-opt').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                rInput.value = this.getAttribute('data-val');
                rLabel.innerText = this.getAttribute('data-lbl');
                rMenu.classList.add('hidden');
                rChev.classList.remove('rotate-180');
                form.submit();
            });
        });

        if (sBtn && sMenu) {
            sBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                if (rMenu) { rMenu.classList.add('hidden'); rChev.classList.remove('rotate-180'); }
                sMenu.classList.toggle('hidden');
                sChev.classList.toggle('rotate-180');
            });
        }

        document.querySelectorAll('.user-status-opt').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                sInput.value = this.getAttribute('data-val');
                sLabel.innerText = this.getAttribute('data-lbl');
                sMenu.classList.add('hidden');
                sChev.classList.remove('rotate-180');
                form.submit();
            });
        });

        document.addEventListener('click', function(e) {
            if (rMenu && !rMenu.contains(e.target) && rBtn && !rBtn.contains(e.target)) {
                rMenu.classList.add('hidden');
                if (rChev) rChev.classList.remove('rotate-180');
            }
            if (sMenu && !sMenu.contains(e.target) && sBtn && !sBtn.contains(e.target)) {
                sMenu.classList.add('hidden');
                if (sChev) sChev.classList.remove('rotate-180');
            }
        });
    });
</script>
@endsection
