<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follower extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    protected $guarded = ['id'];

    public $translatable = ['first_name', 'middle_name', 'last_name'];

    // Accessor for relationship
    public function getRelationshipTextAttribute()
    {
        $relationships = [
            0 => 'son',
            1 => 'daughter',
            2 => 'husband',
            3 => 'wife'
        ];

        return $relationships[$this->relationship] ?? '';
    }
    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
