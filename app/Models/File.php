<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
