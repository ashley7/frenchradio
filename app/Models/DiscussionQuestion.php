<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionQuestion extends Model
{
    use HasFactory;

     protected $fillable = [
        'podcast_lesson_id',
        'question',
    ];

    public function lesson()
    {
        return $this->belongsTo(PodcastLesson::class, 'podcast_lesson_id');
    }
}
