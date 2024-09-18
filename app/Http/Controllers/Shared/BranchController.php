<?php

namespace App\Http\Controllers\Shared;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Branch\BranchResource;
use App\Services\BranchService;
use App\Http\Requests\Branch\{StoreBranchRequest,UpdateBranchRequest};
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class BranchController extends Controller
{
    use ApiResponse;

    protected BranchService $branchService;

    public function __construct(BranchService $branchService)
    {
        // Inject the service responsible for handling business logic
        $this->branchService = $branchService;
    }

    /*
     * Get all branches
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve branches with pagination
        $branches = $this->branchService->getAllBranches($perPage);

        return $this->successResponse(BranchResource::collection($branches), 'Branches retrieved successfully');
    }

    /**
     * Show branch based on ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Get branch by id
        $branch = $this->branchService->getBranchById($id);

        // Check if branch is not found
        if (!$branch) {
            return $this->errorResponse('Branch not found', 404);
        }

        // Return success response with branch data
        return $this->successResponse(new BranchResource($branch), 'Branch retrieved successfully');
    }

    /**
     * Create a new branch
     *
     * @param StoreBranchRequest $request
     * @return JsonResponse
     */
    public function store(StoreBranchRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->validated();

        // Check if there is a file in the request and upload it
        $data['logo'] = $request->hasFile('logo') ? HandleUpload::uploadFile($request->logo , 'branches') : NULL;

        $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        // Create a new branch
        $branch = $this->branchService->createBranch($data);

        // Return success response with the created branch
        return $this->successResponse(new BranchResource($branch), 'Branch created successfully', 200);
    }

    /**
     * Update an existing branch
     *
     * @param UpdateBranchRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateBranchRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Get the existing branch to get the old file path
        $existingBranch = $this->branchService->getBranchById($id);

        if (!$existingBranch) {
            return $this->errorResponse('Branch not found', 404); // Return error if not found
        }

        // Check if there is a file in the request and upload it
        $data['logo'] = $request->hasFile('logo') ? HandleUpload::uploadFile($request->logo , 'branches') : $existingBranch->logo;

        $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        // Update the branch based on ID
        $branch = $this->branchService->updateBranch($id, $data);

        // Check if the branch is not found
        if (!$branch) {
            return $this->errorResponse('Branch not found', 404);
        }

        // Return success response with the updated branch
        return $this->successResponse(new BranchResource($branch), 'Branch updated successfully');
    }

    /**
     * Delete a branch
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the branch by ID
        $deleted = $this->branchService->deleteBranch($id);

        // Check if the branch is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Branch not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Branch deleted successfully', 200);
    }
}
