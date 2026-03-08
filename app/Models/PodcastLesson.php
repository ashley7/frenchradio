<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PodcastLesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'podcast_id',
        'key_themes',
        'learning_outcomes',
        'practical_applications',
    ];

     public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }

    public function questions()
    {
        return $this->hasMany(DiscussionQuestion::class, 'podcast_lesson_id');
    }
}
