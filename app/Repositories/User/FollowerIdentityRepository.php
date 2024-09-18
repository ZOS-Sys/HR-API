<?php

namespace App\Repositories\User;

use App\Models\FollowerIdentity;

class FollowerIdentityRepository
{
    // Model instance for the FollowerIdentity
    protected FollowerIdentity $followerIdentity;

    // Constructor to inject the FollowerIdentity model
    public function __construct(FollowerIdentity $followerIdentity)
    {
        // Inject the model instance for FollowerIdentity
        $this->followerIdentity = $followerIdentity;
    }

    /**
     * Find a follower identity by the follower_id.
     *
     * @param int $followerId
     * @return FollowerIdentity|null
     */
    public function findFollowerIdentityByFollowerId($followerId)
    {
        // Fetch the follower identity using the follower_id
        return $this->followerIdentity->where('follower_id', $followerId)->first();
    }

    /**
     * Create a new follower identity in the database.
     *
     * @param array $data
     * @return FollowerIdentity
     */
    public function createFollowerIdentity(array $data)
    {
        // Create a new record for the follower identity using the data
        return $this->followerIdentity->create($data);
    }

    /**
     * Update an existing follower identity by ID.
     *
     * @param int $id
     * @param array $data
     * @return FollowerIdentity|null
     */
    public function updateFollowerIdentity($id, array $data)
    {
        // Find the follower identity by follower ID
        $followerIdentity = $this->findFollowerIdentityByFollowerId($id);
        if ($followerIdentity) {
            // If the follower identity exists, update it with the provided data
            $followerIdentity->update($data);
        }
        // Return the updated follower identity
        return $followerIdentity;
    }

    /**
     * Delete a follower identity by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFollowerIdentity($id)
    {
        // Find the follower identity by follower ID
        $followerIdentity = $this->findFollowerIdentityByFollowerId($id);
        if ($followerIdentity) {
            // If found, delete the follower identity and return true
            return $followerIdentity->delete();
        }

        return false;
    }
}
