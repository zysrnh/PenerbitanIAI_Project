<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'sender_type',
        'sender_name',
        'message',
        'shared_shipping_status',
        'shared_tracking_number',
        'is_read_by_admin',
        'is_read_by_customer',
    ];

    protected $casts = [
        'is_read_by_admin'    => 'boolean',
        'is_read_by_customer' => 'boolean',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at->format('d M Y, H:i') . ' WIB';
    }
}
