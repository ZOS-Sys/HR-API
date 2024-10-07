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
    public function getAllUsers($perPage, $searchTerm = null, $joiningStartDate = null, $joiningEndDate = null, $maritalStatus = null, $gender = null,$jobRank = null, $jobLevel = null,$branchId=null)
    {

        $query = User::query()
            ->with('userJob', 'userIdentity');

        // Apply the search scope if a search term is provided
        if ($searchTerm) {
            $query->search($searchTerm, $joiningStartDate, $joiningEndDate, $maritalStatus, $gender);
        }

        // Apply filters directly in the repository
        if ($maritalStatus !== null) {
            $query->where('marital_status', $maritalStatus);
        }

        if ($gender !== null) {
            $query->where('gender', $gender);
        }

        // Filtering by joining date
        if ($joiningStartDate) {
            $query->whereHas('userJob', function ($q) use ($joiningStartDate) {
                $q->where('joining_date', '>=', $joiningStartDate);
            });
        }
        if ($joiningEndDate) {
            $query->whereHas('userJob', function ($q) use ($joiningEndDate) {
                $q->where('joining_date', '<=', $joiningEndDate);
            });
        }

        // Filtering by job rank from jobTitle
        if ($jobRank !== null) {
            $query->whereHas('userJob.jobTitle', function ($q) use ($jobRank) {
                $q->where('job_rank', $jobRank);
            });
        }

        // Filtering by job level from jobTitle
        if ($jobLevel !== null) {
            $query->whereHas('userJob.jobTitle', function ($q) use ($jobLevel) {
                $q->where('job_level', $jobLevel);
            });
        }

        // Filtering by branch ID
        if ($branchId !== null) {
            $query->WhereHas('userJob', function ($query) use ($branchId) {
                $query->where('branch_id', $branchId);
            });
        }


        return $query->paginate($perPage);
    }
    // Get users where level equal one
    public function levelOne($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->whereHas('jobTitle',function($title){
                $title->where('job_level',1);
            });
        })->paginate($perPage);
    }

    // Get users where level equal one or two
    public function levelOneAndTwo($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->whereHas('jobTitle',function($title){
                $title->where('job_level',1)->orWhere('job_level',2);
            });
        })->paginate($perPage);
    }

    // Get users where level equal three
    public function levelThree($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->whereHas('jobTitle',function($title){
                $title->where('job_level',3);
            });
        })->paginate($perPage);
    }

    // Get users where level equal three or two
    public function levelThreeAndTwo($perPage)
    {
        return $this->user->whereHas('userJob',function($job){
            $job->whereHas('jobTitle',function($title){
                $title->where('job_level',2)->orWhere('job_level',3);
            });
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

    // Update user contacts
    public function updateUserContacts($id,array $data)
    {
        $user = $this->findUserById($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    // Update user image
    public function updateUserImage($id,array $data)
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
