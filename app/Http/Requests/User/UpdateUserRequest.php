<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('cpf')) {
            $this->merge([
                'cpf' => preg_replace('/\D/', '', (string) $this->input('cpf')),
            ]);
        }
    }

    public function rules(): array
    {
        $id = (int) $this->input('id');

        return [
            'id'           => 'required|integer|exists:users,id',
            'name'         => 'required|string|max:255',
            'username'     => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($id),
            ],
            'email'        => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'cpf'          => [
                'required',
                'string',
                'size:11',
                Rule::unique('users', 'cpf')->ignore($id),
            ],
            'password'     => 'nullable|string|min:8',
            'type_user_id' => 'required|integer|exists:type_user,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'           => 'The user identifier is required.',
            'id.exists'             => 'The selected user does not exist.',
            'name.required'         => 'The name field is required.',
            'username.required'     => 'The username field is required.',
            'username.unique'       => 'This username is already taken.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'The email must be a valid email address.',
            'email.unique'          => 'This email is already taken.',
            'cpf.required'          => 'The CPF field is required.',
            'cpf.size'              => 'The CPF must be 11 digits.',
            'cpf.unique'            => 'This CPF is already registered.',
            'password.min'          => 'The password must be at least 8 characters.',
            'type_user_id.required' => 'The permission type field is required.',
            'type_user_id.exists'   => 'The selected permission type is invalid.',
        ];
    }
}
