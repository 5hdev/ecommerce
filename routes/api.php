<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesApiController;
use App\Http\Controllers\OrdersApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('category', CategoriesApiController::class);
Route::get('latest_product_in_categories', [CategoriesApiController::class,'latest_product_in_categories']);
Route::get('category_content', [CategoriesApiController::class,'category_content']);
Route::post('order_post', [OrdersApiController::class,'store']);
// Route::apiResource('order', OrdersApiController::class);
