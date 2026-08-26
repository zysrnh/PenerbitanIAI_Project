@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Ringkasan & Aktivitas Penerbitan')

@section('content')
    <!-- 4 Stats Counter Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        
        <!-- Card 1: Total Judul Buku -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-emerald-500 transition">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Total Master Buku</span>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1 font-mono">{{ $totalBooks ?? 0 }}</h3>
                <span class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Koleksi Ber-ISBN
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                <i class="fa-solid fa-book"></i>
            </div>
        </div>

        <!-- Card 2: Terbitan Baru -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-blue-500 transition">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Terbitan Baru (2026)</span>
                <h3 class="text-2xl sm:text-3xl font-black text-blue-700 mt-1 font-mono">{{ $newBooksCount ?? 0 }}</h3>
                <span class="text-[11px] text-blue-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-sparkles text-[9px]"></i> Highlight Etalase
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                <i class="fa-solid fa-award"></i>
            </div>
        </div>

        <!-- Card 3: Pesan Masuk -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-amber-500 transition">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Pesan &amp; Naskah Masuk</span>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1 font-mono">{{ $unreadMessages ?? 0 }}</h3>
                <span class="text-[11px] text-amber-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-clock text-[9px]"></i> Perlu Ditanggapi
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
        </div>

        <!-- Card 4: Administrator Aktif -->
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-xs flex items-center justify-between hover:border-purple-500 transition">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Administrator Terdaftar</span>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1 font-mono">{{ $totalUsers ?? 0 }}</h3>
                <span class="text-[11px] text-purple-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-user-shield text-[9px]"></i> Hak Akses Sistem
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center text-xl shrink-0 shadow-2xs">
                <i class="fa-solid fa-users-gear"></i>
            </div>
        </div>

    </div>

    <!-- Main Dashboard Split: Left Table Recent Books, Right Quick Shortcuts -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Recent Books (8 Cols) -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h4 class="font-extrabold text-base text-slate-900">Koleksi Terbitan Terbaru</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Master buku yang baru saja ditambahkan atau diperbarui.</p>
                    </div>
                    <a href="{{ route('admin.books.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                        <span>Lihat Semua Koleksi</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="py-3 px-4">Sampul</th>
                                <th class="py-3 px-4">Judul Buku &amp; Penulis</th>
                                <th class="py-3 px-4">Kategori &amp; ISBN</th>
                                <th class="py-3 px-4">Harga Cetak</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($recentBooks ?? [] as $book)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3 px-4">
                                        <div class="w-10 h-14 bg-slate-900 rounded-xs overflow-hidden shadow-2xs border border-slate-200">
                                            @if($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full bg-[#032c21] p-1 flex flex-col justify-between text-[5px] text-white">
                                                    <span class="text-emerald-300 font-bold truncate">PERSIS</span>
                                                    <span class="font-bold line-clamp-2 leading-tight">{{ $book->title }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3 px-4 max-w-xs">
                                        <h5 class="font-bold text-slate-900 text-xs line-clamp-1 hover:text-emerald-700 transition">{{ $book->title }}</h5>
                                        <span class="text-[11px] text-slate-500 block truncate mt-0.5">{{ $book->author }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            {{ $book->category }}
                                        </span>
                                        <span class="text-[10.5px] font-mono text-slate-400 block mt-1">{{ $book->isbn ?? '-' }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="font-mono font-bold text-emerald-700 text-xs">{{ $book->price }}</span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('admin.books.index') }}" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 inline-flex items-center justify-center transition" title="Kelola">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">Belum ada buku terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Quick Shortcuts & Redaksi Status (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Quick Management Card -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-5 space-y-3">
                <h4 class="font-extrabold text-sm text-slate-900">Akses Cepat Pengelolaan</h4>
                
                <div class="grid grid-cols-1 gap-2.5 pt-1">
                    <a href="{{ route('admin.books.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 group-hover:bg-emerald-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Tambah Buku &amp; Foto Naskah</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-emerald-700"></i>
                    </a>

                    <a href="{{ route('admin.settings.catalog') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-700 group-hover:bg-blue-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-sliders"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Ubah Banner &amp; Promo Katalog</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-blue-700"></i>
                    </a>

                    <a href="{{ route('admin.messages.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 group-hover:bg-amber-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-inbox"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Lihat Permohonan Terbit</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-amber-700"></i>
                    </a>
                </div>
            </div>

            <!-- Public Portal Link -->
            <div class="p-5 rounded-xl bg-[#032c21] text-white border border-[#064e3b] shadow-xs space-y-2">
                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">PORTAL UTAMA KAMPUS</span>
                <h5 class="font-bold text-sm text-white">Etalase Publik PERSIS PERS</h5>
                <p class="text-xs text-slate-300 leading-relaxed">Lihat langsung katalog resmi yang tampil kepada mahasiswa, dosen, dan pembaca umum.</p>
                <a href="{{ route('katalog') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-2xs mt-2">
                    <span>Kunjungi Katalog Publik</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>

        </div>

    </div>
@endsection
