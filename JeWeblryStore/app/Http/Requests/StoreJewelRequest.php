<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJewelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for creating a jewel.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'status_id' => ['required', 'integer', 'exists:statuses,id'],
            'stock' => ['required', 'integer', 'min:0'],
            'material' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
