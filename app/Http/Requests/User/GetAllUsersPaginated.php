<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetAllUsersPaginated extends FormRequest
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
            'skip' => 'nullable|integer|min:0',
            'take' => 'nullable|integer|min:1|max:100', 
        ];
    }

    public function messages(): array
    {
        return [
            'skip.integer'  => 'The skip parameter must be an integer.',
            'skip.min'      => 'The skip parameter must be at least 0.',
            'take.integer'  => 'The take parameter must be an integer.',
            'take.min'      => 'The take parameter must be at least 1.',
            'take.max'      => 'The take parameter may not be greater than 100.',
        ];
    }
}
