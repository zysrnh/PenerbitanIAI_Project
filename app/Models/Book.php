<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'category',
        'isbn',
        'kdt',
        'year',
        'pages',
        'format',
        'price',
        'synopsis',
        'cover_image',
        'back_cover_image',
        'inside_preview_image',
        'additional_image',
        'gallery',
        'sample_pdf',
        'is_new_release',
        'is_best_seller',
        'order',
        'status',
    ];

    protected $casts = [
        'is_new_release' => 'boolean',
        'is_best_seller' => 'boolean',
        'gallery' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            if (empty($book->slug)) {
                $book->slug = Str::slug($book->title) . '-' . Str::random(5);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeNewReleases($query)
    {
        return $query->where('is_new_release', true);
    }

    public function scopeBestSellers($query)
    {
        return $query->where('is_best_seller', true);
    }

    // Helper to get all available photo URLs
    public function getPhotoUrlsAttribute(): array
    {
        $photos = [];
        if ($this->cover_image && Storage::disk('public')->exists($this->cover_image)) {
            $photos['Sampul Depan'] = asset('storage/' . $this->cover_image);
        }
        if ($this->back_cover_image && Storage::disk('public')->exists($this->back_cover_image)) {
            $photos['Sampul Belakang'] = asset('storage/' . $this->back_cover_image);
        }
        if ($this->inside_preview_image && Storage::disk('public')->exists($this->inside_preview_image)) {
            $photos['Daftar Isi / Halaman'] = asset('storage/' . $this->inside_preview_image);
        }
        if ($this->additional_image && Storage::disk('public')->exists($this->additional_image)) {
            $photos['Foto Fisik Buku'] = asset('storage/' . $this->additional_image);
        }
        return $photos;
    }
}
