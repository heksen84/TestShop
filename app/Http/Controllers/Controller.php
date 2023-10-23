<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="TestShop API", description="Ilya Bobkov (ilyabobkovprog@gmail.com)", version="0.1",  @OA\Contact(name="Swagger API Team"))
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 **/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
