<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
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
            'id'      => 'required|integer|exists:locations,id',
            'name'    => 'nullable|string|max:255|unique:locations,name,',
            'address' => 'nullable|string|max:500',
            'city'    => 'nullable|string|max:100',
            'state'   => 'nullable|string|max:100',
            'cep'     => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'      => 'The location ID is required.',
            'id.integer'       => 'The location ID must be an integer.',
            'id.exists'        => 'The specified location does not exist.',
            'name.string'      => 'The location name must be a string.',
            'name.max'         => 'The location name may not be greater than 255 characters.',
            'name.unique'      => 'The location name has already been taken.',
            'address.string'   => 'The address must be a string.',
            'address.max'      => 'The address may not be greater than 500 characters.',
            'city.string'      => 'The city must be a string.',
            'city.max'         => 'The city may not be greater than 100 characters.',
            'state.string'     => 'The state must be a string.',
            'state.max'        => 'The state may not be greater than 100 characters.',
            'cep.string'       => 'The CEP must be a string.',
            'cep.max'          => 'The CEP may not be greater than 20 characters.',
        ];
    }
}
