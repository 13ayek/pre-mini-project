@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <h1>Create Employee Assignments</h1>

        <form action="{{ route('employeeAssignments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">employee:</label>
                <select name="employee_id" class="form-control" id="employee_id">
                    <option value="" disabled selected> - </option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="order_id" class="form-label">Order:</label>
                <select name="order_id" class="form-control" id="order_id">
                    <option value="" disabled selected> - </option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}"
                            {{ old('order_id') == $order->id ? 'selected' : '' }}>
                            {{ $order->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="assigned_date" class="form-label">Assigned date :</label>
                <input type="text" name="assigned_date" class="form-control" id="assigned_date" value="{{ old('assigned_date') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('employeeAssignments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
