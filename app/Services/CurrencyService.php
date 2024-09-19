<?php

namespace App\Services;

use App\Models\Currency;
use App\Repositories\Shared\CurrencyRepository;

class CurrencyService
{
    // Repository instance for CurrencyRepository
    protected CurrencyRepository $currencyRepository;

    // Constructor to inject the repository
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }
    /**
     * Get all Currencies .
     *
     * @return Currency|null
     */
    public function getAllCurrencies($perPage)
    {
        return $this->currencyRepository->getAllCurrencies($perPage);
    }

    /**
     * Get a currency by ID.
     *
     * @param int $id
     * @return Currency|null
     */
    public function getCurrencyById($id)
    {
        // Retrieve the currency by its ID from the repository
        return $this->currencyRepository->findCurrencyById($id);
    }

    /**
     * Create a new currency.
     *
     * @param array $data
     * @return Currency
     */
    public function createCurrency(array $data)
    {
        // Create a new currency through the repository
        return $this->currencyRepository->createCurrency($data);
    }

    /**
     * Update an existing currency.
     *
     * @param int $id
     * @param array $data
     * @return Currency|null
     */
    public function updateCurrency($id, array $data)
    {
        // Update the currency by ID through the repository
        return $this->currencyRepository->updateCurrency($id, $data);
    }

    /**
     * Delete a currency by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCurrency($id)
    {
        // Delete the currency by ID through the repository
        return $this->currencyRepository->deleteCurrency($id);
    }
}
