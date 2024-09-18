<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'country_id'=>'required|exists:countries,id'
        ];
    }

    public function messages(): array
    {
        return [
            'country_id.required' => 'The country field is required.',
            'country_id.exists' => 'The selected country does not exist.',
            'title_en.required' => 'The title (English) is required.',
            'title_en.string' => 'The title (English) must be a valid string.',
            'title_en.max' => 'The title (English) field must not be greater than 125 characters.',
            'title_ar.required' => 'The title (Arabic) is required.',
            'title_ar.string' => 'The title (Arabic) must be a valid string.',
            'title_ar.max' => 'The title (Arabic) field must not be greater than 125 characters.',
        ];
    }
}
