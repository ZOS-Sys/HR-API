<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name_en' => 'required|string|max:255',
            'first_name_ar' => 'nullable|string|max:255',
            'middle_name_en' => 'nullable|string|max:255',
            'middle_name_ar' => 'nullable|string|max:255',
            'last_name_en' => 'required|string|max:255',
            'last_name_ar' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
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
            'last_name_en.required' => 'Last Name (English) is required.',
            'email.required' => 'Email is required.',
            'email.unique'   => 'This email is already registered.',
            'password.required'   => 'Password is required.',
        ];
    }
}
