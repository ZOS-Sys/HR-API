<?php

namespace App\Repositories\User;

use App\Models\Document;

class UserDocumentRepository
{
    protected Document $document;

    // Constructor to inject the Document model
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    // Get all documents
    public function findDocumentsByUserId($userId,$perPage)
    {
        return $this->document->with('user')->where('user_id', $userId)->paginate($perPage);
    }

    /**
     * Find a document by the id.
     * This retrieves the document based on the id.
     *
     * @param int $id
     * @return Document|null
     */
    public function findDocumentById($id)
    {
        // Get the document using the id and load related data
        return $this->document->where('id', $id)->first();
    }

    /**
     * Create a new document in the database.
     *
     * @param array $data
     * @return Document
     */
    public function createDocument(array $data)
    {
        // Create a new record for the document using the data
        return $this->document->create($data);
    }

    /**
     * Update an existing document by id.
     *
     * @param int $id
     * @param array $data
     * @return Document|null
     */
    public function updateDocument($id, array $data)
    {
        // Find the document by id
        $document = $this->findDocumentById($id);
        if ($document) {
            // If the document exists, update it with the provided data
            $document->update($data);
        }
        // Return the updated document
        return $document;
    }

    /**
     * Delete a document by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteDocument($id)
    {
        // Find the document by id
        $document = $this->findDocumentById($id);
        if ($document) {
            // If found, delete the document and return true
            return $document->delete();
        }
        return false;
    }
}