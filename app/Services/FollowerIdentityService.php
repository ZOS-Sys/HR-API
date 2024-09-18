<?php

namespace App\Services;

use App\Models\FollowerIdentity;
use App\Repositories\User\FollowerIdentityRepository;

class FollowerIdentityService
{
    // Repository instance for FollowerIdentityRepository
    protected FollowerIdentityRepository $followerIdentityRepository;

    public function __construct(FollowerIdentityRepository $followerIdentityRepository)
    {
        // Inject the repository responsible for interacting with the database
        $this->followerIdentityRepository = $followerIdentityRepository;
    }

    /**
     * Get follower identity by follower ID
     *
     * @param int $followerId
     * @return FollowerIdentity|null
     */
    public function getFollowerIdentityByFollowerId($followerId)
    {
        // Retrieve the follower identity based on follower ID from the repository
        return $this->followerIdentityRepository->findFollowerIdentityByFollowerId($followerId);
    }

    /**
     * Create a new follower identity
     *
     * @param array $data
     * @return FollowerIdentity
     */
    public function createFollowerIdentity(array $data)
    {
        // Create a new follower identity through the repository
        return $this->followerIdentityRepository->createFollowerIdentity($data);
    }

    /**
     * Update an existing follower identity
     *
     * @param int $id
     * @param array $data
     * @return FollowerIdentity|null
     */
    public function updateFollowerIdentity($id, array $data)
    {
        // Update the follower identity by follower ID through the repository
        return $this->followerIdentityRepository->updateFollowerIdentity($id, $data);
    }

    /**
     * Delete a follower identity
     *
     * @param int $id
     * @return bool
     */
    public function deleteFollowerIdentity($id)
    {
        // Delete the follower identity by follower ID through the repository
        return $this->followerIdentityRepository->deleteFollowerIdentity($id);
    }
}
