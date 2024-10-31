<?php

namespace App\Repositories\Eloquent;

use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function getAll()
    {
        return Author::all();
    }

    public function getById($id)
    {
        return Author::findOrFail($id);
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function update($id, array $data)
    {
        $author = Author::findOrFail($id);
        $author->update($data);
        return $author;
    }

    public function delete($id)
    {
        $author = Author::findOrFail($id);
        return $author->delete();
    }

    public function getBooksByAuthorId($id)
    {
        $author = Author::findOrFail($id);
        return $author->books;
    }
}
