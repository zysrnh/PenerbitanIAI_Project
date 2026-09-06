@extends('admin.layouts.app')

@section('title', 'Pengaturan Profil Administrator')
@section('header_title', 'Profil & Keamanan Akun')

@section('content')
    <!-- Top Alert Notifications -->
    @if(session('success'))
        <div class="mb-5 p-3.5 sm:p-4 rounded-sm bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-medium flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2.5 min-w-0">
                <i class="fa-solid fa-circle-check text-emerald-700 text-base shrink-0"></i>
                <span class="truncate">{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 p-1 cursor-pointer" title="Tutup">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 p-3.5 sm:p-4 rounded-sm bg-rose-50 border border-rose-300 text-rose-900 text-xs sm:text-sm font-medium space-y-1 shadow-2xs">
            <div class="flex items-center gap-2 font-bold text-rose-800 mb-1">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <span>Terdapat kendala pada input data Anda:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-xs text-rose-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
        
        <!-- Left: Edit Profile Info & Photo (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-sm border border-slate-200 shadow-2xs p-5 sm:p-6">
            <div class="mb-5 border-b border-slate-100 pb-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center text-xs font-bold">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-slate-900 font-heading">Informasi Akun &amp; Foto Profil</h3>
                        <p class="text-[11px] text-slate-500">Kelola identitas akun, username, nomor kontak, dan avatar Anda.</p>
                    </div>
                </div>
                <span class="px-2.5 py-1 rounded-xs text-[10.5px] font-bold uppercase tracking-wider font-mono {{ $user->isSuperAdmin() ? 'bg-purple-50 text-purple-800 border border-purple-200' : ($user->isAdmin() ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-blue-50 text-blue-800 border border-blue-200') }}">
                    {{ $user->role_label }}
                </span>
            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- 1. Profile Picture (PP) Section with Instant Live Preview -->
                <div class="p-4 bg-slate-50 rounded-sm border border-slate-200">
                    <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2.5">
                        Foto Profil (Avatar / PP)
                    </label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <!-- Preview Box -->
                        <div class="relative group shrink-0">
                            <div id="avatarPreviewContainer" class="w-20 h-20 sm:w-22 sm:h-22 rounded-sm border-2 border-slate-300 bg-white shadow-2xs overflow-hidden flex items-center justify-center">
                                @if($user->avatar_url)
                                    <img id="avatarPreviewImg" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover" />
                                    <div id="avatarInitialsFallback" class="hidden w-full h-full bg-[#006830] text-white flex items-center justify-center font-black text-xl">
                                        {{ $user->initials }}
                                    </div>
                                @else
                                    <img id="avatarPreviewImg" src="" alt="Preview" class="w-full h-full object-cover hidden" />
                                    <div id="avatarInitialsFallback" class="w-full h-full bg-[#006830] text-white flex items-center justify-center font-black text-xl">
                                        {{ $user->initials }}
                                    </div>
                                @endif
                            </div>
                            <span class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full"></span>
                        </div>

                        <!-- Upload & Removal Controls -->
                        <div class="flex-1 space-y-2">
                            <input 
                                type="file" 
                                name="avatar" 
                                id="adminAvatarInput" 
                                accept="image/png, image/jpeg, image/jpg, image/webp, image/svg+xml" 
                                class="hidden" 
                                onchange="previewAdminAvatar(event)"
                            />

                            <div class="flex flex-wrap items-center gap-2">
                                <button 
                                    type="button" 
                                    onclick="document.getElementById('adminAvatarInput').click()" 
                                    class="px-3.5 py-1.5 bg-slate-800 hover:bg-slate-900 text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer"
                                >
                                    <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i>
                                    <span>Pilih Foto Baru</span>
                                </button>

                                @if($user->avatar)
                                    <button 
                                        type="button" 
                                        id="btnRemoveExistingAvatar"
                                        onclick="markAvatarForRemoval()" 
                                        class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 rounded-xs text-xs font-bold transition flex items-center gap-1.5 cursor-pointer"
                                    >
                                        <i class="fa-solid fa-trash-can text-[11px]"></i>
                                        <span>Hapus Foto</span>
                                    </button>
                                @endif

                                <button 
                                    type="button" 
                                    id="btnCancelNewAvatar" 
                                    onclick="cancelSelectedAvatar()" 
                                    class="hidden px-3 py-1.5 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xs text-xs font-bold transition flex items-center gap-1.5 cursor-pointer"
                                >
                                    <i class="fa-solid fa-rotate-left text-[11px]"></i>
                                    <span>Batal</span>
                                </button>
                            </div>

                            <!-- Hidden field to mark removal -->
                            <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0" />
                            
                            <p id="avatarFileNameDisplay" class="text-[11px] text-slate-500 leading-tight">
                                Format didukung: <strong>JPG, PNG, WEBP</strong> (Maks. 3MB). Rekomendasi rasio 1:1.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2. Personal Detail Fields -->
                <div class="space-y-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            Nama Lengkap / Nama Tampilan <span class="text-rose-600">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $user->name) }}" 
                            required 
                            placeholder="Contoh: Muhammad Akbar, S.Kom." 
                            class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                        <span class="text-[10.5px] text-slate-400 mt-0.5 block">Nama ini akan ditampilkan pada sistem panel, histori verifikasi, dan balasan pesan.</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            Alamat Email (Digunakan untuk Login) <span class="text-rose-600">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}" 
                            required 
                            placeholder="admin@penerbitpersis.com" 
                            class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-mono"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-1">
                            Nomor WhatsApp / Telepon
                        </label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ old('phone', $user->phone) }}" 
                            placeholder="Contoh: 082116116133" 
                            class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-mono"
                        />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Role / Hak Akses Administrator
                        </label>
                        <input 
                            type="text" 
                            value="{{ $user->role_label }}" 
                            disabled 
                            class="w-full px-3.5 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-slate-100 text-slate-500 cursor-not-allowed font-medium select-none"
                        />
                        <span class="text-[10.5px] text-slate-400 mt-0.5 block">Penetapan role hanya dapat diubah oleh Super Admin melalui menu Manajemen Pengguna.</span>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-xs flex items-center gap-2 cursor-pointer"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan Profil</span>
                    </button>
                    <span class="text-[11px] text-slate-400 hidden sm:inline">Perubahan foto akan langsung aktif di seluruh panel</span>
                </div>
            </form>
        </div>

        <!-- Right: Change Password & Security (5 cols) -->
        <div class="lg:col-span-5 bg-white rounded-sm border border-slate-200 shadow-2xs p-5 sm:p-6 space-y-5">
            <div class="border-b border-slate-100 pb-3.5 flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-sm bg-amber-50 text-amber-800 border border-amber-200 flex items-center justify-center text-xs font-bold">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-bold text-slate-900 font-heading">Keamanan &amp; Kata Sandi</h3>
                    <p class="text-[11px] text-slate-500">Perbarui kata sandi secara berkala untuk menjaga keamanan data.</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        Kata Sandi Saat Ini <span class="text-rose-600">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="current_password" 
                            id="fieldCurrentPassword"
                            placeholder="••••••••" 
                            required 
                            class="w-full pl-3.5 pr-9 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('fieldCurrentPassword', 'iconCurrentPass')" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1 cursor-pointer"
                            title="Tampilkan kata sandi"
                        >
                            <i id="iconCurrentPass" class="fa-regular fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        Kata Sandi Baru <span class="text-rose-600">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="fieldNewPassword"
                            placeholder="Minimal 6 karakter" 
                            required 
                            class="w-full pl-3.5 pr-9 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('fieldNewPassword', 'iconNewPass')" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1 cursor-pointer"
                            title="Tampilkan kata sandi"
                        >
                            <i id="iconNewPass" class="fa-regular fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-800 mb-1">
                        Konfirmasi Kata Sandi Baru <span class="text-rose-600">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="fieldConfirmPassword"
                            placeholder="Ulangi kata sandi baru" 
                            required 
                            class="w-full pl-3.5 pr-9 py-2 text-xs sm:text-sm rounded-sm border border-slate-200 bg-white text-slate-900 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('fieldConfirmPassword', 'iconConfirmPass')" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 p-1 cursor-pointer"
                            title="Tampilkan kata sandi"
                        >
                            <i id="iconConfirmPass" class="fa-regular fa-eye text-xs"></i>
                        </button>
                    </div>
                </div>

                <!-- Password Tips Box -->
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm text-[11px] text-slate-600 space-y-1">
                    <p class="font-bold text-slate-800 flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved text-emerald-700"></i>
                        <span>Ketentuan Keamanan:</span>
                    </p>
                    <ul class="list-disc list-inside space-y-0.5 text-[10.5px] text-slate-500 pl-1">
                        <li>Minimal 6 karakter (kombinasi huruf, angka, &amp; simbol).</li>
                        <li>Jangan gunakan kata sandi yang mudah ditebak.</li>
                    </ul>
                </div>

                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-sm text-xs font-bold transition shadow-xs flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>Perbarui Kata Sandi</span>
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Client-Side Scripts for Avatar Preview & Password Toggles -->
    <script>
        const originalAvatarSrc = @json($user->avatar_url);
        const originalInitials = @json($user->initials);

        function previewAdminAvatar(event) {
            const input = event.target;
            const previewImg = document.getElementById('avatarPreviewImg');
            const fallback = document.getElementById('avatarInitialsFallback');
            const cancelBtn = document.getElementById('btnCancelNewAvatar');
            const removeInput = document.getElementById('removeAvatarInput');
            const display = document.getElementById('avatarFileNameDisplay');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Max 3MB validation client-side
                if (file.size > 3 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 3MB.');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if (fallback) fallback.classList.add('hidden');
                    cancelBtn.classList.remove('hidden');
                    removeInput.value = '0';
                    display.innerHTML = `<span class="text-emerald-700 font-bold"><i class="fa-solid fa-check"></i> ${file.name}</span> (${(file.size / 1024).toFixed(1)} KB)`;
                };
                reader.readAsDataURL(file);
            }
        }

        function cancelSelectedAvatar() {
            const input = document.getElementById('adminAvatarInput');
            const previewImg = document.getElementById('avatarPreviewImg');
            const fallback = document.getElementById('avatarInitialsFallback');
            const cancelBtn = document.getElementById('btnCancelNewAvatar');
            const removeInput = document.getElementById('removeAvatarInput');
            const display = document.getElementById('avatarFileNameDisplay');

            input.value = '';
            removeInput.value = '0';
            cancelBtn.classList.add('hidden');

            if (originalAvatarSrc) {
                previewImg.src = originalAvatarSrc;
                previewImg.classList.remove('hidden');
                if (fallback) fallback.classList.add('hidden');
            } else {
                previewImg.src = '';
                previewImg.classList.add('hidden');
                if (fallback) fallback.classList.remove('hidden');
            }

            display.innerHTML = 'Format didukung: <strong>JPG, PNG, WEBP</strong> (Maks. 3MB). Rekomendasi rasio 1:1.';
        }

        function markAvatarForRemoval() {
            if (!confirm('Apakah Anda yakin ingin menghapus foto profil dan kembali menggunakan inisial nama?')) {
                return;
            }

            const input = document.getElementById('adminAvatarInput');
            const previewImg = document.getElementById('avatarPreviewImg');
            const fallback = document.getElementById('avatarInitialsFallback');
            const cancelBtn = document.getElementById('btnCancelNewAvatar');
            const removeInput = document.getElementById('removeAvatarInput');
            const display = document.getElementById('avatarFileNameDisplay');

            input.value = '';
            removeInput.value = '1';
            previewImg.src = '';
            previewImg.classList.add('hidden');
            if (fallback) fallback.classList.remove('hidden');
            cancelBtn.classList.remove('hidden');

            display.innerHTML = '<span class="text-rose-600 font-bold"><i class="fa-solid fa-triangle-exclamation"></i> Foto profil ditandai untuk dihapus. Klik "Simpan Perubahan Profil" untuk menerapkan.</span>';
        }

        function togglePasswordVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            if (!field || !icon) return;

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection

