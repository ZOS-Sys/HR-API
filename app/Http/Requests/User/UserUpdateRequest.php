<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name_en' => 'sometimes|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'first_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'last_name_en' => 'sometimes|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'last_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'nationality' => 'nullable|exists:countries,id',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|in:0,1,2,3',
            'type' => 'nullable|in:1,2',
            'gender' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name_en.regex' => 'First Name (English) may only contain letters and spaces.',
            'first_name_ar.regex' => 'First Name (Arabic) may only contain Arabic letters and spaces.',
            'last_name_en.regex' => 'Last Name (English) may only contain letters and spaces.',
            'last_name_ar.regex' => 'Last Name (Arabic) may only contain Arabic letters and spaces.',
            'nationality.exists' => 'The selected country does not exist.',
        ];
    }
}
