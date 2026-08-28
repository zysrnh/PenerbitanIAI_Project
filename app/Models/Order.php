<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_amount',
        'fee',
        'total_payment',
        'payment_method',
        'payment_status',
        'gateway_project',
        'payment_qr_string',
        'paid_at',
        'expired_at',
        'items_json',
        'notes',
        'shipping_status',
        'tracking_number',
    ];

    protected $casts = [
        'items_json'    => 'array',
        'paid_at'       => 'datetime',
        'expired_at'    => 'datetime',
        'total_amount'  => 'float',
        'fee'           => 'float',
        'total_payment' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedPaymentAttribute(): string
    {
        return 'Rp ' . number_format($this->total_payment, 0, ',', '.');
    }

    public function getFormattedFeeAttribute(): string
    {
        return 'Rp ' . number_format($this->fee, 0, ',', '.');
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'completed';
    }
}
