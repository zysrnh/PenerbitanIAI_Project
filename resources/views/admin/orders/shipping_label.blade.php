<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label Pengiriman #{{ $order->order_number }} | PERSIS PERS</title>

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=JetBrains+Mono:wght@600;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #0f172a;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Print Specific Styling */
        @media print {
            body {
                background-color: #ffffff !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .label-page {
                box-shadow: none !important;
                border: 2px solid #000000 !important;
                margin: 0 auto !important;
                max-width: 100% !important;
                page-break-inside: avoid;
            }
            @page {
                size: 105mm 148mm; /* Standard A6 shipping label / thermal */
                margin: 4mm;
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-3 sm:p-6 antialiased">

    <!-- Top Action Controls (Hidden on Print) -->
    <div class="no-print w-full max-w-lg mb-4 flex items-center justify-between gap-3 bg-white p-3.5 rounded-sm border border-slate-200 shadow-2xs">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 flex items-center gap-1.5 transition">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Detail</span>
        </a>

        <div class="flex items-center gap-2">
            <button type="button" onclick="window.print()" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer">
                <i class="fa-solid fa-print text-xs"></i>
                <span>Cetak Label (Print / PDF)</span>
            </button>
        </div>
    </div>

    <!-- Printable Shipping Label (Standard A6 / Thermal 100x150mm Container) -->
    <div class="label-page w-full max-w-lg bg-white border-2 border-slate-900 rounded-sm shadow-xl p-4 sm:p-5 text-slate-900 space-y-3.5 select-none">
        
        <!-- 1. Header: Brand Logo & Invoice Code -->
        <div class="flex items-center justify-between pb-3 border-b-2 border-slate-900 gap-3">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}?v=3" alt="PERSIS PERS" class="h-10 w-auto object-contain" />
            </div>
            <div class="text-right">
                <span class="text-[9.5px] font-bold uppercase tracking-wider block font-mono text-slate-500">INVOICE PENGIRIMAN</span>
                <span class="text-sm font-black font-mono tracking-tight block">#{{ $order->order_number }}</span>
                <span class="text-[9px] text-slate-500 font-mono">{{ $order->created_at->format('d/m/Y H:i') }} WIB</span>
            </div>
        </div>

        <!-- 2. Big Tracking / Resi Box -->
        <div class="p-2.5 bg-slate-100 border-2 border-dashed border-slate-400 rounded-sm flex items-center justify-between gap-3">
            <div>
                <span class="text-[9px] font-bold text-slate-500 uppercase tracking-wider block">NOMOR RESI EKSPEDISI</span>
                <span class="text-sm sm:text-base font-black font-mono text-slate-900 tracking-wider">
                    {{ $order->tracking_number ?: 'MENUNGGU RESI' }}
                </span>
            </div>
            <div class="text-right">
                <span class="px-2.5 py-1 bg-slate-900 text-white rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    NON-COD / LUNAS
                </span>
                <span class="text-[8.5px] text-slate-500 block mt-0.5 font-bold">KURIR JANGAN TAGIH UANG</span>
            </div>
        </div>

        <!-- 3. Sender & Recipient Box -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pb-3 border-b-2 border-slate-900 text-xs">
            
            <!-- FROM (PENGIRIM) -->
            <div class="space-y-1 bg-slate-50 p-2.5 rounded-sm border border-slate-300">
                <div class="flex items-center gap-1.5 text-slate-600 font-extrabold uppercase text-[9.5px] tracking-wider">
                    <i class="fa-solid fa-paper-plane text-[9px]"></i>
                    <span>PENGIRIM (FROM):</span>
                </div>
                <p class="font-extrabold text-xs text-slate-900">PERSIS PERS (Penerbitan IAI PERSIS)</p>
                <p class="text-[10px] text-slate-700 leading-tight">
                    Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Kab. Bandung 40287
                </p>
                <p class="text-[10px] font-mono text-slate-800 font-bold mt-1">
                    <i class="fa-solid fa-phone text-[8.5px] mr-1"></i>082116116133
                </p>
            </div>

            <!-- TO (PENERIMA) -->
            <div class="space-y-1 bg-emerald-50/60 p-2.5 rounded-sm border-2 border-emerald-700">
                <div class="flex items-center gap-1.5 text-emerald-900 font-extrabold uppercase text-[9.5px] tracking-wider">
                    <i class="fa-solid fa-location-dot text-[9px] text-emerald-700"></i>
                    <span>PENERIMA (TO):</span>
                </div>
                <p class="font-black text-sm text-slate-900 leading-tight">{{ $order->customer_name }}</p>
                <p class="text-[11px] font-mono font-bold text-emerald-800 leading-tight">
                    <i class="fa-brands fa-whatsapp mr-0.5"></i>{{ $order->customer_phone }}
                </p>
                <div class="pt-1 mt-1 border-t border-emerald-200">
                    <p class="text-[10.5px] text-slate-800 font-medium leading-snug">
                        {{ $order->customer_address }}
                    </p>
                </div>
            </div>

        </div>

        <!-- 4. Notes if any -->
        @if($order->notes)
            <div class="p-2 bg-amber-50 border border-amber-300 rounded-sm text-[10.5px]">
                <span class="font-bold text-amber-900 block text-[9px] uppercase">Catatan Pembeli:</span>
                <p class="text-amber-950 font-medium italic">"{{ $order->notes }}"</p>
            </div>
        @endif

        <!-- 5. Items Summary Table -->
        <div class="space-y-1">
            <span class="text-[9.5px] font-extrabold uppercase tracking-wider block text-slate-600">ISI PAKET BUKU (ITEM LIST):</span>
            
            <div class="border border-slate-300 rounded-sm overflow-hidden text-xs">
                <table class="w-full text-left text-[10.5px]">
                    <thead class="bg-slate-100 text-slate-700 font-bold uppercase border-b border-slate-300">
                        <tr>
                            <th class="p-1.5 pl-2">Judul Buku / Naskah</th>
                            <th class="p-1.5 text-center w-12">Qty</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 font-medium">
                        @if(!empty($order->items_json))
                            @foreach($order->items_json as $it)
                                <tr>
                                    <td class="p-1.5 pl-2 text-slate-800">
                                        {{ $it['title'] ?? 'Buku' }}
                                        <span class="text-[9px] text-slate-500 block font-sans">{{ $it['author'] ?? '' }}</span>
                                    </td>
                                    <td class="p-1.5 text-center font-mono font-bold text-slate-900">{{ $it['quantity'] ?? 1 }}x</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="p-1.5 text-center text-slate-400 italic">Buku Terbitan PERSIS PERS</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 6. Footer Note -->
        <div class="pt-2 border-t border-slate-300 flex items-center justify-between text-[9px] text-slate-500 font-mono">
            <span>Diterbitkan resmi oleh Unit Penerbitan IAI PERSIS Bandung</span>
            <span>www.iaipibandung.ac.id</span>
        </div>

    </div>

</body>
</html>
