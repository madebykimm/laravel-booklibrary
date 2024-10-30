<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function show($id)
    {
        return Author::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Author::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        return $author;
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response(null, 204);
    }

    public function books($id)
    {
        return Author::findOrFail($id)->books;
    }
}
