<?php

namespace Tests\Feature\Articles;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Article;

class ListArticleTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function can_fecth_single_article(): void
    {
        $article = Article::factory()->create();
        $response = $this->getJson(route('articles.show', ['article' => $article->getRouteKey()]));

        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content
                ],
                'links' => [
                    'self' => url(route('articles.show', ['article' => $article->getRouteKey()]))
                ]
            ]
        ]);
    }

    /** @test */
    public function can_fecth_all_articles(): void
    {
        $articles = Article::factory(3)->create();
        $response = $this->getJson(route('articles.index', ['sort' => 'created_at']));

        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'articles',
                    'id' => (string) $articles[0]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[0]->title,
                        'slug' => $articles[0]->slug,
                        'content' => $articles[0]->content
                    ],
                    'links' => [
                        'self' => url(route('articles.show', ['article' => $articles[0]->getRouteKey()]))
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[1]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[1]->title,
                        'slug' => $articles[1]->slug,
                        'content' => $articles[1]->content
                    ],
                    'links' => [
                        'self' => url(route('articles.show', ['article' => $articles[1]->getRouteKey()]))
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[2]->getRouteKey(),
                    'attributes' => [
                        'title' => $articles[2]->title,
                        'slug' => $articles[2]->slug,
                        'content' => $articles[2]->content
                    ],
                    'links' => [
                        'self' => url(route('articles.show', ['article' => $articles[2]->getRouteKey()]))
                    ]
                ],  
            ]
        ]);
    }
}
