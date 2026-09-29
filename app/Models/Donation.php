<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'digital_book_id',
        'donor_name',
        'donor_phone',
        'donor_email',
        'amount',
        'payment_method',
        'bank_name',
        'proof_image',
        'notes',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Relationship to DigitalBook
     */
    public function digitalBook()
    {
        return $this->belongsTo(DigitalBook::class, 'digital_book_id');
    }

    /**
     * Formatted Indonesian Rupiah
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->amount, 0, ',', '.');
    }

    /**
     * Get accessible URL for proof of transfer
     */
    public function getProofUrlAttribute(): ?string
    {
        if (empty($this->proof_image)) {
            return null;
        }

        if (Str::startsWith($this->proof_image, ['http://', 'https://', '/'])) {
            return $this->proof_image;
        }

        return asset('storage/' . $this->proof_image);
    }
}
