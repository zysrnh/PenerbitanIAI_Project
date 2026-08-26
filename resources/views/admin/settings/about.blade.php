@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Tentang Kami')
@section('header_title', 'Kelola Konten Halaman Tentang Kami')

@section('content')
    <form method="POST" action="{{ route('admin.settings.about.update') }}" id="aboutSettingsForm">
        @csrf
        @method('PUT')

        <!-- Top Header & Action Bar -->
        <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten Halaman Tentang Kami</h3>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Pratinjau Visual Live
                    </span>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Ubah teks formulir di sebelah kiri dan perhatikan hasil visualisasinya di sebelah kanan secara real-time.</p>
            </div>

            <!-- Top Action Buttons -->
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('tentang') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Halaman
                </a>
                <button type="submit" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
                    <i class="fa-solid fa-floppy-disk text-base"></i>
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1">
                @foreach($errors->all() as $error)
                    <div>&bull; {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- Main 2-Column Grid: Left = Form Inputs (6 cols), Right = Live Visual Mockup (6 cols) -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: FORM INPUTS -->
            <div class="xl:col-span-6 space-y-6">

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">1. Header & Banner Halaman</h4>
                            <span class="text-xs text-slate-400">Judul utama dan pengantar paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Badge Teks <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="about_banner_badge" 
                                    id="in_about_badge"
                                    value="{{ old('about_banner_badge', $about['about_banner_badge']) }}" 
                                    required 
                                    oninput="updateAboutPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Utama Banner <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="about_banner_title" 
                                    id="in_about_title"
                                    value="{{ old('about_banner_title', $about['about_banner_title']) }}" 
                                    required 
                                    oninput="updateAboutPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
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
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('about_banner_desc', $about['about_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. 4 Statistik Angka -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. 4 Kartu Statistik Angka</h4>
                            <span class="text-xs text-slate-400">Pencapaian buku, penulis, ISBN, dan cetakan</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Buku</label>
                            <input 
                                type="text" 
                                name="about_stat_books" 
                                id="in_stat_books"
                                value="{{ old('about_stat_books', $about['about_stat_books']) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Penulis/Dosen</label>
                            <input 
                                type="text" 
                                name="about_stat_authors" 
                                id="in_stat_authors"
                                value="{{ old('about_stat_authors', $about['about_stat_authors']) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Legalitas ISBN</label>
                            <input 
                                type="text" 
                                name="about_stat_isbn" 
                                id="in_stat_isbn"
                                value="{{ old('about_stat_isbn', $about['about_stat_isbn']) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Eksemplar Cetak</label>
                            <input 
                                type="text" 
                                name="about_stat_copies" 
                                id="in_stat_copies"
                                value="{{ old('about_stat_copies', $about['about_stat_copies']) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3 py-2 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Profil Lembaga & Narasi Sejarah -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Profil Lembaga & Narasi Sejarah</h4>
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
                                value="{{ old('about_profile_title', $about['about_profile_title']) }}" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Paragraf 1 (Latar Belakang & Pendirian) <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_profile_story_1" 
                                id="in_profile_story_1"
                                rows="3" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            >{{ old('about_profile_story_1', $about['about_profile_story_1']) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Paragraf 2 (Layanan & Percetakan) <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_profile_story_2" 
                                id="in_profile_story_2"
                                rows="3" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            >{{ old('about_profile_story_2', $about['about_profile_story_2']) }}</textarea>
                        </div>
                    
                        </div></div>
                </div>

                <!-- 4. Visi & Misi -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">4. Visi & Misi Lembaga</h4>
                            <span class="text-xs text-slate-400">Pernyataan visi dan 4 butir misi</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Visi Lembaga <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="about_vision" 
                                id="in_about_vision"
                                rows="2" 
                                required 
                                oninput="updateAboutPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                            >{{ old('about_vision', $about['about_vision']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 1 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_1" id="in_mission_1" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600">{{ old('about_mission_1', $about['about_mission_1']) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 2 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_2" id="in_mission_2" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600">{{ old('about_mission_2', $about['about_mission_2']) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 3 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_3" id="in_mission_3" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600">{{ old('about_mission_3', $about['about_mission_3']) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Misi 4 <span class="text-rose-500">*</span></label>
                                <textarea name="about_mission_4" id="in_mission_4" rows="2" required oninput="updateAboutPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600">{{ old('about_mission_4', $about['about_mission_4']) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5. Dewan Redaksi & Tim -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">5. Struktur Dewan Redaksi & Tim</h4>
                            <span class="text-xs text-slate-400">Nama dan jabatan dewan redaksi</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Director -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                            <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider block">Pimpinan Unit</span>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                                <input type="text" name="about_director_name" id="in_director_name" value="{{ old('about_director_name', $about['about_director_name']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Jabatan</label>
                                <input type="text" name="about_director_title" id="in_director_title" value="{{ old('about_director_title', $about['about_director_title']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                        </div>

                        <!-- Editor Chief -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                            <span class="text-xs font-bold text-blue-800 uppercase tracking-wider block">Editor Pelaksana</span>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                                <input type="text" name="about_editor_chief" id="in_editor_chief" value="{{ old('about_editor_chief', $about['about_editor_chief']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Jabatan</label>
                                <input type="text" name="about_editor_chief_title" id="in_editor_chief_title" value="{{ old('about_editor_chief_title', $about['about_editor_chief_title']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                        </div>

                        <!-- Production Lead -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                            <span class="text-xs font-bold text-purple-800 uppercase tracking-wider block">Produksi & Cetak</span>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Nama Lengkap</label>
                                <input type="text" name="about_production_lead" id="in_production_lead" value="{{ old('about_production_lead', $about['about_production_lead']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-600 mb-1">Jabatan</label>
                                <input type="text" name="about_production_lead_title" id="in_production_lead_title" value="{{ old('about_production_lead_title', $about['about_production_lead_title']) }}" required oninput="updateAboutPreview()" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clean Bottom Save Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs flex items-center justify-between gap-4">
                    <span class="text-xs text-slate-500 font-medium">Perubahan langsung aktif di website publik setelah disimpan.</span>
                    <button type="submit" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk text-base"></i>
                    </button>
                </div>

            </div>

            <!-- RIGHT COLUMN: INTERACTIVE VISUAL LIVE PREVIEW MOCKUP -->
            <div class="xl:col-span-6 sticky top-20 space-y-4">
                
                <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 shadow-lg flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <div class="flex gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        </div>
                        <span class="text-sm font-bold tracking-wide text-white">Pratinjau Visual Halaman Tentang Kami</span>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-800 text-emerald-400 border border-slate-700">Real-time Mockup</span>
                </div>

                <!-- Visual Preview Canvas -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-md overflow-hidden text-slate-800 space-y-5 p-6">
                    
                    <!-- Mockup 1: Dark Header Banner -->
                    <div class="bg-[#032c21] text-white p-6 rounded-2xl shadow-sm">
                        <span id="prev_about_badge" class="text-xs font-extrabold text-emerald-400 uppercase tracking-widest block mb-1.5">
                            {{ $about['about_banner_badge'] ?? '' }}
                        </span>
                        <h4 id="prev_about_title" class="font-extrabold text-lg sm:text-xl text-white leading-tight">
                            {{ $about['about_banner_title'] ?? '' }}
                        </h4>
                        <p id="prev_about_desc" class="text-xs text-slate-300 mt-2 leading-relaxed">
                            {{ $about['about_banner_desc'] ?? '' }}
                        </p>
                    </div>

                    <!-- Mockup 2: 4 Stats Counters Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 text-center">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span id="prev_stat_books" class="text-base font-extrabold text-emerald-700 block">{{ $about['about_stat_books'] ?? '' }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Buku Terbit</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span id="prev_stat_authors" class="text-base font-extrabold text-slate-900 block">{{ $about['about_stat_authors'] ?? '' }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Penulis</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span id="prev_stat_isbn" class="text-base font-extrabold text-emerald-700 block">{{ $about['about_stat_isbn'] ?? '' }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">ISBN Resmi</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                            <span id="prev_stat_copies" class="text-base font-extrabold text-slate-900 block">{{ $about['about_stat_copies'] ?? '' }}</span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider block mt-0.5">Eksemplar</span>
                        </div>
                    </div>

                    <!-- Mockup 3: Profil & Sejarah Box -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-widest block">Profil Lembaga</span>
                        <h5 id="prev_profile_title" class="font-bold text-xs sm:text-sm text-slate-900 leading-snug">
                            {{ $about['about_profile_title'] ?? '' }}
                        </h5>
                        <p id="prev_profile_story_1" class="text-[11px] text-slate-600 leading-relaxed line-clamp-3">
                            {{ $about['about_profile_story_1'] ?? '' }}
                        </p>
                        <p id="prev_profile_story_2" class="text-[11px] text-slate-600 leading-relaxed line-clamp-3">
                            {{ $about['about_profile_story_2'] ?? '' }}
                        </p>
                    
                    <div class="grid grid-cols-2 gap-2 text-[10px] font-medium text-slate-700 pt-1 border-t border-slate-200">
                        <div class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> <span id="prev_feature_1">{{ $about['about_feature_1'] ?? '' }}</span></div>
                        <div class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> <span id="prev_feature_2">{{ $about['about_feature_2'] ?? '' }}</span></div>
                        <div class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> <span id="prev_feature_3">{{ $about['about_feature_3'] ?? '' }}</span></div>
                        <div class="flex items-center gap-1.5"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> <span id="prev_feature_4">{{ $about['about_feature_4'] ?? '' }}</span></div>
                    </div>
                </div>

                <!-- Mockup 4: Visi & Misi Box -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <!-- Visi -->
                        <div class="p-4 rounded-xl bg-[#032c21] text-white border border-emerald-950 flex flex-col justify-between">
                            <div>
                                <span class="text-[9px] font-extrabold text-emerald-400 uppercase tracking-wider block mb-1">Visi Lembaga</span>
                                <p id="prev_about_vision" class="text-[11px] text-slate-200 leading-relaxed italic">
                                    "{{ $about['about_vision'] ?? '' }}"
                                </p>
                            </div>
                            <span class="text-[9px] font-bold text-emerald-400 block mt-2">Target 2030</span>
                        </div>

                        <!-- Misi -->
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-1.5 text-[10px]">
                            <span class="font-bold text-slate-900 block mb-1 text-[11px]">4 Pilar Misi</span>
                            <div class="flex items-start gap-1.5 text-slate-700">
                                <span class="font-bold text-emerald-700 shrink-0">1.</span> <span id="prev_mission_1" class="line-clamp-2">{{ $about['about_mission_1'] ?? '' }}</span>
                            </div>
                            <div class="flex items-start gap-1.5 text-slate-700">
                                <span class="font-bold text-emerald-700 shrink-0">2.</span> <span id="prev_mission_2" class="line-clamp-2">{{ $about['about_mission_2'] ?? '' }}</span>
                            </div>
                            <div class="flex items-start gap-1.5 text-slate-700">
                                <span class="font-bold text-emerald-700 shrink-0">3.</span> <span id="prev_mission_3" class="line-clamp-2">{{ $about['about_mission_3'] ?? '' }}</span>
                            </div>
                            <div class="flex items-start gap-1.5 text-slate-700">
                                <span class="font-bold text-emerald-700 shrink-0">4.</span> <span id="prev_mission_4" class="line-clamp-2">{{ $about['about_mission_4'] ?? '' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mockup 5: Dewan Redaksi Team Cards -->
                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-900 uppercase tracking-wider block mb-2.5 text-center">Struktur Dewan Redaksi</span>
                        <div class="grid grid-cols-3 gap-2 text-center text-[10px]">
                            <div class="p-2 rounded-lg bg-white border border-slate-200 shadow-2xs">
                                <div class="w-8 h-8 rounded-full bg-[#032c21] text-emerald-400 font-bold text-xs flex items-center justify-center mx-auto mb-1">
                                    <span id="prev_avatar_dir">A</span>
                                </div>
                                <span id="prev_director_name" class="font-bold text-slate-900 block truncate">{{ $about['about_director_name'] ?? '' }}</span>
                                <span id="prev_director_title" class="text-[9px] text-emerald-700 block truncate">{{ $about['about_director_title'] ?? '' }}</span>
                            </div>
                            <div class="p-2 rounded-lg bg-white border border-slate-200 shadow-2xs">
                                <div class="w-8 h-8 rounded-full bg-[#032c21] text-emerald-400 font-bold text-xs flex items-center justify-center mx-auto mb-1">
                                    <span id="prev_avatar_edit">N</span>
                                </div>
                                <span id="prev_editor_chief" class="font-bold text-slate-900 block truncate">{{ $about['about_editor_chief'] ?? '' }}</span>
                                <span id="prev_editor_chief_title" class="text-[9px] text-blue-700 block truncate">{{ $about['about_editor_chief_title'] ?? '' }}</span>
                            </div>
                            <div class="p-2 rounded-lg bg-white border border-slate-200 shadow-2xs">
                                <div class="w-8 h-8 rounded-full bg-[#032c21] text-emerald-400 font-bold text-xs flex items-center justify-center mx-auto mb-1">
                                    <span id="prev_avatar_prod">M</span>
                                </div>
                                <span id="prev_production_lead" class="font-bold text-slate-900 block truncate">{{ $about['about_production_lead'] ?? '' }}</span>
                                <span id="prev_production_lead_title" class="text-[9px] text-purple-700 block truncate">{{ $about['about_production_lead_title'] ?? '' }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>

    <!-- Live Preview Vanilla JS Synchronizer -->
    <script>
        function updateAboutPreview() {
            // Banner
            document.getElementById('prev_about_badge').textContent = document.getElementById('in_about_badge').value || 'Badge';
            document.getElementById('prev_about_title').textContent = document.getElementById('in_about_title').value || 'Judul Banner';
            document.getElementById('prev_about_desc').textContent = document.getElementById('in_about_desc').value || 'Deskripsi banner...';

            // Stats
            document.getElementById('prev_stat_books').textContent = document.getElementById('in_stat_books').value || '0';
            document.getElementById('prev_stat_authors').textContent = document.getElementById('in_stat_authors').value || '0';
            document.getElementById('prev_stat_isbn').textContent = document.getElementById('in_stat_isbn').value || '0%';
            document.getElementById('prev_stat_copies').textContent = document.getElementById('in_stat_copies').value || '0';

            // Profil & Sejarah
            document.getElementById('prev_profile_title').textContent = document.getElementById('in_profile_title').value || 'Profil Lembaga';
            document.getElementById('prev_profile_story_1').textContent = document.getElementById('in_profile_story_1').value || 'Paragraf 1...';
            document.getElementById('prev_profile_story_2').textContent = document.getElementById('in_profile_story_2').value || 'Paragraf 2...';

            // 4 Ceklis Keunggulan
            document.getElementById('prev_feature_1').textContent = document.getElementById('in_feature_1').value || 'Poin 1';
            document.getElementById('prev_feature_2').textContent = document.getElementById('in_feature_2').value || 'Poin 2';
            document.getElementById('prev_feature_3').textContent = document.getElementById('in_feature_3').value || 'Poin 3';
            document.getElementById('prev_feature_4').textContent = document.getElementById('in_feature_4').value || 'Poin 4';

            // Visi & Misi
            document.getElementById('prev_about_vision').textContent = '"' + (document.getElementById('in_about_vision').value || 'Visi') + '"';
            document.getElementById('prev_mission_1').textContent = document.getElementById('in_mission_1').value || 'Misi 1';
            document.getElementById('prev_mission_2').textContent = document.getElementById('in_mission_2').value || 'Misi 2';
            document.getElementById('prev_mission_3').textContent = document.getElementById('in_mission_3').value || 'Misi 3';
            document.getElementById('prev_mission_4').textContent = document.getElementById('in_mission_4').value || 'Misi 4';

            // Tim Redaksi
            const dirName = document.getElementById('in_director_name').value || 'Direktur';
            document.getElementById('prev_director_name').textContent = dirName;
            document.getElementById('prev_avatar_dir').textContent = dirName.charAt(0).toUpperCase();
            document.getElementById('prev_director_title').textContent = document.getElementById('in_director_title').value || 'Jabatan';

            const editName = document.getElementById('in_editor_chief').value || 'Editor';
            document.getElementById('prev_editor_chief').textContent = editName;
            document.getElementById('prev_avatar_edit').textContent = editName.charAt(0).toUpperCase();
            document.getElementById('prev_editor_chief_title').textContent = document.getElementById('in_editor_chief_title').value || 'Jabatan';

            const prodName = document.getElementById('in_production_lead').value || 'Produksi';
            document.getElementById('prev_production_lead').textContent = prodName;
            document.getElementById('prev_avatar_prod').textContent = prodName.charAt(0).toUpperCase();
            document.getElementById('prev_production_lead_title').textContent = document.getElementById('in_production_lead_title').value || 'Jabatan';
        }
    </script>
@endsection
