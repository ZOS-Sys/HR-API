<?php

namespace App\Repositories\User;

use App\Models\{User,UserJob};

class UserRepository
{
    protected User $user;

    // Inject the User model
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Get all users
    public function getAllUsers($perPage)
    {
        return $this->user->paginate($perPage);

    }

    // Get users where level equal one
    public function levelOne($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->where('job_level',1);
        })->paginate($perPage);
    }

    // Get users where level equal one or two
    public function levelOneAndTwo($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->where('job_level',1)->orWhere('job_level',2);
        })->paginate($perPage);
    }

    // Get subordinates by userId
    public function subordinates($userId,$perPage)
    {
        return $this->user->whereHas('userJob',function($job)use($userId){
            $job->where('direct_manager',$userId);
        })->paginate($perPage);
    }

    // add new subordinate for user and retrieve his subordinates
    public function addSubordinate($userId, array $data)
    {
        $user = $this->findUserById($userId);
        $subordinate = UserJob::where('user_id',$data['user_id'])->first();
        if ($user && $subordinate && $userId != $data['user_id']) {
            $subordinateLevel = $subordinate?->job_level;
            $userLevel = $user->userJob?->job_level;

            if((int)$subordinateLevel < (int)$userLevel)
            {
                $subordinate->update(['direct_manager'=>$userId]);
                return $user;
            }
        }
        return NULL;
    }

    // Find a user by ID
    public function findUserById($id)
    {
        return $this->user->find($id);
    }

    // Create a new user
    public function createUser(array $data)
    {
        return $this->user->create($data);
    }

    // Update an existing user
    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = $this->findUserById($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
