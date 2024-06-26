<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/product",
     *     tags={"Продукты"},
     *     security={ {"sanctum": {} }},     
     *     summary="Перечень продуктов",     
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Фильтр по названию",
     *         explode=true
     *     ),
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index(Request $request)
    {

        try {

            $product = Product::where('name', 'LIKE', '%' . $request->get('name') . '%');
            return response()->json($product->paginate($request->get('product')));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => false,
                'error' => $e->getMessage()
            ], 404);
        }

    }

    /**
     * @OA\Post(
     *     path="/api/product",
     *     tags={"Продукты"},
     *     summary="Сохранить продукт", 
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
    public function store(ProductRequest $request)
    {

        if (!$request->validated())
            return response()->json($request->errors()->all());

        $categoryId = $request->get('category_id');

        if (!Category::find($categoryId))
            return "Категория с id " . $categoryId . " не найдена";

        $data = $request->all();
        $data['image'] = url('') . '/' . $request->image->store('images', 'public');

        return Product::create($data);
    }

    /**
     * @OA\Get(
     *     path="/api/product/{id}",
     *     tags={"Продукты"},
     *     summary="Получить продукт", 
     *     security={ {"sanctum": {} }},     
     *     @OA\Response(response=200, description="Ресурс удалён"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id продукта"     
     *     )   
     * )     
     * )     
     */
    public function show($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * @OA\Post(
     *     path="/api/product/{id}",
     *     tags={"Продукты"},
     *     summary="Обновить продукт", 
     *     security={ {"sanctum": {} }},     
     *     @OA\Response(response=200, description="Ресурс обновлен"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id продукта"     
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *         mediaType="multipart/form-data",     
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
     * )))
     * )     
     * )     
     */
    public function update($id, ProductRequest $request)
    {

        if (!$request->validated())
            return response()->json($request->errors()->all());

        $data = $request->all();

        $categoryId = $request->get('category_id');

        if (!Category::find($categoryId))
            return "Категория с id " . $categoryId . " не найдена";

        $product = Product::findOrFail($id);

        File::delete(public_path() . '/images/' . basename($product->image));

        $data['image'] = url('') . '/' . $request->image->store('images', 'public');
        
        $product->update($data);

        return $product;
    }

    /**
     * @OA\Delete(
     *     path="/api/product/{id}",
     *     tags={"Продукты"},
     *     summary="Удалить продукт", 
     *     security={ {"sanctum": {} }},     
     *     @OA\Response(response=200, description="Ресурс удалён"),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id продукта"     
     *     )   
     * )     
     * )     
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        File::delete(public_path() . '/images/' . basename($product->image));
        $product->delete();

        return response()->json(['message' => 'Продукт удалён']);
    }
}