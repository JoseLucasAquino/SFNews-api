<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      @OA\Property(property="title", type="string", example="example title"),
 *      @OA\Property(property="url", type="string", example="http://exampleurl.com"),
 *      @OA\Property(property="image_url", type="string", example="http://exampleurl.com/exampleimage.png"),
 *      @OA\Property(property="news_site", type="string", example="Example Site"),
 *      @OA\Property(property="summary", type="string", example="example summary"),
 *      @OA\Property(property="published_at", type="string", example="2022-11-09T15:29:14.000Z"),
 *      @OA\Property(property="article_updated_at", type="string", example="2022-11-09T15:29:14.000Z"),
 *      @OA\Property(property="featured", type="boolean", example="false"),
 *      @OA\Property(property="launches", type="string", example="[]"),
 *      @OA\Property(property="events", type="string", example="[]"),
 * ),
 */
class CreateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|string",
            "url" => "required|string",
            "image_url" => "required|string",
            "news_site" => "required|string",
            "summary" => "required|string",
            "published_at" => "required|string",
            "article_updated_at" => "required|string",
            "featured" => "required|boolean",
            "launches" => "json",
            "events" => "json",
        ];
    }
}
