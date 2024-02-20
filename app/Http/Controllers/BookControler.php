<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Editor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookControler extends Controller
{

    /**public function __construct()
    {
        $this->authorizeResource(Book::class);
    }*/

    /**
     * Display a listing of the resource.
     */
    public function index(string $category = null)
    {
        if ($category) {
            $books = Book::whereHas("categories", function (Builder $query) use ($category) {
                $query->where("slug", "=", $category);
            })->paginate(15);
            $category = Category::where("slug", $category)->first();
        } else {
            $books = Book::paginate(15);
        }
        return view('book.index', ["books" => $books, "category" => $category]); // ["books" => $books] passe le book au composant (like react)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Book::class);
        $editors = Editor::all();
        return view('book.create', compact('editors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookRequest $request)
    {
        $this->authorize("create", Book::class);
        //dd($request->all()); to dump the request data
        $request->file("cover")->store("public/covers"); //store file into the app/public/cover folder

        $book = Book::create(
            [
                ...$request->validated(),
                "cover" => $request->file("cover")->hashName(), //remplace cover with the hash name
                "price" => $request->input("price") * 100
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
        $this->authorize("edit", $book);
        $editors = Editor::all();
        return view('book.edit', compact('editors', "book"),);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $this->authorize("edit", $book);
        if ($request->hasFile("cover")) {
            Storage::delete("public/covers/" . $book->cover);
            $request->file("cover")->store("public/covers"); //store file into the app/public/cover folder
            $book->update([
                ...$request->validated(),
                "cover" => $request->file("cover")->hashName(), //remplace cover with the hash name
                "price" => $request->input("price") * 100
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

        $this->authorize("delete", $book);
        $book->delete();
        return redirect()->route("book.index");
    }

    public function pdf(Book $book)
    {
        $this->authorize("view", Book::class); // vérifier si la personne est autorisé à faire ça (le construct plus haut le permet sur le crud de base de l'appli)
        $pdf = Pdf::loadView('pdf.book', ["book" => $book]);
        return $pdf->download($book->title . '.pdf');
    }
}
