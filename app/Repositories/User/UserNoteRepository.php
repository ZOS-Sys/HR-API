<?php

namespace App\Repositories\User;

use App\Models\Note;

class UserNoteRepository
{
    protected Note $note;

    // Constructor to inject the Note model
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    // Get all notes
    public function findNotesByUserId($userId,$perPage)
    {
        return $this->note->with('user')->where('user_id', $userId)->paginate($perPage);
    }

    /**
     * Find a note by the id.
     * This retrieves the note based on the id.
     *
     * @param int $id
     * @return Note|null
     */
    public function findNoteById($id)
    {
        // Get the note using the id and load related data
        return $this->note->where('id', $id)->first();
    }

    /**
     * Create a new note in the database.
     *
     * @param array $data
     * @return Note
     */
    public function createNote(array $data)
    {
        // Create a new record for the note using the data
        return $this->note->create($data);
    }

    /**
     * Update an existing note by id.
     *
     * @param int $id
     * @param array $data
     * @return Note|null
     */
    public function updateNote($id, array $data)
    {
        // Find the note by id
        $note = $this->findNoteById($id);
        if ($note) {
            // If the note exists, update it with the provided data
            $note->update($data);
        }
        // Return the updated note
        return $note;
    }

    /**
     * Delete a note by id.
     *
     * @param int $id
     * @return bool
     */
    public function deleteNote($id)
    {
        // Find the note by id
        $note = $this->findNoteById($id);
        if ($note) {
            // If found, delete the note and return true
            return $note->delete();
        }
        return false;
    }
}