<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Response;

/**
 * @OA\Parameter (
 *      in="query",
 *      name="page",
 *      required=true,
 *      description="A pagina alvo",
 *      @OA\Schema(
 *          type="integer",
 *          example="1"
 *      ),
 * ),
 * 
 * @OA\Schema(
 *      schema="welcome_message",
 *      @OA\Property(property="message", type="string", example="Back-end Challenge 2021 - Space Flight News"),
 * ),
 */

class ArticleController extends Controller
{
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/",
     *      operationId="getWelcomeMessage",
     *      tags={"Home"},
     *      summary="Get Welcome Message",
     *      description="Returns welcome message",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/welcome_message"),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * ),
     */
    public function home()
    {
        return response()->json('Back-end Challenge 2021 - Space Flight News', 200);
    }

    /**
     * @OA\Get(
     *      path="/api/articles",
     *      operationId="getArticlesList",
     *      tags={"Articles"},
     *      summary="Get list of articles",
     *      description="Returns list of articles",
     *      @OA\Parameter(ref="#/components/parameters/page"),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ArticleResourceCollection")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * ),
     */
    public function index()
    {
        return ArticleResource::collection($this->service->list());
    }

    /**
     * @OA\Post(
     *      path="/api/articles",
     *      operationId="storeArticle",
     *      tags={"Articles"},
     *      summary="Store new article",
     *      description="Returns article data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateArticleRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * ),
     */
    public function store(CreateArticleRequest $request)
    {
        $data = $request->validated();
        return response(new ArticleResource($this->service->createArticle($data)), Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/articles/{id}",
     *      operationId="getArticleById",
     *      tags={"Articles"},
     *      summary="Get article information",
     *      description="Returns article data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * ),
     */
    public function show(Article $article)
    {
        return response(new ArticleResource($article), Response::HTTP_OK);
    }

    /**
     * @OA\Put(
     *      path="/api/articles/{id}",
     *      operationId="updateArticle",
     *      tags={"Articles"},
     *      summary="Update existing article",
     *      description="Returns updated article data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateArticleRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ArticleResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * ),
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        return response(new ArticleResource($this->service->updateArticle($article, $data)), Response::HTTP_ACCEPTED);
    }

    /**
     * @OA\Delete(
     *      path="/api/articles/{id}",
     *      operationId="deleteArticle",
     *      tags={"Articles"},
     *      summary="Delete existing article",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      ),
     * ),
     */
    public function destroy(Article $article)
    {
        Article::destroy($article->id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
