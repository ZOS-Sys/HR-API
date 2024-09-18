<?php

namespace App\Repositories\Shared;

use App\Models\Country;

class CountryRepository
{
    // Model instance for the Country
    protected Country $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    // Get all countries
    public function getAllCountries($perPage)
    {
        return $this->country->paginate($perPage);
    }

    /**
     * Find a country by the id.
     * This retrieves the country based on the id.
     *
     * @param int $id
     * @return Country|null
     */
    public function findCountryById($id)
    {
        return $this->country->where('id', $id)->first();
    }

    /**
     * Create a new country in the database.
     *
     * @param array $data
     * @return Country
     */
    public function createCountry(array $data)
    {
        return $this->country->create($data);
    }

    /**
     * Update an existing country by ID.
     *
     * @param int $id
     * @param array $data
     * @return Country|null
     */
    public function updateCountry($id, array $data)
    {
        // Find the country by ID
        $country = $this->findCountryById($id);
        if ($country) {
            // If the country exists, update it with the provided data
            $country->update($data);
        }
        // Return the updated country
        return $country;
    }

    /**
     * Delete a country by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCountry($id)
    {
        // Find the country by ID
        $country = $this->findCountryById($id);
        if ($country) {
            // If found, delete the country and return true
            return $country->delete();
        }

        return false;
    }
}
