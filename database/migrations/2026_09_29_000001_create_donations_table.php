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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('digital_book_id')->nullable()->index();
            $table->string('donor_name');
            $table->string('donor_phone', 50)->nullable();
            $table->string('donor_email')->nullable();
            $table->decimal('amount', 14, 2)->default(0);
            $table->string('payment_method', 30)->default('qris'); // 'qris' or 'transfer'
            $table->string('bank_name', 100)->nullable();
            $table->string('proof_image')->nullable();
            $table->text('notes')->nullable();
            $table->string('status', 30)->default('pending'); // 'pending', 'confirmed'
            $table->timestamps();

            $table->foreign('digital_book_id')
                ->references('id')
                ->on('digital_books')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
