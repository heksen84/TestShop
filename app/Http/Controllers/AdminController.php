<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/admin/login",
     *     tags={"Админ"},
     *     summary="Авторизация",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      description="почта",
     *                      property="email",
     *                      type="string",
     *			            default="admin@fiton.com"
     *                 ),
     *                 @OA\Property(
     *                      description="пароль",
     *                      property="password",
     *                      type="string",
     *			            default="22vWr!9grE"
     *                 )
     *             )
     *          )
     *        ),
     * @OA\Response(response=200, description="success", @OA\JsonContent()),
     * )
     */
    public function login(Request $request)
    {

        try {

            $rules = [
                'email' => 'required|email|min:6',
                'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
            ];

            $messages = [
                'email.required' => "Укажите email",
                'email.string' => "Укажите почту в виде строки",
                'email.unique' => "Почта уже существует",
                'password.required' => "Укажите пароль",
                'password.string' => "Укажите пароль в виде строки",
                'password.confirmed' => "Пароли не совпадают",
                'password.regex' => "Пароль должен быть не менее 6 символов и содержать цифры и специальные символы",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails())
                return response()->json($validator->errors()->first(), 400);

            //Проверка email
            $admin = Admin::where('email', mb_strtolower($request->get('email')))->first();

            // Проверка password
            if (!$admin || !Hash::check($request->get('password'), $admin->password))
                return response(['message' => 'Введен не правильный логин и/или пароль', 'success' => false], 401);

            $token = $admin->createToken($request->get('email'))->plainTextToken;

            $response = ['admin' => $admin, 'token' => $token];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/admin/logout",
     *     tags={"Админ"},
     *     summary="Выход",
     * 	   security={ {"sanctum": {} }},
     *     @OA\Response(response=200, description="success", @OA\JsonContent()),
     *     @OA\Response(response="500", description="Ошибка на стороне сервера", @OA\JsonContent())
     * )
     */
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return ['message' => 'Logged out'];
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }


    /**
     * @OA\Get(
     *     path="/api/admin/list/users",
     *     tags={"Админ"},
     *     summary="Cписок пользователей",
     * 	   security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="номер страницы"
     *     ),
     *      @OA\Parameter(
     *         name="count",
     *         in="query",
     *         description="кол-во элементов"
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="почта",
     *         explode=true,
     *         @OA\Schema(
     *             default="user@gmail.com",
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response=200, description="success", @OA\JsonContent()),
     * )
     */
    public function getUsers(Request $request)
    {

        try {

            $request->merge(['page' => $request->get('page')]);
            $result = User::where('email', 'LIKE', '%' . $request->get('email') . '%')->paginate($request->get('count'));
            return response()->json($result);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => false,
                'error' => $e->getMessage()
            ], 404);
        }
    }
}