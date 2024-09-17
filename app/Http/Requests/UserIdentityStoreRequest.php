<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserIdentityStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'identity_type' => 'nullable|in:0,1',
            'identity_num' => 'nullable|string|max:255',
            'identity_start' => 'nullable|date',
            'identity_end' => 'nullable|date',
            'passport_num' => 'nullable|string|max:255',
            'passport_start' => 'nullable|date',
            'passport_end' => 'nullable|date',
            'location' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user does not exist.',
            'identity_type.in' => 'The identity type must be either national or residence.',
            'identity_num.string' => 'The identity number must be a valid string.',
            'identity_start.date' => 'The identity start date must be a valid date.',
            'identity_end.date' => 'The identity end date must be a valid date.',
            'passport_num.string' => 'The passport number must be a valid string.',
            'passport_start.date' => 'The passport start date must be a valid date.',
            'passport_end.date' => 'The passport end date must be a valid date.',
            'location.string' => 'The location must be a valid string.',
        ];
    }
}
