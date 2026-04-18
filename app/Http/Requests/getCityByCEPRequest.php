<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getCityByCEPRequest extends FormRequest
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
            'cep' => 'required|size:8|string'
        ];
    }

    public function messages(): array
    {
        return [
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.size'     => 'O campo CEP deve conter exatamente 8 caracteres.',
            'cep.string'   => 'O campo CEP deve ser uma string.'
        ];
    }
}
