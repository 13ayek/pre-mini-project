@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="order_name" class="form-label">order name</label>
                <input type="text" name="order_name" class="form-control" form-id="order_name" value="{{ old('order_name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="number" name="total_price" class="form-control" id="total_price" value="{{ old('total_price') }}">
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" class="form-control" id="total_price" value="{{ old('total_price') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
