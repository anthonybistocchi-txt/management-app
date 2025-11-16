<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StockTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'       => 'required|exists:products,id',
            'quantity'         => 'required|integer|min:1',
            'from_location_id' => 'required|exists:product_locations,id',
            'to_location_id'   => 'required|exists:product_locations,id|different:from_location_id',
            'description'      => 'nullable|string|max:500',
            'type'             => 'required|in:transfer',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'       => 'O produto é obrigatório.',
            'quantity.required'         => 'A quantidade é obrigatória.',
            'quantity.min'              => 'A quantidade deve ser no mínimo 1.',
            'from_location_id.required' => 'A localização de origem é obrigatória.',
            'from_location_id.exists'   => 'A localização de origem é inválida.',
            'to_location_id.required'   => 'A localização de destino é obrigatória.',
            'to_location_id.exists'     => 'A localização de destino é inválida.',
            'to_location_id.different'  => 'A localização de destino deve ser diferente da origem.',
            'type.in'                   => 'O tipo de operação é inválido (deve ser "transfer").',
        ];
    }
}