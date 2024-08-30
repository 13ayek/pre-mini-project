@extends('layouts.app')
@section('content')
    <main>
        <div class="card">
            <div class="card-header">
                <h1>Employee Assignmentss</h1>
            </div>
        </div>

        <div class="container mt-5">
            <div class="container">
                <a href="{{ route('employeeAssignments.create') }}" type="button" class="btn btn-outline-info mb-3">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Employee Assignments</th>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeAssignments as $employeeAssignment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $employeeAssignment->employees->employee_id }}</td>
                            <td>{{ $employeeAssignment->orders->order_id }}</td>
                            <td>{{ $employeeAssignment->assigned_date }}</td>
                            <td>
                                <a href="{{ route('employeeAssignments.edit', $employeeAssignment->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('employeeAssignments.destroy', $employeeAssignment->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus penumpang ini?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
