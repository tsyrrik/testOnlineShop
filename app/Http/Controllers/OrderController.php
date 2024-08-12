<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        return view('checkout', compact('cartItems', 'totalPrice'));
    }

    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => now(),
            'total_price' => $cartItems->sum(function ($cartItem) {
                return $cartItem->quantity * $cartItem->product->price;
            }),
        ]);

        foreach ($cartItems as $cartItem) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('order.view')->with('success', 'Заказ успешно оформлен!');
    }

    public function viewOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('order.index', compact('orders'));
    }
}
