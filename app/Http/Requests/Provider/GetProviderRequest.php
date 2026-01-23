<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class GetProviderRequest extends FormRequest
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
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:providers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'ids.required'   => 'The provider IDDs are required.',
            'ids.array'      => 'The provider IDs must be an array.',
            'ids.*.integer'  => 'Each provider ID must be an integer.',
            'ids.*.exists'   => 'One or more specified providers do not exist.',
        ];
    }
}
