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
            'user_id'=>['required' ,'exists:users,id',Rule::unique('user_identities')->whereNull('deleted_at')],
            'identity_type' => 'required|in:0,1',
            'identity_num' => ['required','digits:10',
                function ($attribute, $value, $fail) {
                    if (request()->identity_type == 0 && !preg_match('/^10/', $value)) {
                        $fail('The identity num must start with 10.');
                    }elseif(request()->identity_type == 1 && !preg_match('/^2/', $value)){
                        $fail('The identity num must start with 2.');
                    }
                },
            ],
            'identity_start' => 'nullable|date',
            'identity_end' => 'nullable|date',
            'passport_num' => 'nullable',
            'passport_start' => 'nullable|date',
            'passport_end' => 'nullable|date',
            'location' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'The selected user does not exist.',
            'identity_type.required' => 'The identity type field is required.',
            'identity_type.in' => 'Identity type must be either national (0) or residence (1).',
            'identity_num.required' => 'The identity num field is required.',
            'identity_start.date' => 'The identity start date must be a valid date.',
            'identity_end.date' => 'The identity end date must be a valid date.',
            'passport_start.date' => 'The passport start date must be a valid date.',
            'passport_end.date' => 'The passport end date must be a valid date.'
        ];
    }
}
