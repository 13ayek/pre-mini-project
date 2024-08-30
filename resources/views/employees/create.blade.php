@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create Employees</h1>

        <form action="{{ route('employees.store') }}" method="POST">
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

            <div class="mb-3">
                <label for="item_name" class="form-label">Item Name :</label>
                <input type="text" name="item_name" class="form-control" id="item_name" value="{{ old('item_name') }}">
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
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
