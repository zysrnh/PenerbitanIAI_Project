@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Kontak')
@section('header_title', 'Kelola Konten & Pratinjau Halaman Kontak')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Pengaturan Konten Halaman Kontak</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Pratinjau Visual Live
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Kelola email penerima notifikasi naskah, teks kontak, dan perhatikan visualisasinya secara live.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ url('/kontak') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Halaman
            </a>
            <button type="submit" form="contactSettingsForm" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
                <i class="fa-solid fa-floppy-disk text-base"></i>
            </button>
        </div>
    </div>

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
            <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="space-y-6" id="contactSettingsForm">
                @csrf
                @method('PUT')

                <!-- 0. Email Penerima Notifikasi Baru -->
                <div class="bg-gradient-to-br from-emerald-950 to-slate-900 text-white rounded-2xl p-6 sm:p-7 shadow-sm border border-emerald-900">
                    <div class="flex items-center gap-3 pb-3 border-b border-emerald-800/60 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-[#25D366] text-white flex items-center justify-center text-base font-bold shadow-xs">
                            <i class="fa-solid fa-envelope-circle-check"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-white">Email Penerima Notifikasi Pesan / Naskah</h4>
                            <span class="text-xs text-emerald-400 font-medium">Otomatis diteruskan ke email ini setiap ada pengirim di website</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-bold text-slate-200 mb-1.5">Alamat Email Penerima <span class="text-rose-400">*</span></label>
                        <div class="relative">
                            <i class="fa-solid fa-at absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input 
                                type="email" 
                                name="notification_recipient_email" 
                                value="{{ old('notification_recipient_email', $settings['notification_recipient_email']) }}" 
                                required 
                                placeholder="hbudiman953@gmail.com"
                                class="w-full pl-10 pr-4 py-2.5 text-sm rounded-xl border border-emerald-700/80 bg-slate-950/70 text-white focus:outline-none focus:border-emerald-400 focus:ring-1 focus:ring-emerald-400 transition"
                            />
                        </div>
                        <span class="text-xs text-slate-400 mt-1.5 block">Email pengirim otomatis via SMTP: <strong class="text-emerald-300">naooolaf@gmail.com</strong>.</span>
                    </div>
                </div>

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">1. Header & Banner Halaman</h4>
                            <span class="text-xs text-slate-400">Judul utama dan deskripsi pengantar</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Badge Teks Atas <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_banner_badge" 
                                    id="in_banner_badge"
                                    value="{{ old('contact_banner_badge', $settings['contact_banner_badge']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Judul Utama Banner <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_banner_title" 
                                    id="in_banner_title"
                                    value="{{ old('contact_banner_title', $settings['contact_banner_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Deskripsi Banner <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="contact_banner_desc" 
                                id="in_banner_desc"
                                rows="3" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_banner_desc', $settings['contact_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. 4 Info Cards -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">2. Informasi 4 Kartu Kontak</h4>
                            <span class="text-xs text-slate-400">Alamat kantor, nomor WA, email, dan jam kerja</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Alamat Lengkap Kantor Redaksi <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="contact_address" 
                                id="in_address"
                                rows="2" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_address', $settings['contact_address']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Nomor WhatsApp Resmi <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_whatsapp" 
                                    id="in_whatsapp"
                                    value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Nomor Telepon Kantor <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_phone" 
                                    id="in_phone"
                                    value="{{ old('contact_phone', $settings['contact_phone']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Email Resmi Redaksi <span class="text-rose-500">*</span></label>
                                <input 
                                    type="email" 
                                    name="contact_email" 
                                    id="in_email"
                                    value="{{ old('contact_email', $settings['contact_email']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Catatan Respon Email</label>
                                <input 
                                    type="text" 
                                    name="contact_email_note" 
                                    id="in_email_note"
                                    value="{{ old('contact_email_note', $settings['contact_email_note']) }}" 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Jam Layanan Hari Kerja <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_hours" 
                                    id="in_hours"
                                    value="{{ old('contact_hours', $settings['contact_hours']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Hari Libur / Weekend</label>
                                <input 
                                    type="text" 
                                    name="contact_hours_weekend" 
                                    id="in_hours_weekend"
                                    value="{{ old('contact_hours_weekend', $settings['contact_hours_weekend']) }}" 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. WhatsApp Consultation Box -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-[#25D366]/20 text-[#128C7E] flex items-center justify-center text-base font-bold">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">3. Box Konsultasi Kilat WhatsApp</h4>
                            <span class="text-xs text-slate-400">Card WhatsApp resmi di samping form</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Judul Box <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_wa_box_title" 
                                    id="in_wa_title"
                                    value="{{ old('contact_wa_box_title', $settings['contact_wa_box_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Subjudul / Status Box <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_wa_box_subtitle" 
                                    id="in_wa_subtitle"
                                    value="{{ old('contact_wa_box_subtitle', $settings['contact_wa_box_subtitle']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Deskripsi Box <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="contact_wa_box_desc" 
                                id="in_wa_desc"
                                rows="2" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_wa_box_desc', $settings['contact_wa_box_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Teks Tombol WA <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_wa_btn_text" 
                                    id="in_wa_btn_text"
                                    value="{{ old('contact_wa_btn_text', $settings['contact_wa_btn_text']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Pesan WhatsApp Otomatis <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_wa_default_msg" 
                                    id="in_wa_msg"
                                    value="{{ old('contact_wa_default_msg', $settings['contact_wa_default_msg']) }}" 
                                    required 
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Location & Google Maps -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">4. Lokasi & Google Maps Embed</h4>
                            <span class="text-xs text-slate-400">Peta lokasi interaktif</span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Judul Bagian Peta <span class="text-rose-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="contact_maps_title" 
                                    id="in_maps_title"
                                    value="{{ old('contact_maps_title', $settings['contact_maps_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Link Eksternal Google Maps</label>
                                <input 
                                    type="text" 
                                    name="contact_maps_external_url" 
                                    id="in_maps_ext"
                                    value="{{ old('contact_maps_external_url', $settings['contact_maps_external_url']) }}" 
                                    placeholder="https://maps.app.goo.gl/..."
                                    class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">URL / Kode Iframe Google Maps <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="contact_maps" 
                                id="in_maps_src"
                                rows="3" 
                                required 
                                oninput="updateMapPreview()"
                                placeholder="https://www.google.com/maps/embed?pb=... atau tag <iframe>"
                                class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-mono text-xs"
                            >{{ old('contact_maps', $settings['contact_maps']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Action Button Sticky -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs flex items-center justify-between gap-4">
        <span class="text-xs text-slate-500 font-medium">Perubahan langsung aktif di website publik setelah disimpan.</span>
        <button type="submit" title="Simpan Perubahan" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl transition shadow-xs hover:shadow-md flex items-center justify-center">
            <i class="fa-solid fa-floppy-disk text-base"></i>
        </button>
    </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: LARGE & SPACIOUS LIVE PREVIEW MOCKUP -->
        <div class="xl:col-span-6 sticky top-20 space-y-4">
            
            <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 shadow-lg flex items-center justify-between text-white">
                <div class="flex items-center gap-3">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                    </div>
                    <span class="text-sm font-bold tracking-wide text-white">Pratinjau Visual Halaman Kontak</span>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-800 text-emerald-400 border border-slate-700">Real-time Mockup</span>
            </div>

            <!-- Visual Preview Canvas -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-md overflow-hidden text-slate-800 space-y-5 p-6">
                
                <!-- Mockup 1: Dark Header Banner -->
                <div class="bg-[#032c21] text-white p-6 rounded-2xl shadow-sm">
                    <span id="prev_badge" class="text-xs font-extrabold text-emerald-400 uppercase tracking-widest block mb-1.5">
                        {{ $settings['contact_banner_badge'] }}
                    </span>
                    <h4 id="prev_title" class="font-extrabold text-lg sm:text-xl text-white leading-tight">
                        {{ $settings['contact_banner_title'] }}
                    </h4>
                    <p id="prev_desc" class="text-xs text-slate-300 mt-2 leading-relaxed">
                        {{ $settings['contact_banner_desc'] }}
                    </p>
                </div>

                <!-- Mockup 2: 4 Info Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 text-xs">
                    <!-- Alamat -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center gap-2 text-emerald-700 font-bold text-xs mb-1">
                            <i class="fa-solid fa-location-dot text-sm"></i> <span>Kantor Redaksi</span>
                        </div>
                        <p id="prev_address" class="text-slate-700 text-xs leading-relaxed font-normal mt-1">
                            {{ $settings['contact_address'] }}
                        </p>
                    </div>

                    <!-- WhatsApp -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center gap-2 text-emerald-700 font-bold text-xs mb-1">
                            <i class="fa-brands fa-whatsapp text-base text-[#25D366]"></i> <span>WhatsApp & Telepon</span>
                        </div>
                        <span id="prev_whatsapp" class="text-slate-900 font-bold text-xs block mt-1">{{ $settings['contact_whatsapp'] }}</span>
                        <span id="prev_phone" class="text-slate-500 text-xs block">{{ $settings['contact_phone'] }}</span>
                    </div>

                    <!-- Email -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center gap-2 text-emerald-700 font-bold text-xs mb-1">
                            <i class="fa-solid fa-envelope text-sm"></i> <span>Email Resmi</span>
                        </div>
                        <span id="prev_email" class="text-slate-900 font-bold text-xs block mt-1 truncate">{{ $settings['contact_email'] }}</span>
                        <span id="prev_email_note" class="text-slate-500 text-xs block mt-0.5">{{ $settings['contact_email_note'] }}</span>
                    </div>

                    <!-- Jam Kerja -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center gap-2 text-emerald-700 font-bold text-xs mb-1">
                            <i class="fa-solid fa-clock text-sm"></i> <span>Jam Layanan</span>
                        </div>
                        <span id="prev_hours" class="text-slate-900 font-bold text-xs block mt-1">{{ $settings['contact_hours'] }}</span>
                        <span id="prev_hours_weekend" class="text-slate-500 text-xs block mt-0.5">{{ $settings['contact_hours_weekend'] }}</span>
                    </div>
                </div>

                <!-- Mockup 3: WhatsApp Fast Consultation Box -->
                <div class="bg-[#032c21] text-white p-5 rounded-2xl border border-emerald-950 shadow-sm">
                    <div class="flex items-center gap-3 mb-2.5">
                        <div class="w-9 h-9 rounded-xl bg-[#25D366] text-white flex items-center justify-center text-lg shrink-0 shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h5 id="prev_wa_title" class="font-bold text-sm leading-tight text-white">{{ $settings['contact_wa_box_title'] }}</h5>
                            <span id="prev_wa_subtitle" class="text-xs text-emerald-400 font-medium block mt-0.5">{{ $settings['contact_wa_box_subtitle'] }}</span>
                        </div>
                    </div>
                    <p id="prev_wa_desc" class="text-xs text-slate-300 leading-relaxed mb-3.5">
                        {{ $settings['contact_wa_box_desc'] }}
                    </p>
                    <div class="w-full py-2.5 bg-[#25D366] text-white rounded-xl font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center gap-2 shadow-xs">
                        <i class="fa-brands fa-whatsapp text-base"></i> <span id="prev_wa_btn_text">{{ $settings['contact_wa_btn_text'] }}</span>
                    </div>
                </div>

                <!-- Mockup 4: Google Maps Frame -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <div class="flex items-center justify-between mb-3">
                        <span id="prev_maps_title" class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-map-location-dot text-emerald-600"></i> {{ $settings['contact_maps_title'] }}
                        </span>
                        <span class="text-xs text-emerald-700 font-bold">Interactive Map</span>
                    </div>
                    <div class="w-full h-52 rounded-xl overflow-hidden border border-slate-200 bg-slate-100 shadow-inner">
                        <iframe 
                            id="prev_map_frame"
                            src="{{ $settings['contact_maps'] }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            loading="lazy"
                        ></iframe>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Live Synchronizer JS -->
    <script>
        function updatePreview() {
            document.getElementById('prev_badge').textContent = document.getElementById('in_banner_badge').value || 'Badge';
            document.getElementById('prev_title').textContent = document.getElementById('in_banner_title').value || 'Judul Banner';
            document.getElementById('prev_desc').textContent = document.getElementById('in_banner_desc').value || 'Deskripsi banner...';

            document.getElementById('prev_address').textContent = document.getElementById('in_address').value || 'Alamat Kantor';
            document.getElementById('prev_whatsapp').textContent = document.getElementById('in_whatsapp').value || '-';
            document.getElementById('prev_phone').textContent = document.getElementById('in_phone').value || '-';
            document.getElementById('prev_email').textContent = document.getElementById('in_email').value || '-';
            document.getElementById('prev_email_note').textContent = document.getElementById('in_email_note').value || '';
            document.getElementById('prev_hours').textContent = document.getElementById('in_hours').value || '-';
            document.getElementById('prev_hours_weekend').textContent = document.getElementById('in_hours_weekend').value || '';

            document.getElementById('prev_wa_title').textContent = document.getElementById('in_wa_title').value || 'Konsultasi WhatsApp';
            document.getElementById('prev_wa_subtitle').textContent = document.getElementById('in_wa_subtitle').value || 'Tim Redaksi';
            document.getElementById('prev_wa_desc').textContent = document.getElementById('in_wa_desc').value || 'Deskripsi box...';
            document.getElementById('prev_wa_btn_text').textContent = document.getElementById('in_wa_btn_text').value || 'CHAT WHATSAPP';

            document.getElementById('prev_maps_title').innerHTML = '<i class="fa-solid fa-map-location-dot text-emerald-600 mr-1"></i> ' + (document.getElementById('in_maps_title').value || 'Lokasi Kampus');
        }

        function updateMapPreview() {
            let srcVal = document.getElementById('in_maps_src').value;
            if (srcVal.includes('src=')) {
                let match = srcVal.match(/src=["'](.*?)["']/);
                if (match && match[1]) {
                    srcVal = match[1];
                }
            }
            if (srcVal.startsWith('http')) {
                document.getElementById('prev_map_frame').src = srcVal;
            }
        }
    </script>
@endsection
