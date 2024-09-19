<?php

namespace App\Repositories\User;

use App\Models\BankAccount;

class BankAccountRepository
{
    protected BankAccount $bankAccount;

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     * Find a bank account by user ID.
     *
     * @param int $userId
     * @return BankAccount|null
     */
    public function findBankAccountByUserId($userId)
    {
        return $this->bankAccount->where('user_id', $userId)->first();
    }

    /**
     * Get all bank accounts with pagination.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllBankAccounts($perPage)
    {
        return $this->bankAccount->paginate($perPage);
    }

    /**
     * Create a new bank account.
     *
     * @param array $data
     * @return BankAccount
     */
    public function createBankAccount(array $data)
    {
        return $this->bankAccount->create($data);
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
        $bankAccount = $this->findBankAccountByUserId($userId);
        if ($bankAccount) {
            $bankAccount->update($data);
        }
        return $bankAccount;
    }

    /**
     * Delete a bank account by user ID.
     *
     * @param int $userId
     * @return bool
     */
    public function deleteBankAccountByUserId($userId)
    {
        $bankAccount = $this->findBankAccountByUserId($userId);
        if ($bankAccount) {
            return $bankAccount->delete();
        }

        return false;
    }
}
