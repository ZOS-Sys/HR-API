<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserJobResource extends JsonResource
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
            'job_num' => $this->job_num,
            'joining_date' => $this->joining_date,
            'job_title' => $this->job_title,
            'cost_center' => $this->cost_center,
            'branch' => $this->branch?->id,
            'city' => $this->city?->id,
            'working_period' => $this->working_period,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
