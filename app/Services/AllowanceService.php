<?php

namespace App\Services;

use App\Repositories\User\AllowanceRepository;

class AllowanceService
{
    protected AllowanceRepository $allowanceRepository;

    public function __construct(AllowanceRepository $allowanceRepository)
    {
        $this->allowanceRepository = $allowanceRepository;
    }

    /**
     * Get an allowance by ID.
     *
     * @param int $id
     * @return Allowance|null
     */
    public function getAllowanceById($id)
    {
        return $this->allowanceRepository->findAllowanceById($id);
    }

    /**
     * Get all allowances with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllAllowances($perPage)
    {
        return $this->allowanceRepository->getAllAllowances($perPage);
    }

    /**
     * Create a new allowance.
     *
     * @param array $data
     * @return Allowance
     */
    public function createAllowance(array $data)
    {
        return $this->allowanceRepository->createAllowance($data);
    }

    /**
     * Update an existing allowance by ID.
     *
     * @param int $id
     * @param array $data
     * @return Allowance|null
     */
    public function updateAllowance($id, array $data)
    {
        return $this->allowanceRepository->updateAllowance($id, $data);
    }

    /**
     * Delete an allowance by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAllowance($id)
    {
        return $this->allowanceRepository->deleteAllowance($id);
    }
}
