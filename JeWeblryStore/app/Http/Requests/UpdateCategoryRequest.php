<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($this->route('id') ?? $this->route('category')),
            ],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
        ];
    }
}
