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
            'location_id' => 'required|exists:product_locations,id',
            'description' => 'nullable|string|max:500',
            'type'        => 'required|in:out',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'  => 'O produto é obrigatório.',
            'product_id.exists'    => 'O produto informado não existe.',
            'quantity.required'    => 'A quantidade é obrigatória.',
            'quantity.min'         => 'A quantidade deve ser no mínimo 1.',
            'location_id.required' => 'A localização é obrigatória.',
            'location_id.exists'   => 'A localização informada é inválida.',
            'type.in'              => 'O tipo de operação é inválido (deve ser "out").',
        ];
    }
}