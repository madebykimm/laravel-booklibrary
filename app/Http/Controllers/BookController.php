<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use App\Repositories\BookRepositoryInterface;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index(): JsonResponse
    {
        $books = Book::with('author')->paginate(20);
        return response()->json($books);
    }

    public function show($id): JsonResponse
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }


    public function store(StoreBookRequest $request)
    {
        return $this->bookRepository->create($request->validated());
    }

    public function update(UpdateBookRequest $request, $id)
    {
        return $this->bookRepository->update($id, $request->validated());
    }

    public function destroy($id): JsonResponse
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
