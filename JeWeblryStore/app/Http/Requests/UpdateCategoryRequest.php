<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($this->route('category')),
            ],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
        ];
    }
}
