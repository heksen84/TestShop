<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="TestShop API", description="", version="0.1", @OA\Contact(email="ilyabobkovprog@gmail.com"))
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
