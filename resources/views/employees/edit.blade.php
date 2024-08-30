@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Edit Employee</h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Directive untuk HTTP PUT -->

            <div class="mb-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $employee->name }}">
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number :</label>
                <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{ $employee->phone_number }}">
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position :</label>
                <input type="text" name="position" class="form-control" id="position" value="{{ $employee->position }}">
            </div>

            <div class="mb-3">
                <label for="hire_date" class="form-label">Hire Date :</label>
                <input type="text" name="hire_date" class="form-control" id="hire_date" value="{{ $employee->hire_date }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
