<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

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

    /**
     * @OA\Post(
     *     path="/api/category",
     *     tags={"Категории"},
     *     summary="Сохранить категорию", 
     *     security={ {"sanctum": {} }},         
     *     @OA\RequestBody(
     *         description="name - название категории, sub_categories - массив id категорий, например: sub_categories: [1,2,3,4,5]",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="название категории",
     *                      property="name",
     *                      type="string",
     *			            default="Аксессуары"
     *                 ),
     *                 @OA\Property(
     *                      description="массив id категорий",
     *                      property="sub_categories",
     *                      type="array",
     *                      @OA\Items(type="number", example={1,2,3,4,5})
     *                 ),     
     * ))),
     *     @OA\Response(response=201, description="Ресурс создан", @OA\JsonContent()),     
     * )     
     * )
     */
    public function store(CategoryRequest $request)
    {

        if (!$request->validated())
            return response()->json($request->errors()->all());

        foreach ($request->get('sub_categories') as $id) {
        }

        return Category::create($request->all());
    }

    /**
     * @OA\Delete(
     *     path="/api/category/{id}",
     *     tags={"Категории"},
     *     security={ {"sanctum": {} }},     
     *     summary="Удалить категорию",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id категории",
     *         @OA\Schema(
     *             type="integer",
     *             minimum=0,
     *             default=1
     *         )
     *     ),
     *     @OA\Response(response=200, description="Ресурс удален", @OA\JsonContent()),     
     * )
     */
    public function destroy($id)
    {
        //
    }
}
