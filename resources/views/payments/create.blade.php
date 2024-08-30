@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="order_id" class="form-label">Order:</label>
                <select name="order_id" class="form-control" id="order_id">
                    <option value="" disabled selected> - </option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}"
                            {{ old('order_id') == $order->id ? 'selected' : '' }}>
                            {{ $order->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">payment_method</label>
                    <select name="payment_method" class="form-control" id="payment_method">
                        <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Pending</option>
                        <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>In Progress</option>
                        <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Completed</option>
                        <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">amount</label>
                <input type="number" name="amount" class="form-control" id="amount" value="{{ old('amount') }}">
            </div>

            <div class="mb-3">
                <label for="payment_date" class="form-label">payment_date</label>
                <input type="date" name="payment_date" class="form-control" id="payment_date" value="{{ old('payment_date') }}">
            </div>

            <div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
