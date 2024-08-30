@extends('layouts.app')
@section('content')
    <main>
        <header class="py-3 mb-4 border-bottom">
            <div class="container d-flex flex-wrap justify-content-start">
                <a href="/services" class="d-flex align-items-center mb-3 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">employee</span>
                </a>
            </div>
        </header>

        <div class="container mt-5">
            <div class="container">
                <a href="{{ route ('employees.create')}}" type="button" class="btn btn-outline-info mb-3">Add</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
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
        </div>
    </main>
@endsection
