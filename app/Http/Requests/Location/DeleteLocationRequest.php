<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLocationRequest extends FormRequest
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
            'id' => 'required|integer|exists:locations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The location ID is required.',
            'id.integer'  => 'The location ID must be an integer.',
            'id.exists'   => 'The specified location does not exist.',
        ];
    }
}
