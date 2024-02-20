<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view("auth/register");
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required|confirmed"
        ]);
        $hashedPassword = Hash::make($validated["password"]);

        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => $validated["password"],
            "role" => "customer",
        ]);

        Auth::login($user);

        $request->session()->flash("success", "Vous êtes bien inscrit");

        return redirect()->route("book.index");
    }
}
