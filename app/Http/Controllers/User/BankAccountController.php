<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\BankAccountService;
use App\Http\Requests\User\BankAccountStoreRequest;
use App\Http\Requests\User\BankAccountUpdateRequest;
use App\Http\Resources\User\BankAccountResource;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use App\Traits\TranslatableTrait;

class BankAccountController extends Controller
{
    use ApiResponse, TranslatableTrait;

    protected BankAccountService $bankAccountService;

    public function __construct(BankAccountService $bankAccountService)
    {
        $this->bankAccountService = $bankAccountService;
    }

    /**
     * Get all bank accounts with pagination.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $perPage = request()->get('per_page', 10);
        $bankAccounts = $this->bankAccountService->getAllBankAccounts($perPage);
        return $this->successResponse(BankAccountResource::collection($bankAccounts), 'Bank accounts retrieved successfully');
    }

    /**
     * Show a bank account by user ID.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        $bankAccount = $this->bankAccountService->getBankAccountByUserId($userId);
        if (!$bankAccount) {
            return $this->errorResponse('Bank account not found', 404);
        }
        return $this->successResponse(new BankAccountResource($bankAccount), 'Bank account retrieved successfully');
    }

    /**
     * Create a new bank account.
     *
     * @param BankAccountStoreRequest $request
     * @return JsonResponse
     */
    public function store(BankAccountStoreRequest $request): JsonResponse
    {
        $data = $request->all();

        // Handle translatable fields
        $data['name'] = $this->handleTranslatableData($data, 'name');

        $bankAccount = $this->bankAccountService->createBankAccount($data);
        return $this->successResponse(new BankAccountResource($bankAccount), 'Bank account created successfully', 200);
    }

    /**
     * Update a bank account by user ID.
     *
     * @param BankAccountUpdateRequest $request
     * @param int $userId
     * @return JsonResponse
     */
    public function update(BankAccountUpdateRequest $request, $userId): JsonResponse
    {
        $data = $request->all();

        // Handle translatable fields
        $data['name'] = $this->handleTranslatableData($data, 'name');

        $bankAccount = $this->bankAccountService->updateBankAccountByUserId($userId, $data);
        if (!$bankAccount) {
            return $this->errorResponse('Bank account not found', 404);
        }
        return $this->successResponse(new BankAccountResource($bankAccount), 'Bank account updated successfully');
    }

    /**
     * Delete a bank account by user ID.
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function destroy($userId): JsonResponse
    {
        $deleted = $this->bankAccountService->deleteBankAccountByUserId($userId);
        if (!$deleted) {
            return $this->errorResponse('Bank account not found', 404);
        }
        return $this->successResponse(null, 'Bank account deleted successfully', 200);
    }
}
