@extends('admin.layouts.app')

@section('title', 'Edit Berita - ' . $article->title)

@section('content')
<div class="space-y-6">

    <!-- Header Breadcrumb & Title -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('admin.articles.index') }}" class="hover:text-emerald-700 transition">Berita</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="text-slate-800 font-semibold">Edit Berita</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight font-heading flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-emerald-700 text-lg"></i>
                <span>Edit Berita &amp; Artikel</span>
            </h1>
        </div>
        <div class="flex items-center gap-2">
            @if($article->status === 'published')
                <a href="{{ route('berita.show', $article->slug) }}" target="_blank" class="px-3 py-2 bg-emerald-50 text-emerald-800 border border-emerald-300 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                    <i class="fa-solid fa-arrow-up-right-from-square text-emerald-600"></i>
                    <span>Lihat di Web</span>
                </a>
            @endif
            <a href="{{ route('admin.articles.index') }}" class="px-3 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-left text-slate-400"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="p-3.5 bg-rose-50 border border-rose-200 text-rose-800 rounded-sm text-xs space-y-1">
            <div class="font-bold flex items-center gap-1.5">
                <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
                <span>Terdapat beberapa kesalahan pengisian formulir:</span>
            </div>
            <ul class="list-disc list-inside space-y-0.5 text-[11px] pl-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" id="articleForm" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf
        @method('PUT')

        <!-- LEFT COLUMN: MAIN CONTENT (8 COLS) -->
        <div class="lg:col-span-8 space-y-5">
            
            <!-- Judul Berita -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-4">
                <div>
                    <label class="block font-bold text-slate-800 text-xs mb-1.5">Judul Berita / Artikel <span class="text-rose-500">*</span></label>
                    <input type="text" name="title" id="article_title" value="{{ old('title', $article->title) }}" required placeholder="Masukkan judul berita yang menarik..." class="w-full px-3.5 py-2.5 text-sm font-bold text-slate-900 rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600" />
                </div>

                <!-- Slug URL -->
                <div class="flex items-center gap-2 text-xs bg-slate-50 p-2.5 rounded-xs border border-slate-200">
                    <span class="text-slate-500 font-mono text-[11px] shrink-0">URL Slug: /berita/</span>
                    <input type="text" name="slug" id="article_slug" value="{{ old('slug', $article->slug) }}" placeholder="judul-berita-otomatis" class="w-full px-2 py-1 text-xs rounded-xs border border-slate-300 bg-white font-mono text-[11px] focus:outline-hidden focus:border-emerald-600" />
                </div>

                <!-- Ringkasan / Excerpt -->
                <div>
                    <label class="block font-bold text-slate-800 text-xs mb-1">Ringkasan Singkat (Excerpt)</label>
                    <p class="text-[11px] text-slate-400 mb-1.5">Teks ringkasan 1-2 kalimat yang tampil di kartu berita dan pratinjau media sosial.</p>
                    <textarea name="excerpt" rows="2" placeholder="Tuliskan rangkuman pokok berita di sini..." class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 text-slate-700">{{ old('excerpt', $article->excerpt) }}</textarea>
                </div>
            </div>

            <!-- Rich Text Editor Container -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100 flex-wrap gap-2">
                    <label class="block font-bold text-slate-800 text-xs">Isi Konten Berita <span class="text-rose-500">*</span></label>
                    
                    <!-- Editor Quick Helper Toolbar -->
                    <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xs border border-slate-200 text-xs">
                        <button type="button" onclick="formatDoc('bold')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs font-bold border border-slate-200 text-slate-700 cursor-pointer" title="Tebal (Bold)">B</button>
                        <button type="button" onclick="formatDoc('italic')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs italic font-serif border border-slate-200 text-slate-700 cursor-pointer" title="Miring (Italic)">I</button>
                        <button type="button" onclick="formatDoc('underline')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs underline border border-slate-200 text-slate-700 cursor-pointer" title="Garis Bawah (Underline)">U</button>
                        <span class="w-px h-4 bg-slate-300 mx-0.5"></span>
                        <button type="button" onclick="formatBlock('h2')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs font-bold text-[11px] border border-slate-200 text-slate-700 cursor-pointer" title="Heading 2">H2</button>
                        <button type="button" onclick="formatBlock('h3')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs font-bold text-[11px] border border-slate-200 text-slate-700 cursor-pointer" title="Heading 3">H3</button>
                        <button type="button" onclick="formatBlock('blockquote')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs border border-slate-200 text-slate-700 cursor-pointer" title="Kutipan (Quote)"><i class="fa-solid fa-quote-left text-[10px]"></i></button>
                        <span class="w-px h-4 bg-slate-300 mx-0.5"></span>
                        <button type="button" onclick="formatDoc('insertUnorderedList')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs border border-slate-200 text-slate-700 cursor-pointer" title="Daftar Bullet"><i class="fa-solid fa-list-ul text-[10px]"></i></button>
                        <button type="button" onclick="formatDoc('insertOrderedList')" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs border border-slate-200 text-slate-700 cursor-pointer" title="Daftar Nomor"><i class="fa-solid fa-list-ol text-[10px]"></i></button>
                        <span class="w-px h-4 bg-slate-300 mx-0.5"></span>
                        <button type="button" onclick="insertLinkPrompt()" class="px-2 py-1 bg-white hover:bg-slate-200 rounded-xs border border-slate-200 text-slate-700 cursor-pointer" title="Sisipkan Link"><i class="fa-solid fa-link text-[10px]"></i></button>
                        <button type="button" onclick="triggerInlineImageUpload()" class="px-2 py-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold rounded-xs border border-emerald-300 cursor-pointer flex items-center gap-1" title="Sisipkan Foto ke Dalam Berita">
                            <i class="fa-solid fa-image text-[10px]"></i>
                            <span class="text-[10.5px]">Sisipkan Foto</span>
                        </button>
                    </div>
                </div>

                <!-- Hidden file input for inline image upload -->
                <input type="file" id="inlineImageInput" accept="image/*" class="hidden" onchange="handleInlineImageUpload(this)" />

                <!-- Contenteditable Visual Editor -->
                <div id="editorContent" contenteditable="true" class="w-full min-h-[360px] p-4 text-slate-800 rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white font-sans text-sm leading-relaxed prose max-w-none shadow-inner" oninput="syncEditorToHiddenInput()">
                    {!! old('content', $article->content) !!}
                </div>

                <!-- Hidden Input for Form Submission -->
                <textarea name="content" id="hidden_content_input" class="hidden">{{ old('content', $article->content) }}</textarea>

                <div class="flex items-center justify-between text-[11px] text-slate-400 pt-1">
                    <span id="wordCounter">0 kata | Estimasi baca: 1 menit</span>
                    <span class="text-slate-500 font-mono text-[10.5px]">HTML WYSIWYG Editor</span>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: PUBLISHING & METADATA (4 COLS) -->
        <div class="lg:col-span-4 space-y-5">
            
            <!-- Publish Action Box -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider">Status &amp; Publikasi</h3>
                    <span class="text-[10px] text-emerald-800 font-bold bg-emerald-50 px-2 py-0.5 rounded-xs">WordPress CMS</span>
                </div>

                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Status Publikasi</label>
                        <select name="status" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white font-semibold">
                            <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Langsung Terbitkan (Published)</option>
                            <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Simpan sebagai Draf (Draft)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Tanggal Publikasi</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center gap-2 cursor-pointer p-2.5 bg-slate-50 rounded-xs border border-slate-200">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }} class="rounded-xs text-emerald-600 focus:ring-0 cursor-pointer" />
                            <div>
                                <span class="font-bold text-slate-800 text-xs block">Jadikan Berita Utama / Headline</span>
                                <span class="text-[10.5px] text-slate-400">Tampil menonjol di bagian atas halaman berita.</span>
                            </div>
                        </label>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-slate-400 text-[11px]">
                        <span>Jumlah Views: <strong class="text-slate-800">{{ number_format($article->views_count, 0, ',', '.') }}</strong></span>
                        <span>Penulis: <strong class="text-slate-800">{{ $article->author->name ?? 'Redaksi' }}</strong></span>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100 flex gap-2">
                    <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold uppercase tracking-wider transition shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Perbarui Berita</span>
                    </button>
                </div>
            </div>

            <!-- Kategori Berita -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <label class="block font-extrabold text-xs text-slate-900 uppercase tracking-wider">Kategori Berita</label>
                    <a href="{{ route('admin.article-categories.index') }}" target="_blank" class="text-[10px] text-emerald-700 font-bold hover:underline">+ Kelola</a>
                </div>

                <div class="space-y-1.5 max-h-48 overflow-y-auto pr-1 text-xs">
                    @forelse($categories as $cat)
                        <label class="flex items-center gap-2 p-2 rounded-xs hover:bg-slate-50 cursor-pointer transition">
                            <input type="radio" name="category_id" value="{{ $cat->id }}" {{ old('category_id', $article->category_id) == $cat->id ? 'checked' : '' }} class="text-emerald-700 focus:ring-0 cursor-pointer" />
                            <span class="text-slate-800 font-semibold">{{ $cat->name }}</span>
                        </label>
                    @empty
                        <p class="text-slate-400 text-xs italic py-2">Belum ada kategori. Silakan buat kategori baru.</p>
                    @endforelse
                </div>
            </div>

            <!-- Cover / Thumbnail Upload -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <label class="block font-extrabold text-xs text-slate-900 uppercase tracking-wider">Thumbnail / Foto Cover</label>
                    <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs">Max 5MB</span>
                </div>

                <div class="space-y-3">
                    <div class="aspect-video w-full rounded-xs overflow-hidden border border-slate-300 bg-slate-100 flex items-center justify-center relative">
                        <img id="thumb_preview" src="{{ old('thumbnail', $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=600&auto=format&fit=crop') }}" class="w-full h-full object-cover" alt="Preview Thumbnail" />
                    </div>

                    <div class="space-y-2">
                        <input type="file" name="thumbnail_file" id="in_thumb_file" accept="image/*" onchange="previewThumbnailFile(this)" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10.5px] file:font-bold file:bg-[#006830] file:text-white hover:file:bg-[#032c21] cursor-pointer" />
                        <input type="text" name="thumbnail" id="in_thumb_url" value="{{ old('thumbnail', $article->thumbnail) }}" placeholder="Atau paste URL gambar cover..." oninput="previewThumbnailUrl(this.value)" class="w-full px-2.5 py-1.5 text-xs rounded-sm border border-slate-300 bg-white font-mono text-[11px]" />
                    </div>
                </div>
            </div>

            <!-- Tags / Kata Kunci -->
            <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-2">
                <label class="block font-extrabold text-xs text-slate-900 uppercase tracking-wider">Tags / Kata Kunci</label>
                <p class="text-[11px] text-slate-400">Pisahkan dengan tanda koma (,).</p>
                <input type="text" name="tags" value="{{ old('tags', $article->tags) }}" placeholder="Misal: Penerbitan, ISBN, Pelatihan" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white" />
            </div>

        </div>

    </form>

</div>

<script>
    // --- Rich Text WYSIWYG Helpers ---
    function formatDoc(cmd, val = null) {
        document.execCommand(cmd, false, val);
        syncEditorToHiddenInput();
    }

    function formatBlock(tag) {
        document.execCommand('formatBlock', false, '<' + tag + '>');
        syncEditorToHiddenInput();
    }

    function insertLinkPrompt() {
        const url = prompt('Masukkan URL Link tujuan (misal: https://...):');
        if (url) {
            document.execCommand('createLink', false, url);
            syncEditorToHiddenInput();
        }
    }

    function triggerInlineImageUpload() {
        document.getElementById('inlineImageInput').click();
    }

    function handleInlineImageUpload(input) {
        if (input.files && input.files[0]) {
            const formData = new FormData();
            formData.append('image', input.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            // Show temporary placeholder
            const placeholderId = 'temp_img_' + Date.now();
            document.execCommand('insertHTML', false, `<p id="${placeholderId}" class="text-xs text-slate-400 italic"><i class="fa-solid fa-spinner fa-spin mr-1"></i>Mengunggah gambar...</p>`);

            fetch('{{ route("admin.articles.upload_image") }}', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const el = document.getElementById(placeholderId);
                if (data.success && data.url) {
                    const imgHtml = `<figure class="my-4"><img src="${data.url}" alt="Foto Berita" class="w-full max-h-96 object-cover rounded-sm border border-slate-200 shadow-xs" /><figcaption class="text-center text-xs text-slate-400 mt-1.5 italic">Foto dokumentasi</figcaption></figure><p><br></p>`;
                    if (el) {
                        el.outerHTML = imgHtml;
                    } else {
                        document.execCommand('insertHTML', false, imgHtml);
                    }
                    syncEditorToHiddenInput();
                } else {
                    alert('Gagal mengunggah gambar.');
                    if (el) el.remove();
                }
            })
            .catch(err => {
                alert('Terjadi kesalahan saat upload gambar.');
                const el = document.getElementById(placeholderId);
                if (el) el.remove();
            });
        }
    }

    function syncEditorToHiddenInput() {
        const editor = document.getElementById('editorContent');
        const hidden = document.getElementById('hidden_content_input');
        hidden.value = editor.innerHTML;

        // Word count & reading time
        const text = editor.innerText || editor.textContent || '';
        const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
        const minutes = Math.ceil(words / 200) || 1;
        document.getElementById('wordCounter').innerText = `${words} kata | Estimasi baca: ${minutes} menit`;
    }

    // --- Thumbnail Helpers ---
    function previewThumbnailFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('thumb_preview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewThumbnailUrl(url) {
        if (url && url.trim() !== '') {
            document.getElementById('thumb_preview').src = url;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        syncEditorToHiddenInput();
    });
</script>
@endsection
