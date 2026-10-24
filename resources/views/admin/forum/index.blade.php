@extends('admin.layouts.app')

@section('title', 'Manajemen Forum Tanya Jawab Agama | Admin PERSIS PERS')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-slate-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading flex items-center gap-2.5">
                <i class="fa-solid fa-scale-balanced text-emerald-700"></i>
                <span>Forum Tanya Jawab Hukum Agama</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Kelola dan berikan jawaban hukum syariah atas pertanyaan jamaah dan masyarakat. Jawaban dapat diisi oleh admin/asatidz terkait.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('forum.index') }}" target="_blank" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-sm transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span>Lihat di Web</span>
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs font-bold flex items-center gap-2 shadow-2xs">
            <i class="fa-solid fa-circle-check text-emerald-700 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- 3 Quick Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Pertanyaan Masuk</span>
                <span class="text-xl font-black text-slate-900 font-heading">{{ number_format($totalCount) }}</span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-slate-100 text-slate-600 flex items-center justify-center text-base">
                <i class="fa-solid fa-inbox"></i>
            </div>
        </div>

        <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Menunggu Jawaban</span>
                <span class="text-xl font-black text-amber-600 font-heading">{{ number_format($pendingCount) }}</span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-amber-50 text-amber-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>

        <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs flex items-center justify-between">
            <div>
                <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Sudah Dijawab / Terbit</span>
                <span class="text-xl font-black text-emerald-700 font-heading">{{ number_format($answeredCount) }}</span>
            </div>
            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-2xs space-y-3">
        <div class="flex items-center justify-between flex-wrap gap-3">
            
            <!-- Status Tabs -->
            <div class="flex items-center gap-1">
                <a href="{{ route('admin.forum-questions.index', ['status' => 'all', 'category' => request('category')]) }}" class="px-3 py-1.5 text-xs font-bold rounded-xs transition {{ request('status', 'all') === 'all' ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua ({{ $totalCount }})
                </a>
                <a href="{{ route('admin.forum-questions.index', ['status' => 'pending', 'category' => request('category')]) }}" class="px-3 py-1.5 text-xs font-bold rounded-xs transition flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-amber-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    <span>Belum Dijawab</span>
                    @if($pendingCount > 0)
                        <span class="px-1.5 py-0.2 rounded-full text-[9px] {{ request('status') === 'pending' ? 'bg-white text-amber-700' : 'bg-amber-100 text-amber-800' }}">{{ $pendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.forum-questions.index', ['status' => 'answered', 'category' => request('category')]) }}" class="px-3 py-1.5 text-xs font-bold rounded-xs transition {{ request('status') === 'answered' ? 'bg-emerald-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Sudah Dijawab ({{ $answeredCount }})
                </a>
            </div>

            <!-- Search & Category Form -->
            <form action="{{ route('admin.forum-questions.index') }}" method="GET" class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                <input type="hidden" name="status" value="{{ request('status', 'all') }}">

                <select name="category" onchange="this.form.submit()" class="text-xs p-2 rounded-xs border border-slate-300 bg-white">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan / nama..." class="text-xs pl-7 pr-3 py-2 rounded-xs border border-slate-300 w-48 sm:w-60 focus:border-emerald-600 outline-none" />
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[10px]"></i>
                </div>

                <button type="submit" class="px-3 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xs transition">
                    Cari
                </button>
            </form>
        </div>
    </div>

    <!-- Table List -->
    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 font-bold uppercase text-[10px] tracking-wider">
                        <th class="p-3.5 w-10 text-center">No</th>
                        <th class="p-3.5">Penanya</th>
                        <th class="p-3.5">Kategori</th>
                        <th class="p-3.5">Pokok Pertanyaan</th>
                        <th class="p-3.5">Status &amp; Penjawab</th>
                        <th class="p-3.5 text-center">Tayang</th>
                        <th class="p-3.5 text-right w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($questions as $index => $q)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-3.5 text-center font-mono text-slate-400">
                                {{ $questions->firstItem() + $index }}
                            </td>
                            <td class="p-3.5">
                                <div class="font-bold text-slate-900">{{ $q->name }}</div>
                                @if($q->phone)
                                    <div class="text-[10.5px] text-slate-500 font-mono">{{ $q->phone }}</div>
                                @endif
                                @if($q->email)
                                    <div class="text-[10px] text-slate-400 truncate max-w-[150px]">{{ $q->email }}</div>
                                @endif
                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $q->created_at ? $q->created_at->format('d/m/Y H:i') : '-' }}
                                </div>
                            </td>
                            <td class="p-3.5">
                                <span class="px-2 py-0.5 text-[9.5px] font-bold rounded-xs border {{ $q->category_badge_class }}">
                                    {{ $q->category }}
                                </span>
                            </td>
                            <td class="p-3.5 max-w-xs">
                                <div class="font-bold text-slate-900 leading-snug line-clamp-2 mb-1">
                                    {{ $q->title }}
                                </div>
                                <div class="text-slate-500 text-[11px] line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($q->question), 100) }}
                                </div>
                            </td>
                            <td class="p-3.5">
                                @if($q->status === 'answered')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i> Sudah Dijawab
                                    </span>
                                    <div class="text-[10.5px] text-slate-700 font-semibold mt-1">
                                        Oleh: <span class="text-emerald-900 font-bold">{{ $q->answered_by ?: 'Admin' }}</span>
                                    </div>
                                    @if($q->answered_at)
                                        <div class="text-[10px] text-slate-400 font-mono">{{ $q->answered_at->format('d/m/Y') }}</div>
                                    @endif
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-100 text-amber-800">
                                        <i class="fa-solid fa-hourglass-half text-[9px]"></i> Belum Dijawab
                                    </span>
                                @endif
                            </td>
                            <td class="p-3.5 text-center">
                                @if($q->is_published)
                                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Tayang
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="p-3.5 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.forum-questions.edit', $q->id) }}" class="px-2.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white text-[11px] font-bold rounded-xs transition flex items-center gap-1" title="Jawab / Edit Pertanyaan">
                                        <i class="fa-solid fa-reply text-[10px]"></i>
                                        <span>{{ $q->status === 'answered' ? 'Edit' : 'Jawab' }}</span>
                                    </a>

                                    <form action="{{ route('admin.forum-questions.destroy', $q->id) }}" method="POST" onsubmit="return confirm('Hapus pertanyaan ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 transition cursor-pointer" title="Hapus">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400 text-xs">
                                <i class="fa-solid fa-inbox text-2xl block mb-2 opacity-50"></i>
                                Tidak ada data pertanyaan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($questions->hasPages())
            <div class="p-4 border-t border-slate-100 flex justify-between items-center">
                <span class="text-xs text-slate-500">
                    Menampilkan {{ $questions->firstItem() }} - {{ $questions->lastItem() }} dari {{ $questions->total() }} pertanyaan
                </span>
                {{ $questions->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
