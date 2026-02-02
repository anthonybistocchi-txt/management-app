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
            'start'         => 'required|integer|min:0',
            'length'        => 'required|integer|min:1|max:100', 
        ];
    }

    public function messages(): array
    {
        return [
            'operator_type.in' => 'The operator type must be one of the following: 1, 2, 3, all.',
            'search.string'    => 'The search parameter must be a string.',
            'search.max'       => 'The search parameter may not be greater than 255 characters.',
            'start.integer'    => 'The start parameter must be an integer.',
            'start.min'        => 'The start parameter must be at least 0.',
            'length.integer'   => 'The length parameter must be an integer.',
            'length.min'       => 'The length parameter must be at least 1.',
            'length.max'       => 'The length parameter may not be greater than 100.',
            'active.in'        => 'The active parameter must be one of the following: 0, 1, all.',
        ];
    }
}
