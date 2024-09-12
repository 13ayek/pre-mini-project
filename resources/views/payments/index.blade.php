@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Payment List</h2>
                </div>
                <div class="card-body">
                    <!-- Action and Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('payments.create') }}" class="btn btn-outline-info">Add New Payment</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('payments.index') }}" method="GET" class="row">
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

                    <!-- Payments Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Order Name</th>
                                <th>Payment Date</th>
                                <th>Total</th>
                                <th>Money Paid Off</th>
                                <th>Refund</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->order->customer->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->translatedFormat('d M Y') }}</td>
                                    <td>Rp {{ number_format($payment->order->total_price, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($payment->refund, 2, ',', '.') }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ $payment->order->status }}</td>
                                    <td>
                                        <a href="{{ route('payments.edit', $payment->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination mt-3">
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
