<?php

namespace App\Services;

use App\Models\Note;
use App\Repositories\User\UserNoteRepository;

class UserNoteService
{
    // Repository instance for UserNoteRepository
    protected UserNoteRepository $userNoteRepository;

    public function __construct(UserNoteRepository $userNoteRepository)
    {
        $this->userNoteRepository = $userNoteRepository;
    }

    /*
    * Get all notes based on userId
    */
    public function getAllNotes($userId,$perPage)
    {
        // Retrieve the notes based on userId from the repository
        return $this->userNoteRepository->findNotesByUserId($userId,$perPage);
    }

    /**
     * Create a new note
     *
     * @param array $data
     * @return Note
     */
    public function createNote(array $data)
    {
        // Create a new note  through the repository
        return $this->userNoteRepository->createNote($data);
    }

    /**
     * Update an existing note
     *
     * @param int $id
     * @param array $data
     * @return Note|null
     */
    public function updateNote($id, array $data)
    {
        // Update the note by id through the repository
        return $this->userNoteRepository->updateNote($id, $data);
    }

    /**
     * Delete a note
     *
     * @param int $id
     * @return bool
     */
    public function deleteNote($id)
    {
        // Delete the note by id through the repository
        return $this->userNoteRepository->deleteNote($id);
    }
}