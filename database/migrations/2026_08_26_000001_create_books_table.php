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
                $table->string('cover_image')->nullable();
                $table->string('sample_pdf')->nullable();
                $table->boolean('is_new_release')->default(true);
                $table->boolean('is_best_seller')->default(false);
                $table->integer('order')->default(0);
                $table->enum('status', ['published', 'draft'])->default('published');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
