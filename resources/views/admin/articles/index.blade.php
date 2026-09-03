@extends('admin.layouts.app')

@section('title', 'Manajemen Berita & Artikel - Penerbit Persis')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight font-heading flex items-center gap-2.5">
                <i class="fa-regular fa-newspaper text-emerald-700"></i>
                <span>Manajemen Berita &amp; Artikel</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola publikasi kabar penerbitan, artikel literasi, dan panduan penulis ala WordPress.</p>
        </div>
        <div class="flex items-center gap-2.5 flex-wrap">
            <a href="{{ route('admin.articles.create') }}" class="px-4 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tulis Berita Baru</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Berita</span>
                    <span class="text-xl font-extrabold text-slate-900 mt-0.5 block">{{ $stats['total'] }}</span>
                </div>
                <div class="w-9 h-9 rounded-sm bg-slate-100 text-slate-600 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">Diterbitkan</span>
                    <span class="text-xl font-extrabold text-emerald-700 mt-0.5 block">{{ $stats['published'] }}</span>
                </div>
                <div class="w-9 h-9 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider block">Draf / Konsep</span>
                    <span class="text-xl font-extrabold text-amber-700 mt-0.5 block">{{ $stats['draft'] }}</span>
                </div>
                <div class="w-9 h-9 rounded-sm bg-amber-50 text-amber-700 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-wider block">Total Pembaca</span>
                    <span class="text-xl font-extrabold text-blue-700 mt-0.5 block">{{ number_format($stats['views'], 0, ',', '.') }}</span>
                </div>
                <div class="w-9 h-9 rounded-sm bg-blue-50 text-blue-700 flex items-center justify-center text-sm shrink-0">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-5 relative">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul, tag, atau isi berita..." class="w-full pl-9 pr-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white" />
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs text-slate-400"></i>
            </div>

            <div class="sm:col-span-3">
                <select name="category_id" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white text-slate-700">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2">
                <select name="status" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white text-slate-700">
                    <option value="">-- Semua Status --</option>
                    <option value="published" {{ $status === 'published' ? 'selected' : '' }}>Diterbitkan</option>
                    <option value="draft" {{ $status === 'draft' ? 'selected' : '' }}>Draf</option>
                </select>
            </div>

            <div class="sm:col-span-2 flex items-center gap-2">
                <button type="submit" class="w-full py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1">
                    <i class="fa-solid fa-filter text-[10px]"></i> Filter
                </button>
                @if(!empty($search) || !empty($status) || !empty($categoryId))
                    <a href="{{ route('admin.articles.index') }}" class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-sm text-xs transition" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Articles Table Container -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 font-bold uppercase tracking-wider text-[10px]">
                        <th class="py-3 px-4 w-12 text-center">#</th>
                        <th class="py-3 px-4 w-20">Cover</th>
                        <th class="py-3 px-4">Judul Berita &amp; Slug</th>
                        <th class="py-3 px-4 w-36">Kategori</th>
                        <th class="py-3 px-4 w-32">Penulis</th>
                        <th class="py-3 px-4 w-28 text-center">Tanggal</th>
                        <th class="py-3 px-4 w-20 text-center">Views</th>
                        <th class="py-3 px-4 w-24 text-center">Status</th>
                        <th class="py-3 px-4 w-28 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($articles as $index => $article)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="py-3 px-4 text-center text-slate-400 font-mono text-[11px]">
                                {{ $articles->firstItem() + $index }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="w-14 h-10 rounded-xs overflow-hidden border border-slate-200 bg-slate-100 shrink-0">
                                    <img src="{{ $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=300&auto=format&fit=crop' }}" class="w-full h-full object-cover" alt="Thumbnail" />
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-1.5 flex-wrap">
                                        @if($article->is_featured)
                                            <span class="px-1.5 py-0.2 text-[9px] font-bold bg-amber-100 text-amber-800 rounded-xs">
                                                <i class="fa-solid fa-star text-[8px] mr-0.5"></i>Utama
                                            </span>
                                        @endif
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="font-bold text-slate-900 hover:text-emerald-700 transition leading-snug">
                                            {{ $article->title }}
                                        </a>
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono truncate max-w-sm">
                                        /berita/{{ $article->slug }}
                                    </div>
                                    @if(!empty($article->tags))
                                        <div class="text-[9.5px] text-slate-500 pt-0.5 flex items-center gap-1">
                                            <i class="fa-solid fa-tags text-[8px] text-slate-400"></i>
                                            <span>{{ $article->tags }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                @if($article->category)
                                    <span class="px-2 py-0.5 text-[10.5px] font-semibold bg-emerald-50 text-emerald-800 rounded-xs border border-emerald-200">
                                        {{ $article->category->name }}
                                    </span>
                                @else
                                    <span class="text-slate-400 text-[10.5px] italic">Tanpa Kategori</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-slate-600">
                                <div class="flex items-center gap-1.5">
                                    <div class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-[9px] font-bold text-slate-700 uppercase shrink-0">
                                        {{ substr($article->author->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="truncate max-w-[100px]">{{ $article->author->name ?? 'Redaksi' }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center text-slate-500 text-[11px] whitespace-nowrap">
                                {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3 px-4 text-center font-mono font-semibold text-slate-700">
                                {{ number_format($article->views_count, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-0.5 text-[10px] font-bold rounded-xs cursor-pointer transition {{ $article->status === 'published' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}" title="Klik untuk ubah status">
                                        <i class="fa-solid fa-circle text-[7px] mr-1 {{ $article->status === 'published' ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                        {{ $article->status === 'published' ? 'Terbit' : 'Draf' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    @if($article->status === 'published')
                                        <a href="{{ route('berita.show', $article->slug) }}" target="_blank" class="p-1.5 text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 rounded-xs transition" title="Lihat di Website">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="p-1.5 text-slate-500 hover:text-amber-700 hover:bg-amber-50 rounded-xs transition" title="Edit Berita">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-700 hover:bg-rose-50 rounded-xs transition cursor-pointer" title="Hapus Berita">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-regular fa-newspaper text-3xl text-slate-300"></i>
                                    <span class="font-semibold">Belum ada berita yang diterbitkan.</span>
                                    <a href="{{ route('admin.articles.create') }}" class="mt-1 px-3 py-1.5 bg-[#006830] text-white rounded-xs text-xs font-bold transition">
                                        + Tulis Berita Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($articles->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $articles->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
