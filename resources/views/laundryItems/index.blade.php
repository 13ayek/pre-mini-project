@extends('layouts.base')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="container">
                <h1>Laundry Item</h1><br>
                <div class="row mb-3">
                    <div class="justify-content-end">
                        <a href="{{ route('laundryItems.create') }}" class="btn btn-outline-info me-2 mb-2">Add New Item</a>
                        <form action="{{ route('laundryItems.index') }}" method="GET" class="input-group">
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
                            <th>Customer</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Weight</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laundryItems as $laundryItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laundryItem->order->customer->name }}</td>
                                <td>{{ $laundryItem->item_name }}</td>
                                <td>{{ $laundryItem->quantity }}</td>
                                <td>{{ $laundryItem->weight }} kg</td>
                                <td>
                                    <a href="{{ route('laundryItems.edit', $laundryItem->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('laundryItems.destroy', $laundryItem->id) }}" method="POST"
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
                    {{ $laundryItems->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
