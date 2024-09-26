<?php

namespace App\Services;

use App\Models\Follower;
use App\Repositories\User\FollowerRepository;

class FollowerService
{
    // Repository instance for FollowerRepository
    protected FollowerRepository $followerRepository;

    public function __construct(FollowerRepository $followerRepository)
    {
        $this->followerRepository = $followerRepository;
    }

    /**
     * Get follower by user ID
     *
     * @param int $userId
     * @return Follower|null
     */
    public function getFollowerByUserId($userId)
    {
        // Retrieve the follower based on user ID from the repository
        return $this->followerRepository->findFollowerByUserId($userId);
    }

    /**
     * Create a new follower
     *
     * @param array $data
     * @return Follower
     */
    public function createFollower(array $data)
    {
        // Create a new follower  through the repository
        return $this->followerRepository->createFollower($data);
    }

    /**
     * Update an existing follower
     *
     * @param int $id
     * @param array $data
     * @return Follower|null
     */
    public function updateFollower($id, array $data)
    {
        // Update the follower by ID through the repository
        return $this->followerRepository->updateFollower($id, $data);
    }

    /**
     * Delete a follower
     *
     * @param int $id
     * @return bool
     */
    public function deleteFollower($id)
    {
        // Delete the follower by ID through the repository
        return $this->followerRepository->deleteFollower($id);
    }
}
