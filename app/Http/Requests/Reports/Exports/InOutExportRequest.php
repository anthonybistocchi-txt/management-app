<?php

namespace App\Http\Requests\Reports\Exports;

use App\Models\Location;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validação dos filtros enviados quando o utilizador pede o
 * download (CSV/PDF) do relatório "Entrada e Saída".
 *
 * Mantém as mesmas regras do {@see \App\Http\Requests\Reports\InOutRequest}
 * mas remove `start` e `length` — o export devolve sempre o conjunto
 * completo de linhas que casam com os filtros.
 */
class InOutExportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id'  => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!Product::whereKey($value)->exists()) $fail('The selected product is invalid.');
                },
            ],
            'location_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!Location::whereKey($value)->exists()) $fail('The selected location is invalid.');
                },
            ],
            'type' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!in_array($value, ['in', 'out', 'transfer'], true)) {
                        $fail('The selected type is invalid.');
                    }
                },
            ],
            'provider_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!Provider::whereKey($value)->exists()) $fail('The selected provider is invalid.');
                },
            ],
            'category_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!ProductCategory::whereKey($value)->exists()) $fail('The selected category is invalid.');
                },
            ],
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
        ];
    }
}
