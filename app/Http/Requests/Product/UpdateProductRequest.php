<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|string', 
            'price'       => 'sometimes|numeric|decimal:0,2|min:0',
            'provider_id' => 'sometimes|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0', 
            'location_id' => 'nullable|exists:locations,id',
            'address'     => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'state'       => 'nullable|string|max:255',
            'cep'         => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
       return [
            'price.min'          => 'The price cannot be negative.',
            'provider_id.exists' => 'The selected provider is invalid.',
            'quantity.integer'   => 'The quantity must be an integer.',
            'location_id.exists' => 'The selected location is invalid.',
        ];
    }
}