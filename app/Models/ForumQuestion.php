<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ForumQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'category',
        'title',
        'slug',
        'question',
        'answer',
        'answered_by',
        'answered_by_id',
        'answered_at',
        'status',
        'is_published',
        'views_count',
    ];

    protected $casts = [
        'answered_at' => 'datetime',
        'is_published' => 'boolean',
        'views_count' => 'integer',
    ];

    public static function getCategories(): array
    {
        return [
            'Fiqih Ibadah',
            'Muamalah & Ekonomi Syariah',
            'Munakahat (Pernikahan & Keluarga)',
            'Aqidah & Akhlak',
            'Hukum Kontemporer',
            'Thaharah & Shalat',
            'Zakat & Wakaf',
            'Lainnya',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            if (empty($item->slug)) {
                $baseSlug = Str::slug($item->title);
                if (empty($baseSlug)) {
                    $baseSlug = 'tanya-jawab-' . time();
                }
                $slug = $baseSlug;
                $count = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $item->slug = $slug;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answeredByUser()
    {
        return $this->belongsTo(User::class, 'answered_by_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeAnswered($query)
    {
        return $query->where('status', 'answered');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getCategoryBadgeClassAttribute(): string
    {
        return match ($this->category) {
            'Fiqih Ibadah' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            'Muamalah & Ekonomi Syariah' => 'bg-blue-50 text-blue-800 border-blue-200',
            'Munakahat (Pernikahan & Keluarga)' => 'bg-rose-50 text-rose-800 border-rose-200',
            'Aqidah & Akhlak' => 'bg-amber-50 text-amber-800 border-amber-200',
            'Hukum Kontemporer' => 'bg-purple-50 text-purple-800 border-purple-200',
            'Thaharah & Shalat' => 'bg-teal-50 text-teal-800 border-teal-200',
            default => 'bg-slate-100 text-slate-800 border-slate-200',
        };
    }
}
