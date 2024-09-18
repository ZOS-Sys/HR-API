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
            'name' => 'required|array',
            'file' => 'nullable|string',
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
            'name.required' => 'Name is required.',
            'name.array' => 'Name must be a valid array.',
            'joining_date.required' => 'Joining date is required.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'period.required' => 'Contract period is required.',
        ];
    }
}
