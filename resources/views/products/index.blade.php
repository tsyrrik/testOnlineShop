@extends('layouts.app')

@section('content')
    <h1>Catalog</h1>
    <p>
        <a href="{{ route('products.create') }}">Create Product</a>
    </p>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <div>
                <h3>{{ $product->name }}</h3>
                <p>${{ $product->price }}</p>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="cart-form">
                    @csrf
                    <button type="button" class="quantity-modify decrease" data-id="{{ $product->id }}">-</button>

                    <!-- Обязательно укажите атрибут 'id' или 'class' для изменения значения -->
                    <input type="number" name="quantity" value="1" min="1" class="quantity-input" data-id="{{ $product->id }}">

                    <button type="button" class="quantity-modify increase" data-id="{{ $product->id }}">+</button>

                    <!-- Кнопка отправки формы -->
                    <button type="submit">Добавить в корзину</button>
                </form>
            </div>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

    <script>
        // JavaScript для увеличения/уменьшения количества
        document.querySelectorAll('.quantity-modify').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let currentValue = parseInt(input.value);

                // Увеличение или уменьшение значения на 1
                if (this.classList.contains('increase')) {
                    currentValue++;
                } else if (this.classList.contains('decrease')) {
                    // Убедитесь, что значение не меньше 1
                    if (currentValue > 1) {
                        currentValue--;
                    }
                }

                // Устанавливаем новое значение в input
                input.value = currentValue;
            });
        });
    </script>

@endsection
