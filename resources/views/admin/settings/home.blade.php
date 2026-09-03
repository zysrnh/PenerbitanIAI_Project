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
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• Dinamis Slider, Layanan &amp; Visualizer</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Kelola Konten, Slider &amp; Layanan Beranda
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Sesuaikan foto slide, 4 nilai keunggulan, daftar kartu layanan (bisa ditambah/dikurangi), dan profil singkat redaksi.
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
            <form method="POST" action="{{ route('admin.settings.home.update') }}" enctype="multipart/form-data" id="homeSettingsForm" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- 1. SLIDER BERANDA DINAMIS (BISA TAMBAH / KURANG & PILIH MODE IKLAN/STANDAR) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                                1
                            </div>
                            <div>
                                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Slide Hero Slider Beranda</h3>
                                <p class="text-[11px] text-slate-400">Bisa tambah slide banner baru tanpa batas &amp; bebas pilih tipe iklan/teks.</p>
                            </div>
                        </div>
                        <button type="button" onclick="addNewSlideRow()" class="px-2.5 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 rounded-xs text-[11px] font-bold transition flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            <span>Tambah Slide Baru</span>
                        </button>
                    </div>

                    <!-- Slide Repeater List Container -->
                    <div id="slidesListContainer" class="space-y-4">
                        @foreach($slides as $i => $slide)
                            @php
                                $isClean = ($slide['type'] ?? 'standard') === 'clean';
                            @endphp
                            <div class="slide-item-card p-4 bg-slate-50/80 border border-slate-200 rounded-sm space-y-3.5 relative" data-index="{{ $i }}">
                                
                                <!-- Card Header: Slide Number + Type Selector + Delete Button -->
                                <div class="flex items-center justify-between pb-2.5 border-b border-slate-200 flex-wrap gap-2">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-grip-vertical text-slate-400 text-xs"></i>
                                        <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">
                                            Slide #<span class="slide-num">{{ $i + 1 }}</span>
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <!-- Type Choice Selector -->
                                        <div class="inline-flex rounded-xs bg-white p-0.5 border border-slate-300 text-[10.5px] font-semibold">
                                            <label class="cursor-pointer px-2 py-0.5 rounded-xs transition {{ !$isClean ? 'bg-[#006830] text-white font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                                                <input type="radio" name="slides[{{ $i }}][type]" value="standard" {{ !$isClean ? 'checked' : '' }} onchange="handleSlideTypeChange(this)" class="sr-only">
                                                <span><i class="fa-solid fa-font mr-1"></i>Teks Standar</span>
                                            </label>
                                            <label class="cursor-pointer px-2 py-0.5 rounded-xs transition {{ $isClean ? 'bg-amber-600 text-white font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                                                <input type="radio" name="slides[{{ $i }}][type]" value="clean" {{ $isClean ? 'checked' : '' }} onchange="handleSlideTypeChange(this)" class="sr-only">
                                                <span><i class="fa-solid fa-image mr-1"></i>Iklan / Poster Bersih</span>
                                            </label>
                                        </div>

                                        <button type="button" onclick="removeSlideRow(this)" class="text-slate-400 hover:text-rose-600 transition p-1 cursor-pointer text-xs" title="Hapus Slide">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Information Note for Mode -->
                                <div class="slide-type-note text-[11px] p-2.5 rounded-xs {{ $isClean ? 'bg-amber-50 text-amber-900 border border-amber-200' : 'bg-emerald-50 text-emerald-900 border border-emerald-200' }}">
                                    @if($isClean)
                                        <i class="fa-solid fa-wand-magic-sparkles mr-1 text-amber-600"></i>
                                        <strong>Mode Banner Iklan:</strong> Banner tampil 100% penuh tanpa teks overlay &amp; tanpa bayangan gelap. Cukup upload poster flyer Anda.
                                    @else
                                        <i class="fa-solid fa-circle-info mr-1 text-emerald-700"></i>
                                        <strong>Mode Banner Standar:</strong> Dilengkapi overlay judul, sorotan teks hijau, deskripsi, dan tombol aksi.
                                    @endif
                                </div>

                                <!-- Foto Upload Section -->
                                <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label class="block font-bold text-slate-800 text-xs">Gambar Banner Slide</label>
                                        <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs">JPG, PNG, WEBP max 5MB</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-16 h-12 rounded-xs overflow-hidden border border-slate-300 bg-slate-100 shrink-0">
                                            <img id="thumb_s_{{ $i }}" src="{{ $slide['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="flex-1 space-y-1.5">
                                            <input type="file" name="slides[{{ $i }}][image_file]" accept="image/*" onchange="handleSlideImageFilePreview(this, {{ $i }})" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10.5px] file:font-bold file:bg-[#006830] file:text-white hover:file:bg-[#032c21] cursor-pointer" />
                                            <input type="text" name="slides[{{ $i }}][image]" id="in_s_{{ $i }}_img" value="{{ $slide['image'] ?? '' }}" placeholder="Atau paste URL gambar..." oninput="updateSlideImageUrl({{ $i }})" class="w-full px-2.5 py-1 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                                        </div>
                                    </div>
                                    
                                    <!-- Fit Mode Selector -->
                                    <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-[11px]">
                                        <span class="font-bold text-slate-700">Tampilan Banner:</span>
                                        @php $fit = $slide['fit'] ?? ($isClean ? 'contain' : 'cover'); @endphp
                                        <div class="inline-flex rounded-xs bg-slate-100 p-0.5 border border-slate-200 text-[10px]">
                                            <label class="cursor-pointer px-2 py-0.5 rounded-xs transition {{ $fit === 'contain' ? 'bg-[#006830] text-white font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                                                <input type="radio" name="slides[{{ $i }}][fit]" value="contain" {{ $fit === 'contain' ? 'checked' : '' }} onchange="handleSlideFitChange(this)" class="sr-only">
                                                <span><i class="fa-solid fa-compress mr-1"></i>Tampil Utuh (No-Crop)</span>
                                            </label>
                                            <label class="cursor-pointer px-2 py-0.5 rounded-xs transition {{ $fit === 'cover' ? 'bg-[#006830] text-white font-bold' : 'text-slate-600 hover:text-slate-900' }}">
                                                <input type="radio" name="slides[{{ $i }}][fit]" value="cover" {{ $fit === 'cover' ? 'checked' : '' }} onchange="handleSlideFitChange(this)" class="sr-only">
                                                <span><i class="fa-solid fa-expand mr-1"></i>Penuhi Layar (Cover)</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Overlay Inputs (Collapsible or Hidden when Clean Mode) -->
                                <div class="slide-text-fields space-y-3 text-xs {{ $isClean ? 'opacity-50' : '' }}">
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div class="sm:col-span-2">
                                            <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide</label>
                                            <textarea name="slides[{{ $i }}][title]" id="in_s_{{ $i }}_title" rows="2" oninput="updateLiveHomePreview()" placeholder="Misal: Melayani Penerbitan dan Percetakan" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ $slide['title'] ?? '' }}</textarea>
                                        </div>
                                        <div>
                                            <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                                            <input type="text" name="slides[{{ $i }}][highlight]" id="in_s_{{ $i }}_hl" value="{{ $slide['highlight'] ?? '' }}" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600" placeholder="Berkualitas" />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide</label>
                                        <textarea name="slides[{{ $i }}][desc]" id="in_s_{{ $i }}_desc" rows="2" oninput="updateLiveHomePreview()" placeholder="Deskripsi ringkas..." class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600">{{ $slide['desc'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- Action Buttons (Available for both modes) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 text-xs">
                                    <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                                        <span class="text-[10px] font-bold text-emerald-800 uppercase flex items-center gap-1">
                                            <i class="fa-solid fa-arrow-right text-[9px]"></i> Tombol Aksi 1 (Hijau Terang)
                                        </span>
                                        <input type="text" name="slides[{{ $i }}][btn1_text]" id="in_s_{{ $i }}_b1_t" value="{{ $slide['btn1_text'] ?? '' }}" placeholder="Label Tombol (misal: ORDER SEKARANG)" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                        <input type="text" name="slides[{{ $i }}][btn1_url]" value="{{ $slide['btn1_url'] ?? '' }}" placeholder="Link URL (misal: /katalog)" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                                    </div>
                                    <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                                        <span class="text-[10px] font-bold text-slate-700 uppercase flex items-center gap-1">
                                            <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i> Tombol Aksi 2 (Gelap / Garis)
                                        </span>
                                        <input type="text" name="slides[{{ $i }}][btn2_text]" id="in_s_{{ $i }}_b2_t" value="{{ $slide['btn2_text'] ?? '' }}" placeholder="Label Tombol (misal: HUBUNGI KAMI)" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                                        <input type="text" name="slides[{{ $i }}][btn2_url]" value="{{ $slide['btn2_url'] ?? '' }}" placeholder="Link URL (misal: /kontak)" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <!-- Bottom Add Slide Button -->
                    <div class="pt-2">
                        <button type="button" onclick="addNewSlideRow()" class="w-full py-3 border-2 border-dashed border-emerald-300 hover:border-emerald-600 bg-emerald-50/50 hover:bg-emerald-100/70 text-emerald-800 rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                            <i class="fa-solid fa-plus-circle text-sm text-emerald-600"></i>
                            <span>+ Tambah Slide Banner / Iklan Baru</span>
                        </button>
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

                <!-- 5. KELOLA LAYANAN KAMI (BISA DITAMBAH / DIKURANGI) -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3.5 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                                5
                            </div>
                            <div>
                                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Daftar Layanan Kami (Fleksibel)</h3>
                                <p class="text-[11px] text-slate-400">Atur kartu layanan di beranda, bisa ditambah atau dikurangi.</p>
                            </div>
                        </div>
                        <button type="button" onclick="addNewServiceRow()" class="px-2.5 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 rounded-xs text-[11px] font-bold transition flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            <span>Tambah Layanan</span>
                        </button>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Badge Layanan</label>
                                <input type="text" name="home_services_badge" value="{{ old('home_services_badge', $settings['home_services_badge']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Judul Seksi Layanan</label>
                                <input type="text" name="home_services_title" value="{{ old('home_services_title', $settings['home_services_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                            </div>
                        </div>

                        <!-- Service Items List -->
                        <div id="servicesListContainer" class="space-y-3 pt-2">
                            @foreach($services as $index => $srv)
                                <div class="service-item-row p-3.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2 relative" data-index="{{ $index }}">
                                    <div class="flex items-center justify-between">
                                        <span class="text-[10.5px] font-bold text-emerald-800 uppercase flex items-center gap-1.5">
                                            <i class="fa-solid fa-grip-vertical text-slate-400 text-xs"></i>
                                            <span>Layanan #<span class="service-num">{{ $index + 1 }}</span></span>
                                        </span>
                                        <button type="button" onclick="removeServiceRow(this)" class="text-slate-400 hover:text-rose-600 transition p-1 cursor-pointer text-xs" title="Hapus Layanan">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                        <div>
                                            <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Icon FontAwesome</label>
                                            <input type="text" name="services[{{ $index }}][icon]" value="{{ $srv['icon'] ?? 'fa-solid fa-book-open' }}" placeholder="fa-solid fa-book-open" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-mono text-[11px]" />
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Nama Layanan</label>
                                            <input type="text" name="services[{{ $index }}][title]" value="{{ $srv['title'] ?? '' }}" required placeholder="Contoh: Penerbitan Buku" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-bold" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Deskripsi Ringkas</label>
                                        <input type="text" name="services[{{ $index }}][desc]" value="{{ $srv['desc'] ?? '' }}" required placeholder="Penjelasan singkat layanan..." class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white" />
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Link URL Tujuan</label>
                                        <input type="text" name="services[{{ $index }}][link]" value="{{ $srv['link'] ?? '/kontak' }}" placeholder="/kontak" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-mono text-[11px]" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 6. PROFIL SINGKAT & ALUR PRODUKSI -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3.5 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold shrink-0">
                            6
                        </div>
                        <div>
                            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Profil Singkat &amp; Alur Produksi</h3>
                            <p class="text-[11px] text-slate-400">Konten kartu tengah beranda (Katalog otomatis terhubung dengan database master buku).</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Profil <span class="text-rose-500">*</span></label>
                            <input type="text" name="home_about_title" id="in_ab_title" value="{{ old('home_about_title', $settings['home_about_title']) }}" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300" />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat Profil <span class="text-rose-500">*</span></label>
                            <textarea name="home_about_desc" id="in_ab_desc" rows="2" required oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300">{{ old('home_about_desc', $settings['home_about_desc']) }}</textarea>
                        </div>

                        <!-- Foto Profil Redaksi -->
                        <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2.5">
                            <div class="flex items-center justify-between">
                                <label class="block font-bold text-slate-800">Foto Profil Gedung / Kantor Redaksi</label>
                                <span class="text-[10px] text-emerald-700 font-bold bg-emerald-100/60 px-1.5 py-0.5 rounded-xs">JPG, PNG, WEBP max 5MB</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-12 rounded-xs overflow-hidden border border-slate-300 bg-slate-200 shrink-0">
                                    <img id="thumb_ab" src="{{ $settings['home_about_image'] }}" class="w-full h-full object-cover" />
                                </div>
                                <div class="flex-1 space-y-1.5">
                                    <input type="file" name="home_about_image_file" id="in_file_ab" accept="image/*" onchange="handleImageFilePreview(this, 'ab')" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10.5px] file:font-bold file:bg-[#006830] file:text-white hover:file:bg-[#032c21] cursor-pointer" />
                                    <input type="text" name="home_about_image" id="in_ab_img" value="{{ old('home_about_image', $settings['home_about_image']) }}" placeholder="Atau paste URL foto di sini..." oninput="updateImageFromUrl('ab')" class="w-full px-2.5 py-1 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                                </div>
                            </div>
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

                <!-- Dynamic Slide Preview Tab Buttons -->
                <div class="flex items-center gap-1 bg-slate-800 p-1 rounded-sm overflow-x-auto max-w-xs" id="previewSlideTabsContainer">
                    <!-- Populated dynamically by JS -->
                </div>
            </div>

            <!-- Visual Preview Canvas (Exact Page Representation) -->
            <div class="bg-slate-100 rounded-sm border border-slate-200/90 shadow-md overflow-hidden text-slate-800 space-y-3.5 p-3 sm:p-4 max-h-[82vh] overflow-y-auto">
                <!-- 1. Hero Slider Exact Preview -->
                <div class="relative bg-brand-950 bg-[#032c21] rounded-sm overflow-hidden border border-slate-800 text-white min-h-[300px] sm:min-h-[320px] p-5 sm:p-6 flex flex-col justify-between shadow-inner">
                    <!-- Ambient Blurred Backdrop -->
                    <div id="mock_hero_ambient" class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
                        <img id="mock_hero_ambient_img" src="{{ $slides[0]['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" class="w-full h-full object-cover blur-2xl opacity-40 scale-110" />
                    </div>

                    <!-- Bg Image with Optional Scrim -->
                    <div class="absolute inset-0 z-0 flex items-center justify-center">
                        <img id="mock_hero_img" src="{{ $slides[0]['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" class="w-full h-full object-contain object-center" />
                        <div id="mock_hero_scrim" class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>
                    </div>

                    <!-- Slide Content Left Aligned -->
                    <div id="mock_hero_content_wrapper" class="relative z-10 space-y-2.5 max-w-sm flex-1 flex flex-col justify-center">
                        <div id="mock_hero_text_box">
                            <h4 class="text-base sm:text-lg font-extrabold text-white leading-tight">
                                <span id="mock_hero_title">{!! nl2br(e($slides[0]['title'] ?? '')) !!}</span><br>
                                <span class="text-lime-400" id="mock_hero_hl">{{ $slides[0]['highlight'] ?? '' }}</span>
                            </h4>
                            <p class="text-[11px] text-slate-200/90 leading-relaxed line-clamp-3 mt-1.5" id="mock_hero_desc">
                                {{ $slides[0]['desc'] ?? '' }}
                            </p>
                        </div>

                        <!-- Mockup Buttons -->
                        <div id="mock_hero_buttons_row" class="flex items-center gap-2 pt-1.5 flex-wrap">
                            <span id="mock_hero_b1" class="px-3 py-1.5 bg-lime-400 text-slate-950 font-bold text-[9.5px] rounded-xs uppercase tracking-wider flex items-center gap-1 shadow-xs">
                                {{ $slides[0]['btn1_text'] ?? 'ORDER SEKARANG' }} <i class="fa-solid fa-arrow-right text-[8px]"></i>
                            </span>
                            <span id="mock_hero_b2" class="px-3 py-1.5 bg-black/60 text-white font-semibold text-[9.5px] rounded-xs border border-white/30 uppercase tracking-wider flex items-center gap-1">
                                {{ $slides[0]['btn2_text'] ?? 'HUBUNGI KAMI' }} <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Slide Indicators -->
                    <div class="relative z-10 flex items-center gap-1.5 pt-2" id="mock_dots_container">
                        <!-- Populated dynamically by JS -->
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
                                <i class="fa-solid fa-hand-holding-dollar"></i>
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

            </div>
        </div>

    </div>

</div>

<script>
    let currentActivePreviewSlideIndex = 0;

    // --- Dynamic Slides Repeater Functions ---
    function addNewSlideRow() {
        const container = document.getElementById('slidesListContainer');
        const cards = container.querySelectorAll('.slide-item-card');
        const newIndex = cards.length;

        const card = document.createElement('div');
        card.className = 'slide-item-card p-4 bg-slate-50/80 border border-slate-200 rounded-sm space-y-3.5 relative animate-fade-in';
        card.setAttribute('data-index', newIndex);
        card.innerHTML = `
            <div class="flex items-center justify-between pb-2.5 border-b border-slate-200 flex-wrap gap-2">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-grip-vertical text-slate-400 text-xs"></i>
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider">
                        Slide #<span class="slide-num">${newIndex + 1}</span>
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="inline-flex rounded-xs bg-white p-0.5 border border-slate-300 text-[10.5px] font-semibold">
                        <label class="cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900">
                            <input type="radio" name="slides[${newIndex}][type]" value="standard" onchange="handleSlideTypeChange(this)" class="sr-only">
                            <span><i class="fa-solid fa-font mr-1"></i>Teks Standar</span>
                        </label>
                        <label class="cursor-pointer px-2 py-0.5 rounded-xs transition bg-amber-600 text-white font-bold">
                            <input type="radio" name="slides[${newIndex}][type]" value="clean" checked onchange="handleSlideTypeChange(this)" class="sr-only">
                            <span><i class="fa-solid fa-image mr-1"></i>Iklan / Poster Bersih</span>
                        </label>
                    </div>
                    <button type="button" onclick="removeSlideRow(this)" class="text-slate-400 hover:text-rose-600 transition p-1 cursor-pointer text-xs" title="Hapus Slide">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <div class="slide-type-note text-[11px] p-2.5 rounded-xs bg-amber-50 text-amber-900 border border-amber-200">
                <i class="fa-solid fa-wand-magic-sparkles mr-1 text-amber-600"></i>
                <strong>Mode Banner Iklan:</strong> Banner tampil 100% penuh tanpa teks overlay &amp; tanpa bayangan gelap. Cukup upload poster flyer Anda.
            </div>

            <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block font-bold text-slate-800 text-xs">Gambar Banner Slide</label>
                    <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs">JPG, PNG, WEBP max 5MB</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-16 h-12 rounded-xs overflow-hidden border border-slate-300 bg-slate-100 shrink-0">
                        <img id="thumb_s_${newIndex}" src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1 space-y-1.5">
                        <input type="file" name="slides[${newIndex}][image_file]" accept="image/*" onchange="handleSlideImageFilePreview(this, ${newIndex})" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10.5px] file:font-bold file:bg-[#006830] file:text-white hover:file:bg-[#032c21] cursor-pointer" />
                        <input type="text" name="slides[${newIndex}][image]" id="in_s_${newIndex}_img" value="" placeholder="Atau paste URL gambar..." oninput="updateSlideImageUrl(${newIndex})" class="w-full px-2.5 py-1 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                    </div>
                </div>
                <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-[11px]">
                    <span class="font-bold text-slate-700">Tampilan Banner:</span>
                    <div class="inline-flex rounded-xs bg-slate-100 p-0.5 border border-slate-200 text-[10px]">
                        <label class="cursor-pointer px-2 py-0.5 rounded-xs transition bg-[#006830] text-white font-bold">
                            <input type="radio" name="slides[${newIndex}][fit]" value="contain" checked onchange="handleSlideFitChange(this)" class="sr-only">
                            <span><i class="fa-solid fa-compress mr-1"></i>Tampil Utuh (No-Crop)</span>
                        </label>
                        <label class="cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900">
                            <input type="radio" name="slides[${newIndex}][fit]" value="cover" onchange="handleSlideFitChange(this)" class="sr-only">
                            <span><i class="fa-solid fa-expand mr-1"></i>Penuhi Layar (Cover)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="slide-text-fields space-y-3 text-xs opacity-50">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block font-bold text-slate-700 mb-1">Judul Utama Slide</label>
                        <textarea name="slides[${newIndex}][title]" id="in_s_${newIndex}_title" rows="2" oninput="updateLiveHomePreview()" placeholder="Misal: Melayani Penerbitan dan Percetakan" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600"></textarea>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Teks Sorotan Hijau</label>
                        <input type="text" name="slides[${newIndex}][highlight]" id="in_s_${newIndex}_hl" value="" oninput="updateLiveHomePreview()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600" placeholder="Berkualitas" />
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Deskripsi Slide</label>
                    <textarea name="slides[${newIndex}][desc]" id="in_s_${newIndex}_desc" rows="2" oninput="updateLiveHomePreview()" placeholder="Deskripsi ringkas..." class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 text-xs">
                <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                    <span class="text-[10px] font-bold text-emerald-800 uppercase flex items-center gap-1">
                        <i class="fa-solid fa-arrow-right text-[9px]"></i> Tombol Aksi 1 (Hijau Terang)
                    </span>
                    <input type="text" name="slides[${newIndex}][btn1_text]" id="in_s_${newIndex}_b1_t" value="" placeholder="Label Tombol (opsional)" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                    <input type="text" name="slides[${newIndex}][btn1_url]" value="/katalog" placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                </div>
                <div class="p-3 bg-white border border-slate-200 rounded-sm space-y-2">
                    <span class="text-[10px] font-bold text-slate-700 uppercase flex items-center gap-1">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i> Tombol Aksi 2 (Gelap / Garis)
                    </span>
                    <input type="text" name="slides[${newIndex}][btn2_text]" id="in_s_${newIndex}_b2_t" value="" placeholder="Label Tombol (opsional)" oninput="updateLiveHomePreview()" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white" />
                    <input type="text" name="slides[${newIndex}][btn2_url]" value="/kontak" placeholder="Link URL" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                </div>
            </div>
        `;

        container.appendChild(card);
        renumberSlides();
        renderPreviewTabs();
        switchPreviewSlide(newIndex);
        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function removeSlideRow(btn) {
        const container = document.getElementById('slidesListContainer');
        const cards = container.querySelectorAll('.slide-item-card');
        if (cards.length <= 1) {
            alert('Minimal harus ada 1 slide di slider beranda.');
            return;
        }
        btn.closest('.slide-item-card').remove();
        renumberSlides();
        renderPreviewTabs();
        switchPreviewSlide(Math.max(0, currentActivePreviewSlideIndex - 1));
    }

    function renumberSlides() {
        const container = document.getElementById('slidesListContainer');
        const cards = container.querySelectorAll('.slide-item-card');
        cards.forEach((card, i) => {
            card.setAttribute('data-index', i);
            card.querySelector('.slide-num').innerText = (i + 1);

            // Update all form names
            card.querySelectorAll('input, textarea').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/slides\[\d+\]/, 'slides[' + i + ']'));
                }
                const id = input.getAttribute('id');
                if (id && id.includes('_s_')) {
                    input.setAttribute('id', id.replace(/_s_\d+_/, '_s_' + i + '_').replace(/_s_\d+$/, '_s_' + i));
                }
            });

            // Update thumb id
            const thumb = card.querySelector('img[id^="thumb_s_"]');
            if (thumb) thumb.setAttribute('id', 'thumb_s_' + i);
        });
    }

    function handleSlideTypeChange(radio) {
        const card = radio.closest('.slide-item-card');
        const isClean = radio.value === 'clean';
        const labels = radio.closest('.inline-flex').querySelectorAll('label');

        if (isClean) {
            labels[0].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900';
            labels[1].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition bg-amber-600 text-white font-bold';
        } else {
            labels[0].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition bg-[#006830] text-white font-bold';
            labels[1].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900';
        }

        const note = card.querySelector('.slide-type-note');
        if (note) {
            if (isClean) {
                note.className = 'slide-type-note text-[11px] p-2.5 rounded-xs bg-amber-50 text-amber-900 border border-amber-200';
                note.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles mr-1 text-amber-600"></i><strong>Mode Banner Iklan:</strong> Banner tampil 100% penuh tanpa teks overlay &amp; tanpa bayangan gelap. Cukup upload poster flyer Anda.';
            } else {
                note.className = 'slide-type-note text-[11px] p-2.5 rounded-xs bg-emerald-50 text-emerald-900 border border-emerald-200';
                note.innerHTML = '<i class="fa-solid fa-circle-info mr-1 text-emerald-700"></i><strong>Mode Banner Standar:</strong> Dilengkapi overlay judul, sorotan teks hijau, deskripsi, dan tombol aksi.';
            }
        }

        const textFields = card.querySelector('.slide-text-fields');
        if (textFields) {
            if (isClean) {
                textFields.classList.add('opacity-50');
            } else {
                textFields.classList.remove('opacity-50');
            }
        }

        updateLiveHomePreview();
    }

    function handleSlideFitChange(radio) {
        const card = radio.closest('.slide-item-card');
        const labels = radio.closest('.inline-flex').querySelectorAll('label');
        if (radio.value === 'contain') {
            labels[0].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition bg-[#006830] text-white font-bold';
            labels[1].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900';
        } else {
            labels[0].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition text-slate-600 hover:text-slate-900';
            labels[1].className = 'cursor-pointer px-2 py-0.5 rounded-xs transition bg-[#006830] text-white font-bold';
        }
        updateLiveHomePreview();
    }

    function handleSlideImageFilePreview(input, index) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                const thumb = document.getElementById('thumb_s_' + index);
                if (thumb) thumb.src = dataUrl;
                if (currentActivePreviewSlideIndex === index) {
                    const heroImg = document.getElementById('mock_hero_img');
                    const ambImg = document.getElementById('mock_hero_ambient_img');
                    if (heroImg) heroImg.src = dataUrl;
                    if (ambImg) ambImg.src = dataUrl;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateSlideImageUrl(index) {
        const urlInput = document.getElementById('in_s_' + index + '_img');
        if (urlInput && urlInput.value) {
            const thumb = document.getElementById('thumb_s_' + index);
            if (thumb) thumb.src = urlInput.value;
            if (currentActivePreviewSlideIndex === index) {
                const heroImg = document.getElementById('mock_hero_img');
                const ambImg = document.getElementById('mock_hero_ambient_img');
                if (heroImg) heroImg.src = urlInput.value;
                if (ambImg) ambImg.src = urlInput.value;
            }
        }
    }

    // --- Dynamic Preview Rendering ---
    function renderPreviewTabs() {
        const container = document.getElementById('previewSlideTabsContainer');
        const dotsContainer = document.getElementById('mock_dots_container');
        const cards = document.querySelectorAll('.slide-item-card');

        container.innerHTML = '';
        dotsContainer.innerHTML = '';

        cards.forEach((card, i) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.id = 'btn_tab_s_' + i;
            btn.className = (i === currentActivePreviewSlideIndex) 
                ? 'px-2 py-0.5 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition shrink-0 cursor-pointer' 
                : 'px-2 py-0.5 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition shrink-0 cursor-pointer';
            btn.innerText = 'Slide ' + (i + 1);
            btn.onclick = () => switchPreviewSlide(i);
            container.appendChild(btn);

            const dot = document.createElement('span');
            dot.id = 'dot_s_' + i;
            dot.className = (i === currentActivePreviewSlideIndex)
                ? 'w-6 h-2 rounded-full bg-lime-400 transition-all'
                : 'w-2 h-2 rounded-full bg-white/40 transition-all';
            dotsContainer.appendChild(dot);
        });
    }

    function switchPreviewSlide(index) {
        currentActivePreviewSlideIndex = index;
        const cards = document.querySelectorAll('.slide-item-card');
        
        cards.forEach((_, i) => {
            const btn = document.getElementById('btn_tab_s_' + i);
            const dot = document.getElementById('dot_s_' + i);
            if (btn) {
                btn.className = (i === index) 
                    ? 'px-2 py-0.5 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition shrink-0 cursor-pointer' 
                    : 'px-2 py-0.5 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition shrink-0 cursor-pointer';
            }
            if (dot) {
                dot.className = (i === index)
                    ? 'w-6 h-2 rounded-full bg-lime-400 transition-all'
                    : 'w-2 h-2 rounded-full bg-white/40 transition-all';
            }
        });

        updateLiveHomePreview();
    }

    function updateLiveHomePreview() {
        const i = currentActivePreviewSlideIndex;
        const card = document.querySelector(`.slide-item-card[data-index="${i}"]`);
        if (!card) return;

        const typeInput = card.querySelector(`input[name="slides[${i}][type]"]:checked`);
        const isClean = typeInput ? typeInput.value === 'clean' : false;

        const fitInput = card.querySelector(`input[name="slides[${i}][fit]"]:checked`);
        const fitMode = fitInput ? fitInput.value : (isClean ? 'contain' : 'cover');

        const titleInput = card.querySelector(`textarea[name="slides[${i}][title]"]`);
        const hlInput = card.querySelector(`input[name="slides[${i}][highlight]"]`);
        const descInput = card.querySelector(`textarea[name="slides[${i}][desc]"]`);
        const thumbImg = document.getElementById('thumb_s_' + i)?.src;

        const b1Input = card.querySelector(`input[name="slides[${i}][btn1_text]"]`);
        const b2Input = card.querySelector(`input[name="slides[${i}][btn2_text]"]`);

        const title = titleInput?.value || '';
        const hl = hlInput?.value || '';
        const desc = descInput?.value || '';
        const b1 = b1Input?.value || '';
        const b2 = b2Input?.value || '';

        const scrim = document.getElementById('mock_hero_scrim');
        const contentWrapper = document.getElementById('mock_hero_content_wrapper');
        const textBox = document.getElementById('mock_hero_text_box');
        const heroImg = document.getElementById('mock_hero_img');
        const ambImg = document.getElementById('mock_hero_ambient_img');

        if (fitMode === 'contain') {
            if (heroImg) heroImg.className = 'w-full h-full object-contain object-center';
            if (ambImg && ambImg.parentElement) ambImg.parentElement.classList.remove('hidden');
        } else {
            if (heroImg) heroImg.className = 'w-full h-full object-cover object-center';
            if (ambImg && ambImg.parentElement) ambImg.parentElement.classList.add('hidden');
        }

        if (isClean || (!title.trim() && !desc.trim())) {
            if (scrim) scrim.classList.add('hidden');
            if (textBox) textBox.classList.add('hidden');
            if (contentWrapper) {
                contentWrapper.classList.remove('justify-center');
                contentWrapper.classList.add('justify-end');
            }
        } else {
            if (scrim) scrim.classList.remove('hidden');
            if (textBox) textBox.classList.remove('hidden');
            if (contentWrapper) {
                contentWrapper.classList.remove('justify-end');
                contentWrapper.classList.add('justify-center');
            }
            document.getElementById('mock_hero_title').innerHTML = title.replace(/\n/g, '<br>');
            document.getElementById('mock_hero_hl').innerText = hl;
            document.getElementById('mock_hero_desc').innerText = desc;
        }

        if (thumbImg) {
            if (heroImg) heroImg.src = thumbImg;
            if (ambImg) ambImg.src = thumbImg;
        }

        const b1El = document.getElementById('mock_hero_b1');
        const b2El = document.getElementById('mock_hero_b2');

        if (b1 && b1.trim() !== '') {
            b1El.classList.remove('hidden');
            b1El.innerHTML = b1 + ' <i class="fa-solid fa-arrow-right text-[8px]"></i>';
        } else {
            b1El.classList.add('hidden');
        }

        if (b2 && b2.trim() !== '') {
            b2El.classList.remove('hidden');
            b2El.innerHTML = b2 + ' <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>';
        } else {
            b2El.classList.add('hidden');
        }

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
        const abThumb = document.getElementById('thumb_ab')?.src;
        if (abThumb) document.getElementById('mock_ab_img').src = abThumb;
        document.getElementById('mock_pr_title').innerText = document.getElementById('in_pr_title')?.value || 'Proses Produksi';
        document.getElementById('mock_pr_desc').innerText = document.getElementById('in_pr_desc')?.value || 'Catatan mutu...';
    }

    // --- Services Repeater Functions ---
    function addNewServiceRow() {
        const container = document.getElementById('servicesListContainer');
        const count = container.querySelectorAll('.service-item-row').length;
        const newIndex = count;

        const row = document.createElement('div');
        row.className = 'service-item-row p-3.5 bg-slate-50 border border-slate-200 rounded-sm space-y-2 relative animate-fade-in';
        row.setAttribute('data-index', newIndex);
        row.innerHTML = `
            <div class="flex items-center justify-between">
                <span class="text-[10.5px] font-bold text-emerald-800 uppercase flex items-center gap-1.5">
                    <i class="fa-solid fa-grip-vertical text-slate-400 text-xs"></i>
                    <span>Layanan #<span class="service-num">${count + 1}</span></span>
                </span>
                <button type="button" onclick="removeServiceRow(this)" class="text-slate-400 hover:text-rose-600 transition p-1 cursor-pointer text-xs" title="Hapus Layanan">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                <div>
                    <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Icon FontAwesome</label>
                    <input type="text" name="services[${newIndex}][icon]" value="fa-solid fa-bookmark" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-mono text-[11px]" />
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Nama Layanan</label>
                    <input type="text" name="services[${newIndex}][title]" value="Layanan Baru" required class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-bold" />
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Deskripsi Ringkas</label>
                <input type="text" name="services[${newIndex}][desc]" value="Deskripsi layanan baru..." required class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white" />
            </div>
            <div>
                <label class="block text-[10px] font-semibold text-slate-500 mb-0.5">Link URL Tujuan</label>
                <input type="text" name="services[${newIndex}][link]" value="/kontak" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-mono text-[11px]" />
            </div>
        `;
        container.appendChild(row);
        renumberServices();
    }

    function removeServiceRow(btn) {
        const container = document.getElementById('servicesListContainer');
        const rows = container.querySelectorAll('.service-item-row');
        if (rows.length <= 1) {
            alert('Minimal harus ada 1 layanan.');
            return;
        }
        btn.closest('.service-item-row').remove();
        renumberServices();
    }

    function renumberServices() {
        const container = document.getElementById('servicesListContainer');
        const rows = container.querySelectorAll('.service-item-row');
        rows.forEach((row, i) => {
            row.querySelector('.service-num').innerText = (i + 1);
            row.querySelectorAll('input').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/services\[\d+\]/, 'services[' + i + ']'));
                }
            });
        });
    }

    // --- About & General Image Helpers ---
    function handleImageFilePreview(input, key) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                if (key === 'ab') {
                    document.getElementById('thumb_ab').src = dataUrl;
                    document.getElementById('mock_ab_img').src = dataUrl;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateImageFromUrl(key) {
        if (key === 'ab') {
            const url = document.getElementById('in_ab_img').value;
            if (url) {
                document.getElementById('thumb_ab').src = url;
                document.getElementById('mock_ab_img').src = url;
            }
        }
    }

    // Init on load
    document.addEventListener('DOMContentLoaded', function() {
        renderPreviewTabs();
        updateLiveHomePreview();
    });
</script>
@endsection
