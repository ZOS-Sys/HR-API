<?php

namespace App\Services;

use App\Models\Branch;
use App\Repositories\Shared\BranchRepository;

class BranchService
{
    protected BranchRepository $branchRepository;


    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    /*
     * Get all branches
     */
    public function getAllBranches($perPage)
    {
        return $this->branchRepository->getAllBranches($perPage);
    }

    /**
     * Get branch by ID
     *
     * @param int $id
     * @return Branch|null
     */
    public function getBranchById($id)
    {

        return $this->branchRepository->findBranchById($id);
    }

    /**
     * Create a new branch
     *
     * @param array $data
     * @return Branch
     */
    public function createBranch(array $data)
    {
        return $this->branchRepository->createBranch($data);
    }

    /**
     * Update an existing branch
     *
     * @param int $id
     * @param array $data
     * @return Branch|null
     */
    public function updateBranch($id, array $data)
    {
        return $this->branchRepository->updateBranch($id, $data);
    }

    /**
     * Delete a branch
     *
     * @param int $id
     * @return bool
     */
    public function deleteBranch($id)
    {
        return $this->branchRepository->deleteBranch($id);
    }
}