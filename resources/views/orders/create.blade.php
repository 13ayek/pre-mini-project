@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 mb-5">
            <div class="col-md-8">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Create Order</h3>
                            <p class="text-muted text-center">Please fill in the form below correctly</p>

                            <x-session/>

                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer</label>
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
                                <label for="service_id" class="form-label">Service</label>
                                <select name="service_id" class="form-control" id="service_id">
                                    <option value="" disabled selected>Select Service Name</option>
                                    @foreach ($service as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                            {{ $service->service_name }} - Rp.
                                            {{ number_format($service->price, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Order Date</label>
                                <input type="date" name="order_date" class="form-control" id="order_date"
                                    value="{{ old('order_date') }}">
                            </div>

                            <div class="mb-3">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" name="item_name" id="item_name" class="form-control"
                                    placeholder="Enter item name" value="{{ old('item_name') }}">
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control"
                                    placeholder="Enter quantity" value="{{ old('quantity') }}">
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (kg) | 5000/kg</label>
                                <input type="number" name="weight" id="weight" class="form-control"
                                    placeholder="Enter weight in kg" value="{{ old('weight') }}">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In
                                        Progress</option>
                                    <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>
                                        Cancelled</option>
                                </select>
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
                                <a href="{{ route('orders.index') }}"
                                    class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
