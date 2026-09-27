<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('digital_books')) {
            Schema::create('digital_books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('author');
                $table->string('category')->default('Studi Islam');
                $table->string('year', 10)->default('2026');
                $table->string('pages', 50)->default('240 hlm');
                $table->string('language')->default('Indonesia');
                $table->text('synopsis')->nullable();
                $table->string('cover_image')->nullable();
                $table->string('pdf_file')->nullable();
                $table->boolean('is_featured')->default(true);
                $table->integer('order')->default(0);
                $table->enum('status', ['published', 'draft'])->default('published');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_books');
    }
};
