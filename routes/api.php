<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ArticleController;

// Routes
Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show');

Route::get('/article', [ArticleController::class, 'index'])
    ->name('articles.index');