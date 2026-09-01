@extends('admin.layouts.app')

@section('title', 'Edit Layanan: ' . $service->title)

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
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
                Perbarui konten, tahapan alur kerja, dan FAQ layanan.
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

    <!-- Main Form Grid -->
    <form id="serviceForm" action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        @csrf
        @method('PUT')

        <!-- LEFT COLUMN: Content Builder (col-span-8) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- 1. INFORMASI UTAMA & KARTU BERANDA -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-address-card text-emerald-600"></i>
                    <span>1. Informasi Utama &amp; Kartu Beranda</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="inputTitle" value="{{ old('title', $service->title) }}" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 font-medium" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">URL Slug</label>
                        <input type="text" name="slug" id="inputSlug" value="{{ old('slug', $service->slug) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono text-slate-600" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Icon FontAwesome <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <div id="iconPreview" class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0 border border-emerald-200">
                                <i class="{{ $service->icon ?: 'fa-solid fa-book-open' }}"></i>
                            </div>
                            <input type="text" name="icon" id="inputIcon" value="{{ old('icon', $service->icon) }}" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono" />
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
                    <textarea name="short_desc" id="inputShortDesc" rows="2" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600">{{ old('short_desc', $service->short_desc) }}</textarea>
                </div>
            </div>

            <!-- 2. HERO BANNER HALAMAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-image text-emerald-600"></i>
                    <span>2. Hero Banner Halaman</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Slogan / Tagline Layanan</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $service->tagline) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Gambar Banner Hero (Opsional)</label>
                    @if($service->banner_image)
                        <div class="mb-2">
                            <img src="{{ $service->banner_image }}" alt="Current Banner" class="h-20 w-auto rounded-xs object-cover border border-slate-200" />
                        </div>
                    @endif
                    <input type="file" name="banner_image" accept="image/*" class="w-full text-xs p-2 border border-slate-300 rounded-sm file:mr-3 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100" />
                </div>
            </div>

            <!-- 3. PENJELASAN LENGKAP & CAKUPAN LAYANAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-paragraph text-emerald-600"></i>
                    <span>3. Penjelasan Lengkap &amp; Cakupan Layanan</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Pengantar Layanan</label>
                    <textarea name="overview" rows="5" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-sans leading-relaxed">{{ old('overview', $service->overview) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">
                        Cakupan Layanan / Fasilitas yang Disediakan <span class="text-[10px] text-slate-400 font-normal">(1 baris = 1 poin layanan)</span>
                    </label>
                    @php
                        $featuresText = is_array($service->features) ? implode("
", $service->features) : ($service->features ?: '');
                    @endphp
                    <textarea name="features" rows="6" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-mono">{{ old('features', $featuresText) }}</textarea>
                </div>
            </div>

            <!-- 4. ALUR & TAHAPAN PELAKSANAAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
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
                                <button type="button" onclick="this.closest('.workflow-item').remove()" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                            @endif
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                                <div class="sm:col-span-4">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah {{ $step['step'] ?? ($idx + 1) }}</label>
                                    <input type="text" name="step_titles[]" value="{{ $step['title'] ?? '' }}" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                                </div>
                                <div class="sm:col-span-8">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                                    <input type="text" name="step_descs[]" value="{{ $step['desc'] ?? '' }}" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="workflow-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 relative">
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                                <div class="sm:col-span-4">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah 1</label>
                                    <input type="text" name="step_titles[]" placeholder="Contoh: Pengajuan Naskah" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                                </div>
                                <div class="sm:col-span-8">
                                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                                    <input type="text" name="step_descs[]" placeholder="Penjelasan..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- 5. KEUNTUNGAN LAYANAN & CATATAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2 border-b border-slate-100 pb-3">
                    <i class="fa-solid fa-award text-emerald-600"></i>
                    <span>5. Keuntungan Layanan &amp; Catatan Penting</span>
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Keuntungan / Keunggulan Layanan</label>
                    <textarea name="benefits" rows="4" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600">{{ old('benefits', $service->benefits) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Penting / Disclaimer</label>
                    <textarea name="notes" rows="3" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600">{{ old('notes', $service->notes) }}</textarea>
                </div>
            </div>

            <!-- 6. TANYA JAWAB (FAQ) -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
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
                            <button type="button" onclick="this.closest('.faq-item').remove()" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan</label>
                                <input type="text" name="faq_questions[]" value="{{ $faq['q'] ?? '' }}" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                                <textarea name="faq_answers[]" rows="2" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white">{{ $faq['a'] ?? '' }}</textarea>
                            </div>
                        </div>
                    @empty
                        <div class="faq-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 space-y-2 relative">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan 1</label>
                                <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                                <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white"></textarea>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Publishing Settings & LIVE VISUAL SIMULATOR (col-span-4) -->
        <div class="lg:col-span-4 space-y-6 sticky top-24">
            
            <!-- LIVE VISUAL SIMULATOR CARD -->
            <div class="bg-gradient-to-br from-brand-950 to-emerald-950 text-white p-5 rounded-sm shadow-md border border-emerald-700/60">
                <div class="flex items-center justify-between pb-3 mb-3 border-b border-white/15">
                    <span class="text-[10px] font-black uppercase tracking-widest text-lime-300 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-lime-400 animate-pulse"></span>
                        Simulasi Tampilan Kartu Beranda
                    </span>
                </div>

                <!-- Simulated Live Card -->
                <div class="bg-white p-4 rounded-sm border border-slate-200 text-slate-900 shadow-sm">
                    <div id="simIconBox" class="w-9 h-9 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-lg mb-2.5">
                        <i id="simIcon" class="{{ $service->icon ?: 'fa-solid fa-book-open' }}"></i>
                    </div>
                    <h4 id="simTitle" class="font-bold text-xs text-slate-900 mb-1 leading-snug">
                        {{ $service->title ?: 'Judul Layanan' }}
                    </h4>
                    <p id="simDesc" class="text-[10px] text-slate-500 leading-relaxed mb-3">
                        {{ $service->short_desc ?: 'Deskripsi ringkas layanan...' }}
                    </p>
                    <div class="text-[10px] font-bold text-[#006830] inline-flex items-center gap-1 pt-2 border-t border-slate-100 w-full">
                        <span>Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right text-[8px]"></i>
                    </div>
                </div>
            </div>

            <!-- PUBLISHING SETTINGS -->
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2.5">
                    Pengaturan Publikasi
                </h3>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Status Layanan</label>
                    <select name="status" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 bg-white font-medium">
                        <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Tayang (Published)</option>
                        <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Draf (Disembunyikan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Urutan Tampil (Order)</label>
                    <input type="number" name="order" value="{{ old('order', $service->order) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300" />
                    <span class="text-[10px] text-slate-400 mt-1 block">Angka lebih kecil tampil lebih awal.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Teks Tombol Aksi (CTA)</label>
                    <input type="text" name="cta_text" value="{{ old('cta_text', $service->cta_text) }}" class="w-full text-xs p-2.5 rounded-sm border border-slate-300" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#024a23] text-white text-xs font-bold rounded-sm shadow-sm transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </div>

        </div>

    </form>
</div>

<script>
    // Live Simulator Sync
    const inputTitle = document.getElementById('inputTitle');
    const inputIcon = document.getElementById('inputIcon');
    const inputShortDesc = document.getElementById('inputShortDesc');
    const iconPreview = document.getElementById('iconPreview');

    const simTitle = document.getElementById('simTitle');
    const simIcon = document.getElementById('simIcon');
    const simDesc = document.getElementById('simDesc');

    function syncPreview() {
        if (inputTitle && simTitle) {
            simTitle.innerText = inputTitle.value.trim() || 'Judul Layanan';
        }
        if (inputShortDesc && simDesc) {
            simDesc.innerText = inputShortDesc.value.trim() || 'Deskripsi ringkas layanan akan muncul di kartu beranda pengunjung...';
        }
        if (inputIcon && simIcon) {
            const iconClass = inputIcon.value.trim() || 'fa-solid fa-book-open';
            simIcon.className = iconClass;
            if (iconPreview) {
                iconPreview.innerHTML = '<i class="' + iconClass + '"></i>';
            }
        }
    }

    if (inputTitle) inputTitle.addEventListener('input', syncPreview);
    if (inputIcon) inputIcon.addEventListener('input', syncPreview);
    if (inputShortDesc) inputShortDesc.addEventListener('input', syncPreview);

    function selectIcon(iconClass) {
        if (inputIcon) {
            inputIcon.value = iconClass;
            syncPreview();
        }
    }

    let stepCount = {{ count($steps) > 0 ? count($steps) : 1 }};
    function addWorkflowStep() {
        stepCount++;
        const container = document.getElementById('workflowContainer');
        const html = `
            <div class="workflow-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 relative">
                <button type="button" onclick="this.closest('.workflow-item').remove()" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                    <div class="sm:col-span-4">
                        <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Judul Langkah ${stepCount}</label>
                        <input type="text" name="step_titles[]" placeholder="Contoh: Review Naskah" class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                    </div>
                    <div class="sm:col-span-8">
                        <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Penjelasan Singkat</label>
                        <input type="text" name="step_descs[]" placeholder="Penjelasan proses..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    let faqCount = {{ count($faqs) > 0 ? count($faqs) : 1 }};
    function addFaqItem() {
        faqCount++;
        const container = document.getElementById('faqContainer');
        const html = `
            <div class="faq-item p-3.5 bg-slate-50 rounded-xs border border-slate-200 space-y-2 relative">
                <button type="button" onclick="this.closest('.faq-item').remove()" class="absolute top-2 right-2 text-slate-400 hover:text-red-600 text-xs cursor-pointer"><i class="fa-solid fa-times"></i></button>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Pertanyaan ${faqCount}</label>
                    <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-600 uppercase mb-1">Jawaban</label>
                    <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full text-xs p-2 rounded-xs border border-slate-300 bg-white"></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection
