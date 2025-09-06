<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pro_SkilRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'project_id' => ['required', 'integer', 'min:1', 'exists:projects,id'],
            'skill_id' => ['required', 'integer', 'min:1', 'exists:skills,id']
        ];
    }
}
