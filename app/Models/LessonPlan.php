<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'radio_program_id',
        'title',
        'learning_objectives',
        'content',
        'activities',
        'assessment',
        'downloadable_material'
    ];

    public function program()
    {
        return $this->belongsTo(RadioProgram::class,'radio_program_id');
    }
}
