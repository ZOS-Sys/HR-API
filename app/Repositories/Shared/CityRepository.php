<?php

namespace App\Repositories\Shared;

use App\Models\City;

class CityRepository
{
    // Model instance for the city
    protected City $city;

    public function __construct(City $city)
    {
        $this->city = $city;
    }

    // Get all cities
    public function getAllCities($perPage)
    {
        return $this->city->paginate($perPage);
    }

    /**
     * Find a city by the id.
     * This retrieves the city based on the id.
     *
     * @param int $id
     * @return City|null
     */
    public function findCityById($id)
    {
        return $this->city->where('id', $id)->first();
    }

    /**
     * Create a new city in the database.
     *
     * @param array $data
     * @return City
     */
    public function createCity(array $data)
    {
        return $this->city->create($data);
    }

    /**
     * Update an existing city by ID.
     *
     * @param int $id
     * @param array $data
     * @return City|null
     */
    public function updateCity($id, array $data)
    {
        // Find the city by ID
        $city = $this->findCityById($id);
        if ($city) {
            // If the city exists, update it with the provided data
            $city->update($data);
        }
        // Return the updated city
        return $city;
    }

    /**
     * Delete a city by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCity($id)
    {
        // Find the city by ID
        $city = $this->findCityById($id);
        if ($city) {
            // If found, delete the city and return true
            return $city->delete();
        }

        return false;
    }
}
