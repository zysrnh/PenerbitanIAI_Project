@extends('admin.layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' | Admin PERSIS PERS')
@section('header_title', 'Kelola Pesanan #' . $order->order_number)

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Navigation & Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-800 flex items-center gap-1.5 transition">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Daftar Pesanan</span>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="px-3.5 py-1.5 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-file-invoice text-emerald-700 text-xs"></i>
                <span>Buka Invoice Publik</span>
            </a>
            <a href="{{ route('admin.orders.shipping_label', $order->id) }}" target="_blank" class="px-3.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Cetak Label Resi</span>
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}?text={{ urlencode('Halo ' . $order->customer_name . ', terkait pesanan buku #' . $order->order_number . ' di PERSIS PERS.') }}" target="_blank" class="px-3.5 py-1.5 bg-emerald-50 hover:bg-emerald-100/80 border border-emerald-300 text-emerald-800 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                <span>Chat Pemesan</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-2xs animate-fade-in">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Main Order Details Card -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
        
        <!-- Header Banner -->
        <div class="p-4 sm:p-5 bg-slate-50/80 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="space-y-0.5">
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold uppercase text-emerald-800 font-mono tracking-wider">INVOICE PEMESANAN</span>
                    <span class="text-xs text-slate-400">• IAI PERSIS</span>
                </div>
                <h2 class="text-lg sm:text-xl font-black text-slate-900 font-mono">#{{ $order->order_number }}</h2>
                <p class="text-xs text-slate-500">Dibuat pada {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
            
            <div class="sm:text-right">
                @if($order->payment_status === 'completed')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-800 border border-emerald-300 rounded-xs text-xs font-bold uppercase font-mono">
                        <i class="fa-solid fa-circle-check text-emerald-700"></i> LUNAS / TERBAYAR
                    </span>
                    <p class="text-[11px] text-slate-500 mt-1 font-mono">Dibayar: {{ $order->paid_at ? $order->paid_at->format('d/m/Y H:i') : $order->created_at->format('d/m/Y H:i') }} WIB</p>
                @elseif($order->payment_status === 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-900 border border-amber-300 rounded-xs text-xs font-bold uppercase font-mono">
                        <i class="fa-solid fa-clock text-amber-700"></i> MENUNGGU PEMBAYARAN
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-900 border border-red-300 rounded-xs text-xs font-bold uppercase font-mono">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                @endif
            </div>
        </div>

        <!-- 2-Column Info: Customer Info & Shipping Update Form -->
        <div class="p-4 sm:p-5 grid grid-cols-1 md:grid-cols-2 gap-5 border-b border-slate-200">
            
            <!-- Column 1: Customer Info -->
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-user-tag text-emerald-700 text-xs"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Informasi Pemesan</h3>
                </div>

                <div class="bg-slate-50/70 p-4 rounded-sm border border-slate-200 space-y-2.5 text-xs text-slate-700">
                    <div>
                        <span class="text-[10px] text-slate-400 font-semibold block uppercase">Nama Lengkap:</span>
                        <p class="text-sm font-bold text-slate-900">{{ $order->customer_name }}</p>
                    </div>

                    <div class="flex items-center gap-3 pt-1 border-t border-slate-200/80">
                        <div class="flex-1">
                            <span class="text-[10px] text-slate-400 font-semibold block uppercase">No. WhatsApp:</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="font-mono text-emerald-700 font-bold hover:underline flex items-center gap-1 mt-0.5">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                <span>{{ $order->customer_phone }}</span>
                            </a>
                        </div>
                        @if($order->customer_email)
                            <div class="flex-1">
                                <span class="text-[10px] text-slate-400 font-semibold block uppercase">Email:</span>
                                <p class="text-slate-700 truncate mt-0.5">{{ $order->customer_email }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-2 border-t border-slate-200/80">
                        <span class="text-[10px] text-slate-400 font-semibold block uppercase mb-0.5">Alamat Pengiriman:</span>
                        <p class="text-slate-800 leading-relaxed font-medium">{{ $order->customer_address }}</p>
                    </div>

                    @if($order->notes)
                        <div class="pt-2 border-t border-slate-200/80">
                            <span class="text-[10px] text-amber-800 font-bold block uppercase mb-0.5">Catatan Tambahan Pembeli:</span>
                            <p class="text-amber-900 bg-amber-50/80 p-2 rounded-xs border border-amber-200/80 italic leading-relaxed">
                                "{{ $order->notes }}"
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 2: Shipping Status Form -->
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-truck-fast text-emerald-700 text-xs"></i>
                    <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Update Status Pengiriman &amp; Resi</h3>
                </div>

                <form method="POST" action="{{ route('admin.orders.shipping', $order->id) }}" class="bg-slate-50/70 p-4 rounded-sm border border-slate-200 space-y-3 text-xs">
                    @csrf
                    
                                        <!-- Custom Enterprise Status Dropdown (No Emojis) -->
                    <div class="relative" id="customShippingDropdownContainer">
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Pengiriman</label>
                        
                        <!-- Hidden Input for Form Submission -->
                        <input type="hidden" name="shipping_status" id="shippingStatusValue" value="{{ $order->shipping_status }}" />

                        <!-- Trigger Button -->
                        <button 
                            type="button" 
                            id="shippingStatusTrigger"
                            onclick="toggleShippingDropdown()"
                            class="w-full px-3 py-2 bg-white border border-slate-300 rounded-sm text-slate-800 text-xs font-semibold flex items-center justify-between shadow-2xs hover:border-emerald-600 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition cursor-pointer"
                        >
                            <div class="flex items-center gap-2" id="selectedStatusDisplay">
                                @if($order->shipping_status === 'selesai')
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                                    <span class="text-slate-900 font-bold">Pesanan Selesai / Diterima</span>
                                @elseif($order->shipping_status === 'dikirim')
                                    <i class="fa-solid fa-truck-fast text-blue-600 text-sm"></i>
                                    <span class="text-slate-900 font-bold">Sudah Dikirim (Kurir / Ekspedisi)</span>
                                @elseif($order->shipping_status === 'diproses')
                                    <i class="fa-solid fa-box text-indigo-600 text-sm"></i>
                                    <span class="text-slate-900 font-bold">Sedang Diproses / Packing</span>
                                @else
                                    <i class="fa-solid fa-clock text-amber-600 text-sm"></i>
                                    <span class="text-slate-900 font-bold">Menunggu Proses Packing</span>
                                @endif
                            </div>
                            <i id="shippingDropdownChevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200"></i>
                        </button>

                        <!-- Dropdown Options Menu -->
                        <div 
                            id="shippingStatusMenu" 
                            class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in"
                        >
                            <!-- 1. Menunggu Proses -->
                            <button 
                                type="button" 
                                onclick="selectShippingOption('menunggu_proses', 'fa-solid fa-clock text-amber-600', 'Menunggu Proses Packing')"
                                class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                            >
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 rounded-xs bg-amber-50 text-amber-700 flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">Menunggu Proses Packing</p>
                                        <p class="text-[10px] text-slate-400">Pesanan baru lunas siap disiapkan</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-check text-xs text-emerald-600 {{ $order->shipping_status === 'menunggu_proses' ? '' : 'hidden' }} status-check-icon" data-status="menunggu_proses"></i>
                            </button>

                            <!-- 2. Sedang Diproses -->
                            <button 
                                type="button" 
                                onclick="selectShippingOption('diproses', 'fa-solid fa-box text-indigo-600', 'Sedang Diproses / Packing')"
                                class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                            >
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 rounded-xs bg-indigo-50 text-indigo-700 flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-box"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">Sedang Diproses / Packing</p>
                                        <p class="text-[10px] text-slate-400">Naskah &amp; buku sedang dikemas</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-check text-xs text-emerald-600 {{ $order->shipping_status === 'diproses' ? '' : 'hidden' }} status-check-icon" data-status="diproses"></i>
                            </button>

                            <!-- 3. Sudah Dikirim -->
                            <button 
                                type="button" 
                                onclick="selectShippingOption('dikirim', 'fa-solid fa-truck-fast text-blue-600', 'Sudah Dikirim (Kurir / Ekspedisi)')"
                                class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                            >
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 rounded-xs bg-blue-50 text-blue-700 flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">Sudah Dikirim (Kurir / Ekspedisi)</p>
                                        <p class="text-[10px] text-slate-400">Paket telah diserahkan ke kurir</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-check text-xs text-emerald-600 {{ $order->shipping_status === 'dikirim' ? '' : 'hidden' }} status-check-icon" data-status="dikirim"></i>
                            </button>

                            <!-- 4. Selesai / Diterima -->
                            <button 
                                type="button" 
                                onclick="selectShippingOption('selesai', 'fa-solid fa-circle-check text-emerald-600', 'Pesanan Selesai / Diterima')"
                                class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                            >
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900">Pesanan Selesai / Diterima</p>
                                        <p class="text-[10px] text-slate-400">Buku telah sukses diterima pembeli</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-check text-xs text-emerald-600 {{ $order->shipping_status === 'selesai' ? '' : 'hidden' }} status-check-icon" data-status="selesai"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Resi Pengiriman</label>
                        <div class="relative">
                            <i class="fa-solid fa-barcode absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            <input 
                                type="text" 
                                name="tracking_number" 
                                value="{{ $order->tracking_number }}" 
                                placeholder="Contoh: JNE / J&T / Sicepat (Resi)" 
                                class="w-full pl-8 pr-3 py-2 bg-white border border-slate-300 rounded-sm text-slate-900 text-xs font-mono font-bold placeholder-slate-400 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 uppercase" 
                            />
                        </div>
                        <span class="text-[10px] text-slate-400 mt-1 block">Nomor resi akan langsung tampil di akun member dan invoice pembeli.</span>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm font-bold text-xs uppercase tracking-wider transition shadow-2xs flex items-center justify-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Status Pengiriman</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- Order Items List -->
        <div class="p-4 sm:p-5">
            <div class="flex items-center gap-2 mb-3">
                <i class="fa-solid fa-book-open text-emerald-700 text-xs"></i>
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading">Daftar Buku Dipesan</h3>
            </div>

            <div class="overflow-x-auto rounded-sm border border-slate-200">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200 text-[10px]">
                        <tr>
                            <th class="py-2.5 px-4">Judul Buku &amp; Penulis</th>
                            <th class="py-2.5 px-4 text-center">Jumlah</th>
                            <th class="py-2.5 px-4 text-right">Harga Satuan</th>
                            <th class="py-2.5 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @if(!empty($order->items_json))
                            @foreach($order->items_json as $it)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3 px-4">
                                        <p class="font-bold text-slate-900">{{ $it['title'] ?? 'Buku' }}</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $it['category'] ?? 'Penerbitan' }} • Penulis: {{ $it['author'] ?? '-' }}</p>
                                    </td>
                                    <td class="py-3 px-4 text-center font-bold font-mono text-slate-900">{{ $it['quantity'] ?? 1 }}x</td>
                                    <td class="py-3 px-4 text-right font-mono text-slate-700">{{ $it['formatted_price'] ?? 'Rp 0' }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-slate-900 font-mono">{{ $it['formatted_subtotal'] ?? 'Rp 0' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="py-4 text-center text-slate-400 italic">Data item buku tidak tersedia</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Calculation Summary Box -->
            <div class="mt-4 flex justify-end">
                <div class="w-full sm:w-72 space-y-2 text-xs bg-slate-50 p-4 rounded-sm border border-slate-200">
                    <div class="flex justify-between text-slate-600">
                        <span>Subtotal Buku:</span>
                        <span class="font-mono text-slate-900 font-bold">{{ $order->formatted_total }}</span>
                    </div>
                    @if($order->fee > 0)
                        <div class="flex justify-between text-slate-600">
                            <span>Biaya Layanan / QRIS:</span>
                            <span class="font-mono text-slate-900">{{ $order->formatted_fee }}</span>
                        </div>
                    @endif
                    <div class="pt-2 border-t border-slate-200 flex justify-between items-center text-slate-900">
                        <span class="font-extrabold text-xs">Total Pembayaran:</span>
                        <span class="font-black font-mono text-sm text-emerald-800">{{ $order->formatted_payment }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    function toggleShippingDropdown() {
        const menu = document.getElementById('shippingStatusMenu');
        const chevron = document.getElementById('shippingDropdownChevron');
        menu.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }

    function selectShippingOption(value, iconClass, label) {
        document.getElementById('shippingStatusValue').value = value;
        
        // Update trigger display
        const display = document.getElementById('selectedStatusDisplay');
        display.innerHTML = `<i class="${iconClass} text-sm"></i><span class="text-slate-900 font-bold">${label}</span>`;
        
        // Update check icons
        document.querySelectorAll('.status-check-icon').forEach(icon => {
            if (icon.getAttribute('data-status') === value) {
                icon.classList.remove('hidden');
            } else {
                icon.classList.add('hidden');
            }
        });

        // Close menu
        toggleShippingDropdown();
    }

    // Close dropdown on click outside
    document.addEventListener('click', function(e) {
        const container = document.getElementById('customShippingDropdownContainer');
        const menu = document.getElementById('shippingStatusMenu');
        const chevron = document.getElementById('shippingDropdownChevron');
        if (container && !container.contains(e.target) && menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            chevron.classList.remove('rotate-180');
        }
    });
</script>
@endsection

