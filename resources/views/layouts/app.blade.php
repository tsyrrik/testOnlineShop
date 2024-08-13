<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Каталог продуктов')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .navbar {
            background-color: #0056b3;
            padding: 1rem;
            text-align: center;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 1rem;
        }

        .container {
            width: 90%;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="{{ route('products.index') }}">Продукты</a>
    <a href="{{ route('products.create') }}">Добавить продукт</a>
    <a href="{{ route('cart.view') }}">Корзина</a>
    <a href="{{ route('order.view') }}">Заказы</a>
    <a href="{{ route('signout') }}">Logout</a>


</nav>

<div class="container">
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
