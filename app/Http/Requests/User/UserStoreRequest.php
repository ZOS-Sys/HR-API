<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'first_name_en' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'first_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'middle_name_en' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'last_name_en' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'last_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'nationality' => 'nullable|exists:countries,id',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|in:0,1,2,3',
            'type' => 'nullable|in:1,2',
            'gender' => 'nullable|in:0,1',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name_en.required' => 'First Name (English) is required.',
            'first_name_en.regex' => 'First Name (English) may only contain letters and spaces.',
            'first_name_ar.regex' => 'First Name (Arabic) may only contain Arabic letters and spaces.',
            'middle_name_en.regex' => 'Middle Name (English) may only contain letters and spaces.',
            'middle_name_ar.regex' => 'Middle Name (Arabic) may only contain Arabic letters and spaces.',
            'last_name_en.required' => 'Last Name (English) is required.',
            'last_name_en.regex' => 'Last Name (English) may only contain letters and spaces.',
            'last_name_ar.regex' => 'Last Name (Arabic) may only contain Arabic letters and spaces.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'nationality.exists' => 'The selected country does not exist.',
        ];
    }
}
