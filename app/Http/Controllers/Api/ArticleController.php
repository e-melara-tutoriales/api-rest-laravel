<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Models\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    public function index()
    {
        return new ArticleCollection(Article::all());
    }
}
