<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookControler;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get(
    '/catalogue',
    BookControler::class . "@index"
)->name("catalogue");

Route::get(
    '/catalogue/create',
    BookControler::class . "@create"
)->name("book.create");

Route::get(
    '/catalogue/{book}',
    BookControler::class . "@show"
)->name("book.show");

Route::post(
    '/catalogue',
    BookControler::class . "@store"
)->name("book.store");*/

Route::resource("book", BookControler::class)->except(["show", "index"])->middleware("auth");

//Route::resource("book", BookControler::class)->only(["show", "index"]);
//Route::resource créer toutes les routes pour le CRUD

//Permet de mettre une catégory en slug

Route::get("/book/{book}", "App\Http\Controllers\BookControler@show")->name("book.show");

Route::get("book/{book}/pdf", [BookControler::class, "pdf"])->name("book.pdf");

Route::get(
    "/login",
    LoginController::class . "@show"
)->name("login");

Route::post(
    "/login",
    LoginController::class . "@authenticate"
)->name("login");

Route::post(
    "/logout",
    LogoutController::class . "@logout"
)->name("logout");

Route::get(
    "/register",
    RegisterController::class . "@show"
)->name("register");

Route::post(
    "/register",
    RegisterController::class . "@register"
)->name("register");

Route::middleware(["auth"])->group(function () {
    Route::get(
        "/cart",
        CartController::class . "@show"
    )
        ->name("cart.show");

    Route::post(
        "/cart/item",
        CartController::class . "@addToCart"
    )
        ->name("cart.addToCart");

    Route::post(
        "/cart/complete",
        CartController::class . "@complete"
    )->name("cart.complete");

    Route::delete(
        "/cart/item/{orderItem}",
        CartController::class . "@removeFromCart"
    )->name("cart.remove");
});





//A mettre tout en bas car appelé en dernier mais même racine (remember MSW)
Route::get("/{category?}", "App\Http\Controllers\BookControler@index")->name("book.index");
