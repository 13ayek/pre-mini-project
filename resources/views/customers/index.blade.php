@extends('layouts.base')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Customer</h1><br>
                <div class="row mb-3">
                    <div class="justify-content-end">
                        <a href="{{ route('customers.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Customer</a>
                        <form action="{{ route('customers.index') }}" method="GET" class="input-group">
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
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure for deleted this ');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
