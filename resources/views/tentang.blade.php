@extends('layouts.app')

@section('title', 'Tentang Kami | IAI PERSIS PRESS')

@section('content')
    <!-- Hero Banner -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">{{ $about['banner_badge'] ?? '' }}</span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl">
                {{ $about['banner_title'] ?? '' }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-2xl leading-relaxed">
                {{ $about['banner_desc'] ?? '' }}
            </p>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">{{ $about['stat_books'] ?? '' }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Judul Buku Terbit</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">{{ $about['stat_authors'] ?? '' }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Penulis & Dosen</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">{{ $about['stat_isbn'] ?? '' }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Legalitas ISBN Resmi</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">{{ $about['stat_copies'] ?? '' }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Eksemplar Tercetak</span>
            </div>
        </div>
    </section>

    <!-- Profil & Sejarah Section -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Content Narrative -->
                <div class="lg:col-span-7 space-y-5 reveal-card">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block">Profil & Kilas Sejarah</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight leading-snug">
                        {{ $about['profile_title'] ?? '' }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $about['profile_story_1'] ?? '' }}
                    </p>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $about['profile_story_2'] ?? '' }}
                    </p>

                    <!-- Feature checkmarks -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                        <div class="flex items-center gap-2.5 text-xs text-slate-800 font-semibold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>{{ $about['about_feature_1'] ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-800 font-semibold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>{{ $about['about_feature_2'] ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-800 font-semibold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>{{ $about['about_feature_3'] ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2.5 text-xs text-slate-800 font-semibold">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <span>{{ $about['about_feature_4'] ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Visual Highlights Box -->
                <div class="lg:col-span-5 reveal-card">
                    <div class="bg-gradient-to-br from-brand-950 via-brand-900 to-emerald-950 rounded-3xl p-7 text-white shadow-xl border border-brand-900 relative overflow-hidden">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400 text-xl mb-5 shadow-sm">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-1">Naungan Resmi</span>
                        <h3 class="text-xl font-extrabold font-heading text-white mb-3">Institut Agama Islam Persatuan Islam Bandung</h3>
                        <p class="text-xs text-slate-300 leading-relaxed mb-6">
                            Menghadirkan karya tulis ilmiah berkualitas yang berlandaskan Al-Qur'an dan As-Sunnah serta responsif terhadap perkembangan sains dan peradaban zaman.
                        </p>

                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 backdrop-blur-xs flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-lg bg-[#25D366] text-white flex items-center justify-center text-xl shrink-0">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <span class="text-[11px] text-slate-300 block">Konsultasi Penerbitan Naskah:</span>
                                <a href="{{ route('kontak') }}" class="text-xs font-bold text-white hover:text-emerald-400 transition flex items-center gap-1">
                                    Hubungi Tim Redaksi &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section class="py-16 sm:py-20 bg-slate-50 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Arah & Panduan Langkah</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">Visi & Misi Lembaga</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Visi Box -->
                <div class="lg:col-span-5 bg-white p-7 sm:p-8 rounded-3xl border border-slate-200 shadow-sm reveal-card flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mb-5">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <span class="text-xs font-extrabold text-emerald-700 uppercase tracking-widest block mb-2">Visi Kami</span>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900 font-heading leading-relaxed">
                            "{{ $about['vision'] ?? '' }}"
                        </h3>
                    </div>
                    <div class="pt-6 mt-6 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-slate-500">
                        <i class="fa-solid fa-flag-checkered text-emerald-600"></i> Target Capaian Tahun 2030
                    </div>
                </div>

                <!-- Misi List -->
                <div class="lg:col-span-7 bg-white p-7 sm:p-8 rounded-3xl border border-slate-200 shadow-sm reveal-card">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <span class="text-xs font-extrabold text-blue-700 uppercase tracking-widest block mb-4">4 Pilar Misi Kami</span>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_1'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_2'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_3'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_4'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Core Values -->
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Prinsip & Budaya Kerja</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">Nilai-Nilai Utama (Core Values)</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 reveal-card hover:border-emerald-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Integritas Akademik</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Menjunjung tinggi etika keilmuan, bebas plagiarisme, dan proses review yang independen.</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 reveal-card hover:border-emerald-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Kualitas & Presisi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Standar tata letak, pemilihan kertas, dan penjilidan berkualitas tinggi berstandar industri.</p>
                </div>

                <!-- Value 3 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 reveal-card hover:border-emerald-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Amanah & Pelayanan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Mendampingi penulis secara komunikatif dan transparan sejak draf naskah hingga buku siap didistribusikan.</p>
                </div>

                <!-- Value 4 -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 reveal-card hover:border-emerald-500 transition">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-800 flex items-center justify-center text-lg mb-4">
                        <i class="fa-solid fa-book-quran"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5">Literasi Islam & Dakwah</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Menyebarluaskan khazanah keislaman dan peradaban yang mencerahkan ummat dan bangsa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Tim Pengelola / Dewan Redaksi -->
    <section class="py-16 sm:py-20 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Struktur Pengelola</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">Dewan Redaksi & Tim Produksi</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Dikelola oleh tenaga profesional dan akademisi berdedikasi tinggi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <!-- Person 1: Director -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm reveal-card text-center">
                    <div class="w-16 h-16 rounded-full bg-brand-900 text-emerald-400 font-bold text-xl flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500/40">
                        {{ strtoupper(substr($about['about_director_name'] ?? ($about['about_director_name'] ?? ($about['director_name'] ?? '') ?? 'A'), 0, 1)) }}
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">{{ $about['about_director_name'] ?? ($about['director_name'] ?? '') ?? '' }}</h3>
                    <span class="text-xs text-emerald-700 font-semibold block mt-0.5">{{ $about['about_director_title'] ?? ($about['director_title'] ?? '') ?? '' }}</span>
                </div>

                <!-- Person 2: Editor Chief -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm reveal-card text-center">
                    <div class="w-16 h-16 rounded-full bg-brand-900 text-emerald-400 font-bold text-xl flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500/40">
                        {{ strtoupper(substr($about['about_editor_chief'] ?? ($about['about_editor_chief'] ?? ($about['editor_chief'] ?? '') ?? 'E'), 0, 1)) }}
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">{{ $about['about_editor_chief'] ?? ($about['editor_chief'] ?? '') ?? '' }}</h3>
                    <span class="text-xs text-emerald-700 font-semibold block mt-0.5">{{ $about['about_editor_chief_title'] ?? ($about['editor_chief_title'] ?? '') ?? '' }}</span>
                </div>

                <!-- Person 3: Production Lead -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm reveal-card text-center">
                    <div class="w-16 h-16 rounded-full bg-brand-900 text-emerald-400 font-bold text-xl flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500/40">
                        {{ strtoupper(substr($about['about_production_lead'] ?? ($about['about_production_lead'] ?? ($about['production_lead'] ?? '') ?? 'P'), 0, 1)) }}
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">{{ $about['about_production_lead'] ?? ($about['production_lead'] ?? '') ?? '' }}</h3>
                    <span class="text-xs text-emerald-700 font-semibold block mt-0.5">{{ $about['about_production_lead_title'] ?? ($about['production_lead_title'] ?? '') ?? '' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-14 sm:py-16 bg-brand-950 text-white border-t border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">Publikasikan Karya Anda Bersama Kami</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold font-heading text-white max-w-2xl mx-auto">
                Siap Menerbitkan Naskah Buku & Karya Ilmiah Anda?
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-xl mx-auto leading-relaxed">
                Tim redaksi kami siap mendampingi proses penerbitan buku ber-ISBN secara mudah, profesional, dan terjangkau.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('kontak') }}" class="px-6 py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl font-bold text-xs uppercase tracking-wider transition shadow-sm flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-base"></i> Konsultasi Naskah Sekarang
                </a>
                <a href="{{ url('/#layanan') }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-xl font-bold text-xs uppercase tracking-wider transition border border-white/20">
                    Lihat Paket Layanan
                </a>
            </div>
        </div>
    </section>
@endsection
