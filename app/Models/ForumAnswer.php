<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_question_id',
        'user_id',
        'name',
        'email',
        'answer',
        'is_official',
    ];

    protected $casts = [
        'is_official' => 'boolean',
    ];

    public function forumQuestion()
    {
        return $this->belongsTo(ForumQuestion::class, 'forum_question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
