@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Order</h1><br>
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
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Order date</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->service->service_name }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->status }}</td>
                                <td>Rp. {{ $order->total_price }}</td>
                                <td>
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
                <div class="pagination">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
