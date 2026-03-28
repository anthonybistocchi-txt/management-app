<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitiesAllRequest extends FormRequest
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
                'uf_id' => 'required|integer',
        ];
    }

        protected function prepareForValidation(): void
        {
            $routeUf = $this->route('uf');

            if ($routeUf !== null) {
                $this->merge(['uf_id' => $routeUf]);
            }
        }

    public function messages(): array
    {
        return [
            'uf_id.required' => 'The UF ID is required.',
        ];
    }
}
