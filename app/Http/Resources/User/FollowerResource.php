<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResource extends JsonResource
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
            'user_id' => $this->user_id,
            'first_name' => $this->getTranslation('first_name', 'en'),
            'first_name_ar' => $this->getTranslation('first_name', 'ar'),
            'middle_name' => $this->getTranslation('middle_name', 'en'),
            'middle_name_ar' => $this->getTranslation('middle_name', 'ar'),
            'last_name' => $this->getTranslation('last_name', 'en'),
            'last_name_ar' => $this->getTranslation('last_name', 'ar'),
            'date_of_birth' => $this->date_of_birth,
            'relationship' => $this->relationship,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
