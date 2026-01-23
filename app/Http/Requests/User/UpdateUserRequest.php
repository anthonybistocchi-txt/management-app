<?php

namespace  App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
           'id'       => 'nullable|integer|exists:users,id',
           'name'     => 'nullable|string|max:255',
           'username' => 'nullable|string|max:255',
           'email'    => 'nullable|email|max:255|',
           'password' => 'nullable|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists'        => 'The selected user does not exist.',
            'email.email'      => 'The email must be a valid email address.',
            'password.min'     => 'The password must be at least 8 characters.',
        ];
    }
}