<?php

namespace App\Http\Controllers\User;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserContractStoreRequest;
use App\Http\Requests\UserContractUpdateRequest;
use App\Http\Resources\User\UserContractResource;
use App\Services\UserContractService;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class UserContractController extends Controller
{
    use ApiResponse;

    protected UserContractService $userContractService;

    public function __construct(UserContractService $userContractService)
    {
        // Inject the service responsible for handling business logic
        $this->userContractService = $userContractService;
    }

    /**
     * Show user contract based on user ID
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Get user contract by user_id
        $userContract = $this->userContractService->getUserContractByUserId($userId);

        // Check if user contract is not found
        if (!$userContract) {
            return $this->errorResponse('User contract not found', 404);
        }

        // Return success response with user contract data
        return $this->successResponse(new UserContractResource($userContract), 'User contract retrieved successfully');
    }

    /**
     * Create a new user contract
     *
     * @param UserContractStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserContractStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Check if there is a file in the request and upload it
        if ($request->hasFile('file')) {
            $data['file'] = HandleUpload::uploadFile($request->file('file'), 'contracts');
        }

        // Create the new user contract
        $userContract = $this->userContractService->createUserContract($data);

        // Return success response with the created user contract
        return $this->successResponse(new UserContractResource($userContract), 'User contract created successfully', 200);
    }

    /**
     * Update an existing user contract
     *
     * @param UserContractUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserContractUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        // Get the existing contract from User to get the old file path
        $existingContract = $this->userContractService->getUserContractByUserId($id);

        // Check if a new file has been uploaded in the request
        if ($request->hasFile('file')) {
            // If a new file is uploaded, handle the file upload
            $data['file'] = HandleUpload::uploadFile($request->file('file'), 'contracts');
        } else {
            // If no new file is uploaded, retain the old file path
            $data['file'] = $existingContract->file;
        }

        // Update the existing contract with the new or retained data
        $userContract = $this->userContractService->updateUserContract($id, $data);

        // Check if the contract was not found
        if (!$userContract) {
            return $this->errorResponse('User contract not found', 404);
        }

        // Return success response with the updated contract
        return $this->successResponse(new UserContractResource($userContract), 'User contract updated successfully');
    }


    /**
     * Delete a user contract
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the user contract by ID
        $deleted = $this->userContractService->deleteUserContract($id);

        // Check if the user contract is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('User contract not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'User contract deleted successfully', 200);
    }
}
