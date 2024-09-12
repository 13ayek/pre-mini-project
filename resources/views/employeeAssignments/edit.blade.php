@extends('layouts.base')

@section('content')
<main>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-8">
            <form action="{{ route('employeeAssignments.update', $employeeAssignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                    <div class="card-header bg-info text-white text-center rounded-4">
                        <h2 class="fw-bold mb-0">CleanDream</h2>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center text-dark">Edit Employee Assignment</h3>
                        <p class="text-muted text-center">Update the details below</p>

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
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" class="form-select" id="employee_id">
                                <option value="" disabled>Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $employeeAssignment->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="service_id" class="form-label">Service Sector</label>
                            <select name="service_id" class="form-select" id="service_id">
                                <option value="" disabled>Select Service Sector</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ old('service_id', $employeeAssignment->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->service_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Schedule</label>
                            @foreach ($days as $day)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}"
                                        id="{{ $day }}" {{ in_array($day, old('days', $selectedDays)) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $day }}">
                                        {{ $day }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-4">Save Changes</button>
                            <a href="{{ route('employeeAssignments.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
