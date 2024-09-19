<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name_en' => 'required|string',
            'name_ar' => 'nullable|string',
            'iban' => 'required|string|unique:bank_accounts,iban',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The user ID must exist in the users table.',
            'name_en.required' => 'The bank account name in English is required.',
            'name_en.string' => 'The bank account name in English must be a valid string.',
            'name_ar.string' => 'The bank account name in Arabic must be a valid string.',
            'iban.required' => 'The IBAN is required.',
            'iban.string' => 'The IBAN must be a valid string.',
            'iban.unique' => 'The IBAN must be unique.',
        ];
    }
}
