@extends('layouts.base')

@section('content')
    <main>
        <div class="container">
            <h1>Edit Employee Assignment</h1>

            <form action="{{ route('employeeAssignments.update', $employeeAssignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee:</label>
                    <select name="employee_id" class="form-control" id="employee_id">
                        <option value="" disabled> - </option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ old('employee_id', $employeeAssignment->employee_id) == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="service_id" class="form-label">Service sector:</label>
                    <select name="service_id" class="form-control" id="service_id">
                        <option value="" disabled> - </option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ old('service_id', $employeeAssignment->service_id) == $service->id ? 'selected' : '' }}>
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @foreach ($days as $day)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="days[]" value="{{ $day }}"
                            id="{{ $day }}" @if (in_array($day, $selectedDays)) checked @endif>
                        <label class="form-check-label" for="{{ $day }}">
                            {{ $day }}
                        </label>
                    </div>
                @endforeach


                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('employeeAssignments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </main>
@endsection
