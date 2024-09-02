@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create order</h1>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer:</label>
                <select name="customer_id" class="form-control" id="customer_id">
                    <option value="" disabled selected>Select Customer</option>
                    @foreach ($customer as $customer)
                        <option value="{{ $customer->id }}"
                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Service:</label>
                <select name="service_id" class="form-control" id="service_id">
                    <option value="" disabled selected> Select Service Name </option>
                    @foreach ($service as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="order_date" class="form-label">order_date</label>
                <input type="date" name="order_date" class="form-control" id="order_date" {{ old('order_date') }}>
            </div>

            <div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" id="status">
                        <option value="" disabled selected>Select Status</option>
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="number" name="total_price" class="form-control" id="total_price" value="{{ old('total_price') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection

</div>
