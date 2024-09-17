<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserJobStoreRequest extends FormRequest
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
            'user_id'=>['required' ,'exists:users,id',Rule::unique('user_jobs')->whereNull('deleted_at')],
            'job_num' => 'required|numeric|digits_between:1,8',
            'joining_date' => 'nullable|date',
            'job_title' => 'nullable|string|max:125',
            'branch_id' => 'nullable|exists:branches,id',
            'city_id' => 'nullable|exists:cities,id',
            'cost_center' => 'nullable|numeric',
            'job_rank' => 'required|in:1,2,3',
            'job_level' => 'required|in:1,2,3',
            'direct_manager' => 'nullable|exists:users,id',
            'working_period' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user id field is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'job_num.required' => 'The job num field is required.',
            'job_num.digits_between' => 'The job num field must be between 1 and 8 digits.',
            'job_num.numeric' => 'The job number field must be a number.',
            'joining_date.date' => 'The joining date must be a valid date.',
            'job_title.string' => 'The job title must be a valid string.',
            'branch_id.exists' => 'The selected branch does not exist.',
            'city_id.exists' => 'The selected city does not exist.',
            'cost_center.numeric' => 'The cost centetr field must be a number.',
            'job_rank.required' => 'The job rank field is required.',
            'job_rank.in' => 'The job rank must be first rank, second rank or third rank.',
            'job_level.required' => 'The job level field is required.',
            'job_level.in' => 'The job level must be first level, second level or third level.',
            'direct_manager.exists' => 'The selected manager does not exist.',
            'working_period.string' => 'The working period must be a valid string.'
        ];
    }
}
