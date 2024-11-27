<?php

namespace Tests\Feature\Articles;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Article;
use Illuminate\Support\Facades\DB;

class SortArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function in_cat_sort_articles_by_title_test(): void
    {
        $this->withoutExceptionHandling();
        $articleC = Article::factory()->create([ 'title' => 'C Title' ]);
        $articleA = Article::factory()->create([ 'title' => 'A Title' ]);
        $articleB = Article::factory()->create([ 'title' => 'B Title' ]);

        $routeName = route('articles.index', ['sort' => 'title']);

        $this->getJson($routeName)->assertSeeInOrder([
            $articleA->title,
            $articleB->title,
            $articleC->title
        ]);
    }

    /** @test */
    public function in_cat_sort_articles_by_title_desc(): void
    {
        $articleC = Article::factory()->create([ 'title' => 'C Title' ]);
        $articleA = Article::factory()->create([ 'title' => 'A Title' ]);
        $articleB = Article::factory()->create([ 'title' => 'B Title' ]);

        $routeName = route('articles.index', ['sort' => '-title']);

        $this->getJson($routeName)->assertSeeInOrder([
            $articleC->title,
            $articleB->title,
            $articleA->title
        ]);
    }

    /** @test */
    public function in_cat_sort_articles_by_title_and_content(): void
    {
        $this->withoutExceptionHandling();
        $articleC = Article::factory()->create([ 'title' => 'C Title', 'content' => 'C Content' ]);
        $articleA = Article::factory()->create([ 'title' => 'A Title', 'content' => 'D Content'  ]);
        $articleB = Article::factory()->create([ 'title' => 'B Title', 'content' => 'F Content'  ]);

        $routeName = route('articles.index', ['sort' => '-title,content']);
        $this->getJson($routeName)->assertSeeInOrder([
            $articleC->title,
            $articleB->title,
            $articleA->title
        ]);
    }
}
