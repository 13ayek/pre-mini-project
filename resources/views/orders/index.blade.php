@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Orders List</h2>
                </div>
                <div class="card-body">
                    <!-- Action and Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('orders.create') }}" class="btn btn-outline-info">Add New Order</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('orders.index') }}" method="GET" class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="search" placeholder="Search..."
                                        value="{{ request('search') }}" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Orders Table -->
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
                                    <td>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>Rp{{ number_format($order->total_price, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('orders.edit', $order->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
