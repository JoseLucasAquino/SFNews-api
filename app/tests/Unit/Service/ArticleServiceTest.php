<?php

namespace Tests\Unit\Service;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Mockery;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{
    protected $articleMock;
    protected $service;

    protected function setUp(): void{
        parent::setUp();
        $this->articleMock = Mockery::mock(Article::class);
        $this->service = new ArticleService($this->articleMock);
    }

    public function test_article_list()
    {
        $this->articleMock->shouldReceive('paginate')->andReturn(Mockery::mock(Paginator::class));
        $response = $this->service->list(15);
        $this->assertInstanceOf(LengthAwarePaginator::class, $response);
    }

    public function test_article_create()
    {
        $data = [
            "title"=>"The oracle who predicted SLS?s launch in 2023 has thoughts about Artemis III",
            "url"=>"https://arstechnica.com/science/2022/11/the-oracle-who-predicted-slss-launch-in-2023-has-thoughts-about-artemis-iii/",
            "image_url"=>"https://cdn.arstechnica.net/wp-content/uploads/2022/11/SLS-Sunrise-June-7-2022-8862.jpg",
            "news_site"=>"Arstechnica",
            "summary"=>"An unbiased industry source is back for more space policy spitballing.",
            "published_at"=>"2022-11-14T12:00:49.000Z",
            "article_updated_at"=>"2022-11-14T12:07:05.227Z",
            "featured"=>false,
            "launches"=>"{}",
            "events"=>"{}"
        ];
        $this->articleMock->shouldReceive('save')->with($data)->andReturn(Article::class);
        $response = $this->service->createArticle($data);
        $this->assertInstanceOf(Article::class, $response);
    }

    public function test_article_update()
    {
        $data = [
            "title"=>"The oracle who predicted SLS?s launch in 2023 has thoughts about Artemis III",
            "url"=>"https://arstechnica.com/science/2022/11/the-oracle-who-predicted-slss-launch-in-2023-has-thoughts-about-artemis-iii/",
            "image_url"=>"https://cdn.arstechnica.net/wp-content/uploads/2022/11/SLS-Sunrise-June-7-2022-8862.jpg",
            "news_site"=>"Arstechnica",
            "summary"=>"An unbiased industry source is back for more space policy spitballing.",
            "published_at"=>"2022-11-14T12:00:49.000Z",
            "article_updated_at"=>"2022-11-14T12:07:05.227Z",
            "featured"=>false,
            "launches"=>"{}",
            "events"=>"{}"
        ];
        $this->articleMock->shouldReceive('update')->with($data)->andReturn(Article::class);
        $response = $this->service->updateArticle($this->articleMock, $data);
        $this->assertInstanceOf(Article::class, $response);
    }

    public function test_article_delete()
    {
        $this->articleMock->shouldReceive('getAttribute')->with('id')->andReturn(1);
        $this->articleMock->shouldReceive('destroy')->with($this->articleMock->id)->andReturn();
        $this->service->deleteById($this->articleMock->id);
        $this->assertDeleted('articles', ['id'=>1]);
    }

}
