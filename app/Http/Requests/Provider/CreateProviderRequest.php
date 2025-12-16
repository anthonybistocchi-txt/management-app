<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'cnpj'    => 'required|string|max:21|unique:providers', 
            'phone'   => 'nullable|string|max:20',
            'email'   => 'required|string|email|max:255|unique:providers',
            'street'  => 'required|string|max:255',
            'number'  => 'required|string|max:20',
            'city'    => 'required|string|max:255',
            'state'   => 'required|string|max:2',
            'cep'     => 'required|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'The provider name is required.',
            'cnpj.required'  => 'The CNPJ is required.',
            'cnpj.max'       => 'The CNPJ may not be greater than 21 characters.',
            'email.required' => 'The email field is required.',
            'email.email'    => 'The email must be a valid email address.',
            'email.unique'   => 'This email is already in use by another provider.',
            'state.max'      => 'The state may not be greater than 2 characters (e.g., NY).',
            'cep.max'        => 'The Zip Code may not be greater than 10 characters.',
        ];
    }
}