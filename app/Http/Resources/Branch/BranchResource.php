<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BranchResource extends JsonResource
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
            'name' => Request()->header('Accept-language') == 'ar' ? $this->getTranslation('name', 'ar') : $this->name,
            'logo' => $this->logo ? Storage::disk('public')->url($this->logo) : null,
            'company' => Request()->header('Accept-language') == 'ar' ? $this->company?->getTranslation('name', 'ar') : $this->company?->name,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
