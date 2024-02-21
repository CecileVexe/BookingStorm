<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/catalogue", "App\Http\Controllers\Api\BookController@index")->name("catalogue.index");
Route::get("/book/{book}", "App\Http\Controllers\Api\BookController@show")->name("book.show");

Route::post("/login", "App\Http\Controllers\Api\AuthController@login")->name("login");

Route::middleware('auth:sanctum')->group(function () {
    Route::get("/cart", "App\Http\Controllers\Api\CartController@show")->name("cart.show");
    Route::post("/cart/item", "App\Http\Controllers\Api\CartController@add")->name("cart.add");
    Route::post("/cart/complete", "App\Http\Controllers\Api\CartController@complete")->name("cart.complete");
    Route::delete("/cart/delete/{orderItem}", "App\Http\Controllers\Api\CartController@delete")->name("cart.delete");
});
