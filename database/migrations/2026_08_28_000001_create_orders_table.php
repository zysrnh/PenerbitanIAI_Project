<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Customer Info
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->text('customer_address')->nullable();
            
            // Payment & Financial Details
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('fee', 10, 2)->default(0);
            $table->decimal('total_payment', 12, 2)->default(0);
            $table->string('payment_method')->default('qris');
            $table->string('payment_status')->default('pending'); // pending, completed, failed, expired
            
            // Gateway Details
            $table->string('gateway_project')->nullable();
            $table->text('payment_qr_string')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            
            // Order Items & Tracking
            $table->json('items_json')->nullable();
            $table->text('notes')->nullable();
            $table->string('shipping_status')->default('menunggu_proses'); // menunggu_proses, diproses, dikirim, selesai
            $table->string('tracking_number')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
