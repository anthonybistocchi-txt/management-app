<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetIdsUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ids'   => 'required',
            'ids.*' => 'integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required'   => 'The ids field is required.',
            'ids.*.integer'  => 'Each id must be an integer.',
            'ids.*.exists'   => 'One or more ids do not exist in the users table.',
        ];
    }
}
