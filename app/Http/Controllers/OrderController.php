<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = $user->userProducts;
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        return view('checkout', compact('cartItems', 'totalPrice'));
    }

    public function placeOrder(Request $request, OrderService $orderService)
    {
        $user = Auth::user();

        if ($user->userProducts->isEmpty()) {
            return redirect()->back()->with('error', 'Ваша корзина пуста!');
        }

        $orderService->create($user);


        return redirect()->route('order.view')->with('success', 'Заказ успешно оформлен!');
    }

    public function viewOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('order.index', compact('orders'));
    }
}
