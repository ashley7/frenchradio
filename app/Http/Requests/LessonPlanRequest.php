<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonPlanRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

     
    public function rules(): array
    {
        return [
            'radio_program_id' => 'nullable|exists:radio_programs,id',

            'title' => 'required|string|max:255',

            'learning_objectives' => 'required|string',

            'content' => 'required|string',

            'activities' => 'nullable|string',

            'assessment' => 'nullable|string',

            'downloadable_material' => 'nullable|file|mimes:pdf,doc,docx,mp3,mp4'

        ];
    }
}
