<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\JobTitleService;
use App\Http\Requests\User\JobTitleStoreRequest;
use App\Http\Requests\User\JobTitleUpdateRequest;
use App\Http\Resources\User\JobTitleResource;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use App\Traits\TranslatableTrait;

class JobTitleController extends Controller
{
    use ApiResponse, TranslatableTrait;

    protected JobTitleService $jobTitleService;

    /**
     * Constructor to inject JobTitleService dependency.
     *
     * @param JobTitleService $jobTitleService
     */
    public function __construct(JobTitleService $jobTitleService)
    {
        $this->jobTitleService = $jobTitleService;
    }

    /**
     * Get all job titles with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->get('per_page', 10);
        $jobTitles = $this->jobTitleService->getAllJobTitles($perPage);
        return $this->successResponse(JobTitleResource::collection($jobTitles), 'Job Titles retrieved successfully');
    }

    /**
     * Show a specific job title by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $jobTitle = $this->jobTitleService->getJobTitleById($id);
        // check if found
        if (!$jobTitle) {
            return $this->errorResponse('Job Title not found', 404);
        }
        return $this->successResponse(new JobTitleResource($jobTitle), 'Job Title retrieved successfully');
    }

    /**
     * Get job titles by branch_id.
     *
     * @param int $branch_id
     * @return JsonResponse
     */
    public function jobTitlesByBranch($branch_id): JsonResponse
    {
        $perPage = request()->get('per_page', 10);
        $jobTitles = $this->jobTitleService->jobTitlesByBranch($branch_id,$perPage);
        return $this->successResponse(JobTitleResource::collection($jobTitles), 'Job Titles retrieved successfully');
    }

    /**
     * Create a new job title.
     *
     * @param JobTitleStoreRequest $request
     * @return JsonResponse
     */
    public function store(JobTitleStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Handle translatable data for the title field in English and Arabic
        $data['title'] = $this->handleTranslatableData($data, 'title');

        // Call the service to create a new job title
        $jobTitle = $this->jobTitleService->createJobTitle($data);

        // Load the branch relationship
        $jobTitle->load('branch');

        // Return a successful response with the created job title
        return $this->successResponse(new JobTitleResource($jobTitle), 'Job Title created successfully', 200);
    }

    /**
     * Update an existing job title by its ID.
     *
     * @param JobTitleUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(JobTitleUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        // Handle translatable data for the title field in English and Arabic
        $data['title'] = $this->handleTranslatableData($data, 'title');


        // Call the service to update the job title by its ID
        $jobTitle = $this->jobTitleService->updateJobTitleById($id, $data);
        if (!$jobTitle) {
            return $this->errorResponse('Job Title not found', 404);
        }

        // Load the branch relationship
        $jobTitle->load('branch');

        // Return a successful response with the updated job title
        return $this->successResponse(new JobTitleResource($jobTitle), 'Job Title updated successfully');
    }

    /**
     * Delete a job title by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->jobTitleService->deleteJobTitleById($id);
        // check if deleted
        if (!$deleted) {
            return $this->errorResponse('Job Title not found', 404);
        }

        // Return a successful response confirming deletion
        return $this->successResponse(null, 'Job Title deleted successfully', 200);
    }
}
