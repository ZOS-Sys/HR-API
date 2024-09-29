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
            'job_title' => 'nullable|string|max:125|regex:/^[a-zA-Z\s]+$/', // Only allows letters and spaces
            'branch_id' => 'nullable|exists:branches,id',
            'city_id' => 'nullable|exists:cities,id',
            'cost_center' => 'nullable|numeric',
            'job_rank' => 'in:1,2,3',
            'job_level' => 'in:1,2,3',
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
            'job_title.string' => 'The job title must be a valid string.',
            'job_title.regex' => 'The job title may only contain letters and spaces.', // Error message for invalid job_title
            'branch_id.exists' => 'The selected branch does not exist.',
            'city_id.exists' => 'The selected city does not exist.',
            'cost_center.numeric' => 'The cost center field must be a number.',
            'job_rank.required' => 'The job rank field is required.',
            'job_rank.in' => 'The job rank must be first rank, second rank, or third rank.',
            'job_level.required' => 'The job level field is required.',
            'job_level.in' => 'The job level must be first level, second level, or third level.',
            'direct_manager.exists' => 'The selected manager does not exist.',
            'working_period.string' => 'The working period must be a valid string.'
        ];
    }
}
