<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'sample_pdf',
        'is_new_release',
        'is_best_seller',
        'order',
        'status',
    ];

    protected $casts = [
        'is_new_release' => 'boolean',
        'is_best_seller' => 'boolean',
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
}
