<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RadioProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'stream_url',
        'recorded_file',
        'created_by',
    ];

    protected $casts = [
        'start_time'=>'datetime',
        'end_time'=>'datetime'
    ];

    protected $appends = ['status','is_live','is_ended','is_upcoming'];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function lessonPlans()
    {
        return $this->hasMany(LessonPlan::class,'radio_program_id');
    }

 

    public function getStatusAttribute()
    {
        $now = Carbon::now();

        if ($this->end_time && $now->greaterThan($this->end_time)) {
            return 'ended';
        }

        if ($this->start_time && $this->end_time && $now->between($this->start_time, $this->end_time)) {
            return 'live';
        }

        if ($this->start_time && $now->lessThan($this->start_time)) {
            return 'upcoming';
        }

        return 'scheduled';
    }

    public function getIsLiveAttribute()
    {
        $now = now();
        return $this->start_time && $this->end_time && $now->between($this->start_time, $this->end_time);
    }

    public function getIsEndedAttribute()
    {
        return $this->end_time && now()->greaterThan($this->end_time);
    }

    public function getIsUpcomingAttribute()
    {
        return $this->start_time && now()->lessThan($this->start_time);
    }
}
