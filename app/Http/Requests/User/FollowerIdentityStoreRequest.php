<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FollowerIdentityStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'follower_id' => 'required|exists:followers,id',
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

    public function messages()
    {
        return [
            'follower_id.required' => 'Follower ID is required.',
            'follower_id.exists' => 'Follower ID must be a valid follower.',
            'identity_type.in' => 'Identity type must be either national (0) or residence (1).',
            'identity_num.string' => 'Identity number must be a valid string.',
            'passport_num.string' => 'Passport number must be a valid string.',
            'identity_start.date' => 'Identity start date must be a valid date.',
            'identity_end.date' => 'Identity end date must be a valid date.',
            'passport_start.date' => 'Passport start date must be a valid date.',
            'passport_end.date' => 'Passport end date must be a valid date.',
            'location.string' => 'Location must be a valid string.',
        ];
    }
}
