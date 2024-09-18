<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name_en' => 'required|string|max:125',
            'name_ar' => 'required|string|max:125',
            'logo' =>  'nullable|mimes:jpeg,png,jpg,gif,svg|max:102400'
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required' => 'The name (English) is required.',
            'name_en.string' => 'The name (English) must be a valid string.',
            'name_en.max' => 'The name (English) field must not be greater than 125 characters.',
            'name_ar.required' => 'The name (Arabic) is required.',
            'name_ar.string' => 'The name (Arabic) must be a valid string.',
            'name_ar.max' => 'The name (Arabic) field must not be greater than 125 characters.',
        ];
    }
}
