<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
/**
 * list --> http://127.0.0.1:8000/api/list [GET]
 * category
 *  create --> http://127.0.0.1:8000/api/category/create [POST]
 *  list ---> http://127.0.0.1:8000/api/category/list [GET]
 *  update ---> http://127.0.0.1:8000/api/category/update/{id} [POST]
 *  delete ---> http://127.0.0.1:8000/api/category/update/{id} [POST]
 *
 *
**/

//All
Route::get('list/',[\App\Http\Controllers\ApiRouteController::class,'list']);

//category
Route::post('category/create',[\App\Http\Controllers\ApiRouteController::class,'categoryCreate']);
Route::get('category/list',[\App\Http\Controllers\ApiRouteController::class,'categoryList']);
// delete using (get method & post method)
Route::get('category/delete/{id}',[\App\Http\Controllers\ApiRouteController::class,'categoryDelete']);
Route::post('category/delete',[\App\Http\Controllers\ApiRouteController::class,'categoryDelete']);
Route::post('category/update/{id}',[\App\Http\Controllers\ApiRouteController::class,'categoryUpdate']);


