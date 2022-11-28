<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login,register
Route::group(['middleware'=>'isAdmin'],function (){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[\App\Http\Controllers\AuthController::class,'login'])->name('loginPage');
    Route::get('registerPage',[\App\Http\Controllers\AuthController::class,'register'])->name('registerPage');

});

//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
Route::middleware(['auth'])->group(function () {

    Route::get('dashboard/',[AuthController::class,'dashboard'])->name('dashboard');
    Route::middleware('isAdmin')->group(function (){
        //Admin
        Route::prefix('account')->group(function(){
        //password change
            Route::get('password/change/',[AuthController::class,'passwordChange'])->name('password_change');
            Route::post('password/update/',[AuthController::class,'passwordUpdate'])->name('password_update');
        //profile change
            Route::get('profile/{id}',[AuthController::class,'profile'])->name('profile');
            Route::get('profile/change/',[AuthController::class,'profileChange'])->name('profile_change');
            Route::post('profile/update/{id}',[AuthController::class,'profileUpdate'])->name('profile_update');
        //Admin List
            Route::get('list/',[AuthController::class,'accountList'])->name('account_list');
            Route::post('delete/{id}',[AuthController::class,'accountDelete'])->name('account_delete');
        });
        //Category List
        Route::prefix('category')->group(function (){
            Route::get('list',[CategoryController::class,'list'])->name('category_list');
            Route::get('create',[CategoryController::class,'create'])->name('category_create');
            Route::post('create',[CategoryController::class,'store'])->name('category_store');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category_edit');
            Route::post('update',[CategoryController::class,'update'])->name('category_update');
            Route::post('delete/{id}',[CategoryController::class,'delete'])->name('category_delete');
        });
        Route::prefix('product/')->group(function (){
            Route::get('list',[\App\Http\Controllers\ProductController::class,'list'])->name('product_list');
            Route::get('create',[\App\Http\Controllers\ProductController::class,'create'])->name('product_create');
            Route::post('create',[\App\Http\Controllers\ProductController::class,'store'])->name('product_store');
            Route::get('detail/{id}',[\App\Http\Controllers\ProductController::class,'detail'])->name('product_detail');
            Route::get('edit/{id}',[\App\Http\Controllers\ProductController::class,'edit'])->name('product_edit');
            Route::post('update',[\App\Http\Controllers\ProductController::class,'update'])->name('product_update');
            Route::post('delete{id}',[\App\Http\Controllers\ProductController::class,'delete'])->name('product_delete');
        });
    });

    //User
    Route::group(['prefix'=>'user','middleware'=> 'isUser'],function (){
        Route::get('home/',function (){
            return view('user.home');
        })->name('user_home');
    });



});


