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

    

    <!-- Struktur Organisasi Resmi Penerbit Persis (Desain Eksekutif & Elegan Human-Crafted) -->
    <section class="py-16 sm:py-24 bg-slate-50 border-t border-slate-200/90 relative overflow-hidden">
        <!-- Background subtle accent decoration -->
        <div class="absolute top-0 inset-x-0 h-40 bg-gradient-to-b from-emerald-50/50 to-transparent pointer-events-none"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-100/70 border border-emerald-300 text-[#006830] text-xs font-bold uppercase tracking-wider mb-3 shadow-2xs">
                    <i class="fa-solid fa-sitemap text-emerald-700 text-xs"></i> Tata Kelola Lembaga
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 font-heading tracking-tight">
                    Struktur Organisasi Penerbit Persis
                </h2>
                <div class="w-16 h-1 bg-[#006830] mx-auto mt-3 rounded-full"></div>
                <p class="text-xs sm:text-sm text-slate-600 mt-3 max-w-xl mx-auto leading-relaxed">
                    Susunan dewan pengawas, kepemimpinan direksi, dan jajaran manajemen operasional Penerbitan Persatuan Islam (PERSIS PERS).
                </p>
            </div>

            <!-- ORGANIZATIONAL HIERARCHY -->
            <div class="space-y-10 sm:space-y-12">
                
                <!-- TIER 1: PENANGGUNG JAWAB -->
                <div class="flex flex-col items-center">
                    <div class="w-full max-w-md bg-white rounded-sm border-2 border-emerald-700/80 shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden group">
                        <!-- Card Header Ribbon -->
                        <div class="bg-[#006830] px-4 py-2 flex items-center justify-between text-white">
                            <span class="text-[10px] sm:text-[11px] font-bold uppercase tracking-widest text-emerald-100 flex items-center gap-1.5">
                                <i class="fa-solid fa-landmark text-amber-300 text-xs"></i> Penanggung Jawab
                            </span>
                            <span class="text-[10px] font-semibold px-2 py-0.5 bg-white/15 rounded-xs text-white">
                                Pimpinan Pusat PERSIS
                            </span>
                        </div>
                        <!-- Card Body -->
                        <div class="p-5 sm:p-6 text-center bg-gradient-to-b from-white to-slate-50/60">
                            <div class="w-14 h-14 rounded-full bg-emerald-50 border-2 border-emerald-200 text-[#006830] flex items-center justify-center text-xl mx-auto mb-3.5 shadow-2xs group-hover:scale-105 transition-transform duration-200">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                Dr. Jeje Zaenudin
                            </h3>
                            <div class="inline-block mt-1.5 px-3 py-0.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold">
                                Ketua Umum PP PERSIS
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TIER 2: DEWAN PENGAWAS -->
                <div>
                    <!-- Category Title Divider -->
                    <div class="flex items-center gap-4 mb-6 max-w-4xl mx-auto">
                        <div class="h-px bg-slate-200 flex-1"></div>
                        <div class="flex items-center gap-2 px-3 py-1 rounded-sm bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider border border-slate-200/90">
                            <i class="fa-solid fa-shield-halved text-emerald-700"></i> Dewan Pengawas
                        </div>
                        <div class="h-px bg-slate-200 flex-1"></div>
                    </div>

                    <!-- 3 Pengawas Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 max-w-4xl mx-auto">
                        <!-- Pengawas 1 -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 text-slate-600 group-hover:bg-emerald-50 group-hover:text-[#006830] group-hover:border-emerald-200 flex items-center justify-center text-base mx-auto mb-3 transition-colors">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Pengawas</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">
                                Dr. Ihsan Setiadi Latief
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-1">Dewan Pengawas Penerbit Persis</p>
                        </div>

                        <!-- Pengawas 2 -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 text-slate-600 group-hover:bg-emerald-50 group-hover:text-[#006830] group-hover:border-emerald-200 flex items-center justify-center text-base mx-auto mb-3 transition-colors">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Pengawas</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">
                                Jejen Jaenudin, M.Pd
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-1">Dewan Pengawas Penerbit Persis</p>
                        </div>

                        <!-- Pengawas 3 -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-11 h-11 rounded-full bg-slate-100 border border-slate-200 text-slate-600 group-hover:bg-emerald-50 group-hover:text-[#006830] group-hover:border-emerald-200 flex items-center justify-center text-base mx-auto mb-3 transition-colors">
                                <i class="fa-solid fa-user-check"></i>
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Pengawas</span>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 leading-snug">
                                Ginanjar Nugraha, M.Sy
                            </h4>
                            <p class="text-[11px] text-slate-500 mt-1">Dewan Pengawas Penerbit Persis</p>
                        </div>
                    </div>
                </div>

                <!-- TIER 3: DIREKSI & MANAJEMEN OPERASIONAL -->
                <div>
                    <!-- Category Title Divider -->
                    <div class="flex items-center gap-4 mb-6 max-w-5xl mx-auto">
                        <div class="h-px bg-slate-200 flex-1"></div>
                        <div class="flex items-center gap-2 px-3 py-1 rounded-sm bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider border border-slate-200/90">
                            <i class="fa-solid fa-briefcase text-emerald-700"></i> Direksi &amp; Manajemen Operasional
                        </div>
                        <div class="h-px bg-slate-200 flex-1"></div>
                    </div>

                    <!-- Direktur Card (Featured Center) -->
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-full max-w-sm bg-white rounded-sm border-2 border-emerald-600/90 shadow-2xs hover:shadow-md transition-all duration-200 p-5 text-center group">
                            <div class="w-12 h-12 rounded-full bg-emerald-50 border-2 border-emerald-200 text-[#006830] flex items-center justify-center text-lg mx-auto mb-2.5 group-hover:scale-105 transition-transform duration-200">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider bg-emerald-50 text-[#006830] border border-emerald-200/80 px-2.5 py-0.5 rounded-full mb-1">
                                DIREKTUR
                            </span>
                            <h4 class="text-base font-extrabold text-slate-900 font-heading">
                                A Nurjaman
                            </h4>
                            <p class="text-xs text-slate-600 font-medium mt-0.5">Direktur Penerbit Persis</p>
                        </div>
                    </div>

                    <!-- 3 Divisi Grid (Marketing, Keuangan, Umum) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 max-w-5xl mx-auto">
                        <!-- Marketing -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-200 text-blue-700 flex items-center justify-center text-sm mx-auto mb-2.5 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-800 block mb-1">MARKETING</span>
                            <h5 class="text-sm sm:text-base font-bold text-slate-900">
                                Iban Muhiban
                            </h5>
                            <p class="text-[11px] text-slate-500 mt-1 leading-snug">Pemasaran &amp; Distribusi</p>
                        </div>

                        <!-- Keuangan -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-10 h-10 rounded-full bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center text-sm mx-auto mb-2.5 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-800 block mb-1">KEUANGAN</span>
                            <h5 class="text-sm sm:text-base font-bold text-slate-900">
                                Dewi Kurmiati
                            </h5>
                            <p class="text-[11px] text-slate-500 mt-1 leading-snug">Keuangan &amp; Administrasi</p>
                        </div>

                        <!-- Umum -->
                        <div class="bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 text-slate-700 flex items-center justify-center text-sm mx-auto mb-2.5 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-boxes-packing"></i>
                            </div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-700 block mb-1">UMUM</span>
                            <h5 class="text-sm sm:text-base font-bold text-slate-900">
                                Dedi Setiadi
                            </h5>
                            <p class="text-[11px] text-slate-500 mt-1 leading-snug">Operasional &amp; Logistik</p>
                        </div>
                    </div>
                </div>

                <!-- TIER 4: TEKNOLOGI & SISTEM INFORMASI -->
                <div>
                    <!-- Category Title Divider -->
                    <div class="flex items-center gap-4 mb-6 max-w-sm mx-auto">
                        <div class="h-px bg-slate-200 flex-1"></div>
                        <div class="flex items-center gap-2 px-3 py-1 rounded-sm bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider border border-slate-200/90">
                            <i class="fa-solid fa-code text-emerald-700"></i> Teknologi Informasi
                        </div>
                        <div class="h-px bg-slate-200 flex-1"></div>
                    </div>

                    <!-- Web Development Card -->
                    <div class="flex flex-col items-center">
                        <div class="w-full max-w-sm bg-white rounded-sm border border-slate-200/90 hover:border-emerald-600 p-5 text-center transition-all duration-200 shadow-2xs hover:shadow-sm group">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-sm mx-auto mb-2.5 group-hover:scale-105 transition-transform">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-emerald-800 block mb-1">WEB DEVELOPMENT</span>
                            <h5 class="text-sm sm:text-base font-bold text-slate-900">
                                Zaki Yusron Hasyimi
                            </h5>
                            <p class="text-[11px] text-slate-500 mt-1 leading-snug">Teknologi &amp; Sistem Informasi</p>
                        </div>
                    </div>
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
