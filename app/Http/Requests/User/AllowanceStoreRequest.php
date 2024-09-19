<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AllowanceStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => 'required|string',
            'name_ar' => 'nullable|string',
            'currency_id' => 'nullable|exists:currencies,id',
            'note_en' => 'nullable|string',
            'note_ar' => 'nullable|string',
            'percent' => 'nullable|numeric',
            'type_of_operation' => 'nullable|in:0,1',
            'maximum' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => 'The allowance name in English is required.',
            'name_en.string' => 'The allowance name in English must be a string.',
            'name_ar.string' => 'The allowance name in Arabic must be a string.',
            'currency_id.exists' => 'The currency must be a valid currency.',
            'note_en.string' => 'The note in English must be a string.',
            'note_ar.string' => 'The note in Arabic must be a string.',
            'percent.numeric' => 'The percent must be a valid number.',
            'type_of_operation.in' => 'The type of operation must be either 0 (minus) or 1 (plus).',
            'maximum.numeric' => 'The maximum allowance must be a number.',
        ];
    }
}
