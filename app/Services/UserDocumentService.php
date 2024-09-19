<?php

namespace App\Services;

use App\Models\Document;
use App\Repositories\User\UserDocumentRepository;

class UserDocumentService
{
    // Repository instance for UserDocumentRepository
    protected UserDocumentRepository $userDocumentRepository;

    public function __construct(UserDocumentRepository $userDocumentRepository)
    {
        $this->userDocumentRepository = $userDocumentRepository;
    }

    /*
    * Get all based on userId
    */
    public function getAllDocuments($userId,$perPage)
    {
        // Retrieve the documents based on userId from the repository
        return $this->userDocumentRepository->findDocumentsByUserId($userId,$perPage);
    }

    /**
     * Get document by id
     *
     * @param int $id
     * @return Document|null
     */
    public function getDocumentById($id)
    {
        // Retrieve the document based on id from the repository
        return $this->userDocumentRepository->findDocumentById($id);
    }

    /**
     * Create a new document
     *
     * @param array $data
     * @return Document
     */
    public function createDocument(array $data)
    {
        // Create a new document  through the repository
        return $this->userDocumentRepository->createDocument($data);
    }

    /**
     * Update an existing document
     *
     * @param int $id
     * @param array $data
     * @return Document|null
     */
    public function updateDocument($id, array $data)
    {
        // Update the document by id through the repository
        return $this->userDocumentRepository->updateDocument($id, $data);
    }

    /**
     * Delete a document
     *
     * @param int $id
     * @return bool
     */
    public function deleteDocument($id)
    {
        // Delete the document by id through the repository
        return $this->userDocumentRepository->deleteDocument($id);
    }
}