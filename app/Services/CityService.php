<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\Shared\CityRepository;

class CityService
{
    protected CityRepository $cityRepository;


    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /*
     * Get all cities
     */
    public function getAllCities($perPage)
    {
        return $this->cityRepository->getAllCities($perPage);
    }

    /**
     * Get city by ID
     *
     * @param int $id
     * @return City|null
     */
    public function getCityById($id)
    {

        return $this->cityRepository->findCityById($id);
    }

    /**
     * Create a new city
     *
     * @param array $data
     * @return City
     */
    public function createCity(array $data)
    {
        return $this->cityRepository->createCity($data);
    }

    /**
     * Update an existing city
     *
     * @param int $id
     * @param array $data
     * @return City|null
     */
    public function updateCity($id, array $data)
    {
        return $this->cityRepository->updateCity($id, $data);
    }

    /**
     * Delete a city
     *
     * @param int $id
     * @return bool
     */
    public function deleteCity($id)
    {
        return $this->cityRepository->deleteCity($id);
    }
}
