<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajuste conforme sua regra de permissão
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|decimal:0,2|min:0',
            'provider_id' => 'required|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0',
            // 'location_id' => 'nullable|exists:product_locations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'The product name is required.',
            'price.required'       => 'The price is required.',
            'price.numeric'        => 'The price must be a number.', // Ajustado de integer para numeric
            'price.min'            => 'The price cannot be negative.',
            'provider_id.required' => 'The provider is required.',
            'provider_id.exists'   => 'The selected provider is invalid.',
            'quantity.integer'     => 'The quantity must be an integer.',
            // 'location_id.exists'   => 'The selected location is invalid.',
        ];
    }
}