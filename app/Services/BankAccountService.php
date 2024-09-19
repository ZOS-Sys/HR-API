<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Repositories\User\BankAccountRepository;

class BankAccountService
{
    protected BankAccountRepository $bankAccountRepository;

    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    /**
     * Get a bank account by user ID.
     *
     * @param int $userId
     * @return BankAccount|null
     */
    public function getBankAccountByUserId($userId)
    {
        return $this->bankAccountRepository->findBankAccountByUserId($userId);
    }

    /**
     * Get all bank accounts with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllBankAccounts($perPage)
    {
        return $this->bankAccountRepository->getAllBankAccounts($perPage);
    }

    /**
     * Create a new bank account.
     *
     * @param array $data
     * @return BankAccount
     */
    public function createBankAccount(array $data)
    {
        return $this->bankAccountRepository->createBankAccount($data);
    }

    /**
     * Update a bank account by user ID.
     *
     * @param int $userId
     * @param array $data
     * @return BankAccount|null
     */
    public function updateBankAccountByUserId($userId, array $data)
    {
        return $this->bankAccountRepository->updateBankAccountByUserId($userId, $data);
    }

    /**
     * Delete a bank account by user ID.
     *
     * @param int $userId
     * @return bool
     */
    public function deleteBankAccountByUserId($userId)
    {
        return $this->bankAccountRepository->deleteBankAccountByUserId($userId);
    }
}
