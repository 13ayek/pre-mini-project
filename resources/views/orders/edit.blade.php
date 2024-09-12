@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 mb-5">
            <div class="col-md-8">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Edit Order</h3>
                            <p class="text-muted text-center">Please update the details below</p>

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
                                <label for="customer_id" class="form-label">Customer</label>
                                <select name="customer_id" class="form-control" id="customer_id">
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="service_id" class="form-label">Service</label>
                                <select name="service_id" class="form-control" id="service_id">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" {{ $order->service_id == $service->id ? 'selected' : '' }}>
                                            {{ $service->service_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Order Date</label>
                                <input type="date" name="order_date" class="form-control" id="order_date"
                                    value="{{ $order->order_date }}">
                            </div>

                            <div class="mb-3">
                                <label for="item_name" class="form-label">Item Name</label>
                                <input type="text" name="item_name" class="form-control" id="item_name"
                                    value="{{ $order->item_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" id="quantity"
                                    value="{{ $order->quantity }}">
                            </div>

                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (kg)</label>
                                <input type="number" name="weight" class="form-control" id="weight"
                                    value="{{ $order->weight }}">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $order->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Save Changes</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
