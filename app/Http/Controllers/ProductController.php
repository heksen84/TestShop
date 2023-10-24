<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"Продукты"},
     *     security={ {"sanctum": {} }},     
     *     summary="Перечень продуктов",     
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @OA\Post(
     *     path="/api/product",
     *     tags={"Продукты"},
     *     summary="Создать продукт", 
     *     security={ {"sanctum": {} }},         
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="id категории",
     *                      property="category_id",
     *                      type="number",
     *			            default=1
     *                 ),
     *                 @OA\Property(
     *                      description="название продукта",
     *                      property="name",
     *                      type="string",
     *			            default="Аксессуары"
     *                 ),
     *                 @OA\Property(
     *                      description="описание",
     *                      property="description",
     *                      type="string",
     *			            default="Описание продукта"
     *                 ),    
     *                 @OA\Property(
     *                      description="изображение",
     *                      property="image",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="цена",
     *                      property="price",
     *                      type="number",
     *			            default=100000
     *                 ),
     *                 @OA\Property(
     *                      description="в наличии",
     *                      property="available",
     *                      type="boolean",
     *                 )
     * ))),
     *     @OA\Response(response=201, description="Ресурс создан", @OA\JsonContent()),     
     * )     
     * )
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['available'] = $request->get("available") === "true" ? 1 : 0;
        $data['image'] = url('') . '/' . $request->image->store('images', 'public');

        return Product::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/product/{id}",
     *     tags={"Продукты"},
     *     summary="Обновить продукт", 
     *     security={ {"sanctum": {} }},    
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="id продукта",
     *                      property="id",
     *                      type="number",
     *			            default=1
     *                 )    
     * ))),
     *     @OA\Response(response=200, description="Ресурс обновлен"),     
     * )     
     * )     
     */
    public function update(Request $request, Product $product)
    {
        return $request->get('id');

        //$products = $product->findOrFail($request->get('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
