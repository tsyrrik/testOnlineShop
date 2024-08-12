@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <p>Корзина пуста.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена за единицу</th>
                    <th>Общая стоимость</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity * $item->product->price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{ route('checkout') }}">Перейти к оформлению</a>
        @endif
    </div>
@endsection
