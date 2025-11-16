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
            'price'       => 'sometimes|integer|min:0',
            'provider_id' => 'sometimes|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0', 
            'location_id' => 'nullable|exists:product_locations,id',
            'address'     => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'state'       => 'nullable|string|max:255',
            'cep'         => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'price.integer'      => 'O preço deve ser um número inteiro (ex: 1000 para R$ 10,00).',
            'price.min'          => 'O preço não pode ser negativo.',
            'provider_id.exists' => 'O fornecedor selecionado é inválido.',
            'quantity.integer'   => 'A quantidade deve ser um número.',
            'location_id.exists' => 'A localização selecionada é inválida.',
        ];
    }
}