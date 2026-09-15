<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'lastNames' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];
    }
}
