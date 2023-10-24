<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Requests\ShoppingCardRequest;

class ShoppingCartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shoppingCart",
     *     tags={"Корзина"},
     *     security={ {"sanctum": {} }},     
     *     summary="Перечень продуктов в корзине",     
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return ShoppingCart::all();
    }

    /**
     * @OA\Post(
     *     path="/api/shoppingCart",
     *     tags={"Корзина"},
     *     security={ {"sanctum": {} }},     
     *     summary="Добавить продукт в корзину",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="id продукта",
     *                      property="product_id",
     *                      type="number",
     *			            default=1
     *                 )
     * ))),
     *     @OA\Response(response=201, description="Ресурс создан", @OA\JsonContent()),     
     * )     
     * )
     */
    public function add(ShoppingCardRequest $request)
    {

        if (!$request->validated())
            return response()->json($request->errors()->all());

        ShoppingCart::create($request->all());

        return response()->json(['message' => 'Продукт добавлен в корзину']);
    }

    /**
     * @OA\Delete(
     *     path="/api/shoppingCart/{id}",
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
    public function delete($id)
    {
        $shoppingCart = ShoppingCart::where("product_id", $id);
        $shoppingCart->firstOrFail();
        $shoppingCart->delete();

        return response()->json(['message' => 'Продукт удалён из корзины']);
    }
}
