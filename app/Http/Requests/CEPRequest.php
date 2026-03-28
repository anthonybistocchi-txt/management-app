<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CEPRequest extends FormRequest
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
    protected function prepareForValidation(): void
        {
            $routeCEP = $this->route('cep');

            if ($routeCEP !== null) {
                $this->merge(['cep' => $routeCEP]);
            }
        }

    public function rules(): array
    {
        return [
            'cep'       => 'required|string|size:8',
            'cep.regex' => '/^\d{8}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'cep.required' => 'The CEP is required.',
            'cep.string'   => 'The CEP must be a string.',
            'cep.size'     => 'The CEP must be exactly 8 characters.',
            'cep.regex'    => 'The CEP must consist of exactly 8 digits.',
        ];
    }
}
