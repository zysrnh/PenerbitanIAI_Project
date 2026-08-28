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

        @if($message->phone)
            <a href="{{ $message->wa_link }}" target="_blank" class="px-3.5 py-1.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Balas Langsung via WhatsApp</span>
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-2xs animate-fade-in">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
        
        <!-- Left: Main Message Detail (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-sm border border-slate-200/90 shadow-2xs p-5 sm:p-6 space-y-5">
            <div class="border-b border-slate-100 pb-4">
                <span class="inline-block text-[10.5px] font-bold px-2.5 py-0.5 rounded-xs bg-emerald-50 text-emerald-800 border border-emerald-200 mb-2">
                    {{ $message->service_category ?? 'Konsultasi Umum' }}
                </span>
                <h2 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading">{{ $message->subject ?: 'Pengajuan Naskah / Konsultasi' }}</h2>
                <span class="text-xs text-slate-400 block mt-1">
                    Diterima pada {{ $message->created_at->format('d F Y, H:i') }} WIB ({{ $message->created_at->diffForHumans() }})
                </span>
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
                        <!-- 1. Belum Dihubungi -->
                        <button 
                            type="button" 
                            onclick="selectMsgOption('pending', 'fa-solid fa-clock text-amber-600', 'Belum Dihubungi')"
                            class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                        >
                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded-xs bg-amber-50 text-amber-700 flex items-center justify-center text-xs shrink-0">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Belum Dihubungi</p>
                                    <p class="text-[10px] text-slate-400">Pesan baru masuk menunggu respon</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-check text-xs text-emerald-600 {{ $message->status === 'pending' ? '' : 'hidden' }} msg-check-icon" data-status="pending"></i>
                        </button>

                        <!-- 2. Sudah Dihubungi -->
                        <button 
                            type="button" 
                            onclick="selectMsgOption('contacted', 'fa-solid fa-comments text-blue-600', 'Sudah Dihubungi')"
                            class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                        >
                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded-xs bg-blue-50 text-blue-700 flex items-center justify-center text-xs shrink-0">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Sudah Dihubungi</p>
                                    <p class="text-[10px] text-slate-400">Redaksi telah menghubungi via WhatsApp/Email</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-check text-xs text-emerald-600 {{ $message->status === 'contacted' ? '' : 'hidden' }} msg-check-icon" data-status="contacted"></i>
                        </button>

                        <!-- 3. Selesai Diproses -->
                        <button 
                            type="button" 
                            onclick="selectMsgOption('completed', 'fa-solid fa-circle-check text-emerald-600', 'Selesai Diproses')"
                            class="w-full px-3 py-2 text-left hover:bg-slate-50 flex items-center justify-between transition cursor-pointer"
                        >
                            <div class="flex items-center gap-2.5">
                                <div class="w-6 h-6 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Selesai Diproses</p>
                                    <p class="text-[10px] text-slate-400">Naskah telah terbit / urusan selesai</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-check text-xs text-emerald-600 {{ $message->status === 'completed' ? '' : 'hidden' }} msg-check-icon" data-status="completed"></i>
                        </button>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Internal Redaksi (Opsional)</label>
                    <textarea 
                        name="notes" 
                        rows="4" 
                        placeholder="Tuliskan catatan internal (misal: Sudah dikontak, draf bab 1 diterima, menunggu ISBN)..."
                        class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600"
                    >{{ old('notes', $message->notes) }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-2xs flex items-center justify-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Perbarui Status Pesan</span>
                </button>
            </form>
        </div>

    </div>

</div>

<script>
    function toggleMsgDropdown() {
        const menu = document.getElementById('msgStatusMenu');
        const chevron = document.getElementById('msgDropdownChevron');
        menu.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }

    function selectMsgOption(value, iconClass, label) {
        document.getElementById('msgStatusValue').value = value;
        
        const display = document.getElementById('msgSelectedDisplay');
        display.innerHTML = `<i class="${iconClass} text-sm"></i><span class="text-slate-900 font-bold">${label}</span>`;
        
        document.querySelectorAll('.msg-check-icon').forEach(icon => {
            if (icon.getAttribute('data-status') === value) {
                icon.classList.remove('hidden');
            } else {
                icon.classList.add('hidden');
            }
        });

        toggleMsgDropdown();
    }

    document.addEventListener('click', function(e) {
        const container = document.getElementById('customMsgStatusContainer');
        const menu = document.getElementById('msgStatusMenu');
        const chevron = document.getElementById('msgDropdownChevron');
        if (container && !container.contains(e.target) && menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            chevron.classList.remove('rotate-180');
        }
    });
</script>
@endsection
