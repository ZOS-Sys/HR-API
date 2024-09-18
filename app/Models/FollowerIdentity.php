<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowerIdentity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='follower_identities';
    protected $guarded = ['id'];

    // Relation with Follower
    public function follower()
    {
        return $this->belongsTo(Follower::class);
    }
}
