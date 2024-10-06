<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
        $id = request()->segment(3);
        return [
            'email' => "required|email|unique:users,email,{$id},id,deleted_at,NULL",
            'phone' => "required|numeric|unique:users,phone,{$id},id,deleted_at,NULL",
            'another_phone' => "nullable|numeric|unique:users,phone,{$id},id,deleted_at,NULL",
        ];
    }
}
