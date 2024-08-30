@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Edit Laundry Item</h1>

        <form action="{{ route('laundyItems.update', $laundryItem->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="order_id" class="form-label">Order:</label>
                <select name="order_id" class="form-control" id="order_id">
                    <option value="" disabled> - </option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}"
                            {{ $laundryItem->order_id == $order->id ? 'selected' : '' }}>
                            {{ $order->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name:</label>
                <input type="text" name="item_name" class="form-control" id="item_name" value="{{ $laundryItem->item_name }}">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity:</label>
                <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $laundryItem->quantity }}">
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Weight:</label>
                <input type="number" name="weight" class="form-control" id="weight" value="{{ $laundryItem->weight }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('laundyItems.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
