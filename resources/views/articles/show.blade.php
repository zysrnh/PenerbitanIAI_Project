@extends('layouts.app')

@section('title', $article->title . ' - Penerbit Persis')

@section('content')
<main class="bg-slate-50 min-h-screen py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <!-- Breadcrumbs Navigation -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
            <a href="{{ route('berita.index') }}" class="hover:text-emerald-700 transition">Berita &amp; Artikel</a>
            @if($article->category)
                <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
                <a href="{{ route('berita.index', ['kategori' => $article->category->slug]) }}" class="hover:text-emerald-700 transition">
                    {{ $article->category->name }}
                </a>
            @endif
            <i class="fa-solid fa-chevron-right text-[8px] text-slate-300"></i>
            <span class="text-slate-800 font-semibold truncate max-w-xs">{{ $article->title }}</span>
        </nav>

        <!-- Main Layout: Article Content (8 Cols) + Sidebar (4 Cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: ARTICLE DETAIL (8 COLS) -->
            <article class="lg:col-span-8 bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
                
                <!-- Article Header -->
                <div class="p-6 sm:p-8 space-y-4 border-b border-slate-100">
                    @if($article->category)
                        <a href="{{ route('berita.index', ['kategori' => $article->category->slug]) }}" class="inline-block px-3 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold uppercase tracking-wider rounded-xs hover:bg-emerald-100 transition">
                            {{ $article->category->name }}
                        </a>
                    @endif

                    <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-slate-900 tracking-tight font-heading leading-tight">
                        {{ $article->title }}
                    </h1>

                    <!-- Author & Meta Info Row -->
                    <div class="flex items-center justify-between flex-wrap gap-3 pt-2 text-xs text-slate-500 border-t border-slate-100">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-[#006830] text-white flex items-center justify-center text-xs font-bold uppercase shrink-0">
                                {{ substr($article->author->name ?? 'P', 0, 1) }}
                            </div>
                            <div>
                                <span class="font-bold text-slate-800 block">{{ $article->author->name ?? 'Redaksi Persis' }}</span>
                                <span class="text-[11px] text-slate-400">Penerbit Persis Press</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 sm:gap-4 text-[11.5px] text-slate-400">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-calendar text-emerald-700"></i>
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-clock"></i>
                                {{ $article->reading_time }} mnt baca
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-eye"></i>
                                {{ number_format($article->views_count, 0, ',', '.') }} views
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Featured Cover Image -->
                @if($article->thumbnail)
                    <div class="aspect-[16/9] w-full overflow-hidden bg-slate-100 border-b border-slate-100">
                        <img 
                            src="{{ $article->thumbnail }}" 
                            alt="{{ $article->title }}" 
                            class="w-full h-full object-cover" 
                        />
                    </div>
                @endif

                <!-- Article Body Content -->
                <div class="p-6 sm:p-8 space-y-6">
                    
                    @if($article->excerpt)
                        <div class="p-4 bg-emerald-50/50 border-l-4 border-[#006830] text-slate-700 text-xs sm:text-sm leading-relaxed italic font-serif">
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
                            <span class="text-[11px] text-slate-400">Bantu sebarkan ilmu dan warta literasi</span>
                        </div>

                        <div class="flex items-center gap-2 flex-wrap">
                            <!-- WhatsApp -->
                            <a href="{{ $article->share_urls['whatsapp'] }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 bg-[#25D366] hover:bg-[#1EBE5D] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>WhatsApp</span>
                            </a>

                            <!-- Facebook -->
                            <a href="{{ $article->share_urls['facebook'] }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 bg-[#1877F2] hover:bg-[#0C63D4] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                <i class="fa-brands fa-facebook text-sm"></i>
                                <span>Facebook</span>
                            </a>

                            <!-- Twitter / X -->
                            <a href="{{ $article->share_urls['twitter'] }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 bg-[#000000] hover:bg-[#222222] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                <i class="fa-brands fa-x-twitter text-sm"></i>
                                <span>X (Twitter)</span>
                            </a>

                            <!-- Telegram -->
                            <a href="{{ $article->share_urls['telegram'] }}" target="_blank" rel="noopener noreferrer" class="px-3 py-2 bg-[#229ED9] hover:bg-[#1A8BC2] text-white font-bold text-xs rounded-xs transition flex items-center gap-1.5 shadow-2xs">
                                <i class="fa-brands fa-telegram text-sm"></i>
                                <span>Telegram</span>
                            </a>

                            <!-- Copy Link Button -->
                            <button type="button" onclick="copyArticleLink('{{ $article->share_urls['raw_url'] }}')" id="btnCopyLink" class="px-3 py-2 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 font-bold text-xs rounded-xs transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                                <i class="fa-regular fa-copy text-sm"></i>
                                <span id="copyLinkText">Salin Link</span>
                            </button>
                        </div>
                    </div>

                </div>

            </article>

            <!-- RIGHT COLUMN: SIDEBAR (4 COLS) -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Widget: Berita Terbaru -->
                <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3.5">
                    <div class="flex items-center justify-between pb-2.5 border-b border-slate-100">
                        <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-regular fa-newspaper text-emerald-700"></i>
                            <span>Berita Lainnya</span>
                        </h3>
                        <a href="{{ route('berita.index') }}" class="text-[10px] text-emerald-700 font-bold hover:underline">Semua &rarr;</a>
                    </div>

                    <div class="space-y-3.5">
                        @foreach($recentArticles as $recent)
                            <a href="{{ route('berita.show', $recent->slug) }}" class="flex gap-3 group items-start">
                                <div class="w-16 h-12 rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $recent->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=200&auto=format&fit=crop' }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                                </div>
                                <div class="min-w-0 flex-1 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                        {{ $recent->title }}
                                    </h4>
                                    <span class="text-[10.5px] text-slate-400 block">
                                        {{ $recent->published_at ? $recent->published_at->format('d M Y') : '' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Widget: Kategori Berita -->
                <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3">
                    <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-folder-tree text-emerald-700"></i>
                        <span>Kategori Berita</span>
                    </h3>

                    <ul class="space-y-1 text-xs divide-y divide-slate-50">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" class="py-2 flex items-center justify-between text-slate-700 hover:text-emerald-700 font-medium transition {{ ($article->category_id == $cat->id) ? 'text-emerald-700 font-bold' : '' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-xs text-[10px] font-bold">
                                        {{ $cat->published_articles_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Widget: Ajakan Terbit Naskah -->
                <div class="bg-gradient-to-br from-[#006830] to-[#032c21] text-white p-5 rounded-sm shadow-md space-y-3 text-center">
                    <div class="w-10 h-10 bg-lime-400 text-slate-950 rounded-full flex items-center justify-center mx-auto text-base font-bold shadow-xs">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-white">Punya Naskah Buku?</h4>
                        <p class="text-xs text-slate-200/90 mt-1 leading-relaxed">
                            Percayakan penerbitan dan pengurusan ISBN buku Anda kepada Penerbit Persis.
                        </p>
                    </div>
                    <a href="{{ route('kontak') }}" class="block w-full py-2.5 bg-lime-400 hover:bg-lime-500 text-slate-950 rounded-xs text-xs font-bold uppercase tracking-wider transition shadow-sm">
                        Hubungi Redaksi
                    </a>
                </div>

            </aside>

        </div>

        <!-- BOTTOM SECTION: RELATED ARTICLES (3 CARDS) -->
        @if($relatedArticles->count() > 0)
        <div class="pt-8 border-t border-slate-200 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block">REKOMENDASI</span>
                    <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 leading-tight">Artikel Terkait Lainnya</h3>
                </div>
                <a href="{{ route('berita.index') }}" class="text-xs font-bold text-emerald-800 hover:underline">
                    Lihat Semua Berita &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($relatedArticles as $rel)
                    <article class="bg-white rounded-sm border border-slate-200/90 shadow-2xs hover:shadow-md transition overflow-hidden flex flex-col justify-between group">
                        <div>
                            <a href="{{ route('berita.show', $rel->slug) }}" class="block aspect-[16/9] overflow-hidden bg-slate-100 relative">
                                <img src="{{ $rel->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=400&auto=format&fit=crop' }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
                            </a>
                            <div class="p-4 space-y-2">
                                <span class="text-[10.5px] text-slate-400 block">
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

<script>
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
</script>
@endsection
