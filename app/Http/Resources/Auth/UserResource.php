<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name_en' => $this->getTranslation('first_name', 'en'),
            'first_name_ar' => $this->getTranslation('first_name', 'ar'),
            'middle_name_en' => $this->getTranslation('middle_name', 'en'),
            'middle_name_ar' => $this->getTranslation('middle_name', 'ar'),
            'last_name_en' => $this->getTranslation('last_name', 'en'),
            'last_name_ar' => $this->getTranslation('last_name', 'ar'),
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'date_of_birth' => $this->date_of_birth,
            'marital_status' => $this->marital_status,
            'image' => $this->image ? Storage::disk('public')->url($this->image) : null,
            'type' => [
                'id' => $this->type,
                'type' => $this->type == 0 ? 'Admin' : ($this->type == 1 ? 'User' : NULL),
            ],
            'gender' => [
                'id' => $this->gender,
                'gender' => $this->gender == 1 ? 'male' : ($this->gender == 2 ? 'female' : NULL),
            ],
            'branch' => [
                'id' => $this->userJob?->branch?->id,
                'name' => Request()->header('Accept-language') == 'ar' ?  $this->userJob?->branch?->getTranslation('name', 'ar') : $this->userJob?->branch?->name,
            ],
            'job_title' => [
                'id' => $this->userJob?->jobTitle?->id,
                'title' => Request()->header('Accept-language') == 'ar' ?  $this->userJob?->jobTitle?->getTranslation('title', 'ar') : $this->userJob?->jobTitle?->title,
            ],
            'job_num' => $this->userJob?->job_num,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
