<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasTranslations, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];

    public $translatable = ['first_name', 'middle_name', 'last_name'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password','remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // JWT custom claims
    public function getJWTCustomClaims()
    {
        return [];
    }
  // User job Relation
    public function userJob()
    {
        return $this->hasOne(UserJob::class);
    }
    // User job Relation
    public function userIdentity()
    {
        return $this->hasOne(UserIdentity::class);
    }
    // User job Relation
    public function userContract()
    {
        return $this->hasOne(UserContract::class);
    }

    // Handle Search for User
    public function scopeSearch(Builder $query, $searchTerm = null, $startDate = null, $endDate = null, $maritalStatus = null, $gender = null)
    {
        return $query->where(function ($q) use ($searchTerm, $startDate, $endDate, $maritalStatus, $gender) {
            // searching by name fields
            if ($searchTerm) {
                $q->where('first_name->en', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('first_name->ar', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('middle_name->en', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('middle_name->ar', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('last_name->en', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('last_name->ar', 'LIKE', '%' . $searchTerm . '%');
            }

            // Filtering by UserJob and relation of it
            if ($searchTerm) {
                $q->orWhereHas('userJob', function ($query) use ($searchTerm) {
                    $query->where('job_num', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhereHas('jobTitle', function ($query) use ($searchTerm) {
                            $query->where('title->en', 'LIKE', '%' . $searchTerm . '%')
                                ->orWhere('title->ar', 'LIKE', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('city', function ($query) use ($searchTerm) {
                            $query->where('title->en', 'LIKE', '%' . $searchTerm . '%')
                                ->orWhere('title->ar', 'LIKE', '%' . $searchTerm . '%');
                        });
                });
            }
            // Searching in identity number
            if ($searchTerm) {
                $q->orWhereHas('userIdentity', function ($q) use ($searchTerm) {
                    $q->where('identity_num', 'LIKE', '%' . $searchTerm . '%');
                });
                }
        });
    }
}
