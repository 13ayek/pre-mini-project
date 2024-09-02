@extends('layouts.base')

@section('content')
<main>
    <div class="container">
        <h1>Create Employees</h1>

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number :</label>
                <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position :</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ old('position') }}">
            </div>

            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date :</label>
                <input type="date" name="hire_date" class="form-control" id="hire_date" value="{{ old('hire_date') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
