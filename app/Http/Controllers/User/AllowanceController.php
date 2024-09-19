<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\AllowanceService;
use App\Http\Requests\User\AllowanceStoreRequest;
use App\Http\Requests\User\AllowanceUpdateRequest;
use App\Http\Resources\User\AllowanceResource;
use Illuminate\Http\JsonResponse;
use App\Traits\TranslatableTrait;
use App\Traits\ApiResponse;

class AllowanceController extends Controller
{
    use ApiResponse, TranslatableTrait;

    protected AllowanceService $allowanceService;

    public function __construct(AllowanceService $allowanceService)
    {
        $this->allowanceService = $allowanceService;
    }

    /**
     * Get all allowances with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->get('per_page', 10);
        $allowances = $this->allowanceService->getAllAllowances($perPage);
        return $this->successResponse(AllowanceResource::collection($allowances), 'Allowances retrieved successfully');
    }

    /**
     * Show an allowance by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $allowance = $this->allowanceService->getAllowanceById($id);
        if (!$allowance) {
            return $this->errorResponse('Allowance not found', 404);
        }
        return $this->successResponse(new AllowanceResource($allowance), 'Allowance retrieved successfully');
    }

    /**
     * Create a new allowance.
     *
     * @param AllowanceStoreRequest $request
     * @return JsonResponse
     */
    public function store(AllowanceStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Handle translatable fields
        $data['name'] = $this->handleTranslatableData($data, 'name');
        $data['note'] = $this->handleTranslatableData($data, 'note');

        $allowance = $this->allowanceService->createAllowance($data);
        return $this->successResponse(new AllowanceResource($allowance), 'Allowance created successfully', 201);
    }

    /**
     * Update an existing allowance.
     *
     * @param AllowanceUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(AllowanceUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->all();

        // Handle translatable fields
        $data['name'] = $this->handleTranslatableData($data, 'name');
        $data['note'] = $this->handleTranslatableData($data, 'note');

        $allowance = $this->allowanceService->updateAllowance($id, $data);
        if (!$allowance) {
            return $this->errorResponse('Allowance not found', 404);
        }
        return $this->successResponse(new AllowanceResource($allowance), 'Allowance updated successfully');
    }

    /**
     * Delete an allowance.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $deleted = $this->allowanceService->deleteAllowance($id);
        if (!$deleted) {
            return $this->errorResponse('Allowance not found', 404);
        }
        return $this->successResponse(null, 'Allowance deleted successfully', 200);
    }
}
