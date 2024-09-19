<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'name_en' => 'nullable|string',
            'name_ar' => 'nullable|string',
            'iban' => 'nullable|string|unique:bank_accounts,iban,' . $this->route('bank_account'),
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'The user ID must exist in the users table.',
            'name_en.string' => 'The bank account name in English must be a string.',
            'name_ar.string' => 'The bank account name in Arabic must be a string.',
            'iban.string' => 'The IBAN must be a valid string.',
            'iban.unique' => 'The IBAN must be unique in the bank accounts table.',
        ];
    }
}
