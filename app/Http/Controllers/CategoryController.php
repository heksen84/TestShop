<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/category",
     *     tags={"Категории"},
     *     summary="Добавить категорию",     
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="Название группы",
     *                      property="name",
     *                      type="string",
     *			            default="Трапеция"
     *                 )
     * ))),
     *     @OA\Response(response=201, description="Ресурс создан", @OA\JsonContent()),     
     * )     
     * )
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/category",
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
     *                 ),
     *                 @OA\Property(
     *                      description="Название тренировки",
     *                      property="name",
     *                      type="string",
     *			            default="Упражнение на бицепс"
     *                 ),
     *                 @OA\Property(
     *                      description="описание",
     *                      property="description",
     *                      type="string",
     *			            default=null
     *                 ),
     *                 @OA\Property(
     *                      description="Видео М",
     *                      property="video_male",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="Видео М (профиль)",
     *                      property="video_male_profile",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="Видео М (анфас)",
     *                      property="video_male_full_face",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="Видео Ж",
     *                      property="video_female",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="Видео Ж (профиль)",
     *                      property="video_female_profile",
     *                      type="file",
     *                 ),
     *                 @OA\Property(
     *                      description="Видео Ж (анфас)",
     *                      property="video_female_full_face",
     *                      type="file",
     *                 ),
     *               @OA\Property(
     *                   property="muscle_groups",
     *                   description="Инвентарь",
     *                   description="Группы мышц",
     *                   type="array",
     *                   @OA\Items(
     *                      type="integer",
     *                      format="int64",
     *                      example=1,
     *                   ),
     *               ), 
     *               @OA\Property(
     *                   property="inventory",
     *                   description="Инвентарь",
     *                   type="array",
     *                   @OA\Items(
     *                      type="integer",
     *                      format="int64",
     *                      example=1,
     *                   ),
     *               )
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
