@extends('layouts.app')

@section('content')
    <main>
        <div class="card">
            <div class="card-header">
                <h1>Orders</h1>
            </div>
        </div>

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
