<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\SalaryService;
use App\Http\Requests\User\SalaryStoreRequest;
use App\Http\Requests\User\SalaryUpdateRequest;
use App\Http\Resources\User\SalaryResource;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class SalaryController extends Controller
{
    use ApiResponse;

    protected SalaryService $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * Get all salaries with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->get('per_page', 10);
        $salaries = $this->salaryService->getAllSalaries($perPage);
        return $this->successResponse(SalaryResource::collection($salaries), 'Salaries retrieved successfully');
    }

    /**
     * Show a salary by user ID.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        $salary = $this->salaryService->getSalaryByUserId($userId);
        if (!$salary) {
            return $this->errorResponse('Salary not found', 404);
        }
        return $this->successResponse(new SalaryResource($salary), 'Salary retrieved successfully');
    }

    /**
     * Create a new salary.
     *
     * @param SalaryStoreRequest $request
     * @return JsonResponse
     */
    public function store(SalaryStoreRequest $request): JsonResponse
    {
        $data = $request->all();
        $salary = $this->salaryService->createSalary($data);
        return $this->successResponse(new SalaryResource($salary), 'Salary created successfully', 200);
    }

    /**
     * Update an existing salary by user ID.
     *
     * @param SalaryUpdateRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function update(SalaryUpdateRequest $request, $userId): JsonResponse
    {
        $data = $request->all();
        $salary = $this->salaryService->updateSalaryByUserId($userId, $data);
        if (!$salary) {
            return $this->errorResponse('Salary not found', 404);
        }
        return $this->successResponse(new SalaryResource($salary), 'Salary updated successfully');
    }

    /**
     * Delete a salary by user ID.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy($userId): JsonResponse
    {
        $deleted = $this->salaryService->deleteSalaryByUserId($userId);
        if (!$deleted) {
            return $this->errorResponse('Salary not found', 404);
        }
        return $this->successResponse(null, 'Salary deleted successfully', 200);
    }
}
