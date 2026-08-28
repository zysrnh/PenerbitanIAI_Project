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
        <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2.5 items-center">
            
            <!-- Search -->
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

            <!-- Status Filter -->
            <div class="lg:col-span-3">
                <select name="status" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 bg-slate-50/50 text-slate-700 font-medium">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Belum Dihubungi</option>
                    <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>💬 Sudah Dihubungi</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Selesai Diproses</option>
                </select>
            </div>

            <!-- Service Category -->
            <div class="lg:col-span-2">
                <select name="service" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 bg-slate-50/50 text-slate-700 font-medium">
                    <option value="">Semua Layanan</option>
                    <option value="Penerbitan Buku Ber-ISBN" {{ request('service') == 'Penerbitan Buku Ber-ISBN' ? 'selected' : '' }}>Buku Ber-ISBN</option>
                    <option value="Percetakan Umum & Komersil" {{ request('service') == 'Percetakan Umum & Komersil' ? 'selected' : '' }}>Percetakan Umum</option>
                    <option value="Jurnal & Prosiding Ilmiah" {{ request('service') == 'Jurnal & Prosiding Ilmiah' ? 'selected' : '' }}>Jurnal &amp; Prosiding</option>
                    <option value="Konversi KTI ke Buku" {{ request('service') == 'Konversi KTI ke Buku' ? 'selected' : '' }}>Konversi KTI</option>
                </select>
            </div>

            <!-- Buttons -->
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
        <div class="overflow-x-auto w-full">
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
