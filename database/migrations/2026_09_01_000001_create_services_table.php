<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('services')) {
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('icon')->default('fa-solid fa-book');
                $table->text('short_desc')->nullable();
                $table->string('tagline')->nullable();
                $table->string('banner_image')->nullable();
                $table->longText('overview')->nullable();
                $table->json('features')->nullable(); // Array of bullet points or feature objects
                $table->json('workflow_steps')->nullable(); // Array of [{ 'step': 1, 'title': '...', 'desc': '...' }]
                $table->text('benefits')->nullable(); // Text or highlights
                $table->text('notes')->nullable(); // Catatan / Disclaimer
                $table->json('pricing_packages')->nullable(); // Optional pricing packages
                $table->json('faqs')->nullable(); // Optional FAQ items
                $table->string('cta_text')->nullable()->default('Konsultasi Sekarang');
                $table->string('cta_url')->nullable();
                $table->integer('order')->default(0);
                $table->enum('status', ['published', 'draft'])->default('published');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
