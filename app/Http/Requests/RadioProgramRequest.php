<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadioProgramRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date|after_or_equal:now|before_or_equal:end_time',
            'end_time' => 'required|date|after:start_time',        
            'stream_url' => 'nullable|url',
            'recorded_file' => 'nullable|file|mimes:mp3,wav,mp4'
        ];
    }

    public function messages()
    {
        return [
            'start_time.after_or_equal' => 'Start time cannot be in the past.',
            'start_time.before_or_equal' => 'Start time must be before end time.',
            'end_time.after' => 'End time must be after start time.',
        ];
    }
}
