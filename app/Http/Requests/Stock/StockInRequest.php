<?php

namespace App\Http\Requests\Stock   ;

use Illuminate\Foundation\Http\FormRequest;

class StockInRequest extends FormRequest
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
            'location_id' => 'required|exists:product_locations,id',
            'description' => 'nullable|string|max:500',
            'provider_id' => 'nullable|exists:providers,id',
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
            'provider_id.exists'   => 'The selected provider is invalid.',
        ];
    }
}