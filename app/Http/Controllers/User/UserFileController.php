<?php

namespace App\Http\Controllers\User;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\FileResource;
use App\Models\File;
use App\Services\UserFileService;
use App\Http\Requests\User\Files\{StoreFileRequest,UpdateFileRequest};
use App\Traits\{TranslatableTrait,ApiResponse};
use Illuminate\Http\JsonResponse;

class UserFileController extends Controller
{
    use ApiResponse;
    use TranslatableTrait;
    protected UserFileService $userFileService;
    protected File $file;

    public function __construct(UserFileService $userFileService , File $file)
    {
        $this->userFileService = $userFileService;
        $this->file = $file;
    }

    /**
     * Show files based on userId
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

       // Retrieve documents with pagination
        $files = $this->userFileService->getAllFiles($userId,$perPage);

        return $this->successResponse(FileResource::collection($files), 'Files retrieved successfully');
    }

    /**
     * Create a new file
     *
     * @param StoreFileRequest $request
     * @return JsonResponse
     */
    public function store(StoreFileRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Check if there is a file in the request and upload it
        $data['file'] = $request->hasFile('file') ? HandleUpload::uploadFile($request->file , 'files') : NULL;

        // Handle Translatable Data
        $data['address'] = $this->handleTranslatableData($data, 'address');

        // Create a new file
        $file = $this->userFileService->createFile($data);

        // Return success response with the created file
        return $this->successResponse(new FileResource($file), 'File created successfully', 200);
    }

    /**
     * Update an existing file
     *
     * @param UpdateFileRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateFileRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Get the existing file to get the old file path
        $existingFile = $this->userFileService->getFileById($id);

        if (!$existingFile) {
            return $this->errorResponse('File not found', 404); // Return error if not found
        }

        // Check if there is a file in the request and upload it
        $data['file'] = $request->hasFile('file') ? HandleUpload::uploadFile($request->file , 'files') : $existingFile->file;

        // Handle Translatable Data
        $data['address'] = $this->handleTranslatableData($data, 'address');

        // Update the file based on id
        $file = $this->userFileService->updateFile($id, $data);

        // Check if the file is not found
        if (!$file) {
            return $this->errorResponse('File not found', 404);
        }

        // Return success response with the updated file
        return $this->successResponse(new FileResource($file), 'File updated successfully');
    }

    /**
     * Delete a file
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the file by id
        $deleted = $this->userFileService->deleteFile($id);

        // Check if the file is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('File not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'File deleted successfully', 200);
    }
}
