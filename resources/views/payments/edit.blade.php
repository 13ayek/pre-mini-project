@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
                <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Edit Payment</h3>
                            <p class="text-muted text-center">Please update the payment details below</p>

                            <div class="mb-3">
                                <label for="order_id" class="form-label">Order</label>
                                <select name="order_id" id="order_id" class="form-select" required>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order->id }}" {{ $order->id == $payment->order_id ? 'selected' : '' }}>
                                            {{ $order->customer->name }} - Rp.{{ number_format($order->total_price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Money Paid Off</label>
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="{{ $payment->amount }}">
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" id="payment_method">
                                    <option value="" disabled>Select Payment Method</option>
                                    <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Bank Transfer" {{ $payment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="Credit Card" {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="E-Wallet" {{ $payment->payment_method == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" class="form-control" id="payment_date" value="{{ $payment->payment_date }}">
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Save Changes</button>
                                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
