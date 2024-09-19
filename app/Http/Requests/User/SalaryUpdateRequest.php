<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SalaryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'allowance_id' => 'nullable|exists:allowances,id',
            'salary' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'The user ID must exist in the users table.',
            'allowance_id.exists' => 'The allowance ID must exist in the allowances table.',
            'salary.numeric' => 'The salary must be a valid number.',
        ];
    }
}
