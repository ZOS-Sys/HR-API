<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContract extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $table = 'user_contracts';
    protected $guarded = ['id'];

    public $translatable = ['name'];
}
