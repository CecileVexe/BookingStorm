<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Editor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $books = Book::all();
        return view('book.index', ["books" => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $editors = Editor::all();
        return view('book.create', compact('editors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        //dd($request->all()); to dump the request data
        $request->file("cover")->store("public/covers"); //store file into the app/public/cover folder

        $book = Book::create(
            [
                ...$request->validated(),
                "cover" => $request->file("cover")->hashName() //remplace cover with the hash name
            ]
        );

        return redirect()->route("book.show", $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('book.show', compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

        $editors = Editor::all();
        return view('book.edit', compact('editors', "book"),);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        if ($request->hasFile("cover")) {
            Storage::delete("public/covers/" . $book->cover);
            $request->file("cover")->store("public/covers"); //store file into the app/public/cover folder
            $book->update([
                ...$request->validated(),
                "cover" => $request->file("cover")->hashName() //remplace cover with the hash name
            ]);
        } else {
            $book->update(
                $request->validated()
            );
        };

        /*dd($request->all(), $book);*/

        return redirect()->route("book.show", $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route("book.index");
    }

    public function pdf(Book $book)
    {
        $pdf = Pdf::loadView('pdf.book', ["book" => $book]);
        return $pdf->download($book->title . '.pdf');
    }
}
