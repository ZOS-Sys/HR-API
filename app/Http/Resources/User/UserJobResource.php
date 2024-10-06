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
            'job_title' => [
                'id' => $this->jobTitle?->id,
                'title' => Request()->header('Accept-language') == 'ar' ?  $this->jobTitle?->getTranslation('title', 'ar') : $this->jobTitle?->title,
                'job_rank' => $this->jobTitle?->job_rank,
                'job_level' => $this->jobTitle?->job_level,
            ],
            'cost_center' => $this->cost_center,
            'branch' => [
                'id' => $this->branch?->id,
                'name' => Request()->header('Accept-language') == 'ar' ?  $this->branch?->getTranslation('name', 'ar') : $this->branch?->name,
            ],
            'city' => [
                'id' => $this->city?->id,
                'title' => Request()->header('Accept-language') == 'ar' ?  $this->city?->getTranslation('title', 'ar') : $this->city?->title,
            ],
            'working_period' => $this->working_period,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
