@extends('admin.layouts.app')

@section('title', 'Detail Pesan Masuk')
@section('header_title', 'Detail Pesan & Pengajuan Naskah')

@section('content')
    <div class="mb-5 flex items-center justify-between">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 transition">
            <i class="fa-solid fa-arrow-left text-[11px]"></i> Kembali ke Daftar Pesan
        </a>

        <a href="{{ $message->wa_link }}" target="_blank" class="px-4 py-2 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-lg text-xs font-bold transition flex items-center gap-2 shadow-xs">
            <i class="fa-brands fa-whatsapp text-sm"></i> Balas Langsung via WhatsApp
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Main Message Detail -->
        <div class="lg:col-span-8 bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                <div>
                    <span class="inline-block text-[11px] font-bold px-2.5 py-0.5 rounded bg-emerald-50 text-emerald-800 border border-emerald-200/70 mb-1">
                        {{ $message->service_category ?? 'Konsultasi Umum' }}
                    </span>
                    <h3 class="text-base font-bold text-slate-900">{{ $message->subject ?: 'Pengajuan Naskah / Konsultasi' }}</h3>
                    <span class="text-xs text-slate-400 block mt-0.5">Diterima pada {{ $message->created_at->format('d F Y, Pukul H:i WIB') }}</span>
                </div>
            </div>

            <!-- Content Body -->
            <div class="mb-6">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-2">Isi Pesan / Keterangan Naskah:</span>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200/70 text-slate-800 text-xs sm:text-sm leading-relaxed whitespace-pre-line font-sans">
{{ $message->message }}
                </div>
            </div>

            <!-- Sender Info Card -->
            <div class="border-t border-slate-100 pt-4">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider block mb-3">Informasi Pengirim:</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/60">
                        <span class="text-[10px] font-semibold text-slate-400 block uppercase">Nama Pengirim</span>
                        <span class="text-xs font-bold text-slate-900 block mt-0.5">{{ $message->name }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/60">
                        <span class="text-[10px] font-semibold text-slate-400 block uppercase">Alamat Email</span>
                        <span class="text-xs font-bold text-slate-900 block mt-0.5">{{ $message->email }}</span>
                    </div>
                    <div class="p-3 rounded-lg bg-slate-50 border border-slate-200/60">
                        <span class="text-[10px] font-semibold text-slate-400 block uppercase">No. WhatsApp</span>
                        <span class="text-xs font-bold text-emerald-700 block mt-0.5">{{ $message->phone }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Status Update & Notes -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-xl border border-slate-200/80 shadow-xs p-6">
                <h4 class="text-sm font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">Status & Catatan Redaksi</h4>

                <form method="POST" action="{{ route('admin.messages.update', $message) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ubah Status Pemrosesan</label>
                        <select name="status" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600 bg-white font-semibold">
                            <option value="pending" {{ $message->status === 'pending' ? 'selected' : '' }}>⏳ Belum Dihubungi</option>
                            <option value="contacted" {{ $message->status === 'contacted' ? 'selected' : '' }}>💬 Sudah Dihubungi</option>
                            <option value="completed" {{ $message->status === 'completed' ? 'selected' : '' }}>✅ Selesai Diproses</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan Internal Redaksi (Opsional)</label>
                        <textarea 
                            name="notes" 
                            rows="4" 
                            placeholder="Tuliskan catatan internal (misal: Sudah dikontak, draf bab 1 diterima, menunggu ISBN)..."
                            class="w-full px-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-none focus:border-emerald-600"
                        >{{ old('notes', $message->notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-semibold transition shadow-xs">
                        Perbarui Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
