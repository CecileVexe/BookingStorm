<?php

use App\Http\Controllers\BookControler;
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

Route::get('/', function () {
    return view('welcome');
});

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

Route::resource("book", BookControler::class);
