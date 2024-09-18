<?php

namespace App\Traits;

trait TranslatableTrait
{
    public function handleTranslatableData(array $data, string $field): array
    {
        if (isset($data["{$field}_en"]) || isset($data["{$field}_ar"])) {
            return [
                'en' => $data["{$field}_en"] ?? null,
                'ar' => $data["{$field}_ar"] ?? null,
            ];
        }

        return $data[$field] ?? [];
    }
}
