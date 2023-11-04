<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\AdminAccountController;

//login , register
Route::redirect('/','loginPage');

Route::middleware(['route_auth'])->group(function(){
    
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    
    /* Admin */
    Route::middleware(['admin_auth'])->group(function(){

    //admin account
    Route::prefix('admin')->group(function(){
        //password
        Route::get('password/changePage',[AdminAccountController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('password/change' ,[AdminAccountController::class,'changePassword'])->name('adminAccount@changePassword');
    
        //personal information
        Route::get('personal/detail/page',[AdminAccountController::class,'detailPage'])->name('admin#detailPage');
        Route::get('personal/edit' ,[AdminAccountController::class,'editDetailPage'])->name('admin#editPage');
        Route::post('psersonal/update' ,[AdminAccountController::class,'updateDetail'])->name('Admin@updateDetail');

        //admin list
        Route::get('list/page' ,[AdminAccountController::class,'listPage'])->name('admin#listPage');
        Route::get('delete/{id}' ,[AdminAccountController::class,'delete'])->name('Admin@delete');
        Route::get('change/role' ,[AdminAccountController::class,'changeRole'])->name('Admin@changeRole');
    
        //dashboard
        Route::get('dashboard/page',[AdminAccountController::class,'dashboard'])->name('admin#dashboard');
    
    });

    //category
    Route::prefix('category')->group(function(){

        Route::get('list',[CategoryController::class,'listPage'])->name('category#listPage');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'create'])->name('Category@create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('Category@delete');
        Route::get('update/page/{id}',[CategoryController::class,'updatePage'])->name('category#updatePage');
        Route::post('update/{id}',[CategoryController::class,'update'])->name('Category@update');

    });
    
    //product 
    Route::prefix('product')->group(function(){

        Route::get('list' ,[ProductController::class,'listPage'])->name('product#listPage');
        Route::get('create/page' ,[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create' ,[ProductController::class,'create'])->name('Product@create');
        Route::get('view/page/{id}' ,[ProductController::class,'viewPage'])->name('product#viewPage');
        Route::get('update/page/{id}' ,[ProductController::class,'updatePage'])->name('product#updatePage');
        Route::post('update/{id}' ,[ProductController::class,'update'])->name('Product@update');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('Product@delete');
    });

    //order
    Route::prefix('order')->group(function(){

        Route::get('list' ,[OrderController::class,'listPage'])->name('order#listPage');
        Route::get('status/sorting',[OrderController::class,'statusSort'])->name('order#sort');
        Route::get('change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
        Route::get('listInfo/page/{orderCode}',[OrderListController::class,'listInfo'])->name('order#listInfo');
        Route::get('search',[OrderController::class,'search'])->name('Order@search');
    });

    //about user
    Route::prefix('user')->group(function(){

        Route::get('list',[UserListController::class,'userListPage'])->name('admin#userList');
        Route::get('change/role',[UserListController::class,'changeRole'])->name('Admin@changeUserRole');
        Route::get('delete/{id}',[UserListController::class,'delete'])->name('Admin@deleteUser');
    });

    //contact
    Route::prefix('contact')->group(function(){

        Route::get('list',[ContactController::class,'contactListPage'])->name('admin#contactPage');
        Route::get('detail/{id}',[ContactController::class,'detailPage'])->name('admin#contactDetailPage');
        Route::get('delete/{id}',[ContactController::class,'delete'])->name('Admin@deleteContact');
    
    });

    });

    /* User */
    Route::group(['prefix' => 'user' ,'middleware' => 'user_auth'] ,function(){

        //home page
        Route::get('/homePage' ,[UserController::class,'homePage'])->name('user#home');
        Route::get('/fileter/category/{id}' ,[UserController::class,'filterBy'])->name('user#filter');
       
        Route::prefix('product')->group(function(){

        //detail page
        Route::get('detail/page/{id}' ,[UserController::class,'detailPage'])->name('user#detailPage');
        //cart page
        Route::get('cart/page' ,[UserController::class,'cartPage'])->name('user#cartPage');
        });

        //history page
        Route::get('order/history/page' ,[UserController::class,'historyPage'])->name('user#historyPage');
        
        //add to cart
        Route::get('addTo/cart/{id}' ,[CartController::class,'addToCart'])->name('User@addToCart');
        
        //password
        Route::prefix('password')->group(function(){

            Route::get('change/page' ,[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change' ,[UserController::class,'changePassword'])->name('User@changePassword');
        });
        
        //profile
        Route::prefix('profile')->group(function(){

            Route::get('page' ,[UserController::class,'profilePage'])->name('user#profilePage');
            Route::post('change' ,[UserController::class,'profileChange'])->name('User@profileChange');
        });
        
        //transport data to and from with Ajax
        Route::prefix('ajax')->group(function(){

            Route::get('product/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('product/addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('process/checkOut',[AjaxController::class,'checkOut'])->name('ajax#checkOut');
            Route::get('delete/current/product/cart',[AjaxController::class,'deleteCart'])->name('ajax#deleteCart');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
        });

        //contact
        Route::prefix('contact')->group(function(){
            
            Route::get('page', [ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('send', [ContactController::class,'send'])->name('User@sendContact');
        });
        
    });

});



/*
* localhost:8000/testing  or 127.0.0.1:8000/testing
*/

Route::get('testing',function(){
    return " this is testing web Route from  web.php";
});
