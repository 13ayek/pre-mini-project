@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <h3>Edit Service</h3>
        </div>

        <div class="row mt-3">
            <form action="{{ route('services.update', $service->id) }}" method="POST">
                @csrf
                @method('PUT')
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service Name</label>
                        <input type="text" name="service_name" class="form-control" id="service_name" value="{{ $service->service_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" value="{{ $service->description }}"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ $service->price }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </form>
        </div>
    </div>
</main>
@endsection
