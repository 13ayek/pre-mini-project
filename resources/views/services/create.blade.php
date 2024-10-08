@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf
                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Add New Service</h3>
                            <p class="text-muted text-center">Please fill in the form below to create a new service</p>

                            <x-session/>

                            <div class="mb-3">
                                <label for="service_name" class="form-label">Service Name</label>
                                <div class="input-group">
                                    <input type="text" name="service_name" class="form-control" id="service_name"
                                        placeholder="Enter service name" value="{{ old('service_name') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3"
                                    placeholder="Enter service description">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control" id="price"
                                        placeholder="Enter service price" value="{{ old('price') }}">
                                </div>
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Submit</button>
                                <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
