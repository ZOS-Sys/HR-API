<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class JobTitleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title_en' => $this->getTranslation('title', 'en'),
            'title_ar' => $this->getTranslation('title', 'ar'),
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'job_rank' => $this->job_rank,
            'job_level' => $this->job_level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
