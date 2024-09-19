<?php

namespace App\Http\Requests\User\Files;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=> 'required|exists:users,id',
            'address_en' => 'required|string|max:125',
            'address_ar' => 'required|string|max:125',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:102400',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'address_en.required' => 'The address (English) is required.',
            'address_en.string' => 'The address (English) must be a valid string.',
            'address_en.max' => 'The address (English) field must not be greater than 125 characters.',
            'address_ar.required' => 'The address (Arabic) is required.',
            'address_ar.string' => 'The address (Arabic) must be a valid string.',
            'address_ar.max' => 'The address (Arabic) field must not be greater than 125 characters.',
        ];
    }
}
