@extends('admin.layouts.app')

@section('title', 'Katalog Buku & ISBN')
@section('header_title', 'Manajemen Koleksi Buku & Terbitan')

@section('content')
    <style>
        /* 3D Realistic Book Styling & Micro-Animations */
        .book-container-3d {
            perspective: 1000px;
        }
        .book-3d {
            transform-style: preserve-3d;
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            box-shadow: 12px 16px 28px -6px rgba(0, 0, 0, 0.35), 2px 2px 6px rgba(0,0,0,0.15);
        }
        .book-container-3d:hover .book-3d {
            transform: rotateY(-18deg) rotateX(6deg) translateY(-4px) scale(1.03);
            box-shadow: 18px 24px 36px -6px rgba(0, 0, 0, 0.45), 4px 4px 10px rgba(0,0,0,0.2);
        }
        .book-spine-effect {
            background: linear-gradient(90deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 15%, rgba(0,0,0,0.25) 85%, rgba(0,0,0,0.4) 100%);
        }
        .book-shine {
            background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0) 60%);
        }
        .photo-card-hover {
            transition: all 0.25s ease;
        }
        .photo-card-hover:hover {
            transform: translateY(-2px);
            border-color: #006830;
        }
        .animate-flip-3d {
            animation: flipIn 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }
        @keyframes flipIn {
            0% { transform: scale(0.92) rotateY(35deg); opacity: 0.7; }
            100% { transform: scale(1) rotateY(0deg); opacity: 1; }
        }
    </style>

    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Katalog Buku &amp; Publikasi Ilmiah</h3>
                <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> {{ $totalBooks }} Judul Terdaftar
                </span>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola master buku, nomor ISBN, galeri 4 foto naskah, harga cetak, dan status etalase.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Katalog Publik
            </a>
            <button type="button" onclick="openAddBookModal()" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-xs sm:text-sm font-bold transition shadow-xs hover:shadow-md flex items-center gap-2 group">
                <i class="fa-solid fa-plus transition-transform group-hover:rotate-90 duration-300"></i> Tambah Buku Baru
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm font-medium flex items-center justify-between shadow-xs animate-fade-in-up">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm font-medium space-y-1">
            @foreach($errors->all() as $error)
                <div>&bull; {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4 mb-6">
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5 hover:shadow-md transition">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#006830] flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Total Koleksi</span>
                <span class="text-lg font-black text-slate-900 leading-tight block mt-0.5">{{ $totalBooks }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5 hover:shadow-md transition">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-sparkles"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Terbitan Baru (2026)</span>
                <span class="text-lg font-black text-blue-700 leading-tight block mt-0.5">{{ $newReleasesCount }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5 hover:shadow-md transition">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Koleksi Best Seller</span>
                <span class="text-lg font-black text-amber-700 leading-tight block mt-0.5">{{ $bestSellersCount }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5 hover:shadow-md transition">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Kategori Aktif</span>
                <span class="text-lg font-black text-purple-700 leading-tight block mt-0.5">{{ $categories->count() }} Kategori</span>
            </div>
        </div>
    </div>

    <!-- Main Data Table Box -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Filter Bar -->
        <div class="p-4 border-b border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 bg-slate-50/50">
            <form method="GET" action="{{ route('admin.books.index') }}" class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-2.5">
                <div class="relative w-full sm:w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari judul, nama penulis, nomor ISBN..." 
                        class="w-full pl-9 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 bg-white focus:outline-hidden focus:border-emerald-600 shadow-2xs"
                    />
                </div>

                <select name="category" onchange="this.form.submit()" class="w-full sm:w-48 px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white focus:outline-hidden focus:border-emerald-600 shadow-2xs">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                @if(request('search') || (request('category') && request('category') !== 'all'))
                    <a href="{{ route('admin.books.index') }}" class="px-3 py-2 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 rounded-xl">Reset Filter</a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-200 uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4">Sampul Buku</th>
                        <th class="py-3.5 px-4">Judul &amp; Penulis</th>
                        <th class="py-3.5 px-4">Kategori &amp; ISBN</th>
                        <th class="py-3.5 px-4">Format &amp; Hlm</th>
                        <th class="py-3.5 px-4">Harga Cetak</th>
                        <th class="py-3.5 px-4">Etalase / Foto</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/80 transition">
                            <!-- Cover Mini -->
                            <td class="py-3.5 px-4">
                                @if($book->cover_image && Storage::disk('public')->exists($book->cover_image))
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-11 aspect-[3/4.2] object-cover rounded-xs shadow-xs border border-slate-200 hover:scale-110 transition cursor-pointer" onclick="openEditBookModal({{ json_encode($book) }})" />
                                @else
                                    <div class="w-10 aspect-[3/4.2] rounded-xs bg-[#032c21] text-white p-1 flex flex-col justify-between border-l-2 border-emerald-400 shadow-2xs text-[6px]">
                                        <span class="font-extrabold truncate text-emerald-300">{{ $book->category }}</span>
                                        <span class="font-black text-[7px] leading-tight line-clamp-2">{{ $book->title }}</span>
                                        <span class="truncate text-slate-300 font-mono">{{ $book->year }}</span>
                                    </div>
                                @endif
                            </td>

                            <!-- Title & Author -->
                            <td class="py-3.5 px-4 max-w-xs">
                                <h4 class="font-bold text-slate-900 leading-snug line-clamp-2 text-xs">{{ $book->title }}</h4>
                                <span class="text-slate-500 text-[11px] block mt-0.5">{{ $book->author }}</span>
                            </td>

                            <!-- Category & ISBN -->
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-[#006830] font-bold text-[10px] border border-emerald-200 inline-block mb-1">
                                    {{ $book->category }}
                                </span>
                                <span class="font-mono text-[11px] text-slate-600 block">ISBN: {{ $book->isbn ?: '-' }}</span>
                            </td>

                            <!-- Format & Pages -->
                            <td class="py-3.5 px-4">
                                <span class="font-medium text-slate-800 block">{{ $book->pages }}</span>
                                <span class="text-[11px] text-slate-500 block truncate">{{ $book->format }}</span>
                            </td>

                            <!-- Price -->
                            <td class="py-3.5 px-4">
                                <span class="font-extrabold text-[#006830] text-xs font-mono">{{ $book->price }}</span>
                            </td>

                            <!-- Badges & Photos Count -->
                            <td class="py-3.5 px-4 space-y-1">
                                <div class="flex flex-wrap gap-1">
                                    @if($book->is_new_release)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            <i class="fa-solid fa-sparkles text-[7px]"></i> Baru 2026
                                        </span>
                                    @endif
                                    @if($book->is_best_seller)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                            <i class="fa-solid fa-trophy text-[7px]"></i> Best Seller
                                        </span>
                                    @endif
                                </div>
                                <div class="text-[10px] text-slate-500 flex items-center gap-1">
                                    <i class="fa-solid fa-images text-emerald-600"></i>
                                    <span>{{ count($book->photo_urls) }} Foto Terunggah</span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" onclick="openEditBookModal({{ json_encode($book) }})" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-700 flex items-center justify-center text-xs transition shadow-2xs" title="Edit Buku & Foto">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini beserta seluruh fotonya?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center text-xs transition shadow-2xs" title="Hapus Buku">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-book-open text-3xl mb-3 block text-slate-300"></i>
                                <span class="text-sm font-semibold block text-slate-600">Belum ada buku terdaftar</span>
                                <span class="text-xs text-slate-400 block mt-1">Klik tombol "+ Tambah Buku Baru" untuk menambahkan buku ke katalog.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($books->hasPages())
            <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs">
                {{ $books->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL INTERAKTIF TAMBAH & EDIT BUKU (ANIMATED 3D VISUALIZER + 4 PHOTO SLOTS) -->
    <div id="bookFormModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto backdrop-blur-xs">
        <div class="bg-white rounded-2xl max-w-5xl w-full shadow-2xl border border-slate-200 overflow-hidden relative animate-fade-in-up my-auto max-h-[95vh] flex flex-col">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-6 py-4 flex items-center justify-between border-b border-[#064e3b] shrink-0">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span id="modalFormTitle" class="text-sm font-bold uppercase tracking-wider text-emerald-300">Kelola Koleksi Buku &amp; Galeri Foto</span>
                </div>
                <button type="button" onclick="closeBookFormModal()" class="w-8 h-8 rounded-lg bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-sm font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Form Body (2-Column Grid: Left Visual 3D Showcase & 4 Slots, Right Form) -->
            <form id="bookFormElement" method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="p-6 overflow-y-auto">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST" />

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: Interactive Animated 3D Showcase + 4 Photo Slots -->
                    <div class="lg:col-span-5 space-y-4 bg-slate-50/80 p-4 rounded-xl border border-slate-200">
                        
                        <!-- Top: Animated 3D Book Showcase Box -->
                        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-xs flex flex-col items-center">
                            
                            <!-- Angle Switcher Pills -->
                            <div class="flex items-center justify-center gap-1.5 mb-3 w-full border-b border-slate-100 pb-2.5">
                                <button type="button" onclick="switchShowcaseAngle('cover')" id="btnAngleCover" class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-[#006830] text-white transition shadow-2xs">
                                    Depan
                                </button>
                                <button type="button" onclick="switchShowcaseAngle('back')" id="btnAngleBack" class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                    Belakang
                                </button>
                                <button type="button" onclick="switchShowcaseAngle('inside')" id="btnAngleInside" class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                    Isi
                                </button>
                                <button type="button" onclick="switchShowcaseAngle('physical')" id="btnAnglePhysical" class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                    Fisik
                                </button>
                            </div>

                            <!-- 3D Perspective Book Wrapper -->
                            <div class="book-container-3d py-1 flex items-center justify-center">
                                <div id="main3dBookWrapper" class="book-3d relative w-36 aspect-[3/4.2] rounded-xs overflow-hidden select-none cursor-pointer">
                                    
                                    <!-- Dynamic Image Display (Active when photo selected) -->
                                    <img id="main3dBookImage" src="" alt="Book Cover" class="w-full h-full object-cover hidden" />

                                    <!-- Realistic Spine Crease Bar & Edge Highlight -->
                                    <div id="spineCrease" class="absolute inset-0 pointer-events-none book-spine-effect"></div>
                                    <div class="absolute inset-0 pointer-events-none book-shine"></div>

                                    <!-- Vector Cover (Active by default or when no image) -->
                                    <div id="main3dVectorCover" class="w-full h-full bg-[#032c21] text-white p-3 flex flex-col justify-between border-l-4 border-emerald-400">
                                        <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                            <span id="prev_cover_cat" class="text-[7.5px] font-extrabold uppercase px-1 py-0.5 rounded-xs bg-[#064e3b] text-emerald-300 truncate">Buku Ajar</span>
                                            <span class="text-[7.5px] text-slate-300 font-mono">PERSIS</span>
                                        </div>

                                        <div class="text-center my-auto py-1">
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mb-1"></div>
                                            <h5 id="prev_cover_title" class="font-black text-[10.5px] text-white leading-tight font-heading line-clamp-3">Judul Buku</h5>
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mt-1"></div>
                                        </div>

                                        <div class="pt-1 border-t border-white/20 text-center">
                                            <span id="prev_cover_author" class="text-[8.5px] text-slate-200 block font-medium truncate">Nama Penulis</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Live Price Tag & Hint -->
                            <div class="mt-3 flex items-center justify-between w-full pt-2 border-t border-slate-100 text-xs">
                                <span class="text-[10px] text-slate-400 font-medium">
                                    <i class="fa-solid fa-hand-pointer text-emerald-600"></i> Sorot kursor utk efek 3D
                                </span>
                                <span id="prev_cover_price" class="font-black text-[#006830] font-mono text-sm">Rp 75.000</span>
                            </div>
                        </div>

                        <!-- 4 Image Upload Cards Grid -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">
                                    <i class="fa-solid fa-images text-emerald-600 mr-1"></i> Galeri Naskah (2 - 4 Foto)
                                </span>
                                <span class="text-[9px] text-slate-400 font-medium">Maks. 50MB/foto</span>
                            </div>

                            <div class="grid grid-cols-2 gap-2.5 text-[10.5px]">
                                
                                <!-- Foto 1: Sampul Depan -->
                                <div class="photo-card-hover p-2 bg-white rounded-lg border border-slate-200 shadow-2xs space-y-1 text-center">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-700 text-[9.5px]">1. Depan <span class="text-rose-500">*</span></span>
                                        <span id="badgeCover" class="hidden text-[8px] font-bold text-emerald-700 bg-emerald-50 px-1 rounded">Ada</span>
                                    </div>
                                    <div id="previewBoxCover" onclick="switchShowcaseAngle('cover')" class="w-full h-16 rounded bg-slate-100 border border-dashed border-slate-300 flex items-center justify-center overflow-hidden cursor-pointer hover:border-emerald-500 transition">
                                        <span class="text-[8.5px] text-slate-400">Pilih Foto</span>
                                    </div>
                                    <input type="file" name="cover_image" id="in_cover_image" accept="image/*" onchange="handleImageSlotChange(this, 'previewBoxCover', 'badgeCover', 'cover')" class="w-full text-[8.5px] file:mr-1 file:py-0.5 file:px-1.5 file:rounded file:border-0 file:text-[8.5px] file:bg-emerald-50 file:text-emerald-700 cursor-pointer" />
                                </div>

                                <!-- Foto 2: Sampul Belakang -->
                                <div class="photo-card-hover p-2 bg-white rounded-lg border border-slate-200 shadow-2xs space-y-1 text-center">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-700 text-[9.5px]">2. Belakang</span>
                                        <span id="badgeBack" class="hidden text-[8px] font-bold text-emerald-700 bg-emerald-50 px-1 rounded">Ada</span>
                                    </div>
                                    <div id="previewBoxBack" onclick="switchShowcaseAngle('back')" class="w-full h-16 rounded bg-slate-100 border border-dashed border-slate-300 flex items-center justify-center overflow-hidden cursor-pointer hover:border-emerald-500 transition">
                                        <span class="text-[8.5px] text-slate-400">Pilih Foto</span>
                                    </div>
                                    <input type="file" name="back_cover_image" id="in_back_cover" accept="image/*" onchange="handleImageSlotChange(this, 'previewBoxBack', 'badgeBack', 'back')" class="w-full text-[8.5px] file:mr-1 file:py-0.5 file:px-1.5 file:rounded file:border-0 file:text-[8.5px] file:bg-emerald-50 file:text-emerald-700 cursor-pointer" />
                                </div>

                                <!-- Foto 3: Halaman Isi / Daftar Isi -->
                                <div class="photo-card-hover p-2 bg-white rounded-lg border border-slate-200 shadow-2xs space-y-1 text-center">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-700 text-[9.5px]">3. Isi / Daftar</span>
                                        <span id="badgeInside" class="hidden text-[8px] font-bold text-emerald-700 bg-emerald-50 px-1 rounded">Ada</span>
                                    </div>
                                    <div id="previewBoxInside" onclick="switchShowcaseAngle('inside')" class="w-full h-16 rounded bg-slate-100 border border-dashed border-slate-300 flex items-center justify-center overflow-hidden cursor-pointer hover:border-emerald-500 transition">
                                        <span class="text-[8.5px] text-slate-400">Pilih Foto</span>
                                    </div>
                                    <input type="file" name="inside_preview_image" id="in_inside_img" accept="image/*" onchange="handleImageSlotChange(this, 'previewBoxInside', 'badgeInside', 'inside')" class="w-full text-[8.5px] file:mr-1 file:py-0.5 file:px-1.5 file:rounded file:border-0 file:text-[8.5px] file:bg-emerald-50 file:text-emerald-700 cursor-pointer" />
                                </div>

                                <!-- Foto 4: Foto Fisik / Mockup -->
                                <div class="photo-card-hover p-2 bg-white rounded-lg border border-slate-200 shadow-2xs space-y-1 text-center">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-700 text-[9.5px]">4. Fisik / Detail</span>
                                        <span id="badgePhysical" class="hidden text-[8px] font-bold text-emerald-700 bg-emerald-50 px-1 rounded">Ada</span>
                                    </div>
                                    <div id="previewBoxPhysical" onclick="switchShowcaseAngle('physical')" class="w-full h-16 rounded bg-slate-100 border border-dashed border-slate-300 flex items-center justify-center overflow-hidden cursor-pointer hover:border-emerald-500 transition">
                                        <span class="text-[8.5px] text-slate-400">Pilih Foto</span>
                                    </div>
                                    <input type="file" name="additional_image" id="in_additional_img" accept="image/*" onchange="handleImageSlotChange(this, 'previewBoxPhysical', 'badgePhysical', 'physical')" class="w-full text-[8.5px] file:mr-1 file:py-0.5 file:px-1.5 file:rounded file:border-0 file:text-[8.5px] file:bg-emerald-50 file:text-emerald-700 cursor-pointer" />
                                </div>

                            </div>
                        </div>

                        <!-- Upload Sample PDF -->
                        <div class="pt-2 border-t border-slate-200">
                            <label class="block text-[11px] font-bold text-slate-700 mb-1">
                                <i class="fa-solid fa-file-pdf text-red-600"></i> Dokumen Sampel PDF (Bab 1 / Daftar Isi)
                            </label>
                            <input type="file" name="sample_pdf" id="form_pdf_file" accept="application/pdf" class="w-full text-[10px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer" />
                            <span class="text-[9px] text-slate-400 block mt-0.5">Batasan upload dokumen: Hingga 100 MB</span>
                        </div>
                    </div>

                    <!-- Right: Categorized Form Fields -->
                    <div class="lg:col-span-7 space-y-4 text-xs">
                        
                        <!-- 1. Info Utama -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Judul Lengkap Buku <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" id="form_title" required oninput="updateModalMockup()" placeholder="Contoh: Metodologi Penelitian Studi Islam & Integrasi Sains" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs font-medium" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nama Penulis / Dosen <span class="text-rose-500">*</span></label>
                                <input type="text" name="author" id="form_author" required oninput="updateModalMockup()" placeholder="Dr. H. Ahmad Fauzi, M.Ag." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Kategori Buku <span class="text-rose-500">*</span></label>
                                <input type="text" name="category" id="form_category" required oninput="updateModalMockup()" list="catList" placeholder="Buku Ajar / Studi Islam / dll" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs" />
                                <datalist id="catList">
                                    <option value="Buku Ajar">
                                    <option value="Studi Islam">
                                    <option value="Tarbiyah">
                                    <option value="Monograf Riset">
                                    <option value="Wawasan Islam">
                                    <option value="Hukum & Syariah">
                                    <option value="Sejarah & Tokoh">
                                </datalist>
                            </div>
                        </div>

                        <!-- 2. Legalitas & Harga -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nomor ISBN Resmi (Perpusnas)</label>
                                <input type="text" name="isbn" id="form_isbn" placeholder="978-623-8812-40-1" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono shadow-2xs" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Harga Cetak Resmi <span class="text-rose-500">*</span></label>
                                <input type="text" name="price" id="form_price" required oninput="updateModalMockup()" placeholder="Rp 75.000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold shadow-2xs text-[#006830]" />
                            </div>
                        </div>

                        <!-- 3. Fisik Buku -->
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Tahun Terbit <span class="text-rose-500">*</span></label>
                                <input type="text" name="year" id="form_year" value="2026" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-mono shadow-2xs" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Jumlah Halaman <span class="text-rose-500">*</span></label>
                                <input type="text" name="pages" id="form_pages" value="240 hlm" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-mono shadow-2xs" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Status Publikasi</label>
                                <select name="status" id="form_status" class="w-full px-2 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs font-medium">
                                    <option value="published">Tayang (Published)</option>
                                    <option value="draft">Draf (Hidden)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Format &amp; Standar Cetak</label>
                            <input type="text" name="format" id="form_format" value="UNESCO B5 (Bookpaper)" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs" />
                        </div>

                        <!-- 4. Sinopsis -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Sinopsis Ringkas</label>
                            <textarea name="synopsis" id="form_synopsis" rows="3" placeholder="Tuliskan ringkasan isi naskah buku..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 shadow-2xs leading-relaxed"></textarea>
                        </div>

                        <!-- 5. Checkbox Etalase Highlight -->
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex flex-col sm:flex-row items-center justify-around gap-2">
                            <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                                <input type="checkbox" name="is_new_release" id="form_new_release" value="1" class="rounded text-[#006830] focus:ring-[#006830]" />
                                <span>🌟 Koleksi Terbitan Baru (2026)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                                <input type="checkbox" name="is_best_seller" id="form_best_seller" value="1" class="rounded text-amber-600 focus:ring-amber-600" />
                                <span>🏆 Koleksi Best Seller</span>
                            </label>
                        </div>

                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeBookFormModal()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl transition shadow-xs flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Buku &amp; Foto
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal JS -->
    <script>
        // Track uploaded/cached data URLs for the 4 slots
        let slotImages = {
            cover: null,
            back: null,
            inside: null,
            physical: null
        };

        function switchShowcaseAngle(slot) {
            // Update active pill button style
            ['btnAngleCover', 'btnAngleBack', 'btnAngleInside', 'btnAnglePhysical'].forEach(id => {
                const btn = document.getElementById(id);
                if (btn) {
                    btn.className = 'px-2.5 py-1 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition';
                }
            });

            const activeBtnMap = {
                cover: 'btnAngleCover',
                back: 'btnAngleBack',
                inside: 'btnAngleInside',
                physical: 'btnAnglePhysical'
            };
            const activeBtn = document.getElementById(activeBtnMap[slot]);
            if (activeBtn) {
                activeBtn.className = 'px-2.5 py-1 rounded-md text-[10px] font-bold bg-[#006830] text-white transition shadow-2xs';
            }

            const imgElement = document.getElementById('main3dBookImage');
            const vectorCover = document.getElementById('main3dVectorCover');
            const wrapper = document.getElementById('main3dBookWrapper');

            // Add smooth flip micro-animation
            wrapper.classList.remove('animate-flip-3d');
            void wrapper.offsetWidth; // trigger reflow
            wrapper.classList.add('animate-flip-3d');

            if (slotImages[slot]) {
                imgElement.src = slotImages[slot];
                imgElement.classList.remove('hidden');
                vectorCover.classList.add('hidden');
            } else if (slot === 'cover') {
                imgElement.classList.add('hidden');
                vectorCover.classList.remove('hidden');
            } else {
                imgElement.classList.add('hidden');
                vectorCover.classList.remove('hidden');
            }
        }

        function handleImageSlotChange(input, boxId, badgeId, slot) {
            const box = document.getElementById(boxId);
            const badge = document.getElementById(badgeId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    slotImages[slot] = e.target.result;
                    box.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover rounded" />';
                    if (badge) badge.classList.remove('hidden');
                    
                    // Switch 3D preview to the newly selected photo immediately
                    switchShowcaseAngle(slot);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateModalMockup() {
            const title = document.getElementById('form_title').value || 'Judul Buku';
            const author = document.getElementById('form_author').value || 'Nama Penulis';
            const category = document.getElementById('form_category').value || 'Buku Ajar';
            const price = document.getElementById('form_price').value || 'Rp 75.000';

            document.getElementById('prev_cover_title').innerText = title;
            document.getElementById('prev_cover_author').innerText = author;
            document.getElementById('prev_cover_cat').innerText = category;
            document.getElementById('prev_cover_price').innerText = price;
        }

        function resetAllPreviews() {
            slotImages = { cover: null, back: null, inside: null, physical: null };
            ['previewBoxCover', 'previewBoxBack', 'previewBoxInside', 'previewBoxPhysical'].forEach(id => {
                document.getElementById(id).innerHTML = '<span class="text-[8.5px] text-slate-400">Pilih Foto</span>';
            });
            ['badgeCover', 'badgeBack', 'badgeInside', 'badgePhysical'].forEach(id => {
                const badge = document.getElementById(id);
                if (badge) badge.classList.add('hidden');
            });
            switchShowcaseAngle('cover');
        }

        function openAddBookModal() {
            document.getElementById('modalFormTitle').innerText = 'Tambah Buku Baru ke Katalog';
            document.getElementById('bookFormElement').action = "{{ route('admin.books.store') }}";
            document.getElementById('formMethod').value = 'POST';

            document.getElementById('form_title').value = '';
            document.getElementById('form_author').value = '';
            document.getElementById('form_category').value = 'Buku Ajar';
            document.getElementById('form_isbn').value = '';
            document.getElementById('form_price').value = 'Rp 75.000';
            document.getElementById('form_year').value = '2026';
            document.getElementById('form_pages').value = '240 hlm';
            document.getElementById('form_format').value = 'UNESCO B5 (Bookpaper)';
            document.getElementById('form_synopsis').value = '';
            document.getElementById('form_status').value = 'published';
            document.getElementById('form_new_release').checked = true;
            document.getElementById('form_best_seller').checked = false;

            resetAllPreviews();
            updateModalMockup();

            const modal = document.getElementById('bookFormModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditBookModal(book) {
            document.getElementById('modalFormTitle').innerText = 'Edit Data & Foto Buku: ' + book.title;
            document.getElementById('bookFormElement').action = "/admin/books/" + book.id;
            document.getElementById('formMethod').value = 'PUT';

            document.getElementById('form_title').value = book.title;
            document.getElementById('form_author').value = book.author;
            document.getElementById('form_category').value = book.category;
            document.getElementById('form_isbn').value = book.isbn || '';
            document.getElementById('form_price').value = book.price;
            document.getElementById('form_year').value = book.year;
            document.getElementById('form_pages').value = book.pages;
            document.getElementById('form_format').value = book.format || 'UNESCO B5 (Bookpaper)';
            document.getElementById('form_synopsis').value = book.synopsis || '';
            document.getElementById('form_status').value = book.status;
            document.getElementById('form_new_release').checked = Boolean(book.is_new_release);
            document.getElementById('form_best_seller').checked = Boolean(book.is_best_seller);

            resetAllPreviews();
            updateModalMockup();

            if (book.cover_image) {
                slotImages.cover = '/storage/' + book.cover_image;
                document.getElementById('previewBoxCover').innerHTML = '<img src="/storage/' + book.cover_image + '" class="w-full h-full object-cover rounded" />';
                document.getElementById('badgeCover').classList.remove('hidden');
            }
            if (book.back_cover_image) {
                slotImages.back = '/storage/' + book.back_cover_image;
                document.getElementById('previewBoxBack').innerHTML = '<img src="/storage/' + book.back_cover_image + '" class="w-full h-full object-cover rounded" />';
                document.getElementById('badgeBack').classList.remove('hidden');
            }
            if (book.inside_preview_image) {
                slotImages.inside = '/storage/' + book.inside_preview_image;
                document.getElementById('previewBoxInside').innerHTML = '<img src="/storage/' + book.inside_preview_image + '" class="w-full h-full object-cover rounded" />';
                document.getElementById('badgeInside').classList.remove('hidden');
            }
            if (book.additional_image) {
                slotImages.physical = '/storage/' + book.additional_image;
                document.getElementById('previewBoxPhysical').innerHTML = '<img src="/storage/' + book.additional_image + '" class="w-full h-full object-cover rounded" />';
                document.getElementById('badgePhysical').classList.remove('hidden');
            }

            switchShowcaseAngle('cover');

            const modal = document.getElementById('bookFormModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeBookFormModal() {
            const modal = document.getElementById('bookFormModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('bookFormModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookFormModal();
            }
        });
    </script>
@endsection
