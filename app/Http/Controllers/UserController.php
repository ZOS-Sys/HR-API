<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    protected UserService $userService;

    // Inject the UserService
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /*
     * Get all users
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve users with pagination
        $users = $this->userService->getAllUsers($perPage);

        return $this->successResponse(UserResource::collection($users), 'Users retrieved successfully');
    }

    /*
     * Get a user by ID
     */
    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }
        return $this->successResponse(new UserResource($user), 'User retrieved successfully');
    }

    /*
     * Create a new user
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Handle Translatable Data
        $data['first_name'] = ['en' => $data['first_name_en'], 'ar' => $data['first_name_ar'] ?? null];
        $data['last_name'] = ['en' => $data['last_name_en'], 'ar' => $data['last_name_ar'] ?? null];

        if (isset($data['middle_name_en']) || isset($data['middle_name_ar'])) {
            $data['middle_name'] = [
                'en' => $data['middle_name_en'] ?? null,
                'ar' => $data['middle_name_ar'] ?? null,
            ];
        }

        // Hash the password
        $data['password'] = bcrypt($data['password']);

        $user = $this->userService->createUser($data);
        return $this->successResponse(new UserResource($user), 'User created successfully', 200);
    }

    /*
     * Update a user
     */
    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        // Handle Translatable Data
        if (isset($data['first_name_en']) || isset($data['first_name_ar'])) {
            $data['first_name'] = ['en' => $data['first_name_en'] ?? null, 'ar' => $data['first_name_ar'] ?? null];
        }

        if (isset($data['last_name_en']) || isset($data['last_name_ar'])) {
            $data['last_name'] = ['en' => $data['last_name_en'] ?? null, 'ar' => $data['last_name_ar'] ?? null];
        }

        if (isset($data['middle_name_en']) || isset($data['middle_name_ar'])) {
            $data['middle_name'] = [
                'en' => $data['middle_name_en'] ?? null,
                'ar' => $data['middle_name_ar'] ?? null,
            ];
        }

        $user = $this->userService->updateUser($id, $data);
        if (!$user) {
            return $this->errorResponse('User not found', 404);
        }
        return $this->successResponse(new UserResource($user), 'User updated successfully');
    }

    /*
     * Delete a user
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->userService->deleteUser($id);
        if (!$deleted) {
            return $this->errorResponse('User not found', 404);
        }
        return $this->successResponse(null, 'User deleted successfully', 200);
    }
}
