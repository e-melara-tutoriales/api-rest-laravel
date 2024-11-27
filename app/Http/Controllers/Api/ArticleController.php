<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Support\Str;

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
//        $direction = 'asc';
//        $sortFields = Str::of(request('sort'))->explode(',');
//
//        $query = Article::query();
//
//        foreach ($sortFields as $sortField) {
//            $direction = 'asc';
//            if(Str::of($sortField)->startsWith('-')) {
//                $direction = 'desc';
//                $sortField = Str::of($sortField)->substr(1);
//            }
//            $query->orderBy($sortField, $direction);
//        }

        Article::scopeApplySorts(request('sort'));

        return new ArticleCollection($query->get());
    }
}
