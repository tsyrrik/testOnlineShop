<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use App\Models\Product;
use App\Http\Requests\AddToCartRequest;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request, $productId)
    {
        $user = Auth::user();
        $quantity = $request->input('quantity', 1);

        $userProduct = UserProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($userProduct) {
            // Если товар уже в корзине, увеличиваем количество
            $userProduct->quantity += $quantity;
            $userProduct->save();
        } else {
            // Если товара нет в корзине, создаем новую запись
            UserProduct::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

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
        $cartItems = UserProduct::where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }
}
