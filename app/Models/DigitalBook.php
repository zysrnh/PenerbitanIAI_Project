<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DigitalBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'category',
        'year',
        'pages',
        'language',
        'synopsis',
        'cover_image',
        'pdf_file',
        'is_featured',
        'order',
        'status',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
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

    public function getCoverUrlAttribute(): ?string
    {
        if (empty($this->cover_image)) {
            return null;
        }
        if (Str::startsWith($this->cover_image, ['http://', 'https://', '/'])) {
            return $this->cover_image;
        }
        return asset('storage/' . $this->cover_image);
    }

    public function getPdfUrlAttribute(): ?string
    {
        if (empty($this->pdf_file)) {
            return null;
        }
        if (Str::startsWith($this->pdf_file, ['http://', 'https://', '/'])) {
            return $this->pdf_file;
        }
        return asset('storage/' . $this->pdf_file);
    }
}
