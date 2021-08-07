<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReviewController;
use App\Models\Review;
use App\Models\User;

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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum'] ], function() {
    /*routes need to access */
//  Route::resource('/users',[UserController::class,'index']);

});

Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);
Route::post('/users',[UserController::class,'store']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'destroy']);
Route::get('/developers',[UserController::class,'getDevelopers']);
Route::get('/mostProjects',[ProjectController::class,'getMostProjects']);
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/reviews',[ReviewController::class,'index']);
Route::get('/HomeReviews',[ReviewController::class,'HomeReviews']);
Route::post('/reviews',[ReviewController::class,'store']);


Route::apiResource('portfolio',App\Http\Controllers\PortfolioController::class);

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});