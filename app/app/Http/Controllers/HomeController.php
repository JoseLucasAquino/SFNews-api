<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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
}
