<?php

namespace App\Services;

use App\Models\JobTitle;
use App\Repositories\User\JobTitleRepository;

class JobTitleService
{
    protected JobTitleRepository $jobTitleRepository;

    /**
     * Constructor to inject JobTitleRepository dependency.
     *
     * @param JobTitleRepository $jobTitleRepository
     */
    public function __construct(JobTitleRepository $jobTitleRepository)
    {
        $this->jobTitleRepository = $jobTitleRepository;
    }

    /**
     * Get all job titles with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllJobTitles($perPage)
    {
        // Get all job titles with the branch relationship
        return $this->jobTitleRepository->getAllJobTitles($perPage);
    }

    /**
     * Get a job title by ID with its branch relationship.
     *
     * @param int $id
     * @return JobTitle|null
     */
    public function getJobTitleById($id)
    {
        // Find the job title by ID and load the branch relationship
        return JobTitle::with('branch')->find($id);
    }

    /**
     * Create a new job title.
     *
     * @param array $data
     * @return JobTitle
     */
    public function createJobTitle(array $data)
    {
        // Create a new job title
        return $this->jobTitleRepository->createJobTitle($data);
    }

    /**
     * Update a job title by ID.
     *
     * @param int $id
     * @param array $data
     * @return JobTitle|null
     */
    public function updateJobTitleById($id, array $data)
    {
        // Update the job title by ID
        return $this->jobTitleRepository->updateJobTitleById($id, $data);
    }

    /**
     * Delete a job title by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteJobTitleById($id)
    {
        // Delete the job title by ID
        return $this->jobTitleRepository->deleteJobTitleById($id);
    }
}
