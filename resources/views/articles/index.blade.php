@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name . ' - ' : '') . 'Berita & Artikel | PERSIS PERS')

@section('content')
    <!-- 1. HERO BANNER (Clean & Identical to Tentang Kami) -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">
                {{ $settings['news_banner_badge'] ?? 'WARNA LITERASI & WARTA' }}
            </span>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl">
                {{ $currentCategory ? $currentCategory->name : ($settings['news_banner_title'] ?? 'Kabar & Artikel Penerbitan') }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-2xl leading-relaxed">
                {{ $currentCategory ? ($currentCategory->description ?: 'Kumpulan artikel, rilis publikasi, dan warta kegiatan seputar ' . $currentCategory->name) : ($settings['news_banner_desc'] ?? 'Temukan warta kegiatan, tips penulisan buku ber-ISBN, agenda workshop, serta pemikiran literasi Islam dari Penerbit Persis.') }}
            </p>
        </div>
    </section>

    <!-- 2. MAIN CONTENT AREA: ARTICLES (8 COLS) + SIDEBAR (4 COLS) -->
    <main class="bg-slate-50 py-12 sm:py-16 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: ARTICLES FEED (8 COLS) -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Active Filter Bar / Header -->
                    <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-regular fa-newspaper text-emerald-700"></i>
                                @if($currentCategory)
                                    <span>Kategori: <strong class="text-emerald-800">{{ $currentCategory->name }}</strong></span>
                                @elseif(!empty($search))
                                    <span>Pencarian: <strong class="text-emerald-800">"{{ $search }}"</strong></span>
                                @else
                                    <span>Semua Artikel Terbit</span>
                                @endif
                            </span>
                            <span class="text-slate-300">&bull;</span>
                            <span class="text-slate-500 font-mono text-[11px]">{{ $articles->total() }} Artikel</span>
                        </div>

                        @if(!empty($search) || $currentCategory)
                            <a href="{{ route('berita.index') }}" class="text-[11px] font-bold text-rose-600 hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-rotate-left text-[9px]"></i> Reset Filter
                            </a>
                        @endif
                    </div>

                    @if($articles->count() > 0)
                        <!-- 2-Column Articles Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @foreach($articles as $article)
                                <article class="bg-white rounded-sm border border-slate-200 shadow-2xs hover:shadow-md hover:border-emerald-600 transition overflow-hidden flex flex-col justify-between group">
                                    <div>
                                        <!-- Thumbnail Frame (16:9 Aspect) -->
                                        <a href="{{ route('berita.show', $article->slug) }}" class="block aspect-[16/9] overflow-hidden bg-slate-100 relative">
                                            <img 
                                                src="{{ $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=600&auto=format&fit=crop' }}" 
                                                alt="{{ $article->title }}" 
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                                loading="lazy"
                                            />
                                            @if($article->category)
                                                <span class="absolute top-2.5 left-2.5 px-2.5 py-1 bg-[#006830]/90 backdrop-blur-xs text-white text-[9.5px] font-bold uppercase tracking-wider rounded-xs shadow-xs">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                        </a>

                                        <!-- Card Content -->
                                        <div class="p-5 space-y-2.5">
                                            <!-- Date & Reading Time -->
                                            <div class="flex items-center gap-2.5 text-[11px] text-slate-400 font-mono">
                                                <span class="flex items-center gap-1">
                                                    <i class="fa-regular fa-calendar text-[10px] text-emerald-700"></i>
                                                    {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                                </span>
                                                <span>&bull;</span>
                                                <span class="font-sans flex items-center gap-1">
                                                    <i class="fa-regular fa-clock text-[10px]"></i>
                                                    {{ $article->reading_time }} mnt baca
                                                </span>
                                            </div>

                                            <!-- Title -->
                                            <h2 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                <a href="{{ route('berita.show', $article->slug) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </h2>

                                            <!-- Excerpt -->
                                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Footer Card Action -->
                                    <div class="px-5 pb-5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <div class="flex items-center gap-1.5 text-slate-500 text-[11px] truncate max-w-[130px]">
                                            <i class="fa-regular fa-user text-emerald-700 text-[10px]"></i>
                                            <span class="truncate">{{ $article->author->name ?? 'Redaksi Persis' }}</span>
                                        </div>
                                        <a href="{{ route('berita.show', $article->slug) }}" class="font-bold text-[#006830] group-hover:text-emerald-900 transition flex items-center gap-1 text-xs shrink-0">
                                            <span>Baca Selengkapnya</span>
                                            <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($articles->hasPages())
                            <div class="pt-6 flex justify-center">
                                {{ $articles->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State Box -->
                        <div class="bg-white p-12 text-center rounded-sm border border-slate-200 shadow-2xs space-y-3">
                            <div class="w-14 h-14 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto text-xl">
                                <i class="fa-regular fa-newspaper"></i>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 font-heading">Belum Ada Berita</h3>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto">
                                @if(!empty($search))
                                    Tidak ditemukan berita yang cocok dengan kata kunci "{{ $search }}".
                                @else
                                    Belum ada artikel yang dipublikasikan pada kategori ini.
                                @endif
                            </p>
                            <a href="{{ route('berita.index') }}" class="inline-block px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm uppercase tracking-wider transition shadow-2xs">
                                Lihat Semua Berita
                            </a>
                        </div>
                    @endif

                </div>

                <!-- RIGHT COLUMN: SIDEBAR (4 COLS) -->
                <aside class="lg:col-span-4 space-y-6">

                    <!-- 1. Search Box Widget -->
                    <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs space-y-2">
                        <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider block pb-2 border-b border-slate-100 flex items-center gap-1.5">
                            <i class="fa-solid fa-magnifying-glass text-emerald-700"></i>
                            <span>Pencarian Berita</span>
                        </span>
                        <form action="{{ route('berita.index') }}" method="GET" class="relative pt-1">
                            @if($currentCategory)
                                <input type="hidden" name="kategori" value="{{ $currentCategory->slug }}" />
                            @endif
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ $search }}" 
                                placeholder="Cari kata kunci artikel..." 
                                class="w-full pl-8 pr-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white text-slate-800"
                            />
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-3.5 text-slate-400 text-xs pointer-events-none"></i>
                        </form>
                    </div>

                    <!-- 2. Kategori Berita Widget -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
                        <div class="p-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                            <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="fa-solid fa-folder-tree text-emerald-700"></i>
                                <span>Kategori Berita</span>
                            </span>
                        </div>

                        <div class="divide-y divide-slate-100 text-xs">
                            <a 
                                href="{{ route('berita.index') }}" 
                                class="flex items-center justify-between px-4 py-2.5 transition {{ empty($currentCategory) ? 'bg-emerald-50 text-emerald-800 font-bold border-l-3 border-[#006830]' : 'text-slate-700 hover:bg-slate-50' }}"
                            >
                                <span>Semua Kategori</span>
                                <span class="px-2 py-0.5 rounded-full text-[10.5px] font-bold font-mono {{ empty($currentCategory) ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $categories->sum('published_articles_count') }}
                                </span>
                            </a>

                            @foreach($categories as $cat)
                                <a 
                                    href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" 
                                    class="flex items-center justify-between px-4 py-2.5 transition {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'bg-emerald-50 text-emerald-800 font-bold border-l-3 border-[#006830]' : 'text-slate-700 hover:bg-slate-50' }}"
                                >
                                    <span class="truncate pr-2">{{ $cat->name }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10.5px] font-bold font-mono shrink-0 {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $cat->published_articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- 2. Widget Wakaf Al-Qur'an & Buku (Di Atas Berita Populer) -->
                    @if(($settings['wakaf_active'] ?? '1') === '1')
                        <div class="bg-white rounded-sm border border-emerald-300/80 shadow-2xs overflow-hidden group">
                            <!-- Top Strip Green Accent -->
                            <div class="h-1 bg-[#006830]"></div>

                            <div class="p-4 space-y-3.5">
                                <!-- Card Header (Clickable to Wakaf Article) -->
                                <a href="{{ $settings['wakaf_article_url'] ?? '/berita/program-wakaf-al-quran-dan-buku' }}" class="block group/link space-y-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span class="text-[9.5px] font-black uppercase tracking-widest text-[#006830] font-mono">PROGRAM WAKAF</span>
                                    </div>
                                    <h3 class="text-xs font-black text-slate-900 group-hover/link:text-emerald-800 transition leading-snug">
                                        {{ $settings['wakaf_card_title'] ?? "WAKAF AL-QUR'AN & BUKU UNTUK GENERASI QUR'ANI" }}
                                    </h3>
                                </a>

                                <!-- Bank & Account Detail Box -->
                                <div class="p-3 bg-slate-50/90 rounded-xs border border-slate-200/90 space-y-2 text-xs">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bank:</span>
                                        <span class="text-[11px] font-bold text-slate-900 text-right">{{ $settings['wakaf_bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</span>
                                    </div>

                                    <div class="flex items-center justify-between gap-2 pt-1.5 border-t border-slate-200/60">
                                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Rek Wakaf:</span>
                                        <div class="flex items-center gap-1.5">
                                            <span id="wakafRekNo" class="text-xs font-black font-mono text-emerald-950 bg-emerald-100/80 px-2 py-0.5 rounded-xs select-all">{{ $settings['wakaf_account_no'] ?? '7148888999' }}</span>
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
                                        <span class="text-[11px] font-bold text-slate-700 truncate max-w-[150px]">{{ $settings['wakaf_account_name'] ?? 'PENERBIT PERSIS' }}</span>
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
                                    <a 
                                        href="{{ $settings['wakaf_article_url'] ?? '/berita/program-wakaf-al-quran-dan-buku' }}" 
                                        class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-xs transform hover:scale-[1.01] active:scale-98"
                                    >
                                        <i class="fa-solid fa-book-open-reader text-xs"></i>
                                        <span>Pelajari &amp; Salurkan</span>
                                    </a>
                                    
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

                    <!-- 3. Berita Populer / Terbaru Widget -->
                    @if($popularArticles->count() > 0)
                        <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
                            <div class="p-3.5 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                                <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-fire text-amber-500"></i>
                                    <span>Berita Populer</span>
                                </span>
                            </div>

                            <div class="p-4 space-y-3.5 divide-y divide-slate-100">
                                @foreach($popularArticles as $pop)
                                    <a href="{{ route('berita.show', $pop->slug) }}" class="pt-3 first:pt-0 flex gap-3 group items-start">
                                        <div class="w-16 h-12 rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                            <img src="{{ $pop->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=200&auto=format&fit=crop' }}" alt="{{ $pop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                                        </div>
                                        <div class="min-w-0 flex-1 space-y-0.5">
                                            <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                {{ $pop->title }}
                                            </h4>
                                            <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                                <span>{{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}</span>
                                                <span>&bull;</span>
                                                <span class="text-emerald-700 font-bold">{{ number_format($pop->views_count, 0, ',', '.') }} views</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </aside>

            </div>

        </div>
    </main>

    <script>
        function copyWakafRekening(rek, btn) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(rek).then(() => {
                    showCopySuccess(btn, rek);
                }).catch(() => {
                    fallbackCopyText(rek, btn);
                });
            } else {
                fallbackCopyText(rek, btn);
            }
        }

        function fallbackCopyText(text, btn) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                showCopySuccess(btn, text);
            } catch (err) {}
            document.body.removeChild(textArea);
        }

        function showCopySuccess(btn, rek) {
            const icon = btn.querySelector('i');
            if (icon) {
                icon.className = 'fa-solid fa-check text-emerald-600';
                setTimeout(() => {
                    icon.className = 'fa-regular fa-copy';
                }, 2000);
            }
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
