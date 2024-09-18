<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FollowerStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'first_name_en' => 'required|string|max:255',
            'first_name_ar' => 'nullable|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'last_name_ar' => 'nullable|string|max:255',
            'middle_name_en' => 'nullable|string|max:255',
            'middle_name_ar' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'relationship' => 'required|integer|in:0,1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'User ID must be a valid user.',
            'first_name_en.required' => 'First Name (English) is required.',
            'last_name_en.required' => 'Last Name (English) is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            'relationship.required' => 'Relationship is required.',
        ];
    }
}
