<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClubRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $club = $this->route('club');

        return [
            'name' => ['required', 'string', 'max:255'],
            'short_name' => ['required', 'string', 'max:30', Rule::unique('clubs', 'short_name')->ignore($club?->id)],
            'description' => ['required', 'string'],
            'mission' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'banner' => ['nullable', 'image', 'max:4096'],
            'advisor_id' => ['nullable', 'exists:users,id'],
            'category' => ['required', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ];
    }
}