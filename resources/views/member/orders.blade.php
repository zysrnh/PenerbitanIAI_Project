<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan & Transaksi Saya | Portal Member PERSIS PERS</title>
    <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#064e3b',
                            950: '#032c21',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .brand-dark { background-color: #032c21; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) both; }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex">

    <!-- ==================== SIDEBAR ==================== -->
    <aside class="w-64 brand-dark text-white shrink-0 hidden lg:flex flex-col justify-between border-r border-emerald-900/60 select-none">
        
        <div class="p-5 space-y-6">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PERSIS PERS" class="h-12 w-auto object-contain" />
            </a>

            <!-- User Brief -->
            <div class="p-3 bg-white/5 border border-white/10 rounded-sm flex items-center gap-3">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-sm object-cover border border-emerald-400/40" />
                @else
                    <div class="w-10 h-10 rounded-sm bg-emerald-600 text-white font-extrabold flex items-center justify-center text-sm shadow-xs">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <h4 class="text-xs font-bold text-white truncate">{{ $user->name }}</h4>
                    <p class="text-[10px] text-emerald-300/80 truncate">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <a href="{{ route('member.dashboard') }}" 
                    class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-xs font-semibold text-emerald-100 hover:bg-emerald-800 hover:text-white transition">
                    <i class="fa-solid fa-gauge-high text-xs w-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('member.orders') }}" 
                    class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-xs font-bold transition bg-emerald-700 text-white shadow-2xs">
                    <i class="fa-solid fa-receipt text-xs w-4"></i>
                    <span>Pesanan Saya</span>
                    @if(isset($countAll) && $countAll > 0)
                        <span class="ml-auto px-1.5 py-0.2 bg-emerald-500 text-[#032c21] text-[9.5px] font-black rounded-xs">{{ $countAll }}</span>
                    @endif
                </a>

                <a href="{{ route('katalog') }}" 
                    class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-xs font-semibold text-emerald-100 hover:bg-emerald-800 hover:text-white transition">
                    <i class="fa-solid fa-book-open text-xs w-4"></i>
                    <span>Katalog Buku</span>
                </a>

                <a href="{{ route('member.profile') }}" 
                    class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-xs font-semibold text-emerald-100 hover:bg-emerald-800 hover:text-white transition">
                    <i class="fa-solid fa-user-gear text-xs w-4"></i>
                    <span>Profil Saya</span>
                </a>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PERSIS PERS, saya member ' . $user->name . ' ingin berkonsultasi mengenai pesanan buku.') }}" 
                    target="_blank"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-sm text-xs font-semibold text-emerald-100 hover:bg-emerald-800 hover:text-white transition">
                    <i class="fa-brands fa-whatsapp text-xs w-4"></i>
                    <span>Hubungi Redaksi</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-white/10 space-y-2">
            <a href="{{ url('/') }}" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-sm text-xs font-medium text-emerald-200 hover:bg-white/10 transition">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                <span>Halaman Utama</span>
            </a>

            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-sm text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition border border-red-500/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">

        <!-- Top Header Bar -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-3 lg:hidden">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PERSIS PERS" class="h-11 w-auto object-contain" />
                </a>
            </div>

            <!-- Breadcrumb -->
            <div class="hidden lg:flex items-center gap-2 text-xs">
                <a href="{{ route('member.dashboard') }}" class="text-slate-500 hover:text-emerald-700 transition">Portal Member</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="font-bold text-slate-800">Pesanan & Transaksi Buku</span>
            </div>

            <div class="flex items-center gap-2.5 sm:gap-3.5">
                <a href="{{ route('katalog') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition shadow-2xs">
                    <i class="fa-solid fa-book-open text-[10px]"></i>
                    <span>Buka Katalog</span>
                </a>

                <a href="{{ route('member.profile') }}" 
                    class="flex items-center gap-2 pl-1.5 pr-2.5 py-1 rounded-sm bg-slate-100 hover:bg-slate-200/80 border border-slate-200 transition">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-6 h-6 rounded-sm object-cover" />
                    @else
                        <div class="w-6 h-6 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-[10px] font-black">
                            {{ $user->initials }}
                        </div>
                    @endif
                    <span class="text-xs font-bold text-slate-700 max-w-[100px] truncate hidden sm:inline">{{ explode(' ', $user->name)[0] }}</span>
                </a>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in max-w-6xl w-full mx-auto space-y-5">

            <!-- Success Alert Notification -->
            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm flex items-center gap-2.5 text-xs sm:text-sm text-emerald-900 font-semibold shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Title & Filter Tabs -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200 pb-3">
                <div>
                    <h1 class="text-lg sm:text-xl font-black text-slate-900 font-heading tracking-tight flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-emerald-700 text-base"></i>
                        <span>Riwayat Pesanan & Transaksi Buku</span>
                    </h1>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau status pembayaran QRIS, nomor resi pengiriman, dan konfirmasi penerimaan buku.</p>
                </div>
            </div>

            <!-- Status Tabs -->
            <div class="flex items-center gap-1.5 overflow-x-auto pb-1 text-xs select-none">
                <a href="{{ route('member.orders') }}" 
                    class="px-3 py-1.5 rounded-sm font-semibold transition whitespace-nowrap {{ !$statusFilter ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Semua ({{ $countAll }})
                </a>
                <a href="{{ route('member.orders', ['status' => 'diproses']) }}" 
                    class="px-3 py-1.5 rounded-sm font-semibold transition whitespace-nowrap {{ $statusFilter === 'diproses' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Sedang Dipacking ({{ $countProcessing }})
                </a>
                <a href="{{ route('member.orders', ['status' => 'dikirim']) }}" 
                    class="px-3 py-1.5 rounded-sm font-semibold transition whitespace-nowrap {{ $statusFilter === 'dikirim' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Dalam Pengiriman ({{ $countShipping }})
                </a>
                <a href="{{ route('member.orders', ['status' => 'selesai']) }}" 
                    class="px-3 py-1.5 rounded-sm font-semibold transition whitespace-nowrap {{ $statusFilter === 'selesai' ? 'bg-[#006830] text-white shadow-2xs font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Selesai / Diterima ({{ $countCompleted }})
                </a>
                <a href="{{ route('member.orders', ['status' => 'pending']) }}" 
                    class="px-3 py-1.5 rounded-sm font-semibold transition whitespace-nowrap {{ $statusFilter === 'pending' ? 'bg-amber-600 text-white shadow-2xs font-bold' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                    Menunggu Bayar ({{ $countPending }})
                </a>
            </div>

            <!-- Orders List -->
            @if($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders as $ord)
                        <div class="bg-white rounded-sm border border-slate-200 shadow-2xs overflow-hidden transition hover:border-slate-300">
                            
                            <!-- Order Card Header -->
                            <div class="p-3.5 sm:p-4 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs">
                                <div class="flex items-center gap-3">
                                    <span class="font-mono font-bold text-slate-900">
                                        #{{ $ord->order_number }}
                                    </span>
                                    <span class="text-slate-400">•</span>
                                    <span class="text-slate-500">{{ $ord->created_at->format('d M Y, H:i') }} WIB</span>
                                    <span class="text-slate-400">•</span>
                                    <span class="font-mono uppercase text-slate-600 font-semibold">{{ $ord->payment_method }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if($ord->payment_status === 'completed')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded-xs text-[10.5px] font-bold uppercase border border-emerald-300">
                                            <i class="fa-solid fa-check text-[9px]"></i> Lunas
                                        </span>
                                    @elseif($ord->payment_status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-amber-100 text-amber-900 rounded-xs text-[10.5px] font-bold uppercase border border-amber-300">
                                            <i class="fa-solid fa-clock text-[9px]"></i> Menunggu Bayar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-100 text-red-800 rounded-xs text-[10.5px] font-bold uppercase">
                                            {{ strtoupper($ord->payment_status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Card Body: Items List & Shipping Status -->
                            <div class="p-4 sm:p-5 grid grid-cols-1 lg:grid-cols-12 gap-5 items-center">
                                
                                <!-- Left: Book Items (7 cols) -->
                                <div class="lg:col-span-7 space-y-2.5 text-xs">
                                    @if(!empty($ord->items_json))
                                        @foreach($ord->items_json as $it)
                                            <div class="flex items-start justify-between gap-3 py-1 border-b border-slate-100 last:border-none">
                                                <div>
                                                    <h4 class="font-bold text-slate-900 leading-snug">{{ $it['title'] ?? 'Buku' }}</h4>
                                                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $it['category'] ?? 'Penerbitan' }} • {{ $it['author'] ?? '-' }}</p>
                                                </div>
                                                <div class="text-right whitespace-nowrap">
                                                    <span class="font-bold font-mono text-slate-900">{{ $it['formatted_subtotal'] ?? 'Rp 0' }}</span>
                                                    <span class="text-[10px] text-slate-400 block">{{ $it['quantity'] ?? 1 }}x @ {{ $it['formatted_price'] ?? 'Rp 0' }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Right: Shipping Lifecycle & Status (5 cols) -->
                                <div class="lg:col-span-5 bg-slate-50/70 p-3.5 rounded-sm border border-slate-200 text-xs space-y-2.5">
                                    <div class="flex justify-between items-center text-slate-600">
                                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Pengiriman:</span>
                                        @if($ord->shipping_status === 'selesai')
                                            <span class="px-2 py-0.5 rounded-xs text-[10.5px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 uppercase">
                                                <i class="fa-solid fa-circle-check text-[9px]"></i> Diterima / Selesai
                                            </span>
                                        @elseif($ord->shipping_status === 'dikirim')
                                            <span class="px-2 py-0.5 rounded-xs text-[10.5px] font-bold bg-blue-100 text-blue-800 border border-blue-300 uppercase">
                                                <i class="fa-solid fa-truck text-[9px]"></i> Sedang Dikirim
                                            </span>
                                        @elseif($ord->shipping_status === 'diproses')
                                            <span class="px-2 py-0.5 rounded-xs text-[10.5px] font-bold bg-amber-100 text-amber-900 border border-amber-300 uppercase">
                                                <i class="fa-solid fa-box-archive text-[9px]"></i> Sedang Dikemas
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-xs text-[10.5px] font-bold bg-slate-200 text-slate-700 uppercase">
                                                <i class="fa-solid fa-hourglass-start text-[9px]"></i> Menunggu Antrean
                                            </span>
                                        @endif
                                    </div>

                                    @if($ord->tracking_number)
                                        <div class="pt-1.5 border-t border-slate-200/80 flex justify-between items-center">
                                            <span class="text-slate-500">Nomor Resi:</span>
                                            <span class="font-bold text-emerald-800 font-mono text-[11px] bg-white px-2 py-0.5 border border-slate-200 rounded-xs">
                                                {{ $ord->tracking_number }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="pt-1.5 border-t border-slate-200/80 flex justify-between items-center">
                                        <span class="text-slate-500 font-semibold">Total Pembayaran:</span>
                                        <span class="font-bold font-mono text-sm text-slate-900">{{ $ord->formatted_payment }}</span>
                                    </div>
                                </div>

                            </div>

                            <!-- Order Card Actions Footer -->
                            <div class="p-3.5 bg-slate-50/50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                                <div class="text-[11px] text-slate-500 text-center sm:text-left">
                                    Tujuan: <strong class="text-slate-700">{{ $ord->customer_name }}</strong> ({{ $ord->customer_phone }})
                                </div>

                                <div class="flex items-center gap-2">
                                    <!-- Tombol Konfirmasi Diterima (Khusus jika status dikirim) -->
                                    @if($ord->shipping_status === 'dikirim')
                                        <form method="POST" action="{{ route('member.orders.confirm_received', $ord->order_number) }}" onsubmit="return confirm('Apakah Anda yakin paket buku telah sampai dan diterima dengan baik?')">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                                                <i class="fa-solid fa-circle-check text-lime-300"></i>
                                                <span>Konfirmasi Diterima</span>
                                            </button>
                                        </form>
                                    @elseif($ord->shipping_status === 'selesai')
                                        <span class="text-[11px] text-emerald-700 font-bold flex items-center gap-1">
                                            <i class="fa-solid fa-circle-check"></i> Paket Selesai Diterima
                                        </span>
                                    @endif

                                    <!-- Tombol Lihat Invoice -->
                                    <a href="{{ route('order.invoice', $ord->order_number) }}" target="_blank" class="px-3 py-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-medium transition flex items-center gap-1.5 shadow-2xs">
                                        <i class="fa-solid fa-file-invoice text-slate-400"></i>
                                        <span>Lihat Invoice</span>
                                    </a>

                                    <!-- Tombol WhatsApp Redaksi -->
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin menanyakan pesanan #' . $ord->order_number . ' (' . $ord->customer_name . ').') }}" target="_blank" class="px-3 py-1.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-sm text-xs font-medium transition flex items-center gap-1">
                                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                        <span class="hidden sm:inline">Hubungi Redaksi</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="pt-3">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="p-10 text-center bg-white rounded-sm border border-slate-200 space-y-3">
                    <div class="w-14 h-14 rounded-sm bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Tidak Ada Pesanan Ditemukan</h3>
                        <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">
                            @if($statusFilter)
                                Tidak ada transaksi buku dengan filter status yang Anda pilih.
                            @else
                                Anda belum memiliki riwayat pembelian buku di PERSIS PERS.
                            @endif
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-2xs">
                            <i class="fa-solid fa-book-open text-xs"></i>
                            <span>Jelajahi Katalog Buku</span>
                        </a>
                    </div>
                </div>
            @endif

        </main>
    </div>

</body>
</html>
