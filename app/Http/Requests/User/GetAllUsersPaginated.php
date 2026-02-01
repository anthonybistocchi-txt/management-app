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
            'operator_type' => 'nullable|string|in:1,2,3,all',
            'active'        => 'nullable|string|in:0,1,all',
            'search'        => 'nullable|string|max:255',
            'skip'          => 'nullable|integer|min:0',
            'take'          => 'nullable|integer|min:1|max:100', 
        ];
    }

    public function messages(): array
    {
        return [
            'operator_type.in' => 'The operator type must be one of the following: 1, 2, 3, all.',
            'search.string'    => 'The search parameter must be a string.',
            'skip.integer'     => 'The skip parameter must be an integer.',
            'skip.min'         => 'The skip parameter must be at least 0.',
            'take.integer'     => 'The take parameter must be an integer.',
            'take.min'         => 'The take parameter must be at least 1.',
            'take.max'         => 'The take parameter may not be greater than 100.',
            'active.in'        => 'The active parameter must be one of the following: 0, 1, all.',
        ];
    }
}
