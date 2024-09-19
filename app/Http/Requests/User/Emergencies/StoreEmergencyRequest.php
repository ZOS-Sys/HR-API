<?php

namespace App\Http\Requests\User\Emergencies;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmergencyRequest extends FormRequest
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
            'first_name_en' => 'required|string|max:125',
            'first_name_ar' => 'required|string|max:125',
            'middle_name_en' => 'required|string|max:125',
            'middle_name_ar' => 'required|string|max:125',
            'last_name_en' => 'required|string|max:125',
            'last_name_ar' => 'required|string|max:125',
            'relationship' => 'required|in:0,1,2,3,4',
            'phone_one' => 'nullable|numeric',
            'phone_two' => 'nullable|numeric',
            'phone_three' => 'nullable|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'first_name_en.required' => 'The first name (English) is required.',
            'first_name_en.string' => 'The first name (English) must be a valid string.',
            'first_name_en.max' => 'The first name (English) field must not be greater than 125 characters.',
            'first_name_ar.required' => 'The first name (Arabic) is required.',
            'first_name_ar.string' => 'The first name (Arabic) must be a valid string.',
            'first_name_ar.max' => 'The first name (Arabic) field must not be greater than 125 characters.',
            'middle_name_en.required' => 'The middle name (English) is required.',
            'middle_name_en.string' => 'The middle name (English) must be a valid string.',
            'middle_name_en.max' => 'The middle name (English) field must not be greater than 125 characters.',
            'middle_name_ar.required' => 'The middle name (Arabic) is required.',
            'middle_name_ar.string' => 'The middle name (Arabic) must be a valid string.',
            'middle_name_ar.max' => 'The middle name (Arabic) field must not be greater than 125 characters.',
            'last_name_ar.required' => 'The last name (English) is required.',
            'last_name_ar.string' => 'The last name (English) must be a valid string.',
            'last_name_ar.max' => 'The last name (English) field must not be greater than 125 characters.',
            'last_name_ar.required' => 'The last name (Arabic) is required.',
            'last_name_ar.string' => 'The last name (Arabic) must be a valid string.',
            'last_name_ar.max' => 'The last name (Arabic) field must not be greater than 125 characters.',
            'relationship.in' => 'The relationship must be father, mother, sister, brother, or other.',
            'phone_one.numeric' => 'The phone one field must be a number.',
            'phone_two.numeric' => 'The phone two field must be a number.',
            'phone_three.numeric' => 'The phone three field must be a number.'
        ];
    }
}
