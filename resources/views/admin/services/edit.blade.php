@extends('admin.layouts.app')

@section('title', 'Edit Layanan: ' . $service->title)

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1.5 mb-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Layanan
            </a>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">
                Edit Layanan: {{ $service->title }}
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Perbarui konten, tahapan alur kerja, dan FAQ layanan. Pratinjau di sebelah kanan akan ter-update secara real-time.
            </p>
        </div>
        <div class="flex items-center gap-2.5 self-start sm:self-auto">
            <a href="{{ route('layanan.show', $service->slug) }}" target="_blank" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-sm transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span>Lihat di Web</span>
            </a>
            <button type="submit" form="serviceForm" class="px-5 py-2 bg-[#006830] hover:bg-[#024a23] text-white text-xs font-bold rounded-sm shadow-sm transition flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>

    <!-- Main Form & Live Visualizer Grid -->
    <form id="serviceForm" action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- LEFT COLUMN: Form Editor (col-span-7) -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- 1. INFORMASI UTAMA & KARTU BERANDA -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-address-card text-emerald-600"></i>
                    <span>1. Informasi Utama &amp; Kartu Beranda</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="inputTitle" value="{{ old('title', $service->title) }}" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-medium" oninput="updateLivePreview()" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">URL Slug</label>
                        <input type="text" name="slug" id="inputSlug" value="{{ old('slug', $service->slug) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono text-slate-600" oninput="updateLivePreview()" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Icon FontAwesome <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <div id="iconPreview" class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0 border border-emerald-200">
                                <i class="{{ $service->icon ?: 'fa-solid fa-barcode' }}"></i>
                            </div>
                            <input type="text" name="icon" id="inputIcon" value="{{ old('icon', $service->icon) }}" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono" oninput="updateLivePreview()" />
                        </div>
                    </div>
                </div>

                <!-- Quick Icon Selectors -->
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Pilihan Cepat Icon:</label>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" onclick="selectIcon('fa-solid fa-book-open')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-book-open"></i> book-open</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-graduation-cap')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-graduation-cap"></i> graduation</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-barcode')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-barcode"></i> barcode</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-pen-nib')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-pen-nib"></i> pen-nib</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-certificate')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-certificate"></i> certificate</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-copy')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-copy"></i> copy</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-newspaper')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-newspaper"></i> newspaper</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-box-open')" class="px-2.5 py-1 text-[11px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer flex items-center gap-1.5"><i class="fa-solid fa-box-open"></i> box-open</button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Ringkas (Tampil pada Kartu Beranda &amp; Navbar) <span class="text-red-500">*</span></label>
                    <textarea name="short_desc" id="inputShortDesc" rows="2" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" oninput="updateLivePreview()">{{ old('short_desc', $service->short_desc) }}</textarea>
                </div>
            </div>

            <!-- 2. HERO BANNER HALAMAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-image text-emerald-600"></i>
                    <span>2. Hero Banner Halaman</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Slogan / Tagline Layanan</label>
                    <input type="text" name="tagline" id="inputTagline" value="{{ old('tagline', $service->tagline) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" oninput="updateLivePreview()" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol Aksi (CTA)</label>
                        <input type="text" name="cta_text" id="inputCtaText" value="{{ old('cta_text', $service->cta_text) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300" oninput="updateLivePreview()" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Layanan</label>
                        <select name="status" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 bg-white font-medium">
                            <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Tayang (Published)</option>
                            <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Draf (Disembunyikan)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- 3. PENJELASAN LENGKAP & CAKUPAN LAYANAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-paragraph text-emerald-600"></i>
                    <span>3. Penjelasan Lengkap &amp; Cakupan Layanan</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Pengantar Layanan</label>
                    <textarea name="overview" id="inputOverview" rows="4" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" oninput="updateLivePreview()">{{ old('overview', $service->overview) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Cakupan Layanan / Fasilitas yang Disediakan <span class="text-[10px] text-slate-400 font-normal">(1 baris = 1 poin fasilitas)</span>
                    </label>
                    @php
                        $featuresText = is_array($service->features) ? implode("
", $service->features) : ($service->features ?: '');
                    @endphp
                    <textarea name="features" id="inputFeatures" rows="5" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono" oninput="updateLivePreview()">{{ old('features', $featuresText) }}</textarea>
                </div>
            </div>

            <!-- 4. ALUR & TAHAPAN PELAKSANAAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2">
                        <i class="fa-solid fa-arrows-spin text-emerald-600"></i>
                        <span>4. Alur &amp; Tahapan Pelaksanaan</span>
                    </h3>
                    <button type="button" onclick="addWorkflowStep()" class="px-2.5 py-1 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-xs text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                        <i class="fa-solid fa-plus text-[10px]"></i> Tambah Langkah
                    </button>
                </div>

                <div id="workflowContainer" class="space-y-3">
                    @php
                        $steps = is_array($service->workflow_steps) ? $service->workflow_steps : [];
                    @endphp

                    @forelse($steps as $idx => $step)
                        <div class="workflow-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 relative">
                            @if(!$loop->first)
                                <button type="button" onclick="this.closest('.workflow-item').remove(); updateLivePreview();" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                            @endif
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                                <div class="sm:col-span-4">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah {{ $step['step'] ?? ($idx + 1) }}</label>
                                    <input type="text" name="step_titles[]" value="{{ $step['title'] ?? '' }}" class="step-title-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                                </div>
                                <div class="sm:col-span-8">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                                    <input type="text" name="step_descs[]" value="{{ $step['desc'] ?? '' }}" class="step-desc-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="workflow-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 relative">
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                                <div class="sm:col-span-4">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah 1</label>
                                    <input type="text" name="step_titles[]" placeholder="Contoh: Pengajuan Naskah" class="step-title-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                                </div>
                                <div class="sm:col-span-8">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                                    <input type="text" name="step_descs[]" placeholder="Penjelasan..." class="step-desc-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- 5. KEUNTUNGAN LAYANAN & CATATAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-award text-emerald-600"></i>
                    <span>5. Keuntungan Layanan &amp; Catatan Penting</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Keuntungan / Keunggulan Layanan</label>
                    <textarea name="benefits" id="inputBenefits" rows="3" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" oninput="updateLivePreview()">{{ old('benefits', $service->benefits) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Penting / Disclaimer</label>
                    <textarea name="notes" id="inputNotes" rows="2" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" oninput="updateLivePreview()">{{ old('notes', $service->notes) }}</textarea>
                </div>
            </div>

            <!-- 6. TANYA JAWAB (FAQ) -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-emerald-600"></i>
                        <span>6. Tanya Jawab (FAQ Layanan)</span>
                    </h3>
                    <button type="button" onclick="addFaqItem()" class="px-2.5 py-1 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-xs text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                        <i class="fa-solid fa-plus text-[10px]"></i> Tambah FAQ
                    </button>
                </div>

                <div id="faqContainer" class="space-y-3">
                    @php
                        $faqs = is_array($service->faqs) ? $service->faqs : [];
                    @endphp

                    @forelse($faqs as $faq)
                        <div class="faq-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 space-y-2 relative">
                            <button type="button" onclick="this.closest('.faq-item').remove(); updateLivePreview();" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan</label>
                                <input type="text" name="faq_questions[]" value="{{ $faq['q'] ?? '' }}" class="faq-q-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                                <textarea name="faq_answers[]" rows="2" class="faq-a-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()">{{ $faq['a'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="faq-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 space-y-2 relative">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan 1</label>
                                <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="faq-q-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                                <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="faq-a-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()"></textarea>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: EXACT REPLICA OF HOME PREVIEW SIMULATOR (col-span-5) -->
        <div class="lg:col-span-5 space-y-4 sticky top-20">
            
            <!-- Mockup Window Header -->
            <div class="bg-slate-900 rounded-t-sm px-4 py-3 border border-slate-800 shadow-lg flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1.5 shrink-0">
                        <span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-400 inline-block"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span>
                    </div>
                    <span class="text-xs font-bold tracking-wide text-white flex items-center gap-2">
                        <span>Pratinjau Halaman</span>
                        <span class="text-[10px] text-slate-400 font-mono font-normal">penerbitpersis.com</span>
                    </span>
                </div>

                <!-- Tabs Switcher -->
                <div class="flex items-center gap-1 bg-slate-800 p-0.5 rounded-sm border border-slate-700 shrink-0">
                    <button type="button" onclick="switchPreviewTab('detail')" id="tabBtnDetail" class="px-2.5 py-1 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition cursor-pointer">Halaman Detail</button>
                    <button type="button" onclick="switchPreviewTab('card')" id="tabBtnCard" class="px-2.5 py-1 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition cursor-pointer">Kartu Beranda</button>
                </div>
            </div>

            <!-- Visual Preview Canvas (Exact Page Representation) -->
            <div class="bg-slate-100 rounded-b-sm border border-slate-200/90 shadow-md overflow-hidden text-slate-800 space-y-3.5 p-3 sm:p-4 max-h-[82vh] overflow-y-auto">
                
                <!-- TAB 1: FULL DETAIL PAGE MOCKUP -->
                <div id="previewDetailTab" class="space-y-3.5">
                    
                    <!-- 1. Hero Banner Mockup -->
                    <div class="relative bg-brand-950 bg-[#032c21] rounded-sm overflow-hidden border border-slate-800 text-white min-h-[220px] p-4 sm:p-5 flex flex-col justify-between shadow-inner">
                        <div class="relative z-10 space-y-2">
                            <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest block">
                                <i id="mockHeroIcon" class="{{ $service->icon ?: 'fa-solid fa-barcode' }} text-lime-300 mr-1"></i> LAYANAN RESMI PENERBIT PERSIS
                            </span>
                            <h4 id="mockHeroTitle" class="text-base sm:text-lg font-extrabold text-white leading-tight">
                                {{ $service->title ?: 'Judul Layanan' }}
                            </h4>
                            <p id="mockHeroTagline" class="text-[11px] text-emerald-200 italic font-medium">
                                {{ $service->tagline ?: '“Satu Karya, Satu Identitas, Siap Diterbitkan.”' }}
                            </p>
                            <p id="mockHeroDesc" class="text-[10.5px] text-slate-300 leading-relaxed line-clamp-3">
                                {{ $service->short_desc ?: 'Deskripsi ringkas layanan...' }}
                            </p>
                            <div class="flex items-center gap-2 pt-2">
                                <span id="mockHeroCta" class="px-3 py-1.5 bg-[#006830] text-white font-bold text-[9.5px] rounded-xs uppercase tracking-wider flex items-center gap-1 shadow-xs border border-emerald-600">
                                    <i class="fa-brands fa-whatsapp text-lime-300 text-xs"></i>
                                    <span>{{ $service->cta_text ?: 'Konsultasi Sekarang' }}</span>
                                </span>
                                <span class="px-3 py-1.5 bg-white/10 text-white font-semibold text-[9.5px] rounded-xs border border-white/20 uppercase tracking-wider">
                                    Kirim Draf
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 2. 4 Overlapping Stats Mockup -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs p-2.5 text-slate-800">
                        <div class="grid grid-cols-4 gap-1.5 divide-x divide-slate-100 text-center">
                            <div class="p-1">
                                <span class="block text-xs font-black text-emerald-700">100%</span>
                                <span class="text-[8px] text-slate-500 font-semibold uppercase block">ISBN Resmi</span>
                            </div>
                            <div class="p-1">
                                <span class="block text-xs font-black text-slate-900">Standar</span>
                                <span class="text-[8px] text-slate-500 font-semibold uppercase block">KUM</span>
                            </div>
                            <div class="p-1">
                                <span class="block text-xs font-black text-emerald-700">Terarah</span>
                                <span class="text-[8px] text-slate-500 font-semibold uppercase block">Redaksi</span>
                            </div>
                            <div class="p-1">
                                <span class="block text-xs font-black text-slate-900">Nasional</span>
                                <span class="text-[8px] text-slate-500 font-semibold uppercase block">Distribusi</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Overview Mockup -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs space-y-1">
                        <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block">MENGENAL LAYANAN</span>
                        <p id="mockOverview" class="text-[10.5px] text-slate-600 leading-relaxed line-clamp-3">
                            {{ $service->overview ?: 'Jelaskan secara mendalam tentang layanan ini pada form di sebelah kiri...' }}
                        </p>
                    </div>

                    <!-- 4. Features Grid Mockup -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs space-y-2">
                        <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block">CAKUPAN FASILITAS</span>
                        <div id="mockFeaturesContainer" class="grid grid-cols-2 gap-1.5">
                            <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                                <i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> <span class="truncate">Poin Fasilitas 1</span>
                            </div>
                            <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                                <i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> <span class="truncate">Poin Fasilitas 2</span>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Workflow Steps Mockup -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs space-y-2">
                        <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block">ALUR &amp; TAHAPAN KERJA</span>
                        <div id="mockStepsContainer" class="space-y-1.5">
                            <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10.5px] flex items-center gap-2">
                                <span class="w-5 h-5 rounded-xs bg-[#006830] text-white text-[9px] font-bold flex items-center justify-center shrink-0">1</span>
                                <span class="font-bold text-slate-800 truncate">Tahap 1: Pengajuan Naskah</span>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Benefits Matrix Mockup -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs space-y-2">
                        <span class="text-brand-800 font-bold text-[8.5px] uppercase tracking-widest block">KEUNGGULAN LEMBAGA</span>
                        <div id="mockBenefitsContainer" class="grid grid-cols-2 gap-1.5">
                            <div class="p-1.5 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-[9px]"></i> <span class="truncate">Keunggulan 1</span>
                            </div>
                            <div class="p-1.5 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-[9px]"></i> <span class="truncate">Keunggulan 2</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- TAB 2: HOMEPAGE CARD MOCKUP -->
                <div id="previewCardTab" class="hidden space-y-3">
                    <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm text-slate-900">
                        <div id="mockCardIconBox" class="w-11 h-11 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-xl mb-3 shadow-2xs">
                            <i id="mockCardIcon" class="{{ $service->icon ?: 'fa-solid fa-barcode' }}"></i>
                        </div>
                        <h4 id="mockCardTitle" class="font-extrabold text-sm text-slate-900 mb-1.5 leading-snug">
                            {{ $service->title ?: 'Judul Layanan' }}
                        </h4>
                        <p id="mockCardDesc" class="text-xs text-slate-500 leading-relaxed mb-4">
                            {{ $service->short_desc ?: 'Deskripsi ringkas layanan akan muncul di kartu beranda pengunjung...' }}
                        </p>
                        <div class="text-xs font-bold text-[#006830] inline-flex items-center gap-1 pt-2.5 border-t border-slate-100 w-full">
                            <span>Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </form>
</div>

<script>
    function switchPreviewTab(tab) {
        const detailTab = document.getElementById('previewDetailTab');
        const cardTab = document.getElementById('previewCardTab');
        const btnDetail = document.getElementById('tabBtnDetail');
        const btnCard = document.getElementById('tabBtnCard');

        if (tab === 'detail') {
            detailTab.classList.remove('hidden');
            cardTab.classList.add('hidden');
            btnDetail.className = 'px-2.5 py-1 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition cursor-pointer';
            btnCard.className = 'px-2.5 py-1 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition cursor-pointer';
        } else {
            detailTab.classList.add('hidden');
            cardTab.classList.remove('hidden');
            btnCard.className = 'px-2.5 py-1 text-[10px] font-bold rounded-xs bg-emerald-600 text-white transition cursor-pointer';
            btnDetail.className = 'px-2.5 py-1 text-[10px] font-bold rounded-xs text-slate-300 hover:text-white transition cursor-pointer';
        }
    }

    function selectIcon(iconClass) {
        const inputIcon = document.getElementById('inputIcon');
        if (inputIcon) {
            inputIcon.value = iconClass;
            updateLivePreview();
        }
    }

    function updateLivePreview() {
        const title = document.getElementById('inputTitle')?.value.trim() || 'Judul Layanan';
        const icon = document.getElementById('inputIcon')?.value.trim() || 'fa-solid fa-barcode';
        const tagline = document.getElementById('inputTagline')?.value.trim() || '“Satu Karya, Satu Identitas, Siap Diterbitkan.”';
        const shortDesc = document.getElementById('inputShortDesc')?.value.trim() || 'Deskripsi ringkas layanan...';
        const overview = document.getElementById('inputOverview')?.value.trim() || 'Jelaskan secara mendalam tentang layanan ini pada form di sebelah kiri...';
        const ctaText = document.getElementById('inputCtaText')?.value.trim() || 'Konsultasi Sekarang';
        const benefits = document.getElementById('inputBenefits')?.value.trim() || 'Mudah • Terarah • Profesional • Terintegrasi';

        // Hero
        document.getElementById('mockHeroTitle').innerText = title;
        document.getElementById('mockHeroTagline').innerText = tagline;
        document.getElementById('mockHeroDesc').innerText = shortDesc;
        document.getElementById('mockHeroIcon').className = icon + ' text-lime-300 mr-1';
        document.getElementById('mockHeroCta').innerHTML = '<i class="fa-brands fa-whatsapp text-lime-300 text-xs"></i> <span>' + ctaText + '</span>';

        // Card Tab
        document.getElementById('mockCardTitle').innerText = title;
        document.getElementById('mockCardDesc').innerText = shortDesc;
        document.getElementById('mockCardIcon').className = icon;
        document.getElementById('iconPreview').innerHTML = '<i class="' + icon + '"></i>';

        // Overview
        document.getElementById('mockOverview').innerText = overview;

        // Benefits Grid Preview
        const benText = document.getElementById('inputBenefits')?.value || '';
        const benLines = benText.split('\n').map(l => l.replace(/^[•\-\*\–]\s*/, '').trim()).filter(l => l.length > 0 && !l.endsWith(':'));
        const benContainer = document.getElementById('mockBenefitsContainer');
        if (benContainer) {
            if (benLines.length > 0) {
                benContainer.innerHTML = benLines.slice(0, 4).map(l => `
                    <div class="p-1.5 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-[9px]"></i> <span class="truncate">${l}</span>
                    </div>
                `).join('');
            } else {
                benContainer.innerHTML = `
                    <div class="p-1.5 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-[9px]"></i> <span class="truncate">Keunggulan 1</span>
                    </div>
                    <div class="p-1.5 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-[9px]"></i> <span class="truncate">Keunggulan 2</span>
                    </div>
                `;
            }
        }

        // Features Preview
        const featText = document.getElementById('inputFeatures')?.value || '';
        const featLines = featText.split('\n').map(l => l.replace(/^[•\-\*]\s*/, '').trim()).filter(l => l.length > 0);
        const featContainer = document.getElementById('mockFeaturesContainer');
        if (featLines.length > 0) {
            featContainer.innerHTML = featLines.map(l => `
                <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> <span class="truncate">${l}</span>
                </div>
            `).join('');
        } else {
            featContainer.innerHTML = `
                <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> <span class="truncate">Poin Fasilitas 1</span>
                </div>
                <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10px] font-semibold text-slate-700 flex items-center gap-1.5">
                    <i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> <span class="truncate">Poin Fasilitas 2</span>
                </div>
            `;
        }

        // Steps Preview
        const stepTitles = Array.from(document.querySelectorAll('.step-title-input')).map(i => i.value.trim()).filter(v => v.length > 0);
        const stepContainer = document.getElementById('mockStepsContainer');
        if (stepTitles.length > 0) {
            stepContainer.innerHTML = stepTitles.map((st, idx) => `
                <div class="p-2 rounded-xs bg-slate-50 border border-slate-200 text-[10.5px] flex items-center gap-2">
                    <span class="w-5 h-5 rounded-xs bg-[#006830] text-white text-[9px] font-bold flex items-center justify-center shrink-0">${idx + 1}</span>
                    <span class="font-bold text-slate-800 truncate">${st}</span>
                </div>
            `).join('');
        }
    }

    let stepCount = {{ count($steps) > 0 ? count($steps) : 1 }};
    function addWorkflowStep() {
        stepCount++;
        const container = document.getElementById('workflowContainer');
        const html = `
            <div class="workflow-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 relative">
                <button type="button" onclick="this.closest('.workflow-item').remove(); updateLivePreview();" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                    <div class="sm:col-span-4">
                        <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah ${stepCount}</label>
                        <input type="text" name="step_titles[]" placeholder="Contoh: Review Naskah" class="step-title-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                    </div>
                    <div class="sm:col-span-8">
                        <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                        <input type="text" name="step_descs[]" placeholder="Penjelasan proses..." class="step-desc-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        updateLivePreview();
    }

    let faqCount = {{ count($faqs) > 0 ? count($faqs) : 1 }};
    function addFaqItem() {
        faqCount++;
        const container = document.getElementById('faqContainer');
        const html = `
            <div class="faq-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 space-y-2 relative">
                <button type="button" onclick="this.closest('.faq-item').remove(); updateLivePreview();" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan ${faqCount}</label>
                    <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="faq-q-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                    <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="faq-a-input w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" oninput="updateLivePreview()"></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        updateLivePreview();
    }

    document.addEventListener('DOMContentLoaded', updateLivePreview);
</script>
@endsection
