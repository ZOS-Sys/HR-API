<?php

namespace App\Services;

use App\Models\UserIdentity;
use App\Repositories\UserJobRepository;

class UserJobService
{
    protected UserJobRepository $userJobRepository;


    public function __construct(UserJobRepository $userJobRepository)
    {
        $this->userJobRepository = $userJobRepository;
    }

    /**
     * Get user job by user ID
     *
     * @param int $userId
     * @return UserJob|null
     */
    public function getUserJobByUserId($userId)
    {

        return $this->userJobRepository->findUserJobByUserId($userId);
    }

    /**
     * Create a new user job
     *
     * @param array $data
     * @return UserJob
     */
    public function createUserJob(array $data)
    {
        return $this->userJobRepository->createUserJob($data);
    }

    /**
     * Update an existing user job
     *
     * @param int $id
     * @param array $data
     * @return UserJob|null
     */
    public function updateUserJob($id, array $data)
    {
        return $this->userJobRepository->updateUserJob($id, $data);
    }

    /**
     * Delete a user job
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserJob($id)
    {
        return $this->userJobRepository->deleteUserJob($id);
    }
}
