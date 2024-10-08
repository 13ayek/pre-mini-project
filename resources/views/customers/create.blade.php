@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Add New Customer</h3>
                            <p class="text-muted text-center">Please fill in the form below correctly</p>

                            <x-session/>

                            <div class="mb-3">
                                <label for="name" class="form-label">Customer Name</label>
                                <div class="input-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter customer name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <div class="input-group">
                                    <input type="number" name="phone" class="form-control" id="phone"
                                        placeholder="Enter phone number" value="{{ old('phone') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="Enter email address" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter address">{{ old('address') }}</textarea>
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
                                <a href="{{ route('customers.index') }}"
                                    class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
