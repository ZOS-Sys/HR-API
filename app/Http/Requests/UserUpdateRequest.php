<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'first_name_en' => 'sometimes|string|max:255',
            'first_name_ar' => 'nullable|string|max:255',
            'last_name_en' => 'sometimes|string|max:255',
            'last_name_ar' => 'nullable|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $this->route('user'),
            'phone' => 'nullable|string|max:20',
            'nationality' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|in:0,1,2,3',
            'type' => 'nullable|in:1,2',
            'gender' => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name_en.required' => 'First Name (English) is required.',
            'last_name_en.required' => 'Last Name (English) is required.',
            'email.unique' => 'This email is already registered.',
        ];
    }
}
