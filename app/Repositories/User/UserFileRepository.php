<?php

namespace App\Repositories\User;

use App\Models\File;

class UserFileRepository
{
    protected File $file;

    // Constructor to inject the File model
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    // Get all files
    public function findFilesByUserId($userId,$perPage)
    {
        return $this->file->with('user')->where('user_id', $userId)->paginate($perPage);
    }

    /**
     * Find a file by the id.
     * This retrieves the file based on the id.
     *
     * @param int $id
     * @return File|null
     */
    public function findFileById($id)
    {
        // Get the file using the id and load related data
        return $this->file->where('id', $id)->first();
    }

    /**
     * Create a new file in the database.
     *
     * @param array $data
     * @return File
     */
    public function createFile(array $data)
    {
        // Create a new record for the file using the data
        return $this->file->create($data);
    }

    /**
     * Update an existing file by id.
     *
     * @param int $id
     * @param array $data
     * @return File|null
     */
    public function updateFile($id, array $data)
    {
        // Find the file by id
        $file = $this->findFileById($id);
        if ($file) {
            // If the file exists, update it with the provided data
            $file->update($data);
        }
        // Return the updated file
        return $file;
    }

    /**
     * Delete a file by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteFile($id)
    {
        // Find the file by id
        $file = $this->findFileById($id);
        if ($file) {
            // If found, delete the file and return true
            return $file->delete();
        }
        return false;
    }
}