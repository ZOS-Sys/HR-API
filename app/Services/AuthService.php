<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    protected AuthRepository $authRepository;

    // Inject the AuthRepository
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /*
     * Register a new User
     */
    public function register(array $data): User
    {
        // Hash the password before passing it to the repository
        $data['password'] = Hash::make($data['password']);

        //Handle Trans Data
        $data['first_name'] = ['en' => $data['first_name_en'], 'ar' => $data['first_name_ar'] ?? null];
        $data['last_name'] = ['en' => $data['last_name_en'], 'ar' => $data['last_name_ar'] ?? null];
        $data['middle_name'] = isset($data['middle_name_en']) || isset($data['middle_name_ar'])
            ? ['en' => $data['middle_name_en'] ?? null, 'ar' => $data['middle_name_ar'] ?? null]
            : null;

        //  create the user
        return $this->authRepository->create($data);
    }

    /*
     * Login and return JWT token
     */
    public function login(array $credentials): ?string
    {
        // Attempt to authenticate the admin using the 'admin' guard
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return null; // Authentication failed
        }

        return $token;
    }
}
