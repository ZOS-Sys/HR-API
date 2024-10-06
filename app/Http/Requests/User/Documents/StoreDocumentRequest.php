<?php

namespace App\Http\Requests\User\Documents;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
            'document_type' => 'required|string|max:125',
            'document_num' => 'required|numeric|digits_between:1,8',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg|max:102400',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'document_type.required' => 'The document type is required.',
            'document_type.string' => 'The document type must be a valid string.',
            'document_type.max' => 'The document type field must not be greater than 125 characters.',
            'document_num.required' => 'The document num field is required.',
            'document_num.digits_between' => 'The document num field must be between 1 and 8 digits.',
            'document_num.numeric' => 'The document number field must be a number.',
            'start_date.date' => 'Start Date must be a valid date.',
            'start_date.required' => 'The start date is required.',
            'end_date.date' => 'End Date must be a valid date.',
            'end_date.required' => 'The end date is required.'
        ];
    }
}
