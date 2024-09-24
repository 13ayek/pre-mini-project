@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Employee List</h2>
                </div>
                <div class="card-body">
                    <!-- Add New Employee Button and Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
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

                    <x-session />

                    <!-- Employee Cards -->
                    <div class="row">
                        @foreach ($employees as $employee)
                            <div class="col-md-4 mb-3">
                                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded border-0 rounded-4 h-100">
                                    <div class="card-body flex-column justify-content-between p-2">
                                        <div class="text-center">
                                            @if ($employee->image)
                                                <img src="{{ Storage::url($employee->image) }}" alt="{{ $employee->name }}"
                                                    class="rounded-circle mb-2"
                                                    style="width: 120px; height: 120px; object-fit: cover;">
                                                <!-- Button trigger modal -->
                                                {{-- <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal-{{ $employee->id }}">
                                                    <i class="fas fa-search-plus" style="cursor: pointer;"></i>
                                                </a> --}}
                                                {{-- @foreach ($employees as $employee)
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="imageModal-{{ $employee->id }}"
                                                        tabindex="-1" aria-labelledby="imageModalLabel-{{ $employee->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="imageModalLabel-{{ $employee->id }}">
                                                                        {{ $employee->name }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ Storage::url($employee->image) }}"
                                                                        alt="{{ $employee->name }}"
                                                                        class="img-fluid rounded">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach --}}
                                            @else
                                                <img src="{{ asset('storage/default.png') }}" alt="Default Image"
                                                class="rounded-circle mb-2"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                            @endif

                                            <h5 class="card-title fw-bold text-primary mb-2">
                                                {{ ($employee->name) }}</h5>
                                            <p class="card-text mb-1"><strong>Email:</strong>
                                                {{ ($employee->email) }}</p>
                                            <p class="card-text mb-1"><strong>Phone:</strong>
                                                {{ $employee->phone_number }}
                                            </p>
                                            <p class="card-text mb-1"><strong>Position:</strong>
                                                {{ ($employee->position) }}</p>
                                            <p class="card-text mb-1"><strong>Hire Date:</strong>
                                                {{ \Carbon\Carbon::parse($employee->hire_date)->translatedFormat('d M Y') }}
                                            </p>
                                        </div>
                                        <center>
                                            <div class="btn-group mt-4 mb-2 ms-2" role="group">
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-warning btn-sm me-1">Edit</a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?');">Delete</button>
                                                </form>
                                            </div>
                                        </center>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination mt-3">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
