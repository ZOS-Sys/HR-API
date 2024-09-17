<?php

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    protected User $user;

    /*
     * Inject the Admin model
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /*
     *  Create a new admin
     */
    public function create(array $data): User
    {
        return $this->user->create($data);
    }

}
