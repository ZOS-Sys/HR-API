<?php

namespace App\Http\Requests\User\Notes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
            'note_en' => 'required|string|max:125',
            'note_ar' => 'required|string|max:125'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'note_en.required' => 'The note (English) is required.',
            'note_en.string' => 'The note (English) must be a valid string.',
            'note_en.max' => 'The note (English) field must not be greater than 125 characters.',
            'note_ar.required' => 'The note (Arabic) is required.',
            'note_ar.string' => 'The note (Arabic) must be a valid string.',
            'note_ar.max' => 'The note (Arabic) field must not be greater than 125 characters.',
        ];
    }
}
