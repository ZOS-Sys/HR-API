<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['name'];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($data){
            $data->branches->each->delete();
        });
    }
}
