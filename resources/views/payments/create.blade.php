@extends('layouts.base')

@section('content')
    <main>
        <div class="container">
            <h1>Create Payment</h1>

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select name="order_id" id="customer" class="form-select">
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            @foreach ($customer->orders as $order)
                                <option value="{{ $order->id }}">{{ $customer->name }} - Order #{{ $order->id }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">payment_method</label>
                        <select name="payment_method" class="form-control" id="payment_method">
                            <option value="" disabled selected>Select payment method</option>
                            <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>
                                Bank Transfer</option>
                            <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>
                                Credit Card</option>
                            <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Money Paid Off</label>
                        <input type="number" name="amount" class="form-control" id="amount"
                            value="{{ old('amount') }}">
                    </div>

                    <div class="mb-3">
                        <label for="payment_date" class="form-label">payment_date</label>
                        <input type="date" name="payment_date" class="form-control" id="payment_date"
                            value="{{ old('payment_date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </main>
@endsection
