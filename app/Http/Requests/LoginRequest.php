<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    // Permite que qualquer um tente validar (pode ser true)
    public function authorize(): bool
    {
        return true; 
    }

    // Regras de validação de FORMATO
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'O campo email precisa ser preenchido.',
            'email.email'       => 'Por favor, insira um e-mail válido.',
            'password.required' => 'O campo senha precisa ser preenchido.',
        ];
    }
}