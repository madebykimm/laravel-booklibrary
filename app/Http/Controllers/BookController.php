<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id): JsonResponse
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'required|date',
            'author_id' => 'required|exists:authors,id',
        ]);

        $book = Book::create($validatedData);

        return response()->json($book, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'publish_date' => 'sometimes|required|date',
            'author_id' => 'sometimes|required|exists:authors,id',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return response()->json($book);
    }

    public function destroy($id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
