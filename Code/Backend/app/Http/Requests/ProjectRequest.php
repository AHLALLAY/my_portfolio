<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => ['required','string', 'max:100'],
            'description' => ['required','string', 'max:500'],
            'start_date' => ['required','date'],
            'end_date' => ['nullable','date', 'after_or_equal:start_date'],
            'homepage_url' => ['nullable','url'],
            'image_url' => ['nullable','url'],
            'status' => ['nullable','in:completed,in_progress,planned']
        ];
    }
}
