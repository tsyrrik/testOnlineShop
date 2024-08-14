<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use App\Http\Requests\AddToCartRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request, int $productId)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        UserProduct::createOrUpdateQuantity( $user->id, $productId, $quantity);

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();
        $userProduct = UserProduct::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($userProduct) {
            $userProduct->delete();
            return redirect()->back()->with('success', 'Товар удален из корзины!');
        }

        return redirect()->back()->with('error', 'Товар не найден в корзине!');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cartItems = $user->userProducts;

        return view('cart.index', compact('cartItems'));
    }
}
