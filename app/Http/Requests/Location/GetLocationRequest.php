<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetLocationRequest extends FormRequest
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
            'id' => 'required|array|exists:locations,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The location ID is required.',
            'id.array'    => 'The location ID must be an array.',
            'id.exists'   => 'The specified location does not exist.',
        ];
    }
}
