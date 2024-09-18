<?php

namespace App\Services;

use App\Models\Country;
use App\Repositories\Shared\CountryRepository;

class CountryService
{
    protected CountryRepository $countryRepository;


    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /*
     * Get all countries
     */
    public function getAllCountries($perPage)
    {
        return $this->countryRepository->getAllCountries($perPage);
    }

    /**
     * Get country by ID
     *
     * @param int $id
     * @return Country|null
     */
    public function getCountryById($id)
    {

        return $this->countryRepository->findCountryById($id);
    }

    /**
     * Create a new country
     *
     * @param array $data
     * @return Country
     */
    public function createCountry(array $data)
    {
        return $this->countryRepository->createCountry($data);
    }

    /**
     * Update an existing country
     *
     * @param int $id
     * @param array $data
     * @return Country|null
     */
    public function updateCountry($id, array $data)
    {
        return $this->countryRepository->updateCountry($id, $data);
    }

    /**
     * Delete a country
     *
     * @param int $id
     * @return bool
     */
    public function deleteCountry($id)
    {
        return $this->countryRepository->deleteCountry($id);
    }
}
