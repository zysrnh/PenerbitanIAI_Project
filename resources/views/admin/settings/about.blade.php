@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Tentang Kami')
@section('header_title', 'Kelola Konten & Pratinjau Halaman Tentang Kami')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten Halaman Tentang Kami</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xs text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                    <span class="w-2 h-2 rounded-xs bg-emerald-500 animate-pulse"></span> Pratinjau Visual Live
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Ubah teks formulir di sebelah kiri dan perhatikan hasil visualisasinya di sebelah kanan secara real-time.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('tentang') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Halaman
            </a>
            <button type="submit" form="aboutSettingsForm" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm transition shadow-xs hover:shadow-md flex items-center justify-center">
                <i class="fa-solid fa-floppy-disk text-base"></i>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1">
            @foreach($errors->all() as $error)
                <div>&bull; {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- Main Grid: Form Left (6 cols), Visual Preview Right (6 cols) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="xl:col-span-6 space-y-6">
            <form method="POST" action="{{ route('admin.settings.about.update') }}" class="space-y-6" id="aboutSettingsForm">
                @csrf
                @method('PUT')

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">1. Header &amp; Banner Halaman</h4>
                            <span class="text-xs text-slate-400">Judul utama dan deskripsi pengantar paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Badge Teks Atas <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="about_banner_badge" 
                                    id="in_about_badge"
                                    value="{{ old('about_banner_badge', $about['about_banner_badge'] ?? ($about['banner_badge'] ?? 'TENTANG PERSIS PERS')) }}" 
                                    required 
                                    oninput="updateAboutPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Utama Banner <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="about_banner_title" 
                                    id="in_about_title"
                                    value="{{ old('about_banner_title', $about['about_banner_title'] ?? ($about['banner_title'] ?? 'Pusat Penerbitan dan Publikasi Ilmiah')) }}" 
                                    required 
                                    oninput="updateAboutPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_banner_desc" 
                                id="in_about_desc"
                                rows="3" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('about_banner_desc', $about['about_banner_desc'] ?? ($about['banner_desc'] ?? 'PERSIS PERS merupakan unit penerbitan resmi...')) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. 4 Statistik Angka -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. 4 Kartu Statistik Angka</h4>
                            <span class="text-xs text-slate-400">Pencapaian buku, penulis, ISBN, dan eksemplar cetak</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Buku</label>
                            <input 
                                type="text" 
                                name="about_stat_books" 
                                id="in_stat_books"
                                value="{{ old('about_stat_books', $about['about_stat_books'] ?? ($about['stat_books'] ?? '150+')) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Penulis/Dosen</label>
                            <input 
                                type="text" 
                                name="about_stat_authors" 
                                id="in_stat_authors"
                                value="{{ old('about_stat_authors', $about['about_stat_authors'] ?? ($about['stat_authors'] ?? '80+')) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Legalitas ISBN</label>
                            <input 
                                type="text" 
                                name="about_stat_isbn" 
                                id="in_stat_isbn"
                                value="{{ old('about_stat_isbn', $about['about_stat_isbn'] ?? ($about['stat_isbn'] ?? '100%')) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Eksemplar Cetak</label>
                            <input 
                                type="text" 
                                name="about_stat_copies" 
                                id="in_stat_copies"
                                value="{{ old('about_stat_copies', $about['about_stat_copies'] ?? ($about['stat_copies'] ?? '25.000+')) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Profil Lembaga & Narasi Sejarah -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-blue-50 text-blue-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Profil Lembaga &amp; Narasi Sejarah</h4>
                            <span class="text-xs text-slate-400">Cerita pendirian dan komitmen penerbitan</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Bagian Profil <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="about_profile_title" 
                                id="in_profile_title"
                                value="{{ old('about_profile_title', $about['about_profile_title'] ?? ($about['profile_title'] ?? 'Komitmen Membangun Peradaban Literasi & Riset Akademik')) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Paragraf 1 (Latar Belakang &amp; Pendirian) <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_profile_story_1" 
                                id="in_profile_story_1"
                                rows="4" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            >{{ old('about_profile_story_1', $about['about_profile_story_1'] ?? ($about['profile_story_1'] ?? 'PERSIS PERS didirikan dengan visi besar...')) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Paragraf 2 (Layanan &amp; Percetakan) <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_profile_story_2" 
                                id="in_profile_story_2"
                                rows="4" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            >{{ old('about_profile_story_2', $about['about_profile_story_2'] ?? ($about['profile_story_2'] ?? 'Didukung oleh mesin percetakan modern...')) }}</textarea>
                        </div>

                        <!-- 4 Poin Keunggulan Lembaga -->
                        <div class="pt-2">
                            <label class="block text-xs font-bold text-slate-700 mb-2">4 Poin Keunggulan / Fitur Lembaga</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keunggulan 1</label>
                                    <input type="text" name="about_feature_1" id="in_feature_1" value="{{ old('about_feature_1', $about['about_feature_1'] ?? 'Proses Peer-Review Berstandar Ilmiah') }}" oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keunggulan 2</label>
                                    <input type="text" name="about_feature_2" id="in_feature_2" value="{{ old('about_feature_2', $about['about_feature_2'] ?? 'Pengurusan ISBN & KDT Resmi Perpusnas') }}" oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keunggulan 3</label>
                                    <input type="text" name="about_feature_3" id="in_feature_3" value="{{ old('about_feature_3', $about['about_feature_3'] ?? 'Mesin Cetak Offset & Digital Mandiri') }}" oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keunggulan 4</label>
                                    <input type="text" name="about_feature_4" id="in_feature_4" value="{{ old('about_feature_4', $about['about_feature_4'] ?? 'Pendampingan Naskah Sampai Terbit') }}" oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Visi & Misi -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-purple-50 text-purple-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">4. Visi &amp; Misi Lembaga</h4>
                            <span class="text-xs text-slate-400">Pernyataan visi dan 4 butir pilar misi</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Visi Lembaga <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_vision" 
                                id="in_vision"
                                rows="3" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            >{{ old('about_vision', $about['about_vision'] ?? ($about['vision'] ?? 'Menjadi pusat penerbitan dan percetakan terkemuka...')) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 1 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_1" id="in_mission_1" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600">{{ old('about_mission_1', $about['about_mission_1'] ?? ($about['mission_1'] ?? '')) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 2 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_2" id="in_mission_2" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600">{{ old('about_mission_2', $about['about_mission_2'] ?? ($about['mission_2'] ?? '')) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 3 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_3" id="in_mission_3" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600">{{ old('about_mission_3', $about['about_mission_3'] ?? ($about['mission_3'] ?? '')) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 4 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_4" id="in_mission_4" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600">{{ old('about_mission_4', $about['about_mission_4'] ?? ($about['mission_4'] ?? '')) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Struktur Dewan Redaksi -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-teal-50 text-teal-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">5. Struktur Dewan Redaksi &amp; Pengelola</h4>
                            <span class="text-xs text-slate-400">Nama dan jabatan dewan redaksi</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Person 1 -->
                        <div class="p-3.5 rounded-sm bg-slate-50 border border-slate-200/80 space-y-2">
                            <span class="text-xs font-bold text-slate-800 uppercase block">1. Direktur / Pimpinan Penerbitan</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Lengkap &amp; Gelar</label>
                                    <input type="text" name="about_director_name" id="in_director_name" value="{{ old('about_director_name', $about['about_director_name'] ?? ($about['director_name'] ?? '')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Jabatan</label>
                                    <input type="text" name="about_director_title" id="in_director_title" value="{{ old('about_director_title', $about['about_director_title'] ?? ($about['director_title'] ?? 'Direktur Penerbitan')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                            </div>
                        </div>

                        <!-- Person 2 -->
                        <div class="p-3.5 rounded-sm bg-slate-50 border border-slate-200/80 space-y-2">
                            <span class="text-xs font-bold text-slate-800 uppercase block">2. Pemimpin Redaksi / Editor Chief</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Lengkap &amp; Gelar</label>
                                    <input type="text" name="about_editor_chief" id="in_editor_chief" value="{{ old('about_editor_chief', $about['about_editor_chief'] ?? ($about['editor_chief'] ?? '')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Jabatan</label>
                                    <input type="text" name="about_editor_chief_title" id="in_editor_chief_title" value="{{ old('about_editor_chief_title', $about['about_editor_chief_title'] ?? ($about['editor_chief_title'] ?? 'Pemimpin Redaksi')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                            </div>
                        </div>

                        <!-- Person 3 -->
                        <div class="p-3.5 rounded-sm bg-slate-50 border border-slate-200/80 space-y-2">
                            <span class="text-xs font-bold text-slate-800 uppercase block">3. Koordinator Produksi &amp; Percetakan</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Nama Lengkap &amp; Gelar</label>
                                    <input type="text" name="about_production_lead" id="in_production_lead" value="{{ old('about_production_lead', $about['about_production_lead'] ?? ($about['production_lead'] ?? '')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-slate-500 mb-1">Jabatan</label>
                                    <input type="text" name="about_production_lead_title" id="in_production_lead_title" value="{{ old('about_production_lead_title', $about['about_production_lead_title'] ?? ($about['production_lead_title'] ?? 'Manajer Percetakan')) }}" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Sticky Bottom -->
                <div class="bg-white rounded-sm border border-slate-200/80 p-5 shadow-xs flex items-center justify-between gap-4">
                    <span class="text-xs text-slate-500 font-medium">Perubahan langsung aktif di website publik setelah disimpan.</span>
                    <button type="submit" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm transition shadow-xs hover:shadow-md flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk text-base"></i>
                    </button>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: LARGE & SPACIOUS LIVE PREVIEW MOCKUP (STICKY TOP-20) -->
        <div class="xl:col-span-6 sticky top-20 self-start space-y-4">
            
            <!-- Window Mockup Frame Header (🔴 🟡 🟢) -->
            <div class="bg-slate-900 rounded-sm p-4 border border-slate-800 shadow-lg flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-xs bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-xs bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-xs bg-emerald-500"></span>
                    </div>
                    <span class="text-sm font-bold tracking-wide text-white">Pratinjau Visual Halaman Tentang Kami</span>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-sm bg-slate-800 text-emerald-400 border border-slate-700">Real-time Mockup</span>
            </div>

            <!-- Visual Preview Canvas -->
            <div class="bg-white rounded-sm border border-slate-200/80 shadow-md overflow-hidden text-slate-800 space-y-5 p-6">
                
                <!-- Preview 1: Header Banner -->
                <div class="bg-[#032c21] text-white p-6 rounded-sm shadow-sm">
                    <span id="prev_badge" class="text-xs font-extrabold text-emerald-400 uppercase tracking-widest block mb-1.5">
                        {{ $about['about_banner_badge'] ?? ($about['banner_badge'] ?? 'TENTANG PERSIS PERS') }}
                    </span>
                    <h4 id="prev_title" class="font-extrabold text-lg sm:text-xl text-white leading-tight">
                        {{ $about['about_banner_title'] ?? ($about['banner_title'] ?? 'Pusat Penerbitan dan Publikasi Ilmiah') }}
                    </h4>
                    <p id="prev_desc" class="text-xs text-slate-300 mt-2 leading-relaxed">
                        {{ $about['about_banner_desc'] ?? ($about['banner_desc'] ?? 'PERSIS PERS merupakan unit penerbitan resmi...') }}
                    </p>
                </div>

                <!-- Preview 2: 4 Stats -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200/80 shadow-2xs">
                        <span id="prev_stat_books" class="font-extrabold text-base text-[#006830] block">{{ $about['about_stat_books'] ?? '150+' }}</span>
                        <span class="text-[10px] text-slate-500 font-medium">Buku Terbit</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200/80 shadow-2xs">
                        <span id="prev_stat_authors" class="font-extrabold text-base text-[#006830] block">{{ $about['about_stat_authors'] ?? '80+' }}</span>
                        <span class="text-[10px] text-slate-500 font-medium">Penulis/Dosen</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200/80 shadow-2xs">
                        <span id="prev_stat_isbn" class="font-extrabold text-base text-[#006830] block">{{ $about['about_stat_isbn'] ?? '100%' }}</span>
                        <span class="text-[10px] text-slate-500 font-medium">ISBN Resmi</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200/80 shadow-2xs">
                        <span id="prev_stat_copies" class="font-extrabold text-base text-[#006830] block">{{ $about['about_stat_copies'] ?? '25.000+' }}</span>
                        <span class="text-[10px] text-slate-500 font-medium">Eksemplar</span>
                    </div>
                </div>

                <!-- Preview 3: Profil Narasi -->
                <div class="p-4 rounded-sm bg-slate-50 border border-slate-200/80 space-y-2">
                    <span class="text-[10px] font-bold text-[#006830] uppercase tracking-widest block">Profil &amp; Kilas Sejarah</span>
                    <h5 id="prev_profile_title" class="font-bold text-xs sm:text-sm text-slate-900 leading-snug">
                        {{ $about['about_profile_title'] ?? 'Komitmen Membangun Peradaban Literasi & Riset Akademik' }}
                    </h5>
                    <p id="prev_profile_story_1" class="text-xs text-slate-600 leading-relaxed text-justify line-clamp-3">
                        {{ $about['about_profile_story_1'] ?? '' }}
                    </p>
                    <p id="prev_profile_story_2" class="text-xs text-slate-600 leading-relaxed text-justify line-clamp-2">
                        {{ $about['about_profile_story_2'] ?? '' }}
                    </p>
                </div>

                <!-- Preview 4: Visi & Misi -->
                <div class="p-4 rounded-sm bg-slate-50 border border-slate-200/80 space-y-2.5">
                    <div>
                        <span class="text-[10px] font-bold text-[#006830] uppercase tracking-wider block">Visi Lembaga:</span>
                        <p id="prev_vision" class="text-xs italic font-medium text-slate-800 mt-0.5">
                            "{{ $about['about_vision'] ?? ($about['vision'] ?? '') }}"
                        </p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[11px] text-slate-600 pt-1">
                        <div class="p-2.5 bg-white rounded-sm border border-slate-200">
                            <strong class="text-slate-900 block mb-0.5">Misi 1:</strong> <span id="prev_mission_1">{{ $about['about_mission_1'] ?? '' }}</span>
                        </div>
                        <div class="p-2.5 bg-white rounded-sm border border-slate-200">
                            <strong class="text-slate-900 block mb-0.5">Misi 2:</strong> <span id="prev_mission_2">{{ $about['about_mission_2'] ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Preview 5: Dewan Redaksi -->
                <div class="grid grid-cols-3 gap-2 text-center text-xs">
                    <div class="p-2.5 bg-slate-50 rounded-sm border border-slate-200/80">
                        <span id="prev_director_name" class="font-bold text-slate-900 block truncate">{{ $about['about_director_name'] ?? '' }}</span>
                        <span id="prev_director_title" class="text-[10px] text-[#006830] font-semibold block truncate">{{ $about['about_director_title'] ?? 'Direktur' }}</span>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-sm border border-slate-200/80">
                        <span id="prev_editor_chief" class="font-bold text-slate-900 block truncate">{{ $about['about_editor_chief'] ?? '' }}</span>
                        <span id="prev_editor_chief_title" class="text-[10px] text-[#006830] font-semibold block truncate">{{ $about['about_editor_chief_title'] ?? 'Pimred' }}</span>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-sm border border-slate-200/80">
                        <span id="prev_production_lead" class="font-bold text-slate-900 block truncate">{{ $about['about_production_lead'] ?? '' }}</span>
                        <span id="prev_production_lead_title" class="text-[10px] text-[#006830] font-semibold block truncate">{{ $about['about_production_lead_title'] ?? 'Produksi' }}</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript for Live Preview -->
    <script>
        function updateAboutPreview() {
            // Banner
            const inBadge = document.getElementById('in_about_badge');
            const inTitle = document.getElementById('in_about_title');
            const inDesc = document.getElementById('in_about_desc');
            if (inBadge) document.getElementById('prev_badge').innerText = inBadge.value;
            if (inTitle) document.getElementById('prev_title').innerText = inTitle.value;
            if (inDesc) document.getElementById('prev_desc').innerText = inDesc.value;

            // Stats
            const inStatBooks = document.getElementById('in_stat_books');
            const inStatAuthors = document.getElementById('in_stat_authors');
            const inStatIsbn = document.getElementById('in_stat_isbn');
            const inStatCopies = document.getElementById('in_stat_copies');
            if (inStatBooks) document.getElementById('prev_stat_books').innerText = inStatBooks.value;
            if (inStatAuthors) document.getElementById('prev_stat_authors').innerText = inStatAuthors.value;
            if (inStatIsbn) document.getElementById('prev_stat_isbn').innerText = inStatIsbn.value;
            if (inStatCopies) document.getElementById('prev_stat_copies').innerText = inStatCopies.value;

            // Profile
            const inProfTitle = document.getElementById('in_profile_title');
            const inStory1 = document.getElementById('in_profile_story_1');
            const inStory2 = document.getElementById('in_profile_story_2');
            if (inProfTitle) document.getElementById('prev_profile_title').innerText = inProfTitle.value;
            if (inStory1) document.getElementById('prev_profile_story_1').innerText = inStory1.value;
            if (inStory2) document.getElementById('prev_profile_story_2').innerText = inStory2.value;

            // Vision & Mission
            const inVision = document.getElementById('in_vision');
            const inM1 = document.getElementById('in_mission_1');
            const inM2 = document.getElementById('in_mission_2');
            if (inVision) document.getElementById('prev_vision').innerText = '"' + inVision.value + '"';
            if (inM1) document.getElementById('prev_mission_1').innerText = inM1.value;
            if (inM2) document.getElementById('prev_mission_2').innerText = inM2.value;

            // Editorial Team
            const inDirName = document.getElementById('in_director_name');
            const inDirTitle = document.getElementById('in_director_title');
            const inEdName = document.getElementById('in_editor_chief');
            const inEdTitle = document.getElementById('in_editor_chief_title');
            const inProdName = document.getElementById('in_production_lead');
            const inProdTitle = document.getElementById('in_production_lead_title');

            if (inDirName) document.getElementById('prev_director_name').innerText = inDirName.value;
            if (inDirTitle) document.getElementById('prev_director_title').innerText = inDirTitle.value;
            if (inEdName) document.getElementById('prev_editor_chief').innerText = inEdName.value;
            if (inEdTitle) document.getElementById('prev_editor_chief_title').innerText = inEdTitle.value;
            if (inProdName) document.getElementById('prev_production_lead').innerText = inProdName.value;
            if (inProdTitle) document.getElementById('prev_production_lead_title').innerText = inProdTitle.value;
        }
    </script>
@endsection
