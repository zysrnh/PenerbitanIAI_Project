@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Berita')
@section('header_title', 'Kelola Konten & Pratinjau Halaman Berita')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten Halaman Berita</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xs text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                    <span class="w-2 h-2 rounded-xs bg-emerald-500 animate-pulse"></span> Pratinjau Visual Live
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Ubah teks header, kartu quick stats, dan info promo sidebar berita dengan visualisasi real-time.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('berita.index') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Halaman Berita
            </a>
            <button type="submit" form="newsSettingsForm" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm transition shadow-xs hover:shadow-md flex items-center justify-center cursor-pointer">
                <i class="fa-solid fa-floppy-disk text-base mr-1.5"></i>
                <span class="text-xs font-bold uppercase">Simpan</span>
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
            <form method="POST" action="{{ route('admin.settings.news.update') }}" class="space-y-6" id="newsSettingsForm">
                @csrf
                @method('PUT')

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">1. Header &amp; Banner Berita</h4>
                            <span class="text-xs text-slate-400">Judul utama dan deskripsi pengantar paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Badge Teks Atas <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="news_banner_badge" 
                                id="in_news_badge"
                                value="{{ old('news_banner_badge', $settings['news_banner_badge']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Utama Halaman <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="news_banner_title" 
                                id="in_news_title"
                                value="{{ old('news_banner_title', $settings['news_banner_title']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="news_banner_desc" 
                                id="in_news_desc"
                                rows="3" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('news_banner_desc', $settings['news_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. Quick Stats Overlap (4 Cards) -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. Bar Statistik (4 Kartu Overlap)</h4>
                            <span class="text-xs text-slate-400">Teks keterangan pada 4 kartu info yang menimpa banner</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-3 bg-slate-50 rounded-sm border border-slate-200">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kartu 1: Info Total Artikel</label>
                            <input 
                                type="text" 
                                name="news_stat_total" 
                                id="in_stat_total"
                                value="{{ old('news_stat_total', $settings['news_stat_total']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white"
                            />
                        </div>

                        <div class="p-3 bg-slate-50 rounded-sm border border-slate-200">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kartu 2: Info Kategori</label>
                            <input 
                                type="text" 
                                name="news_stat_categories" 
                                id="in_stat_cat"
                                value="{{ old('news_stat_categories', $settings['news_stat_categories']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white"
                            />
                        </div>

                        <div class="p-3 bg-slate-50 rounded-sm border border-slate-200">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kartu 3: Info Pembaca</label>
                            <input 
                                type="text" 
                                name="news_stat_views" 
                                id="in_stat_views"
                                value="{{ old('news_stat_views', $settings['news_stat_views']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white"
                            />
                        </div>

                        <div class="p-3 bg-slate-50 rounded-sm border border-slate-200">
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kartu 4: Info Penulis</label>
                            <input 
                                type="text" 
                                name="news_stat_authors" 
                                id="in_stat_authors"
                                value="{{ old('news_stat_authors', $settings['news_stat_authors']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Sidebar Promo Box -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Box Ajakan Redaksi di Sidebar</h4>
                            <span class="text-xs text-slate-400">Pesan ajakan konsultasi naskah di sisi kanan halaman berita</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Ajakan <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="news_promo_title" 
                                id="in_promo_title"
                                value="{{ old('news_promo_title', $settings['news_promo_title']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Ajakan <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="news_promo_desc" 
                                id="in_promo_desc"
                                rows="2" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('news_promo_desc', $settings['news_promo_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="submit" class="px-6 py-3 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-md flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        <span>Simpan Semua Pengaturan Berita</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT COLUMN: LIVE VISUAL PREVIEW -->
        <div class="xl:col-span-6 sticky top-20 space-y-4">
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-sm p-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-desktop text-emerald-700"></i>
                        <span>Pratinjau Halaman Berita</span>
                    </span>
                    <span class="text-[10.5px] text-slate-400 font-mono">100% Sesuai Desain Publik</span>
                </div>

                <!-- Mockup Canvas -->
                <div class="bg-slate-100 rounded-sm border border-slate-200 overflow-hidden text-xs">
                    
                    <!-- 1. Header Banner Mockup -->
                    <div class="bg-brand-950 text-white p-5 space-y-1.5 border-b border-brand-900">
                        <span id="pv_badge" class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">
                            {{ $settings['news_banner_badge'] }}
                        </span>
                        <h2 id="pv_title" class="text-base sm:text-lg font-black font-heading text-white leading-tight">
                            {{ $settings['news_banner_title'] }}
                        </h2>
                        <p id="pv_desc" class="text-[11px] text-slate-300 leading-relaxed line-clamp-2">
                            {{ $settings['news_banner_desc'] }}
                        </p>
                    </div>

                    <!-- 2. Overlap Stats Mockup -->
                    <div class="px-4 -mt-3 relative z-10 grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <div class="bg-white p-2.5 rounded-xs border border-slate-200 shadow-2xs">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">Total</span>
                            <span id="pv_stat_total" class="text-[11px] font-extrabold text-slate-900 truncate block">{{ $settings['news_stat_total'] }}</span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xs border border-slate-200 shadow-2xs">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">Kategori</span>
                            <span id="pv_stat_cat" class="text-[11px] font-extrabold text-slate-900 truncate block">{{ $settings['news_stat_categories'] }}</span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xs border border-slate-200 shadow-2xs">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">Views</span>
                            <span id="pv_stat_views" class="text-[11px] font-extrabold text-slate-900 truncate block">{{ $settings['news_stat_views'] }}</span>
                        </div>
                        <div class="bg-white p-2.5 rounded-xs border border-slate-200 shadow-2xs">
                            <span class="text-[9px] font-bold text-slate-400 uppercase block">Penulis</span>
                            <span id="pv_stat_authors" class="text-[11px] font-extrabold text-slate-900 truncate block">{{ $settings['news_stat_authors'] }}</span>
                        </div>
                    </div>

                    <!-- 3. Body Content Mockup -->
                    <div class="p-4 grid grid-cols-12 gap-3 items-start">
                        
                        <!-- Left Sidebar in Mockup -->
                        <div class="col-span-4 space-y-2">
                            <div class="bg-white p-2 rounded-xs border border-slate-200 text-[10px] text-slate-400 flex items-center gap-1.5">
                                <i class="fa-solid fa-magnifying-glass text-[9px]"></i> Cari berita...
                            </div>
                            <div class="bg-white rounded-xs border border-slate-200 overflow-hidden">
                                <div class="bg-brand-950 text-white px-2 py-1 text-[9.5px] font-bold uppercase tracking-wider">Kategori</div>
                                <div class="p-1.5 space-y-1 text-[10px] text-slate-600">
                                    <div class="font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded-xs">Semua Topik</div>
                                    <div class="px-1.5 py-0.5">Kabar Penerbitan</div>
                                    <div class="px-1.5 py-0.5">Tips Penulis</div>
                                </div>
                            </div>
                            <div class="bg-brand-950 text-white p-2.5 rounded-xs space-y-1 text-center">
                                <span id="pv_promo_title" class="font-bold text-[10.5px] block leading-tight">{{ $settings['news_promo_title'] }}</span>
                                <span id="pv_promo_desc" class="text-[9px] text-slate-300 block line-clamp-2">{{ $settings['news_promo_desc'] }}</span>
                            </div>
                        </div>

                        <!-- Right Articles in Mockup -->
                        <div class="col-span-8 grid grid-cols-2 gap-2">
                            <div class="bg-white rounded-xs border border-slate-200 overflow-hidden shadow-2xs">
                                <div class="aspect-video bg-slate-200"></div>
                                <div class="p-2 space-y-1">
                                    <span class="text-[8.5px] text-slate-400">03 Sep 2026</span>
                                    <h5 class="font-bold text-[10.5px] text-slate-900 leading-snug line-clamp-2">Penerbitan Buku Ber-ISBN Resmi di PERSIS</h5>
                                </div>
                            </div>
                            <div class="bg-white rounded-xs border border-slate-200 overflow-hidden shadow-2xs">
                                <div class="aspect-video bg-slate-200"></div>
                                <div class="p-2 space-y-1">
                                    <span class="text-[8.5px] text-slate-400">01 Sep 2026</span>
                                    <h5 class="font-bold text-[10.5px] text-slate-900 leading-snug line-clamp-2">5 Tips Menulis Naskah Buku Islam Berbobot</h5>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

<script>
    function updateNewsPreview() {
        document.getElementById('pv_badge').innerText = document.getElementById('in_news_badge').value;
        document.getElementById('pv_title').innerText = document.getElementById('in_news_title').value;
        document.getElementById('pv_desc').innerText = document.getElementById('in_news_desc').value;

        document.getElementById('pv_stat_total').innerText = document.getElementById('in_stat_total').value;
        document.getElementById('pv_stat_cat').innerText = document.getElementById('in_stat_cat').value;
        document.getElementById('pv_stat_views').innerText = document.getElementById('in_stat_views').value;
        document.getElementById('pv_stat_authors').innerText = document.getElementById('in_stat_authors').value;

        document.getElementById('pv_promo_title').innerText = document.getElementById('in_promo_title').value;
        document.getElementById('pv_promo_desc').innerText = document.getElementById('in_promo_desc').value;
    }
</script>
@endsection
