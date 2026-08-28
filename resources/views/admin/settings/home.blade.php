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
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• Live Real-Time Visualizer</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Kelola Konten, Slider &amp; Banner Beranda
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Sesuaikan teks hero slider 3 slide, 4 poin keunggulan, profil singkat, alur produksi, dan banner ajakan naskah.
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

    <!-- Main Grid: Form Left (6 cols), Visual Live Preview Right (6 cols) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS (6 COLS) -->
        <div class="xl:col-span-6 space-y-4">
            <form method="POST" action="{{ route('admin.settings.home.update') }}" id="homeSettingsForm" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- 1. SLIDE 1 (Hero Slider Utama) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            1
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 1: Banner Utama Percetakan</h3>
                            <p class="text-[11px] text-slate-400">Slide pertama yang tampil saat pengunjung membuka website.</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 1 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide1_title" id="in_s1_title" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600">{{ old('home_slide1_title', $settings['home_slide1_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide1_highlight" id="in_s1_hl" value="{{ old('home_slide1_highlight', $settings['home_slide1_highlight']) }}" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600" placeholder="Berkualitas" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 1 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide1_desc" id="in_s1_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ old('home_slide1_desc', $settings['home_slide1_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 1 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide1_image" id="in_s1_img" value="{{ old('home_slide1_image', $settings['home_slide1_image']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide1_btn1_text" id="in_s1_b1_t" value="{{ old('home_slide1_btn1_text', $settings['home_slide1_btn1_text']) }}" required placeholder="Label Tombol" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide1_btn1_url" value="{{ old('home_slide1_btn1_url', $settings['home_slide1_btn1_url']) }}" required placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide1_btn2_text" id="in_s1_b2_t" value="{{ old('home_slide1_btn2_text', $settings['home_slide1_btn2_text']) }}" required placeholder="Label Tombol" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide1_btn2_url" value="{{ old('home_slide1_btn2_url', $settings['home_slide1_btn2_url']) }}" required placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. SLIDE 2 (Penerbitan Buku ISBN) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            2
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 2: Penerbitan Buku Ber-ISBN Resmi</h3>
                            <p class="text-[11px] text-slate-400">Slide kedua promosi pengurusan naskah dan HKI.</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 2 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide2_title" id="in_s2_title" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ old('home_slide2_title', $settings['home_slide2_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide2_highlight" id="in_s2_hl" value="{{ old('home_slide2_highlight', $settings['home_slide2_highlight']) }}" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" placeholder="& Terindeks" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 2 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide2_desc" id="in_s2_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ old('home_slide2_desc', $settings['home_slide2_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 2 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide2_image" id="in_s2_img" value="{{ old('home_slide2_image', $settings['home_slide2_image']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide2_btn1_text" id="in_s2_b1_t" value="{{ old('home_slide2_btn1_text', $settings['home_slide2_btn1_text']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide2_btn1_url" value="{{ old('home_slide2_btn1_url', $settings['home_slide2_btn1_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide2_btn2_text" id="in_s2_b2_t" value="{{ old('home_slide2_btn2_text', $settings['home_slide2_btn2_text']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide2_btn2_url" value="{{ old('home_slide2_btn2_url', $settings['home_slide2_btn2_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. SLIDE 3 (Percetakan Cepat & Presisi) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            3
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide 3: Percetakan Komersil &amp; Modul</h3>
                            <p class="text-[11px] text-slate-400">Slide ketiga fokus pada percetakan custom, modul, &amp; majalah.</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide 3 <span class="text-rose-500">*</span></label>
                                <textarea name="home_slide3_title" id="in_s3_title" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ old('home_slide3_title', $settings['home_slide3_title']) }}</textarea>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                <input type="text" name="home_slide3_highlight" id="in_s3_hl" value="{{ old('home_slide3_highlight', $settings['home_slide3_highlight']) }}" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" placeholder="& Presisi" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide 3 <span class="text-rose-500">*</span></label>
                            <textarea name="home_slide3_desc" id="in_s3_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ old('home_slide3_desc', $settings['home_slide3_desc']) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">URL Foto Background Slide 3 <span class="text-rose-500">*</span></label>
                            <input type="url" name="home_slide3_image" id="in_s3_img" value="{{ old('home_slide3_image', $settings['home_slide3_image']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 1 (Hijau Terang)</span>
                                <input type="text" name="home_slide3_btn1_text" id="in_s3_b1_t" value="{{ old('home_slide3_btn1_text', $settings['home_slide3_btn1_text']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide3_btn1_url" value="{{ old('home_slide3_btn1_url', $settings['home_slide3_btn1_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                            <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                                <span class="text-[10px] font-bold text-slate-500 uppercase">Tombol Aksi 2 (Garis Putih)</span>
                                <input type="text" name="home_slide3_btn2_text" id="in_s3_b2_t" value="{{ old('home_slide3_btn2_text', $settings['home_slide3_btn2_text']) }}" required oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                <input type="text" name="home_slide3_btn2_url" value="{{ old('home_slide3_btn2_url', $settings['home_slide3_btn2_url']) }}" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. NILAI KEUNGGULAN (4 Cards) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            4
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">4 Poin Keunggulan Utama</h3>
                            <p class="text-[11px] text-slate-400">Poin penting yang tampil mengambang di bawah hero slider.</p>
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

                <!-- 5. PROFIL SINGKAT & ALUR PRODUKSI -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            5
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Profil Singkat &amp; Alur Produksi</h3>
                            <p class="text-[11px] text-slate-400">Konten kartu tengah beranda (Katalog otomatis terhubung dengan database).</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Profil <span class="text-rose-500">*</span></label>
                                <input type="text" name="home_about_title" id="in_ab_title" value="{{ old('home_about_title', $settings['home_about_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block font-bold text-slate-700 mb-1">URL Foto Profil Gedung / Redaksi <span class="text-rose-500">*</span></label>
                                <input type="url" name="home_about_image" id="in_ab_img" value="{{ old('home_about_image', $settings['home_about_image']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat Profil <span class="text-rose-500">*</span></label>
                            <textarea name="home_about_desc" id="in_ab_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300">{{ old('home_about_desc', $settings['home_about_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Seksi Alur Produksi</label>
                                <input type="text" name="home_process_title" id="in_pr_title" value="{{ old('home_process_title', $settings['home_process_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Catatan Mutu / Subteks Alur</label>
                                <input type="text" name="home_process_desc" id="in_pr_desc" value="{{ old('home_process_desc', $settings['home_process_desc']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. BANNER CTA KONSULTASI -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            6
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Banner Ajakan Konsultasi (CTA)</h3>
                            <p class="text-[11px] text-slate-400">Banner promosi konsultasi di bagian bawah halaman.</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
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
                            <input type="text" name="home_cta_title" id="in_cta_title" value="{{ old('home_cta_title', $settings['home_cta_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Banner CTA</label>
                            <textarea name="home_cta_desc" id="in_cta_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300">{{ old('home_cta_desc', $settings['home_cta_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Teks Tombol CTA</label>
                                <input type="text" name="home_cta_btn_text" id="in_cta_btn" value="{{ old('home_cta_btn_text', $settings['home_cta_btn_text']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Tujuan</label>
                                <input type="text" name="home_cta_wa_number" id="in_cta_wa" value="{{ old('home_cta_wa_number', $settings['home_cta_wa_number']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Button Bottom -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-2xs flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Semua Pengaturan Beranda</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT COLUMN: HIGH-FIDELITY LIVE PREVIEW MOCKUP (6 COLS, STICKY TOP-20) -->
        <div class="xl:col-span-6 sticky top-20 self-start space-y-4 select-none">
            
            <!-- Window Mockup Frame Header -->
            <div class="bg-slate-900 rounded-sm p-3.5 border border-slate-800 shadow-md flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-xs bg-rose-500"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-amber-500"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-emerald-500"></span>
                    </div>
                    <span class="text-xs font-bold tracking-wide text-white flex items-center gap-2">
                        <span>Pratinjau Halaman Beranda</span>
                        <span class="text-[10px] text-slate-400 font-mono font-normal">penerbitpersis.com</span>
                    </span>
                </div>

                <!-- Slide Switcher Tabs in Mockup -->
                <div class="flex items-center gap-1 bg-slate-800 p-0.5 rounded-sm border border-slate-700">
                    <button type="button" onclick="switchPreviewSlide(1)" id="btn_tab_s1" class="px-2 py-0.5 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition">Slide 1</button>
                    <button type="button" onclick="switchPreviewSlide(2)" id="btn_tab_s2" class="px-2 py-0.5 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition">Slide 2</button>
                    <button type="button" onclick="switchPreviewSlide(3)" id="btn_tab_s3" class="px-2 py-0.5 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition">Slide 3</button>
                </div>
            </div>

            <!-- Visual Preview Canvas (Exact Page Representation) -->
            <div class="bg-slate-100 rounded-sm border border-slate-200/90 shadow-md overflow-hidden text-slate-800 space-y-3.5 p-3 sm:p-4 max-h-[82vh] overflow-y-auto">
                
                <!-- 1. Hero Slider Exact Preview -->
                <div class="relative bg-brand-950 bg-[#032c21] rounded-sm overflow-hidden border border-slate-800 text-white min-h-[300px] sm:min-h-[320px] p-5 sm:p-6 flex flex-col justify-between shadow-inner">
                    <!-- Bg Image with Right-aligned Fade -->
                    <div class="absolute inset-0 z-0 flex justify-end">
                        <div class="w-3/4 h-full relative">
                            <img id="mock_hero_img" src="{{ $settings['home_slide1_image'] }}" class="w-full h-full object-cover object-left opacity-40" />
                            <div class="absolute inset-0 bg-gradient-to-r from-[#032c21] via-[#032c21]/80 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#032c21] via-transparent to-[#032c21]/30"></div>
                        </div>
                    </div>

                    <!-- Slide Content Left Aligned -->
                    <div class="relative z-10 space-y-2.5 max-w-sm">
                        <h4 class="text-base sm:text-lg font-extrabold text-white leading-tight">
                            <span id="mock_hero_title">{!! nl2br(e($settings['home_slide1_title'])) !!}</span><br>
                            <span class="text-lime-400" id="mock_hero_hl">{{ $settings['home_slide1_highlight'] }}</span>
                        </h4>
                        <p class="text-[11px] text-slate-200/90 leading-relaxed line-clamp-3" id="mock_hero_desc">
                            {{ $settings['home_slide1_desc'] }}
                        </p>

                        <!-- Mockup Buttons -->
                        <div class="flex items-center gap-2 pt-1.5">
                            <span id="mock_hero_b1" class="px-3 py-1.5 bg-lime-400 text-slate-950 font-bold text-[9.5px] rounded-xs uppercase tracking-wider flex items-center gap-1 shadow-xs">
                                {{ $settings['home_slide1_btn1_text'] }} <i class="fa-solid fa-arrow-right text-[8px]"></i>
                            </span>
                            <span id="mock_hero_b2" class="px-3 py-1.5 bg-white/10 text-white font-semibold text-[9.5px] rounded-xs border border-white/20 uppercase tracking-wider flex items-center gap-1">
                                {{ $settings['home_slide1_btn2_text'] }} <i class="fa-solid fa-book-open text-[8px]"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Slide Indicators -->
                    <div class="relative z-10 flex items-center gap-1.5 pt-4">
                        <span id="dot_s1" class="w-2 h-2 rounded-full bg-lime-400"></span>
                        <span id="dot_s2" class="w-2 h-2 rounded-full bg-white/40"></span>
                        <span id="dot_s3" class="w-2 h-2 rounded-full bg-white/40"></span>
                    </div>
                </div>

                <!-- 2. 4 Value Propositions Bar (Exact Floating Representation) -->
                <div class="bg-white rounded-sm border border-slate-200 shadow-2xs p-3 text-slate-800">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                        <div class="flex items-center gap-2 p-1">
                            <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-[10.5px] text-slate-900 truncate" id="mock_f1_title">{{ $settings['home_feat1_title'] }}</h5>
                                <p class="text-[8.5px] text-slate-500 truncate" id="mock_f1_desc">{{ $settings['home_feat1_desc'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 p-1 sm:pl-2 pt-2 sm:pt-1">
                            <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-[10.5px] text-slate-900 truncate" id="mock_f2_title">{{ $settings['home_feat2_title'] }}</h5>
                                <p class="text-[8.5px] text-slate-500 truncate" id="mock_f2_desc">{{ $settings['home_feat2_desc'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 p-1 sm:pl-2 pt-2 sm:pt-1">
                            <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-[10.5px] text-slate-900 truncate" id="mock_f3_title">{{ $settings['home_feat3_title'] }}</h5>
                                <p class="text-[8.5px] text-slate-500 truncate" id="mock_f3_desc">{{ $settings['home_feat3_desc'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 p-1 sm:pl-2 pt-2 sm:pt-1">
                            <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-[10.5px] text-slate-900 truncate" id="mock_f4_title">{{ $settings['home_feat4_title'] }}</h5>
                                <p class="text-[8.5px] text-slate-500 truncate" id="mock_f4_desc">{{ $settings['home_feat4_desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Section 3 Kolom Beranda: Profil, Alur, & Real Catalog Showcase -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                    
                    <!-- Kolom 1: Profil Singkat -->
                    <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                        <div>
                            <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block mb-0.5">TENTANG KAMI</span>
                            <h5 class="font-bold text-xs text-slate-900 mb-1.5" id="mock_ab_title">{{ $settings['home_about_title'] }}</h5>
                            <div class="flex gap-2 items-center mb-2">
                                <p class="text-[9px] text-slate-600 line-clamp-3 leading-tight flex-1" id="mock_ab_desc">{{ $settings['home_about_desc'] }}</p>
                                <div class="w-10 h-10 rounded-xs overflow-hidden shrink-0 border border-slate-200">
                                    <img id="mock_ab_img" src="{{ $settings['home_about_image'] }}" class="w-full h-full object-cover" />
                                </div>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold text-[#006830] inline-flex items-center gap-1">
                            Selengkapnya <i class="fa-solid fa-arrow-right text-[7px]"></i>
                        </span>
                    </div>

                    <!-- Kolom 2: Alur Proses -->
                    <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                        <div>
                            <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block mb-0.5">PROSES KAMI</span>
                            <h5 class="font-bold text-xs text-slate-900 mb-1.5" id="mock_pr_title">{{ $settings['home_process_title'] }}</h5>
                            <div class="flex items-center justify-between text-center gap-0.5 py-1">
                                <span class="text-[7.5px] font-bold bg-emerald-50 text-emerald-800 px-1 py-0.5 rounded-xs">Konsultasi</span>
                                <i class="fa-solid fa-arrow-right text-[6px] text-slate-400"></i>
                                <span class="text-[7.5px] font-bold bg-emerald-50 text-emerald-800 px-1 py-0.5 rounded-xs">Desain</span>
                                <i class="fa-solid fa-arrow-right text-[6px] text-slate-400"></i>
                                <span class="text-[7.5px] font-bold bg-emerald-50 text-emerald-800 px-1 py-0.5 rounded-xs">Produksi</span>
                                <i class="fa-solid fa-arrow-right text-[6px] text-slate-400"></i>
                                <span class="text-[7.5px] font-bold bg-emerald-50 text-emerald-800 px-1 py-0.5 rounded-xs">Kirim</span>
                            </div>
                        </div>
                        <p class="text-[8px] text-slate-400 truncate" id="mock_pr_desc">{{ $settings['home_process_desc'] }}</p>
                    </div>

                    <!-- Kolom 3: Real Catalog Preview -->
                    <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                        <div>
                            <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block mb-0.5">PRODUK TERBARU</span>
                            <h5 class="font-bold text-xs text-slate-900 mb-1.5">Katalog Buku Terbaru</h5>
                            <div class="grid grid-cols-4 gap-1 mb-1">
                                <div class="aspect-[3/4] bg-[#032c21] rounded-xs p-1 text-[6px] text-white font-bold flex items-center justify-center text-center">BUKU 1</div>
                                <div class="aspect-[3/4] bg-[#032c21] rounded-xs p-1 text-[6px] text-white font-bold flex items-center justify-center text-center">BUKU 2</div>
                                <div class="aspect-[3/4] bg-[#032c21] rounded-xs p-1 text-[6px] text-white font-bold flex items-center justify-center text-center">BUKU 3</div>
                                <div class="aspect-[3/4] bg-[#032c21] rounded-xs p-1 text-[6px] text-white font-bold flex items-center justify-center text-center">BUKU 4</div>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold text-emerald-800 inline-flex items-center gap-1">
                            Buka Katalog <i class="fa-solid fa-arrow-right text-[7px]"></i>
                        </span>
                    </div>

                </div>

                <!-- 4. Bottom Action Bar Preview (Exact Dual CTA) -->
                <div class="bg-[#032c21] text-white p-3 rounded-sm border border-slate-800 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-white/10 text-lime-400 flex items-center justify-center text-xs shrink-0">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div>
                            <h5 class="text-[10px] font-bold text-white leading-tight" id="mock_cta_title">{{ $settings['home_cta_title'] }}</h5>
                            <p class="text-[8.5px] text-slate-300 truncate" id="mock_cta_desc">{{ $settings['home_cta_desc'] }}</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 bg-lime-400 text-slate-950 font-bold text-[8.5px] rounded-xs whitespace-nowrap" id="mock_cta_btn">
                        {{ $settings['home_cta_btn_text'] }}
                    </span>
                </div>

            </div>
        </div>

    </div>

</div>

<script>
    let currentActivePreviewSlide = 1;

    function switchPreviewSlide(slideNum) {
        currentActivePreviewSlide = slideNum;
        [1, 2, 3].forEach(n => {
            const btn = document.getElementById('btn_tab_s' + n);
            const dot = document.getElementById('dot_s' + n);
            if (n === slideNum) {
                btn.className = 'px-2 py-0.5 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition';
                dot.className = 'w-2 h-2 rounded-full bg-lime-400';
            } else {
                btn.className = 'px-2 py-0.5 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition';
                dot.className = 'w-2 h-2 rounded-full bg-white/40';
            }
        });
        updateLiveHomePreview();
    }

    function updateLiveHomePreview() {
        const s = currentActivePreviewSlide;
        const title = document.getElementById('in_s' + s + '_title')?.value || 'Melayani Penerbitan dan Percetakan';
        const hl = document.getElementById('in_s' + s + '_hl')?.value || 'Berkualitas';
        const desc = document.getElementById('in_s' + s + '_desc')?.value || 'Deskripsi slider hero...';
        const img = document.getElementById('in_s' + s + '_img')?.value;
        const b1 = document.getElementById('in_s' + s + '_b1_t')?.value || 'LIHAT LAYANAN';
        const b2 = document.getElementById('in_s' + s + '_b2_t')?.value || 'KATALOG BUKU';

        document.getElementById('mock_hero_title').innerHTML = title.replace(/\n/g, '<br>');
        document.getElementById('mock_hero_hl').innerText = hl;
        document.getElementById('mock_hero_desc').innerText = desc;
        if (img) document.getElementById('mock_hero_img').src = img;
        document.getElementById('mock_hero_b1').innerHTML = b1 + ' <i class="fa-solid fa-arrow-right text-[8px]"></i>';
        document.getElementById('mock_hero_b2').innerHTML = b2 + ' <i class="fa-solid fa-book-open text-[8px]"></i>';

        // 4 Value Props
        document.getElementById('mock_f1_title').innerText = document.getElementById('in_f1_title')?.value || 'Kualitas';
        document.getElementById('mock_f1_desc').innerText = document.getElementById('in_f1_desc')?.value || 'Deskripsi';
        document.getElementById('mock_f2_title').innerText = document.getElementById('in_f2_title')?.value || 'Kecepatan';
        document.getElementById('mock_f2_desc').innerText = document.getElementById('in_f2_desc')?.value || 'Deskripsi';
        document.getElementById('mock_f3_title').innerText = document.getElementById('in_f3_title')?.value || 'Harga';
        document.getElementById('mock_f3_desc').innerText = document.getElementById('in_f3_desc')?.value || 'Deskripsi';
        document.getElementById('mock_f4_title').innerText = document.getElementById('in_f4_title')?.value || 'Pengalaman';
        document.getElementById('mock_f4_desc').innerText = document.getElementById('in_f4_desc')?.value || 'Deskripsi';

        // Profil & Alur
        document.getElementById('mock_ab_title').innerText = document.getElementById('in_ab_title')?.value || 'PERSIS PERS';
        document.getElementById('mock_ab_desc').innerText = document.getElementById('in_ab_desc')?.value || 'Deskripsi profil...';
        const abImg = document.getElementById('in_ab_img')?.value;
        if (abImg) document.getElementById('mock_ab_img').src = abImg;
        document.getElementById('mock_pr_title').innerText = document.getElementById('in_pr_title')?.value || 'Proses Produksi';
        document.getElementById('mock_pr_desc').innerText = document.getElementById('in_pr_desc')?.value || 'Catatan mutu...';

        // CTA
        document.getElementById('mock_cta_title').innerText = document.getElementById('in_cta_title')?.value || 'Konsultasi';
        document.getElementById('mock_cta_desc').innerText = document.getElementById('in_cta_desc')?.value || 'Deskripsi ajakan...';
        document.getElementById('mock_cta_btn').innerText = document.getElementById('in_cta_btn')?.value || 'KONSULTASI';
    }
</script>
@endsection
