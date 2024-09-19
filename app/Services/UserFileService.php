<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\User\UserFileRepository;

class UserFileService
{
    // Repository instance for UserFileRepository
    protected UserFileRepository $userFileRepository;

    public function __construct(UserFileRepository $userFileRepository)
    {
        $this->userFileRepository = $userFileRepository;
    }

    /*
    * Get all files based on userId
    */
    public function getAllFiles($userId,$perPage) 
    {
        // Retrieve the documents based on userId from the repository
        return $this->userFileRepository->findFilesByUserId($userId,$perPage);
    }

    /**
     * Get file by id
     *
     * @param int $id
     * @return File|null
     */
    public function getFileById($id)
    {
        // Retrieve the file based on id from the repository
        return $this->userFileRepository->findFileById($id);
    }

    /**
     * Create a new file
     *
     * @param array $data
     * @return File
     */
    public function createFile(array $data)
    {
        // Create a new file  through the repository
        return $this->userFileRepository->createFile($data);
    }

    /**
     * Update an existing file
     *
     * @param int $id
     * @param array $data
     * @return File|null
     */
    public function updateFile($id, array $data)
    {
        // Update the file by id through the repository
        return $this->userFileRepository->updateFile($id, $data);
    }

    /**
     * Delete a file
     *
     * @param int $id
     * @return bool
     */
    public function deleteFile($id)
    {
        // Delete the file by id through the repository
        return $this->userFileRepository->deleteFile($id);
    }
}