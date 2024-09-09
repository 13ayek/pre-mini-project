@extends('layouts.base')

@section('content')
<div class="container">
    <div class="container">
    <h1>Orders List</h1>
    <div class="row mb-3">
        <div class="justify-content-end">
            <a href="{{ route('orders.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Order</a>
            <form action="{{ route('orders.index') }}" method="GET" class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..."
                    value="{{ request('search') }}" autocomplete="off">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Customer Name</th>
                <th>Service</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->service->service_name }}</td>
                    <td>{{ \carbon\carbon::parse($order->order_date)->translatedFormat('d M Y') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp{{ number_format($order->total_price, 2,',','.') }}</td>
                    <td>
                        <!-- Link menuju halaman show -->
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $orders->links() }}
</div>
</div>
@endsection
