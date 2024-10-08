<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use  HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['title'];

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
