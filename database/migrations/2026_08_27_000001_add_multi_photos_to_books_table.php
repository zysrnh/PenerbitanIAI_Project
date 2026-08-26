<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
            if (!Schema::hasColumn('books', 'sample_pdf')) {
                $table->string('sample_pdf')->nullable()->after('gallery');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $columns = ['back_cover_image', 'inside_preview_image', 'additional_image', 'gallery', 'sample_pdf'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('books', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
