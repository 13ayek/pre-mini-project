@extends('layouts.base')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Employee</h1><br>
                <div class="row mb-3">
                    <div class="justify-content-end">
                        <a href="{{ route('employees.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Employee</a>
                        <form action="{{ route('employees.index') }}" method="GET" class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..."
                                value="{{ request('search') }}" autocomplete="off">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Hire Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone_number }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->hire_date }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                        class="d-inline">
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
                <div class="pagination">
                    {{ $employees->links() }}
                </div>
                </div>
            </div>
        </div>
    </main>
@endsection
