<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserIdentityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'identity_type' => $this->identity_type == 0 ? 'national' : 'residence',
            'identity_num' => $this->identity_num,
            'identity_start' => $this->identity_start,
            'identity_end' => $this->identity_end,
            'passport_num' => $this->passport_num,
            'passport_start' => $this->passport_start,
            'passport_end' => $this->passport_end,
            'location' => $this->location,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
