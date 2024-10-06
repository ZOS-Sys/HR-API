<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FollowerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'first_name_en' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'first_name_ar' => 'required|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'last_name_en' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'last_name_ar' => 'required|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'middle_name_en' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'middle_name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'date_of_birth' => 'required|date',
            'relationship' => 'required|integer|in:0,1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'User ID must be a valid user.',
            'first_name_en.required' => 'First Name (English) is required.',
            'first_name_en.string' => 'The first name (English) must be a valid string.',
            'first_name_en.max' => 'The first name (English) field must not be greater than 255 characters.',
            'first_name_en.regex' => 'First Name (English) may only contain letters and spaces.',
            'first_name_ar.required' => 'First Name (Arabic) is required.',
            'first_name_ar.string' => 'The first name (Arabic) must be a valid string.',
            'first_name_ar.max' => 'The first name (Arabic) field must not be greater than 255 characters.',
            'first_name_ar.regex' => 'First Name (Arabic) may only contain Arabic letters and spaces.',
            'middle_name_en.regex' => 'Middle Name (English) may only contain letters and spaces.',
            'middle_name_en.string' => 'The middle name (English) must be a valid string.',
            'middle_name_en.max' => 'The middle name (English) field must not be greater than 255 characters.',
            'middle_name_ar.regex' => 'Middle Name (Arabic) may only contain Arabic letters and spaces.',
            'middle_name_ar.string' => 'The middle name (Arabic) must be a valid string.',
            'middle_name_ar.max' => 'The middle name (Arabic) field must not be greater than 255 characters.',
            'last_name_en.required' => 'Last Name (English) is required.',
            'last_name_en.string' => 'The last name (English) must be a valid string.',
            'last_name_en.max' => 'The last name (English) field must not be greater than 255 characters.',
            'last_name_en.regex' => 'Last Name (English) may only contain letters and spaces.',
            'last_name_ar.required' => 'Last Name (Arabic) is required.',
            'last_name_ar.string' => 'The last name (Arabic) must be a valid string.',
            'last_name_ar.max' => 'The last name (Arabic) field must not be greater than 255 characters.',
            'last_name_ar.regex' => 'Last Name (Arabic) may only contain Arabic letters and spaces.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'relationship.in' => 'Relationship must be one of the allowed values.',
        ];
    }
}
