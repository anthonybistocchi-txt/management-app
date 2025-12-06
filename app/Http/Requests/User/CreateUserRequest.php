<?php

namespace App\Http\Requests\User;

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
            'name.required'         => 'The name field is required.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'The email must be a valid email address.',
            'email.unique'          => 'The email has already been taken.',
            'password.required'     => 'The password field is required.',
            'password.min'          => 'The password must be at least 8 characters.', 
            'type_user_id.required' => 'The user type field is required.',
            'type_user_id.exists'   => 'The selected user type is invalid.',
            'cpf.required'          => 'The CPF field is required.',
            'cpf.unique'            => 'The CPF has already been taken.',
];
    }
}