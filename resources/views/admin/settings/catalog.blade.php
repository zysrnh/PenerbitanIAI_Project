@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Katalog & Pembayaran')
@section('header_title', 'Kelola Halaman Katalog & Metode Pembayaran')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten &amp; Pembayaran Katalog</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xs text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                    <span class="w-2 h-2 rounded-xs bg-emerald-500 animate-pulse"></span> Multi-Mode Checkout
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Ubah teks banner, kartu statistik, dan mode pembayaran (Payment Gateway Otomatis vs QRIS/Rekening Tempel Manual).</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Katalog Publik
            </a>
            <button type="submit" form="catalogSettingsForm" title="Simpan Perubahan" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-sm transition shadow-xs hover:shadow-md flex items-center gap-2 text-xs sm:text-sm">
                <i class="fa-solid fa-floppy-disk text-base"></i>
                <span>Simpan Semua Pengaturan</span>
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

    <!-- Main Grid: Form Left (7 cols), Visual Preview Right (5 cols) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="xl:col-span-7 space-y-6">
            <form method="POST" action="{{ route('admin.settings.catalog.update') }}" enctype="multipart/form-data" class="space-y-6" id="catalogSettingsForm">
                @csrf
                @method('PUT')

                <!-- 0. METODE PEMBAYARAN CHECKOUT BUKU (SWITCHER) -->
                <div class="bg-white rounded-sm border-2 border-emerald-500/40 shadow-xs p-6 sm:p-7 relative overflow-hidden">
                    <div class="absolute top-0 right-0 px-3 py-1 bg-emerald-600 text-white font-mono text-[10px] font-bold rounded-bl-sm uppercase tracking-wider">
                        Konfigurasi Checkout
                    </div>

                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-slate-900">Metode Pembayaran Checkout Buku</h4>
                            <span class="text-xs text-slate-400">Pilih alur transaksi saat pembeli memesan buku dari katalog</span>
                        </div>
                    </div>

                    <!-- Payment Mode Selector (Radio Cards) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                        <!-- Mode 1: Payment Gateway (Pakasir) -->
                        <label class="relative flex flex-col p-4 border rounded-sm cursor-pointer transition select-none {{ $settings['catalog_payment_mode'] === 'gateway' ? 'border-emerald-600 bg-emerald-50/50 ring-1 ring-emerald-500' : 'border-slate-200 bg-white hover:bg-slate-50' }}" id="labelModeGateway">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                                    <i class="fa-solid fa-bolt text-amber-500"></i> Payment Gateway (Pakasir)
                                </span>
                                <input type="radio" name="catalog_payment_mode" value="gateway" class="text-emerald-700 focus:ring-emerald-600" {{ $settings['catalog_payment_mode'] === 'gateway' ? 'checked' : '' }} onchange="togglePaymentModeUI('gateway')">
                            </div>
                            <p class="text-[11px] text-slate-500 leading-snug">
                                QRIS dinamis otomatis mendeteksi status <strong>Lunas</strong> secara real-time tanpa perlu cek mutasi manual.
                            </p>
                            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold text-emerald-700">
                                <i class="fa-solid fa-circle-check"></i> Deteksi Lunas Otomatis
                            </div>
                        </label>

                        <!-- Mode 2: Tempel QRIS / Bank Manual -->
                        <label class="relative flex flex-col p-4 border rounded-sm cursor-pointer transition select-none {{ $settings['catalog_payment_mode'] === 'manual' ? 'border-emerald-600 bg-emerald-50/50 ring-1 ring-emerald-500' : 'border-slate-200 bg-white hover:bg-slate-50' }}" id="labelModeManual">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-xs text-slate-900 flex items-center gap-1.5">
                                    <i class="fa-solid fa-qrcode text-emerald-700"></i> QRIS Tempel / Bank Manual
                                </span>
                                <input type="radio" name="catalog_payment_mode" value="manual" class="text-emerald-700 focus:ring-emerald-600" {{ $settings['catalog_payment_mode'] === 'manual' ? 'checked' : '' }} onchange="togglePaymentModeUI('manual')">
                            </div>
                            <p class="text-[11px] text-slate-500 leading-snug">
                                Pembeli scan foto QRIS yayasan &amp; mengirimkan bukti transfer via WhatsApp langsung ke admin.
                            </p>
                            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold text-blue-700">
                                <i class="fa-brands fa-whatsapp"></i> Konfirmasi Bukti via WA
                            </div>
                        </label>
                    </div>

                    <!-- Manual QRIS & Bank Config Drawer (Toggled) -->
                    <div id="manualQrisConfigSection" class="p-4 bg-slate-50 border border-slate-200 rounded-sm space-y-4 {{ $settings['catalog_payment_mode'] === 'manual' ? '' : 'hidden' }}">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                            <span class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-sliders text-emerald-700"></i> Detail QRIS &amp; Rekening Manual
                            </span>
                            <span class="text-[10px] text-slate-400">Aktif saat mode Manual dipilih</span>
                        </div>

                        <!-- Upload Foto QRIS Statis -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-start">
                            <div class="sm:col-span-1">
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Foto Barcode QRIS</label>
                                <div class="w-full aspect-square bg-white border border-slate-300 rounded-xs flex items-center justify-center overflow-hidden p-2 relative shadow-2xs">
                                    @if(!empty($settings['catalog_manual_qris_image']))
                                        <img id="manualQrisPreviewImg" src="{{ asset($settings['catalog_manual_qris_image']) }}?v={{ time() }}" alt="QRIS Toko" class="w-full h-full object-contain" />
                                    @else
                                        <div id="manualQrisPreviewEmpty" class="text-center p-2 text-slate-400">
                                            <i class="fa-solid fa-qrcode text-3xl mb-1 block"></i>
                                            <span class="text-[10px] block">Belum ada foto</span>
                                        </div>
                                        <img id="manualQrisPreviewImg" src="" alt="QRIS Toko" class="w-full h-full object-contain hidden" />
                                    @endif
                                </div>
                            </div>
                            <div class="sm:col-span-2 space-y-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Unggah Foto QRIS Baru (PNG/JPG/WEBP)</label>
                                    <input 
                                        type="file" 
                                        name="catalog_manual_qris_file" 
                                        accept="image/png,image/jpeg,image/jpg,image/webp"
                                        onchange="previewUploadedQris(this)"
                                        class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xs file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-300 rounded-xs p-1 bg-white"
                                    />
                                    <p class="text-[10px] text-slate-400 mt-1">Format: PNG, JPG, WEBP. Maksimal ukuran 5MB.</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp Admin Konfirmasi <span class="text-rose-500">*</span></label>
                                    <input 
                                        type="text" 
                                        name="catalog_manual_wa_number" 
                                        value="{{ old('catalog_manual_wa_number', $settings['catalog_manual_wa_number']) }}" 
                                        placeholder="Contoh: 6281234567890" 
                                        class="w-full px-3 py-2 text-xs rounded-xs border border-slate-300 focus:outline-hidden focus:border-emerald-600 font-mono"
                                    />
                                    <p class="text-[10px] text-slate-400 mt-0.5">Format internasional berawalan 62 (contoh: 628xxxxxxxxxx).</p>
                                </div>
                            </div>
                        </div>

                        <!-- Rekening Bank Alternatif -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-slate-200">
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nama Bank</label>
                                <input 
                                    type="text" 
                                    name="catalog_manual_bank_name" 
                                    value="{{ old('catalog_manual_bank_name', $settings['catalog_manual_bank_name']) }}" 
                                    placeholder="Contoh: BSI / BCA / Mandiri" 
                                    class="w-full px-3 py-2 text-xs rounded-xs border border-slate-300 focus:outline-hidden focus:border-emerald-600"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nomor Rekening</label>
                                <input 
                                    type="text" 
                                    name="catalog_manual_bank_number" 
                                    value="{{ old('catalog_manual_bank_number', $settings['catalog_manual_bank_number']) }}" 
                                    placeholder="Contoh: 7123456789" 
                                    class="w-full px-3 py-2 text-xs rounded-xs border border-slate-300 focus:outline-hidden focus:border-emerald-600 font-mono font-bold"
                                />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Atas Nama Pemilik</label>
                                <input 
                                    type="text" 
                                    name="catalog_manual_bank_holder" 
                                    value="{{ old('catalog_manual_bank_holder', $settings['catalog_manual_bank_holder']) }}" 
                                    placeholder="Contoh: PENERBIT PERSIS PERS" 
                                    class="w-full px-3 py-2 text-xs rounded-xs border border-slate-300 focus:outline-hidden focus:border-emerald-600"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Petunjuk Pembayaran untuk Pembeli</label>
                            <textarea 
                                name="catalog_manual_instructions" 
                                rows="2" 
                                class="w-full px-3 py-2 text-xs rounded-xs border border-slate-300 focus:outline-hidden focus:border-emerald-600 leading-relaxed"
                            >{{ old('catalog_manual_instructions', $settings['catalog_manual_instructions']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
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
                                    class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
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
                                    class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Singkat Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="catalog_banner_desc" 
                                id="in_catalog_desc"
                                rows="3" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition leading-relaxed"
                            >{{ old('catalog_banner_desc', $settings['catalog_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. Highlight Cards (4 Stats) -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. Kartu Highlight Angka &amp; Mutu</h4>
                            <span class="text-xs text-slate-400">4 kartu statistik yang tampil di bawah header</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Statistik 1 (Total Koleksi) <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_stat_books" 
                                id="in_stat_books"
                                value="{{ old('catalog_stat_books', $settings['catalog_stat_books']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Statistik 2 (Penulis Penerbit Persis) <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_stat_authors" 
                                id="in_stat_authors"
                                value="{{ old('catalog_stat_authors', $settings['catalog_stat_authors']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Statistik 3 (Legalitas ISBN) <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_stat_isbn" 
                                id="in_stat_isbn"
                                value="{{ old('catalog_stat_isbn', $settings['catalog_stat_isbn']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Statistik 4 (Standar Mutu) <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_stat_print" 
                                id="in_stat_print"
                                value="{{ old('catalog_stat_print', $settings['catalog_stat_print']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-medium"
                            />
                        </div>
                    </div>
                </div>

                <!-- 3. Sidebar Info & Promo Box -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-amber-50 text-amber-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Widget Info &amp; Promo Sidebar</h4>
                            <span class="text-xs text-slate-400">Pengumuman promo cetak dan agenda call for papers</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 rounded-sm border border-slate-200 space-y-3">
                            <span class="text-xs font-bold text-slate-900 uppercase">A. Program Promo Cetak</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Promo <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="catalog_promo_title" 
                                    id="in_promo_title"
                                    value="{{ old('catalog_promo_title', $settings['catalog_promo_title']) }}" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi Promo <span class="text-rose-500">*</span></label>
                                <textarea 
                                    name="catalog_promo_desc" 
                                    id="in_promo_desc"
                                    rows="2" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                                >{{ old('catalog_promo_desc', $settings['catalog_promo_desc']) }}</textarea>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-sm border border-slate-200 space-y-3">
                            <span class="text-xs font-bold text-slate-900 uppercase">B. Agenda Akademik</span>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Judul Agenda <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="catalog_agenda_title" 
                                    id="in_agenda_title"
                                    value="{{ old('catalog_agenda_title', $settings['catalog_agenda_title']) }}" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 mb-1">Deskripsi Agenda <span class="text-rose-500">*</span></label>
                                <textarea 
                                    name="catalog_agenda_desc" 
                                    id="in_agenda_desc"
                                    rows="2" 
                                    required 
                                    oninput="updateCatalogPreview()"
                                    class="w-full px-3.5 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                                >{{ old('catalog_agenda_desc', $settings['catalog_agenda_desc']) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. CTA Box Terbitkan Naskah -->
                <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-sm bg-purple-50 text-purple-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">4. Banner Penawaran Terbit Naskah (CTA Bawah)</h4>
                            <span class="text-xs text-slate-400">Ajakan menerbitkan naskah di bagian paling bawah halaman</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Banner CTA <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="catalog_publish_box_title" 
                                id="in_publish_title"
                                value="{{ old('catalog_publish_box_title', $settings['catalog_publish_box_title']) }}" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium"
                            />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Banner CTA <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="catalog_publish_box_desc" 
                                id="in_publish_desc"
                                rows="2" 
                                required 
                                oninput="updateCatalogPreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed"
                            >{{ old('catalog_publish_box_desc', $settings['catalog_publish_box_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex items-center justify-end">
                    <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-sm transition shadow-xs hover:shadow-md flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Pengaturan Konten &amp; Pembayaran</span>
                    </button>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: 1:1 LIVE PREVIEW MOCKUP (STICKY TOP-20) -->
        <div class="xl:col-span-5 sticky top-20 self-start space-y-4">
            
            <div class="bg-slate-900 rounded-sm p-4 border border-slate-800 shadow-lg flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-xs bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-xs bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-xs bg-emerald-500"></span>
                    </div>
                    <span class="text-sm font-bold tracking-wide text-white">Pratinjau Visual Halaman Katalog</span>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-sm bg-slate-800 text-emerald-400 border border-slate-700">Live Mockup</span>
            </div>

            <!-- Visual Preview Canvas -->
            <div class="bg-slate-100 rounded-sm border border-slate-200/80 shadow-md overflow-hidden text-slate-800 space-y-4 p-4">
                
                <!-- Preview 1: Header Banner bg-brand-950 -->
                <div class="bg-[#032c21] text-white p-5 rounded-sm shadow-xs border-b border-[#064e3b]">
                    <span id="prev_badge" class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block mb-1">
                        {{ $settings['catalog_banner_badge'] }}
                    </span>
                    <h4 id="prev_title" class="font-extrabold text-base sm:text-lg text-white leading-tight">
                        {{ $settings['catalog_banner_title'] }}
                    </h4>
                    <p id="prev_desc" class="text-[11px] text-slate-300 mt-1.5 leading-relaxed line-clamp-2">
                        {{ $settings['catalog_banner_desc'] }}
                    </p>
                </div>

                <!-- Preview 2: 4 Highlight Cards -mt-5 -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 -mt-7 relative z-10 px-2">
                    <div class="p-2.5 bg-white rounded-sm border border-slate-200 shadow-sm text-center">
                        <i class="fa-solid fa-book text-emerald-700 text-xs mb-1 block"></i>
                        <span id="prev_stat_books" class="font-bold text-[11px] text-slate-900 block truncate">{{ $settings['catalog_stat_books'] }}</span>
                    </div>
                    <div class="p-2.5 bg-white rounded-sm border border-slate-200 shadow-sm text-center">
                        <i class="fa-solid fa-user-graduate text-emerald-700 text-xs mb-1 block"></i>
                        <span id="prev_stat_authors" class="font-bold text-[11px] text-slate-900 block truncate">{{ $settings['catalog_stat_authors'] }}</span>
                    </div>
                    <div class="p-2.5 bg-white rounded-sm border border-slate-200 shadow-sm text-center">
                        <i class="fa-solid fa-barcode text-emerald-700 text-xs mb-1 block"></i>
                        <span id="prev_stat_isbn" class="font-bold text-[11px] text-slate-900 block truncate">{{ $settings['catalog_stat_isbn'] }}</span>
                    </div>
                    <div class="p-2.5 bg-white rounded-sm border border-slate-200 shadow-sm text-center">
                        <i class="fa-solid fa-award text-emerald-700 text-xs mb-1 block"></i>
                        <span id="prev_stat_print" class="font-bold text-[11px] text-slate-900 block truncate">{{ $settings['catalog_stat_print'] }}</span>
                    </div>
                </div>

                <!-- Preview 3: Sidebar Info & Promo -->
                <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs space-y-2">
                    <div class="bg-[#032c21] text-emerald-300 p-2 rounded-xs text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fa-solid fa-bullhorn text-emerald-400"></i> Info &amp; Promo Sidebar
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-xs border border-slate-200 space-y-0.5">
                        <span class="text-[9px] font-bold text-emerald-800">PROMO PENERBITAN</span>
                        <h6 id="prev_promo_title" class="font-bold text-xs text-slate-900">{{ $settings['catalog_promo_title'] }}</h6>
                        <p id="prev_promo_desc" class="text-[10px] text-slate-600 line-clamp-1">{{ $settings['catalog_promo_desc'] }}</p>
                    </div>
                    <div class="p-2.5 bg-slate-50 rounded-xs border border-slate-200 space-y-0.5">
                        <span class="text-[9px] font-bold text-blue-800">AGENDA RESMI</span>
                        <h6 id="prev_agenda_title" class="font-bold text-xs text-slate-900">{{ $settings['catalog_agenda_title'] }}</h6>
                        <p id="prev_agenda_desc" class="text-[10px] text-slate-600 line-clamp-1">{{ $settings['catalog_agenda_desc'] }}</p>
                    </div>
                </div>

                <!-- Preview 4: CTA Box Terbitkan Naskah -->
                <div class="p-3.5 rounded-sm bg-[#032c21] text-white border border-[#064e3b] space-y-1">
                    <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest block">Layanan Penerbitan</span>
                    <h6 id="prev_publish_title" class="font-bold text-xs text-white">{{ $settings['catalog_publish_box_title'] }}</h6>
                    <p id="prev_publish_desc" class="text-[10px] text-slate-300 leading-relaxed line-clamp-2">{{ $settings['catalog_publish_box_desc'] }}</p>
                </div>

            </div>
        </div>

    </div>

    <!-- JavaScript for Dynamic UI & Live Preview -->
    <script>
        function togglePaymentModeUI(mode) {
            const manualSection = document.getElementById('manualQrisConfigSection');
            const labelGateway = document.getElementById('labelModeGateway');
            const labelManual = document.getElementById('labelModeManual');

            if (mode === 'manual') {
                manualSection.classList.remove('hidden');
                labelManual.classList.add('border-emerald-600', 'bg-emerald-50/50', 'ring-1', 'ring-emerald-500');
                labelGateway.classList.remove('border-emerald-600', 'bg-emerald-50/50', 'ring-1', 'ring-emerald-500');
            } else {
                manualSection.classList.add('hidden');
                labelGateway.classList.add('border-emerald-600', 'bg-emerald-50/50', 'ring-1', 'ring-emerald-500');
                labelManual.classList.remove('border-emerald-600', 'bg-emerald-50/50', 'ring-1', 'ring-emerald-500');
            }
        }

        function previewUploadedQris(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('manualQrisPreviewImg');
                    const empty = document.getElementById('manualQrisPreviewEmpty');
                    if (img) {
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                    }
                    if (empty) empty.classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateCatalogPreview() {
            const inBadge = document.getElementById('in_catalog_badge');
            const inTitle = document.getElementById('in_catalog_title');
            const inDesc = document.getElementById('in_catalog_desc');
            if (inBadge) document.getElementById('prev_badge').innerText = inBadge.value;
            if (inTitle) document.getElementById('prev_title').innerText = inTitle.value;
            if (inDesc) document.getElementById('prev_desc').innerText = inDesc.value;

            const inBooks = document.getElementById('in_stat_books');
            const inAuthors = document.getElementById('in_stat_authors');
            const inIsbn = document.getElementById('in_stat_isbn');
            const inPrint = document.getElementById('in_stat_print');
            if (inBooks) document.getElementById('prev_stat_books').innerText = inBooks.value;
            if (inAuthors) document.getElementById('prev_stat_authors').innerText = inAuthors.value;
            if (inIsbn) document.getElementById('prev_stat_isbn').innerText = inIsbn.value;
            if (inPrint) document.getElementById('prev_stat_print').innerText = inPrint.value;

            const inPromoTitle = document.getElementById('in_promo_title');
            const inPromoDesc = document.getElementById('in_promo_desc');
            const inAgendaTitle = document.getElementById('in_agenda_title');
            const inAgendaDesc = document.getElementById('in_agenda_desc');
            if (inPromoTitle) document.getElementById('prev_promo_title').innerText = inPromoTitle.value;
            if (inPromoDesc) document.getElementById('prev_promo_desc').innerText = inPromoDesc.value;
            if (inAgendaTitle) document.getElementById('prev_agenda_title').innerText = inAgendaTitle.value;
            if (inAgendaDesc) document.getElementById('prev_agenda_desc').innerText = inAgendaDesc.value;

            const inPubTitle = document.getElementById('in_publish_title');
            const inPubDesc = document.getElementById('in_publish_desc');
            if (inPubTitle) document.getElementById('prev_publish_title').innerText = inPubTitle.value;
            if (inPubDesc) document.getElementById('prev_publish_desc').innerText = inPubDesc.value;
        }
    </script>
@endsection
