<?php

namespace App\Http\Requests\Reports\Exports;

use App\Models\Location;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validação dos filtros para o download (CSV/PDF) do relatório
 * "Ficha de Estoque".
 */
class StockCardExportRequest extends FormRequest
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
                    if (!Product::whereKey($value)->exists()) {
                        $fail('The selected product is invalid.');
                    }
                },
            ],
            'location_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value === 'all') return;
                    if (!Location::whereKey($value)->exists()) {
                        $fail('The selected location is invalid.');
                    }
                },
            ],
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
        ];
    }
}
