<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserContractStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // Define the validation rules for creating a user contract
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name_en' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'name_ar' => 'required|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx',
            'joining_date' => 'required|date|before_or_equal:today',
            'period' => 'required|integer|min:1',
        ];
    }

    // Customize the validation error messages
    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'User ID must be a valid user.',
            'name_en.required' => 'English Name is required.',
            'name_en.regex' => 'English Name may only contain letters and spaces.',
            'name_ar.required' => 'Arabic Name is required.',
            'name_ar.regex' => 'Arabic Name may only contain Arabic letters and spaces.',
            'joining_date.required' => 'Joining date is required.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'joining_date.before_or_equal' => 'Joining date cannot be in the future.',
            'period.required' => 'Contract period is required.',
            'period.integer' => 'Contract period must be a valid number.',
            'file.mimes' => 'The file must be an image (jpg, jpeg, png) or a document (pdf, doc, docx).',
        ];
    }
}
