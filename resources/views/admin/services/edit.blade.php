@extends('admin.layouts.app')

@section('title', 'Edit Layanan: ' . $service->title)
@section('header_title', 'Edit Layanan & Konten Halaman')

@section('content')
<form method="POST" action="{{ route('admin.services.update', $service->id) }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Top Action Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1 mb-1">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Layanan
            </a>
            <h3 class="text-lg font-black text-slate-900 font-heading">Edit Layanan: {{ $service->title }}</h3>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi, cakupan layanan, alur tahapan kerja, dan FAQ.</p>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('layanan.show', $service->slug) }}" target="_blank" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 border border-slate-200">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                <span>Lihat Halaman Publik</span>
            </a>
            <button type="submit" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-bold rounded-sm space-y-1">
            @foreach($errors->all() as $err)
                <div>• {{ $err }}</div>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- LEFT: 1. Main Info & Card (col-span-8) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- SECTION 1: INFORMASI UTAMA & KARTU BERANDA -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-id-card text-emerald-700"></i>
                    <span>1. Informasi Utama &amp; Kartu Beranda</span>
                </h4>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Layanan <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="srv_title" value="{{ old('title', $service->title) }}" required class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-bold" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">URL Slug</label>
                        <input type="text" name="slug" id="srv_slug" value="{{ old('slug', $service->slug) }}" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono text-emerald-800" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Icon FontAwesome <span class="text-rose-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <div id="iconPreviewBox" class="w-10 h-10 rounded-xs bg-emerald-50 text-emerald-800 flex items-center justify-center text-base border border-emerald-200 shrink-0">
                                <i id="iconPreview" class="{{ old('icon', $service->icon) }}"></i>
                            </div>
                            <input type="text" name="icon" id="srv_icon" value="{{ old('icon', $service->icon) }}" required class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono" oninput="updateIconPreview(this.value)" />
                        </div>
                    </div>
                </div>

                <!-- Icon Quick Presets -->
                <div>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1.5">Pilihan Cepat Icon:</span>
                    <div class="flex flex-wrap items-center gap-1.5">
                        <button type="button" onclick="selectIcon('fa-solid fa-barcode')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-barcode mr-1"></i> barcode</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-book-open')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-book-open mr-1"></i> book-open</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-graduation-cap')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-graduation-cap mr-1"></i> graduation</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-copy')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-copy mr-1"></i> copy</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-newspaper')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-newspaper mr-1"></i> newspaper</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-box-open')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-box-open mr-1"></i> box-open</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-certificate')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-certificate mr-1"></i> certificate</button>
                        <button type="button" onclick="selectIcon('fa-solid fa-pen-nib')" class="px-2 py-1 bg-slate-100 hover:bg-emerald-100 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-mono border border-slate-200 transition"><i class="fa-solid fa-pen-nib mr-1"></i> pen-nib</button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Ringkas (Tampil pada Kartu Beranda &amp; Navbar) <span class="text-rose-500">*</span></label>
                    <textarea name="short_desc" required rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed">{{ old('short_desc', $service->short_desc) }}</textarea>
                </div>
            </div>

            <!-- SECTION 2: HERO BANNER & TAGLINE -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-image text-emerald-700"></i>
                    <span>2. Hero Banner Halaman</span>
                </h4>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Slogan / Tagline Layanan</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $service->tagline) }}" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 italic" placeholder="Contoh: “Satu Karya, Satu Identitas, Siap Diterbitkan.”" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ganti Foto Banner Hero</label>
                    @if($service->banner_image)
                        <div class="mb-2 w-full h-24 rounded-xs overflow-hidden bg-slate-900 border border-slate-200">
                            <img src="{{ $service->banner_url }}" alt="Banner Preview" class="w-full h-full object-cover" />
                        </div>
                    @endif
                    <input type="file" name="banner_image" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                </div>
            </div>

            <!-- SECTION 3: PENJELASAN LENGKAP & CAKUPAN LAYANAN -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-emerald-700"></i>
                    <span>3. Penjelasan Lengkap &amp; Cakupan Layanan</span>
                </h4>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Lengkap / Pengantar Layanan</label>
                    <textarea name="overview" rows="4" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed">{{ old('overview', $service->overview) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">📚 Cakupan / Poin-Poin Layanan yang Disediakan (1 Baris = 1 Poin)</label>
                    <textarea name="features_list" rows="6" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed font-mono">{{ old('features_list', is_array($service->features) ? implode("
", $service->features) : '') }}</textarea>
                    <span class="text-[11px] text-slate-400 block mt-1">Ketikkan tiap poin cakupan layanan pada baris baru (Enter).</span>
                </div>
            </div>

            <!-- SECTION 4: ALUR & TAHAPAN KERJA -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-arrows-spin text-emerald-700"></i>
                        <span>4. 🔄 Alur &amp; Tahapan Pelaksanaan</span>
                    </h4>
                    <button type="button" onclick="addWorkflowRow()" class="px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-xs border border-emerald-200 flex items-center gap-1 transition">
                        <i class="fa-solid fa-plus text-[10px]"></i> Tambah Langkah
                    </button>
                </div>

                <div id="workflowContainer" class="space-y-3">
                    @if(!empty($service->workflow_steps) && is_array($service->workflow_steps))
                        @foreach($service->workflow_steps as $idx => $step)
                            <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 workflow-row">
                                <span class="w-6 h-6 rounded-full bg-[#006830] text-white font-mono font-bold text-xs flex items-center justify-center shrink-0 mt-1 step-num">{{ $idx + 1 }}</span>
                                <div class="flex-1 space-y-2">
                                    <input type="text" name="step_titles[]" value="{{ $step['title'] ?? '' }}" placeholder="Nama Tahap" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                                    <textarea name="step_descs[]" rows="2" placeholder="Penjelasan singkat tahap ini..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300">{{ $step['desc'] ?? '' }}</textarea>
                                </div>
                                <button type="button" onclick="this.closest('.workflow-row').remove(); reindexSteps();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 workflow-row">
                            <span class="w-6 h-6 rounded-full bg-[#006830] text-white font-mono font-bold text-xs flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                            <div class="flex-1 space-y-2">
                                <input type="text" name="step_titles[]" placeholder="Nama Tahap" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                                <textarea name="step_descs[]" rows="2" placeholder="Penjelasan singkat tahap ini..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
                            </div>
                            <button type="button" onclick="this.closest('.workflow-row').remove(); reindexSteps();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- SECTION 5: KEUNTUNGAN & CATATAN PENTING -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-award text-emerald-700"></i>
                    <span>5. Keuntungan Layanan &amp; Catatan Penting</span>
                </h4>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">🎯 Keuntungan Menggunakan Layanan</label>
                    <textarea name="benefits" rows="3" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed">{{ old('benefits', $service->benefits) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">⚠️ Catatan Penting / Disclaimer</label>
                    <textarea name="notes" rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed">{{ old('notes', $service->notes) }}</textarea>
                </div>
            </div>

            <!-- SECTION 6: FAQ (TANYA JAWAB) -->
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-emerald-700"></i>
                        <span>6. Tanya Jawab (FAQ Layanan)</span>
                    </h4>
                    <button type="button" onclick="addFaqRow()" class="px-2.5 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-[11px] font-bold rounded-xs border border-emerald-200 flex items-center gap-1 transition">
                        <i class="fa-solid fa-plus text-[10px]"></i> Tambah FAQ
                    </button>
                </div>

                <div id="faqContainer" class="space-y-3">
                    @if(!empty($service->faqs) && is_array($service->faqs))
                        @foreach($service->faqs as $faq)
                            <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 faq-row">
                                <div class="flex-1 space-y-2">
                                    <input type="text" name="faq_questions[]" value="{{ $faq['q'] ?? '' }}" placeholder="Pertanyaan..." class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                                    <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300">{{ $faq['a'] ?? '' }}</textarea>
                                </div>
                                <button type="button" onclick="this.closest('.faq-row').remove();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        @endforeach
                    @else
                        <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 faq-row">
                            <div class="flex-1 space-y-2">
                                <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                                <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
                            </div>
                            <button type="button" onclick="this.closest('.faq-row').remove();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- RIGHT: Meta Settings & Status (col-span-4) -->
        <div class="lg:col-span-4 space-y-6 sticky top-24">
            
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100">
                    Pengaturan Publikasi
                </h4>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Layanan</label>
                    <select name="status" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 bg-white font-semibold">
                        <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Tayang (Published)</option>
                        <option value="draft" {{ old('status', $service->status) === 'draft' ? 'selected' : '' }}>Draf (Draft)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Urutan Tampil (Order)</label>
                    <input type="number" name="order" value="{{ old('order', $service->order) }}" min="0" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold" />
                    <span class="text-[11px] text-slate-400 block mt-1">Angka lebih kecil tampil lebih awal.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Tombol Aksi (CTA)</label>
                    <input type="text" name="cta_text" value="{{ old('cta_text', $service->cta_text) }}" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" />
                </div>

                <div class="pt-3 border-t border-slate-100 space-y-2">
                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </div>

        </div>

    </div>
</form>

<script>
    function selectIcon(iconClass) {
        document.getElementById('srv_icon').value = iconClass;
        updateIconPreview(iconClass);
    }

    function updateIconPreview(iconClass) {
        const preview = document.getElementById('iconPreview');
        if (preview) {
            preview.className = iconClass;
        }
    }

    function addWorkflowRow() {
        const container = document.getElementById('workflowContainer');
        const count = container.querySelectorAll('.workflow-row').length + 1;
        const div = document.createElement('div');
        div.className = 'flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 workflow-row';
        div.innerHTML = `
            <span class="w-6 h-6 rounded-full bg-[#006830] text-white font-mono font-bold text-xs flex items-center justify-center shrink-0 mt-1 step-num">${count}</span>
            <div class="flex-1 space-y-2">
                <input type="text" name="step_titles[]" placeholder="Nama Tahap" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                <textarea name="step_descs[]" rows="2" placeholder="Penjelasan singkat tahap ini..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
            </div>
            <button type="button" onclick="this.closest('.workflow-row').remove(); reindexSteps();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
        `;
        container.appendChild(div);
    }

    function reindexSteps() {
        const rows = document.querySelectorAll('#workflowContainer .workflow-row');
        rows.forEach((r, idx) => {
            const num = r.querySelector('.step-num');
            if (num) num.innerText = idx + 1;
        });
    }

    function addFaqRow() {
        const container = document.getElementById('faqContainer');
        const div = document.createElement('div');
        div.className = 'flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 faq-row';
        div.innerHTML = `
            <div class="flex-1 space-y-2">
                <input type="text" name="faq_questions[]" placeholder="Pertanyaan..." class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
            </div>
            <button type="button" onclick="this.closest('.faq-row').remove();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
        `;
        container.appendChild(div);
    }
</script>
@endsection
