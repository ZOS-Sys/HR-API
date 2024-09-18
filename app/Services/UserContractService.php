<?php

namespace App\Services;

use App\Models\UserContract;
use App\Repositories\User\UserContractRepository;

class UserContractService
{
    protected UserContractRepository $userContractRepository;

    // Constructor to inject the repository
    public function __construct(UserContractRepository $userContractRepository)
    {
        $this->userContractRepository = $userContractRepository;
    }

    /**
     * Get user contract by user ID
     *
     * @param int $userId
     * @return UserContract|null
     */
    public function getUserContractByUserId($userId)
    {
        // Retrieve the user contract based on user ID from the repository
        return $this->userContractRepository->findUserContractByUserId($userId);
    }

    /**
     * Create a new user contract
     *
     * @param array $data
     * @return UserContract
     */
    public function createUserContract(array $data)
    {
        // Create a new user contract through the repository
        return $this->userContractRepository->createUserContract($data);
    }

    /**
     * Update an existing user contract
     *
     * @param int $id
     * @param array $data
     * @return UserContract|null
     */
    public function updateUserContract($id, array $data)
    {
        // Update the user contract by ID through the repository
        return $this->userContractRepository->updateUserContract($id, $data);
    }

    /**
     * Delete a user contract
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserContract($id)
    {
        // Delete the user contract by ID through the repository
        return $this->userContractRepository->deleteUserContract($id);
    }
}
