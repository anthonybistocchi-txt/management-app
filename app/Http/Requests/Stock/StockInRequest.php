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
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'location_id'   => 'required|exists:locations,id',
            'movement_date' => 'required|date|date_format:Y-m-d H:i:s',
            'description'   => 'nullable|string|max:500',
            'provider_id'   => 'nullable|exists:providers,id',
        ];
    }

    public function messages(): array
    {
       return [
            'product_id.required'       => 'The product is required.',
            'product_id.exists'         => 'The selected product is invalid.',
            'quantity.required'         => 'The quantity is required.',
            'quantity.min'              => 'The quantity must be at least 1.',
            'movement_date.required'    => 'The movement date is required.',
            'movement_date.date'        => 'The movement date is not a valid date.',
            'movement_date.date_format' => 'The movement date does not match the format Y-m-d H:i:s.',
            'location_id.required'      => 'The location is required.',
            'location_id.exists'        => 'The selected location is invalid.',
            'provider_id.exists'        => 'The selected provider is invalid.',
        ];
    }
}