@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Beranda | PERSIS PERS')
@section('header_title', 'Kelola Konten & Slider Halaman Beranda')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Card Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    PENGATURAN BERANDA
                </span>
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• Live Visual Simulation</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Kelola Konten, Slider &amp; Banner Beranda
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Sesuaikan teks slider hero 3 slide, 4 poin nilai keunggulan, dan banner ajakan konsultasi redaksi.
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('home') }}" target="_blank" class="flex-1 sm:flex-none px-3 sm:px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Lihat Beranda</span>
            </a>
            <button type="submit" form="homeSettingsForm" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan Konten</span>
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-2xs animate-fade-in">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Grid: Form Left (7 cols), Visual Live Preview Right (5 cols) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-5 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="xl:col-span-7 space-y-4">
            <form method="POST" action="{{ route('admin.settings.home.update') }}" id="homeSettingsForm" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- 1. SLIDE 1 (Hero Slider Utama) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            1
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 1: Banner Utama Percetakan</h3>
                            <p class="text-[10.5px] text-slate-400">Slide pertama yang tampil saat pengunjung membuka website.</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 1 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide1_title" id="in_s1_title" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">{{ old('home_slide1_title', $settings['home_slide1_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide1_highlight" id="in_s1_hl" value="{{ old('home_slide1_highlight', $settings['home_slide1_highlight']) }}" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600" placeholder="Berkualitas" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 1 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide1_desc" id="in_s1_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('home_slide1_desc', $settings['home_slide1_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 1 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide1_image" id="in_s1_img" value="{{ old('home_slide1_image', $settings['home_slide1_image']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide1_btn1_text" value="{{ old('home_slide1_btn1_text', $settings['home_slide1_btn1_text']) }}" required placeholder="Label Tombol" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide1_btn1_url" value="{{ old('home_slide1_btn1_url', $settings['home_slide1_btn1_url']) }}" required placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide1_btn2_text" value="{{ old('home_slide1_btn2_text', $settings['home_slide1_btn2_text']) }}" required placeholder="Label Tombol" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide1_btn2_url" value="{{ old('home_slide1_btn2_url', $settings['home_slide1_btn2_url']) }}" required placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. SLIDE 2 (Penerbitan Buku ISBN) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            2
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 2: Penerbitan Buku Ber-ISBN Resmi</h3>
                            <p class="text-[10.5px] text-slate-400">Slide kedua promosi pengurusan naskah dan HKI.</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 2 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide2_title" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('home_slide2_title', $settings['home_slide2_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide2_highlight" value="{{ old('home_slide2_highlight', $settings['home_slide2_highlight']) }}" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" placeholder="& Terindeks" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 2 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide2_desc" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('home_slide2_desc', $settings['home_slide2_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 2 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide2_image" value="{{ old('home_slide2_image', $settings['home_slide2_image']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide2_btn1_text" value="{{ old('home_slide2_btn1_text', $settings['home_slide2_btn1_text']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide2_btn1_url" value="{{ old('home_slide2_btn1_url', $settings['home_slide2_btn1_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide2_btn2_text" value="{{ old('home_slide2_btn2_text', $settings['home_slide2_btn2_text']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide2_btn2_url" value="{{ old('home_slide2_btn2_url', $settings['home_slide2_btn2_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. SLIDE 3 (Percetakan Cepat & Presisi) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            3
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 3: Percetakan Komersil &amp; Modul</h3>
                            <p class="text-[10.5px] text-slate-400">Slide ketiga fokus pada percetakan custom, modul, &amp; majalah.</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 3 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide3_title" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('home_slide3_title', $settings['home_slide3_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide3_highlight" value="{{ old('home_slide3_highlight', $settings['home_slide3_highlight']) }}" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" placeholder="& Presisi" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 3 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide3_desc" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600">{{ old('home_slide3_desc', $settings['home_slide3_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 3 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide3_image" value="{{ old('home_slide3_image', $settings['home_slide3_image']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide3_btn1_text" value="{{ old('home_slide3_btn1_text', $settings['home_slide3_btn1_text']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide3_btn1_url" value="{{ old('home_slide3_btn1_url', $settings['home_slide3_btn1_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-400 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide3_btn2_text" value="{{ old('home_slide3_btn2_text', $settings['home_slide3_btn2_text']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide3_btn2_url" value="{{ old('home_slide3_btn2_url', $settings['home_slide3_btn2_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. NILAI KEUNGGULAN (4 Cards) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            4
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">4 Poin Keunggulan Utama</h3>
                            <p class="text-[10.5px] text-slate-400">Poin penting yang tampil mengambang di bawah hero slider.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Poin 1: Kualitas</span>
                            <input type="text" name="home_feat1_title" id="in_f1_title" value="{{ old('home_feat1_title', $settings['home_feat1_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-bold" />
                            <input type="text" name="home_feat1_desc" id="in_f1_desc" value="{{ old('home_feat1_desc', $settings['home_feat1_desc']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Poin 2: Kecepatan</span>
                            <input type="text" name="home_feat2_title" id="in_f2_title" value="{{ old('home_feat2_title', $settings['home_feat2_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-bold" />
                            <input type="text" name="home_feat2_desc" id="in_f2_desc" value="{{ old('home_feat2_desc', $settings['home_feat2_desc']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Poin 3: Harga</span>
                            <input type="text" name="home_feat3_title" id="in_f3_title" value="{{ old('home_feat3_title', $settings['home_feat3_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-bold" />
                            <input type="text" name="home_feat3_desc" id="in_f3_desc" value="{{ old('home_feat3_desc', $settings['home_feat3_desc']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase">Poin 4: Pengalaman</span>
                            <input type="text" name="home_feat4_title" id="in_f4_title" value="{{ old('home_feat4_title', $settings['home_feat4_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-bold" />
                            <input type="text" name="home_feat4_desc" id="in_f4_desc" value="{{ old('home_feat4_desc', $settings['home_feat4_desc']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                        </div>
                    </div>
                </div>

                <!-- 5. PROFIL SINGKAT & ALUR PRODUKSI (3 Kolom Beranda) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            5
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Profil Singkat &amp; Alur Produksi</h3>
                            <p class="text-[10.5px] text-slate-400">Konten kartu tengah beranda (Katalog otomatis mengambil 4 buku terbaru dari database).</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Profil <span class="text-rose-500">*</span></label>
                                <input type="text" name="home_about_title" value="{{ old('home_about_title', $settings['home_about_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">URL Foto Profil Gedung / Redaksi <span class="text-rose-500">*</span></label>
                                <input type="url" name="home_about_image" value="{{ old('home_about_image', $settings['home_about_image']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat Profil <span class="text-rose-500">*</span></label>
                            <textarea name="home_about_desc" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300">{{ old('home_about_desc', $settings['home_about_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Seksi Alur Produksi</label>
                                <input type="text" name="home_process_title" value="{{ old('home_process_title', $settings['home_process_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Catatan Mutu / Subteks Alur</label>
                                <input type="text" name="home_process_desc" value="{{ old('home_process_desc', $settings['home_process_desc']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. BANNER CTA KONSULTASI -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 sm:p-5 space-y-3.5">
                    <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            5
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Banner Ajakan Konsultasi (CTA)</h3>
                            <p class="text-[10.5px] text-slate-400">Banner promosi konsultasi di bagian bawah halaman.</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Badge Teks Layanan</label>
                                <input type="text" name="home_services_badge" value="{{ old('home_services_badge', $settings['home_services_badge']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Seksi Layanan</label>
                                <input type="text" name="home_services_title" value="{{ old('home_services_title', $settings['home_services_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Utama Banner CTA</label>
                            <input type="text" name="home_cta_title" value="{{ old('home_cta_title', $settings['home_cta_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Banner CTA</label>
                            <textarea name="home_cta_desc" rows="2" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300">{{ old('home_cta_desc', $settings['home_cta_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Tombol CTA</label>
                                <input type="text" name="home_cta_btn_text" value="{{ old('home_cta_btn_text', $settings['home_cta_btn_text']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Tujuan</label>
                                <input type="text" name="home_cta_wa_number" value="{{ old('home_cta_wa_number', $settings['home_cta_wa_number']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Bottom -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-2xs flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Semua Pengaturan Beranda</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT COLUMN: LIVE VISUAL SIMULATION (5 cols) -->
        <div class="xl:col-span-5 sticky top-20 space-y-4">
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="text-[10px] font-black uppercase font-mono tracking-wider text-emerald-700 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-xs bg-emerald-500 animate-pulse"></span>
                        SIMULASI VISUAL HERO SLIDER
                    </span>
                    <span class="text-[10px] text-slate-400 font-mono">Live Preview</span>
                </div>

                <!-- Visual Slide Mini Mockup -->
                <div class="relative bg-[#032c21] rounded-sm overflow-hidden border border-slate-800 text-white min-h-[260px] p-4 flex flex-col justify-between select-none shadow-inner">
                    <!-- Bg Image Mockup -->
                    <div class="absolute inset-0 z-0 flex justify-end">
                        <img id="prev_s1_img" src="{{ $settings['home_slide1_image'] }}" class="w-3/4 h-full object-cover object-left opacity-35" />
                        <div class="absolute inset-0 bg-gradient-to-r from-[#032c21] via-[#032c21]/90 to-transparent"></div>
                    </div>

                    <!-- Slide Content -->
                    <div class="relative z-10 space-y-2 max-w-xs">
                        <h4 class="text-sm sm:text-base font-black leading-tight">
                            <span id="prev_s1_title">{{ $settings['home_slide1_title'] }}</span><br>
                            <span class="text-lime-400" id="prev_s1_hl">{{ $settings['home_slide1_highlight'] }}</span>
                        </h4>
                        <p class="text-[10px] text-slate-300 leading-relaxed line-clamp-3" id="prev_s1_desc">
                            {{ $settings['home_slide1_desc'] }}
                        </p>
                    </div>

                    <!-- Mockup Buttons -->
                    <div class="relative z-10 flex items-center gap-2 pt-2">
                        <span class="px-2.5 py-1 bg-lime-400 text-slate-950 font-bold text-[9px] rounded-xs uppercase tracking-wider">
                            LIHAT LAYANAN
                        </span>
                        <span class="px-2.5 py-1 bg-white/10 text-white font-semibold text-[9px] rounded-xs border border-white/20 uppercase tracking-wider">
                            KATALOG BUKU
                        </span>
                    </div>
                </div>

                <!-- 4 Value Props Mini Simulation -->
                <div class="pt-2">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Simulasi 4 Poin Keunggulan</span>
                    <div class="grid grid-cols-2 gap-2 text-left">
                        <div class="p-2 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[11px] font-bold text-slate-900 truncate" id="prev_f1_title">{{ $settings['home_feat1_title'] }}</p>
                            <p class="text-[9px] text-slate-500 truncate" id="prev_f1_desc">{{ $settings['home_feat1_desc'] }}</p>
                        </div>
                        <div class="p-2 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[11px] font-bold text-slate-900 truncate" id="prev_f2_title">{{ $settings['home_feat2_title'] }}</p>
                            <p class="text-[9px] text-slate-500 truncate" id="prev_f2_desc">{{ $settings['home_feat2_desc'] }}</p>
                        </div>
                        <div class="p-2 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[11px] font-bold text-slate-900 truncate" id="prev_f3_title">{{ $settings['home_feat3_title'] }}</p>
                            <p class="text-[9px] text-slate-500 truncate" id="prev_f3_desc">{{ $settings['home_feat3_desc'] }}</p>
                        </div>
                        <div class="p-2 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[11px] font-bold text-slate-900 truncate" id="prev_f4_title">{{ $settings['home_feat4_title'] }}</p>
                            <p class="text-[9px] text-slate-500 truncate" id="prev_f4_desc">{{ $settings['home_feat4_desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    function updateLiveHomePreview() {
        const t1 = document.getElementById('in_s1_title').value || 'Melayani Penerbitan dan Percetakan';
        const hl = document.getElementById('in_s1_hl').value || 'Berkualitas';
        const d1 = document.getElementById('in_s1_desc').value || 'Deskripsi slider hero...';
        const im = document.getElementById('in_s1_img').value;

        document.getElementById('prev_s1_title').innerText = t1;
        document.getElementById('prev_s1_hl').innerText = hl;
        document.getElementById('prev_s1_desc').innerText = d1;
        if (im) document.getElementById('prev_s1_img').src = im;

        document.getElementById('prev_f1_title').innerText = document.getElementById('in_f1_title').value || 'Kualitas';
        document.getElementById('prev_f1_desc').innerText = document.getElementById('in_f1_desc').value || 'Deskripsi';

        document.getElementById('prev_f2_title').innerText = document.getElementById('in_f2_title').value || 'Kecepatan';
        document.getElementById('prev_f2_desc').innerText = document.getElementById('in_f2_desc').value || 'Deskripsi';

        document.getElementById('prev_f3_title').innerText = document.getElementById('in_f3_title').value || 'Harga';
        document.getElementById('prev_f3_desc').innerText = document.getElementById('in_f3_desc').value || 'Deskripsi';

        document.getElementById('prev_f4_title').innerText = document.getElementById('in_f4_title').value || 'Pengalaman';
        document.getElementById('prev_f4_desc').innerText = document.getElementById('in_f4_desc').value || 'Deskripsi';
    }
</script>
@endsection
