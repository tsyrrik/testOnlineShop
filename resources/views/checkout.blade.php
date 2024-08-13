@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Оформление заказа</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Название товара</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Итого</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->quantity * $item->product->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h3>Общая стоимость: {{ $totalPrice }}</h3>
        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Оформить заказ</button>
        </form>
    </div>
@endsection
