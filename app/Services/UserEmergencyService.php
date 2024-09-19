<?php

namespace App\Services;

use App\Models\Emergrncy;
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
     * Create a new emergrncy
     *
     * @param array $data
     * @return Emergrncy
     */
    public function createEmergrncy(array $data)
    {
        // Create a new emergrncy  through the repository
        return $this->userEmergencyRepository->createEmergrncy($data);
    }

    /**
     * Update an existing emergrncy
     *
     * @param int $id
     * @param array $data
     * @return Emergrncy|null
     */
    public function updateEmergrncy($id, array $data)
    {
        // Update the emergrncy by id through the repository
        return $this->userEmergencyRepository->updateEmergrncy($id, $data);
    }

    /**
     * Delete an emergrncy
     *
     * @param int $id
     * @return bool
     */
    public function deleteEmergrncy($id)
    {
        // Delete the emergrncy by id through the repository
        return $this->userEmergencyRepository->deleteEmergrncy($id);
    }
}