@extends('layouts.app')
@section('content')
    <main>
        <div class="card">
            <div class="card-header">
                <h1>Payments</h1>
            </div>
        </div>

        <div class="container mt-5">
            <div class="container">
                <a href="{{ route('payments.create') }}" type="button" class="btn btn-outline-info mb-3">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Order</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->orders->order_id }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_date }}</td>
                            <td>{{ $payment->status }}</td>
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
