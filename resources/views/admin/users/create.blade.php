@extends('admin.layouts.app')

@section('title', 'Tambah Admin')
@section('header_title', 'Tambah Admin Baru')

@section('content')
    <div class="max-w-xl bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
        <div class="mb-5 border-b border-slate-100 pb-3.5">
            <h3 class="text-sm font-bold text-slate-900">Formulir Pendaftaran Admin</h3>
            <p class="text-xs text-slate-500 mt-0.5">Lengkapi formulir di bawah untuk menambahkan admin baru ke sistem.</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
                @foreach($errors->all() as $error)
                    <div>&bull; {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag." 
                    required 
                    class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                />
            </div>

            <!-- Email & Phone Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="admin@penerbitpersis.com" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. WhatsApp / HP</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        placeholder="08123456789" 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>
            </div>

            <!-- Role & Status Grid with Custom Enterprise Dropdowns -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Custom Role Dropdown -->
                <div class="relative" id="createRoleContainer">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Role Hak Akses <span class="text-rose-500">*</span></label>
                    <input type="hidden" name="role" id="createRoleInput" value="{{ old('role', 'admin') }}" />
                    <button 
                        type="button" 
                        onclick="toggleCreateRoleMenu()"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-sm text-xs sm:text-sm font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 focus:outline-none focus:border-emerald-600 transition cursor-pointer shadow-2xs"
                    >
                        <div class="flex items-center gap-2" id="createRoleDisplay">
                            @if(old('role') === 'super_admin')
                                <i class="fa-solid fa-user-shield text-amber-600 text-xs"></i>
                                <span>Super Admin (Akses Penuh)</span>
                            @else
                                <i class="fa-solid fa-user-gear text-emerald-700 text-xs"></i>
                                <span>Admin Biasa (Operator)</span>
                            @endif
                        </div>
                        <i id="createRoleChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                    </button>

                    <div id="createRoleMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                        <button type="button" onclick="selectCreateRole('admin', 'Admin Biasa (Operator)', 'fa-solid fa-user-gear text-emerald-700')" class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-gear text-emerald-700 text-xs"></i>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Admin Biasa (Operator)</p>
                                    <p class="text-[10px] text-slate-400">Kelola buku, pesanan, dan pesan</p>
                                </div>
                            </div>
                            <i id="check_role_admin" class="fa-solid fa-check text-xs text-emerald-600 {{ old('role') !== 'super_admin' ? '' : 'hidden' }}"></i>
                        </button>
                        <button type="button" onclick="selectCreateRole('super_admin', 'Super Admin (Akses Penuh)', 'fa-solid fa-user-shield text-amber-600')" class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-shield text-amber-600 text-xs"></i>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Super Admin (Akses Penuh)</p>
                                    <p class="text-[10px] text-slate-400">Hak akses mutlak seluruh sistem &amp; pengguna</p>
                                </div>
                            </div>
                            <i id="check_role_super" class="fa-solid fa-check text-xs text-emerald-600 {{ old('role') === 'super_admin' ? '' : 'hidden' }}"></i>
                        </button>
                        <button type="button" onclick="selectCreateRole('member', 'Member / Pengguna Umum', 'fa-solid fa-user text-blue-600')" class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user text-blue-600 text-xs"></i>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Member / Pengguna Umum</p>
                                    <p class="text-[10px] text-slate-400">Pengguna toko &amp; riwayat belanja</p>
                                </div>
                            </div>
                            <i id="check_role_member" class="fa-solid fa-check text-xs text-emerald-600 {{ old('role') === 'member' ? '' : 'hidden' }}"></i>
                        </button>
                    </div>
                </div>

                <!-- Custom Status Dropdown -->
                <div class="relative" id="createStatusContainer">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Akun <span class="text-rose-500">*</span></label>
                    <input type="hidden" name="is_active" id="createStatusInput" value="{{ old('is_active', '1') }}" />
                    <button 
                        type="button" 
                        onclick="toggleCreateStatusMenu()"
                        class="w-full px-3.5 py-2.5 bg-white border border-slate-300 rounded-sm text-xs sm:text-sm font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 focus:outline-none focus:border-emerald-600 transition cursor-pointer shadow-2xs"
                    >
                        <div class="flex items-center gap-2" id="createStatusDisplay">
                            @if(old('is_active', '1') == '0')
                                <i class="fa-solid fa-circle-xmark text-rose-500 text-xs"></i>
                                <span>Nonaktif</span>
                            @else
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                                <span>Aktif (Dapat Login)</span>
                            @endif
                        </div>
                        <i id="createStatusChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                    </button>

                    <div id="createStatusMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                        <button type="button" onclick="selectCreateStatus('1', 'Aktif (Dapat Login)', 'fa-solid fa-circle-check text-emerald-600')" class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Aktif (Dapat Login)</p>
                                    <p class="text-[10px] text-slate-400">Pengguna dapat mengakses sistem</p>
                                </div>
                            </div>
                            <i id="check_status_active" class="fa-solid fa-check text-xs text-emerald-600 {{ old('is_active', '1') == '1' ? '' : 'hidden' }}"></i>
                        </button>
                        <button type="button" onclick="selectCreateStatus('0', 'Nonaktif', 'fa-solid fa-circle-xmark text-rose-500')" class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-xmark text-rose-500 text-xs"></i>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Nonaktif</p>
                                    <p class="text-[10px] text-slate-400">Akses login ditangguhkan</p>
                                </div>
                            </div>
                            <i id="check_status_inactive" class="fa-solid fa-check text-xs text-emerald-600 {{ old('is_active', '1') == '0' ? '' : 'hidden' }}"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Password & Confirmation Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi (Password) <span class="text-rose-500">*</span></label>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Minimal 6 karakter" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Sandi <span class="text-rose-500">*</span></label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Ulangi kata sandi" 
                        required 
                        class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    />
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-3 flex items-center gap-2.5">
                <button type="submit" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm text-xs font-semibold transition">
                    Simpan Admin
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
