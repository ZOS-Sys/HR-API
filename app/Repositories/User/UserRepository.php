<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository
{
    protected User $user;

    // Inject the User model
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Get all users
    public function getAllUsers($perPage)
    {
        return $this->user->paginate($perPage);

    }

    // Find a user by ID
    public function findUserById($id)
    {
        return $this->user->find($id);
    }

    // Create a new user
    public function createUser(array $data)
    {
        return $this->user->create($data);
    }

    // Update an existing user
    public function updateUser($id, array $data)
    {
        $user = $this->findUserById($id);
        if ($user) {
            $user->update($data);
        }
        return $user;
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = $this->findUserById($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
