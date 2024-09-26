<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'first_name_en' => $this->getTranslation('first_name', 'en'),
            'first_name_ar' => $this->getTranslation('first_name', 'ar'),
            'middle_name_en' => $this->getTranslation('middle_name', 'en'),
            'middle_name_ar' => $this->getTranslation('middle_name', 'ar'),
            'last_name_en' => $this->getTranslation('last_name', 'en'),
            'last_name_ar' => $this->getTranslation('last_name', 'ar'),
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'relationship' => $this->relationship == 0 ? 'father' : ($this->relationship == 1 ? 'mother' : ($this->relationship == 2 ? 'sister' : ($this->relationship == 3 ? 'brother' : 'other'))),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
