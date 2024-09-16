<?php

namespace App\Http\Resources;

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
            'first_name' => $this->getTranslation('first_name', 'en'),
            'first_name_ar' => $this->getTranslation('first_name', 'ar'),
            'middle_name' => $this->getTranslation('middle_name', 'en'),
            'middle_name_ar' => $this->getTranslation('middle_name', 'ar'),
            'last_name' => $this->getTranslation('last_name', 'en'),
            'last_name_ar' => $this->getTranslation('last_name', 'ar'),
            'email' => $this->email,
            'phone' => $this->phone,
            'nationality' => $this->nationality,
            'date_of_birth' => $this->date_of_birth,
            'marital_status' => $this->marital_status,
            'type' => $this->type == 1 ? 'admin' : 'user',
            'gender' => $this->gender == 1 ? 'male' : 'female',
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
