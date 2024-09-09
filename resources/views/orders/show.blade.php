@extends('layouts.base')

@section('content')
<div class="container">
    <h1>Order Details</h1>

    <div class="card">
        <div class="card-body">

            <p><strong>Customer Name:</strong> {{ $order->customer->name }}</p>
            <p><strong>Service Name:</strong> {{ $order->service->service_name }}</p>
            <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
                @foreach ($order->laundryItems as $item)
                    <p><strong>Item Name : </strong>{{ $item->item_name }}</p>
                    <p><strong>Quantity : </strong>{{ $item->quantity }}</p>
                    <p><strong>Weight : </strong>{{ $item->weight }} (Kg)</p>
                @endforeach
            <p><strong>Total Price:</strong> Rp. {{ number_format($order->total_price, 2) }}</p>

            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>
@endsection
