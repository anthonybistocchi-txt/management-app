<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:products,id' 
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The field id is required.',
            'id.integer'  => 'The field id must be an integer.',
            'id.exists'   => 'The product with the provided id does not exist.',
        ];
    }
}