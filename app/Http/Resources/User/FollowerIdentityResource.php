<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FollowerIdentityResource extends JsonResource
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
            'follower_id' => $this->follower_id,
            'identity_type' => $this->identity_type,
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
