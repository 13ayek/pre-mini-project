@extends('layouts.base')

@section('content')
    <main>
        <div class="container">
            <h1>Edit Payment</h1>

            <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select name="order_id" id="customer" class="form-select" required>
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}" {{ $order->id == $payment->order_id ? 'selected' : '' }}>
                                {{ $order->customer->name }} - Order #{{ $order->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-control" id="payment_method">
                        <option value="" disabled selected> - </option>
                        <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Bank Transfer" {{ $payment->payment_method == 'Bank Transfer' ? 'selected' : '' }}>
                            Bank Transfer</option>
                        <option value="Credit Card" {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit
                            Card</option>
                        <option value="E-Wallet" {{ $payment->payment_method == 'E-Wallet' ? 'selected' : '' }}>E-Wallet
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Money Paid Off</label>
                    <input type="number" name="amount" class="form-control" id="amount" value="{{ $payment->amount }}">
                </div>

                <div class="mb-3">
                    <label for="payment_date" class="form-label">Payment Date</label>
                    <input type="date" name="payment_date" class="form-control" id="payment_date"
                        value="{{ $payment->payment_date }}">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </main>
@endsection
