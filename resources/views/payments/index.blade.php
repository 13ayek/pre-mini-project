@extends('layouts.base')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
            <h1>Payment</h1><br>
                <a href="{{ route('payments.create') }}" type="button" class="btn btn-outline-info mb-3">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order Name</th>
                        <th>Payment Method</th>
                        <th>Money Paid Off</th>
                        <th>Total</th>
                        <th>Refund</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->order->customer->name }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>Rp. {{ number_format($payment->amount, 2, ',', '.') }}</td>
                            <td>Rp. {{ number_format($payment->order->total_price, 2,',','.') }}</td>
                            <td>Rp. {{ number_format($payment->refund, 2, ',', '.') }}</td>
                            <td>{{ $payment->payment_date }}</td>
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
        </div>
    </main>
@endsection
