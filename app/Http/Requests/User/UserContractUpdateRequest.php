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
            'name_en' => 'nullable|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx',
            'joining_date' => 'nullable|date',
            'period' => 'nullable|string',
        ];
    }

    // Customize the validation error messages
    public function messages()
    {
        return [
            'user_id.exists' => 'User ID must be a valid user.',
            'name_en' => 'English Name must be a valid String.',
            'name_ar' => 'Arabic Name must be a valid String.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'period.string' => 'Contract period must be a string.',
        ];
    }
}
