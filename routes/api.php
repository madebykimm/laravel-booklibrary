<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::prefix('authors')->group(function () {
    Route::apiResource('/', AuthorController::class)->parameters(['' => 'id']);
    Route::get('/{id}/books', [AuthorController::class, 'books']);
});

Route::apiResource('books', BookController::class);
