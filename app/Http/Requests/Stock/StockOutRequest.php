<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StockOutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'location_id' => 'required|exists:locations,id',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'  => 'The product is required.',
            'product_id.exists'    => 'The selected product is invalid.',
            'quantity.required'    => 'The quantity is required.',
            'quantity.min'         => 'The quantity must be at least 1.',
            'location_id.required' => 'The location is required.',
            'location_id.exists'   => 'The selected location is invalid.',
        ];
    }
}