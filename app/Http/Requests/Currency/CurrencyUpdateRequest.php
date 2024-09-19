<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => 'nullable|string',
            'name_ar' => 'nullable|string',
            'symbol' => 'nullable|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name_en.string' => 'Currency name (English) must be a string.',
            'name_ar.string' => 'Currency name (Arabic) must be a string.',
            'symbol.string' => 'Currency symbol must be a string.',
            'symbol.max' => 'Currency symbol must not exceed 10 characters.',
        ];
    }
}
