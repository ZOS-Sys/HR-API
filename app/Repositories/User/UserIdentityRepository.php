<?php

namespace App\Repositories\User;

use App\Models\UserIdentity;

class UserIdentityRepository
{
    // Model instance for the UserIdentity
    protected UserIdentity $userIdentity;

    public function __construct(UserIdentity $userIdentity)
    {
        $this->userIdentity = $userIdentity;
    }

    /**
     * Find a user identity by the user_id.
     * This retrieves the user identity based on the user ID, not the identity's ID.
     *
     * @param int $userId
     * @return UserIdentity|null
     */
    public function findUserIdentityByUserId($userId)
    {
        return $this->userIdentity->with('user')->where('user_id', $userId)->first();
    }

    /**
     * Create a new user identity in the database.
     *
     * @param array $data
     * @return UserIdentity
     */
    public function createUserIdentity(array $data)
    {
        return $this->userIdentity->create($data);
    }

    /**
     * Update an existing user identity by ID.
     *
     * @param int $id
     * @param array $data
     * @return UserIdentity|null
     */
    public function updateUserIdentity($id, array $data)
    {
        // Find the user identity by ID
        $userIdentity = $this->findUserIdentityByUserId($id);
        if ($userIdentity) {
            // If the user identity exists, update it with the provided data
            $userIdentity->update($data);
        }
        // Return the updated user identity
        return $userIdentity;
    }

    /**
     * Delete a user identity by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUserIdentity($id)
    {
        // Find the user identity by ID
        $userIdentity = $this->findUserIdentityByUserId($id);
        if ($userIdentity) {
            // If found, delete the user identity and return true
            return $userIdentity->delete();
        }

        return false;
    }
}
