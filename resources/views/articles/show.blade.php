@extends('layouts.app')

@section('title', $article->title . ' | PERSIS PERS')

@section('content')
    <!-- 1. HERO BANNER (Clean & Identical to Tentang Kami) -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up space-y-4">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-emerald-400 font-semibold flex-wrap" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:underline text-slate-300">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[8px] opacity-60"></i>
                <a href="{{ route('berita.index') }}" class="hover:underline text-slate-300">Berita &amp; Artikel</a>
                @if($article->category)
                    <i class="fa-solid fa-chevron-right text-[8px] opacity-60"></i>
                    <a href="{{ route('berita.index', ['kategori' => $article->category->slug]) }}" class="hover:underline text-emerald-400">
                        {{ $article->category->name }}
                    </a>
                @endif
                <i class="fa-solid fa-chevron-right text-[8px] opacity-60"></i>
                <span class="text-white truncate max-w-xs">{{ $article->title }}</span>
            </nav>

            <div class="space-y-3 max-w-4xl">
                @if($article->category)
                    <a href="{{ route('berita.index', ['kategori' => $article->category->slug]) }}" class="inline-block px-3 py-1 bg-emerald-600/20 text-emerald-400 border border-emerald-500/30 text-xs font-bold uppercase tracking-wider rounded-xs hover:bg-emerald-600/30 transition">
                        {{ $article->category->name }}
                    </a>
                @endif

                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight text-white">
                    {{ $article->title }}
                </h1>

                <!-- Author & Meta Info Byline -->
                <div class="flex items-center justify-between flex-wrap gap-4 pt-4 text-xs text-slate-300 border-t border-brand-900">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-full bg-[#006830] text-white flex items-center justify-center text-xs font-bold uppercase shrink-0">
                            {{ substr($article->author->name ?? 'P', 0, 1) }}
                        </div>
                        <div>
                            <span class="font-bold text-white block">{{ $article->author->name ?? 'Redaksi Persis' }}</span>
                            <span class="text-[11px] text-slate-400">Penerbit &amp; Percetakan PERSIS PERS</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 text-[11.5px] text-slate-300 font-mono">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar text-emerald-400"></i>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1.5 font-sans">
                            <i class="fa-regular fa-clock text-emerald-400"></i>
                            {{ $article->reading_time }} mnt baca
                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fa-regular fa-eye text-emerald-400"></i>
                            {{ number_format($article->views_count, 0, ',', '.') }} views
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. ARTICLE CONTENT AREA -->
    <main class="bg-slate-50 py-12 sm:py-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: ARTICLE DETAIL (8 COLS) -->
                <article class="lg:col-span-8 bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
                    
                    <!-- Cover Image -->
                    @if($article->thumbnail)
                        <div class="aspect-[16/9] w-full overflow-hidden bg-slate-100 border-b border-slate-200">
                            <img 
                                src="{{ $article->thumbnail }}" 
                                alt="{{ $article->title }}" 
                                class="w-full h-full object-cover" 
                            />
                        </div>
                    @endif

                    <!-- Article Content Container -->
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        @if($article->excerpt)
                            <div class="p-4 bg-emerald-50/60 border-l-4 border-[#006830] text-slate-800 text-xs sm:text-sm leading-relaxed italic font-serif">
                                {{ $article->excerpt }}
                            </div>
                        @endif

                        <!-- Rendered HTML Content (Prose Styled) -->
                        <div class="prose prose-slate prose-sm sm:prose-base max-w-none text-slate-800 leading-relaxed space-y-4">
                            {!! $article->content !!}
                        </div>

                        <!-- Tags Row -->
                        @if(!empty($article->tags))
                            <div class="pt-6 border-t border-slate-100 flex items-center gap-2 flex-wrap text-xs">
                                <span class="font-bold text-slate-700 flex items-center gap-1">
                                    <i class="fa-solid fa-tags text-emerald-700"></i> Tags:
                                </span>
                                @foreach(explode(',', $article->tags) as $tag)
                                    <span class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xs text-[11px] font-medium transition">
                                        #{{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Social Media Share Box -->
                        <div class="p-5 bg-slate-50 border border-slate-200 rounded-sm space-y-3">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-share-nodes text-emerald-700"></i>
                                    <span>Bagikan Artikel Ini:</span>
                                </span>
                                <span class="text-[11px] text-slate-400">Bantu sebarkan warta dan literasi keumatan</span>
                            </div>

                            <div class="flex items-center gap-2 flex-wrap">
                                <!-- WhatsApp -->
                                <a href="{{ $article->share_urls['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>WhatsApp</span>
                                </a>

                                <!-- Facebook -->
                                <a href="{{ $article->share_urls['facebook'] }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 bg-[#1877F2] hover:bg-[#0C63D4] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                    <i class="fa-brands fa-facebook text-sm"></i>
                                    <span>Facebook</span>
                                </a>

                                <!-- Twitter / X -->
                                <a href="{{ $article->share_urls['twitter'] }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 bg-[#000000] hover:bg-[#222222] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                    <i class="fa-brands fa-x-twitter text-sm"></i>
                                    <span>X (Twitter)</span>
                                </a>

                                <!-- Telegram -->
                                <a href="{{ $article->share_urls['telegram'] }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 bg-[#229ED9] hover:bg-[#1A8BC2] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                    <i class="fa-brands fa-telegram text-sm"></i>
                                    <span>Telegram</span>
                                </a>

                                <!-- Copy Link Button -->
                                <button type="button" onclick="copyArticleLink('{{ $article->share_urls['raw_url'] }}')" id="btnCopyLink" class="px-3.5 py-2 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 font-bold text-xs rounded-xs transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                                    <i class="fa-regular fa-copy text-sm"></i>
                                    <span id="copyLinkText">Salin Link</span>
                                </button>
                            </div>
                        </div>

                    </div>

                </article>

                <!-- RIGHT COLUMN: SIDEBAR (4 COLS) -->
                <aside class="lg:col-span-4 space-y-6">

                    <!-- 1. Kategori Berita Widget -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
                        <div class="p-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                            <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-folder-tree text-emerald-700"></i>
                                <span>Kategori Berita</span>
                            </span>
                        </div>

                        <div class="divide-y divide-slate-100 text-xs">
                            @foreach($categories as $cat)
                                <a 
                                    href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" 
                                    class="flex items-center justify-between px-4 py-2.5 transition {{ ($article->category_id == $cat->id) ? 'bg-emerald-50 text-emerald-900 font-bold border-l-3 border-[#006830]' : 'text-slate-700 hover:bg-slate-50' }}"
                                >
                                    <span>{{ $cat->name }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10.5px] font-bold font-mono {{ ($article->category_id == $cat->id) ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $cat->published_articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Widget Wakaf Al-Qur'an & Buku (Di Atas Berita Lainnya/Populer) -->
                    @if(($settings['wakaf_active'] ?? '1') === '1')
                        <div class="bg-white rounded-sm border border-emerald-300/80 shadow-2xs overflow-hidden group">
                            <!-- Top Strip Green Accent -->
                            <div class="h-1 bg-[#006830]"></div>

                            <div class="p-4 space-y-3.5">
                                <!-- Card Header (Opens Modal Popup) -->
                                <button type="button" onclick="openWakafModal()" class="w-full text-left group/btn space-y-1 cursor-pointer">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span class="text-[9.5px] font-black uppercase tracking-widest text-[#006830] font-mono">PROGRAM WAKAF</span>
                                    </div>
                                    <h3 class="text-xs font-black text-slate-900 group-hover/btn:text-emerald-800 transition leading-snug">
                                        {{ $settings['wakaf_card_title'] ?? "WAKAF AL-QUR'AN & BUKU UNTUK GENERASI QUR'ANI" }}
                                    </h3>
                                </button>

                                <!-- Bank & Account Detail Box -->
                                <div class="p-3 bg-slate-50/90 rounded-xs border border-slate-200/90 space-y-2 text-xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bank:</span>
                                        <span class="text-[11px] font-bold text-slate-900 text-right">{{ $settings['wakaf_bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</span>
                                    </div>

                                    <div class="flex items-center justify-between gap-2 pt-1.5 border-t border-slate-200/60">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Rek Wakaf:</span>
                                        <div class="flex items-center gap-1.5">
                                            <span id="wakafRekNoShow" class="text-xs font-black font-mono text-emerald-950 bg-emerald-100/80 px-2 py-0.5 rounded-xs select-all">{{ $settings['wakaf_account_no'] ?? '7148888999' }}</span>
                                            <button 
                                                type="button" 
                                                onclick="copyWakafRekening('{{ $settings['wakaf_account_no'] ?? '7148888999' }}', this)" 
                                                class="p-1 rounded-xs bg-white hover:bg-emerald-50 text-slate-500 hover:text-emerald-800 border border-slate-300 transition cursor-pointer text-[10px]" 
                                                title="Salin Nomor Rekening"
                                            >
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between gap-2 pt-1.5 border-t border-slate-200/60">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">An:</span>
                                        <span class="text-[11px] font-bold text-slate-700 truncate max-w-[150px]">{{ $settings['wakaf_account_name'] ?? 'PENERBIT PERSIS WAKAF' }}</span>
                                    </div>
                                </div>

                                <!-- QRIS Info (Optional) -->
                                @if(!empty($settings['wakaf_qris_image']))
                                    <div class="flex items-center justify-between gap-2 px-3 py-2 bg-emerald-50/50 rounded-xs border border-emerald-200/70 text-xs">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-qrcode text-emerald-800 text-sm"></i>
                                            <span class="text-[11px] font-bold text-slate-800">Wakaf via QRIS</span>
                                        </div>
                                        <button type="button" onclick="openWakafQrisModal('{{ $settings['wakaf_qris_image'] }}')" class="text-[10px] font-bold text-emerald-800 hover:text-emerald-950 underline cursor-pointer">
                                            Lihat QRIS
                                        </button>
                                    </div>
                                @endif

                                <!-- CTA Action Buttons -->
                                <div class="pt-1 space-y-2">
                                    <button 
                                        type="button" 
                                        onclick="openWakafModal()" 
                                        class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-xs transform hover:scale-[1.01] active:scale-98 cursor-pointer"
                                    >
                                        <i class="fa-solid fa-book-open-reader text-xs"></i>
                                        <span>Pelajari &amp; Salurkan</span>
                                    </button>
                                    
                                    @if(!empty($settings['wakaf_contact_wa']))
                                        <a 
                                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['wakaf_contact_wa']) }}?text={{ urlencode('Assalamu\'alaikum Admin Penerbit Persis, saya ingin konfirmasi Wakaf Al-Qur\'an dan Buku') }}" 
                                            target="_blank" 
                                            class="w-full py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5"
                                        >
                                            <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                                            <span>Konfirmasi via WhatsApp</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 3. Berita Lainnya / Terbaru Widget -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
                        <div class="p-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                            <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-fire text-amber-500"></i>
                                <span>Berita Lainnya</span>
                            </span>
                            <a href="{{ route('berita.index') }}" class="text-[10px] text-emerald-700 font-bold hover:underline">Semua &rarr;</a>
                        </div>

                        <div class="p-4 space-y-3.5 divide-y divide-slate-100">
                            @foreach($recentArticles as $recent)
                                <a href="{{ route('berita.show', $recent->slug) }}" class="pt-3 first:pt-0 flex gap-3 group items-start">
                                    <div class="w-16 h-12 rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                        <img src="{{ $recent->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=200&auto=format&fit=crop' }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                                    </div>
                                    <div class="min-w-0 flex-1 space-y-0.5">
                                        <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                            {{ $recent->title }}
                                        </h4>
                                        <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                            <span>{{ $recent->published_at ? $recent->published_at->format('d M Y') : '' }}</span>
                                            <span>&bull;</span>
                                            <span class="text-emerald-700 font-bold">{{ number_format($recent->views_count, 0, ',', '.') }} views</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>

            </div>

            <!-- 3. BOTTOM SECTION: RELATED ARTICLES (3 CARDS) -->
            @if($relatedArticles->count() > 0)
            <div class="mt-12 pt-8 border-t border-slate-200 space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block">REKOMENDASI</span>
                        <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 font-heading leading-tight">Artikel Terkait Lainnya</h3>
                    </div>
                    <a href="{{ route('berita.index') }}" class="text-xs font-bold text-emerald-800 hover:underline">
                        Lihat Semua Berita &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $rel)
                        <article class="bg-white rounded-sm border border-slate-200 shadow-2xs hover:shadow-md transition overflow-hidden group">
                            <div>
                                <a href="{{ route('berita.show', $rel->slug) }}" class="block aspect-[16/9] overflow-hidden bg-slate-100 relative">
                                    <img src="{{ $rel->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                                </a>
                                <div class="p-4 space-y-2">
                                    <span class="text-[10px] text-slate-400 block font-mono">
                                        {{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}
                                    </span>
                                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                        <a href="{{ route('berita.show', $rel->slug) }}">{{ $rel->title }}</a>
                                    </h4>
                                </div>
                            </div>
                            <div class="p-4 pt-0">
                                <a href="{{ route('berita.show', $rel->slug) }}" class="text-[11px] font-bold text-[#006830] inline-flex items-center gap-1 group-hover:underline">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </main>

    <!-- 4. MODAL POPUP DIALOG: PROGRAM WAKAF AL-QUR'AN & BUKU -->
    <div id="wakafProgramModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/70 backdrop-blur-xs transition-opacity duration-300">
        <div class="bg-white rounded-sm max-w-2xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-emerald-300 overflow-hidden transform transition-all">
            
            <!-- Modal Header -->
            <div class="bg-[#006830] text-white p-4 sm:p-5 flex items-start justify-between gap-3 shrink-0">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest font-mono block">PROGRAM RESMI PENERBIT PERSIS</span>
                    <h3 class="text-base sm:text-lg font-black font-heading leading-snug text-white">
                        {{ $settings['wakaf_program_title'] ?? 'PROGRAM WAKAF AL-QUR’AN DAN BUKU' }}
                    </h3>
                    <p class="text-xs text-emerald-100">
                        {{ $settings['wakaf_program_subtitle'] ?? 'Menghidupkan Literasi, Menebarkan Ilmu, Mengalirkan Pahala' }}
                    </p>
                </div>
                <button type="button" onclick="closeWakafModal()" class="w-8 h-8 rounded-xs bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition cursor-pointer shrink-0">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Modal Body (Scrollable) -->
            <div class="p-5 sm:p-6 overflow-y-auto space-y-5 text-xs sm:text-sm text-slate-700 leading-relaxed">
                
                <!-- Rekening Box Callout -->
                <div class="p-4 bg-emerald-50/90 border border-emerald-300 rounded-xs space-y-3 shadow-2xs">
                    <div class="flex items-center gap-2 pb-2 border-b border-emerald-200">
                        <div class="w-7 h-7 rounded-xs bg-[#006830] text-white flex items-center justify-center text-xs">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div>
                            <span class="text-[9.5px] font-black uppercase tracking-widest text-[#006830] block">REKENING RESMI WAKAF</span>
                            <span class="text-xs font-bold text-slate-900">Saluran Transfer &amp; Wakaf Jariyah</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="bg-white p-3 rounded-xs border border-emerald-200 space-y-1">
                            <span class="text-slate-500 text-[11px] block">Transfer Bank Syariah:</span>
                            <div class="font-bold text-slate-900 text-xs">{{ $settings['wakaf_bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</div>
                            <div class="text-xs flex items-center justify-between gap-2 pt-1 border-t border-slate-100">
                                <span>No. Rek: <strong class="font-mono text-emerald-950 font-bold select-all">{{ $settings['wakaf_account_no'] ?? '7148888999' }}</strong></span>
                                <button 
                                    type="button" 
                                    onclick="copyWakafRekening('{{ $settings['wakaf_account_no'] ?? '7148888999' }}', this)" 
                                    class="px-2 py-0.5 rounded-xs bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-300 text-[10.5px] font-bold cursor-pointer"
                                >
                                    <i class="fa-regular fa-copy mr-0.5"></i> Salin
                                </button>
                            </div>
                            <div class="text-[10.5px] text-slate-500">Atas Nama: <strong class="text-slate-800">{{ $settings['wakaf_account_name'] ?? 'PENERBIT PERSIS WAKAF' }}</strong></div>
                        </div>

                        <div class="bg-white p-3 rounded-xs border border-emerald-200 flex flex-col justify-between space-y-2">
                            <span class="text-slate-500 text-[11px] block">Layanan Konfirmasi Wakaf:</span>
                            @if(!empty($settings['wakaf_qris_image']))
                                <button type="button" onclick="openWakafQrisModal('{{ $settings['wakaf_qris_image'] }}')" class="w-full py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-800 rounded-xs text-[11px] font-bold border border-slate-300 flex items-center justify-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-qrcode text-emerald-700"></i> Scan QRIS Wakaf
                                </button>
                            @endif
                            @if(!empty($settings['wakaf_contact_wa']))
                                <a 
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['wakaf_contact_wa']) }}?text={{ urlencode('Assalamu\'alaikum Admin Penerbit Persis, saya ingin berwakaf Al-Qur\'an dan Buku') }}" 
                                    target="_blank" 
                                    class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs"
                                >
                                    <i class="fa-brands fa-whatsapp text-emerald-300"></i>
                                    <span>Konfirmasi via WhatsApp</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Wakaf HTML Full Content -->
                <div class="space-y-3 prose prose-xs sm:prose-sm max-w-none text-slate-700 leading-relaxed">
                    @if(!empty($settings['wakaf_content']))
                        {!! $settings['wakaf_content'] !!}
                    @else
                        <p class="lead font-medium text-slate-800"><strong>Penerbit Persis</strong> menghadirkan <strong>Program Wakaf Al-Qur’an dan Buku</strong> sebagai ikhtiar untuk memperluas akses umat Islam terhadap Al-Qur’an dan berbagai sumber ilmu pengetahuan yang bermanfaat.</p>
                        <p>Program ini membuka kesempatan bagi masyarakat untuk turut berwakaf dalam bentuk Al-Qur’an dan buku-buku keislaman serta keilmuan yang akan dicetak dan disalurkan kepada pihak-pihak yang membutuhkan.</p>
                    @endif
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="p-3 sm:p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between gap-3 shrink-0">
                <button type="button" onclick="closeWakafModal()" class="px-4 py-2 bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 rounded-xs text-xs font-bold transition cursor-pointer">
                    Tutup
                </button>
                @if(!empty($settings['wakaf_contact_wa']))
                    <a 
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['wakaf_contact_wa']) }}?text={{ urlencode('Assalamu\'alaikum Admin Penerbit Persis, saya ingin berwakaf Al-Qur\'an dan Buku') }}" 
                        target="_blank" 
                        class="px-5 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold uppercase tracking-wider transition flex items-center gap-2 shadow-xs cursor-pointer"
                    >
                        <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i>
                        <span>Salurkan Wakaf Sekarang</span>
                    </a>
                @endif
            </div>

        </div>
    </div>

    <script>
        function openWakafModal() {
            const modal = document.getElementById('wakafProgramModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeWakafModal() {
            const modal = document.getElementById('wakafProgramModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }

        // Close on backdrop click
        document.getElementById('wakafProgramModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeWakafModal();
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWakafModal();
            }
        });

        function copyArticleLink(url) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    const textEl = document.getElementById('copyLinkText');
                    const original = textEl.innerText;
                    textEl.innerText = 'Link Tersalin!';
                    setTimeout(() => { textEl.innerText = original; }, 2500);
                });
            } else {
                prompt('Salin link ini:', url);
            }
        }

        function copyWakafRekening(rek, btn) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(rek).then(() => {
                    showWakafCopySuccess(btn, rek);
                }).catch(() => {
                    fallbackCopyTextWakaf(rek, btn);
                });
            } else {
                fallbackCopyTextWakaf(rek, btn);
            }
        }

        function fallbackCopyTextWakaf(text, btn) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showWakafCopySuccess(btn, text);
            } catch (err) {}
            document.body.removeChild(textArea);
        }

        function showWakafCopySuccess(btn, rek) {
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check text-emerald-600"></i> Tersalin!';
            setTimeout(() => {
                btn.innerHTML = originalHtml;
            }, 2000);

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'No. Rekening Disalin!',
                    text: rek,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        }

        function openWakafQrisModal(imgUrl) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'QRIS Wakaf Al-Qur\'an & Buku',
                    text: 'Scan barcode melalui Mobile Banking atau e-Wallet',
                    imageUrl: imgUrl,
                    imageWidth: 260,
                    imageHeight: 260,
                    imageAlt: 'QRIS Wakaf Penerbit Persis',
                    confirmButtonColor: '#006830',
                    confirmButtonText: 'Tutup'
                });
            } else {
                window.open(imgUrl, '_blank');
            }
        }
    </script>
@endsection
