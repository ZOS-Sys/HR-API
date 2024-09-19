<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\NoteResource;
use App\Models\Note;
use App\Services\UserNoteService;
use App\Http\Requests\User\Notes\{StoreNoteRequest,UpdateNoteRequest};
use App\Traits\{TranslatableTrait,ApiResponse};
use Illuminate\Http\JsonResponse;

class UserNoteController extends Controller
{
    use ApiResponse;
    use TranslatableTrait;
    protected UserNoteService $userNoteService;
    protected Note $note;

    public function __construct(UserNoteService $userNoteService , Note $note)
    {
        $this->userNoteService = $userNoteService;
        $this->note = $note;
    }

    /**
     * Show notes based on userId
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

       // Retrieve documents with pagination
        $notes = $this->userNoteService->getAllNotes($userId,$perPage);

        return $this->successResponse(NoteResource::collection($notes), 'Notes retrieved successfully');
    }

    /**
     * Create a new note
     *
     * @param StoreNoteRequest $request
     * @return JsonResponse
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Handle Translatable Data
        $data['note'] = $this->handleTranslatableData($data, 'note');

        // Create a new note
        $note = $this->userNoteService->createNote($data);

        // Return success response with the created note
        return $this->successResponse(new NoteResource($note), 'Note created successfully', 200);
    }

    /**
     * Update an existing note
     *
     * @param UpdateNoteRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateNoteRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Handle Translatable Data
        $data['note'] = $this->handleTranslatableData($data, 'note');

        // Update the note based on id
        $note = $this->userNoteService->updateNote($id, $data);

        // Check if the note is not found
        if (!$note) {
            return $this->errorResponse('Note not found', 404);
        }

        // Return success response with the updated note
        return $this->successResponse(new NoteResource($note), 'Note updated successfully');
    }

    /**
     * Delete a note
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the note by id
        $deleted = $this->userNoteService->deleteNote($id);

        // Check if the note is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Note not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Note deleted successfully', 200);
    }
}
