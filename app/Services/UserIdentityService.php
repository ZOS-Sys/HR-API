<?php

namespace App\Services;

use App\Models\UserIdentity;
use App\Repositories\User\UserIdentityRepository;

class UserIdentityService
{
    protected UserIdentityRepository $userIdentityRepository;


    public function __construct(UserIdentityRepository $userIdentityRepository)
    {
        $this->userIdentityRepository = $userIdentityRepository;
    }

    /**
     * Get user identity by user ID
     *
     * @param int $userId
     * @return UserIdentity|null
     */
    public function getUserIdentityByUserId($userId)
    {

        return $this->userIdentityRepository->findUserIdentityByUserId($userId);
    }

    /**
     * Create a new user identity
     *
     * @param array $data
     * @return UserIdentity
     */
    public function createUserIdentity(array $data)
    {
        return $this->userIdentityRepository->createUserIdentity($data);
    }

    /**
     * Update an existing user identity
     *
     * @param int $id
     * @param array $data
     * @return UserIdentity|null
     */
    public function updateUserIdentity($id, array $data)
    {
        return $this->userIdentityRepository->updateUserIdentity($id, $data);
    }

    /**
     * Delete a user identity
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserIdentity($id)
    {
        return $this->userIdentityRepository->deleteUserIdentity($id);
    }
}
