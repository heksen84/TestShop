<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/category",
     *     tags={"Категории"},
     *     security={ {"sanctum": {} }},     
     *     summary="Перечень категорий",     
     *     @OA\Response(response="200", description="Success")
     * )
     */
    public function index()
    {
        return Category::all();
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/category",
     *     tags={"Категории"},
     *     summary="Создать категорию", 
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
        return Category::create($request->all());
    }

    /**
     * @OA\Get(
     *     path="/api/category/{id}",
     *     tags={"Категории"},
     *     security={ {"sanctum": {} }},     
     *     summary="Получить категорию",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="id упражнения",
     *         required=true,
     *         explode=true,
     *         @OA\Schema(
     *             type="integer",
     *             minimum=0,
     *             default=1
     *         )
     *     ),
     *     @OA\Response(response="200", description="Ресурс получен")
     * )
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * @OA\Put(
     *     path="/api/category/{id}",
     *     tags={"Категории"},
     *     security={ {"sanctum": {} }},     
     *     summary="Обновить категорию",   
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="id упражнения",
     *                      property="id",
     *                      type="number",
     *			            default=1
     *                 )    
     * ))),
     *     @OA\Response(response=200, description="Ресурс обновлен"),     
     * )     
     * )     
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * @OA\Delete(
     *     path="/api/category",
     *     tags={"Категории"},
     *     security={ {"sanctum": {} }},     
     *     summary="Удалить категорию",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id упражнения",
     *         @OA\Schema(
     *             type="integer",
     *             minimum=0,
     *             default=1
     *         )
     *     ),
     *     @OA\Response(response=200, description="Ресурс удален", @OA\JsonContent()),     
     * )
     */
    public function destroy(Category $category)
    {
        //
    }
}
