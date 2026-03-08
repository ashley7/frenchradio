<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePodcastRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'audio_file' => ['nullable', 'file', 'mimes:mp3,wav,mpeg'],
            'created_by' => ['sometimes', 'exists:users,id'],
        ];
    }
}
