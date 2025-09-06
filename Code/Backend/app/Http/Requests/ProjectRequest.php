<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => ['required','string', 'max:50'],
            'description' => ['required','string', 'max:150'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date'],
            'homepage_url' => ['required','string']
        ];
    }
}
