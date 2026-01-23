<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class UpdateProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'email'  => 'nullable|email|',
            'state'  => 'nullable|string|max:2',
            'active' => 'nullable|boolean',
            'phone'  => 'nullable|string',
            'cep'    => 'nullable|string',
            'street'  => 'nullable|string',
            'number'  => 'nullable|string',
            'city'    => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email'        => 'The email must be a valid email address.',
            'state.string'       => 'The state must be a string.',
            'state.max'          => 'The state may not be greater than 2 characters.',
            'active.boolean'     => 'The active field must be true or false.',
            'phone.string'       => 'The phone must be a string.',
            'cep.string'         => 'The cep must be a string.',
            'street.string'      => 'The street must be a string.',
            'number.string'      => 'The number must be a string.',
            'city.string'        => 'The city must be a string.',
        ];
    }
}