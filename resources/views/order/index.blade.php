@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Мои заказы</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Дата заказа</th>
                <th>Товары</th>
                <th>Общая стоимость</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>
                        @foreach ($order->orderDetails as $detail)
                            {{ $detail->product->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
