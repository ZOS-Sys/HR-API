<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserIdentityStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'=>['required' ,'exists:users,id',Rule::unique('user_jobs')->whereNull('deleted_at')],
            'identity_type' => 'nullable|in:0,1',
            'identity_num' => 'nullable',
            'identity_start' => 'nullable|date',
            'identity_end' => 'nullable|date',
            'passport_num' => 'nullable',
            'passport_start' => 'nullable|date',
            'passport_end' => 'nullable|date',
            'location' => 'nullable|exists:countries,id',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user does not exist.',
            'identity_type.in' => 'The identity type must be either national or residence.',
            'identity_start.date' => 'The identity start date must be a valid date.',
            'identity_end.date' => 'The identity end date must be a valid date.',
            'passport_start.date' => 'The passport start date must be a valid date.',
            'passport_end.date' => 'The passport end date must be a valid date.',
            'location.exists' => 'The selected country does not exist.',
        ];
    }
}
