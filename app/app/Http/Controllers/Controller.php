<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="OpenApi Documentation For Space Flight News",
     *      description="Documentation intended to guide the use of the API to access spaceflight news articles",
     *      @OA\Contact(
     *          email="sfnews_admin@gmail.com"
     *      ),
     * 
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * ),
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * ),

     *
     * @OA\Tag(
     *     name="Space Flight News",
     *     description="API Endpoints of Space Flight News"
     * ),
     * 
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
