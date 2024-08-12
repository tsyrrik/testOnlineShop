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
                    <input type="number" name="quantity" value="1" min="1" class="quantity-input" data-id="{{ $product->id }}">
                    <button type="button" class="quantity-modify increase" data-id="{{ $product->id }}">+</button>
                    <button type="submit">Добавить в корзину</button>
                </form>
            </div>
        @endforeach

        </tbody>
    </table>
@endsection
<script>
    document.querySelectorAll('.quantity-modify').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
            let quantity = parseInt(input.value);

            if (this.classList.contains('increase')) {
                quantity++;
            } else if (this.classList.contains('decrease')) {
                quantity = quantity > 1 ? quantity - 1 : 1; // Prevent quantity from going below 1
            }

            input.value = quantity;
        });
    });
</script>

