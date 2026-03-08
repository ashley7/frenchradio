<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Podcast extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'audio_file',
        'created_by',
        'you_tube_embed_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
