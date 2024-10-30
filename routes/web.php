<?php

use Illuminate\Support\Facades\Route;

// In routes/web.php
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::prefix('api/authors')->group(function () {
    Route::apiResource('/', AuthorController::class)->parameters(['' => 'id']);
    Route::get('/{id}/books', [AuthorController::class, 'books']);
});

Route::prefix('api')->group(function () {
    Route::apiResource('books', BookController::class);
});
