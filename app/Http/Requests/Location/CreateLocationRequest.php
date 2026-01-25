<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocationRequest extends FormRequest
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
            'name'    => 'required|string|max:255|unique:locations,name',
            'address' => 'required|string|max:500',
            'city'    => 'required|string|max:100',
            'state'   => 'required|string|max:100',
            'cep'     => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'The location name is required.',
            'name.string'      => 'The location name must be a string.',
            'name.max'         => 'The location name may not be greater than 255 characters.',
            'name.unique'      => 'The location name has already been taken.',
            'address.required' => 'The address is required.',
            'address.string'   => 'The address must be a string.',
            'address.max'      => 'The address may not be greater than 500 characters.',
            'city.required'    => 'The city is required.',
            'city.string'      => 'The city must be a string.',
            'city.max'         => 'The city may not be greater than 100 characters.',
            'state.required'   => 'The state is required.',
            'state.string'     => 'The state must be a string.',
            'state.max'        => 'The state may not be greater than 100 characters.',
            'cep.required'     => 'The CEP is required.',
            'cep.string'       => 'The CEP must be a string.',
            'cep.max'          => 'The CEP may not be greater than 20 characters.',
        ];
    }
}
