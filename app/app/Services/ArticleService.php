<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{

    public function __construct(Article $article){
        $this->article = $article;
    }
    
    public function list(int $itemsByPage = 15){
        return Article::paginate($itemsByPage);
    }

    public function createArticle(array $data){
        $article = new Article($data);
        $article->save();
        return $article;
    }

    public function updateArticle(Article $article, array $data){
        $article->update($data);
        return $article;
    }

    public function deleteById(int $id){
        Article::destroy($id);
    }

    public function importApiData(string $url, string $countUrl)
    {
        $limit = $this->countApiData($countUrl);
        $url .= $limit;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        $this->persistImportedData($result);
    }

    public function updateImportedApiData(string $url)
    {
        $lastImportedId = Article::max("id_article");
        $url .= $lastImportedId;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        $this->persistImportedData($result);
    }

    public function persistImportedData(array $articles)
    {
        foreach($articles as $article){
            $articleModel = new Article();
            $articleModel->id_article = $article->id;
            $articleModel->title = $article->title;
            $articleModel->url = $article->url;
            $articleModel->image_url = $article->imageUrl;
            $articleModel->news_site = $article->newsSite;
            $articleModel->summary = $article->summary;
            $articleModel->published_at = $article->publishedAt;
            $articleModel->article_updated_at = $article->updatedAt;
            $articleModel->featured = $article->featured;
            $articleModel->launches = json_encode($article->launches);
            $articleModel->events = json_encode($article->events);
            $articleModel->save();
        }
    }

    private function countApiData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $count = curl_exec($ch);
        curl_close($ch);
        return $count;
    }
}
