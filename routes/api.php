<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

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



Route::POST('/register',[UserController::class,"register"]);
Route::POST('/login',[UserController::class,"login"]);


Route::group(["middleware"=>["auth:sanctum"]],function(){
    //auth
    Route::get("users",[UserController::class,"users"]);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/products', [ProductController::class, 'index']);

    //products
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/products/search/{name}', [ProductController::class, 'search']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    

});