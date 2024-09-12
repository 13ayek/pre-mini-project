@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Create Payment</h3>
                            <p class="text-muted text-center">Please fill in the form below correctly</p>

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
                            
                            <div class="mb-3">
                                <label for="order_id" class="form-label">Order</label>
                                <select name="order_id" id="order_id" class="form-select">
                                    <option value="" disabled selected>Select Order Name</option>
                                    @foreach ($customers as $customer)
                                        @foreach ($customer->orders as $order)
                                            <option value="{{ $order->id }}" data-order-date="{{ $order->order_date }}">{{ $customer->name }} ({{ $customer->email }}) - Rp.{{ number_format($order->total_price, 0, ',', '.') }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Money Paid Off</label>
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter amount" value="{{ old('amount') }}">
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" id="payment_method">
                                    <option value="" disabled selected>Select Payment Method</option>
                                    <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Bank Transfer" {{ old('payment_method') == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    <option value="Credit Card" {{ old('payment_method') == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="E-Wallet" {{ old('payment_method') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="payment_date" class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" class="form-control" id="payment_date" value="{{ old('payment_date') }}">
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
                                <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('order_id').addEventListener('change', function() {
            // Mendapatkan tanggal order dari opsi yang dipilih
            var selectedOption = this.options[this.selectedIndex];
            var orderDate = selectedOption.getAttribute('data-order-date');

            // Mengatur tanggal minimum untuk input tanggal pembayaran
            var paymentDateInput = document.getElementById('payment_date');
            paymentDateInput.min = orderDate;
        });
    </script>
@endsection
