@extends('layouts.app')

@section('title', 'Ketentuan & Pendaftaran Reseller - PENERBIT PERSIS')
@section('meta_description', 'Penerbit Persis membuka kesempatan kemitraan Reseller & Agen buku resmi untuk individu, toko buku, pesantren, dan lembaga di seluruh Indonesia.')

@section('content')
<div class="bg-slate-50 min-h-screen">

    <!-- 1. HERO BANNER -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900 animate-fade-in">
        <!-- Accent Glow Background -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-xs text-xs font-bold uppercase tracking-wider bg-emerald-900/60 text-emerald-400 border border-emerald-500/30 mb-4 shadow-2xs">
                    <i class="fa-solid fa-handshake text-emerald-400 text-xs"></i> Program Kemitraan &amp; Distribusi Resmi
                </span>
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-white tracking-tight leading-tight">
                    Ketentuan &amp; Pendaftaran Reseller Penerbit Persis
                </h1>
                <p class="text-xs sm:text-sm md:text-base text-slate-300 mt-4 leading-relaxed">
                    Penerbit Persis membuka kesempatan bagi individu, toko buku, lembaga pendidikan, komunitas, pesantren, organisasi, dan pihak lainnya untuk menjadi <strong>Reseller Resmi</strong> guna memperluas distribusi buku-buku ber-ISBN berkualitas ke seluruh penjuru Nusantara.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="#pendaftaran" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs sm:text-sm font-bold rounded-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fa-solid fa-user-plus text-xs"></i> Daftar Menjadi Reseller
                    </a>
                    <a href="#ketentuan" class="px-6 py-3 bg-brand-900/80 hover:bg-brand-900 text-slate-200 hover:text-white text-xs sm:text-sm font-bold rounded-sm border border-emerald-500/20 transition-all flex items-center gap-2">
                        <i class="fa-solid fa-file-lines text-xs"></i> Baca 12 Ketentuan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. QUICK VALUE PROPOSITIONS (4 STAT/BENEFIT CARDS) -->
    <section class="py-10 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <div class="p-5 rounded-sm bg-slate-50 border border-slate-200/80 hover:border-emerald-500/40 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-base mb-3 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Harga &amp; Diskon Khusus</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Margin keuntungan reseller yang kompetitif dengan skema diskon bertingkat.</p>
                </div>

                <div class="p-5 rounded-sm bg-slate-50 border border-slate-200/80 hover:border-emerald-500/40 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-sm bg-blue-100 text-blue-800 flex items-center justify-center text-base mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Koleksi Lengkap &amp; Beragam</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Ratusan judul buku keislaman, pendidikan, akademik, anak, dan buku umum.</p>
                </div>

                <div class="p-5 rounded-sm bg-slate-50 border border-slate-200/80 hover:border-emerald-500/40 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-sm bg-amber-100 text-amber-800 flex items-center justify-center text-base mb-3 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Materi Promosi Siap Pakai</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Disediakan aset foto produk beresolusi tinggi, mockup, dan deskripsi penjualan.</p>
                </div>

                <div class="p-5 rounded-sm bg-slate-50 border border-slate-200/80 hover:border-emerald-500/40 hover:bg-emerald-50/20 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-sm bg-purple-100 text-purple-800 flex items-center justify-center text-base mb-3 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1">Distribusi &amp; Logistik Rapi</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">Pengemasan aman dan pengiriman terpercaya ke seluruh wilayah Indonesia.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. 12 KETENTUAN RESELLER RESMI (STRUCTURED POLICY CARDS) -->
    <section id="ketentuan" class="py-14 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1.5">Kebijakan &amp; Pedoman Kemitraan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">12 Ketentuan Reseller Penerbit Persis</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                    Harap membaca dan memahami ketentuan kemitraan berikut ini sebelum mengajukan pendaftaran sebagai reseller resmi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- 1. Persyaratan Reseller -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">01</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Persyaratan Reseller</h3>
                            </div>
                            <i class="fa-solid fa-clipboard-check text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mb-2.5">Calon reseller wajib memenuhi ketentuan berikut:</p>
                        <ul class="space-y-2 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Mengisi formulir pendaftaran reseller resmi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Memiliki identitas yang jelas dan nomor WhatsApp yang dapat dihubungi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Mencantumkan nama, nomor WA, alamat lengkap, dan data usaha/toko apabila ada.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Menyetujui seluruh ketentuan dan kebijakan reseller Penerbit Persis.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Menjaga nama baik dan citra Penerbit Persis dalam promosi dan penjualan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 2. Produk yang Dijual -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">02</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Produk yang Dijual</h3>
                            </div>
                            <i class="fa-solid fa-book-bookmark text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mb-2.5">Reseller dapat memasarkan buku terbitan resmi yang meliputi:</p>
                        <ul class="space-y-2 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-dot text-emerald-600 text-[8px] mt-1.5 shrink-0"></i>
                                <span><strong>Buku Keislaman:</strong> Fiqih, Aqidah, Hadis, Tarikh, dan Studi Islam.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-dot text-emerald-600 text-[8px] mt-1.5 shrink-0"></i>
                                <span><strong>Buku Pendidikan &amp; Ajar:</strong> Modul kuliah, teks sekolah, &amp; pesantren.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-dot text-emerald-600 text-[8px] mt-1.5 shrink-0"></i>
                                <span><strong>Buku Akademik &amp; Riset:</strong> Monograf, referensi, &amp; prosiding ilmiah.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-dot text-emerald-600 text-[8px] mt-1.5 shrink-0"></i>
                                <span><strong>Buku Anak &amp; Umum:</strong> Cerita islami, parenting, &amp; literatur umum.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 3. Harga Reseller -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">03</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Harga Reseller</h3>
                            </div>
                            <i class="fa-solid fa-percent text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2.5">
                            Penerbit Persis memberikan harga khusus reseller sesuai dengan ketentuan dan level reseller yang berlaku.
                        </p>
                        <p class="text-xs text-slate-500 font-medium mb-1.5">Harga reseller dapat berbeda berdasarkan:</p>
                        <ul class="space-y-1.5 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-angle-right text-emerald-600 text-[9px]"></i> Jenis &amp; kategori buku</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-angle-right text-emerald-600 text-[9px]"></i> Jumlah &amp; volume pembelian</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-angle-right text-emerald-600 text-[9px]"></i> Program promo aktif atau status reseller</li>
                        </ul>
                    </div>
                </div>

                <!-- 4. Minimum Pembelian -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">04</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Minimum Pembelian</h3>
                            </div>
                            <i class="fa-solid fa-boxes-stacked text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2.5">
                            Ketentuan minimum pembelian reseller ditetapkan oleh Penerbit Persis dan dapat berbeda berdasarkan jenis produk atau program kemitraan.
                        </p>
                        <div class="p-3 bg-slate-50 rounded-xs border border-slate-200/80 text-[11px] text-slate-600 leading-relaxed">
                            <i class="fa-solid fa-circle-info text-emerald-700 mr-1"></i> Untuk mendapatkan penawaran harga reseller terbaik, reseller disarankan melakukan pemesanan dalam jumlah tertentu sesuai paket yang berlaku.
                        </div>
                    </div>
                </div>

                <!-- 5. Pemesanan Buku -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">05</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Pemesanan Buku</h3>
                            </div>
                            <i class="fa-solid fa-cart-shopping text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2">
                            Pemesanan dilakukan melalui saluran resmi Penerbit Persis dengan menyertakan data:
                        </p>
                        <div class="grid grid-cols-2 gap-1.5 text-xs text-slate-700 font-medium">
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> Nama Reseller</span>
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> Nomor WhatsApp</span>
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> Alamat Lengkap</span>
                            <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-600 text-[9px]"></i> Judul &amp; Jumlah</span>
                        </div>
                    </div>
                </div>

                <!-- 6. Pembayaran -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">06</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Pembayaran Resmi</h3>
                            </div>
                            <i class="fa-solid fa-credit-card text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2.5">
                            Pembayaran dilakukan melalui rekening atau metode pembayaran resmi yang ditentukan oleh Penerbit Persis.
                        </p>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Reseller wajib menyimpan bukti transaksi dan mengirimkan konfirmasi pembayaran kepada admin untuk validasi pengiriman.
                        </p>
                    </div>
                </div>

                <!-- 7. Pengiriman -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">07</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Pengiriman &amp; Ekspedisi</h3>
                            </div>
                            <i class="fa-solid fa-truck-fast text-slate-400 text-sm"></i>
                        </div>
                        <ul class="space-y-2 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-arrow-right text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Biaya kirim menjadi tanggung jawab reseller (kecuali program promo khusus).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-arrow-right text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Pengemasan dilakukan rapi dan presisi dari kantor pusat Bandung.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-arrow-right text-emerald-600 text-[10px] mt-1 shrink-0"></i>
                                <span>Klaim asuransi / kendala kurir mengikuti prosedur ekspedisi yang digunakan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 8. Promosi dan Penggunaan Materi -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">08</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Promosi &amp; Materi</h3>
                            </div>
                            <i class="fa-solid fa-share-nodes text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2">
                            Promosi dapat dilakukan di WhatsApp, Instagram, Facebook, TikTok, Marketplace, Website, maupun Toko Buku fisik.
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Reseller dapat menggunakan foto dan deskripsi resmi. Dilarang mengubah info produk secara menyesatkan.
                        </p>
                    </div>
                </div>

                <!-- 9. Larangan Reseller -->
                <div class="bg-white rounded-sm border border-rose-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-rose-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-rose-50 text-rose-800 font-black text-xs flex items-center justify-center border border-rose-200">09</span>
                                <h3 class="text-sm font-extrabold text-rose-900">Larangan Reseller</h3>
                            </div>
                            <i class="fa-solid fa-shield-halved text-rose-500 text-sm"></i>
                        </div>
                        <ul class="space-y-1.5 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-start gap-2 text-rose-900">
                                <i class="fa-solid fa-ban text-rose-500 text-[10px] mt-1 shrink-0"></i>
                                <span>Dilarang membajak / memalsukan produk Penerbit Persis.</span>
                            </li>
                            <li class="flex items-start gap-2 text-rose-900">
                                <i class="fa-solid fa-ban text-rose-500 text-[10px] mt-1 shrink-0"></i>
                                <span>Dilarang menghilangkan identitas/logo penerbit.</span>
                            </li>
                            <li class="flex items-start gap-2 text-rose-900">
                                <i class="fa-solid fa-ban text-rose-500 text-[10px] mt-1 shrink-0"></i>
                                <span>Dilarang mencemarkan nama baik atau melanggar hukum.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 10. Keuntungan Menjadi Reseller -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">10</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Keuntungan Kemitraan</h3>
                            </div>
                            <i class="fa-solid fa-trophy text-amber-500 text-sm"></i>
                        </div>
                        <ul class="space-y-1.5 text-xs text-slate-700 leading-relaxed">
                            <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> Mendapatkan harga khusus reseller.</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> Materi promosi foto &amp; deskripsi produk.</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> Info rilisan buku terbaru lebih awal.</li>
                            <li class="flex items-center gap-2"><i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i> Memperluas bisnis penjualan buku.</li>
                        </ul>
                    </div>
                </div>

                <!-- 11. Status Reseller -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">11</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Status &amp; Evaluasi</h3>
                            </div>
                            <i class="fa-solid fa-user-check text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2">
                            Penerbit Persis berhak melakukan evaluasi keaktifan kemitraan.
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Status reseller dapat ditinjau atau dihentikan jika tidak aktif dalam jangka waktu lama atau melakukan pelanggaran ketentuan.
                        </p>
                    </div>
                </div>

                <!-- 12. Perubahan Ketentuan -->
                <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-6 hover:shadow-md transition-shadow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-3 mb-4 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-800 font-black text-xs flex items-center justify-center border border-emerald-200">12</span>
                                <h3 class="text-sm font-extrabold text-slate-900">Perubahan Ketentuan</h3>
                            </div>
                            <i class="fa-solid fa-rotate text-slate-400 text-sm"></i>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed mb-2">
                            Penerbit Persis berhak melakukan perubahan terhadap harga, diskon, sistem pemesanan, maupun ketentuan kemitraan lainnya.
                        </p>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Setiap pembaruan akan diinformasikan resmi melalui saluran komunikasi Penerbit Persis.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. SECTION PENDAFTARAN RESELLER (REGISTRATION FORM & WHATSAPP GENERATOR) -->
    <section id="pendaftaran" class="py-14 sm:py-20 bg-white border-t border-slate-200/80">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1.5">Gabung Jaringan Kemitraan</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">Formulir Pendaftaran Reseller</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                    Bagi Anda yang ingin menjadi bagian dari jaringan distribusi Penerbit Persis, silakan lengkapi formulir di bawah ini. Kami siap membantu proses pendaftaran Anda.
                </p>
            </div>

            <!-- Flash Message & WA Launcher -->
            @if(session('success'))
                <div class="mb-8 p-5 rounded-sm bg-emerald-50 border border-emerald-300 text-emerald-950 shadow-sm animate-fade-in">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-xl mt-0.5 shrink-0"></i>
                        <div class="space-y-2 flex-1">
                            <h4 class="text-sm font-extrabold text-emerald-900">Pendaftaran Berhasil Dikirim!</h4>
                            <p class="text-xs text-emerald-800 leading-relaxed">{{ session('success') }}</p>
                            @if(session('wa_url'))
                                <div class="pt-2">
                                    <a href="{{ session('wa_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm text-xs font-bold shadow-xs hover:shadow-md transition">
                                        <i class="fa-brands fa-whatsapp text-sm"></i> Buka Chat WhatsApp Redaksi Sekarang &rarr;
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-8 p-4 rounded-sm bg-rose-50 border border-rose-200 text-rose-900 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation text-rose-500"></i> {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Registration Card -->
            <div class="bg-slate-50 rounded-sm border border-slate-200/90 p-6 sm:p-10 shadow-sm">
                <form method="POST" action="{{ route('reseller.store') }}" class="space-y-5" id="resellerForm">
                    @csrf
                    
                    <!-- Anti-Spam Honeypot Field -->
                    <input type="text" name="website_hp_check" value="" class="hidden" style="display:none;" tabindex="-1" autocomplete="off" />

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap Pemohon <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="name"
                                id="reseller_name" 
                                value="{{ old('name') }}"
                                required 
                                placeholder="Contoh: Ahmad Fauzan" 
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor WhatsApp Aktif <span class="text-rose-500">*</span></label>
                            <input 
                                type="tel" 
                                name="phone"
                                id="reseller_wa" 
                                value="{{ old('phone') }}"
                                required 
                                placeholder="Contoh: 081234567890" 
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input 
                                type="email" 
                                name="email"
                                id="reseller_email" 
                                value="{{ old('email') }}"
                                placeholder="Contoh: pemohon@gmail.com" 
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Usaha / Toko / Lembaga <span class="text-slate-400 font-normal">(Opsional)</span></label>
                            <input 
                                type="text" 
                                name="business_name"
                                id="reseller_business" 
                                value="{{ old('business_name') }}"
                                placeholder="Contoh: Toko Buku Barokah / Pesantren Al-Hidayah" 
                                class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Reseller <span class="text-rose-500">*</span></label>
                        <select 
                            name="category"
                            id="reseller_category" 
                            required 
                            class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        >
                            <option value="Individu / Perorangan" {{ old('category') == 'Individu / Perorangan' ? 'selected' : '' }}>Individu / Perorangan</option>
                            <option value="Toko Buku Fisik / Online" {{ old('category') == 'Toko Buku Fisik / Online' ? 'selected' : '' }}>Toko Buku Fisik / Online</option>
                            <option value="Pesantren / Sekolah / Madrasah" {{ old('category') == 'Pesantren / Sekolah / Madrasah' ? 'selected' : '' }}>Pesantren / Sekolah / Madrasah</option>
                            <option value="Komunitas / Organisasi / Majelis" {{ old('category') == 'Komunitas / Organisasi / Majelis' ? 'selected' : '' }}>Komunitas / Organisasi / Majelis</option>
                            <option value="Dosen / Guru / Mahasiswa" {{ old('category') == 'Dosen / Guru / Mahasiswa' ? 'selected' : '' }}>Dosen / Guru / Mahasiswa</option>
                            <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Lengkap &amp; Kota / Kabupaten <span class="text-rose-500">*</span></label>
                        <textarea 
                            name="address"
                            id="reseller_address" 
                            rows="3" 
                            required 
                            placeholder="Sebutkan alamat lengkap pengiriman untuk estimasi ongkos kirim..." 
                            class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        >{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Catatan Tambahan / Minat Buku Tertentu <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input 
                            type="text" 
                            name="notes"
                            id="reseller_notes" 
                            value="{{ old('notes') }}"
                            placeholder="Contoh: Tertarik memesan buku paket fiqih dan modul ajar..." 
                            class="w-full px-3.5 py-2.5 text-sm rounded-sm bg-white border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition"
                        />
                    </div>

                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-xs text-slate-500 flex items-center gap-1.5">
                            <i class="fa-solid fa-lock text-emerald-600 text-xs"></i> Data tersimpan ke admin &amp; notifikasi otomatis dikirim ke email Redaksi.
                        </span>
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-8 py-3.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-sm text-xs sm:text-sm transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer uppercase tracking-wider"
                        >
                            <i class="fa-solid fa-paper-plane text-xs"></i> DAFTAR MENJADI RESELLER
                        </button>
                    </div>

                </form>
            </div>

            <!-- Direct Contact Helper Box -->
            <div class="mt-8 p-5 rounded-sm bg-emerald-50 border border-emerald-200 text-center flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
                <div class="text-left">
                    <p class="font-bold text-emerald-900">Ingin berkonsultasi langsung mengenai paket reseller?</p>
                    <p class="text-emerald-700 mt-0.5">Hubungi Tim Layanan Redaksi &amp; Distribusi Penerbit Persis melalui WhatsApp.</p>
                </div>
                <a 
                    href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin bertanya mengenai program kemitraan Reseller.') }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-sm shrink-0 transition flex items-center gap-2 shadow-2xs"
                >
                    <i class="fa-brands fa-whatsapp text-sm"></i> Chat Langsung
                </a>
            </div>

        </div>
    </section>

</div>

@if(session('wa_url'))
<script>
    // Auto-open WhatsApp in new tab if user just submitted
    window.addEventListener('load', function() {
        setTimeout(function() {
            window.open("{{ session('wa_url') }}", "_blank");
        }, 600);
    });
</script>
@endif
@endsection
