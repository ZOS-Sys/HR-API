<?php

namespace App\Repositories\User;

use App\Models\Allowance;

class AllowanceRepository
{
    // Model instance for Allowance
    protected Allowance $allowance;

    public function __construct(Allowance $allowance)
    {
        $this->allowance = $allowance;
    }

    /**
     * Find an allowance by its ID.
     *
     * @param int $id
     * @return Allowance|null
     */
    public function findAllowanceById($id)
    {
        return $this->allowance->with('currency')->find($id);
    }

    /**
     * Get all allowances with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllAllowances($perPage)
    {
        return $this->allowance->paginate($perPage);
    }

    /**
     * Create a new allowance.
     *
     * @param array $data
     * @return Allowance
     */
    public function createAllowance(array $data)
    {
        return $this->allowance->create($data);
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
        $allowance = $this->findAllowanceById($id);
        if ($allowance) {
            $allowance->update($data);
        }
        return $allowance;
    }

    /**
     * Delete an allowance by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteAllowance($id)
    {
        $allowance = $this->findAllowanceById($id);
        if ($allowance) {
            return $allowance->delete();
        }

        return false;
    }
}
