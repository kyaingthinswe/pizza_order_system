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
            Route::get('profile/',[AuthController::class,'profile'])->name('profile');
            Route::get('profile/change/',[AuthController::class,'profileChange'])->name('profile_change');
            Route::post('profile/update/',[AuthController::class,'profileUpdate'])->name('profile_update');
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
    });

    //User
    Route::group(['prefix'=>'user','middleware'=> 'isUser'],function (){
        Route::get('home/',function (){
            return view('user.home');
        })->name('user_home');
    });



});


