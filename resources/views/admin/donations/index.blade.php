@extends('admin.layouts.app')

@section('title', 'Kelola Donasi Digital | PERSIS PERS')
@section('header_title', 'Kelola Donasi Digital & Unduh Buku')

@section('content')
<div class="space-y-6">

    <!-- Top Header & Action Buttons -->
    <div class="bg-white rounded-sm border border-slate-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    DONASI &amp; WAKAF DIGITAL
                </span>
                <span class="text-xs text-slate-400 font-medium">• Rekapitulasi Dukungan Pembaca</span>
            </div>
            <h1 class="text-xl font-black text-slate-900 font-heading tracking-tight">
                Daftar Riwayat Donasi Digital
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Pantau donasi yang masuk melalui QRIS dan Transfer Bank dari pembaca katalog buku digital.
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.donations.settings') }}" class="px-4 py-2 bg-emerald-800 hover:bg-emerald-900 text-white rounded-sm text-xs font-bold transition flex items-center gap-2">
                <i class="fa-solid fa-qrcode"></i>
                <span>Pengaturan QRIS &amp; Rekening</span>
            </a>
        </div>
    </div>

    <!-- Stats 4 Cards (Flat Style) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Donasi Terkonfirmasi -->
        <div class="bg-white p-4 rounded-sm border border-slate-200 flex items-center justify-between">
            <div>
                <span class="text-[10.5px] font-bold text-slate-500 uppercase tracking-wider block">Total Donasi Sah</span>
                <span class="text-lg sm:text-xl font-black text-emerald-800 font-mono mt-0.5 block">
                    Rp {{ number_format($stats['total_amount'], 0, ',', '.') }}
                </span>
                <span class="text-[10px] text-emerald-700 font-semibold">{{ $stats['confirmed_count'] }} transaksi terkonfirmasi</span>
            </div>
            <div class="w-10 h-10 rounded-xs bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-hand-holding-dollar"></i>
            </div>
        </div>

        <!-- Total Semua Transaksi -->
        <div class="bg-white p-4 rounded-sm border border-slate-200 flex items-center justify-between">
            <div>
                <span class="text-[10.5px] font-bold text-slate-500 uppercase tracking-wider block">Total Masuk (Semua)</span>
                <span class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 block">
                    Rp {{ number_format($stats['all_amount'], 0, ',', '.') }}
                </span>
                <span class="text-[10px] text-slate-500 font-semibold">{{ $stats['total_donors'] }} total donatur</span>
            </div>
            <div class="w-10 h-10 rounded-xs bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <!-- Donasi via QRIS -->
        <div class="bg-white p-4 rounded-sm border border-slate-200 flex items-center justify-between">
            <div>
                <span class="text-[10.5px] font-bold text-slate-500 uppercase tracking-wider block">Metode QRIS</span>
                <span class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 block">
                    {{ $stats['qris_count'] }} Donasi
                </span>
                <span class="text-[10px] text-emerald-700 font-semibold">Scan QRIS Instan</span>
            </div>
            <div class="w-10 h-10 rounded-xs bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-qrcode"></i>
            </div>
        </div>

        <!-- Menunggu Konfirmasi -->
        <div class="bg-white p-4 rounded-sm border border-slate-200 flex items-center justify-between">
            <div>
                <span class="text-[10.5px] font-bold text-slate-500 uppercase tracking-wider block">Menunggu Konfirmasi</span>
                <span class="text-lg sm:text-xl font-black text-amber-700 font-mono mt-0.5 block">
                    {{ $stats['pending_count'] }} Transaksi
                </span>
                <span class="text-[10px] text-amber-600 font-semibold">Perlu dicek admin</span>
            </div>
            <div class="w-10 h-10 rounded-xs bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center text-lg shrink-0">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-sm border border-slate-200 p-4">
        <form method="GET" action="{{ route('admin.donations.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            <div class="sm:col-span-5">
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Cari Donatur / Buku</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, WhatsApp, email, atau judul buku..." class="w-full pl-8 pr-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-700" />
                    <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-2.5 text-xs text-slate-400"></i>
                </div>
            </div>

            <div class="sm:col-span-3">
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Status Konfirmasi</label>
                <select name="status" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white">
                    <option value="all" {{ request('status') === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Terkonfirmasi (Sah)</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-[11px] font-bold text-slate-700 mb-1">Metode</label>
                <select name="method" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white">
                    <option value="all" {{ request('method') === 'all' ? 'selected' : '' }}>Semua Metode</option>
                    <option value="qris" {{ request('method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                    <option value="transfer" {{ request('method') === 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                </select>
            </div>

            <div class="sm:col-span-2 flex items-end gap-2">
                <button type="submit" class="flex-1 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-filter text-[10px]"></i>
                    <span>Filter</span>
                </button>
                @if(request()->hasAny(['search', 'status', 'method']))
                    <a href="{{ route('admin.donations.index') }}" class="px-2.5 py-2 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-700 border border-slate-300 rounded-sm text-xs transition" title="Reset Filter">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table of Donations -->
    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-700 uppercase font-black tracking-wider text-[10px]">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Donatur</th>
                        <th class="px-4 py-3">Buku Terkait</th>
                        <th class="px-4 py-3">Nominal</th>
                        <th class="px-4 py-3">Metode &amp; Bank</th>
                        <th class="px-4 py-3">Bukti Bayar</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-800">
                    @forelse($donations as $d)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-4 py-3.5 whitespace-nowrap text-slate-500 font-mono text-[11px]">
                                {{ $d->created_at ? $d->created_at->format('d M Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="font-bold text-slate-900">{{ $d->donor_name }}</div>
                                <div class="text-[11px] text-slate-500 flex items-center gap-2 mt-0.5">
                                    @if($d->donor_phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $d->donor_phone) }}" target="_blank" class="text-emerald-700 hover:underline flex items-center gap-1 font-mono">
                                            <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                            <span>{{ $d->donor_phone }}</span>
                                        </a>
                                    @endif
                                    @if($d->donor_email)
                                        <span class="text-slate-400">&bull; {{ $d->donor_email }}</span>
                                    @endif
                                </div>
                                @if($d->notes)
                                    <div class="text-[10.5px] text-slate-600 bg-slate-50 p-1.5 rounded-xs border border-slate-200 mt-1 max-w-xs italic">
                                        "{{ $d->notes }}"
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 max-w-xs">
                                @if($d->digitalBook)
                                    <span class="font-bold text-slate-800 block truncate" title="{{ $d->digitalBook->title }}">
                                        {{ $d->digitalBook->title }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-mono">{{ $d->digitalBook->category }}</span>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">Donasi Umum / Bebas</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <span class="font-black text-emerald-900 font-mono text-sm block">
                                    {{ $d->formatted_amount }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($d->payment_method === 'qris')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold text-[10.5px]">
                                        <i class="fa-solid fa-qrcode text-[9px]"></i>
                                        <span>QRIS</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs bg-sky-100 text-sky-900 border border-sky-300 font-bold text-[10.5px]">
                                        <i class="fa-solid fa-building-columns text-[9px]"></i>
                                        <span>Transfer</span>
                                    </span>
                                    <span class="block text-[10px] text-slate-500 font-medium mt-0.5">{{ $d->bank_name ?: 'Bank BSI' }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($d->proof_image)
                                    <button type="button" onclick="showProofModal('{{ $d->proof_url }}', '{{ addslashes($d->donor_name) }}', '{{ $d->formatted_amount }}')" class="inline-flex items-center gap-1 px-2 py-1 bg-white border border-slate-300 hover:border-emerald-700 text-slate-700 hover:text-emerald-800 rounded-xs text-[11px] font-bold transition cursor-pointer">
                                        <i class="fa-solid fa-image text-emerald-700"></i>
                                        <span>Lihat Bukti</span>
                                    </button>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">Tanpa File</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                @if($d->status === 'confirmed')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xs bg-emerald-100 text-emerald-900 border border-emerald-300 font-bold text-[10.5px]">
                                        <i class="fa-solid fa-check-double text-[9px] text-emerald-700"></i>
                                        <span>TERKONFIRMASI</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xs bg-amber-100 text-amber-900 border border-amber-300 font-bold text-[10.5px]">
                                        <i class="fa-solid fa-clock text-[9px] text-amber-700"></i>
                                        <span>PENDING</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap space-x-1">
                                <form action="{{ route('admin.donations.status', $d->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-1.5 px-2.5 {{ $d->status === 'confirmed' ? 'bg-slate-100 hover:bg-slate-200 text-slate-700' : 'bg-emerald-700 hover:bg-emerald-800 text-white' }} rounded-xs text-[10.5px] font-bold transition cursor-pointer" title="{{ $d->status === 'confirmed' ? 'Batalkan Konfirmasi' : 'Konfirmasi Donasi Sah' }}">
                                        @if($d->status === 'confirmed')
                                            <i class="fa-solid fa-rotate-left mr-1"></i><span>Ubah Pending</span>
                                        @else
                                            <i class="fa-solid fa-check mr-1"></i><span>Sahkan</span>
                                        @endif
                                    </button>
                                </form>

                                <form action="{{ route('admin.donations.destroy', $d->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus riwayat donasi dari {{ addslashes($d->donor_name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 px-2 bg-white hover:bg-rose-50 text-slate-400 hover:text-rose-600 border border-slate-200 hover:border-rose-300 rounded-xs text-[10.5px] transition cursor-pointer" title="Hapus Data">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-12 text-center text-slate-400 space-y-2">
                                <i class="fa-solid fa-hand-holding-heart text-4xl text-slate-300"></i>
                                <div class="font-bold text-slate-600 text-sm">Belum ada catatan donasi masuk</div>
                                <div class="text-xs text-slate-400">Donasi dari pembaca buku digital akan otomatis tercatat di halaman ini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donations->hasPages())
            <div class="p-4 bg-slate-50 border-t border-slate-200">
                {{ $donations->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal Lihat Bukti Transfer -->
<div id="proofModal" class="fixed inset-0 z-50 bg-black/80 hidden items-center justify-center p-4 animate-fade-in" style="display: none;">
    <div class="bg-white rounded-sm border border-slate-300 max-w-md w-full overflow-hidden shadow-2xl space-y-3 p-5">
        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
            <div>
                <h4 class="font-bold text-slate-900 text-sm" id="modalProofTitle">Bukti Pembayaran Donasi</h4>
                <p class="text-xs text-slate-500" id="modalProofSubtitle">Nama Donatur</p>
            </div>
            <button type="button" onclick="closeProofModal()" class="w-7 h-7 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xs flex items-center justify-center cursor-pointer">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="rounded-xs overflow-hidden border border-slate-200 bg-slate-100 max-h-96 flex items-center justify-center">
            <img id="modalProofImg" src="" alt="Bukti Transfer" class="max-h-96 w-auto object-contain mx-auto" />
        </div>

        <div class="pt-2 flex items-center justify-between">
            <span class="text-xs font-bold text-emerald-800 font-mono" id="modalProofAmount">Rp 0</span>
            <a id="modalProofDownload" href="#" target="_blank" class="px-3 py-1.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span>Buka Ukuran Asli</span>
            </a>
        </div>
    </div>
</div>

<script>
    function showProofModal(url, donor, amount) {
        document.getElementById('modalProofImg').src = url;
        document.getElementById('modalProofDownload').href = url;
        document.getElementById('modalProofSubtitle').innerText = 'Donatur: ' + donor;
        document.getElementById('modalProofAmount').innerText = amount;
        
        const modal = document.getElementById('proofModal');
        modal.style.display = 'flex';
        modal.classList.remove('hidden');
    }

    function closeProofModal() {
        const modal = document.getElementById('proofModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
    }
</script>
@endsection
