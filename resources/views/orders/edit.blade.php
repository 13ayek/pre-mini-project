@extends('layouts.base')

@section('content')
<main>
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer:</label>
                <select name="customer_id" class="form-control" id="customer_id">
                    <option value="" disabled> - </option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Service:</label>
                <select name="service_id" class="form-control" id="service_id">
                    <option value="" disabled> - </option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ $order->service_id == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date</label>
                <input type="date" name="order_date" class="form-control" id="order_date" value="{{ $order->order_date }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control" id="status">
                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $order->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" class="form-control" id="total_price" value="{{ $order->total_price }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
