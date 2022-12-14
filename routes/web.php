<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
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
            Route::get('profile/change/{id}',[AuthController::class,'profileChange'])->name('profile_change');
            Route::post('profile/update/{id}',[AuthController::class,'profileUpdate'])->name('profile_update');
        //Account List
            Route::get('list/',[AuthController::class,'accountList'])->name('account_list');
            Route::post('changeRole/{id}',[AuthController::class,'accountChangeRole'])->name('account_change_role');
            Route::post('delete/{id}',[AuthController::class,'accountDelete'])->name('account_delete');
        });
        //Category Role
        Route::prefix('category')->group(function (){
            Route::get('list',[CategoryController::class,'list'])->name('category_list');
            Route::get('create',[CategoryController::class,'create'])->name('category_create');
            Route::post('create',[CategoryController::class,'store'])->name('category_store');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category_edit');
            Route::post('update',[CategoryController::class,'update'])->name('category_update');
            Route::post('delete/{id}',[CategoryController::class,'delete'])->name('category_delete');
        });
        //product List
        Route::prefix('product/')->group(function (){
            Route::get('list',[\App\Http\Controllers\ProductController::class,'list'])->name('product_list');
            Route::get('create',[\App\Http\Controllers\ProductController::class,'create'])->name('product_create');
            Route::post('create',[\App\Http\Controllers\ProductController::class,'store'])->name('product_store');
            Route::get('detail/{id}',[\App\Http\Controllers\ProductController::class,'detail'])->name('product_detail');
            Route::get('edit/{id}',[\App\Http\Controllers\ProductController::class,'edit'])->name('product_edit');
            Route::post('update',[\App\Http\Controllers\ProductController::class,'update'])->name('product_update');
            Route::post('delete{id}',[\App\Http\Controllers\ProductController::class,'delete'])->name('product_delete');
        });
        //Order List
        Route::prefix('order/')->group(function(){
            Route::get('list',[OrderController::class,'list'])->name('order_list');
            Route::get('status/change',[OrderController::class,'statusChange'])->name('order_statusChange'); //using ajax
            Route::get('status/list',[OrderController::class,'statusList'])->name('order_statusList');
            Route::get('order/detail/{order_code}',[\App\Http\Controllers\OrderListController::class,'orderDetail'])->name('order_detail');
        });
        //Contact List
        Route::get('contact/list',[\App\Http\Controllers\ContactController::class,'contactList'])->name('contact_list');

    });

    //User
    Route::group(['prefix'=>'user','middleware'=> 'isUser'],function (){
        Route::get('home/',[\App\Http\Controllers\HomeController::class,'home'])->name('user_home');
        Route::get('sorting/',[\App\Http\Controllers\HomeController::class,'sorting'])->name('user_sorting');
        Route::get('filter/category/{id}',[\App\Http\Controllers\HomeController::class,'filterCategory'])->name('user_filterCategory');
        Route::get('detail/{id}',[\App\Http\Controllers\HomeController::class,'detail'])->name('user_detail'); // using ajax
        Route::get('view/count',[\App\Http\Controllers\HomeController::class,'viewCount'])->name('user_viewCount'); // using ajax
        // Cart
        Route::get('addToCart/',[\App\Http\Controllers\CartController::class,'addToCart'])->name('user_addToCart');
        Route::get('cartList/',[\App\Http\Controllers\CartController::class,'cartList'])->name('user_cartList');
        Route::get('cartRow/remove',[\App\Http\Controllers\CartController::class,'cartRowRemove'])->name('user_cartRowRemove'); //using ajax
        Route::get('cartRows/remove',[\App\Http\Controllers\CartController::class,'cartRowsRemove'])->name('user_cartRowsRemove'); //using ajax
        Route::get('orderList/',[\App\Http\Controllers\CartController::class,'orderList'])->name('user_orderList'); //using ajax
        Route::get('order/',[\App\Http\Controllers\CartController::class,'order'])->name('user_order'); //using ajax
        //Account
        Route::get('profile/',[\App\Http\Controllers\UserController::class,'profile'])->name('user_profile');
        Route::get('profile/change/{id}',[\App\Http\Controllers\UserController::class,'profileChange'])->name('user_profileChange');
        Route::post('profile/update/{id}',[\App\Http\Controllers\UserController::class,'profileUpdate'])->name('user_profileUpdate');
        Route::get('password/change/',[\App\Http\Controllers\UserController::class,'passwordChange'])->name('user_passwordChange');
        Route::post('password/update/',[\App\Http\Controllers\UserController::class,'passwordUpdate'])->name('user_passwordUpdate');
        //contact message
        Route::post('contact/message',[\App\Http\Controllers\ContactController::class,'contactMessage'])->name('contact_message');
    });

});




