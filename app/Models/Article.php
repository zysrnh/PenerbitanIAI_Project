<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'author_id',
        'thumbnail',
        'excerpt',
        'content',
        'status',
        'is_featured',
        'views_count',
        'tags',
        'published_at',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'views_count'   => 'integer',
        'published_at'  => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $baseSlug = Str::slug($article->title);
                $slug = $baseSlug;
                $counter = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }
                $article->slug = $slug;
            }

            if (empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return max(1, $minutes);
    }

    public function getShareUrlsAttribute()
    {
        $url = route('berita.show', $this->slug);
        $title = urlencode($this->title);
        $encodedUrl = urlencode($url);

        return [
            'whatsapp' => "https://api.whatsapp.com/send?text={$title}%20{$encodedUrl}",
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$encodedUrl}",
            'twitter'  => "https://twitter.com/intent/tweet?text={$title}&url={$encodedUrl}",
            'telegram' => "https://t.me/share/url?url={$encodedUrl}&text={$title}",
            'raw_url'  => $url,
        ];
    }
}
