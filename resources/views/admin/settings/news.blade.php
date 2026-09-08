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
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start pb-12">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="xl:col-span-6 space-y-6">
            <form method="POST" action="{{ route('admin.settings.news.update') }}" enctype="multipart/form-data" class="space-y-6" id="newsSettingsForm">
                @csrf
                @method('PUT')

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                        <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Header &amp; Banner Berita</h4>
                            <span class="text-[11px] text-slate-400">Judul utama dan deskripsi pengantar paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Badge Teks Atas <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="news_banner_badge" 
                                id="in_news_badge"
                                value="{{ old('news_banner_badge', $settings['news_banner_badge']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Utama Halaman <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="news_banner_title" 
                                id="in_news_title"
                                value="{{ old('news_banner_title', $settings['news_banner_title']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="news_banner_desc" 
                                id="in_news_desc"
                                rows="3" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('news_banner_desc', $settings['news_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. Widget Sidebar Wakaf Al-Qur'an & Buku -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-5 sm:p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-sm bg-emerald-50 text-emerald-800 flex items-center justify-center text-xs font-bold">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Widget Wakaf Al-Qur'an &amp; Buku</h4>
                                <span class="text-[11px] text-slate-400">Muncul di sidebar atas Berita Populer</span>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="wakaf_active" value="1" {{ ($settings['wakaf_active'] ?? '1') === '1' ? 'checked' : '' }} class="sr-only peer" />
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-hidden rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#006830]"></div>
                        </label>
                    </div>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Card Widget Wakaf <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="wakaf_card_title" 
                                id="in_wakaf_title"
                                value="{{ old('wakaf_card_title', $settings['wakaf_card_title']) }}" 
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nama Bank <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="wakaf_bank_name" 
                                    id="in_wakaf_bank"
                                    value="{{ old('wakaf_bank_name', $settings['wakaf_bank_name']) }}" 
                                    placeholder="Contoh: Bank Syariah Indonesia (BSI)"
                                    required 
                                    oninput="updateNewsPreview()"
                                    class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nomor Rekening Wakaf <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="wakaf_account_no" 
                                    id="in_wakaf_rek"
                                    value="{{ old('wakaf_account_no', $settings['wakaf_account_no']) }}" 
                                    placeholder="Contoh: 7148888999"
                                    required 
                                    oninput="updateNewsPreview()"
                                    class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono font-bold focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Atas Nama Rekening <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="wakaf_account_name" 
                                id="in_wakaf_an"
                                value="{{ old('wakaf_account_name', $settings['wakaf_account_name']) }}" 
                                placeholder="Contoh: PENERBIT PERSIS WAKAF"
                                required 
                                oninput="updateNewsPreview()"
                                class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">No. WhatsApp Konfirmasi</label>
                                <input 
                                    type="text" 
                                    name="wakaf_contact_wa" 
                                    id="in_wakaf_wa"
                                    value="{{ old('wakaf_contact_wa', $settings['wakaf_contact_wa']) }}" 
                                    placeholder="Contoh: 6281234567890"
                                    class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono"
                                />
                            </div>

                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Link URL Detail Artikel Wakaf</label>
                                <input 
                                    type="text" 
                                    name="wakaf_article_url" 
                                    id="in_wakaf_url"
                                    value="{{ old('wakaf_article_url', $settings['wakaf_article_url']) }}" 
                                    placeholder="/berita/program-wakaf-al-quran-dan-buku"
                                    class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono"
                                />
                            </div>
                        </div>

                        <!-- Upload QRIS Image (Opsional) -->
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="block font-bold text-slate-800">QRIS Barcode Wakaf (Opsional)</label>
                                <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs">PNG / JPG Max 3MB</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xs overflow-hidden border border-slate-300 bg-white shrink-0 flex items-center justify-center p-1">
                                    <img id="thumb_qris" src="{{ $settings['wakaf_qris_image'] ?: 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=WAKAF-PERSIS' }}" class="w-full h-full object-contain" />
                                </div>
                                <div class="flex-1 space-y-1">
                                    <input type="file" name="wakaf_qris_file" accept="image/*" onchange="previewQrisFile(this)" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10.5px] file:font-bold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer" />
                                    <input type="text" name="wakaf_qris_image" id="in_wakaf_qris_url" value="{{ $settings['wakaf_qris_image'] }}" placeholder="Atau paste URL gambar QRIS..." class="w-full px-2.5 py-1 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-md flex items-center gap-2 cursor-pointer hover:shadow-lg transform active:scale-98">
                        <i class="fa-solid fa-floppy-disk text-sm"></i>
                        <span>Simpan Pengaturan Berita &amp; Wakaf</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT COLUMN: LIVE VISUAL PREVIEWS -->
        <div class="xl:col-span-6 sticky top-20 space-y-5">
            
            <!-- 1. Header Preview -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-desktop text-emerald-700"></i>
                        <span>Pratinjau Header Banner</span>
                    </span>
                    <span class="text-[10px] text-slate-400 font-mono">Real-time</span>
                </div>

                <!-- Mockup Canvas -->
                <div class="bg-brand-950 bg-[#032c21] text-white p-5 rounded-sm space-y-1.5 border border-brand-900 shadow-xs">
                    <span id="pv_badge" class="text-[10.5px] font-bold text-emerald-400 uppercase tracking-widest block">
                        {{ $settings['news_banner_badge'] }}
                    </span>
                    <h2 id="pv_title" class="text-lg sm:text-xl font-black font-heading text-white leading-tight">
                        {{ $settings['news_banner_title'] }}
                    </h2>
                    <p id="pv_desc" class="text-xs text-slate-300 leading-relaxed">
                        {{ $settings['news_banner_desc'] }}
                    </p>
                </div>
            </div>

            <!-- 2. Sidebar Wakaf Card Live Preview -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-hand-holding-dollar text-[#006830]"></i>
                        <span>Pratinjau Widget Sidebar Wakaf</span>
                    </span>
                    <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs">Posisi: Di Atas Populer</span>
                </div>

                <!-- Exact Mockup of the Sidebar Card -->
                <div class="max-w-sm mx-auto bg-white rounded-sm border border-emerald-300/80 shadow-xs overflow-hidden">
                    <!-- Top Strip Accent -->
                    <div class="h-1 bg-[#006830]"></div>

                    <div class="p-4 space-y-3">
                        <div class="flex items-start gap-2.5">
                            <div class="w-7 h-7 rounded-xs bg-emerald-50 text-emerald-800 flex items-center justify-center text-xs shrink-0 border border-emerald-200 mt-0.5">
                                <i class="fa-solid fa-quran"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[9px] font-black uppercase tracking-widest text-[#006830] block">PROGRAM WAKAF</span>
                                <h4 id="pv_wakaf_title" class="text-xs font-black text-slate-900 leading-snug">
                                    {{ $settings['wakaf_card_title'] }}
                                </h4>
                            </div>
                        </div>

                        <!-- Bank & Account Box -->
                        <div class="p-3 bg-slate-50 rounded-xs border border-slate-200/90 space-y-2 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bank:</span>
                                <span id="pv_wakaf_bank" class="text-[11px] font-bold text-slate-800">{{ $settings['wakaf_bank_name'] }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-1 border-t border-slate-200/60">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Rek Wakaf:</span>
                                <span id="pv_wakaf_rek" class="text-xs font-black font-mono text-emerald-950 bg-emerald-100/70 px-1.5 py-0.5 rounded-xs">{{ $settings['wakaf_account_no'] }}</span>
                            </div>

                            <div class="flex items-center justify-between pt-1 border-t border-slate-200/60">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">An:</span>
                                <span id="pv_wakaf_an" class="text-[11px] font-bold text-slate-700 truncate max-w-[150px]">{{ $settings['wakaf_account_name'] }}</span>
                            </div>
                        </div>

                        <!-- QRIS & CTA Button -->
                        <div class="pt-1 flex items-center gap-2">
                            <div class="flex-1">
                                <button type="button" class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[10.5px] font-bold uppercase tracking-wider transition flex items-center justify-center gap-1.5 shadow-2xs">
                                    <span>Pelajari &amp; Salurkan</span>
                                    <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                </button>
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

        document.getElementById('pv_wakaf_title').innerText = document.getElementById('in_wakaf_title').value;
        document.getElementById('pv_wakaf_bank').innerText = document.getElementById('in_wakaf_bank').value;
        document.getElementById('pv_wakaf_rek').innerText = document.getElementById('in_wakaf_rek').value;
        document.getElementById('pv_wakaf_an').innerText = document.getElementById('in_wakaf_an').value;
    }

    function previewQrisFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumb_qris').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

