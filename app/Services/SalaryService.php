<?php

namespace App\Services;

use App\Models\Salary;
use App\Repositories\User\SalaryRepository;

class SalaryService
{
    protected SalaryRepository $salaryRepository;

    public function __construct(SalaryRepository $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }

    /**
     * Get a salary by user ID.
     *
     * @param int $userId
     * @return Salary|null
     */
    public function getSalaryByUserId($userId)
    {
        return $this->salaryRepository->findSalaryByUserId($userId);
    }

    /**
     * Get all salaries with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllSalaries($perPage)
    {
        return $this->salaryRepository->getAllSalaries($perPage);
    }

    /**
     * Create a new salary.
     *
     * @param array $data
     * @return Salary
     */
    public function createSalary(array $data)
    {
        return $this->salaryRepository->createSalary($data);
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
        return $this->salaryRepository->updateSalaryByUserId($userId, $data);
    }

    /**
     * Delete a salary by user ID.
     *
     * @param int $userId
     * @return bool
     */
    public function deleteSalaryByUserId($userId)
    {
        return $this->salaryRepository->deleteSalaryByUserId($userId);
    }
}
