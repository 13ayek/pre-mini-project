@extends('layouts.base')

@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <div class="row mb-3">

                    <h1>Service</h1>
                </div>
                <div class="row mb-3">
                    <div class="justify-content-end">
                        <a href="{{ route('services.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Service</a>
                        <form action="{{ route('services.index') }}" method="GET" class="input-group">
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
                            <th>Service</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>Rp. {{ number_format($service->price, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('services.edit', $service->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
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
                    {{ $services->links() }}
                </div>
            </div>
    </main>
@endsection
