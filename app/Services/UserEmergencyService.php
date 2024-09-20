<?php

namespace App\Services;

use App\Models\Emergency;
use App\Repositories\User\UserEmergencyRepository;

class UserEmergencyService
{
    // Repository instance for UserEmergencyRepository
    protected UserEmergencyRepository $userEmergencyRepository;

    public function __construct(UserEmergencyRepository $userEmergencyRepository)
    {
        $this->userEmergencyRepository = $userEmergencyRepository;
    }

    /**
     * Get Emergencies based on userId 
    **/
    public function getAllEmergencies($userId,$perPage)
    {
        // Retrieve the emergencies based on userId from the repository
        return $this->userEmergencyRepository->findEmergenciesByUserId($userId,$perPage);
    }

    /**
     * Create a new emergency
     *
     * @param array $data
     * @return Emergency
     */
    public function createEmergency(array $data)
    {
        // Create a new emergency  through the repository
        return $this->userEmergencyRepository->createEmergency($data);
    }

    /**
     * Update an existing emergency
     *
     * @param int $id
     * @param array $data
     * @return Emergency|null
     */
    public function updateEmergency($id, array $data)
    {
        // Update the emergency by id through the repository
        return $this->userEmergencyRepository->updateEmergency($id, $data);
    }

    /**
     * Delete an emergency
     *
     * @param int $id
     * @return bool
     */
    public function deleteEmergency($id)
    {
        // Delete the emergency by id through the repository
        return $this->userEmergencyRepository->deleteEmergency($id);
    }
}