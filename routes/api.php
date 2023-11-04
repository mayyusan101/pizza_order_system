<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*  Add => api url
*
*   localhost:8000/api/testing or 127.0.0.1:8000/testing
*/
Route::get('testing',function(){
    return " this is testing API Route from  api.php";
});

//read *
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('order_list',[RouteController::class,'orderList']);
Route::get('contact/list',[RouteController::class,'contactList']);

Route::get('product/category/user/lists',[RouteController::class,'listAll']);

//read 
Route::get('read/category/{id}',[RouteController::class,'readCategory']);
Route::post('read/category',[RouteController::class,'readCategory1']);

//create with only POST
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('create/user',[RouteController::class,'createUser']);

//delete with GET
Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);
Route::get('delete/contact/{id}',[RouteController::class,'deleteContact']);

//delete with POST
Route::post('delete/category',[RouteController::class,'deleteCategory1']);
Route::post('delete/contact',[RouteController::class,'deleteContact1']);

//update
Route::post('update/category',[RouteController::class,'updateCategory']);
