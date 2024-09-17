<?php

namespace App\Repositories;

use App\Models\UserJob;

class UserJobRepository
{
    // Model instance for the UserJob
    protected UserJob $userJob;

    public function __construct(UserJob $userJob)
    {
        $this->userJob = $userJob;
    }

    /**
     * Find a user job by the user_id.
     * This retrieves the user job based on the user ID, not the job's ID.
     *
     * @param int $userId
     * @return UserJob|null
     */
    public function findUserJobByUserId($userId)
    {
        return $this->userJob->with('user')->where('user_id', $userId)->first();
    }

    /**
     * Create a new user job in the database.
     *
     * @param array $data
     * @return UserJob
     */
    public function createUserJob(array $data)
    {
        return $this->userJob->create($data);
    }

    /**
     * Update an existing user job by ID.
     *
     * @param int $id
     * @param array $data
     * @return UserJob|null
     */
    public function updateUserJob($id, array $data)
    {
        // Find the user job by ID
        $userJob = $this->findUserJobByUserId($id);
        if ($userJob) {
            // If the user job exists, update it with the provided data
            $userJob->update($data);
        }
        // Return the updated user job
        return $userJob;
    }

    /**
     * Delete a user job by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserJob($id)
    {
        // Find the user job by ID
        $userJob = $this->findUserJobByUserId($id);
        if ($userJob) {
            // If found, delete the user job and return true
            return $userJob->delete();
        }

        return false;
    }
}
