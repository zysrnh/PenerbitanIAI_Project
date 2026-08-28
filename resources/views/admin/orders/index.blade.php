@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan & Transaksi Buku | Admin PERSIS PERS')
@section('header_title', 'Pesanan & Transaksi Buku')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Card Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-sm sm:text-lg font-extrabold text-slate-900 font-heading leading-tight">
                        Manajemen Pesanan &amp; Transaksi Buku
                    </h1>
                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 font-mono">
                        {{ $totalOrders }} Total Transaksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">Kelola konfirmasi pembayaran QRIS, update resi ekspedisi, dan cetak invoice pemesan.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Toko Publik</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Stat Cards (2x2 Grid on Mobile, 4 Cols on Desktop) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3.5">
        
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs flex items-center gap-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-sm sm:text-base shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider truncate">Total Pendapatan</p>
                <h4 class="text-xs sm:text-lg font-black text-slate-900 font-mono mt-0.5 truncate">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                <p class="text-[9px] sm:text-[10px] text-emerald-700 font-bold mt-0.5 hidden sm:block">Dari transaksi lunas</p>
            </div>
        </div>

        <!-- Pesanan Lunas -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs flex items-center gap-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-sm sm:text-base shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider truncate">Pesanan Lunas</p>
                <h4 class="text-xs sm:text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalCompleted }} Order</h4>
                <p class="text-[9px] sm:text-[10px] text-slate-500 font-semibold mt-0.5 hidden sm:block">Selesai terbayar</p>
            </div>
        </div>

        <!-- Menunggu Bayar -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs flex items-center gap-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-sm bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center text-sm sm:text-base shrink-0">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider truncate">Menunggu Bayar</p>
                <h4 class="text-xs sm:text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalPending }} Order</h4>
                <p class="text-[9px] sm:text-[10px] text-amber-700 font-semibold mt-0.5 hidden sm:block">Belum diselesaikan</p>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs flex items-center gap-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-sm bg-indigo-50 text-indigo-700 border border-indigo-200 flex items-center justify-center text-sm sm:text-base shrink-0">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider truncate">Total Semua Order</p>
                <h4 class="text-xs sm:text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalOrders }} Order</h4>
                <p class="text-[9px] sm:text-[10px] text-slate-500 font-semibold mt-0.5 hidden sm:block">Database transaksi</p>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar with Custom Autocomplete Dropdown -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-3.5 flex flex-col sm:flex-row items-center justify-between gap-3 relative z-30">
        
        <!-- Status Tabs -->
        <div class="flex items-center gap-1.5 w-full sm:w-auto overflow-x-auto select-none">
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ !$status ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua ({{ $totalOrders }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ $status === 'completed' ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Lunas ({{ $totalCompleted }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Menunggu ({{ $totalPending }})
            </a>
        </div>

        <!-- Search Input with Custom Autocomplete Dropdown -->
        <div class="w-full sm:w-80 relative" id="orderSearchContainer">
            <form method="GET" action="{{ route('admin.orders.index') }}" id="orderSearchForm">
                @if($status)
                    <input type="hidden" name="status" value="{{ $status }}">
                @endif
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                    <input 
                        type="text" 
                        name="q" 
                        id="orderSearchInput"
                        autocomplete="off"
                        spellcheck="false"
                        value="{{ $search ?? '' }}" 
                        placeholder="Cari nama pemesan, invoice, nomor HP..." 
                        class="w-full pl-8 pr-8 py-2 bg-slate-50 border border-slate-300 rounded-sm text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        oninput="handleOrderLiveSearch(this.value)"
                        onfocus="handleOrderLiveSearch(this.value)"
                    />
                    <button 
                        type="button" 
                        id="clearOrderSearchBtn" 
                        onclick="clearOrderSearch()" 
                        class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 text-xs cursor-pointer"
                        title="Hapus pencarian"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </form>

            <!-- Custom Autocomplete Dropdown Menu -->
            <div 
                id="orderAutocompleteDropdown" 
                class="hidden absolute left-0 right-0 top-full mt-1.5 bg-white rounded-sm shadow-2xl border border-emerald-600/30 overflow-hidden z-[9999] divide-y divide-slate-100 max-h-72 overflow-y-auto ring-4 ring-black/5 animate-fade-in"
            >
                <div id="orderAutocompleteList" class="p-1.5 space-y-1"></div>
            </div>
        </div>
    </div>

    <!-- Orders Table & Mobile Card Stream -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden w-full">
        
        <!-- 1. MOBILE NATIVE ORDER CARDS (Visible on mobile < 640px) -->
        <div class="block sm:hidden divide-y divide-slate-100" id="orderMobileList">
            @forelse($orders as $order)
                @php
                    $itemsArr = $order->items_json ?? [];
                    $bookNames = collect($itemsArr)->pluck('title')->filter()->implode(', ');
                @endphp
                <div class="p-3.5 space-y-2.5 hover:bg-slate-50/80 transition order-card-item" data-invoice="{{ strtolower($order->order_number) }}" data-name="{{ strtolower($order->customer_name) }}" data-phone="{{ strtolower($order->customer_phone ?? '') }}" data-book="{{ strtolower($bookNames) }}">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="font-mono font-bold text-xs text-slate-900">{{ $order->order_number }}</span>
                            <span class="text-[10px] text-slate-400">• {{ $order->created_at->format('d/m H:i') }}</span>
                        </div>
                        @if($order->payment_status === 'completed' || $order->status === 'completed')
                            <span class="px-1.5 py-0.2 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 font-mono">
                                LUNAS
                            </span>
                        @else
                            <span class="px-1.5 py-0.2 rounded-xs text-[9.5px] font-bold bg-amber-50 text-amber-800 border border-amber-200 font-mono">
                                MENUNGGU
                            </span>
                        @endif
                    </div>

                    <div class="text-xs space-y-1">
                        <p class="font-bold text-slate-900">{{ $order->customer_name }}</p>
                        <p class="text-[11px] text-slate-500 truncate">
                            @if(!empty($itemsArr))
                                @foreach($itemsArr as $item)
                                    {{ $item['title'] ?? 'Buku' }} ({{ $item['quantity'] ?? 1 }}x)@if(!$loop->last), @endif
                                @endforeach
                            @else
                                {{ $bookNames ?: 'Item Buku' }}
                            @endif
                        </p>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="font-mono font-black text-emerald-800 text-xs">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.orders.shipping_label', $order->id) }}" target="_blank" class="px-2.5 py-1 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xs text-xs font-bold transition flex items-center gap-1">
                                <i class="fa-solid fa-print text-[10px]"></i>
                                <span>Resi</span>
                            </a>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1 bg-[#006830] text-white rounded-xs text-xs font-bold shadow-2xs flex items-center gap-1">
                                <span>Detail</span>
                                <i class="fa-solid fa-angle-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-receipt text-2xl mb-1 text-slate-300 block"></i>
                    Belum ada transaksi pesanan.
                </div>
            @endforelse
        </div>

        <!-- 2. DESKTOP WIDE TABLE (Visible on tablets & desktop >= 640px) -->
        <div class="hidden sm:block overflow-x-auto w-full">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200 text-[10px]">
                    <tr>
                        <th class="py-3 px-4">No. Invoice &amp; Waktu</th>
                        <th class="py-3 px-4">Nama Pemesan</th>
                        <th class="py-3 px-4">Buku Dipesan</th>
                        <th class="py-3 px-4 text-right">Total Tagihan</th>
                        <th class="py-3 px-4 text-center">Status Bayar</th>
                        <th class="py-3 px-4 text-center">Pengiriman</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($orders as $order)
                        @php
                            $itemsArr = $order->items_json ?? [];
                            $bookNames = collect($itemsArr)->pluck('title')->filter()->implode(', ');
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition order-table-row" data-invoice="{{ strtolower($order->order_number) }}" data-name="{{ strtolower($order->customer_name) }}" data-phone="{{ strtolower($order->customer_phone ?? '') }}" data-book="{{ strtolower($bookNames) }}">
                            <!-- No. Invoice & Date -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="font-mono font-bold text-emerald-800 hover:underline">
                                    {{ $order->order_number }}
                                </a>
                                <p class="text-[10.5px] text-slate-400 font-mono mt-0.5">{{ $order->created_at->format('d/m/Y H:i') }} WIB</p>
                            </td>

                            <!-- Customer Info -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                <p class="font-bold text-slate-900">{{ $order->customer_name }}</p>
                                @if($order->customer_phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="text-[11px] text-emerald-700 hover:underline flex items-center gap-1 font-mono mt-0.5">
                                        <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                        <span>{{ $order->customer_phone }}</span>
                                    </a>
                                @endif
                            </td>

                            <!-- Ordered Books -->
                            <td class="py-3 px-4 max-w-xs">
                                <div class="space-y-1">
                                    @if(!empty($itemsArr))
                                        @foreach($itemsArr as $it)
                                            <p class="text-xs text-slate-800 truncate" title="{{ $it['title'] ?? 'Buku' }}">
                                                • {{ $it['title'] ?? 'Buku' }} <span class="text-slate-400 font-mono text-[11px]">({{ $it['quantity'] ?? 1 }} eks)</span>
                                            </p>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-slate-500 italic">-</p>
                                    @endif
                                </div>
                            </td>

                            <!-- Total Amount -->
                            <td class="py-3 px-4 text-right whitespace-nowrap">
                                <span class="font-mono font-black text-slate-900 text-xs">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                                <span class="block text-[10px] text-slate-400 font-mono uppercase">{{ $order->payment_method ?? 'QRIS' }}</span>
                            </td>

                            <!-- Payment Status Badge -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($order->payment_status === 'completed' || $order->status === 'completed')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <i class="fa-solid fa-check text-[9px]"></i> LUNAS
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <i class="fa-solid fa-clock text-[9px]"></i> MENUNGGU
                                    </span>
                                @endif
                            </td>

                            <!-- Shipping Status Badge -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($order->shipping_status === 'dikirim' || $order->shipping_status === 'shipped')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-blue-50 text-blue-800 border border-blue-200">
                                        <i class="fa-solid fa-truck-fast text-[9px]"></i> DIKIRIM
                                    </span>
                                @elseif($order->shipping_status === 'selesai' || $order->shipping_status === 'delivered')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i> DITERIMA
                                    </span>
                                @elseif($order->shipping_status === 'diproses' || $order->shipping_status === 'processing')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-indigo-50 text-indigo-800 border border-indigo-200">
                                        <i class="fa-solid fa-box text-[9px]"></i> PACKING
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <i class="fa-solid fa-clock text-[9px]"></i> MENUNGGU PROSES
                                    </span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.orders.shipping_label', $order->id) }}" target="_blank" class="px-2.5 py-1 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-xs text-xs font-bold transition flex items-center gap-1 shadow-2xs" title="Cetak Resi Pengiriman">
                                        <i class="fa-solid fa-print text-[10px] text-emerald-700"></i>
                                        <span>Resi</span>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center gap-1 shadow-2xs">
                                        <span>Detail</span>
                                        <i class="fa-solid fa-angle-right text-[9px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-xl mb-2">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 font-heading">Tidak Ada Pesanan Ditemukan</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Belum ada transaksi pesanan yang sesuai filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-3 border-t border-slate-200">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Client-side Instant Search & Autocomplete Script -->
<script>
    // Prepare order data for autocomplete
    const orderIndexData = [
        @foreach($orders as $order)
            @php
                $itNames = collect($order->items_json ?? [])->pluck('title')->filter()->implode(', ');
            @endphp
            {
                id: {{ $order->id }},
                invoice: "{{ $order->order_number }}",
                name: "{{ addslashes($order->customer_name) }}",
                phone: "{{ $order->customer_phone ?? '' }}",
                total: "Rp {{ number_format($order->total_amount, 0, ',', '.') }}",
                books: "{{ addslashes($itNames) }}",
                url: "{{ route('admin.orders.show', $order->id) }}"
            },
        @endforeach
    ];

    function handleOrderLiveSearch(query) {
        const trimmed = (query || '').trim().toLowerCase();
        const clearBtn = document.getElementById('clearOrderSearchBtn');
        const dropdown = document.getElementById('orderAutocompleteDropdown');
        const list = document.getElementById('orderAutocompleteList');
        const rows = document.querySelectorAll('.order-table-row, .order-card-item');

        if (clearBtn) {
            if (trimmed.length > 0) clearBtn.classList.remove('hidden');
            else clearBtn.classList.add('hidden');
        }

        let matching = [];

        rows.forEach(row => {
            const inv = row.getAttribute('data-invoice') || '';
            const name = row.getAttribute('data-name') || '';
            const phone = row.getAttribute('data-phone') || '';
            const book = row.getAttribute('data-book') || '';

            const matches = trimmed === '' || inv.includes(trimmed) || name.includes(trimmed) || phone.includes(trimmed) || book.includes(trimmed);

            if (matches) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        if (trimmed.length >= 1) {
            matching = orderIndexData.filter(o => 
                o.invoice.toLowerCase().includes(trimmed) || 
                o.name.toLowerCase().includes(trimmed) || 
                o.phone.toLowerCase().includes(trimmed) || 
                o.books.toLowerCase().includes(trimmed)
            ).slice(0, 6);
        }

        if (matching.length > 0) {
            list.innerHTML = '';
            matching.forEach(ord => {
                const item = document.createElement('a');
                item.href = ord.url;
                item.className = 'flex items-center justify-between p-2 rounded-sm hover:bg-emerald-50 cursor-pointer transition text-left group';

                item.innerHTML = `
                    <div class="min-w-0 pr-2">
                        <div class="flex items-center gap-1.5">
                            <span class="font-mono font-bold text-xs text-emerald-800">${ord.invoice}</span>
                            <span class="text-[10.5px] text-slate-400">• ${ord.name}</span>
                        </div>
                        <p class="text-[11px] text-slate-500 truncate mt-0.5">${ord.books || 'Detail Pesanan'}</p>
                    </div>
                    <span class="font-mono font-bold text-slate-900 text-xs shrink-0">${ord.total}</span>
                `;
                list.appendChild(item);
            });
            dropdown.classList.remove('hidden');
        } else {
            dropdown.classList.add('hidden');
        }
    }

    function clearOrderSearch() {
        const input = document.getElementById('orderSearchInput');
        input.value = '';
        handleOrderLiveSearch('');
        input.focus();
    }

    document.addEventListener('click', function(e) {
        const container = document.getElementById('orderSearchContainer');
        const dropdown = document.getElementById('orderAutocompleteDropdown');
        if (container && !container.contains(e.target) && dropdown) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection
