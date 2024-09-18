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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx',
            'joining_date' => 'required|date',
            'period' => 'required|string',
        ];
    }


    // Customize the validation error messages
    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'User ID must be a valid user.',
            'name_en.required' => 'English Name is required.',
            'name_ar.required' => 'Arabic Name is required.',
            'joining_date.required' => 'Joining date is required.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'period.required' => 'Contract period is required.',
            'file.mimes' => 'The file must be an image (jpg, jpeg, png) or a document (pdf, doc, docx).',
        ];
    }
}
