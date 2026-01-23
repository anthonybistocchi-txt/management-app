<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class DeleteProviderRequest extends FormRequest
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
            'id' => 'required|integer|exists:providers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The provider ID is required.',
            'id.integer'  => 'The provider ID must be an integer.',
            'id.exists'   => 'The specified provider does not exist.',
        ];
    }
}
