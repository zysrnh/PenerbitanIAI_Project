@extends('admin.layouts.app')

@section('title', 'Jawab Pertanyaan | Admin PERSIS PERS')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header & Back Button -->
    <div class="flex items-center justify-between pb-4 border-b border-slate-200">
        <div>
            <a href="{{ route('admin.forum-questions.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1.5 mb-1.5">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pertanyaan
            </a>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">
                {{ $question->status === 'answered' ? 'Edit Jawaban Hukum Agama' : 'Jawab Pertanyaan Hukum Agama' }}
            </h1>
            <p class="text-xs text-slate-500">
                Berikan ulasan dan dalil hukum atas permasalahan yang diajukan oleh jamaah/masyarakat.
            </p>
        </div>
        <div>
            @if($question->is_published)
                <a href="{{ route('forum.show', $question->slug) }}" target="_blank" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xs transition flex items-center gap-1">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    <span>Lihat di Web</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Main Form Grid -->
    <form action="{{ route('admin.forum-questions.update', $question->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. KOTAK INFORMASI PENANYA & PERTANYAAN -->
        <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-user-pen text-emerald-700"></i>
                    <span>1. Data Penanya &amp; Pokok Masalah</span>
                </h3>
                <span class="text-[11px] text-slate-400 font-mono">
                    Diajukan: {{ $question->created_at ? $question->created_at->format('d M Y H:i') : '-' }}
                </span>
            </div>

            <!-- Penanya Details -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-3 bg-slate-50 rounded-xs border border-slate-200 text-xs">
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase block">Nama Penanya</span>
                    <strong class="text-slate-900">{{ $question->name }}</strong>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase block">No. WhatsApp</span>
                    <span class="text-slate-800 font-mono">{{ $question->phone ?: '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase block">Email</span>
                    <span class="text-slate-800">{{ $question->email ?: '-' }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-1">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Masalah <span class="text-red-500">*</span></label>
                    <select name="category" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 bg-white focus:border-emerald-600 outline-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $question->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pokok / Judul Pertanyaan <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $question->title) }}" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-bold outline-none" />
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Uraian Pertanyaan Penanya <span class="text-red-500">*</span></label>
                <textarea name="question" rows="4" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 outline-none leading-relaxed">{{ old('question', $question->question) }}</textarea>
                <p class="text-[11px] text-slate-400 mt-1">Redaksi diperkenankan merapikan susunan kalimat penanya tanpa mengubah substansi permasalahan.</p>
            </div>
        </div>

        <!-- 2. KOTAK JAWABAN & IDENTITAS PENJAWAB -->
        <div class="bg-white p-5 rounded-sm border-2 border-emerald-600/70 shadow-2xs space-y-4">
            <div class="flex items-center justify-between border-b border-emerald-100 pb-3">
                <h3 class="text-xs font-extrabold text-emerald-950 uppercase tracking-wider flex items-center gap-2">
                    <i class="fa-solid fa-scale-balanced text-emerald-700"></i>
                    <span>2. Jawaban Resmi &amp; Identitas Penjawab</span>
                </h3>
                <span class="text-[11px] text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-xs">
                    Wajib mencantumkan dalil Al-Qur'an &amp; Sunnah
                </span>
            </div>

            <!-- Nama Penjawab Field -->
            <div>
                <label class="block text-xs font-bold text-slate-900 mb-1">
                    Nama Penjawab / Dewan Asatidz <span class="text-red-500">*</span>
                </label>
                <input type="text" name="answered_by" id="inputAnsweredBy" value="{{ old('answered_by', $defaultAnswerer) }}" required placeholder="Contoh: Dewan Hisbah PERSIS / Admin Redaksi" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 font-bold text-slate-900 outline-none" />
                
                <!-- Quick Pilihan Identitas Penjawab -->
                <div class="flex items-center gap-1.5 flex-wrap mt-2">
                    <span class="text-[10px] text-slate-400 font-bold uppercase">Pilihan Cepat:</span>
                    <button type="button" onclick="setAnswerer('Dewan Hisbah PERSIS')" class="px-2 py-0.5 text-[10.5px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer">Dewan Hisbah PERSIS</button>
                    <button type="button" onclick="setAnswerer('Dewan Redaksi PERSIS PERS')" class="px-2 py-0.5 text-[10.5px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer">Dewan Redaksi PERSIS PERS</button>
                    <button type="button" onclick="setAnswerer('{{ Auth::user()->name }}')" class="px-2 py-0.5 text-[10.5px] rounded-xs bg-slate-100 hover:bg-emerald-100 text-slate-700 font-medium transition cursor-pointer">{{ Auth::user()->name }} (Saya Sendiri)</button>
                </div>
            </div>

            <!-- Isi Jawaban Lengkap -->
            <div>
                <label class="block text-xs font-bold text-slate-900 mb-1">
                    Uraian Jawaban &amp; Dalil Hukum Syariah <span class="text-red-500">*</span>
                </label>
                <textarea name="answer" rows="10" placeholder="Tuliskan ulasan hukum, nash dalil Al-Qur'an / Hadits, serta kesimpulan praktis yang dapat dipedomani oleh penanya..." class="w-full text-xs p-3 rounded-sm border border-slate-300 focus:border-emerald-600 outline-none leading-relaxed font-normal">{{ old('answer', $question->answer) }}</textarea>
            </div>

            <!-- Status & Publikasi Toggle -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 border-t border-slate-100">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Status Jawaban</label>
                    <select name="status" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 bg-white font-semibold">
                        <option value="answered" {{ old('status', $question->status) === 'answered' ? 'selected' : '' }}>Sudah Dijawab (Selesai)</option>
                        <option value="pending" {{ old('status', $question->status) === 'pending' ? 'selected' : '' }}>Menunggu Telaah (Pending)</option>
                        <option value="rejected" {{ old('status', $question->status) === 'rejected' ? 'selected' : '' }}>Ditolak / Tidak Memenuhi Kriteria</option>
                    </select>
                </div>

                <div class="flex items-center pt-5">
                    <label class="inline-flex items-center gap-2 cursor-pointer bg-slate-50 hover:bg-emerald-50/50 p-2.5 rounded-xs border border-slate-200 transition w-full">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $question->is_published ?? true) ? 'checked' : '' }} class="rounded-xs text-emerald-700 focus:ring-0 cursor-pointer w-4 h-4">
                        <div>
                            <span class="text-xs font-bold text-slate-800 block">Tayangkan di Forum Publik</span>
                            <span class="text-[10px] text-slate-400 block">Pertanyaan &amp; jawaban dapat dibaca oleh seluruh pengunjung website.</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Actions -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('admin.forum-questions.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-sm transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm shadow-sm transition flex items-center gap-2 cursor-pointer">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan &amp; Publikasikan Jawaban</span>
            </button>
        </div>
    </form>
</div>

<script>
    function setAnswerer(name) {
        const input = document.getElementById('inputAnsweredBy');
        if (input) {
            input.value = name;
            input.focus();
        }
    }
</script>
@endsection
