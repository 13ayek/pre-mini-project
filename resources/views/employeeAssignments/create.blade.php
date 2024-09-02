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
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="service_id" class="form-label">Service:</label>
                    <select name="service_id" class="form-control" id="service_id">
                        <option value="" disabled selected> - </option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}"
                                {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->service_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="schedule" class="form-label">Schedule:</label>
                @foreach ($days as $day)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="days[]" value="{{ $loop->iteration }}"
                            {{ in_array($day, old('schedule', $employeeAssignment->schedule ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $day }}</label>
                    </div>
                @endforeach
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('employeeAssignments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </main>
@endsection
