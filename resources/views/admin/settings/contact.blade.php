@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Kontak')
@section('header_title', 'Kelola Konten Halaman Kontak')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Pengaturan Konten Halaman Kontak</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola teks banner, kontak WhatsApp, email, jam kerja, box konsultasi kilat, dan embed lokasi Google Maps.</p>
        </div>
        <a href="{{ url('/kontak') }}" target="_blank" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-lg text-xs font-semibold transition flex items-center gap-1.5 shadow-xs">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Lihat Halaman Kontak
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
            @foreach($errors->all() as $error)
                <div>&bull; {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- SECTION 1: Banner Header -->
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-heading"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">1. Header & Banner Halaman</h4>
                    <span class="text-[11px] text-slate-400">Bagian atas halaman kontak</span>
                </div>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Badge Teks Atas <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_banner_badge" 
                            value="{{ old('contact_banner_badge', $settings['contact_banner_badge']) }}" 
                            required 
                            placeholder="Contoh: Layanan & Informasi"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Utama Banner <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_banner_title" 
                            value="{{ old('contact_banner_title', $settings['contact_banner_title']) }}" 
                            required 
                            placeholder="Contoh: Hubungi Kami & Layanan Redaksi"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi Pengantar Banner <span class="text-rose-500">*</span></label>
                    <textarea 
                        name="contact_banner_desc" 
                        rows="2" 
                        required 
                        class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    >{{ old('contact_banner_desc', $settings['contact_banner_desc']) }}</textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 2: 4 Quick Info Cards -->
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-address-card"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">2. Informasi 4 Kartu Kontak Cepat</h4>
                    <span class="text-[11px] text-slate-400">Alamat kantor, nomor WA, email, dan jam kerja</span>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Alamat Kantor -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Lengkap Kantor Redaksi <span class="text-rose-500">*</span></label>
                    <textarea 
                        name="contact_address" 
                        rows="2" 
                        required 
                        class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    >{{ old('contact_address', $settings['contact_address']) }}</textarea>
                </div>

                <!-- WA & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp Resmi <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_whatsapp" 
                            value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}" 
                            required 
                            placeholder="082116116133"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Telepon Kantor Kampus <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_phone" 
                            value="{{ old('contact_phone', $settings['contact_phone']) }}" 
                            required 
                            placeholder="(022) 5441951"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>

                <!-- Email & Catatan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Email Resmi Redaksi <span class="text-rose-500">*</span></label>
                        <input 
                            type="email" 
                            name="contact_email" 
                            value="{{ old('contact_email', $settings['contact_email']) }}" 
                            required 
                            placeholder="penerbitan@iaipibandung.ac.id"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Respon Email</label>
                        <input 
                            type="text" 
                            name="contact_email_note" 
                            value="{{ old('contact_email_note', $settings['contact_email_note']) }}" 
                            placeholder="Contoh: Respon cepat 1x24 jam kerja"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>

                <!-- Jam Kerja & Weekend -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jam Operasional Hari Kerja <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_hours" 
                            value="{{ old('contact_hours', $settings['contact_hours']) }}" 
                            required 
                            placeholder="Senin – Jumat: 08:00 – 16:00 WIB"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Hari Libur / Weekend</label>
                        <input 
                            type="text" 
                            name="contact_hours_weekend" 
                            value="{{ old('contact_hours_weekend', $settings['contact_hours_weekend']) }}" 
                            placeholder="Sabtu & Minggu: Tutup"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Box Konsultasi WhatsApp Cepat -->
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                <div class="w-7 h-7 rounded-lg bg-[#25D366]/15 text-[#128C7E] flex items-center justify-center text-xs">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">3. Box Konsultasi Kilat WhatsApp</h4>
                    <span class="text-[11px] text-slate-400">Card hijau di samping form kontak</span>
                </div>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Box <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_wa_box_title" 
                            value="{{ old('contact_wa_box_title', $settings['contact_wa_box_title']) }}" 
                            required 
                            placeholder="Konsultasi Cepat (WhatsApp)"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Subjudul / Status Box <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_wa_box_subtitle" 
                            value="{{ old('contact_wa_box_subtitle', $settings['contact_wa_box_subtitle']) }}" 
                            required 
                            placeholder="Langsung terhubung dengan Tim Redaksi"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Teks Deskripsi Box <span class="text-rose-500">*</span></label>
                    <textarea 
                        name="contact_wa_box_desc" 
                        rows="2" 
                        required 
                        class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                    >{{ old('contact_wa_box_desc', $settings['contact_wa_box_desc']) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Teks Tombol WhatsApp <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_wa_btn_text" 
                            value="{{ old('contact_wa_btn_text', $settings['contact_wa_btn_text']) }}" 
                            required 
                            placeholder="CHAT WHATSAPP SEKARANG"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Template Pesan WhatsApp Otomatis <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_wa_default_msg" 
                            value="{{ old('contact_wa_default_msg', $settings['contact_wa_default_msg']) }}" 
                            required 
                            placeholder="Halo Redaksi IAI PERSIS PRESS, saya ingin konsultasi..."
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 4: Lokasi & Google Maps -->
        <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900">4. Lokasi & Google Maps Embed</h4>
                    <span class="text-[11px] text-slate-400">Peta interaktif kampus & percetakan</span>
                </div>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Judul Bagian Peta <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="contact_maps_title" 
                            value="{{ old('contact_maps_title', $settings['contact_maps_title']) }}" 
                            required 
                            placeholder="Lokasi Kampus & Percetakan"
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Link Eksternal Google Maps (Buka di Maps)</label>
                        <input 
                            type="text" 
                            name="contact_maps_external_url" 
                            value="{{ old('contact_maps_external_url', $settings['contact_maps_external_url']) }}" 
                            placeholder="https://maps.app.goo.gl/..."
                            class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">URL Iframe Embed Google Maps <span class="text-rose-500">*</span></label>
                    <textarea 
                        name="contact_maps" 
                        rows="3" 
                        required 
                        placeholder="https://www.google.com/maps/embed?pb=... atau masukkan seluruh tag <iframe src='...'></iframe>"
                        class="w-full px-3.5 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-mono text-[11px]"
                    >{{ old('contact_maps', $settings['contact_maps']) }}</textarea>
                    <span class="text-[11px] text-slate-400 mt-1 block">Bisa paste langsung link embed atau seluruh kode iframe dari fitur Share &gt; Embed Map di Google Maps.</span>
                </div>
            </div>
        </div>

        <!-- Submit Button Sticky Bottom -->
        <div class="pt-2 flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold uppercase tracking-wider transition shadow-sm hover:shadow-md">
                Simpan Semua Perubahan
            </button>
            <a href="{{ url('/kontak') }}" target="_blank" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition">
                Batal & Cek Halaman Publik
            </a>
        </div>
    </form>
@endsection
