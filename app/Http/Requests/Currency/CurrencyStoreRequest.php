<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
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
            'symbol' => 'nullable|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required' => 'Currency name (English) is required.',
            'name_en.string' => 'Currency name (English) must be a string.',
            'name_ar.string' => 'Currency name (Arabic) must be a string.',
            'symbol.string' => 'Currency symbol must be a string.',
            'symbol.max' => 'Currency symbol must not exceed 10 characters.',
        ];
    }
}
