@extends('layouts.base')

@section('content')
<main>
    <div class="container">
        <h1>Create Service</h1>

        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="service_name" class="form-label">service name</label>
                <input type="text" name="service_name" class="form-control" form-id="service_name" value="{{ old('service_name') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
