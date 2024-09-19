<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Currency\CurrencyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AllowanceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'currency' => new CurrencyResource($this->whenLoaded('currency')),
            'name_en' => $this->getTranslation('name', 'en'),
            'name_ar' => $this->getTranslation('name', 'ar'),
            'note_en' => $this->getTranslation('note', 'en'),
            'note_ar' => $this->getTranslation('note', 'ar'),
            'percent' => $this->percent,
            'type_of_operation' => $this->type_of_operation_text,
            'maximum' => $this->maximum,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
