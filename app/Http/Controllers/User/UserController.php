<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Services\UserService;
use App\Http\Requests\User\{UserStoreRequest,UserUpdateRequest,SubordinateRequest};
use App\Traits\TranslatableTrait;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;
    use TranslatableTrait;
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
     * Get users where level equal one
     */
    public function levelOne(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve users with pagination
        $users = $this->userService->levelOne($perPage);

        return $this->successResponse(UserResource::collection($users), 'Level one users retrieved successfully');
    }

    /*
     * Get users where level equal one
     */
    public function levelOneAndTwo(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve users with pagination
        $users = $this->userService->levelOneAndTwo($perPage);

        return $this->successResponse(UserResource::collection($users), 'Users where Level equal one or two retrieved successfully');
    }

    /*
     * Get subordinates by userId
     */
    public function subordinates($userId): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve subordinates with pagination
        $subordinates = $this->userService->subordinates($userId,$perPage);

        return $this->successResponse(UserResource::collection($subordinates), 'Subordinatess retrieved successfully!');
    }

    /*
     * add subordinate for user
     */
    public function addSubordinate(SubordinateRequest $request, $userId): JsonResponse
    {
        $data = $request->validated();

        // add new subordinate
        $user = $this->userService->addSubordinate($userId,$data);
        if (!$user) {
            return $this->errorResponse('Subordinate not found', 404);
        }

        return $this->successResponse(UserResource::make($user),'Subordinate added successfully!');
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
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');

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
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');

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
