@extends('layouts.base')

@section('content')
    <main>
        <div class="container">
            <h1>Create laundry Item</h1>

            <form action="{{ route('laundryItems.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select name="order_id" id="customer" class="form-select" required>
                        <option value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            @foreach ($customer->orders as $order)
                                <option value="{{ $order->id }}">{{ $customer->name }} - {{ $order->customer->email }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name :</label>
                    <input type="text" name="item_name" class="form-control" id="item_name"
                        value="{{ old('item_name') }}">
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity :</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}">
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight :</label>
                    <input type="number" name="weight" class="form-control" id="weight" value="{{ old('weight') }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('laundryItems.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </main>
@endsection
