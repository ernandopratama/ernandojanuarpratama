<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('skills', 'name')->ignore($this->route('skill'))],
            'category' => ['required', Rule::in(['Frontend', 'Backend', 'Design', 'Tools & DevOps'])],
            'icon' => ['nullable', 'string', 'max:255'],
            'proficiency' => ['required', 'integer', 'min:0', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}