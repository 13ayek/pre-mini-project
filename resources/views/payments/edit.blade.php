@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <h3>Edit Customer</h3>
        </div>

        <div class="row mt-3">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Customers name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $customer->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" max="12" name="phone" class="form-control" id="phone" value="{{ $customer->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $customer->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="textarea" name="address" class="form-control" id="address" value="{{ $customer->address }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </form>
        </div>
    </div>
</main>
@endsection
