<?php

namespace App\Http\Controllers\User;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\DocumentResource;
use App\Models\Document;
use App\Services\UserDocumentService;
use App\Http\Requests\User\Documents\{StoreDocumentRequest,UpdateDocumentRequest};
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class UserDocumentController extends Controller
{
    use ApiResponse;
    protected UserDocumentService $userDocumentService;
    protected Document $document;

    public function __construct(UserDocumentService $userDocumentService , Document $document)
    {
        $this->userDocumentService = $userDocumentService;
        $this->document = $document;
    }

    /**
     * Show documents based on userId
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve documents with pagination
        $documents = $this->userDocumentService->getAllDocuments($userId,$perPage);

        return $this->successResponse(DocumentResource::collection($documents), 'Documents retrieved successfully');
    }

    /**
     * Create a new document
     *
     * @param StoreDocumentRequest $request
     * @return JsonResponse
     */
    public function store(StoreDocumentRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Check if there is a file in the request and upload it
        $data['file'] = $request->hasFile('file') ? HandleUpload::uploadFile($request->file , 'documents') : NULL;

        // Create a new document
        $document = $this->userDocumentService->createDocument($data);

        // Return success response with the created document
        return $this->successResponse(new DocumentResource($document), 'Document created successfully', 200);
    }

    /**
     * Update an existing document
     *
     * @param UpdateDocumentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateDocumentRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Get the existing document to get the old file path
        $existingDocument = $this->userDocumentService->getDocumentById($id);

        if (!$existingDocument) {
            return $this->errorResponse('Document not found', 404); // Return error if not found
        }

        // Check if there is a file in the request and upload it
        $data['file'] = $request->hasFile('file') ? HandleUpload::uploadFile($request->file , 'documents') : $existingDocument->file;

        // Update the document based on id
        $document = $this->userDocumentService->updateDocument($id, $data);

        // Check if the document is not found
        if (!$document) {
            return $this->errorResponse('Document not found', 404);
        }

        // Return success response with the updated document
        return $this->successResponse(new DocumentResource($document), 'Document updated successfully');
    }

    /**
     * Delete a document
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the document by id
        $deleted = $this->userDocumentService->deleteDocument($id);

        // Check if the document is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Document not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Document deleted successfully', 200);
    }
}
