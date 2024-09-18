@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Customer List</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Add New Customer Button -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <a href="{{ route('customers.create') }}" class="btn btn-outline-info">Add New Customer</a>
                        </div>
                        <!-- Search Form -->
                        <div class="col-md-6">
                            <form action="{{ route('customers.index') }}" method="GET" class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="search" placeholder="Search..."
                                        value="{{ request('search') }}" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <x-session/>

                    <!-- Customer Cards -->
                    <div class="row">
                        @foreach ($customers as $customer)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded border rounded-4 h-100" style="max-width: 25rem">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-primary">{{ $customer->name }}</h5>
                                        <p class="card-text mb-1"><strong>Email:</strong> {{ $customer->email }}</p>
                                        <p class="card-text mb-1"><strong>Phone:</strong> {{ $customer->phone }}</p>
                                        <p class="card-text"><strong>Address:</strong> {{ $customer->address }}</p>

                                        <div class="btn-group mt-3" role="group">
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pagination mt-3">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
