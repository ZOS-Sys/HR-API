<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'type' => $this->type,
            'gender' => $this->gender == 1 ? 'male' : ($this->gender == 2 ? 'female' : NULL),
            'branch' => Request()->header('Accept-language') == 'ar' ?  $this->userJob?->branch?->getTranslation('name', 'ar') : $this->userJob?->branch?->name,
            'job_title' => $this->userJob?->job_title,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
