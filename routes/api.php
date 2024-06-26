<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminController::class, 'logout'])->middleware(['auth:sanctum'])->name('admin.logout');
    Route::get('/', [AdminController::class, 'get'])->middleware(['auth:sanctum'])->name('admin.get');
});

Route::group([
    'prefix' => 'category',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::group([
    'prefix' => 'product',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

Route::group([
    'prefix' => 'shoppingCart',
], function () {
    Route::get('', [ShoppingCartController::class, 'index']);
    Route::post('', [ShoppingCartController::class, 'store']);
    Route::delete('/{id}', [ShoppingCartController::class, 'destroy']);
});
