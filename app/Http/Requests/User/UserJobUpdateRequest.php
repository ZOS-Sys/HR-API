<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserJobUpdateRequest extends FormRequest
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
            'job_num' => 'numeric|digits_between:1,8|unique:user_jobs,job_num,' . $this->route('user-job'),
            'joining_date' => 'nullable|date|before_or_equal:today', // Prevents future dates
            'job_title_id' => 'required|exists:job_titles,id',
            'branch_id' => 'nullable|exists:branches,id',
            'city_id' => 'nullable|exists:cities,id',
            'cost_center' => 'nullable|numeric',
            'direct_manager' => 'nullable|exists:users,id',
            'working_period' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'job_num.required' => 'The job num field is required.',
            'job_num.digits_between' => 'The job num field must be between 1 and 8 digits.',
            'job_num.numeric' => 'The job number field must be a number.',
            'joining_date.before_or_equal' => 'The joining date must not be a future date.', // Error for future dates
            'joining_date.date' => 'The joining date must be a valid date.',
            'job_title_id.required' => 'The job title id field is required.',
            'job_title_id.exists' => 'The selected job title does not exist.',
            'branch_id.exists' => 'The selected branch does not exist.',
            'city_id.exists' => 'The selected city does not exist.',
            'cost_center.numeric' => 'The cost center field must be a number.',
            'direct_manager.exists' => 'The selected manager does not exist.',
            'working_period.string' => 'The working period must be a valid string.'
        ];
    }
}
