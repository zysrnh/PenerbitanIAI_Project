@extends('admin.layouts.app')

@section('title', 'Pesan & Pengajuan Naskah')
@section('header_title', 'Pesan Masuk & Pengajuan Naskah')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <div class="min-w-0">
            <div class="flex items-center gap-2 flex-wrap">
                <h3 class="text-base sm:text-lg font-bold text-slate-900">Kotak Masuk Redaksi</h3>
                @if($pendingCount > 0)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                        {{ $pendingCount }} Belum Dihubungi
                    </span>
                @endif
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Daftar pengajuan naskah dan pesan konsultasi yang dikirim melalui website.</p>
        </div>
        <a href="{{ route('admin.settings.contact') }}" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs sm:text-sm font-semibold transition flex items-center gap-2 shadow-xs shrink-0 whitespace-nowrap">
            <i class="fa-solid fa-sliders text-xs"></i> Pengaturan Kontak
        </a>
    </div>

    <!-- Filters Bar (Wrap nicely on smaller screens) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-4 mb-6">
        <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
            <!-- Search -->
            <div class="sm:col-span-2 lg:col-span-5 relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari pengirim, email, telp, subjek..." 
                    class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition bg-slate-50/50"
                />
            </div>

            <!-- Status -->
            <div class="lg:col-span-3">
                <select name="status" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 bg-slate-50/50 text-slate-700 font-medium">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Belum Dihubungi</option>
                    <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>💬 Sudah Dihubungi</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Selesai Diproses</option>
                </select>
            </div>

            <!-- Service Category -->
            <div class="lg:col-span-2">
                <select name="service" class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 bg-slate-50/50 text-slate-700 font-medium">
                    <option value="">Semua Layanan</option>
                    <option value="Penerbitan Buku Ber-ISBN" {{ request('service') == 'Penerbitan Buku Ber-ISBN' ? 'selected' : '' }}>Buku Ber-ISBN</option>
                    <option value="Percetakan Umum & Komersil" {{ request('service') == 'Percetakan Umum & Komersil' ? 'selected' : '' }}>Percetakan Umum</option>
                    <option value="Jurnal & Prosiding Ilmiah" {{ request('service') == 'Jurnal & Prosiding Ilmiah' ? 'selected' : '' }}>Jurnal & Prosiding</option>
                    <option value="Konversi KTI ke Buku" {{ request('service') == 'Konversi KTI ke Buku' ? 'selected' : '' }}>Konversi KTI</option>
                </select>
            </div>

            <!-- Action -->
            <div class="lg:col-span-2 flex gap-2">
                <button type="submit" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs sm:text-sm font-bold rounded-xl transition">
                    Filter
                </button>
                @if(request('search') || request('status') || request('service'))
                    <a href="{{ route('admin.messages.index') }}" class="px-3.5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs sm:text-sm font-semibold rounded-xl transition flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Messages Table (Strictly contained with overflow-x-auto) -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden w-full">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left text-xs sm:text-sm text-slate-700 min-w-[700px]">
                <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold border-b border-slate-200/80 tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Pengirim</th>
                        <th class="px-5 py-3.5">Layanan & Subjek</th>
                        <th class="px-5 py-3.5">Pesan Ringkas</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Tanggal Masuk</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/60 transition {{ $msg->status === 'pending' ? 'bg-amber-50/30' : '' }}">
                            <!-- Sender -->
                            <td class="px-5 py-4 font-semibold text-slate-900">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs ring-1 ring-slate-200 shrink-0">
                                        {{ strtoupper(substr($msg->name, 0, 1)) }}
                                    </div>
                                    <div class="truncate max-w-[180px]">
                                        <span class="block text-slate-900 font-bold truncate">{{ $msg->name }}</span>
                                        <span class="text-xs text-slate-500 font-normal block truncate">{{ $msg->email }}</span>
                                        <span class="text-xs text-emerald-700 font-semibold block truncate"><i class="fa-brands fa-whatsapp mr-1 text-[11px]"></i>{{ $msg->phone }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Service & Subject -->
                            <td class="px-5 py-4">
                                <span class="inline-block text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-800 border border-slate-200/70 mb-1">
                                    {{ $msg->service_category ?? 'Umum' }}
                                </span>
                                <span class="block text-xs font-semibold text-slate-800 truncate max-w-[200px]">{{ $msg->subject ?: 'Konsultasi Naskah' }}</span>
                            </td>

                            <!-- Message Snippet -->
                            <td class="px-5 py-4 text-slate-600 max-w-[220px] truncate text-xs">
                                {{ Str::limit($msg->message, 50) }}
                            </td>

                            <!-- Status -->
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($msg->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-800 ring-1 ring-amber-200/80">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum Dihubungi
                                    </span>
                                @elseif($msg->status === 'contacted')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-800 ring-1 ring-blue-200/80">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Sudah Dihubungi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200/80">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                                    </span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td class="px-5 py-4 text-slate-500 text-xs whitespace-nowrap">
                                {{ $msg->created_at->format('d M Y, H:i') }}
                            </td>

                            <!-- Actions -->
                            <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap">
                                <!-- Direct WhatsApp Link -->
                                <a href="{{ $msg->wa_link }}" target="_blank" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#25D366]/10 text-[#128C7E] hover:bg-[#25D366] hover:text-white transition border border-[#25D366]/30">
                                    <i class="fa-brands fa-whatsapp text-sm mr-1"></i> Chat WA
                                </a>

                                <!-- Show Detail -->
                                <a href="{{ route('admin.messages.show', $msg) }}" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 transition border border-slate-200">
                                    <i class="fa-solid fa-eye text-[10px] mr-1 text-slate-400"></i> Detail
                                </a>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" class="inline-block" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium text-rose-600 hover:text-rose-800 hover:bg-rose-50 transition border border-rose-200/60">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-slate-400">
                                Belum ada pesan atau pengajuan naskah masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-5 py-3.5 border-t border-slate-100">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection
