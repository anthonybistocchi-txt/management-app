<?php

namespace App\Http\Requests\Provider;

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
            'name.required'  => 'O nome do fornecedor é obrigatório.',
            'cnpj.required'  => 'O CNPJ é obrigatório.',
            'cnpj.max'       => 'O CNPJ deve ter no máximo 21 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'O e-mail informado é inválido.',
            'email.unique'   => 'Este e-mail já está em uso por outro fornecedor.',
            'state.max'      => 'O estado deve ter no máximo 2 caracteres (ex: SP).',
            'cep.max'        => 'O CEP deve ter no máximo 10 caracteres.',
        ];
    }
}