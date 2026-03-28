<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PropertySearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $input = $this->all();

        // Convert empty strings from HTML selects into null so `nullable` rules behave.
        foreach (['search', 'category', 'type', 'status', 'city', 'min_price', 'max_price', 'price_range', 'sort'] as $key) {
            if (array_key_exists($key, $input) && $input[$key] === '') {
                $input[$key] = null;
            }
        }

        // Support hero filter (price_range) by mapping it into min_price/max_price
        // so existing controller query logic continues to work.
        if (!empty($input['price_range']) && (empty($input['min_price']) && empty($input['max_price']))) {
            $pr = Str::lower((string) $input['price_range']);
            $pr = str_replace(['&lt;', '&gt;'], ['<', '>'], $pr);

            // Examples from UI: "< 500 jt", "500 jt - 1 M", "1 M - 2 M", "> 2 M"
            if (Str::contains($pr, '<') && Str::contains($pr, '500')) {
                $input['max_price'] = 500000000; // 500 jt
                $input['min_price'] = null;
            } elseif (Str::contains($pr, '500') && Str::contains($pr, '1')) {
                $input['min_price'] = 500000000;  // 500 jt
                $input['max_price'] = 1000000000; // 1 M
            } elseif (Str::contains($pr, '1') && Str::contains($pr, '2')) {
                $input['min_price'] = 1000000000; // 1 M
                $input['max_price'] = 2000000000; // 2 M
            } elseif (Str::contains($pr, '>') && Str::contains($pr, '2')) {
                $input['min_price'] = 2000000000; // 2 M
                $input['max_price'] = null;
            }
        }

        $this->merge($input);
    }

    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
            'type' => ['nullable', 'string', 'in:rumah,tanah,apartemen,ruko'],
            'status' => ['nullable', 'string', 'in:dijual,disewakan'],
            'city' => ['nullable', 'string', 'max:100'],

            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'price_range' => ['nullable', 'string', 'max:50'],

            'sort' => ['nullable', 'string', 'in:latest,price_low,price_high'],
        ];
    }
}

