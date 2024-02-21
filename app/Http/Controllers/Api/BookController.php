<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$books = Book::with(["categories", "editor"])->paginate(15);
        //return response()->json($books);

        return
            Book::with(["categories", "editor"])->paginate(15);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //return response()->json($book);

        return $book->load(["categories", "editor"]);
    }
}
