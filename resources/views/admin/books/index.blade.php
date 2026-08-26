@extends('admin.layouts.app')

@section('title', 'Katalog Buku & ISBN')
@section('header_title', 'Manajemen Koleksi Buku & Terbitan')

@section('content')
    <!-- Top Header -->
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5">
                <h3 class="text-lg font-extrabold text-slate-900">Katalog Buku &amp; Publikasi Ilmiah</h3>
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                    {{ $totalBooks }} Judul Terdaftar
                </span>
            </div>
            <p class="text-sm text-slate-500 mt-1">Kelola master buku, nomor ISBN, kategori, harga cetak, dan status etalase katalog publik.</p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i> Buka Katalog
            </a>
            <button type="button" onclick="openAddBookModal()" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-xs sm:text-sm font-bold transition shadow-xs hover:shadow-md flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Tambah Buku Baru
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @endif

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#006830] flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Total Koleksi</span>
                <span class="text-lg font-black text-slate-900 leading-tight block mt-0.5">{{ $totalBooks }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-sparkles"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Terbitan Baru (2026)</span>
                <span class="text-lg font-black text-blue-700 leading-tight block mt-0.5">{{ $newReleasesCount }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div>
                <span class="text-xs text-slate-500 font-medium block">Koleksi Best Seller</span>
                <span class="text-lg font-black text-amber-700 leading-tight block mt-0.5">{{ $bestSellersCount }} Judul</span>
            </div>
        </div>

        <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-3.5">
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
                <div class="relative w-full sm:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari judul, penulis, ISBN..." 
                        class="w-full pl-9 pr-3.5 py-2 text-xs rounded-xl border border-slate-200 bg-white focus:outline-hidden focus:border-emerald-600"
                    />
                </div>

                <select name="category" onchange="this.form.submit()" class="w-full sm:w-44 px-3 py-2 text-xs rounded-xl border border-slate-200 bg-white focus:outline-hidden focus:border-emerald-600">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                @if(request('search') || (request('category') && request('category') !== 'all'))
                    <a href="{{ route('admin.books.index') }}" class="px-3 py-2 text-xs font-semibold text-rose-600 hover:text-rose-800 bg-rose-50 rounded-xl">Reset</a>
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
                        <th class="py-3.5 px-4">Etalase / Status</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/80 transition">
                            <!-- Cover Mini -->
                            <td class="py-3.5 px-4">
                                <div class="w-10 aspect-[3/4.2] rounded-xs bg-[#032c21] text-white p-1 flex flex-col justify-between border-l-2 border-emerald-400 shadow-2xs text-[6px]">
                                    <span class="font-extrabold truncate">{{ $book->category }}</span>
                                    <span class="font-black text-[7px] leading-none line-clamp-2">{{ $book->title }}</span>
                                    <span class="truncate text-emerald-300 font-mono">{{ $book->year }}</span>
                                </div>
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
                                <span class="font-mono text-[11px] text-slate-600 block">ISBN: {{ $book->isbn }}</span>
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

                            <!-- Badges & Status -->
                            <td class="py-3.5 px-4 space-y-1">
                                @if($book->is_new_release)
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9.5px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-sparkles text-[8px]"></i> Baru 2026
                                    </span>
                                @endif
                                @if($book->is_best_seller)
                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9.5px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <i class="fa-solid fa-trophy text-[8px]"></i> Best Seller
                                    </span>
                                @endif
                                <span class="block text-[10px] text-slate-400 font-medium">Status: {{ ucfirst($book->status) }}</span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" onclick="openEditBookModal({{ json_encode($book) }})" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs transition" title="Edit Buku">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini dari katalog?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center text-xs transition" title="Hapus Buku">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">
                                <i class="fa-solid fa-book-open text-2xl mb-2 block"></i>
                                Tidak ada buku yang sesuai dengan pencarian.
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

    <!-- MODAL TAMBAH & EDIT BUKU -->
    <div id="bookFormModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl max-w-xl w-full shadow-2xl border border-slate-200 overflow-hidden relative animate-fade-in-up my-auto max-h-[92vh] flex flex-col">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-5 py-3.5 flex items-center justify-between border-b border-[#064e3b] shrink-0">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    <span id="modalFormTitle" class="text-xs font-bold uppercase tracking-wider text-emerald-300">Tambah Buku Baru</span>
                </div>
                <button type="button" onclick="closeBookFormModal()" class="w-7 h-7 rounded-lg bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-xs font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form id="bookFormElement" method="POST" action="{{ route('admin.books.store') }}" class="p-5 sm:p-6 overflow-y-auto space-y-4 text-xs">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST" />

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Judul Lengkap Buku <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="form_title" required placeholder="Contoh: Metodologi Studi Islam" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Penulis / Dosen <span class="text-rose-500">*</span></label>
                        <input type="text" name="author" id="form_author" required placeholder="Dr. H. Nama Penulis, M.Ag." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Kategori Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="category" id="form_category" required list="catList" placeholder="Buku Ajar / Studi Islam / dll" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nomor ISBN Resmi</label>
                        <input type="text" name="isbn" id="form_isbn" placeholder="978-623-8812-xx-x" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Harga Cetak Resmi <span class="text-rose-500">*</span></label>
                        <input type="text" name="price" id="form_price" required placeholder="Rp 75.000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold" />
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Tahun Terbit <span class="text-rose-500">*</span></label>
                        <input type="text" name="year" id="form_year" value="2026" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-mono" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Jumlah Halaman <span class="text-rose-500">*</span></label>
                        <input type="text" name="pages" id="form_pages" value="240 hlm" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-mono" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Status Publikasi</label>
                        <select name="status" id="form_status" class="w-full px-2 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600">
                            <option value="published">Tayang (Published)</option>
                            <option value="draft">Draf (Hidden)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Format &amp; Standar Cetak</label>
                    <input type="text" name="format" id="form_format" value="UNESCO B5 (Bookpaper)" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600" />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Sinopsis Ringkas</label>
                    <textarea name="synopsis" id="form_synopsis" rows="3" placeholder="Tuliskan ringkasan isi naskah buku..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-200 focus:outline-hidden focus:border-emerald-600"></textarea>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-around">
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" name="is_new_release" id="form_new_release" value="1" class="rounded text-[#006830] focus:ring-[#006830]" />
                        <span>Koleksi Terbitan Baru (2026)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" name="is_best_seller" id="form_best_seller" value="1" class="rounded text-amber-600 focus:ring-amber-600" />
                        <span>Koleksi Best Seller</span>
                    </label>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeBookFormModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-xl transition shadow-xs">
                        Simpan Buku
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal JS -->
    <script>
        function openAddBookModal() {
            document.getElementById('modalFormTitle').innerText = 'Tambah Buku Baru';
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

            const modal = document.getElementById('bookFormModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditBookModal(book) {
            document.getElementById('modalFormTitle').innerText = 'Edit Data Buku: ' + book.title;
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
