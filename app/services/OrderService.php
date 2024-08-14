<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(User $user)
    {
        DB::transaction(function () use ($user) {
            // Создаем заказ
            $order = Order::create([
                'user_id' => $user->id,
                'order_date' => now(),
                'total_price' => $user->userProducts->sum(function ($cartItem) {
                    return $cartItem->quantity * $cartItem->product->price;
                }),
            ]);

            // Добавляем детали заказа
            foreach ($user->userProducts as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                ]);
            }

            // Удаляем товары из корзины
            $user->userProducts()->delete();
        });
    }
}
