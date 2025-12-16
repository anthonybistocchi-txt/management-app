<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
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
            'date_from' => 'date_format:Y-m-d',
            'date_to'   => 'date_format:Y-m-d|after_or_equal:date_from',
        ];
    }

    public function messages(): array
    {
        return [
            'date_from.date_format' => 'The date_from must be in the format Y-m-d .',
            'date_to.date_format'   => 'The date_to must be in the format Y-m-d .',
            'date_to.after_or_equal'=> 'The date_to must be a date after or equal to date_from.',
        ];
    }
}
