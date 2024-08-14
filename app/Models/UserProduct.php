<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public static function createOrUpdateQuantity(int $userId, int $productId, int $quantity)
    {
        $userProduct = UserProduct::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($userProduct) {
            // Если товар уже в корзине, увеличиваем количество
            $userProduct->quantity += $quantity;
            $userProduct->save();
        } else {
            // Если товара нет в корзине, создаем новую запись
            parent::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }
}
