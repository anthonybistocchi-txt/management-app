<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Location;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Provider;

class InOutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'product_id'  => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === "all") return;
                    if (!Product::whereKey($value)->exists()) $fail("The selected product is invalid.");
                },
            ],
            'location_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === "all") return;
                    if (!Location::whereKey($value)->exists()) $fail("The selected location is invalid.");
                },
            ],
            'type' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === "all") return;
                    if (!in_array($value, ["in", "out", "transfer"], true)) {
                        $fail("The selected type is invalid.");
                    }
                },
            ],
            'provider_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === "all") return;
                    if (!Provider::whereKey($value)->exists()) $fail("The selected provider is invalid.");
                },
            ],
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === "all") return;
                    if (!ProductCategory::whereKey($value)->exists()) $fail("The selected category is invalid.");
                },
            ],
            'start'       => 'required|integer|min:0',
            'length'      => 'required|integer|min:1|max:100',
            'date_from'   => 'required|date',
            'date_to'     => 'required|date|after_or_equal:date_from',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'    => 'The product is required.',
            'product_id.exists'      => 'The selected product is invalid.',
            'location_id.required'   => 'The location is required.',
            'location_id.exists'     => 'The selected location is invalid.',
            'type.required'          => 'The type is required.',
            'type.in'                => 'The selected type is invalid.',
            'provider_id.required'   => 'The provider is required.',
            'provider_id.exists'     => 'The selected provider is invalid.',
            'category_id.required'   => 'The category is required.',
            'category_id.exists'     => 'The selected category is invalid.',
            'start.required'         => 'The start is required.',
            'start.integer'          => 'The start must be an integer.',
            'start.min'              => 'The start must be at least 0.',
            'length.required'        => 'The length is required.',
            'length.integer'         => 'The length must be an integer.',
            'length.min'             => 'The length must be at least 1.',
            'length.max'             => 'The length may not be greater than 100.',
            'date_from.required'     => 'The date from is required.',
            'date_from.date'         => 'The date from is not a valid date.',
            'date_to.required'       => 'The date to is required.',
            'date_to.date'           => 'The date to is not a valid date.',
            'date_to.after_or_equal' => 'The date to must be a date after or equal to date from.',
    ];
    }
}
