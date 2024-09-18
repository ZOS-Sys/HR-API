<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['title'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($data){
            $data->cities->each->delete();
        });
    }
}
