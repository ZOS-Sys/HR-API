<?php

namespace App\Repositories\Shared;

use App\Models\Branch;

class BranchRepository
{
    // Model instance for the branch
    protected Branch $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    // Get all branches
    public function getAllBranches($perPage)
    {
        return $this->branch->paginate($perPage);
    }

    /**
     * Find a branch by the id.
     * This retrieves the branch based on the id.
     *
     * @param int $id
     * @return Branch|null
     */
    public function findBranchById($id)
    {
        return $this->branch->where('id', $id)->first();
    }

    /**
     * Create a new branch in the database.
     *
     * @param array $data
     * @return Branch
     */
    public function createBranch(array $data)
    {
        return $this->branch->create($data);
    }

    /**
     * Update an existing branch by ID.
     *
     * @param int $id
     * @param array $data
     * @return Branch|null
     */
    public function updateBranch($id, array $data)
    {
        // Find the branch by ID
        $branch = $this->findBranchById($id);
        if ($branch) {
            // If the branch exists, update it with the provided data
            $branch->update($data);
        }
        // Return the updated branch
        return $branch;
    }

    /**
     * Delete a branch by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBranch($id)
    {
        // Find the branch by ID
        $branch = $this->findBranchById($id);
        if ($branch) {
            // If found, delete the branch and return true
            return $branch->delete();
        }

        return false;
    }
}