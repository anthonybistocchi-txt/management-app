<!-- <?php

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
            'from_location_id' => 'required|exists:locations,id',
            'to_location_id'   => 'required|exists:locations,id|different:from_location_id',
            'description'      => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
       return [
            'product_id.required'       => 'The product is required.',
            'quantity.required'         => 'The quantity is required.',
            'quantity.min'              => 'The quantity must be at least 1.',
            'from_location_id.required' => 'The source location is required.',
            'from_location_id.exists'   => 'The selected source location is invalid.',
            'to_location_id.required'   => 'The destination location is required.',
            'to_location_id.exists'     => 'The selected destination location is invalid.',
            'to_location_id.different'  => 'The destination location must be different from the source.',
        ];
    }
} 