@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01" required>
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
