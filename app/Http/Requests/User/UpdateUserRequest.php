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
            'username'     => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId)
            ],
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
            'active'       => ['sometimes', 'required', Rule::in(['0', '1', 0, 1, true, false])],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'         => 'The name field is required.',
            'username.required'     => 'The username field is required.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'The email must be a valid email address.',
            'email.unique'          => 'The email has already been taken.',
            'password.min'          => 'The new password must be at least 8 characters.',
            'type_user_id.required' => 'The user type field is required.',
            'type_user_id.exists'   => 'The selected user type is invalid.',
            'active.in'             => 'The active value is invalid (accepted: 0 or 1).',
        ];
    }
}