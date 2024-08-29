@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create Customer</h1>

        <form action="{{ route('customers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Customers name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="textarea" name="address" class="form-control" id="address" value="{{ old('address') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
