<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserIdentityResource;
use App\Services\UserIdentityService;
use App\Http\Requests\User\UserIdentityStoreRequest;
use App\Http\Requests\User\UserIdentityUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class UserIdentityController extends Controller
{
    use ApiResponse;

    protected UserIdentityService $userIdentityService;

    public function __construct(UserIdentityService $userIdentityService)
    {
        // Inject the service responsible for handling business logic
        $this->userIdentityService = $userIdentityService;
    }

    /**
     * Show user identity based on user ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Get user identity by user_id
        $userIdentity = $this->userIdentityService->getUserIdentityByUserId($userId);

        // Check if user identity is not found
        if (!$userIdentity) {
            return $this->errorResponse('User identity not found', 404);
        }

        // Return success response with user identity data
        return $this->successResponse(new UserIdentityResource($userIdentity), 'User identity retrieved successfully');
    }

    /**
     * Create a new user identity
     *
     * @param UserIdentityStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserIdentityStoreRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->all();

        // Create a new user identity
        $userIdentity = $this->userIdentityService->createUserIdentity($data);

        // Return success response with the created user identity
        return $this->successResponse(new UserIdentityResource($userIdentity), 'User identity created successfully', 200);
    }

    /**
     * Update an existing user identity
     *
     * @param UserIdentityUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserIdentityUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        // Update the user identity based on ID
        $userIdentity = $this->userIdentityService->updateUserIdentity($id, $data);

        // Check if the user identity is not found
        if (!$userIdentity) {
            return $this->errorResponse('User identity not found', 404);
        }

        // Return success response with the updated user identity
        return $this->successResponse(new UserIdentityResource($userIdentity), 'User identity updated successfully');
    }

    /**
     * Delete a user identity
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the user identity by ID
        $deleted = $this->userIdentityService->deleteUserIdentity($id);

        // Check if the user identity is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('User identity not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'User identity deleted successfully', 200);
    }
}
