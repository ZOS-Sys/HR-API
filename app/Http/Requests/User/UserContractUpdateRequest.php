<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserContractUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // Define the validation rules for updating a user contract
    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'name_en' => 'nullable|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'name_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]+$/u',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx',
            'joining_date' => 'nullable|date|before_or_equal:today',
            'period' => 'nullable|integer|min:1',
        ];
    }

    // Customize the validation error messages
    public function messages()
    {
        return [
            'user_id.exists' => 'User ID must be a valid user.',
            'name_en.regex' => 'English Name may only contain letters and spaces.',
            'name_ar.regex' => 'Arabic Name may only contain Arabic letters and spaces.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'joining_date.before_or_equal' => 'Joining date must not be a future date.',
            'period.integer' => 'Contract period must be a valid number.',
            'file.mimes' => 'The file must be an image (jpg, jpeg, png) or a document (pdf, doc, docx).',
        ];
    }
}
