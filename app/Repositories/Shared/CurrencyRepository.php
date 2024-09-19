<?php

namespace App\Repositories\Shared;

use App\Models\Currency;

class CurrencyRepository
{
    // Model instance for the Currency
    protected Currency $currency;

    // Constructor to inject the Currency model
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }
    /**
     * Get all currencies with pagination
     *
    */
    public function getAllCurrencies($perPage)
    {
        return $this->currency->paginate($perPage);
    }
    /**
     * Find a currency by its ID.
     *
     * @param int $id
     * @return Currency|null
     */
    public function findCurrencyById($id)
    {
        // Fetch the currency using its ID
        return $this->currency->find($id);
    }

    /**
     * Create a new currency.
     *
     * @param array $data
     * @return Currency
     */
    public function createCurrency(array $data)
    {
        // Create a new currency using the provided data
        return $this->currency->create($data);
    }

    /**
     * Update an existing currency by ID.
     *
     * @param int $id
     * @param array $data
     * @return Currency|null
     */
    public function updateCurrency($id, array $data)
    {
        // Find the currency by ID
        $currency = $this->findCurrencyById($id);
        if ($currency) {
            // If the currency exists, update it with the provided data
            $currency->update($data);
        }
        return $currency;
    }

    /**
     * Delete a currency by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCurrency($id)
    {
        // Find the currency by ID
        $currency = $this->findCurrencyById($id);
        if ($currency) {
            // If found, delete the currency and return true
            return $currency->delete();
        }

        return false;
    }
}
