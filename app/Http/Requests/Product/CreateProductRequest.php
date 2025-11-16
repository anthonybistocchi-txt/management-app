<?php

namespace App\Http\Requests;

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
            'price'       => 'required|integer|min:0',
            'provider_id' => 'required|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0',
            'location_id' => 'nullable|exists:product_locations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'O nome do produto é obrigatório.',
            'price.required'      => 'O preço é obrigatório.',
            'price.integer'       => 'O preço deve ser um número inteiro',
            'price.min'           => 'O preço não pode ser negativo.',
            'provider_id.required'=> 'O fornecedor é obrigatório.',
            'provider_id.exists'  => 'O fornecedor selecionado é inválido.',
            'quantity.integer'    => 'A quantidade deve ser um número.',
            'location_id.exists'  => 'A localização selecionada é inválida.',
        ];
    }
}