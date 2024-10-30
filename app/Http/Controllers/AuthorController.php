<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    public function show($id): JsonResponse
    {
        $author = Author::findOrFail($id);
        return response()->json($author);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'required|date|before:today',
        ]);

        $author = Author::create($validatedData);

        return response()->json($author, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio' => 'nullable|string',
            'birth_date' => 'sometimes|required|date|before:today',
        ]);

        $author = Author::findOrFail($id);
        $author->update($validatedData);

        return response()->json($author);
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
