<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *      schema="ArticleResource",
 *      @OA\Property(property="id", type="integer", example="1"),
 *      @OA\Property(property="title", type="string", example="example title"),
 *      @OA\Property(property="url", type="string", example="http://exampleurl.com"),
 *      @OA\Property(property="imageUrl", type="string", example="http://exampleurl.com/exampleimage.png"),
 *      @OA\Property(property="newsSite", type="string", example="Example Stite"),
 *      @OA\Property(property="summary", type="string", example="example summary"),
 *      @OA\Property(property="publishedAt", type="string", example="2022-11-09T15:29:14.000Z"),
 *      @OA\Property(property="updatedAt", type="string", example="2022-11-09T15:29:14.000Z"),
 *      @OA\Property(property="featured", type="boolean", example="false"),
 *      @OA\Property(property="launches", type="string", example=""),
 *      @OA\Property(property="events", type="string", example=""),
 * ),
 * 
 * @OA\Schema(schema="ArticleResourceCollection", type="array", @OA\Items(ref="#components/schemas/ArticleResource")),
 * 
 * ),
 */
class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'imageUrl' => $this->image_url,
            'newsSite' => $this->news_site,
            'summary' => $this->summary,
            'publishedAt' => $this->published_at,
            'updatedAt' => $this->article_updated_at,
            'featured' => $this->featured,
            'launches' => $this->launches,
            'events' => $this->events
        ];
    }
}
