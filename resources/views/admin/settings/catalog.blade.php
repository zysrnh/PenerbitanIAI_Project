@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Katalog')
@section('header_title', 'Kelola Konten & Pratinjau Halaman Katalog')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten Halaman Katalog</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Pratinjau Visual Live
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Ubah teks header, kartu highlight, dan info agenda redaksi dengan visualisasi real-time.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Katalog Publik
            </a>
            <button type="submit" form="catalogSettingsForm" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
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

    <!-- Main Grid: Form Left (6 cols), Visual Preview Right (6 cols) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="xl:col-span-6 space-y-6">
            <form method="POST" action="{{ route('admin.settings.catalog.update') }}" class="space-y-6" id="catalogSettingsForm">
                @csrf
                @method('PUT')

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">1. Header &amp; Banner Katalog</h4>
                            <span class="text-xs text-slate-400">Judul utama dan deskripsi pengantar paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Badge Teks Atas <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="catalog_banner_badge" 
                                    id="in_catalog_badge"
                                    value="{{ old('catalog_banner_badge', $settings['catalog_banner_badge']) }}" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Utama Banner <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="catalog_banner_title" 
                                    id="in_catalog_title"
                                    value="{{ old('catalog_banner_title', $settings['catalog_banner_title']) }}" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="catalog_banner_desc" 
                                id="in_catalog_desc"
                                rows="3" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('catalog_banner_desc', $settings['catalog_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. 4 Highlight Cards -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. 4 Kartu Highlight Ringkas</h4>
                            <span class="text-xs text-slate-400">Poin keunggulan publikasi yang menimpa banner</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kartu 1 (Koleksi Judul)</label>
                            <input 
                                type="text" 
                                name="catalog_stat_books" 
                                id="in_stat_books"
                                value="{{ old('catalog_stat_books', $settings['catalog_stat_books']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kartu 2 (Karya Dosen)</label>
                            <input 
                                type="text" 
                                name="catalog_stat_authors" 
                                id="in_stat_authors"
                                value="{{ old('catalog_stat_authors', $settings['catalog_stat_authors']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kartu 3 (Legalitas ISBN)</label>
                            <input 
                                type="text" 
                                name="catalog_stat_isbn" 
                                id="in_stat_isbn"
                                value="{{ old('catalog_stat_isbn', $settings['catalog_stat_isbn']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kartu 4 (Standar Cetak)</label>
                            <input 
                                type="text" 
                                name="catalog_stat_print" 
                                id="in_stat_print"
                                value="{{ old('catalog_stat_print', $settings['catalog_stat_print']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Sidebar Info & Agenda Redaksi -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Info &amp; Agenda Redaksi (Sidebar)</h4>
                            <span class="text-xs text-slate-400">Pengumuman promo cetak dan agenda bedah buku</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <span class="text-xs font-bold text-[#006830] uppercase block">A. Program Khusus (Promo Cetak)</span>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1">Judul Program</label>
                                <input type="text" name="catalog_promo_title" id="in_promo_title" value="{{ old('catalog_promo_title', $settings['catalog_promo_title']) }}" required oninput="updateCatalogPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keterangan Ringkas</label>
                                <input type="text" name="catalog_promo_desc" id="in_promo_desc" value="{{ old('catalog_promo_desc', $settings['catalog_promo_desc']) }}" required oninput="updateCatalogPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                            </div>
                        </div>

                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <span class="text-xs font-bold text-amber-700 uppercase block">B. Agenda Akademik</span>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1">Judul Agenda</label>
                                <input type="text" name="catalog_agenda_title" id="in_agenda_title" value="{{ old('catalog_agenda_title', $settings['catalog_agenda_title']) }}" required oninput="updateCatalogPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-500 mb-1">Keterangan Ringkas</label>
                                <input type="text" name="catalog_agenda_desc" id="in_agenda_desc" value="{{ old('catalog_agenda_desc', $settings['catalog_agenda_desc']) }}" required oninput="updateCatalogPreview()" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Banner Pengajuan Naskah -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">4. Banner Pengajuan Naskah</h4>
                            <span class="text-xs text-slate-400">Ajakan konsultasi naskah bagi civitas akademika</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Banner <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_publish_box_title" 
                                id="in_publish_title"
                                value="{{ old('catalog_publish_box_title', $settings['catalog_publish_box_title']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="catalog_publish_box_desc" 
                                id="in_publish_desc"
                                rows="2" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                            >{{ old('catalog_publish_box_desc', $settings['catalog_publish_box_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Button Sticky Bottom -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs flex items-center justify-between gap-4">
                    <span class="text-xs text-slate-500 font-medium">Perubahan langsung aktif di website publik setelah disimpan.</span>
                    <button type="submit" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
                        <i class="fa-solid fa-floppy-disk text-base"></i>
                    </button>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: LARGE & SPACIOUS LIVE PREVIEW MOCKUP (STICKY TOP-20) -->
        <div class="xl:col-span-6 sticky top-20 self-start space-y-4">
            
            <!-- Window Mockup Frame Header (🔴 🟡 🟢) -->
            <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 shadow-lg flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    </div>
                    <span class="text-sm font-bold tracking-wide text-white">Pratinjau Visual Halaman Katalog</span>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-800 text-emerald-400 border border-slate-700">Real-time Mockup</span>
            </div>

            <!-- Visual Preview Canvas -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-md overflow-hidden text-slate-800 space-y-5 p-6">
                
                <!-- Preview 1: Header Banner -->
                <div class="bg-[#032c21] text-white p-6 rounded-2xl shadow-sm">
                    <span id="prev_badge" class="text-xs font-extrabold text-emerald-400 uppercase tracking-widest block mb-1.5">
                        {{ $settings['catalog_banner_badge'] }}
                    </span>
                    <h4 id="prev_title" class="font-extrabold text-lg sm:text-xl text-white leading-tight">
                        {{ $settings['catalog_banner_title'] }}
                    </h4>
                    <p id="prev_desc" class="text-xs text-slate-300 mt-2 leading-relaxed">
                        {{ $settings['catalog_banner_desc'] }}
                    </p>
                </div>

                <!-- Preview 2: 4 Highlight Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 text-center">
                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/80 shadow-2xs">
                        <i class="fa-solid fa-book-bookmark text-[#006830] text-sm mb-1 block"></i>
                        <span id="prev_stat_books" class="font-bold text-xs text-slate-900 block truncate">{{ $settings['catalog_stat_books'] }}</span>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/80 shadow-2xs">
                        <i class="fa-solid fa-graduation-cap text-[#006830] text-sm mb-1 block"></i>
                        <span id="prev_stat_authors" class="font-bold text-xs text-slate-900 block truncate">{{ $settings['catalog_stat_authors'] }}</span>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/80 shadow-2xs">
                        <i class="fa-solid fa-barcode text-[#006830] text-sm mb-1 block"></i>
                        <span id="prev_stat_isbn" class="font-bold text-xs text-slate-900 block truncate">{{ $settings['catalog_stat_isbn'] }}</span>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200/80 shadow-2xs">
                        <i class="fa-solid fa-print text-[#006830] text-sm mb-1 block"></i>
                        <span id="prev_stat_print" class="font-bold text-xs text-slate-900 block truncate">{{ $settings['catalog_stat_print'] }}</span>
                    </div>
                </div>

                <!-- Preview 3: Sidebar Info Redaksi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/80 space-y-1">
                        <span class="text-[10px] font-bold text-[#006830] uppercase block">Program Khusus</span>
                        <h6 id="prev_promo_title" class="font-bold text-xs text-slate-900">{{ $settings['catalog_promo_title'] }}</h6>
                        <p id="prev_promo_desc" class="text-[11px] text-slate-600">{{ $settings['catalog_promo_desc'] }}</p>
                    </div>

                    <div class="p-4 rounded-xl bg-amber-50/70 border border-amber-200/80 space-y-1">
                        <span class="text-[10px] font-bold text-amber-800 uppercase block">Agenda Akademik</span>
                        <h6 id="prev_agenda_title" class="font-bold text-slate-900 text-xs">{{ $settings['catalog_agenda_title'] }}</h6>
                        <p id="prev_agenda_desc" class="text-[11px] text-slate-600">{{ $settings['catalog_agenda_desc'] }}</p>
                    </div>
                </div>

                <!-- Preview 4: Banner Pengajuan Naskah -->
                <div class="p-4 rounded-xl bg-[#032c21] text-white border border-[#064e3b] space-y-1">
                    <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest block">Layanan Penerbitan</span>
                    <h6 id="prev_publish_title" class="font-bold text-xs text-white">{{ $settings['catalog_publish_box_title'] }}</h6>
                    <p id="prev_publish_desc" class="text-[11px] text-slate-300 leading-relaxed">{{ $settings['catalog_publish_box_desc'] }}</p>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript for Live Preview -->
    <script>
        function updateCatalogPreview() {
            // Banner
            const inBadge = document.getElementById('in_catalog_badge');
            const inTitle = document.getElementById('in_catalog_title');
            const inDesc = document.getElementById('in_catalog_desc');
            if (inBadge) document.getElementById('prev_badge').innerText = inBadge.value;
            if (inTitle) document.getElementById('prev_title').innerText = inTitle.value;
            if (inDesc) document.getElementById('prev_desc').innerText = inDesc.value;

            // Highlight Stats
            const inBooks = document.getElementById('in_stat_books');
            const inAuthors = document.getElementById('in_stat_authors');
            const inIsbn = document.getElementById('in_stat_isbn');
            const inPrint = document.getElementById('in_stat_print');
            if (inBooks) document.getElementById('prev_stat_books').innerText = inBooks.value;
            if (inAuthors) document.getElementById('prev_stat_authors').innerText = inAuthors.value;
            if (inIsbn) document.getElementById('prev_stat_isbn').innerText = inIsbn.value;
            if (inPrint) document.getElementById('prev_stat_print').innerText = inPrint.value;

            // Info & Agenda
            const inPromoTitle = document.getElementById('in_promo_title');
            const inPromoDesc = document.getElementById('in_promo_desc');
            const inAgendaTitle = document.getElementById('in_agenda_title');
            const inAgendaDesc = document.getElementById('in_agenda_desc');
            if (inPromoTitle) document.getElementById('prev_promo_title').innerText = inPromoTitle.value;
            if (inPromoDesc) document.getElementById('prev_promo_desc').innerText = inPromoDesc.value;
            if (inAgendaTitle) document.getElementById('prev_agenda_title').innerText = inAgendaTitle.value;
            if (inAgendaDesc) document.getElementById('prev_agenda_desc').innerText = inAgendaDesc.value;

            // Publish Banner
            const inPubTitle = document.getElementById('in_publish_title');
            const inPubDesc = document.getElementById('in_publish_desc');
            if (inPubTitle) document.getElementById('prev_publish_title').innerText = inPubTitle.value;
            if (inPubDesc) document.getElementById('prev_publish_desc').innerText = inPubDesc.value;
        }
    </script>
@endsection
