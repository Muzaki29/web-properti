<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyImageUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images' => ['required', 'array', 'min:1', 'max:10'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'], // max 5MB per file

            // Admin/public UI uses this checkbox name.
            'set_first_as_primary' => ['nullable', 'boolean'],

            // Some legacy controller logic might read `is_primary` — allow it so validation doesn't reject.
            'is_primary' => ['nullable', 'integer', 'min:0', 'max:9'],
        ];
    }
}

