@extends('admin.layouts.app')

@section('title', 'Kelola Layanan Web')
@section('header_title', 'Kelola Layanan & Halaman Dinamis')

@section('content')
<div class="space-y-6">
    
    <!-- Top Action Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider block mb-0.5">LAYANAN DINAMIS</span>
            <h3 class="text-lg font-black text-slate-900 font-heading">Daftar Layanan Penerbitan &amp; Percetakan</h3>
            <p class="text-xs text-slate-500 mt-0.5">Setiap layanan otomatis memiliki kartu di beranda, menu di navbar, dan halaman detail mandiri.</p>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.services.create') }}" class="w-full sm:w-auto px-4 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Layanan Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold rounded-sm flex items-center gap-2">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Services Table Card -->
    <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-4 w-12 text-center">Urutan</th>
                        <th class="py-3 px-4 w-14 text-center">Icon</th>
                        <th class="py-3 px-4">Nama Layanan</th>
                        <th class="py-3 px-4">URL / Slug</th>
                        <th class="py-3 px-4">Ringkasan Kartu</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($services as $service)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-slate-400">
                                {{ $service->order }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 flex items-center justify-center text-sm mx-auto shadow-2xs border border-emerald-200">
                                    <i class="{{ $service->icon }}"></i>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="font-bold text-slate-900 hover:text-emerald-700 transition block text-sm">
                                    {{ $service->title }}
                                </a>
                                @if($service->tagline)
                                    <span class="text-[11px] text-slate-400 italic block">{{ $service->tagline }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-mono text-emerald-700">
                                /layanan/{{ $service->slug }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 max-w-xs truncate">
                                {{ $service->short_desc }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($service->status === 'published')
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Tayang
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                        Draf
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('layanan.show', $service->slug) }}" target="_blank" class="w-7 h-7 rounded-xs bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition" title="Lihat Halaman Publik">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="w-7 h-7 rounded-xs bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white flex items-center justify-center transition shadow-2xs" title="Edit Layanan & Konten">
                                        <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan '{{ $service->title }}'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-7 h-7 rounded-xs bg-rose-50 hover:bg-rose-600 text-rose-700 hover:text-white flex items-center justify-center transition cursor-pointer" title="Hapus Layanan">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">
                                <i class="fa-solid fa-layer-group text-3xl mb-2 block"></i>
                                Belum ada layanan yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($services->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $services->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
