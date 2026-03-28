<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LeadInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $input = $this->all();

        // Basic normalization: trim name/message and phone formatting.
        foreach (['first_name', 'last_name', 'message', 'email', 'phone'] as $key) {
            if (isset($input[$key]) && is_string($input[$key])) {
                $input[$key] = trim($input[$key]);
            }
        }

        if (isset($input['phone']) && is_string($input['phone'])) {
            // Keep + if present, strip other non-digit separators.
            $phone = $input['phone'];
            $phone = str_replace([' ', '-', '(', ')'], '', $phone);
            $phone = preg_replace('/(?!^\\+)[^0-9]/', '', $phone);
            $input['phone'] = $phone;
        }

        // Convert empty strings to null.
        foreach (['property_id', 'project_title', 'email', 'source'] as $key) {
            if (array_key_exists($key, $input) && $input[$key] === '') {
                $input[$key] = null;
            }
        }

        $this->merge($input);
    }

    public function rules(): array
    {
        return [
            'property_id' => ['nullable', 'integer', 'exists:properties,id'],
            'project_title' => ['nullable', 'string', 'max:255'],

            'first_name' => ['required', 'string', 'max:80'],
            'last_name' => ['required', 'string', 'max:80'],

            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:120'],

            'contact_pref' => ['required', 'string', 'in:whatsapp,email'],
            'message' => ['required', 'string', 'max:2000'],

            'source' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $propertyId = $this->input('property_id');
            $projectTitle = $this->input('project_title');
            $source = $this->input('source');

            // For property-detail lead flow, at least one context is required.
            // Home/general contact is allowed without selecting project.
            if ($source === 'property' && empty($propertyId) && empty($projectTitle)) {
                $validator->errors()->add('property_id', 'Pilih properti atau tulis nama proyek.');
            }
        });
    }
}

