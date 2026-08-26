@extends('layouts.app')

@section('title', 'Tentang Kami | PERSIS PERS')

@section('content')
    <!-- Hero Banner -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">{{ $about['about_banner_badge'] ?? ($about['banner_badge'] ?? 'Mengenal Lembaga') }}</span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl">
                {{ $about['about_banner_title'] ?? ($about['banner_title'] ?? 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah') }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-2xl leading-relaxed">
                {{ $about['about_banner_desc'] ?? ($about['banner_desc'] ?? '') }}
            </p>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">{{ $about['about_stat_books'] ?? ($about['stat_books'] ?? '150+') }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Judul Buku Terbit</span>
            </div>
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">{{ $about['about_stat_authors'] ?? ($about['stat_authors'] ?? '80+') }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Penulis & Dosen</span>
            </div>
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">{{ $about['about_stat_isbn'] ?? ($about['stat_isbn'] ?? '100%') }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Legalitas ISBN Resmi</span>
            </div>
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-md reveal-card text-center">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">{{ $about['about_stat_copies'] ?? ($about['stat_copies'] ?? '25.000+') }}</span>
                <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Eksemplar Tercetak</span>
            </div>
        </div>
    </section>

    <!-- Profil & Sejarah Section -->
    <section class="py-14 sm:py-18 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block">Profil &amp; Kilas Sejarah</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight leading-snug">
                    {{ $about['about_profile_title'] ?? ($about['profile_title'] ?? 'Komitmen Membangun Peradaban Literasi & Riset Akademik') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed text-justify">
                    {{ $about['about_profile_story_1'] ?? ($about['profile_story_1'] ?? '') }}
                </p>
                <p class="text-xs sm:text-sm text-slate-700 leading-relaxed text-justify">
                    {{ $about['about_profile_story_2'] ?? ($about['profile_story_2'] ?? '') }}
                </p>
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
                <div class="lg:col-span-5 bg-white p-7 sm:p-8 rounded-sm border border-slate-200 shadow-sm reveal-card flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mb-5">
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
                <div class="lg:col-span-7 bg-white p-7 sm:p-8 rounded-sm border border-slate-200 shadow-sm reveal-card">
                    <div class="w-12 h-12 rounded-sm bg-blue-50 text-blue-700 flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <span class="text-xs font-extrabold text-blue-700 uppercase tracking-widest block mb-4">4 Pilar Misi Kami</span>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3.5 p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_1'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_2'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_3'] ?? '' }}</p>
                        </div>
                        <div class="flex items-start gap-3.5 p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/60">
                            <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                            <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium">{{ $about['mission_4'] ?? '' }}</p>
                        </div>
                    </div>
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
                <div class="bg-white p-6 rounded-sm border border-slate-200 shadow-sm reveal-card text-center">
                    <div class="w-16 h-16 rounded-full bg-brand-900 text-emerald-400 font-bold text-xl flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500/40">
                        {{ strtoupper(substr($about['about_director_name'] ?? ($about['about_director_name'] ?? ($about['director_name'] ?? '') ?? 'A'), 0, 1)) }}
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">{{ $about['about_director_name'] ?? ($about['director_name'] ?? '') ?? '' }}</h3>
                    <span class="text-xs text-emerald-700 font-semibold block mt-0.5">{{ $about['about_director_title'] ?? ($about['director_title'] ?? '') ?? '' }}</span>
                </div>

                <!-- Person 2: Editor Chief -->
                <div class="bg-white p-6 rounded-sm border border-slate-200 shadow-sm reveal-card text-center">
                    <div class="w-16 h-16 rounded-full bg-brand-900 text-emerald-400 font-bold text-xl flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500/40">
                        {{ strtoupper(substr($about['about_editor_chief'] ?? ($about['about_editor_chief'] ?? ($about['editor_chief'] ?? '') ?? 'E'), 0, 1)) }}
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">{{ $about['about_editor_chief'] ?? ($about['editor_chief'] ?? '') ?? '' }}</h3>
                    <span class="text-xs text-emerald-700 font-semibold block mt-0.5">{{ $about['about_editor_chief_title'] ?? ($about['editor_chief_title'] ?? '') ?? '' }}</span>
                </div>

                <!-- Person 3: Production Lead -->
                <div class="bg-white p-6 rounded-sm border border-slate-200 shadow-sm reveal-card text-center">
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
                <a href="{{ route('kontak') }}" class="px-6 py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm font-bold text-xs uppercase tracking-wider transition shadow-sm flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-base"></i> Konsultasi Naskah Sekarang
                </a>
                <a href="{{ url('/#layanan') }}" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-sm font-bold text-xs uppercase tracking-wider transition border border-white/20">
                    Lihat Paket Layanan
                </a>
            </div>
        </div>
    </section>
@endsection
