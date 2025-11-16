<?php

namespace  App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'         => 'sometimes|required|string|max:255',
            'email'        => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],
            'password'     => 'sometimes|string|min:8', 
            'type_user_id' => 'sometimes|required|integer|exists:type_user,id',
            'is_active'    => ['sometimes', 'required', Rule::in(['0', '1', 0, 1, true, false])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'O nome é obrigatório.',
            'email.required'        => 'O e-mail é obrigatório.',
            'email.email'           => 'O e-mail informado é inválido.',
            'email.unique'          => 'Este e-mail já está cadastrado.',
            'password.min'          => 'A nova senha deve ter no mínimo 8 caracteres.',
            'type_user_id.required' => 'O tipo de usuário é obrigatório.',
            'type_user_id.exists'   => 'O tipo de usuário selecionado é inválido.',
            'is_active.in'          => 'O valor para "ativo" é inválido (aceito: 0 ou 1).',
        ];
    }
}