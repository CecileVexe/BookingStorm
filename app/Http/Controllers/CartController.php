<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view("cart.show");
    }

    public function addToCart(Request $request)
    {
        //On vérifie que l'id du livre existe bien
        $request->validate([
            "book_id" => ["required", "exists:books,id"]
        ]);

        $book = Book::find($request->input("book_id"));

        $order = $request->user()->orders()->where("status", "cart")->first();

        if (!$order) {
            $order = Order::create(
                [
                    "user_id" => $request->user()->id,
                    "total" => 10,
                    "status" => "cart"
                ]
            );
        }

        $order->orderItems()->create([
            "book_id" => $request->input("book_id"),
            "quantity" => 1,
            "price" => $book->price
        ]);

        $request->session()->flash("success", "Votre produit a bien été ajouté au panier");
        return redirect()->intended("cart.show");
    }
}
