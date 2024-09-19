<?php

namespace App\Repositories\User;

use App\Models\Emergency;

class UserEmergencyRepository
{
    protected Emergency $emergency;

    // Constructor to inject the Emergency model
    public function __construct(Emergency $emergency)
    {
        $this->emergency = $emergency;
    }

    // Get all emergencies
    public function findEmergenciesByUserId($userId,$perPage)
    {
        return $this->emergency->with('user')->where('user_id', $userId)->paginate($perPage);
    }

    /**
     * Find an emergency by the id.
     * This retrieves the emergency based on the id.
     *
     * @param int $id
     * @return Emergency|null
     */
    public function findEmergencyById($id)
    {
        // Get the emergency using the id and load related data
        return $this->emergency->where('id', $id)->first();
    }

    /**
     * Create a new emergency in the database.
     *
     * @param array $data
     * @return Emergency
     */
    public function createEmergency(array $data)
    {
        // Create a new record for the emergency using the data
        return $this->emergency->create($data);
    }

    /**
     * Update an existing emergency by id.
     *
     * @param int $id
     * @param array $data
     * @return Emergency|null
     */
    public function updateEmergency($id, array $data)
    {
        // Find the emergency by id
        $emergency = $this->findEmergencyById($id);
        if ($emergency) {
            // If the emergency exists, update it with the provided data
            $emergency->update($data);
        }
        // Return the updated emergency
        return $emergency;
    }

    /**
     * Delete a emergency by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteEmergency($id)
    {
        // Find the emergency by id
        $emergency = $this->findEmergencyById($id);
        if ($emergency) {
            // If found, delete the emergency and return true
            return $emergency->delete();
        }
        return false;
    }
}
