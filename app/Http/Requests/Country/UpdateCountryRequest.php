<?php

namespace App\Http\Requests\Country;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'title_en' => 'required|string|max:125',
            'title_ar' => 'required|string|max:125',
            'image' =>  'nullable|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'code' => 'nullable|string|max:125',
            'phone_code' => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'title_en.required' => 'The title (English) is required.',
            'title_en.string' => 'The title (English) must be a valid string.',
            'title_en.max' => 'The title (English) field must not be greater than 125 characters.',
            'title_ar.required' => 'The title (Arabic) is required.',
            'title_ar.string' => 'The title (Arabic) must be a valid string.',
            'title_ar.max' => 'The title (Arabic) field must not be greater than 125 characters.',
            'code.string' => 'The code must be a valid string.',
            'code.max' => 'The code field must not be greater than 125 characters.',
            'phone_code.numeric' => 'The phone code field must be a number.',
        ];
    }
}
