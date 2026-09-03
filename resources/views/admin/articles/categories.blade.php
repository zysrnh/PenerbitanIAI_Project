@extends('admin.layouts.app')

@section('title', 'Kategori Berita & Artikel - Penerbit Persis')

@section('content')
<div class="space-y-6">

    <!-- Header Breadcrumb & Title -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('admin.articles.index') }}" class="hover:text-emerald-700 transition">Berita</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">Kategori</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <i class="fa-solid fa-tags text-emerald-700 text-lg"></i>
                <span>Kelola Kategori Berita</span>
            </h1>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="px-3 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
            <i class="fa-solid fa-arrow-left text-slate-400"></i>
            <span>Kembali ke Berita</span>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Form Tambah Kategori (4 Cols) -->
        <div class="lg:col-span-4 bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-4">
            <div class="pb-3 border-b border-slate-100">
                <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider">Tambah Kategori Baru</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Kelompokkan berita agar pembaca mudah menemukan topik.</p>
            </div>

            <form method="POST" action="{{ route('admin.article-categories.store') }}" class="space-y-3.5 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-800 mb-1">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required placeholder="Misal: Kabar Penerbitan" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white" />
                </div>

                <div>
                    <label class="block font-bold text-slate-800 mb-1">Slug URL (Opsional)</label>
                    <input type="text" name="slug" placeholder="kabar-penerbitan (otomatis)" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white font-mono text-[11px]" />
                </div>

                <div>
                    <label class="block font-bold text-slate-800 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" placeholder="Deskripsi topik kategori..." class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white"></textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-800 mb-1">Nomor Urutan</label>
                    <input type="number" name="order" value="0" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-xs flex items-center justify-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Daftar Kategori (8 Cols) -->
        <div class="lg:col-span-8 bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
            <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <span class="font-bold text-xs text-slate-800 uppercase tracking-wider">Daftar Kategori Tersedia</span>
                <span class="text-[10px] text-slate-500 font-mono">{{ $categories->count() }} kategori</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-2.5 px-4 w-12 text-center">Urut</th>
                            <th class="py-2.5 px-4">Nama Kategori &amp; Slug</th>
                            <th class="py-2.5 px-4">Deskripsi</th>
                            <th class="py-2.5 px-4 w-24 text-center">Jumlah Berita</th>
                            <th class="py-2.5 px-4 w-20 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($categories as $cat)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 text-center font-mono font-bold text-slate-400">
                                    {{ $cat->order }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900">{{ $cat->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono">/berita?kategori={{ $cat->slug }}</div>
                                </td>
                                <td class="py-3 px-4 text-slate-500 text-[11px]">
                                    {{ $cat->description ?: '-' }}
                                </td>
                                <td class="py-3 px-4 text-center font-bold text-emerald-800">
                                    <span class="px-2 py-0.5 bg-emerald-50 rounded-xs border border-emerald-200 text-[10.5px]">
                                        {{ $cat->articles_count }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <form action="{{ route('admin.article-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Berita di dalamnya tidak akan terhapus.')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 rounded-xs transition cursor-pointer" title="Hapus Kategori">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">
                                    Belum ada kategori berita.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection
