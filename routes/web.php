<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Роуты для управления корзиной
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Роуты для управления заказами
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/orders', [OrderController::class, 'viewOrders'])->name('order.view');

    // Роуты для управления продуктами
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}/edit', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Доступ для всех пользователей к просмотру продуктов
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Роуты для аутентификации
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');  // изменено имя метода
Route::get('/register', [UserController::class, 'registration'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');  // изменено имя метода
Route::get('/signout', [UserController::class, 'signOut'])->name('signout');
