<?php

namespace App\Http\Requests\Reports\Exports;

use App\Models\Location;
use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validação dos filtros para o download (CSV/PDF) do relatório
 * "Giro de Estoque".
 */
class StockTurnoverExportRequest extends FormRequest
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
                    if (!ProductCategory::whereKey($value)->exists()) {
                        $fail('The selected category is invalid.');
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
