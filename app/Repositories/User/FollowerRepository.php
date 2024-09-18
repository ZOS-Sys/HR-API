<?php

namespace App\Repositories\User;

use App\Models\Follower;

class FollowerRepository
{
    protected Follower $follower;

    // Constructor to inject the Follower model
    public function __construct(Follower $follower)
    {
        $this->follower = $follower;
    }

    /**
     * Find a follower by the user_id.
     * This retrieves the follower based on the user ID.
     *
     * @param int $userId
     * @return Follower|null
     */
    public function findFollowerByUserId($userId)
    {
        // Get the follower using the user_id and load related user data
        return $this->follower->with('user')->where('user_id', $userId)->first();
    }

    /**
     * Create a new follower in the database.
     *
     * @param array $data
     * @return Follower
     */
    public function createFollower(array $data)
    {
        // Create a new record for the follower using the data
        return $this->follower->create($data);
    }

    /**
     * Update an existing follower by ID.
     *
     * @param int $id
     * @param array $data
     * @return Follower|null
     */
    public function updateFollower($id, array $data)
    {
        // Find the follower by user ID
        $follower = $this->findFollowerByUserId($id);
        if ($follower) {
            // If the follower exists, update it with the provided data
            $follower->update($data);
        }
        // Return the updated follower
        return $follower;
    }

    /**
     * Delete a follower by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFollower($id)
    {
        // Find the follower by user ID
        $follower = $this->findFollowerByUserId($id);
        if ($follower) {
            // If found, delete the follower and return true
            return $follower->delete();
        }

        return false;
    }
}
