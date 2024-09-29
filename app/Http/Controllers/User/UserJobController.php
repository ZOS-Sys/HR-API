<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserJobResource;
use App\Services\UserJobService;
use App\Http\Requests\User\UserJobStoreRequest;
use App\Http\Requests\User\UserJobUpdateRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use App\Models\UserJob;

class UserJobController extends Controller
{
    use ApiResponse;

    protected UserJobService $userJobService;

    public function __construct(UserJobService $userJobService)
    {
        // Inject the service responsible for handling business logic
        $this->userJobService = $userJobService;
    }

    /**
     * Show user job based on user ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Get user job by user_id
        $userJob = $this->userJobService->getUserJobByUserId($userId);

        // Check if user job is not found
        if (!$userJob) {
            return $this->errorResponse('User job not found', 404);
        }

        // Return success response with user job data
        return $this->successResponse(new UserJobResource($userJob), 'User job retrieved successfully');
    }

    /**
     * Create a new user job
     *
     * @param UserJobStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserJobStoreRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->validated();

        // check for direct manager
        $data['direct_manager'] = $data['job_level'] == 1 ? NULL : $data['direct_manager'];
        if($data['direct_manager'])
        {
            $level = $data['job_level'] == 2 ? [1] : [1,2];
            $managerLevel = UserJob::where('user_id',$data['direct_manager'])->first()?->job_level;
            if(!in_array($managerLevel,$level))
            {
                return $this->errorResponse('direct manager not found', 404);
            }
        }

        // Create a new user job
        $userJob = $this->userJobService->createUserJob($data);

        // Return success response with the created user job
        return $this->successResponse(new UserJobResource($userJob), 'User job created successfully', 200);
    }

    /**
     * Update an existing user job
     *
     * @param UserJobUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserJobUpdateRequest $request, $id): JsonResponse
    {
        // Get only the fields that were sent
        $data = $request->all();

        // If job_level is provided, apply the logic related to it
        if (isset($data['job_level'])) {
            $data['direct_manager'] = $data['job_level'] == 1 ? NULL : $data['direct_manager'];
            if ($data['direct_manager']) {
                $level = $data['job_level'] == 2 ? [1] : [1, 2];
                $managerLevel = UserJob::where('user_id', $data['direct_manager'])->first()?->job_level;
                if (!in_array($managerLevel, $level)) {
                    return $this->errorResponse('direct manager not found', 404);
                }
            }
        }

        // Update only the fields that were sent (skip null or empty ones)
        $userJob = $this->userJobService->updateUserJob($id, array_filter($data));

        if (!$userJob) {
            return $this->errorResponse('User job not found', 404);
        }

        return $this->successResponse(new UserJobResource($userJob), 'User job updated successfully');
    }
    /**
     * Delete a user job
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the user job by ID
        $deleted = $this->userJobService->deleteUserJob($id);

        // Check if the user job is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('User job not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'User job deleted successfully', 200);
    }
}
