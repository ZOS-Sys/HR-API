<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allowance extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['name','note'];

    // Relation With Currency
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the type of operation as a text description.
     *
     * @return string
     */
    public function getTypeOfOperationTextAttribute()
    {
        $operations = [
            0 => 'minus',
            1 => 'plus'
        ];

        return $operations[$this->type_of_operation] ?? '';
    }
}
