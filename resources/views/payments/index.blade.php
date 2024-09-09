@extends('layouts.base')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Payment</h1><br>
                <div class="row mb-3">
                    <div class="justify-content-end">
                        <a href="{{ route('payments.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Payment</a>
                        <form action="{{ route('payments.index') }}" method="GET" class="input-group">
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
                                <td>{{ \carbon\carbon::parse($payment->payment_date)->translatedFormat('d M Y') }}</td>
                                <td>Rp. {{ number_format($payment->order->total_price, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                <td>Rp. {{ number_format($payment->refund, 2, ',', '.') }}</td>
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
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus penumpang ini?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="pagination">
                    {{ $payments->links() }}
                </div> --}}
            </div>
        </div>
    </main>
@endsection
