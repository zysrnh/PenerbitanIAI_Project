@extends('admin.layouts.app')

@section('title', 'Kelola Halaman Kontak')
@section('header_title', 'Kelola Konten & Pratinjau Halaman Kontak')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h3 class="text-base font-bold text-slate-900">Pengaturan Konten Halaman Kontak</h3>
                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live Preview Aktif
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">Ubah teks formulir di sebelah kiri dan lihat hasil visualisasinya secara langsung di panel sebelah kanan.</p>
        </div>

        <div class="flex items-center gap-2.5">
            <a href="{{ url('/kontak') }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-lg text-xs font-semibold transition flex items-center gap-1.5 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i> Buka Halaman Publik
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs font-medium flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
            @foreach($errors->all() as $error)
                <div>&bull; {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- Main Grid: Form Left (7 cols), Visual Live Preview Right (5 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- LEFT COLUMN: FORM INPUTS -->
        <div class="lg:col-span-7 space-y-6">
            <form method="POST" action="{{ route('admin.settings.contact.update') }}" class="space-y-6" id="contactSettingsForm">
                @csrf
                @method('PUT')

                <!-- 1. Header Banner -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-5 sm:p-6">
                    <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-heading"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">1. Header & Banner Halaman</h4>
                            <span class="text-[11px] text-slate-400">Bagian judul paling atas</span>
                        </div>
                    </div>

                    <div class="space-y-3.5">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Badge Teks</label>
                                <input 
                                    type="text" 
                                    name="contact_banner_badge" 
                                    id="in_banner_badge"
                                    value="{{ old('contact_banner_badge', $settings['contact_banner_badge']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Utama Banner</label>
                                <input 
                                    type="text" 
                                    name="contact_banner_title" 
                                    id="in_banner_title"
                                    value="{{ old('contact_banner_title', $settings['contact_banner_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Banner</label>
                            <textarea 
                                name="contact_banner_desc" 
                                id="in_banner_desc"
                                rows="2" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_banner_desc', $settings['contact_banner_desc']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. 4 Info Cards -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-5 sm:p-6">
                    <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-address-card"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">2. Informasi 4 Kartu Cepat</h4>
                            <span class="text-[11px] text-slate-400">Alamat, nomor WA, email, dan jam kerja</span>
                        </div>
                    </div>

                    <div class="space-y-3.5">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Kantor Redaksi</label>
                            <textarea 
                                name="contact_address" 
                                id="in_address"
                                rows="2" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_address', $settings['contact_address']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp Resmi</label>
                                <input 
                                    type="text" 
                                    name="contact_whatsapp" 
                                    id="in_whatsapp"
                                    value="{{ old('contact_whatsapp', $settings['contact_whatsapp']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon Kampus</label>
                                <input 
                                    type="text" 
                                    name="contact_phone" 
                                    id="in_phone"
                                    value="{{ old('contact_phone', $settings['contact_phone']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Resmi</label>
                                <input 
                                    type="email" 
                                    name="contact_email" 
                                    id="in_email"
                                    value="{{ old('contact_email', $settings['contact_email']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Respon Email</label>
                                <input 
                                    type="text" 
                                    name="contact_email_note" 
                                    id="in_email_note"
                                    value="{{ old('contact_email_note', $settings['contact_email_note']) }}" 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Jam Kerja Operasional</label>
                                <input 
                                    type="text" 
                                    name="contact_hours" 
                                    id="in_hours"
                                    value="{{ old('contact_hours', $settings['contact_hours']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Hari Libur / Weekend</label>
                                <input 
                                    type="text" 
                                    name="contact_hours_weekend" 
                                    id="in_hours_weekend"
                                    value="{{ old('contact_hours_weekend', $settings['contact_hours_weekend']) }}" 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. WhatsApp Fast Box -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-5 sm:p-6">
                    <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-[#25D366]/15 text-[#128C7E] flex items-center justify-center text-xs">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">3. Box Konsultasi Kilat WhatsApp</h4>
                            <span class="text-[11px] text-slate-400">Card WhatsApp resmi di samping form</span>
                        </div>
                    </div>

                    <div class="space-y-3.5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Box</label>
                                <input 
                                    type="text" 
                                    name="contact_wa_box_title" 
                                    id="in_wa_title"
                                    value="{{ old('contact_wa_box_title', $settings['contact_wa_box_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Subjudul / Status</label>
                                <input 
                                    type="text" 
                                    name="contact_wa_box_subtitle" 
                                    id="in_wa_subtitle"
                                    value="{{ old('contact_wa_box_subtitle', $settings['contact_wa_box_subtitle']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Box</label>
                            <textarea 
                                name="contact_wa_box_desc" 
                                id="in_wa_desc"
                                rows="2" 
                                required 
                                oninput="updatePreview()"
                                class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            >{{ old('contact_wa_box_desc', $settings['contact_wa_box_desc']) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Tombol WhatsApp</label>
                                <input 
                                    type="text" 
                                    name="contact_wa_btn_text" 
                                    id="in_wa_btn_text"
                                    value="{{ old('contact_wa_btn_text', $settings['contact_wa_btn_text']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Pesan WhatsApp Otomatis</label>
                                <input 
                                    type="text" 
                                    name="contact_wa_default_msg" 
                                    id="in_wa_msg"
                                    value="{{ old('contact_wa_default_msg', $settings['contact_wa_default_msg']) }}" 
                                    required 
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Location & Google Maps -->
                <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-5 sm:p-6">
                    <div class="flex items-center gap-2.5 pb-3.5 border-b border-slate-100 mb-4">
                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">4. Lokasi & Google Maps Embed</h4>
                            <span class="text-[11px] text-slate-400">Peta lokasi interaktif</span>
                        </div>
                    </div>

                    <div class="space-y-3.5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Peta</label>
                                <input 
                                    type="text" 
                                    name="contact_maps_title" 
                                    id="in_maps_title"
                                    value="{{ old('contact_maps_title', $settings['contact_maps_title']) }}" 
                                    required 
                                    oninput="updatePreview()"
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Link Eksternal Google Maps</label>
                                <input 
                                    type="text" 
                                    name="contact_maps_external_url" 
                                    id="in_maps_ext"
                                    value="{{ old('contact_maps_external_url', $settings['contact_maps_external_url']) }}" 
                                    placeholder="https://maps.app.goo.gl/..."
                                    class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">URL / Kode Iframe Google Maps</label>
                            <textarea 
                                name="contact_maps" 
                                id="in_maps_src"
                                rows="2" 
                                required 
                                oninput="updateMapPreview()"
                                placeholder="https://www.google.com/maps/embed?pb=... atau tag <iframe>"
                                class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition font-mono text-[11px]"
                            >{{ old('contact_maps', $settings['contact_maps']) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2 sticky bottom-4 z-20">
                    <div class="bg-white/95 backdrop-blur-md p-3.5 rounded-xl border border-slate-200 shadow-lg flex items-center justify-between gap-3">
                        <span class="text-xs text-slate-500 hidden sm:block">Perubahan akan langsung aktif secara instan.</span>
                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold uppercase tracking-wider transition shadow-xs flex items-center justify-center gap-2">
                            <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Semua Perubahan
                        </button>
                    </div>
                </div>

            </form>
        </div>

        <!-- RIGHT COLUMN: INTERACTIVE VISUAL LIVE PREVIEW MOCKUP -->
        <div class="lg:col-span-5 sticky top-20 space-y-4">
            <div class="bg-slate-900 rounded-xl p-3 border border-slate-800 shadow-md flex items-center justify-between text-white">
                <div class="flex items-center gap-2">
                    <div class="flex gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    </div>
                    <span class="text-xs font-bold tracking-wider ml-1 text-slate-200">Pratinjau Visual Halaman Kontak</span>
                </div>
                <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-800 text-emerald-400 border border-slate-700">Real-time Mockup</span>
            </div>

            <!-- Visual Preview Container -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden text-slate-800 space-y-4 p-4">
                
                <!-- Mockup 1: Dark Header Banner -->
                <div class="bg-[#032c21] text-white p-4 rounded-xl shadow-xs">
                    <span id="prev_badge" class="text-[9px] font-extrabold text-emerald-400 uppercase tracking-widest block mb-1">
                        {{ $settings['contact_banner_badge'] }}
                    </span>
                    <h4 id="prev_title" class="font-extrabold text-sm text-white leading-tight">
                        {{ $settings['contact_banner_title'] }}
                    </h4>
                    <p id="prev_desc" class="text-[10px] text-slate-300 mt-1 leading-relaxed line-clamp-2">
                        {{ $settings['contact_banner_desc'] }}
                    </p>
                </div>

                <!-- Mockup 2: 4 Info Cards Grid -->
                <div class="grid grid-cols-2 gap-2 text-[10px]">
                    <!-- Alamat -->
                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/70">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold text-[10px] mb-0.5">
                            <i class="fa-solid fa-location-dot"></i> <span>Kantor Redaksi</span>
                        </div>
                        <p id="prev_address" class="text-slate-600 line-clamp-2 leading-tight">
                            {{ $settings['contact_address'] }}
                        </p>
                    </div>

                    <!-- WhatsApp -->
                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/70">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold text-[10px] mb-0.5">
                            <i class="fa-brands fa-whatsapp text-[#25D366]"></i> <span>WhatsApp</span>
                        </div>
                        <span id="prev_whatsapp" class="text-slate-900 font-bold block truncate">{{ $settings['contact_whatsapp'] }}</span>
                        <span id="prev_phone" class="text-slate-400 block truncate">{{ $settings['contact_phone'] }}</span>
                    </div>

                    <!-- Email -->
                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/70">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold text-[10px] mb-0.5">
                            <i class="fa-solid fa-envelope"></i> <span>Email Resmi</span>
                        </div>
                        <span id="prev_email" class="text-slate-900 font-bold block truncate">{{ $settings['contact_email'] }}</span>
                        <span id="prev_email_note" class="text-slate-400 block truncate">{{ $settings['contact_email_note'] }}</span>
                    </div>

                    <!-- Jam Kerja -->
                    <div class="p-2.5 rounded-lg bg-slate-50 border border-slate-200/70">
                        <div class="flex items-center gap-1.5 text-emerald-700 font-bold text-[10px] mb-0.5">
                            <i class="fa-solid fa-clock"></i> <span>Jam Layanan</span>
                        </div>
                        <span id="prev_hours" class="text-slate-900 font-bold block truncate">{{ $settings['contact_hours'] }}</span>
                        <span id="prev_hours_weekend" class="text-slate-400 block truncate">{{ $settings['contact_hours_weekend'] }}</span>
                    </div>
                </div>

                <!-- Mockup 3: WhatsApp Consultation Box -->
                <div class="bg-[#032c21] text-white p-3.5 rounded-xl border border-emerald-950">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-6 h-6 rounded-md bg-[#25D366] text-white flex items-center justify-center text-xs shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <h5 id="prev_wa_title" class="font-bold text-xs leading-none text-white">{{ $settings['contact_wa_box_title'] }}</h5>
                            <span id="prev_wa_subtitle" class="text-[9px] text-emerald-400 font-medium block mt-0.5">{{ $settings['contact_wa_box_subtitle'] }}</span>
                        </div>
                    </div>
                    <p id="prev_wa_desc" class="text-[10px] text-slate-300 leading-tight mb-2.5 line-clamp-2">
                        {{ $settings['contact_wa_box_desc'] }}
                    </p>
                    <div class="w-full py-2 bg-[#25D366] text-white rounded-lg font-bold text-[10px] uppercase text-center flex items-center justify-center gap-1.5 shadow-xs">
                        <i class="fa-brands fa-whatsapp"></i> <span id="prev_wa_btn_text">{{ $settings['contact_wa_btn_text'] }}</span>
                    </div>
                </div>

                <!-- Mockup 4: Google Maps Live Frame -->
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                    <div class="flex items-center justify-between mb-2">
                        <span id="prev_maps_title" class="text-[10px] font-bold text-slate-800 uppercase flex items-center gap-1">
                            <i class="fa-solid fa-map-location-dot text-emerald-600"></i> {{ $settings['contact_maps_title'] }}
                        </span>
                        <span class="text-[9px] text-emerald-700 font-semibold">Interactive Map</span>
                    </div>
                    <div class="w-full h-36 rounded-lg overflow-hidden border border-slate-200 bg-slate-100">
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

    <!-- Vanilla JS Live Preview Synchronizer -->
    <script>
        function updatePreview() {
            // Banner
            document.getElementById('prev_badge').textContent = document.getElementById('in_banner_badge').value || 'Badge';
            document.getElementById('prev_title').textContent = document.getElementById('in_banner_title').value || 'Judul Banner';
            document.getElementById('prev_desc').textContent = document.getElementById('in_banner_desc').value || 'Deskripsi banner...';

            // 4 Info Cards
            document.getElementById('prev_address').textContent = document.getElementById('in_address').value || 'Alamat Kantor';
            document.getElementById('prev_whatsapp').textContent = document.getElementById('in_whatsapp').value || '-';
            document.getElementById('prev_phone').textContent = document.getElementById('in_phone').value || '-';
            document.getElementById('prev_email').textContent = document.getElementById('in_email').value || '-';
            document.getElementById('prev_email_note').textContent = document.getElementById('in_email_note').value || '';
            document.getElementById('prev_hours').textContent = document.getElementById('in_hours').value || '-';
            document.getElementById('prev_hours_weekend').textContent = document.getElementById('in_hours_weekend').value || '';

            // WA Box
            document.getElementById('prev_wa_title').textContent = document.getElementById('in_wa_title').value || 'Konsultasi WhatsApp';
            document.getElementById('prev_wa_subtitle').textContent = document.getElementById('in_wa_subtitle').value || 'Tim Redaksi';
            document.getElementById('prev_wa_desc').textContent = document.getElementById('in_wa_desc').value || 'Deskripsi box...';
            document.getElementById('prev_wa_btn_text').textContent = document.getElementById('in_wa_btn_text').value || 'CHAT WHATSAPP';

            // Maps Title
            document.getElementById('prev_maps_title').innerHTML = '<i class="fa-solid fa-map-location-dot text-emerald-600 mr-1"></i> ' + (document.getElementById('in_maps_title').value || 'Lokasi Kampus');
        }

        function updateMapPreview() {
            let srcVal = document.getElementById('in_maps_src').value;
            // extract src if full iframe tag is pasted
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
