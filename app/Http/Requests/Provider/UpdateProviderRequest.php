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
        // Pega o ID do provedor pela rota (ex: /providers/5)
        // Certifique-se que o nome do parâmetro na sua rota é 'provider'
        $providerId = $this->route('provider'); 

        return [
            'name'            => 'sometimes|string|max:255',
            'cnpj'            => 'sometimes|string|max:21',
            'phone'           => 'sometimes|nullable|string|max:20',
            'email'           => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('providers')->ignore($providerId)
            ],
            'is_active' => 'sometimes|boolean',
            'street'    => 'sometimes|nullable|string|max:255',
            'number'    => 'sometimes|nullable|string|max:20',
            'city'      => 'sometimes|nullable|string|max:255',
            'state'     => 'sometimes|nullable|string|max:2',
            'cep'       => 'sometimes|nullable|string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'The email field is required.',
            'email.email'       => 'The email must be a valid email address.',
            'email.unique'      => 'This email is already in use by another provider.',
            'state.max'         => 'The state may not be greater than 2 characters (e.g., NY).',
            'is_active.boolean' => 'The active field must be true or false (1 or 0).',
        ];
    }
}