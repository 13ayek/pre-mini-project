@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Employee Assignment</h1><br>
                <a href="{{ route('employeeAssignments.create') }}" type="button" class="btn btn-outline-info mb-3">Add New Assignment</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Employee Name</th>
                        <th>Service Sector</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeAssignments as $employeeId => $assignments)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $assignments->first()->employee->name }}</td>
                            <td>{{ $assignments->first()->service->service_name }}</td>
                            <td>
                                @foreach ($assignments as $assignment)
                                    {{ $assignment->day }}<br>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('employeeAssignments.edit', $assignments->first()->id) }}"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('employeeAssignments.destroy', $assignments->first()->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </main>
@endsection
