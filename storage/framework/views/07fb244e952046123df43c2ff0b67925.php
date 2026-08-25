<?php $__env->startSection('title', 'Hubungi Kami | IAI PERSIS PRESS'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header Banner -->
    <section class="bg-brand-950 text-white py-12 sm:py-16 relative overflow-hidden border-b border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2"><?php echo e($settings['banner_badge']); ?></span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight"><?php echo e($settings['banner_title']); ?></h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                <?php echo e($settings['banner_desc']); ?>

            </p>
        </div>
    </section>

    <!-- 4 Quick Info Cards -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Kantor -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Kantor Redaksi</h3>
                    <p class="text-xs text-slate-600 mt-1 leading-relaxed"><?php echo e($settings['address']); ?></p>
                </div>
            </div>

            <!-- Card 2: WhatsApp -->
            <?php
                $cleanWaNum = preg_replace('/[^0-9]/', '', $settings['whatsapp']);
                if (str_starts_with($cleanWaNum, '0')) {
                    $cleanWaNum = '62' . substr($cleanWaNum, 1);
                }
            ?>
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-brands fa-whatsapp text-lg text-[#25D366]"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">WhatsApp & Telepon</h3>
                    <a href="https://wa.me/<?php echo e($cleanWaNum); ?>?text=<?php echo e(urlencode($settings['wa_default_msg'])); ?>" target="_blank" class="text-xs font-bold text-slate-800 hover:text-emerald-700 block mt-1 transition">
                        <?php echo e($settings['whatsapp']); ?>

                    </a>
                    <span class="text-xs text-slate-500 block"><?php echo e($settings['phone']); ?></span>
                </div>
            </div>

            <!-- Card 3: Email -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Email Resmi</h3>
                    <a href="mailto:<?php echo e($settings['email']); ?>" class="text-xs font-bold text-slate-800 hover:text-emerald-700 block mt-1 truncate transition">
                        <?php echo e($settings['email']); ?>

                    </a>
                    <span class="text-[11px] text-slate-500 block mt-0.5"><?php echo e($settings['email_note']); ?></span>
                </div>
            </div>

            <!-- Card 4: Jam Operasional -->
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Jam Operasional</h3>
                    <p class="text-xs text-slate-600 mt-1 font-semibold"><?php echo e($settings['hours']); ?></p>
                    <?php if(!empty($settings['hours_weekend'])): ?>
                        <span class="text-[11px] text-slate-400 block mt-0.5"><?php echo e($settings['hours_weekend']); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Form & Maps Section -->
    <section class="py-14 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Alert with WA trigger -->
            <?php if(session('success')): ?>
                <div class="mb-8 p-5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm animate-fade-in-up">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm text-emerald-950"><?php echo e(session('success')); ?></h4>
                                <p class="text-xs text-emerald-800 mt-0.5">Tim redaksi kami akan segera menindaklanjuti pesan Anda.</p>
                            </div>
                        </div>
                        <?php if(session('wa_url')): ?>
                            <a href="<?php echo e(session('wa_url')); ?>" target="_blank" class="px-4 py-2 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-lg text-xs font-bold transition flex items-center gap-2 shrink-0 shadow-xs">
                                <i class="fa-brands fa-whatsapp text-base"></i> Teruskan ke WhatsApp Redaksi &rarr;
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Form Pengajuan Naskah / Pesan -->
                <div class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-2xl border border-slate-200 shadow-sm reveal-card">
                    <div class="mb-6 border-b border-slate-100 pb-4">
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Formulir Konsultasi</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-heading tracking-tight">Kirim Pesan / Pengajuan Naskah</h2>
                        <p class="text-xs text-slate-500 mt-1">Silakan lengkapi formulir berikut. Data Anda akan langsung tersimpan di sistem redaksi kami.</p>
                    </div>

                    <?php if($errors->any()): ?>
                        <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium space-y-1">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div>&bull; <?php echo e($error); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('kontak.store')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>

                        <!-- Nama -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap & Gelar <span class="text-rose-500">*</span></label>
                            <input 
                                type="text" 
                                name="name" 
                                value="<?php echo e(old('name')); ?>"
                                placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag." 
                                required
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 focus:ring-1 focus:ring-brand-700 transition"
                            />
                        </div>

                        <!-- WhatsApp & Email Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">No. WhatsApp / HP <span class="text-rose-500">*</span></label>
                                <input 
                                    type="tel" 
                                    name="phone" 
                                    value="<?php echo e(old('phone')); ?>"
                                    placeholder="08123456789" 
                                    required
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 focus:ring-1 focus:ring-brand-700 transition"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="<?php echo e(old('email')); ?>"
                                    placeholder="email@institusi.ac.id" 
                                    required
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 focus:ring-1 focus:ring-brand-700 transition"
                                />
                            </div>
                        </div>

                        <!-- Layanan & Subjek -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Layanan <span class="text-rose-500">*</span></label>
                                <select name="service_category" required class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 bg-white text-slate-700 font-medium">
                                    <option value="Penerbitan Buku Ber-ISBN" <?php echo e(old('service_category') == 'Penerbitan Buku Ber-ISBN' ? 'selected' : ''); ?>>Penerbitan Buku Ber-ISBN</option>
                                    <option value="Percetakan Umum & Komersil" <?php echo e(old('service_category') == 'Percetakan Umum & Komersil' ? 'selected' : ''); ?>>Percetakan Umum & Komersil</option>
                                    <option value="Jurnal & Prosiding Ilmiah" <?php echo e(old('service_category') == 'Jurnal & Prosiding Ilmiah' ? 'selected' : ''); ?>>Jurnal & Prosiding Ilmiah</option>
                                    <option value="Konversi KTI ke Buku" <?php echo e(old('service_category') == 'Konversi KTI ke Buku' ? 'selected' : ''); ?>>Konversi KTI ke Buku</option>
                                    <option value="Pengurusan ISBN & HKI" <?php echo e(old('service_category') == 'Pengurusan ISBN & HKI' ? 'selected' : ''); ?>>Pengurusan ISBN & HKI</option>
                                    <option value="Lainnya" <?php echo e(old('service_category') == 'Lainnya' ? 'selected' : ''); ?>>Konsultasi Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul / Subjek Naskah</label>
                                <input 
                                    type="text" 
                                    name="subject" 
                                    value="<?php echo e(old('subject')); ?>"
                                    placeholder="Contoh: Draf Buku Fiqih Muamalah" 
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 focus:ring-1 focus:ring-brand-700 transition"
                                />
                            </div>
                        </div>

                        <!-- Pesan -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pesan / Deskripsi Naskah <span class="text-rose-500">*</span></label>
                            <textarea 
                                name="message" 
                                rows="4" 
                                required
                                placeholder="Jelaskan secara singkat mengenai naskah Anda, jumlah halaman, estimasi cetak, atau pertanyaan yang ingin dikonsultasikan..." 
                                class="w-full px-3.5 py-2.5 text-xs sm:text-sm rounded-lg border border-slate-200 focus:outline-none focus:border-brand-700 focus:ring-1 focus:ring-brand-700 transition"
                            ><?php echo e(old('message')); ?></textarea>
                        </div>

                        <div class="pt-2">
                            <button 
                                type="submit" 
                                class="w-full py-3.5 bg-brand-900 hover:bg-brand-950 text-white rounded-lg font-bold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md transform duration-200"
                            >
                                <i class="fa-solid fa-paper-plane text-emerald-400"></i> Kirim Pengajuan Naskah
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right: WhatsApp Box & Maps -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- WhatsApp Box -->
                    <div class="bg-brand-950 text-white p-6 sm:p-7 rounded-2xl border border-brand-900 shadow-md reveal-card">
                        <div class="flex items-center gap-3.5 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-[#25D366] text-white flex items-center justify-center text-2xl shrink-0 shadow-sm">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-base font-heading text-white"><?php echo e($settings['wa_box_title']); ?></h3>
                                <span class="text-xs text-emerald-400 font-medium"><?php echo e($settings['wa_box_subtitle']); ?></span>
                            </div>
                        </div>

                        <p class="text-xs text-slate-300 leading-relaxed mb-5">
                            <?php echo e($settings['wa_box_desc']); ?>

                        </p>

                        <!-- Official Green WhatsApp Button -->
                        <a 
                            href="https://wa.me/<?php echo e($cleanWaNum); ?>?text=<?php echo e(urlencode($settings['wa_default_msg'])); ?>" 
                            target="_blank" 
                            class="w-full py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xl font-bold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2.5 shadow-sm hover:shadow-lg transform duration-200"
                        >
                            <i class="fa-brands fa-whatsapp text-lg"></i> <?php echo e($settings['wa_btn_text']); ?>

                        </a>
                    </div>

                    <!-- Google Maps Card -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm reveal-card">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-map-location-dot text-emerald-600"></i> <?php echo e($settings['maps_title']); ?>

                            </h3>
                            <?php if(!empty($settings['maps_external_url'])): ?>
                                <a href="<?php echo e($settings['maps_external_url']); ?>" target="_blank" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-900 transition flex items-center gap-1">
                                    Buka di Maps <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="w-full h-64 rounded-xl overflow-hidden border border-slate-200">
                            <iframe 
                                src="<?php echo e($settings['maps']); ?>" 
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                            ></iframe>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Gawe\IAIPersis\penerbitan.iaibandung.ac.id\resources\views/kontak.blade.php ENDPATH**/ ?>