@extends('admin.layouts.app')

@section('title', 'Manajemen Buku Digital (Flipbook) | Admin PERSIS PERS')

@section('content')
<div class="space-y-5">
    
    <!-- Top Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    E-LIBRARY &amp; FLIPBOOK
                </span>
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• {{ $totalDigitalBooks }} Judul Terdaftar</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Katalog Buku Digital (E-Library)
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Kelola koleksi buku digital, unggah sampul dan dokumen PDF untuk dibaca dengan animasi membalik lembaran kertas (*3D Flipbook*).
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('katalog.digital') }}" target="_blank" class="px-3 sm:px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Lihat Katalog Publik</span>
            </a>
            <button type="button" onclick="openCreateModal()" class="px-3 sm:px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Buku Digital</span>
            </button>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white p-3.5 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Buku Digital</span>
                <h4 class="text-xl sm:text-2xl font-black text-slate-900 font-mono mt-0.5">{{ $totalDigitalBooks }}</h4>
                <span class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-book-open-reader text-[9px]"></i> Koleksi E-Library
                </span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
        </div>

        <div class="bg-white p-3.5 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Dokumen PDF Aktif</span>
                <h4 class="text-xl sm:text-2xl font-black text-emerald-700 font-mono mt-0.5">{{ $withPdfCount }}</h4>
                <span class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-file-pdf text-[9px]"></i> Siap Flipbook 3D
                </span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
        </div>

        <div class="bg-white p-3.5 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Koleksi Unggulan</span>
                <h4 class="text-xl sm:text-2xl font-black text-amber-700 font-mono mt-0.5">{{ $featuredCount }}</h4>
                <span class="text-[11px] text-amber-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-star text-[9px]"></i> Tampil di Beranda Digital
                </span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-amber-50 text-amber-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-star"></i>
            </div>
        </div>

        <div class="bg-white p-3.5 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Kategori Aktif</span>
                <h4 class="text-xl sm:text-2xl font-black text-purple-700 font-mono mt-0.5">{{ count($categories) }}</h4>
                <span class="text-[11px] text-purple-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-layer-group text-[9px]"></i> Bidang Keilmuan
                </span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-purple-50 text-purple-600 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>
    </div>

    <!-- Table Card with Search & Filters -->
    <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-3.5 sm:p-4 border-b border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
            <form action="{{ route('admin.digital-books.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-3">
                <div class="relative w-full sm:w-80">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari judul buku digital, penulis..." 
                           class="w-full pl-9 pr-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-500 font-medium transition" />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>

                <select name="category" onchange="this.form.submit()" class="w-full sm:w-48 px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white font-medium focus:outline-hidden focus:border-emerald-600">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                @if(request('search') || (request('category') && request('category') !== 'all'))
                    <a href="{{ route('admin.digital-books.index') }}" class="text-xs text-rose-600 hover:text-rose-800 font-semibold">
                        Reset
                    </a>
                @endif
            </form>

            <span class="text-xs text-slate-400 font-mono">
                Menampilkan {{ $digitalBooks->count() }} dari {{ $digitalBooks->total() }} buku
            </span>
        </div>

        <!-- Table Desktop -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 w-20">Sampul</th>
                        <th class="py-3 px-4">Judul &amp; Penulis</th>
                        <th class="py-3 px-4">Kategori &amp; Bahasa</th>
                        <th class="py-3 px-4">Tahun &amp; Hlm</th>
                        <th class="py-3 px-4">Dokumen PDF (Flipbook)</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($digitalBooks as $book)
                        @php
                            $coverUrl = $book->cover_url;
                            $pdfUrl = $book->pdf_url;
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3.5 px-4">
                                <div class="w-14 h-20 rounded-xs bg-slate-900 border border-slate-200 overflow-hidden relative shadow-2xs">
                                    @if($coverUrl)
                                        <img src="{{ $coverUrl }}" alt="{{ $book->title }}" class="w-full h-full object-cover" onerror="this.style.display='none';" />
                                    @endif
                                    <div class="w-full h-full bg-[#032c21] p-1 flex flex-col justify-between text-[6px] text-white" style="{{ $coverUrl ? 'display:none;' : '' }}">
                                        <span class="text-emerald-300 font-bold">DIGITAL</span>
                                        <span class="font-black line-clamp-3 leading-tight">{{ $book->title }}</span>
                                        <span class="text-slate-300 truncate">{{ $book->author }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 max-w-xs">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 hover:text-emerald-700 transition cursor-pointer" onclick="openEditModal({{ json_encode($book) }})">
                                    {{ $book->title }}
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                    <span>{{ $book->author }}</span>
                                </p>
                                @if($book->is_featured)
                                    <span class="inline-flex items-center gap-1 text-[9px] text-amber-700 font-bold bg-amber-50 px-1.5 py-0.2 rounded-xs border border-amber-200 mt-1">
                                        <i class="fa-solid fa-star text-[8px]"></i> Koleksi Unggulan
                                    </span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $book->category }}
                                </span>
                                <span class="text-[11px] text-slate-400 block mt-1">
                                    {{ $book->language ?: 'Indonesia' }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="font-bold text-slate-800 block text-xs">{{ $book->year }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $book->pages ?: '-' }}</span>
                            </td>

                            <td class="py-3.5 px-4">
                                @if($pdfUrl)
                                    <div class="space-y-1">
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                            <i class="fa-solid fa-circle-check text-[9px] text-emerald-600"></i> PDF Flipbook Ready
                                        </span>
                                        <a href="{{ $pdfUrl }}" target="_blank" class="text-[10.5px] text-emerald-700 hover:text-emerald-900 font-semibold block flex items-center gap-1">
                                            <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i> Lihat File PDF
                                        </a>
                                    </div>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[9.5px] font-medium bg-slate-100 text-slate-400 border border-slate-200">
                                        <i class="fa-solid fa-file text-[8px]"></i> Belum Ada PDF
                                    </span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4">
                                @if($book->status === 'published')
                                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Tayang</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">Draf</span>
                                @endif
                            </td>

                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('katalog.digital', ['baca' => $book->slug]) }}" target="_blank" class="w-8 h-8 rounded-sm bg-emerald-50 hover:bg-emerald-100 text-emerald-800 flex items-center justify-center transition" title="Buka Flipbook">
                                        <i class="fa-solid fa-book-open-reader text-xs"></i>
                                    </a>
                                    <button type="button" onclick="openEditModal({{ json_encode($book) }})" class="w-8 h-8 rounded-sm bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 flex items-center justify-center transition" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.digital-books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku digital ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-sm bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition" title="Hapus">
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
                                Belum ada buku digital yang terdaftar. Klik tombol <strong>Tambah Buku Digital</strong> di atas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($digitalBooks->hasPages())
            <div class="p-4 border-t border-slate-100 flex items-center justify-end">
                {{ $digitalBooks->links() }}
            </div>
        @endif
    </div>

</div>

<!-- MODAL FORM TAMBAH / EDIT BUKU DIGITAL -->
<div id="digitalBookModal" class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-2 sm:p-4 overflow-hidden backdrop-blur-xs select-none">
    <div class="bg-white rounded-sm max-w-3xl w-full shadow-2xl border border-slate-200 overflow-hidden relative my-auto max-h-[92vh] flex flex-col animate-fade-in-up">
        
        <!-- Header (Pinned top) -->
        <div class="bg-[#032c21] text-white px-5 py-3.5 flex items-center justify-between border-b border-emerald-950 shrink-0">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-book-open-reader text-emerald-400 text-sm"></i>
                <h3 id="modalHeaderTitle" class="text-xs sm:text-sm font-extrabold uppercase tracking-wider font-heading">
                    Tambah Buku Digital Baru
                </h3>
            </div>
            <button type="button" onclick="closeModal()" class="w-7 h-7 rounded-xs bg-emerald-900/60 hover:bg-rose-600 text-slate-300 hover:text-white flex items-center justify-center transition text-sm cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Form wrapping the scrollable body and pinned footer -->
        <form id="digitalBookForm" action="{{ route('admin.digital-books.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0 overflow-hidden m-0">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST" />

            <!-- Scrollable Content Body -->
            <div class="p-5 sm:p-6 space-y-4 overflow-y-auto flex-1">
                
                <!-- 1. Title -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Buku Digital <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="in_title" required class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 font-medium transition" placeholder="Contoh: Metodologi Penelitian Studi Islam & Integrasi Sains" />
                </div>

                <!-- 2. Author & Category -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Penulis / Muallif <span class="text-rose-500">*</span></label>
                        <input type="text" name="author" id="in_author" required class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 font-medium transition" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag." />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="category" id="in_category" required class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 font-medium transition" placeholder="Contoh: Buku Ajar / Studi Islam / Turats" />
                    </div>
                </div>

                <!-- 3. Metadata 4-Column Responsive Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 bg-slate-50/80 p-3 rounded-sm border border-slate-200">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Tahun Terbit <span class="text-rose-500">*</span></label>
                        <input type="text" name="year" id="in_year" value="2026" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 font-mono text-center font-bold bg-white" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Jml Halaman <span class="text-rose-500">*</span></label>
                        <input type="text" name="pages" id="in_pages" placeholder="240 hlm" required class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 text-center font-bold bg-white" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Bahasa Pengantar</label>
                        <input type="text" name="language" id="in_language" value="Indonesia" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 font-medium bg-white text-center" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Publikasi</label>
                        <select name="status" id="in_status" class="w-full px-2 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-medium cursor-pointer">
                            <option value="published">Tayang (Published)</option>
                            <option value="draft">Draf (Disimpan)</option>
                        </select>
                    </div>
                </div>

                <!-- 4. Upload Cover & PDF File Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    
                    <!-- Cover Image Upload -->
                    <div class="p-3 bg-slate-50 rounded-sm border border-slate-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                <i class="fa-solid fa-image text-emerald-600"></i> Sampul / Cover Buku
                            </span>
                            <span id="cover_status_badge" class="text-[9px] px-1.5 py-0.2 rounded font-bold bg-slate-200 text-slate-600">Pilih Foto</span>
                        </div>
                        <label for="in_cover_image" class="flex items-center gap-3 p-2 bg-white border border-dashed border-slate-300 hover:border-emerald-500 rounded-sm cursor-pointer transition">
                            <div id="cover_thumb_preview" class="w-10 h-14 bg-slate-100 rounded-xs flex items-center justify-center text-slate-400 overflow-hidden shrink-0 border border-slate-200">
                                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p id="cover_name_display" class="text-xs font-semibold text-slate-700 truncate">Pilih gambar cover...</p>
                                <p class="text-[10px] text-slate-400 font-mono">JPG, PNG, WebP (Maks. 10MB)</p>
                            </div>
                            <input type="file" name="cover_image" id="in_cover_image" accept="image/*" class="hidden" onchange="handleCoverChange(this)" />
                        </label>
                    </div>

                    <!-- PDF Document Upload -->
                    <div class="p-3 bg-emerald-50/60 rounded-sm border border-emerald-200 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-emerald-950 flex items-center gap-1.5">
                                <i class="fa-solid fa-file-pdf text-emerald-700"></i> Dokumen PDF (Flipbook)
                            </span>
                            <span id="pdf_status_badge" class="text-[9px] px-1.5 py-0.2 rounded font-bold bg-slate-200 text-slate-600">Belum Ada PDF</span>
                        </div>
                        <label for="in_pdf_file" class="flex items-center gap-3 p-2 bg-white border border-dashed border-emerald-300 hover:border-emerald-600 rounded-sm cursor-pointer transition">
                            <div class="w-10 h-14 bg-emerald-100/70 text-emerald-700 rounded-xs flex items-center justify-center text-lg shrink-0 border border-emerald-200">
                                <i class="fa-solid fa-file-arrow-up"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p id="pdf_name_display" class="text-xs font-semibold text-slate-700 truncate">Pilih dokumen PDF...</p>
                                <p class="text-[10px] text-slate-400 font-mono">Format .pdf (Maks. 100MB)</p>
                            </div>
                            <input type="file" name="pdf_file" id="in_pdf_file" accept="application/pdf" class="hidden" onchange="handlePdfChange(this)" />
                        </label>
                        <div id="pdf_active_box" class="hidden flex items-center justify-between pt-0.5 text-xs">
                            <a id="pdf_active_link" href="#" target="_blank" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i> Lihat PDF Saat Ini
                            </a>
                            <label class="flex items-center gap-1 text-[11px] font-semibold text-rose-600 cursor-pointer">
                                <input type="checkbox" name="remove_pdf" id="in_remove_pdf" value="1" />
                                <span>Hapus PDF</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- 5. Synopsis -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Sinopsis / Ringkasan Buku</label>
                    <textarea name="synopsis" id="in_synopsis" rows="2" class="w-full px-3.5 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 leading-relaxed font-medium transition" placeholder="Deskripsi ringkas mengenai isi dan pembahasan buku digital..."></textarea>
                </div>

                <!-- 6. Featured Checkbox -->
                <div class="p-2.5 bg-slate-50 rounded-sm border border-slate-200">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="is_featured" id="in_featured" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500" />
                        <span class="text-xs font-bold text-slate-800">🌟 Tampilkan Sebagai Koleksi Unggulan Digital (Featured)</span>
                    </label>
                </div>

            </div>

            <!-- Sticky Pinned Footer Action Bar (Always fully visible!) -->
            <div class="bg-slate-50 px-5 py-3.5 border-t border-slate-200 flex items-center justify-end gap-2.5 shrink-0">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-sm bg-white hover:bg-slate-100 text-slate-700 text-xs font-bold border border-slate-300 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition flex items-center gap-2 shadow-xs cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Buku Digital</span>
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    function openCreateModal() {
        const form = document.getElementById('digitalBookForm');
        form.action = "{{ route('admin.digital-books.store') }}";
        form.reset();

        document.getElementById('formMethod').value = 'POST';
        document.getElementById('modalHeaderTitle').innerText = 'Tambah Buku Digital Baru';

        // Reset previews
        document.getElementById('cover_name_display').innerText = 'Pilih gambar cover...';
        document.getElementById('cover_status_badge').innerText = 'Pilih Foto';
        document.getElementById('cover_thumb_preview').innerHTML = '<i class="fa-solid fa-cloud-arrow-up text-base"></i>';

        document.getElementById('pdf_name_display').innerText = 'Pilih dokumen PDF...';
        document.getElementById('pdf_status_badge').innerText = 'Belum Ada PDF';
        document.getElementById('pdf_active_box').classList.add('hidden');

        const modal = document.getElementById('digitalBookModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openEditModal(book) {
        const form = document.getElementById('digitalBookForm');
        form.action = "/admin/digital-books/" + book.id;

        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('modalHeaderTitle').innerText = 'Edit Buku Digital: ' + (book.title || '');

        const setVal = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.value = val;
        };

        setVal('in_title', book.title || '');
        setVal('in_author', book.author || '');
        setVal('in_category', book.category || '');
        setVal('in_year', book.year || '2026');
        setVal('in_pages', book.pages || '');
        setVal('in_language', book.language || 'Indonesia');
        setVal('in_status', book.status || 'published');
        setVal('in_synopsis', book.synopsis || '');

        const feat = document.getElementById('in_featured');
        if (feat) feat.checked = Boolean(book.is_featured);

        // Setup Cover preview
        if (book.cover_image) {
            const coverUrl = book.cover_image.startsWith('http') ? book.cover_image : ('/storage/' + book.cover_image);
            document.getElementById('cover_thumb_preview').innerHTML = '<img src="' + coverUrl + '" class="w-full h-full object-cover" />';
            document.getElementById('cover_name_display').innerText = book.cover_image.split('/').pop();
            document.getElementById('cover_status_badge').innerText = 'Terpasang';
        } else {
            document.getElementById('cover_thumb_preview').innerHTML = '<i class="fa-solid fa-cloud-arrow-up text-base"></i>';
            document.getElementById('cover_name_display').innerText = 'Pilih gambar cover...';
            document.getElementById('cover_status_badge').innerText = 'Belum Ada';
        }

        // Setup PDF preview
        const pdfBox = document.getElementById('pdf_active_box');
        const pdfLink = document.getElementById('pdf_active_link');
        const pdfBadge = document.getElementById('pdf_status_badge');
        const removePdf = document.getElementById('in_remove_pdf');
        if (removePdf) removePdf.checked = false;

        if (book.pdf_file) {
            const pdfUrl = book.pdf_file.startsWith('http') ? book.pdf_file : ('/storage/' + book.pdf_file);
            pdfBox.classList.remove('hidden');
            pdfLink.href = pdfUrl;
            pdfBadge.innerText = 'PDF Terpasang';
            pdfBadge.className = 'text-[9px] px-1.5 py-0.2 rounded font-bold bg-emerald-100 text-emerald-800 border border-emerald-300';
            document.getElementById('pdf_name_display').innerText = book.pdf_file.split('/').pop();
        } else {
            pdfBox.classList.add('hidden');
            pdfBadge.innerText = 'Belum Ada PDF';
            pdfBadge.className = 'text-[9px] px-1.5 py-0.2 rounded font-bold bg-slate-200 text-slate-600';
            document.getElementById('pdf_name_display').innerText = 'Pilih dokumen PDF...';
        }

        const modal = document.getElementById('digitalBookModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('digitalBookModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function handleCoverChange(input) {
        const file = input.files[0];
        if (file) {
            document.getElementById('cover_name_display').innerText = file.name;
            document.getElementById('cover_status_badge').innerText = 'Siap Diunggah';
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('cover_thumb_preview').innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover" />';
            };
            reader.readAsDataURL(file);
        }
    }

    function handlePdfChange(input) {
        const file = input.files[0];
        if (file) {
            if (!file.name.toLowerCase().endsWith('.pdf')) {
                alert('Dokumen harus berekstensi .pdf');
                input.value = '';
                return;
            }
            const mb = (file.size / (1024 * 1024)).toFixed(2);
            document.getElementById('pdf_name_display').innerText = file.name + ' (' + mb + ' MB)';
            const badge = document.getElementById('pdf_status_badge');
            badge.innerText = 'Siap Diunggah';
            badge.className = 'text-[9px] px-1.5 py-0.2 rounded font-bold bg-emerald-700 text-white';
        }
    }
</script>
@endsection
