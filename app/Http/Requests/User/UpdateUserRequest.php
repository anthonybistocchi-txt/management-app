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
           'id'           => 'required|integer|exists:users,id',
           'name'         => 'nullable|string|max:255',
           'username'     => 'nullable|string|max:255',
           'email'        => 'nullable|email|max:255|',
           'password'     => 'nullable|string|min:8',
           'type_user_id' => 'nullable|integer|exists:type_users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'         => 'The id field is required.',
            'id.exists'           => 'The selected user does not exist.',
            'email.email'         => 'The email must be a valid email address.',
            'password.min'        => 'The password must be at least 8 characters.',
            'type_user_id.exists' => 'The selected type user does not exist.',
        ];
    }
}