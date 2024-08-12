@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" required>
        </div>

        <button type="submit">Create</button>
    </form>
@endsection
