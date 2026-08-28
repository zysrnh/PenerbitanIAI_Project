<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->string('sender_type')->default('customer'); // customer, admin, system
            $table->string('sender_name')->nullable();
            $table->text('message');
            
            // Optional shipping status update event attached to message
            $table->string('shared_shipping_status')->nullable(); // menunggu_proses, diproses, dikirim, selesai
            $table->string('shared_tracking_number')->nullable();
            
            $table->boolean('is_read_by_admin')->default(false);
            $table->boolean('is_read_by_customer')->default(false);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_messages');
    }
};
