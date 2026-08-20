<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', Rule::unique('projects', 'slug')->ignore($this->route('project'))],
            'description' => ['required', 'string'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'year' => ['nullable', 'string', 'max:10'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['exists:skills,id'],
        ];
    }
}