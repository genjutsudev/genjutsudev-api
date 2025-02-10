<?php

declare(strict_types=1);

namespace App\Swagger\Rpc\V1;

use App\Swagger\Swagger;
use OpenApi\Annotations as OA;

/**
 *  @OA\PathItem(
 *      path="/rpc/v1",
 *  ),
 *  @OA\Tag(
 *      name="user",
 *      description="API Endpoints of Users",
 *  ),
 */
class UserSwagger extends Swagger
{
    /**
     *  @OA\Post(
     *      path="/rpc/v1/user@list",
     *      tags={"user"},
     *      summary="something",
     *      @OA\Parameter(
     *          name="Authorization",
     *          in="header",
     *          description="Bearer",
     *          @OA\Schema(type="string", example="token"),
     *      ),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="jsonrpc", type="string", example="2.0"),
     *              @OA\Property(property="method", type="string", example="user@list"),
     *              @OA\Property(property="params", type="object",
     *                  @OA\Property(property="limit", type="integer", example=70),
     *                  @OA\Property(property="page", type="integer", example=7),
     *              ),
     *              @OA\Property(property="id", type="string", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              type="object",
     *              oneOf={
     *                  @OA\Schema(
     *                      type="object",
     *                      @OA\Property(property="id", type="string", example="1"),
     *                      @OA\Property(property="result", type="object",
     *                          @OA\Property(property="time", type="string", example="1ms"),
     *                          @OA\Property(property="total", type="int", example="10036"),
     *                          @OA\Property(property="items", type="array",
     *                              @OA\Items(type="object",
     *                                  @OA\Property(property="id", type="int", example="421"),
     *                                  @OA\Property(property="name", type="string", example="Морозов Олег Борисович"),
     *                                  @OA\Property(property="email", type="string", example="o.morozov@example.com"),
     *                              ),
     *                          ),
     *                          @OA\Property(property="page_info", type="object",
     *                              @OA\Property(property="last_page", type="int", example="772"),
     *                              @OA\Property(property="is_first_page", type="boolean", example=false),
     *                              @OA\Property(property="has_next_page", type="boolean", example=true),
     *                          ),
     *                      ),
     *                      @OA\Property(property="jsonrpc", type="string", example="2.0"),
     *                  ),
     *                  @OA\Schema(
     *                      type="object",
     *                      @OA\Property(property="id", type="string", example="1"),
     *                      @OA\Property(property="error", type="object",
     *                          @OA\Property(property="code", type="integer", example=451),
     *                          @OA\Property(property="message", type="string", example="lol, you from russia."),
     *                          @OA\Property(property="data", type="null", example=null),
     *                      ),
     *                      @OA\Property(property="jsonrpc", type="string", example="2.0"),
     *                  )
     *              }
     *          )
     *      )
     *  )
     */
    public function listV1()
    {
    }
}
