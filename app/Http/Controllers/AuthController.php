<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Traits\ApiResponse;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    use ApiResponse;

    protected AuthService $authService;

    // Inject the AuthService
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /*
     *  new registration
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // Get validated data
        $data = $request->validated();

        // Register the User
        $user = $this->authService->register($data);

        // Generate JWT token for the newly registered user
        $token = JWTAuth::fromUser($user);

        // Return success response with the user data (using UserResource) and token
        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'User registered successfully', 200);
    }

    /*
     * Handle login
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // Get validated data
        $credentials = $request->validated();

        // Attempt to login and get the token
        $token = $this->authService->login($credentials);

        if (!$token) {
            // Return unauthorized error
            return $this->unauthorizedResponse('Invalid credentials');
        }

        // Return the token in success response
        return $this->successResponse(['token' => $token], 'Login successful');
    }

    /*
     * Handle logout
     */
    public function logout(): JsonResponse
    {
        try {
            // Invalidate the token to logout
            JWTAuth::invalidate(JWTAuth::getToken());

            return $this->successResponse(null, 'Successfully logged out');
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to log out', 500);
        }
    }
}
