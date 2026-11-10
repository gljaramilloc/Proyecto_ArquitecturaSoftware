<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for creating a category.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:categories,slug'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
        ];
    }
}
