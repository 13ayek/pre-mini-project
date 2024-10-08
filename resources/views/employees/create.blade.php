@extends('layouts.base')

@section('content')
<main>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 mb-5">
        <div class="col-md-8">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                    <div class="card-header bg-info text-white text-center rounded-4">
                        <h2 class="fw-bold mb-0">CleanDream</h2>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center text-dark">Add New Employee</h3>
                        <p class="text-muted text-center">Please fill in the form below correctly</p>

                        <x-session/>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" name="position" class="form-control" id="position" value="{{ old('position') }}">
                    </div>

                    <div class="mb-3">
                        <label for="hire_date" class="form-label">Hire Date</label>
                        <input type="date" name="hire_date" class="form-control" id="hire_date" value="{{ old('hire_date') }}">
                    </div>

                    <div class="justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
