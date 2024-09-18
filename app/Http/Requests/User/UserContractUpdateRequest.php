<?php

namespace App\Http\Requests;

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
            'name' => 'nullable|array',
            'file' => 'nullable|string',
            'joining_date' => 'nullable|date',
            'period' => 'nullable|string',
        ];
    }

    // Customize the validation error messages
    public function messages()
    {
        return [
            'user_id.exists' => 'User ID must be a valid user.',
            'name.array' => 'Name must be a valid array.',
            'joining_date.date' => 'Joining date must be a valid date.',
            'period.string' => 'Contract period must be a string.',
        ];
    }
}
