<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class StockCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'  => 'required|exists:products,id',
            'location_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!\App\Models\Location::whereKey($value)->exists()) {
                        $fail('The selected location is invalid.');
                    }
                },
            ],
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
            'start'     => 'required|integer|min:0',
            'length'    => 'required|integer|min:1|max:100',
        ];
    }
}
