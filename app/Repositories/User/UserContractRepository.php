<?php

namespace App\Repositories\User;

use App\Models\UserContract;

class UserContractRepository
{
    protected UserContract $userContract;

    public function __construct(UserContract $userContract)
    {
        // Inject the model instance for UserContract
        $this->userContract = $userContract;
    }

    /**
     * Find a user contract by the user_id.
     * This retrieves the user contract based on the user ID.
     *
     * @param int $userId
     * @return UserContract|null
     */
    public function findUserContractByUserId($userId)
    {
        // Get the user contract from User
        return $this->userContract->with('user')->where('user_id', $userId)->first();
    }

    /**
     * Create a new user contract in the database.
     *
     * @param array $data
     * @return UserContract
     */
    public function createUserContract(array $data)
    {
        // Create a new record for the user contract using the provided data
        return $this->userContract->create($data);
    }

    /**
     * Update an existing user contract by ID.
     *
     * @param int $id
     * @param array $data
     * @return UserContract|null
     */
    public function updateUserContract($id, array $data)
    {
        // Find the user contract by user ID
        $userContract = $this->findUserContractByUserId($id);
        if ($userContract) {
            // If the user contract exists, update it with the provided data
            $userContract->update($data);
        }
        return $userContract;
    }

    /**
     * Delete a user contract by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserContract($id)
    {
        // Find the user contract by user ID
        $userContract = $this->findUserContractByUserId($id);
        if ($userContract) {
            // If found, delete the user contract and return true
            return $userContract->delete();
        }

        return false;
    }
}
