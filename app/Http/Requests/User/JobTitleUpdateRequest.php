<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class JobTitleUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_en' => 'sometimes|required|string|max:255',
            'title_ar' => 'sometimes|required|string|max:255',
            'branch_id' => 'sometimes|required|exists:branches,id',
            'job_rank' => 'sometimes|required|in:1,2,3',
            'job_level' => 'sometimes|required|in:1,2,3',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => 'The English job title is required.',
            'title_ar.required' => 'The Arabic job title is required.',
            'branch_id.exists' => 'The selected branch is invalid.',
            'job_rank.required' => 'The job rank field is required.',
            'job_rank.in' => 'The job rank must be first rank, second rank, or third rank.',
            'job_level.required' => 'The job level field is required.',
            'job_level.in' => 'The job level must be first level, second level, or third level.',
        ];
    }
}
