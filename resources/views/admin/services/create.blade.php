@extends('admin.layouts.app')

@section('title', 'Tambah Layanan Baru')
@section('header_title', 'Page Builder Layanan Baru')

@section('content')
<form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Top Action Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.services.index') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1 mb-1">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Layanan
            </a>
            <h3 class="text-lg font-black text-slate-900 font-heading">Buat Halaman Layanan Baru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Isi detail, cakupan layanan, alur tahapan, dan FAQ untuk membuat halaman layanan.</p>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Simpan &amp; Publikasikan</span>
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
                    <input type="text" name="title" id="srv_title" value="{{ old('title') }}" required class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-bold" placeholder="Contoh: Pengurusan ISBN" oninput="autoSlug(this.value)" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">URL Slug</label>
                        <input type="text" name="slug" id="srv_slug" value="{{ old('slug') }}" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono text-emerald-800" placeholder="pengurusan-isbn" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Icon FontAwesome <span class="text-rose-500">*</span></label>
                        <div class="flex items-center gap-2">
                            <div id="iconPreviewBox" class="w-10 h-10 rounded-xs bg-emerald-50 text-emerald-800 flex items-center justify-center text-base border border-emerald-200 shrink-0">
                                <i id="iconPreview" class="{{ old('icon', 'fa-solid fa-barcode') }}"></i>
                            </div>
                            <input type="text" name="icon" id="srv_icon" value="{{ old('icon', 'fa-solid fa-barcode') }}" required class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono" placeholder="fa-solid fa-barcode" oninput="updateIconPreview(this.value)" />
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
                    <textarea name="short_desc" required rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Bantu pengurusan ISBN resmi untuk buku dan terbitan Anda...">{{ old('short_desc') }}</textarea>
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
                    <input type="text" name="tagline" value="{{ old('tagline') }}" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 italic" placeholder="Contoh: “Satu Karya, Satu Identitas, Siap Diterbitkan.”" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Foto Banner Hero (Opsional)</label>
                    <input type="file" name="banner_image" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                    <span class="text-[11px] text-slate-400 block mt-1">Format: JPG, PNG, atau WebP (Maks 5MB). Banner otomatis diberi overlay gelap elegan khas PERSIS PERS.</span>
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
                    <textarea name="overview" rows="4" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Penerbit Persis menyediakan layanan pengurusan ISBN untuk membantu penulis dan lembaga memperoleh identitas resmi bagi buku yang akan diterbitkan...">{{ old('overview') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">📚 Cakupan / Poin-Poin Layanan yang Disediakan (1 Baris = 1 Poin)</label>
                    <textarea name="features_list" rows="6" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed font-mono" placeholder="Pengajuan ISBN untuk buku yang diterbitkan&#10;Pemeriksaan kelengkapan data dan naskah&#10;Penyiapan metadata buku&#10;Pendampingan proses pengajuan ISBN&#10;Penyesuaian informasi penerbitan&#10;Penempatan ISBN pada buku&#10;Pendampingan sampai proses penerbitan selesai">{{ old('features_list') }}</textarea>
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
                    <!-- Default Initial Step Rows -->
                    <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 workflow-row">
                        <span class="w-6 h-6 rounded-full bg-[#006830] text-white font-mono font-bold text-xs flex items-center justify-center shrink-0 mt-1 step-num">1</span>
                        <div class="flex-1 space-y-2">
                            <input type="text" name="step_titles[]" placeholder="Nama Tahap (Contoh: Pengajuan Naskah)" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                            <textarea name="step_descs[]" rows="2" placeholder="Penjelasan singkat tahap ini..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
                        </div>
                        <button type="button" onclick="this.closest('.workflow-row').remove(); reindexSteps();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                    </div>
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
                    <textarea name="benefits" rows="3" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Mudah • Terarah • Profesional • Terintegrasi&#10;Penulis tidak perlu mengurus seluruh proses sendiri. Penerbit Persis membantu dari persiapan data hingga ISBN siap digunakan.">{{ old('benefits') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">⚠️ Catatan Penting / Disclaimer</label>
                    <textarea name="notes" rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Catatan: ISBN bukan sertifikasi mutu atau hak cipta buku. ISBN berfungsi sebagai identitas unik publikasi buku.">{{ old('notes') }}</textarea>
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
                    <div class="flex items-start gap-2 bg-slate-50 p-3 rounded-xs border border-slate-200 faq-row">
                        <div class="flex-1 space-y-2">
                            <input type="text" name="faq_questions[]" placeholder="Pertanyaan (Contoh: Berapa lama proses pengurusan ISBN?)" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
                            <textarea name="faq_answers[]" rows="2" placeholder="Jawaban..." class="w-full px-3 py-1.5 text-xs rounded-xs border border-slate-300"></textarea>
                        </div>
                        <button type="button" onclick="this.closest('.faq-row').remove();" class="text-slate-400 hover:text-rose-600 p-1 text-xs"><i class="fa-solid fa-xmark"></i></button>
                    </div>
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
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Tayang (Published)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draf (Draft)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Urutan Tampil (Order)</label>
                    <input type="number" name="order" value="{{ old('order', 1) }}" min="0" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold" />
                    <span class="text-[11px] text-slate-400 block mt-1">Angka lebih kecil tampil lebih awal.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Tombol Aksi (CTA)</label>
                    <input type="text" name="cta_text" value="{{ old('cta_text', 'Konsultasi Sekarang') }}" class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Konsultasi Sekarang" />
                </div>

                <div class="pt-3 border-t border-slate-100">
                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Layanan</span>
                    </button>
                </div>
            </div>

        </div>

    </div>
</form>

<script>
    function autoSlug(text) {
        const slug = text.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
        const slugInput = document.getElementById('srv_slug');
        if (slugInput && !slugInput.dataset.manual) {
            slugInput.value = slug;
        }
    }

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
                <input type="text" name="step_titles[]" placeholder="Nama Tahap (Contoh: Tahap ${count})" class="w-full px-3 py-1.5 text-xs font-bold rounded-xs border border-slate-300" />
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
