<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!\App\Models\ProductCategory::whereKey($value)->exists()) {
                        $fail('The selected category is invalid.');
                    }
                },
            ],
            'location_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!\App\Models\Location::whereKey($value)->exists()) {
                        $fail('The selected location is invalid.');
                    }
                },
            ],
            'start'  => 'required|integer|min:0',
            'length' => 'required|integer|min:1|max:100',
        ];
    }
}
