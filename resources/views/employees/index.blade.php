@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Employee</h2>
                </div>
                <div class="card-body">
                    <!-- Add New Employee Button and Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('employees.create') }}" class="btn btn-outline-info">Add New Employee</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('employees.index') }}" method="GET" class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="search" placeholder="Search..."
                                        value="{{ request('search') }}" autocomplete="off">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

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

                    <!-- Employee Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
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
                                    <td>
                                        @if ($employee->image)
                                            <img src="{{ Storage::url($employee->image) }}" alt="{{ $employee->name }}"
                                                class="rounded-circle"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @endif
                                    </td>

                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone_number }}</td>
                                    <td>{{ $employee->position }}</td>
                                    <td>{{ \Carbon\Carbon::parse($employee->hire_date)->translatedFormat('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this employee?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination mt-3">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
