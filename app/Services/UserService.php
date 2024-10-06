<?php

namespace App\Services;

use App\Repositories\User\UserRepository;

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
     * Get users where level equal one
     */
    public function levelOne($perPage)
    {
        return $this->userRepository->levelOne($perPage);
    }

    /*
     * Get users where level equal one or two
     */
    public function levelOneAndTwo($perPage)
    {
        return $this->userRepository->levelOneAndTwo($perPage);
    }

    /*
     * Get users where level equal three
     */
    public function levelThree($perPage)
    {
        return $this->userRepository->levelThree($perPage);
    }

    /*
     * Get users where level equal three or two
     */
    public function levelThreeAndTwo($perPage)
    {
        return $this->userRepository->levelThreeAndTwo($perPage);
    }

     /*
     * Get subordinates by userId
     */
    public function subordinates($userId,$perPage)
    {
        return $this->userRepository->subordinates($userId,$perPage);
    }

    /*
     * add new subordinate for user
     */
    public function addSubordinate($userId,$data)
    {
        return $this->userRepository->addSubordinate($userId,$data);
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
     * Update user contacts
     */
    public function updateUserContacts($id, array $data)
    {
        return $this->userRepository->updateUserContacts($id,$data);
    }

    /*
     * Update user image
     */
    public function updateUserImage($id, array $data)
    {
        return $this->userRepository->updateUserImage($id,$data);
    }

    /*
     *  Delete a user
     */
    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
