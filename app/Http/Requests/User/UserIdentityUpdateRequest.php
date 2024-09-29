<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserIdentityUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identity_type' => 'nullable|in:0,1',
            'identity_num' => 'nullable|max:255',
            'identity_start' => 'nullable|date',
            'identity_end' => 'nullable|date',
            'passport_num' => 'nullable|max:255',
            'passport_start' => 'nullable|date',
            'passport_end' => 'nullable|date',
            'location' => 'nullable|exists:countries,id',
        ];
    }

    public function messages(): array
    {
        return [
            'identity_type.in' => 'The identity type must be either national or residence.',
            'identity_start.date' => 'The identity start date must be a valid date.',
            'identity_end.date' => 'The identity end date must be a valid date.',
            'passport_start.date' => 'The passport start date must be a valid date.',
            'passport_end.date' => 'The passport end date must be a valid date.',
            'location.exists' => 'The selected country does not exist.',
        ];
    }
}
