<?php

use App\Http\Controllers\API\ApiController;
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
Route::get('products',[ApiController::class,'products']);
Route::get('products/{id}',[ApiController::class,'product']);

Route::post('category/add',[ApiController::class,'create_category']); // {name}
Route::post('category/delete',[ApiController::class,'delete_category']); // {id} of category;
Route::post('category/update',[ApiController::class,'update_category']); // {id,name} of category;


Route::post('contact/create',[ApiController::class,'create_contact']); // {name,email,subject,message}
