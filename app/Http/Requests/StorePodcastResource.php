<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePodcastResource extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
       
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'audio_file' => ['nullable', 'file', 'mimes:mp3,wav,mpeg'],
            'created_by' => ['required', 'exists:users,id'],
            'you_tube_embed_url'=>['nullable']
        ];
  
    }
}
