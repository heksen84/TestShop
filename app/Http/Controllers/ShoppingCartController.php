<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shoppingCard",
     *     tags={"Корзина"},
     *     security={ {"sanctum": {} }},     
     *     summary="Перечень продуктов в корзине",     
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/shoppingCard",
     *     tags={"Корзина"},
     *     security={ {"sanctum": {} }},     
     *     summary="Добавить продукт в корзину",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="id продукта",
     *                      property="id",
     *                      type="number",
     *			            default=1
     *                 )
     * ))),
     *     @OA\Response(response=201, description="Ресурс создан", @OA\JsonContent()),     
     * )     
     * )
     */
    public function add(Request $request)
    {
    }

    /**
     * @OA\Delete(
     *     path="/api/shoppingCard/{id}",
     *     tags={"Корзина"},
     *     security={ {"sanctum": {} }},     
     *     summary="Удалить продукт из корзины",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id продукта",
     *         @OA\Schema(
     *             type="integer",
     *             minimum=0,
     *             default=1
     *         )
     *     ),
     *     @OA\Response(response=200, description="Ресурс удален", @OA\JsonContent()),     
     * )
     */
    public function remove(Request $request)
    {
    }
}
