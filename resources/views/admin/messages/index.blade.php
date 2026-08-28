@extends('admin.layouts.app')

@section('title', 'Pesan & Pengajuan Naskah | Admin PERSIS PERS')
@section('header_title', 'Pesan & Pengajuan Naskah')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Card Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-inbox"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-sm sm:text-lg font-extrabold text-slate-900 font-heading leading-tight">
                        Kotak Masuk &amp; Permohonan Naskah
                    </h1>
                    @if($pendingCount > 0)
                        <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300 font-mono">
                            {{ $pendingCount }} Belum Dihubungi
                        </span>
                    @endif
                </div>
                <p class="text-xs text-slate-500 mt-0.5">Daftar naskah buku dari dosen/peneliti dan konsultasi redaksi via web.</p>
            </div>
        </div>

        <a href="{{ route('admin.settings.contact') }}" class="px-3.5 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs shrink-0 cursor-pointer">
            <i class="fa-solid fa-sliders text-xs"></i>
            <span>Pengaturan Kontak</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-3.5">
        <form method="GET" action="{{ route('admin.messages.index') }}" id="msgFilterForm" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2.5 items-center">
            
            <!-- Search Input -->
            <div class="sm:col-span-2 lg:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari pengirim, email, WhatsApp, judul naskah..." 
                    class="w-full pl-8 pr-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition bg-slate-50/50"
                />
            </div>

            <!-- Custom Status Filter Dropdown -->
            <div class="lg:col-span-3 relative" id="filterStatusContainer">
                <input type="hidden" name="status" id="filterStatusInput" value="{{ request('status') }}" />
                <button 
                    type="button" 
                    onclick="toggleFilterStatusMenu()"
                    class="w-full px-3 py-2 bg-slate-50/50 border border-slate-300 rounded-sm text-xs font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 transition cursor-pointer"
                >
                    <span id="filterStatusLabel">
                        @if(request('status') === 'pending')
                            Belum Dihubungi
                        @elseif(request('status') === 'contacted')
                            Sudah Dihubungi
                        @elseif(request('status') === 'completed')
                            Selesai Diproses
                        @else
                            Semua Status
                        @endif
                    </span>
                    <i id="filterStatusChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                </button>

                <div id="filterStatusMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                    <button type="button" onclick="selectFilterStatus('', 'Semua Status')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span>Semua Status</span>
                        @if(!request('status')) <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterStatus('pending', 'Belum Dihubungi')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span>Belum Dihubungi</span>
                        @if(request('status') === 'pending') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterStatus('contacted', 'Sudah Dihubungi')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span>Sudah Dihubungi</span>
                        @if(request('status') === 'contacted') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterStatus('completed', 'Selesai Diproses')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span>Selesai Diproses</span>
                        @if(request('status') === 'completed') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                </div>
            </div>

            <!-- Custom Service Category Filter Dropdown -->
            <div class="lg:col-span-2 relative" id="filterServiceContainer">
                <input type="hidden" name="service" id="filterServiceInput" value="{{ request('service') }}" />
                <button 
                    type="button" 
                    onclick="toggleFilterServiceMenu()"
                    class="w-full px-3 py-2 bg-slate-50/50 border border-slate-300 rounded-sm text-xs font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 transition cursor-pointer"
                >
                    <span id="filterServiceLabel" class="truncate">
                        {{ request('service') ?: 'Semua Layanan' }}
                    </span>
                    <i id="filterServiceChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                </button>

                <div id="filterServiceMenu" class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in">
                    <button type="button" onclick="selectFilterService('', 'Semua Layanan')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span class="truncate">Semua Layanan</span>
                        @if(!request('service')) <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterService('Penerbitan Buku Ber-ISBN', 'Buku Ber-ISBN')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span class="truncate">Buku Ber-ISBN</span>
                        @if(request('service') === 'Penerbitan Buku Ber-ISBN') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterService('Percetakan Umum & Komersil', 'Percetakan Umum')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span class="truncate">Percetakan Umum</span>
                        @if(request('service') === 'Percetakan Umum & Komersil') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterService('Jurnal & Prosiding Ilmiah', 'Jurnal & Prosiding')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span class="truncate">Jurnal &amp; Prosiding</span>
                        @if(request('service') === 'Jurnal & Prosiding Ilmiah') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                    <button type="button" onclick="selectFilterService('Konversi KTI ke Buku', 'Konversi KTI')" class="w-full px-3 py-1.5 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium">
                        <span class="truncate">Konversi KTI</span>
                        @if(request('service') === 'Konversi KTI ke Buku') <i class="fa-solid fa-check text-xs text-emerald-600"></i> @endif
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="lg:col-span-2 flex gap-1.5">
                <button type="submit" class="flex-1 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-1 shadow-2xs cursor-pointer">
                    <i class="fa-solid fa-filter text-[10px]"></i>
                    <span>Filter</span>
                </button>
                @if(request('search') || request('status') || request('service'))
                    <a href="{{ route('admin.messages.index') }}" class="px-2.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-sm transition flex items-center justify-center" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Messages Table Card -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden w-full">
        <!-- 1. MOBILE NATIVE MESSAGE CARDS (Visible on mobile < 640px) -->
        <div class="block sm:hidden divide-y divide-slate-100">
            @forelse($messages as $msg)
                <div class="p-3.5 space-y-2.5 hover:bg-slate-50/80 transition">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-7 h-7 rounded-sm bg-emerald-700 text-white flex items-center justify-center font-bold text-xs shrink-0">
                                {{ strtoupper(substr($msg->name, 0, 1)) }}
                            </div>
                            <span class="font-bold text-slate-900 text-xs truncate">{{ $msg->name }}</span>
                        </div>
                        @if($msg->status === 'pending')
                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-amber-50 text-amber-800 border border-amber-200 uppercase font-mono shrink-0">
                                Belum Dihubungi
                            </span>
                        @elseif($msg->status === 'contacted')
                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-blue-50 text-blue-800 border border-blue-200 uppercase font-mono shrink-0">
                                Sudah Dihubungi
                            </span>
                        @else
                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 uppercase font-mono shrink-0">
                                Selesai
                            </span>
                        @endif
                    </div>

                    <div class="space-y-1 text-xs">
                        <div class="flex items-center gap-2 text-[11px] text-slate-500">
                            <span class="px-1.5 py-0.2 bg-slate-100 border border-slate-200 text-slate-700 font-semibold rounded-xs">{{ $msg->service ?? 'Konsultasi' }}</span>
                            <span>•</span>
                            <span class="font-mono text-[10px] text-slate-400">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="font-semibold text-slate-800 line-clamp-1">{{ $msg->subject ?: 'Pengajuan Naskah' }}</p>
                        <p class="text-slate-500 line-clamp-2 text-[11.5px] leading-relaxed">{{ $msg->message }}</p>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                        @if($msg->phone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-emerald-700 hover:underline flex items-center gap-1 text-[11px] font-mono font-bold">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                <span>{{ $msg->phone }}</span>
                            </a>
                        @else
                            <span class="text-[11px] text-slate-400 font-mono">{{ $msg->email }}</span>
                        @endif
                        <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-3 py-1 bg-[#006830] text-white rounded-xs text-xs font-bold shadow-2xs flex items-center gap-1">
                            <span>Buka Pesan</span>
                            <i class="fa-solid fa-angle-right text-[9px]"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-inbox text-2xl mb-1 text-slate-300 block"></i>
                    Belum ada pesan naskah masuk.
                </div>
            @endforelse
        </div>

        <!-- 2. DESKTOP WIDE TABLE (Visible on tablets & desktop >= 640px) -->
        <div class="hidden sm:block overflow-x-auto w-full">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-600 uppercase text-[10px] font-bold border-b border-slate-200 tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Pengirim</th>
                        <th class="px-4 py-3">Layanan &amp; Subjek</th>
                        <th class="px-4 py-3">Pesan Ringkas</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/70 transition {{ $msg->status === 'pending' ? 'bg-amber-50/20' : '' }}">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="font-bold text-slate-900">{{ $msg->name }}</p>
                                <div class="flex items-center gap-2 mt-0.5 text-[11px] text-slate-500">
                                    <span>{{ $msg->email }}</span>
                                    @if($msg->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="text-emerald-700 hover:underline flex items-center gap-0.5 font-mono">
                                            <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                            <span>{{ $msg->phone }}</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-block px-1.5 py-0.2 bg-slate-100 text-slate-700 border border-slate-200 rounded-xs text-[9.5px] font-bold mb-1">
                                    {{ $msg->service_type ?: 'Konsultasi Umum' }}
                                </span>
                                <p class="font-bold text-slate-800 text-xs">{{ $msg->subject ?: '-' }}</p>
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <p class="text-slate-600 line-clamp-2 text-xs leading-relaxed">{{ $msg->message }}</p>
                            </td>
                            <td class="px-4 py-3 text-center whitespace-nowrap">
                                @if($msg->status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-100 text-amber-900 border border-amber-300 uppercase">
                                        <i class="fa-solid fa-clock text-[9px]"></i> Belum Dihubungi
                                    </span>
                                @elseif($msg->status === 'contacted')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-blue-100 text-blue-900 border border-blue-300 uppercase">
                                        <i class="fa-solid fa-comment-dots text-[9px]"></i> Sudah Dihubungi
                                    </span>
                                @elseif($msg->status === 'completed')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300 uppercase">
                                        <i class="fa-solid fa-check text-[9px]"></i> Selesai Diproses
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-slate-500 text-xs">
                                <span class="font-mono">{{ $msg->created_at->format('d/m/Y') }}</span>
                                <span class="text-[10px] text-slate-400 block mt-0.5">{{ $msg->created_at->format('H:i') }} WIB</span>
                            </td>
                            <td class="px-4 py-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-[#006830] text-slate-700 hover:text-white rounded-xs text-xs font-bold transition flex items-center gap-1 shadow-2xs">
                                        <span>Detail</span>
                                        <i class="fa-solid fa-angle-right text-[9px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-xl mb-2">
                                    <i class="fa-solid fa-inbox"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 font-heading">Tidak Ada Pesan Ditemukan</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Belum ada pengajuan naskah atau pesan baru yang sesuai filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-3 border-t border-slate-200">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
