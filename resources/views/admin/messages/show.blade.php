@extends('admin.layouts.app')

@section('title', 'Detail Pesan Masuk | Admin PERSIS PERS')
@section('header_title', 'Detail Pesan & Pengajuan Naskah')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-800 flex items-center gap-1.5 transition">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Kembali ke Daftar Pesan</span>
        </a>

        <div class="flex items-center gap-2">
            @if($message->phone)
                <a href="{{ $message->wa_link }}" target="_blank" class="px-3.5 py-1.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>Chat WhatsApp</span>
                </a>
            @endif
            <a href="#replyFormCard" class="px-3.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-reply text-xs"></i>
                <span>Balas via Email</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-2xs animate-fade-in">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-3.5 rounded-sm bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2 shadow-2xs animate-fade-in">
            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-sm"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
        
        <!-- Left: Main Message Detail & Reply Box (8 cols) -->
        <div class="lg:col-span-8 space-y-5">
            
            <!-- Message Detail Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-5">
                <div class="border-b border-slate-100 pb-4">
                    <div class="flex items-center justify-between gap-2 flex-wrap mb-2">
                        <span class="inline-block text-[10.5px] font-bold px-2.5 py-0.5 rounded-xs bg-emerald-50 text-emerald-800 border border-emerald-200">
                            {{ $message->service_category ?? 'Konsultasi Umum' }}
                        </span>
                        <span class="text-xs text-slate-400">
                            Diterima: {{ $message->created_at->format('d F Y, H:i') }} WIB ({{ $message->created_at->diffForHumans() }})
                        </span>
                    </div>
                    <h2 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading">{{ $message->subject ?: 'Pengajuan Naskah / Konsultasi' }}</h2>
                </div>

                <!-- Content Body -->
                <div>
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider block mb-2 font-heading">Isi Pesan / Keterangan Naskah:</span>
                    <div class="p-4 rounded-sm bg-slate-50 border border-slate-200 text-slate-800 text-xs sm:text-sm leading-relaxed whitespace-pre-line font-sans">
{{ $message->message }}
                    </div>
                </div>

                <!-- Sender Info Card -->
                <div class="border-t border-slate-100 pt-4">
                    <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider block mb-2.5 font-heading">Informasi Lengkap Pengirim:</span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Nama Pengirim</span>
                            <span class="text-xs font-bold text-slate-900 block mt-0.5 truncate">{{ $message->name }}</span>
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">Alamat Email</span>
                            <a href="mailto:{{ $message->email }}" class="text-xs font-bold text-slate-900 hover:text-emerald-700 block mt-0.5 truncate transition">{{ $message->email }}</a>
                        </div>
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <span class="text-[10px] font-bold text-slate-400 block uppercase tracking-wider">No. WhatsApp</span>
                            @if($message->phone)
                                <a href="{{ $message->wa_link }}" target="_blank" class="text-xs font-bold text-emerald-700 block mt-0.5 flex items-center gap-1">
                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i> {{ $message->phone }}
                                </a>
                            @else
                                <span class="text-xs text-slate-400 block mt-0.5">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Direct Email Reply Form Card -->
            <div id="replyFormCard" class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-4">
                <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center text-[#006830]">
                            <i class="fa-solid fa-reply text-xs"></i>
                        </div>
                        <div>
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 font-heading">Balas Pesan via Email Resmi</h3>
                            <p class="text-[11px] text-slate-500">Terkirim langsung ke email <strong class="text-emerald-800">{{ $message->email }}</strong></p>
                        </div>
                    </div>
                    <span class="text-[10px] px-2 py-0.5 bg-slate-100 text-slate-600 font-bold uppercase rounded-xs">SMTP Resmi</span>
                </div>

                <form method="POST" action="{{ route('admin.messages.reply', $message) }}" class="space-y-3.5">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Subjek Email Balasan <span class="text-rose-500">*</span></label>
                        <input 
                            type="text" 
                            name="subject" 
                            value="{{ old('subject', 'Re: ' . ($message->subject ?: 'Tanggapan Redaksi PERSIS PERS - ' . $message->service_category)) }}" 
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-sm text-xs text-slate-900 focus:bg-white focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700 outline-none transition font-medium"
                            required
                        />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-xs font-bold text-slate-700">Isi Pesan Balasan <span class="text-rose-500">*</span></label>
                            <span class="text-[10.5px] text-slate-400 font-mono">Format Teks Rapi</span>
                        </div>
                        <textarea 
                            name="reply_message" 
                            rows="7" 
                            class="w-full p-3 bg-slate-50 border border-slate-300 rounded-sm text-xs sm:text-sm text-slate-900 focus:bg-white focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700 outline-none transition font-sans leading-relaxed"
                            placeholder="Tuliskan pesan tanggapan atau instruksi penerbitan naskah..."
                            required
                        >{{ old('reply_message', "Halo " . $message->name . ",\n\nTerima kasih telah menghubungi Redaksi PERSIS PERS mengenai " . ($message->service_category ?? 'penerbitan naskah') . ".\n\nKami telah menerima permohonan Anda dan dengan senang hati siap membantu proses selanjutnya.\n\n[Tuliskan keterangan detail / lampiran panduan naskah di sini]\n\nSalam hangat,\nTim Redaksi PERSIS PERS\nPERSIS PERS") }}</textarea>
                    </div>

                    <div class="pt-1 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <p class="text-[11px] text-slate-500 flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-info text-emerald-600"></i>
                            <span>Status pesan akan otomatis diubah menjadi <strong>Sudah Dihubungi</strong>.</span>
                        </p>
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold shadow-xs hover:shadow-md transition flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <i class="fa-solid fa-paper-plane text-xs text-lime-300"></i>
                            <span>Kirim Balasan Email Sekarang</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Right: Status Update & Notes (4 cols) -->
        <div class="lg:col-span-4 bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 space-y-4">
            <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider font-heading pb-3 border-b border-slate-100">
                Status &amp; Catatan Redaksi
            </h3>

            <form method="POST" action="{{ route('admin.messages.update', $message) }}" class="space-y-3.5">
                @csrf
                @method('PUT')

                <!-- Custom Dropdown for Message Status -->
                <div class="relative" id="customMsgStatusContainer">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Status Pemrosesan</label>
                    <input type="hidden" name="status" id="msgStatusValue" value="{{ $message->status }}" />

                    <!-- Trigger Button -->
                    <button 
                        type="button" 
                        onclick="toggleMsgDropdown()"
                        id="msgStatusTrigger"
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-sm text-slate-800 text-xs font-semibold flex items-center justify-between shadow-2xs hover:border-emerald-600 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition cursor-pointer"
                    >
                        <div class="flex items-center gap-2" id="msgSelectedDisplay">
                            @if($message->status === 'completed')
                                <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                                <span class="text-slate-900 font-bold">Selesai Diproses</span>
                            @elseif($message->status === 'contacted')
                                <i class="fa-solid fa-comments text-blue-600 text-sm"></i>
                                <span class="text-slate-900 font-bold">Sudah Dihubungi</span>
                            @else
                                <i class="fa-solid fa-clock text-amber-600 text-sm"></i>
                                <span class="text-slate-900 font-bold">Belum Dihubungi</span>
                            @endif
                        </div>
                        <i id="msgDropdownChevron" class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200"></i>
                    </button>

                    <!-- Dropdown Options Menu -->
                    <div 
                        id="msgStatusMenu" 
                        class="hidden absolute z-30 w-full mt-1 bg-white border border-slate-200 rounded-sm shadow-xl overflow-hidden py-1 divide-y divide-slate-100 animate-fade-in"
                    >
                        <button 
                            type="button" 
                            onclick="selectMsgStatus('pending', 'Belum Dihubungi', 'fa-solid fa-clock text-amber-600 text-sm')"
                            class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center gap-2 transition cursor-pointer"
                        >
                            <i class="fa-solid fa-clock text-amber-600 text-sm"></i>
                            <div>
                                <p class="font-bold text-slate-800">Belum Dihubungi</p>
                                <p class="text-[10px] text-slate-400">Pesan baru belum direspon</p>
                            </div>
                        </button>
                        <button 
                            type="button" 
                            onclick="selectMsgStatus('contacted', 'Sudah Dihubungi', 'fa-solid fa-comments text-blue-600 text-sm')"
                            class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center gap-2 transition cursor-pointer"
                        >
                            <i class="fa-solid fa-comments text-blue-600 text-sm"></i>
                            <div>
                                <p class="font-bold text-slate-800">Sudah Dihubungi</p>
                                <p class="text-[10px] text-slate-400">Sedang dalam proses komunikasi</p>
                            </div>
                        </button>
                        <button 
                            type="button" 
                            onclick="selectMsgStatus('completed', 'Selesai Diproses', 'fa-solid fa-circle-check text-emerald-600 text-sm')"
                            class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center gap-2 transition cursor-pointer"
                        >
                            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                            <div>
                                <p class="font-bold text-slate-800">Selesai Diproses</p>
                                <p class="text-[10px] text-slate-400">Naskah/pesan telah tuntas</p>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Notes / Riwayat Balasan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Riwayat &amp; Catatan Internal Redaksi</label>
                    <textarea 
                        name="notes" 
                        rows="6" 
                        class="w-full px-3 py-2 bg-slate-50 border border-slate-300 rounded-sm text-xs text-slate-900 focus:bg-white focus:border-emerald-700 outline-none transition font-sans leading-relaxed" 
                        placeholder="Tambahkan catatan khusus mengenai naskah, kesepakatan harga, atau jadwal penerbitan..."
                    >{{ old('notes', $message->notes) }}</textarea>
                </div>

                <div class="pt-1">
                    <button type="submit" class="w-full py-2 bg-slate-900 hover:bg-slate-950 text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs text-emerald-400"></i>
                        <span>Perbarui Catatan &amp; Status</span>
                    </button>
                </div>
            </form>

            <div class="border-t border-slate-100 pt-4 mt-4">
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2 border border-rose-200 text-rose-600 hover:bg-rose-50 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-trash text-xs"></i>
                        <span>Hapus Pesan Ini</span>
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
    function toggleMsgDropdown() {
        const menu = document.getElementById('msgStatusMenu');
        const chevron = document.getElementById('msgDropdownChevron');
        if (menu) {
            menu.classList.toggle('hidden');
            if (chevron) chevron.classList.toggle('rotate-180');
        }
    }

    function selectMsgStatus(value, label, iconClass) {
        document.getElementById('msgStatusValue').value = value;
        document.getElementById('msgSelectedDisplay').innerHTML = `
            <i class="${iconClass}"></i>
            <span class="text-slate-900 font-bold">${label}</span>
        `;
        toggleMsgDropdown();
    }

    document.addEventListener('click', function(e) {
        const container = document.getElementById('customMsgStatusContainer');
        const menu = document.getElementById('msgStatusMenu');
        const chevron = document.getElementById('msgDropdownChevron');
        if (container && menu && !container.contains(e.target)) {
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    });
</script>
@endpush
@endsection
