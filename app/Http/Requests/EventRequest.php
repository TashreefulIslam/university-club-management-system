<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $event = $this->route('event');

        return [
            'club_id' => ['required', 'exists:clubs,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'venue' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'registration_deadline' => ['nullable', 'date'],
            'maximum_participants' => ['nullable', 'integer', 'min:1'],
            'banner' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', Rule::in(['upcoming', 'running', 'completed', 'cancelled'])],
        ];
    }
}