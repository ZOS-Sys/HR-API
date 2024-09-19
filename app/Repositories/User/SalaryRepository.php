<?php

namespace App\Repositories\User;

use App\Models\Salary;

class SalaryRepository
{
    protected Salary $salary;

    public function __construct(Salary $salary)
    {
        $this->salary = $salary;
    }

    /**
     * Find a salary by user ID.
     *
     * @param int $userId
     * @return Salary|null
     */
    public function findSalaryByUserId($userId)
    {
        return $this->salary->where('user_id', $userId)->first();
    }

    /**
     * Get all salaries with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllSalaries($perPage)
    {
        return $this->salary->paginate($perPage);
    }

    /**
     * Create a new salary.
     *
     * @param array $data
     * @return Salary
     */
    public function createSalary(array $data)
    {
        return $this->salary->create($data);
    }

    /**
     * Update a salary by user ID.
     *
     * @param int $userId
     * @param array $data
     * @return Salary|null
     */
    public function updateSalaryByUserId($userId, array $data)
    {
        $salary = $this->findSalaryByUserId($userId);
        if ($salary) {
            $salary->update($data);
        }
        return $salary;
    }

    /**
     * Delete a salary by user ID.
     *
     * @param int $userId
     * @return bool
     */
    public function deleteSalaryByUserId($userId)
    {
        $salary = $this->findSalaryByUserId($userId);
        if ($salary) {
            return $salary->delete();
        }

        return false;
    }
}
