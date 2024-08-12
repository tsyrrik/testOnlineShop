<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        $cart = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($cart) {
            // If the cart item exists, increment the quantity
            $cart->increment('quantity', $quantity);
        } else {
            // If no cart item exists, create a new one with the given quantity
            $cart = Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }
}
