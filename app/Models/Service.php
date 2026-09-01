<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'short_desc',
        'tagline',
        'banner_image',
        'overview',
        'features',
        'workflow_steps',
        'benefits',
        'notes',
        'pricing_packages',
        'faqs',
        'cta_text',
        'cta_url',
        'order',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'workflow_steps' => 'array',
        'pricing_packages' => 'array',
        'faqs' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getBannerUrlAttribute()
    {
        if (!$this->banner_image) {
            return 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop';
        }
        if (str_starts_with($this->banner_image, 'http')) {
            return $this->banner_image;
        }
        return asset('storage/' . ltrim($this->banner_image, '/'));
    }
}
