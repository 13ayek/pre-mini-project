@extends('layouts.app')

@section('content')
    <main>
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-start">
                <a href="/orders" class="d-flex align-items-center mb-3 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Orders</span>
                </a>
            </div>
        </header>
        <div class="container mt-5">
            <div class="container">
                <a href="{{ route('orders.create') }}" type="button" class="btn btn-outline-info mb-3">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->customer->customer_id }}</td>
                            <td>{{ $order->service->service_id }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                <a href="{{ route('orders.edit', $order->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus penumpang ini?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
