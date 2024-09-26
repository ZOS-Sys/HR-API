<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\FollowerResource;
use App\Models\Follower;
use App\Services\FollowerService;
use App\Http\Requests\User\FollowerStoreRequest;
use App\Http\Requests\User\FollowerUpdateRequest;
use App\Traits\TranslatableTrait;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class FollowerController extends Controller
{
    use ApiResponse;
    use TranslatableTrait;
    protected FollowerService $followerService;
    protected Follower $follower;

    public function __construct(FollowerService $followerService , Follower $follower)
    {
        $this->followerService = $followerService;
        $this->follower = $follower;
    }

    /**
     * Show follower based on user ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Get follower by user_id
        $followers = $this->followerService->getFollowerByUserId($userId);

        // Check if follower is not found
        if (!$followers) {
            return $this->errorResponse('Follower not found', 404);
        }

        // Return success response with follower data
        return $this->successResponse(FollowerResource::collection($followers), 'Follower retrieved successfully');
    }

    /**
     * Create a new follower
     *
     * @param FollowerStoreRequest $request
     * @return JsonResponse
     */
    public function store(FollowerStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Handle Translatable Data
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');

        // Create a new follower
        $follower = $this->followerService->createFollower($data);

        // Return success response with the created follower
        return $this->successResponse(new FollowerResource($follower), 'Follower created successfully', 200);
    }

    /**
     * Update an existing follower
     *
     * @param FollowerUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(FollowerUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();
        // Handle Translatable Data
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');
        // Update the follower based on ID
        $follower = $this->followerService->updateFollower($id, $data);

        // Check if the follower is not found
        if (!$follower) {
            return $this->errorResponse('Follower not found', 404);
        }

        // Return success response with the updated follower
        return $this->successResponse(new FollowerResource($follower), 'Follower updated successfully');
    }

    /**
     * Delete a follower
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the follower by ID
        $deleted = $this->followerService->deleteFollower($id);

        // Check if the follower is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Follower not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Follower deleted successfully', 200);
    }
}
