<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

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
     *			            default="admin@testshop.com"
     *                 ),
     *                 @OA\Property(
     *                      description="пароль",
     *                      property="password",
     *                      type="string",
     *			            default="22vWr!9grE_"
     *                 )
     *             )
     *          )
     *        ),
     * @OA\Response(response=200, description="success", @OA\JsonContent()),
     * )
     */
    public function login(Request $request)
    {

        //return $request;

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
}
