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
            <p class="text-sm text-slate-500 mt-1">Ubah teks banner header halaman berita dengan visualisasi real-time.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0 flex-wrap">
            <a href="{{ route('admin.articles.index') }}" class="px-3.5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-regular fa-newspaper text-emerald-700 text-xs"></i> Daftar Berita
            </a>
            <a href="{{ route('admin.articles.create') }}" class="px-3.5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-plus text-xs"></i> Tulis Berita Baru
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
                            <h4 class="text-base font-bold text-slate-900">Header &amp; Banner Berita</h4>
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

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="submit" class="px-6 py-3 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-md flex items-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        <span>Simpan Pengaturan Berita</span>
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
                        <span>Pratinjau Header Berita</span>
                    </span>
                    <span class="text-[10.5px] text-slate-400 font-mono">Real-time</span>
                </div>

                <!-- Mockup Canvas -->
                <div class="bg-brand-950 text-white p-6 rounded-sm space-y-2 border border-brand-900 shadow-md">
                    <span id="pv_badge" class="text-xs font-bold text-emerald-400 uppercase tracking-widest block">
                        {{ $settings['news_banner_badge'] }}
                    </span>
                    <h2 id="pv_title" class="text-xl sm:text-2xl font-black font-heading text-white leading-tight">
                        {{ $settings['news_banner_title'] }}
                    </h2>
                    <p id="pv_desc" class="text-xs text-slate-300 leading-relaxed">
                        {{ $settings['news_banner_desc'] }}
                    </p>
                </div>
            </div>
        </div>

    </div>

<script>
    function updateNewsPreview() {
        document.getElementById('pv_badge').innerText = document.getElementById('in_news_badge').value;
        document.getElementById('pv_title').innerText = document.getElementById('in_news_title').value;
        document.getElementById('pv_desc').innerText = document.getElementById('in_news_desc').value;
    }
</script>
@endsection
