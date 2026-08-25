@extends('admin.layouts.app')

@section('title', 'Detail Pesan Masuk')
@section('header_title', 'Detail Pesan & Pengajuan Naskah')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-600 hover:text-slate-900 transition">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Daftar Pesan
        </a>

        <a href="{{ $message->wa_link }}" target="_blank" class="px-4 py-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-xs">
            <i class="fa-brands fa-whatsapp text-base"></i> Balas Langsung via WhatsApp
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Main Message Detail -->
        <div class="lg:col-span-8 bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
            <div class="border-b border-slate-100 pb-5 mb-5">
                <span class="inline-block text-xs font-bold px-3 py-1 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200/70 mb-2">
                    {{ $message->service_category ?? 'Konsultasi Umum' }}
                </span>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900">{{ $message->subject ?: 'Pengajuan Naskah / Konsultasi' }}</h3>
                <span class="text-xs sm:text-sm text-slate-500 block mt-1">
                    Diterima pada {{ $message->created_at->format('d M Y') }} pukul {{ $message->created_at->format('H:i') }} WIB ({{ $message->created_at->diffForHumans() }})
                </span>
            </div>

            <!-- Content Body -->
            <div class="mb-6">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Isi Pesan / Keterangan Naskah:</span>
                <div class="p-5 rounded-xl bg-slate-50 border border-slate-200/70 text-slate-800 text-sm leading-relaxed whitespace-pre-line font-sans">
{{ $message->message }}
                </div>
            </div>

            <!-- Sender Info Card -->
            <div class="border-t border-slate-100 pt-5">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-3">Informasi Lengkap Pengirim:</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Nama Pengirim</span>
                        <span class="text-sm font-bold text-slate-900 block mt-1">{{ $message->name }}</span>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">Alamat Email</span>
                        <a href="mailto:{{ $message->email }}" class="text-sm font-bold text-slate-900 hover:text-emerald-700 block mt-1 truncate transition">{{ $message->email }}</a>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/60">
                        <span class="text-[11px] font-bold text-slate-400 block uppercase tracking-wider">No. WhatsApp</span>
                        <a href="{{ $message->wa_link }}" target="_blank" class="text-sm font-bold text-emerald-700 block mt-1 flex items-center gap-1.5">
                            <i class="fa-brands fa-whatsapp text-base text-[#25D366]"></i> {{ $message->phone }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Status Update & Notes -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 sm:p-7">
                <h4 class="text-base font-bold text-slate-900 mb-4 pb-3 border-b border-slate-100">Status & Catatan Redaksi</h4>

                <form method="POST" action="{{ route('admin.messages.update', $message) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Ubah Status Pemrosesan</label>
                        <select name="status" class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600 bg-white font-semibold">
                            <option value="pending" {{ $message->status === 'pending' ? 'selected' : '' }}>⏳ Belum Dihubungi</option>
                            <option value="contacted" {{ $message->status === 'contacted' ? 'selected' : '' }}>💬 Sudah Dihubungi</option>
                            <option value="completed" {{ $message->status === 'completed' ? 'selected' : '' }}>✅ Selesai Diproses</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Catatan Internal Redaksi (Opsional)</label>
                        <textarea 
                            name="notes" 
                            rows="4" 
                            placeholder="Tuliskan catatan internal (misal: Sudah dikontak, draf bab 1 diterima, menunggu ISBN)..."
                            class="w-full px-3.5 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-600"
                        >{{ old('notes', $message->notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-sm font-bold transition shadow-xs">
                        Perbarui Status Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
