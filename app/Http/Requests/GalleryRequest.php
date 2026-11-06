<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'club_id' => ['required', 'exists:clubs,id'],
            'event_id' => ['nullable', 'exists:events,id'],
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
        ];
    }
}