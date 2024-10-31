<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepositoryInterface;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function index(): JsonResponse
    {
        $authors = Author::paginate(20);
        return response()->json($authors);
    }

    public function show($id): JsonResponse
    {
        $author = Author::findOrFail($id);
        return response()->json($author);
    }


    public function store(StoreAuthorRequest $request)
    {
        return $this->authorRepository->create($request->validated());
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        return $this->authorRepository->update($id, $request->validated());
    }


    public function destroy($id): JsonResponse
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(null, 204);
    }

    public function books($id): JsonResponse
    {
        $author = Author::findOrFail($id);
        $books = $author->books;

        return response()->json($books);
    }
}
