@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-header bg-info text-white text-center rounded-4">
                    <h2 class="fw-bold mb-0">Service List</h2>
                </div>
                <div class="card-body">
                    <!-- Add New Service Button and Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('services.create') }}" class="btn btn-outline-info">Add New Service</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('services.index') }}" method="GET" class="row">
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

                    <x-session/>

                    <!-- Services Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $index => $service)
                                <tr>
                                    <td>{{ $services->firstItem() + $index }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>Rp {{ number_format($service->price, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('services.edit', $service->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                            class="d-inline">
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

                    <!-- Pagination -->
                    <div class="pagination mt-3">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
