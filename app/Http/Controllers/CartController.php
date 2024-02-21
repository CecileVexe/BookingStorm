<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->user()->cart();
        $orderItems = $cart->orderItems;
        return view("cart.show", compact("cart", "orderItems"));
    }

    public function addToCart(Request $request)
    {
        //On vérifie que l'id du livre existe bien
        $request->validate([
            "book_id" => ["required", "exists:books,id"]
        ]);
        //Va chercher les infos du livre en fonction de l'input
        $book = Book::find($request->input("book_id"));
        // Vérifie si l'utilisateur à déjà une order de status cart
        $order = $request->user()->cart();
        // Vérifie la présence dans orderItem ou non du produit choisie
        $orderItem = $order->orderItems()->where("book_id", "=", $book->id)->first();

        if ($orderItem) {
            $orderItem->update([
                "quantity" => $orderItem->quantity + 1,
            ]);
        } else {

            $order->orderItems()->create([
                "book_id" => $request->input("book_id"),
                "quantity" => 1,
                "price" => $book->price
            ]);
        }

        $order->calculateTotal();

        $request->session()->flash("success", "Votre produit a bien été ajouté au panier");
        return redirect()->route("cart.show");
    }

    public function complete(Request $request)
    {
        $order = $request->user()->cart();

        if ($order->orderItems->count() === 0) {
            $request->session()->flash("error", "Vous ne pouvez pas payer un panier vide");
            return redirect()->route("cart.show");
        }

        $order->update([
            "status" => "completed"
        ]);

        return redirect()->route("cart.thank-you");
    }

    public function removeFromCart(Request $request, OrderItem $orderItem)
    {
        $orderItem->delete();
        $request->user()->cart()->calculateTotal();
        return redirect()->route("cart.show");
    }
}
