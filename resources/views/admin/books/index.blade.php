@extends('admin.layouts.app')

@section('title', 'Katalog Buku & ISBN')
@section('header_title', 'Manajemen Koleksi Buku & Terbitan')

@section('content')
    <!-- Include Cropper.js for Interactive Image Cropping -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <style>
        /* 1. Realistic 3D Perspective Hover Tilt */
        .book-stage-3d {
            perspective: 800px;
        }
        .book-hover-3d {
            transform-style: preserve-3d;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
            box-shadow: 6px 8px 16px -2px rgba(0, 0, 0, 0.25), 1px 1px 4px rgba(0,0,0,0.1);
        }
        .book-stage-3d:hover .book-hover-3d {
            transform: rotateY(-18deg) rotateX(6deg) translateY(-4px) scale(1.03);
            box-shadow: 14px 20px 28px -4px rgba(0, 0, 0, 0.38), 3px 3px 8px rgba(0,0,0,0.15);
        }
        .book-shine-layer {
            background: linear-gradient(135deg, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 60%);
        }
        .book-spine-strip {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 7px;
            background: linear-gradient(90deg, rgba(255,255,255,0.35) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.3) 100%);
            border-right: 1px solid rgba(0,0,0,0.12);
            z-index: 10;
        }
        .book-paper-edge {
            position: absolute;
            right: 0;
            top: 4px;
            bottom: 4px;
            width: 3.5px;
            background: repeating-linear-gradient(180deg, #f8fafc, #f8fafc 1.5px, #cbd5e1 1.5px, #cbd5e1 3px);
            border-left: 1px solid #94a3b8;
            border-radius: 0 2px 2px 0;
            z-index: 5;
        }

        /* Lightbox Directional Slide Animations */
        .lightbox-slide-next {
            animation: slideNext 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .lightbox-slide-prev {
            animation: slidePrev 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideNext {
            0% { opacity: 0; transform: translateX(45px) scale(0.96); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes slidePrev {
            0% { opacity: 0; transform: translateX(-45px) scale(0.96); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }

        /* Smooth Tab Transition */
        .showcase-transition {
            animation: cleanFadeSlide 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes cleanFadeSlide {
            0% { opacity: 0; transform: scale(0.97) translateY(4px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .photo-card-hover {
            transition: all 0.2s ease;
        }
        .photo-card-hover:hover {
            transform: translateY(-2px);
            border-color: #006830;
        }
    </style>

    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Katalog Buku &amp; Publikasi Ilmiah</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> {{ $books->total() }} Judul Terdaftar
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Kelola master buku, nomor ISBN, galeri foto naskah (Depan, Belakang, Isi 1 &amp; 2), harga cetak, dan status etalase.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Katalog Publik
            </a>
            <button type="button" onclick="openCreateModal()" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-xs sm:text-sm font-bold transition shadow-xs hover:shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah Buku Baru</span>
            </button>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        
        <!-- Card 1: Total Koleksi -->
        <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-emerald-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Koleksi</span>
                <h4 class="text-2xl font-black text-slate-900 font-mono mt-0.5">{{ $books->total() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Koleksi Ber-ISBN
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-book"></i>
            </div>
        </div>

        <!-- Card 2: Terbitan Baru -->
        <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-blue-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Terbitan Baru (2026)</span>
                <h4 class="text-2xl font-black text-blue-700 font-mono mt-0.5">{{ $books->where('is_new_release', true)->count() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-blue-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-star text-[9px]"></i> Rilis Terbaru
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-star"></i>
            </div>
        </div>

        <!-- Card 3: Best Seller -->
        <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-amber-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Koleksi Best Seller</span>
                <h4 class="text-2xl font-black text-amber-700 font-mono mt-0.5">{{ $books->where('is_best_seller', true)->count() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-amber-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-trophy text-[9px]"></i> Terpopuler
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-trophy"></i>
            </div>
        </div>

        <!-- Card 4: Kategori Aktif -->
        <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-purple-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Kategori Aktif</span>
                <h4 class="text-2xl font-black text-purple-700 font-mono mt-0.5">{{ count($categories ?? []) }} <span class="text-xs font-semibold text-slate-500 font-sans">Kategori</span></h4>
                <span class="text-[11px] text-purple-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-layer-group text-[9px]"></i> Klasifikasi Keilmuan
                </span>
            </div>
            <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

    </div>

    <!-- Main Table Card with Search & Filters -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-4 sm:p-5 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ route('admin.books.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full sm:w-72">
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Cari judul, nama penulis, nomor ISBN..." 
                        class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"
                    />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>

                <select name="kategori" onchange="this.form.submit()" class="w-full sm:w-48 px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Table with Large & Spacious Covers (w-20 h-28 with 3D Hover) -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-5 w-28">Sampul Buku</th>
                        <th class="py-3 px-4">Judul &amp; Penulis</th>
                        <th class="py-3 px-4">Kategori &amp; ISBN</th>
                        <th class="py-3 px-4">Format &amp; Hlm</th>
                        <th class="py-3 px-4">Harga Cetak</th>
                        <th class="py-3 px-4">Etalase / Foto</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/70 transition">
                            
                            <td class="py-3.5 px-5">
                                <div class="book-stage-3d w-20 h-28 cursor-pointer" onclick="openEditModal({{ json_encode($book) }})" title="Klik untuk Pratinjau 3D & Edit">
                                    <div class="book-hover-3d relative w-full h-full rounded-xs overflow-hidden shadow-xs border border-slate-300 bg-slate-900 select-none">
                                        <div class="book-spine-strip"></div>
                                        <div class="book-paper-edge"></div>
                                        <div class="book-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                        @if($book->cover_image && (file_exists(public_path('storage/' . $book->cover_image)) || file_exists(public_path('images/' . $book->cover_image))))
                                            <img src="{{ file_exists(public_path('storage/' . $book->cover_image)) ? asset('storage/' . $book->cover_image) : asset('images/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full bg-[#032c21] p-2 pl-3 flex flex-col justify-between text-[7px] text-white">
                                                <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                                <span class="font-black line-clamp-3 leading-tight text-[8px]">{{ $book->title }}</span>
                                                <span class="text-slate-300 truncate text-[6.5px]">{{ $book->author }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 max-w-xs">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 hover:text-emerald-700 transition cursor-pointer" onclick="openEditModal({{ json_encode($book) }})">
                                    {{ $book->title }}
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                    <span>{{ $book->author }}</span>
                                </p>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $book->category }}
                                </span>
                                <span class="text-[11px] font-mono text-slate-500 block mt-1">
                                    ISBN: {{ $book->isbn ?: '-' }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="font-bold text-slate-800 block text-xs">{{ $book->pages ? $book->pages . ' hlm' : '-' }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $book->format ?: 'UNESCO B5' }}</span>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="font-mono font-black text-emerald-700 text-xs sm:text-sm">{{ $book->price }}</span>
                            </td>

                            <td class="py-3.5 px-4 space-y-1">
                                @if($book->is_new_release)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Baru 2026
                                    </span>
                                @endif
                                @if($book->is_best_seller)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-trophy mr-1 text-[8px]"></i> Best Seller
                                    </span>
                                @endif
                                <div class="text-[10px] text-slate-400 font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-images text-emerald-600"></i>
                                    <span>4 Foto Terunggah</span>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" onclick="openEditModal({{ json_encode($book) }})" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 flex items-center justify-center transition" title="Edit Data &amp; Foto">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition" title="Hapus">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-book-open text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada buku yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($books->hasPages())
            <div class="p-4 border-t border-slate-100 flex items-center justify-end">
                {{ $books->links() }}
            </div>
        @endif

    </div>

    <!-- MODAL FORM TAMBAH / EDIT BUKU -->
    <div id="bookModal" class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto backdrop-blur-xs">
        <div class="bg-white rounded-2xl max-w-5xl w-full shadow-2xl border border-slate-200 overflow-hidden relative my-auto max-h-[92vh] flex flex-col animate-fade-in-up">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-6 py-4 flex items-center justify-between border-b border-[#064e3b] shrink-0">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <h3 id="modalHeaderTitle" class="text-sm sm:text-base font-extrabold uppercase tracking-wide text-white">Tambah Data &amp; Foto Naskah Buku</h3>
                </div>
                <button type="button" onclick="closeBookModal()" class="w-8 h-8 rounded-xl bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-sm font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form id="bookForm" method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="p-6 overflow-y-auto space-y-6">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: 3D Animated Showcase Visualizer & 4 Dropzone Cards -->
                    <div class="lg:col-span-5 space-y-5">
                        
                        <!-- 3D Interactive Visualizer Container -->
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 text-center space-y-3">
                            <div class="flex items-center justify-center gap-1.5" id="photoSwitcherTabs">
                                <button type="button" onclick="switchVisualizerTab('cover')" id="tab_cover" class="px-3 py-1 rounded-sm text-xs font-bold bg-[#006830] text-white transition shadow-2xs">Depan</button>
                                <button type="button" onclick="switchVisualizerTab('back')" id="tab_back" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Belakang</button>
                                <button type="button" onclick="switchVisualizerTab('inside1')" id="tab_inside1" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Isi 1</button>
                                <button type="button" onclick="switchVisualizerTab('inside2')" id="tab_inside2" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Isi 2</button>
                            </div>

                            <!-- 3D Perspective Stage -->
                            <div class="book-stage-3d w-44 sm:w-48 aspect-[3/4.15] mx-auto py-2 cursor-pointer group relative" onclick="openAdminLightbox()" title="Klik untuk Pratinjau Layar Penuh">
                                <div id="modalBookMockup" class="book-hover-3d relative w-full h-full rounded-xs overflow-hidden shadow-md border border-slate-300 bg-slate-900 select-none">
                                    <div class="book-spine-strip"></div>
                                    <div class="book-paper-edge"></div>
                                    <div class="book-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                    <div class="absolute top-2 right-2 w-7 h-7 rounded-sm bg-black/40 hover:bg-black/70 text-white flex items-center justify-center text-xs backdrop-blur-xs opacity-0 group-hover:opacity-100 transition z-20 pointer-events-none shadow-xs">
                                        <i class="fa-solid fa-expand"></i>
                                    </div>

                                    <img id="visImg" src="" alt="Cover" class="w-full h-full object-cover hidden showcase-transition" />

                                    <div id="visFrontVec" class="w-full h-full bg-[#032c21] p-3.5 pl-4 flex flex-col justify-between text-white border-l-4 border-emerald-400">
                                        <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                            <span id="visFrontCat" class="text-[8px] font-bold uppercase px-1.5 py-0.5 rounded-xs bg-[#064e3b] text-emerald-300">Buku Ajar</span>
                                            <span class="text-[7.5px] text-slate-300 font-mono">PERSIS PERS</span>
                                        </div>
                                        <div class="text-center my-auto py-1.5">
                                            <div class="w-5 h-0.5 bg-amber-400 mx-auto mb-1.5"></div>
                                            <h5 id="visFrontTitle" class="font-black text-xs text-white leading-tight font-heading line-clamp-3">Judul Buku</h5>
                                            <div class="w-5 h-0.5 bg-amber-400 mx-auto mt-1.5"></div>
                                        </div>
                                        <div class="pt-1 border-t border-white/20 text-center">
                                            <span id="visFrontAuthor" class="text-[9px] text-slate-200 block font-medium truncate">Nama Penulis</span>
                                        </div>
                                    </div>

                                    <div id="visInsideVec" class="w-full h-full bg-[#fdfbf7] text-slate-800 p-3.5 pl-4 flex flex-col justify-between hidden border-l-2 border-slate-300 showcase-transition">
                                        <div class="border-b border-slate-300 pb-1 flex justify-between items-center text-[7.5px] font-bold text-slate-500">
                                            <span id="visInsideLabel">BAGIAN ISI NASKAH</span>
                                            <span>hlm. 1</span>
                                        </div>
                                        <div class="text-[7.5px] text-slate-600 leading-relaxed my-auto space-y-1 font-serif">
                                            <p class="font-bold text-slate-800 text-[8.5px]">Pratinjau Isi Halaman</p>
                                            <p>Kajian akademik dan riset ilmiah kurikulum perguruan tinggi...</p>
                                            <div class="w-full h-0.5 bg-slate-200 my-1"></div>
                                            <p>Standar UNESCO B5 Bookpaper.</p>
                                        </div>
                                        <div class="pt-1 border-t border-slate-200 text-center text-[7px] text-slate-400 font-mono">
                                            <span>PERSIS PERS</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-xs px-2 pt-1 border-t border-slate-200">
                                <span class="text-[11px] text-slate-400 flex items-center gap-1 font-semibold">
                                    <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i> Efek 3D Aktif
                                </span>
                                <span id="visPrice" class="font-mono font-black text-[#006830] text-sm">Rp 75.000</span>
                            </div>
                        </div>

                        <!-- 4 Direct Upload Cards -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-camera text-emerald-600"></i> Upload Foto Naskah (Klik Kotak)
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">Maks. 50MB/foto</span>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                
                                <label for="in_cover_image" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-xl border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">1. Sampul Depan <span class="text-rose-500">*</span></span>
                                        <span id="badge_cover" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_cover" class="aspect-[3/2] bg-white rounded-lg border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="cover_image" id="in_cover_image" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'cover')" />
                                </label>

                                <label for="in_back_cover" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-xl border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">2. Sampul Belakang</span>
                                        <span id="badge_back" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_back" class="aspect-[3/2] bg-white rounded-lg border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="back_cover_image" id="in_back_cover" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'back')" />
                                </label>

                                <label for="in_inside1" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-xl border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">3. Halaman Isi 1</span>
                                        <span id="badge_inside1" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_inside1" class="aspect-[3/2] bg-white rounded-lg border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="inside_preview_image" id="in_inside1" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'inside1')" />
                                </label>

                                <label for="in_inside2" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-xl border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">4. Halaman Isi 2</span>
                                        <span id="badge_inside2" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_inside2" class="aspect-[3/2] bg-white rounded-lg border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="additional_image" id="in_inside2" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'inside2')" />
                                </label>

                            </div>
                        </div>

                    </div>

                    <!-- Right: Book Metadata Fields -->
                    <div class="lg:col-span-7 space-y-4">
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Lengkap Buku <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" id="in_title" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Metodologi Penelitian Studi Islam & Integrasi Sains" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Penulis / Dosen <span class="text-rose-500">*</span></label>
                                <input type="text" name="author" id="in_author" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag." />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Buku <span class="text-rose-500">*</span></label>
                                <input type="text" name="category" id="in_category" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Buku Ajar / Studi Islam" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor ISBN Resmi (Perpusnas)</label>
                                <input type="text" name="isbn" id="in_isbn" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono" placeholder="978-623-8812-xx-x" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Harga Cetak Resmi <span class="text-rose-500">*</span></label>
                                <input type="text" name="price" id="in_price" required oninput="formatRupiahInput(this)" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold text-emerald-800" placeholder="Rp 75.000" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tahun Terbit <span class="text-rose-500">*</span></label>
                                <input type="text" name="year" id="in_year" value="2026" required class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono text-center font-bold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Jumlah Halaman <span class="text-rose-500">*</span></label>
                                <input type="text" name="pages" id="in_pages" placeholder="240" required class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-bold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Publikasi</label>
                                <select name="status" id="in_status" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 bg-white font-medium">
                                    <option value="published">Tayang (Published)</option>
                                    <option value="draft">Draf (Draft)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Format &amp; Standar Cetak</label>
                            <input type="text" name="format" id="in_format" value="UNESCO B5 (Bookpaper)" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Sinopsis Ringkas</label>
                            <textarea name="synopsis" id="in_synopsis" rows="3" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Deskripsi ringkas mengenai isi dan cakupan buku..."></textarea>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex flex-wrap items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="is_new_release" id="in_new_release" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500" />
                                <span class="text-xs font-bold text-slate-800">🌟 Koleksi Terbitan Baru (2026)</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="is_best_seller" id="in_best_seller" value="1" class="w-4 h-4 rounded text-amber-600 focus:ring-amber-500" />
                                <span class="text-xs font-bold text-slate-800">🏆 Koleksi Best Seller</span>
                            </label>
                        </div>

                    </div>

                </div>

                <!-- Footer Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeBookModal()" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-bold transition shadow-xs hover:shadow-md flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Data Buku</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- CROPPER.JS MODAL -->
    <div id="cropperModal" class="fixed inset-0 z-60 bg-black/80 hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="bg-[#032c21] text-white px-5 py-3.5 flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Sesuaikan Pemotongan Foto Buku</span>
                <button type="button" onclick="closeCropperModal()" class="text-slate-300 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-4 flex-1 overflow-hidden flex items-center justify-center bg-slate-900">
                <img id="cropperImage" src="" alt="Crop Preview" class="max-h-[60vh] max-w-full" />
            </div>
            <div class="p-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <button type="button" onclick="setCropRatio(3/4.15)" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-white border border-slate-200 hover:bg-slate-100">UNESCO 3:4.15</button>
                    <button type="button" onclick="setCropRatio(1/1.4)" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-white border border-slate-200 hover:bg-slate-100">Isi Halaman</button>
                    <button type="button" onclick="setCropRatio(NaN)" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-white border border-slate-200 hover:bg-slate-100">Bebas</button>
                </div>
                <button type="button" onclick="applyCrop()" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs rounded-xl shadow-xs">
                    Terapkan Crop
                </button>
            </div>
        </div>
    </div>

    <!-- ULTRA-HIGH DEFINITION FULLSCREEN LIGHTBOX FOR ADMIN -->
    <div id="adminLightboxModal" class="fixed inset-0 z-[100] bg-black/95 hidden items-center justify-center p-4 backdrop-blur-md" onclick="if(event.target.id==='adminLightboxModal') closeAdminLightbox()">
        <div class="absolute top-4 inset-x-4 sm:inset-x-8 flex items-center justify-between text-white z-50 pointer-events-none">
            <div class="flex items-center gap-2 bg-black/70 px-3.5 py-1.5 rounded-sm border border-white/20 pointer-events-auto shadow-md">
                <span id="adminLightboxLabel" class="text-xs font-bold text-emerald-400 font-mono tracking-wider">SAMPUL DEPAN</span>
            </div>
            <button type="button" onclick="closeAdminLightbox()" class="w-9 h-9 rounded-sm bg-white/10 hover:bg-rose-600 text-white flex items-center justify-center text-sm transition pointer-events-auto shadow-md border border-white/20" title="Tutup (Esc)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <button type="button" onclick="prevAdminLightbox()" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-sm bg-white/10 hover:bg-emerald-600 text-white flex items-center justify-center text-lg transition z-50 shadow-lg border border-white/20" title="Foto Sebelumnya">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button type="button" onclick="nextAdminLightbox()" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-11 h-11 rounded-sm bg-white/10 hover:bg-emerald-600 text-white flex items-center justify-center text-lg transition z-50 shadow-lg border border-white/20" title="Foto Selanjutnya">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center justify-center select-none my-auto">
            <div class="relative rounded-sm overflow-hidden shadow-2xl border border-white/20 bg-slate-950 max-h-[72vh] aspect-[3/4.15]">
                <img id="adminLightboxImage" src="" alt="Zoomed Cover" class="w-full h-full object-contain" />
            </div>
            <div class="mt-3 text-center">
                <h4 id="adminLightboxTitle" class="text-white text-sm font-bold truncate max-w-xl font-heading">
                    Pratinjau Foto Naskah
                </h4>
            </div>
        </div>
    </div>

    <!-- JS Logic -->
    <script>
        let currentPhotoObj = { cover: null, back: null, inside1: null, inside2: null };
        let activeTab = 'cover';
        let cropper = null;
        let activeCropKey = null;

        const tabKeys = ['cover', 'back', 'inside1', 'inside2'];
        const tabLabels = { cover: 'Sampul Depan', back: 'Sampul Belakang', inside1: 'Halaman Isi 1', inside2: 'Halaman Isi 2' };

        function openAdminLightbox() {
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const bookModal = document.getElementById('bookModal');
            if (bookModal) {
                bookModal.classList.add('hidden');
                bookModal.classList.remove('flex');
            }
            document.getElementById('adminLightboxImage').src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
            document.getElementById('adminLightboxTitle').innerText = document.getElementById('in_title').value || 'Pratinjau Naskah';
            const modal = document.getElementById('adminLightboxModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAdminLightbox() {
            const modal = document.getElementById('adminLightboxModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            const bookModal = document.getElementById('bookModal');
            if (bookModal) {
                bookModal.classList.remove('hidden');
                bookModal.classList.add('flex');
            }
        }

        function prevAdminLightbox() {
            let idx = tabKeys.indexOf(activeTab);
            idx = (idx - 1 + tabKeys.length) % tabKeys.length;
            switchVisualizerTab(tabKeys[idx]);
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const img = document.getElementById('adminLightboxImage');
            img.classList.remove('lightbox-slide-next', 'lightbox-slide-prev');
            void img.offsetWidth;
            img.classList.add('lightbox-slide-prev');
            img.src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
        }

        function nextAdminLightbox() {
            let idx = tabKeys.indexOf(activeTab);
            idx = (idx + 1) % tabKeys.length;
            switchVisualizerTab(tabKeys[idx]);
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const img = document.getElementById('adminLightboxImage');
            img.classList.remove('lightbox-slide-next', 'lightbox-slide-prev');
            void img.offsetWidth;
            img.classList.add('lightbox-slide-next');
            img.src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
        }

        function openCreateModal() {
            document.getElementById('bookForm').action = "{{ route('admin.books.store') }}";
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('modalHeaderTitle').innerText = 'Tambah Master Buku & Foto Naskah';
            document.getElementById('bookForm').reset();
            currentPhotoObj = { cover: null, back: null, inside1: null, inside2: null };
            resetThumbnails();
            switchVisualizerTab('cover');
            updateVisualizerLive();

            const modal = document.getElementById('bookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditModal(book) {
            document.getElementById('bookForm').action = "/admin/books/" + book.id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('modalHeaderTitle').innerText = 'Edit Data & Foto Buku: ' + book.title;

            document.getElementById('in_title').value = book.title || '';
            document.getElementById('in_author').value = book.author || '';
            document.getElementById('in_category').value = book.category || '';
            document.getElementById('in_isbn').value = book.isbn || '';
            document.getElementById('in_price').value = book.price || '';
            document.getElementById('in_year').value = book.year || '2026';
            document.getElementById('in_pages').value = book.pages || '';
            document.getElementById('in_status').value = book.status || 'published';
            document.getElementById('in_format').value = book.format || 'UNESCO B5 (Bookpaper)';
            document.getElementById('in_synopsis').value = book.synopsis || '';
            document.getElementById('in_new_release').checked = Boolean(book.is_new_release);
            document.getElementById('in_best_seller').checked = Boolean(book.is_best_seller);

            currentPhotoObj = {
                cover: book.cover_image ? ('/storage/' + book.cover_image) : null,
                back: book.back_cover_image ? ('/storage/' + book.back_cover_image) : null,
                inside1: book.inside_preview_image ? ('/storage/' + book.inside_preview_image) : null,
                inside2: book.additional_image ? ('/storage/' + book.additional_image) : null,
            };

            setThumbPreview('cover', currentPhotoObj.cover);
            setThumbPreview('back', currentPhotoObj.back);
            setThumbPreview('inside1', currentPhotoObj.inside1);
            setThumbPreview('inside2', currentPhotoObj.inside2);

            switchVisualizerTab('cover');
            updateVisualizerLive();

            const modal = document.getElementById('bookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeBookModal() {
            const modal = document.getElementById('bookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function switchVisualizerTab(tab) {
            activeTab = tab;
            ['cover', 'back', 'inside1', 'inside2'].forEach(t => {
                const btn = document.getElementById('tab_' + t);
                if (btn) {
                    btn.className = t === tab 
                        ? 'px-3 py-1 rounded-sm text-xs font-bold bg-[#006830] text-white transition shadow-2xs'
                        : 'px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
                }
            });

            const imgEl = document.getElementById('visImg');
            const frontVec = document.getElementById('visFrontVec');
            const insideVec = document.getElementById('visInsideVec');

            imgEl.classList.add('hidden');
            frontVec.classList.add('hidden');
            insideVec.classList.add('hidden');

            const url = currentPhotoObj[tab];
            if (url) {
                imgEl.src = url;
                imgEl.classList.remove('hidden');
            } else {
                if (tab === 'cover' || tab === 'back') {
                    frontVec.classList.remove('hidden');
                } else {
                    insideVec.classList.remove('hidden');
                }
            }
        }

        function updateVisualizerLive() {
            const title = document.getElementById('in_title').value || 'Judul Buku';
            const author = document.getElementById('in_author').value || 'Nama Penulis';
            const category = document.getElementById('in_category').value || 'Buku Ajar';
            const price = document.getElementById('in_price').value || 'Rp 75.000';

            document.getElementById('visFrontTitle').innerText = title;
            document.getElementById('visFrontAuthor').innerText = author;
            document.getElementById('visFrontCat').innerText = category;
            document.getElementById('visPrice').innerText = price;
        }

        function formatRupiahInput(input) {
            let val = input.value.replace(/[^0-9]/g, '');
            if (val) {
                input.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
            }
            updateVisualizerLive();
        }

        function setThumbPreview(key, url) {
            const box = document.getElementById('thumb_box_' + key);
            const badge = document.getElementById('badge_' + key);
            if (url) {
                box.innerHTML = '<img src="' + url + '" class="w-full h-full object-cover" />';
                badge.innerText = 'Terunggah';
                badge.className = 'text-[9px] px-1.5 py-0.5 rounded font-bold bg-emerald-100 text-emerald-800';
            } else {
                box.innerHTML = '<i class="fa-solid fa-cloud-arrow-up text-xl"></i>';
                badge.innerText = 'Pilih';
                badge.className = 'text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600';
            }
        }

        function resetThumbnails() {
            ['cover', 'back', 'inside1', 'inside2'].forEach(k => setThumbPreview(k, null));
        }

        function handleImageSelection(input, key) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    activeCropKey = key;
                    openCropper(e.target.result);
                }
                reader.readAsDataURL(file);
            }
        }

        function openCropper(imageSrc) {
            const modal = document.getElementById('cropperModal');
            const img = document.getElementById('cropperImage');
            img.src = imageSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (cropper) cropper.destroy();
            cropper = new Cropper(img, {
                aspectRatio: activeCropKey === 'cover' || activeCropKey === 'back' ? (3 / 4.15) : (1 / 1.4),
                viewMode: 1,
                autoCropArea: 1,
            });
        }

        function setCropRatio(ratio) {
            if (cropper) cropper.setAspectRatio(ratio);
        }

        function closeCropperModal() {
            const modal = document.getElementById('cropperModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        function applyCrop() {
            if (!cropper || !activeCropKey) return;
            const canvas = cropper.getCroppedCanvas({ width: 800, height: 1100 });
            canvas.toBlob(blob => {
                const file = new File([blob], 'cropped_' + activeCropKey + '.jpg', { type: 'image/jpeg' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);

                const inputId = activeCropKey === 'cover' ? 'in_cover_image'
                              : activeCropKey === 'back' ? 'in_back_cover'
                              : activeCropKey === 'inside1' ? 'in_inside1'
                              : 'in_inside2';
                document.getElementById(inputId).files = dataTransfer.files;

                const url = URL.createObjectURL(blob);
                currentPhotoObj[activeCropKey] = url;
                setThumbPreview(activeCropKey, url);
                switchVisualizerTab(activeCropKey);
                closeCropperModal();
            }, 'image/jpeg', 0.92);
        }
    </script>
@endsection
