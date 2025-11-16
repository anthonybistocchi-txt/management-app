<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8',
            'type_user_id' => 'required|integer|exists:type_user,id',
            'cpf'          => 'required|string|max:14|unique:users',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O nome é obrigatório.',
            'email.required'        => 'O e-mail é obrigatório.',
            'email.email'           => 'O e-mail informado é inválido.',
            'email.unique'          => 'Este e-mail já está cadastrado.',
            'password.required'     => 'A senha é obrigatória.',
            'password.min'          => 'A senha deve ter no mínimo 8 caracteres.',
            'type_user_id.required' => 'O tipo de usuário é obrigatório.',
            'type_user_id.exists'   => 'O tipo de usuário selecionado é inválido.',
            'cpf.required'          => 'O CPF é obrigatório.',
            'cpf.unique'            => 'Este CPF já está cadastrado.',
        ];
    }
}