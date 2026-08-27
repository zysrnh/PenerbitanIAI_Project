<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];

    /**
     * Relationship to User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship to Book.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Extract numeric integer price from book price string (e.g. "Rp 75.000" -> 75000).
     */
    public function getNumericPriceAttribute(): int
    {
        if (!$this->book || empty($this->book->price)) {
            return 0;
        }

        $raw = preg_replace('/[^0-9]/', '', (string)$this->book->price);
        return (int)$raw;
    }

    /**
     * Calculate subtotal for this cart item.
     */
    public function getSubtotalAttribute(): int
    {
        return $this->numeric_price * (int)$this->quantity;
    }

    /**
     * Formatted unit price.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->numeric_price, 0, ',', '.');
    }

    /**
     * Formatted subtotal price.
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
