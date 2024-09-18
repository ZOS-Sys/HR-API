<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\FollowerIdentityResource;
use App\Services\FollowerIdentityService;
use App\Http\Requests\User\FollowerIdentityStoreRequest;
use App\Http\Requests\User\FollowerIdentityUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class FollowerIdentityController extends Controller
{
    use ApiResponse;

    protected FollowerIdentityService $followerIdentityService;

    public function __construct(FollowerIdentityService $followerIdentityService)
    {
        // Inject the service responsible for handling business logic
        $this->followerIdentityService = $followerIdentityService;
    }

    /**
     * Show follower identity based on follower ID
     *
     * @param int $followerId
     * @return JsonResponse
     */
    public function show($followerId): JsonResponse
    {
        // Get follower identity by follower_id
        $followerIdentity = $this->followerIdentityService->getFollowerIdentityByFollowerId($followerId);

        // Check if follower identity is not found
        if (!$followerIdentity) {
            return $this->errorResponse('Follower identity not found', 404);
        }

        // Return success response with follower identity data
        return $this->successResponse(new FollowerIdentityResource($followerIdentity), 'Follower identity retrieved successfully');
    }

    /**
     * Create a new follower identity
     *
     * @param FollowerIdentityStoreRequest $request
     * @return JsonResponse
     */
    public function store(FollowerIdentityStoreRequest $request): JsonResponse
    {

        $data = $request->all();

        // Create a new follower identity
        $followerIdentity = $this->followerIdentityService->createFollowerIdentity($data);

        // Return success response with the created follower identity
        return $this->successResponse(new FollowerIdentityResource($followerIdentity), 'Follower identity created successfully', 200);
    }

    /**
     * Update an existing follower identity
     *
     * @param FollowerIdentityUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(FollowerIdentityUpdateRequest $request, $id): JsonResponse
    {

        $data = $request->all();

        // Update the follower identity based on ID
        $followerIdentity = $this->followerIdentityService->updateFollowerIdentity($id, $data);

        // Check if the follower identity is not found
        if (!$followerIdentity) {
            return $this->errorResponse('Follower identity not found', 404);
        }

        // Return success response with the updated follower identity
        return $this->successResponse(new FollowerIdentityResource($followerIdentity), 'Follower identity updated successfully');
    }

    /**
     * Delete a follower identity
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the follower identity by User ID
        $deleted = $this->followerIdentityService->deleteFollowerIdentity($id);

        // Check if the follower identity is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Follower identity not found', 404);
        }

        // Return success response upon successful deletion
        return $this->successResponse(null, 'Follower identity deleted successfully', 200);
    }
}
