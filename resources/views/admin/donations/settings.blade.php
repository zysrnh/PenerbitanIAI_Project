@extends('admin.layouts.app')

@section('title', 'Pengaturan QRIS & Rekening Donasi | PERSIS PERS')
@section('header_title', 'Pengaturan Donasi & Download Buku')

@section('content')
<div class="space-y-6 max-w-4xl">

    <!-- Top Header -->
    <div class="bg-white rounded-sm border border-slate-200 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('admin.donations.index') }}" class="text-xs text-emerald-700 hover:underline flex items-center gap-1 font-bold">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Riwayat Donasi</span>
                </a>
            </div>
            <h1 class="text-xl font-black text-slate-900 font-heading tracking-tight">
                Pengaturan QRIS &amp; Rekening Bank Donasi
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                Atur QRIS statis/dinamis, nomor rekening, nomor WhatsApp, serta teks ajakan donasi pada modal download buku digital.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('katalog.digital') }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Lihat Katalog Digital</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-3.5 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2 shadow-2xs">
            <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Form Settings -->
    <form method="POST" action="{{ route('admin.donations.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. STATUS & TEKS AJAKAN -->
        <div class="bg-white rounded-sm border border-slate-200 p-5 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="w-6 h-6 rounded-xs bg-emerald-100 text-emerald-900 font-bold flex items-center justify-center text-xs">1</span>
                    <h3 class="font-extrabold text-slate-900 text-sm">Status &amp; Pesan Ajakan Donasi</h3>
                </div>
                <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                    <input type="checkbox" name="donation_active" value="1" {{ ($settings['donation_active'] ?? '1') === '1' ? 'checked' : '' }} class="w-4 h-4 accent-emerald-700 rounded-xs" />
                    <span>Aktifkan Opsi Donasi di Katalog</span>
                </label>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Judul Ajakan Donasi <span class="text-rose-500">*</span></label>
                    <input type="text" name="donation_title" value="{{ old('donation_title', $settings['donation_title']) }}" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-700" placeholder="Misal: Dukung Penerbitan Buku Islam" />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Teks Deskripsi / Ajakan <span class="text-rose-500">*</span></label>
                    <textarea name="donation_desc" rows="3" required class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-700 leading-relaxed">{{ old('donation_desc', $settings['donation_desc']) }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1">Teks ini tampil di atas pilihan metode donasi QRIS &amp; Rekening Bank saat pengunjung mengklik unduh buku.</p>
                </div>
            </div>
        </div>

        <!-- 2. PENGATURAN QRIS -->
        <div class="bg-white rounded-sm border border-slate-200 p-5 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                <span class="w-6 h-6 rounded-xs bg-emerald-100 text-emerald-900 font-bold flex items-center justify-center text-xs">2</span>
                <h3 class="font-extrabold text-slate-900 text-sm">Gambar QRIS Donasi Resmi</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start text-xs">
                <!-- Preview Box -->
                <div class="md:col-span-4 bg-slate-50 border border-slate-200 rounded-sm p-3 flex flex-col items-center justify-center text-center">
                    <span class="text-[10.5px] font-bold text-slate-500 uppercase mb-2">Preview QRIS</span>
                    <div class="w-48 h-48 bg-white border border-slate-300 rounded-xs overflow-hidden flex items-center justify-center p-2 shadow-2xs">
                        @php
                            $qrisImg = $settings['donation_qris_image'] ?? '';
                            if (!empty($qrisImg) && !str_starts_with($qrisImg, 'http') && !str_starts_with($qrisImg, '//')) {
                                $qrisImg = asset(ltrim($qrisImg, '/'));
                            }
                        @endphp
                        <img id="qrisPreview" src="{{ $qrisImg ?: 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=PERSIS-PERS-DONASI' }}" alt="QRIS Donasi" class="w-full h-full object-contain" />
                    </div>
                    <span class="text-[10px] text-slate-400 mt-2">Dapat di-scan oleh semua e-wallet &amp; m-banking</span>
                </div>

                <!-- Inputs -->
                <div class="md:col-span-8 space-y-3">
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm space-y-2">
                        <label class="block font-bold text-slate-800 text-xs">Upload Gambar QRIS Baru</label>
                        <input type="file" name="donation_qris_file" id="qrisFileInput" accept="image/*" onchange="previewQrisFile(this)" class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-xs file:border-0 file:text-xs file:font-bold file:bg-emerald-800 file:text-white hover:file:bg-emerald-900 cursor-pointer" />
                        <p class="text-[10.5px] text-slate-400">Format: JPG, PNG, WEBP (Maksimal 5MB). Gambar otomatis tersimpan ke storage.</p>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Atau Gunakan Link / Path URL Gambar QRIS</label>
                        <input type="text" name="donation_qris_image" id="qrisUrlInput" value="{{ old('donation_qris_image', $settings['donation_qris_image']) }}" placeholder="Misal: /storage/qris/qris_persis.jpg" oninput="previewQrisUrl(this.value)" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono" />
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. REKENING BANK & KONTAK WA -->
        <div class="bg-white rounded-sm border border-slate-200 p-5 space-y-4">
            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                <span class="w-6 h-6 rounded-xs bg-emerald-100 text-emerald-900 font-bold flex items-center justify-center text-xs">3</span>
                <h3 class="font-extrabold text-slate-900 text-sm">Rekening Bank &amp; WhatsApp Konfirmasi</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Bank <span class="text-rose-500">*</span></label>
                    <input type="text" name="donation_bank_name" value="{{ old('donation_bank_name', $settings['donation_bank_name']) }}" required placeholder="Misal: Bank Syariah Indonesia (BSI)" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-bold" />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nomor Rekening <span class="text-rose-500">*</span></label>
                    <input type="text" name="donation_bank_account" value="{{ old('donation_bank_account', $settings['donation_bank_account']) }}" required placeholder="Misal: 7148888999" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono font-bold" />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Atas Nama Rekening <span class="text-rose-500">*</span></label>
                    <input type="text" name="donation_bank_holder" value="{{ old('donation_bank_holder', $settings['donation_bank_holder']) }}" required placeholder="Misal: PENERBIT PERSIS DONASI" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-bold" />
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">No. WhatsApp Konfirmasi Resmi <span class="text-rose-500">*</span></label>
                    <input type="text" name="donation_wa_contact" value="{{ old('donation_wa_contact', $settings['donation_wa_contact']) }}" required placeholder="Misal: 6285978006263" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 font-mono" />
                    <p class="text-[10px] text-slate-400 mt-1">Gunakan kode negara, misal 628xxxxxxxx.</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.donations.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Pengaturan Donasi</span>
            </button>
        </div>

    </form>

</div>

<script>
    function previewQrisFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('qrisPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewQrisUrl(url) {
        if (url && url.trim() !== '') {
            document.getElementById('qrisPreview').src = url;
        }
    }
</script>
@endsection
