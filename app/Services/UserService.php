<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    // Inject the UserRepository
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /*
     * Get all users
     */
    public function getAllUsers($perPage)
    {
        return $this->userRepository->getAllUsers($perPage);
    }

    /*
     * Find a user by ID
     */
    public function getUserById($id)
    {
        return $this->userRepository->findUserById($id);
    }

    /*
     * Create a new user
     */
    public function createUser(array $data)
    {
        return $this->userRepository->createUser($data);
    }

    /*
     * Update user
     */
    public function updateUser($id, array $data)
    {
        return $this->userRepository->updateUser($id, $data);
    }

    /*
     *  Delete a user
     */
    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
