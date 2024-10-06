<?php

namespace App\Repositories\User;

use App\Models\JobTitle;

class JobTitleRepository
{
    protected JobTitle $jobTitle;

    /**
     * Constructor to inject JobTitle model dependency.
     *
     * @param JobTitle $jobTitle
     */
    public function __construct(JobTitle $jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * Get all job titles with pagination and load the branch relationship.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllJobTitles($perPage)
    {
        // Get all job titles and include the branch relationship
        return $this->jobTitle->with('branch')->paginate($perPage);
    }

    /**
     * Get branch job titles with pagination
     *
     * @param int $branch_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function jobTitlesByBranch($branch_id,$perPage)
    {
        // Get branch job titles
        return $this->jobTitle->where('branch_id',$branch_id)->paginate($perPage);
    }

    /**
     * Find a job title by ID and load the branch relationship.
     *
     * @param int $id
     * @return JobTitle|null
     */
    public function findJobTitleById($id)
    {
        // Find the job title by ID and include the branch relationship
        return $this->jobTitle->with('branch')->find($id);
    }

    /**
     * Create a new job title.
     *
     * @param array $data
     * @return JobTitle
     */
    public function createJobTitle(array $data)
    {
        // Create a new job title with the provided data
        return $this->jobTitle->create($data);
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
        // Find the job title by ID
        $jobTitle = $this->findJobTitleById($id);

        // check If the job title exists, update it with the provided data
        if ($jobTitle) {
            $jobTitle->update($data);
        }

        return $jobTitle;
    }

    /**
     * Delete a job title by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteJobTitleById($id)
    {
        // Find the job title by ID
        $jobTitle = $this->findJobTitleById($id);

        // If the job title exists, delete it
        if ($jobTitle) {
            return $jobTitle->delete();
        }

        return false;
    }
}
