<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('books')) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('author');
                $table->string('category')->default('Buku Ajar');
                $table->string('isbn')->nullable();
                $table->string('kdt')->nullable();
                $table->string('year', 10)->default('2026');
                $table->string('pages', 50)->default('240 hlm');
                $table->string('format')->default('UNESCO B5 (Bookpaper)');
                $table->string('price')->default('Rp 75.000');
                $table->text('synopsis')->nullable();
                
                // 4 Photo Slots for Complete Showcase
                $table->string('cover_image')->nullable(); // Foto 1: Sampul Depan
                $table->string('back_cover_image')->nullable(); // Foto 2: Sampul Belakang
                $table->string('inside_preview_image')->nullable(); // Foto 3: Halaman Isi / Daftar Isi
                $table->string('additional_image')->nullable(); // Foto 4: Foto Fisik Buku
                $table->json('gallery')->nullable(); // Array Galeri Tambahan

                $table->string('sample_pdf')->nullable();
                $table->boolean('is_new_release')->default(true);
                $table->boolean('is_best_seller')->default(false);
                $table->integer('order')->default(0);
                $table->enum('status', ['published', 'draft'])->default('published');
                $table->timestamps();
            });
        } else {
            Schema::table('books', function (Blueprint $table) {
                if (!Schema::hasColumn('books', 'back_cover_image')) {
                    $table->string('back_cover_image')->nullable()->after('cover_image');
                }
                if (!Schema::hasColumn('books', 'inside_preview_image')) {
                    $table->string('inside_preview_image')->nullable()->after('back_cover_image');
                }
                if (!Schema::hasColumn('books', 'additional_image')) {
                    $table->string('additional_image')->nullable()->after('inside_preview_image');
                }
                if (!Schema::hasColumn('books', 'gallery')) {
                    $table->json('gallery')->nullable()->after('additional_image');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
