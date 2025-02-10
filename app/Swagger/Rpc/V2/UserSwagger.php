<?php

declare(strict_types=1);

namespace App\Swagger\Rpc\V2;

use App\Swagger\Swagger;
use OpenApi\Annotations as OA;

/**
 *  @OA\PathItem(
 *      path="/rpc/v2",
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
     *      path="/rpc/v2/user@list",
     *      tags={"user"},
     *      summary="something",
     *      deprecated=true,
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
    public function listV2()
    {
    }
}
