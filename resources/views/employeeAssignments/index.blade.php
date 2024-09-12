@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Employee Assignment</h2>
                </div>
                <div class="card-body">
                    <!-- Add New Assignment Button -->
                    <a href="{{ route('employeeAssignments.create') }}" type="button" class="btn btn-outline-info mb-4">Add
                        New Assignment</a>

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
                    <!-- Employee Assignment Table -->
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
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('employeeAssignments.destroy', $assignments->first()->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
