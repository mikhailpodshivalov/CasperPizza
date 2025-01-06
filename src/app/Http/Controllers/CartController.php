<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $cart[] = [
            'pizza_id' => $request->pizzaId,
            'name' => $request->name,
            'image' => $request->image,
            'size' => $request->size,
            'price' => $request->price,
        ];
        session(['cart' => $cart]);
        return back();
    }

    public function index()
    {
        $cart = session('cart', []);
        return Inertia::render('Cart', ['cart' => $cart]);
    }

    public function checkout(Request $request)
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $index = $request->input('index');
        $cart = session()->get('cart', []);
        if (!isset($cart[$index])) {
            return back()->withErrors(['message' => 'Element nije pronađen']);
        }

        unset($cart[$index]);
        $cart = array_values($cart);
        session()->put('cart', $cart);

        return back()->with(['cart' => $cart]);
    }
}
