<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    private $baseRoute = "/api/articles";

    public function setUp(): void{
        parent::setUp();

    }
    
    public function test_welcome()
    {
        $response = $this->get('/api/');
        $this->assertEquals($response->getContent(), '"Back-end Challenge 2021 - Space Flight News"');
        $response->assertStatus(200);
    }

    public function test_retrieve_articles_list()
    {
        $response = $this->get($this->baseRoute);
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data')
            ->has('links')
            ->has('meta')
        );
        $response->assertStatus(200);
    }

    public function test_article_show()
    {
        $model = Article::factory()->create();
        $route = $this->baseRoute . '/' . $model->id;
        $arrayedModel = [
            'id' => $model->id,
            'title' => $model->title,
            'url' => $model->url,
            'imageUrl' => $model->image_url,
            'newsSite' => $model->news_site,
            'summary' => $model->summary,
            'publishedAt' => $model->published_at,
            'updatedAt' => $model->article_updated_at,
            'featured' => $model->featured,
            'launches' => $model->launches,
            'events' => $model->events,
        ];
        $response = $this->get($route);
        $response->assertJson($arrayedModel);
        $response->assertStatus(200);
    }

    public function test_article_create()
    {
        $data = [
            "id_article" => 217,
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
        $response = $this->post($this->baseRoute, $data);
        $response->assertStatus(201);
    }

    public function test_article_update()
    {
        $data = [
            "id_article" => 217,
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
        $model = Article::factory()->create();
        $route = $this->baseRoute . '/' . $model->id;
        $response = $this->put($route, $data);
        $response->assertStatus(202);
    }

    public function test_article_delete()
    {
        $model = Article::factory()->create();
        $route = $this->baseRoute . '/' . $model->id;
        $response = $this->delete($route);
        $response->assertStatus(204);
    }
}
