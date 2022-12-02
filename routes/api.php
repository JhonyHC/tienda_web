<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//api/v1/products
Route::group(['namespace' => 'App\Http\Controllers\Api'], function(){
    Route::apiResource('products', ProductController::class);
    Route::apiResource('orders', OrderController::class);
});
/*
El prefix sirve para agregarle algo atras de la URL de la api 
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function(){
    Route::apiResource('products', ProductController::class);
}); */