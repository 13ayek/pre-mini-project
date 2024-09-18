@extends('layouts.base')

@section('content')
    <main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5 mb-5">
            <div class="col-md-8">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card shadow-lg border-0 rounded-4 p-4" style="background-color: #ffffff;">
                        <div class="card-header bg-info text-white text-center rounded-4">
                            <h2 class="fw-bold mb-0">CleanDream</h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-dark">Edit Employee</h3>
                            <p class="text-muted text-center">Update the employee details below</p>

                            <x-session />

                            <div class="mb-3">
                                <label for="name" class="form-label">Name :</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ $employee->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    value="{{ $employee->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number :</label>
                                <input type="number" name="phone_number" class="form-control" id="phone_number"
                                    value="{{ $employee->phone_number }}">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image :</label>
                                <div class="mb-3">
                                @if ($employee->image)
                                    <img src="{{ Storage::url($employee->image) }}" alt="{{ $employee->name }}"
                                        class="mb-2" style="width: 120px; height: 120px; object-fit: cover;">
                                    <!-- Button trigger modal -->
                                @endif
                            </div>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position :</label>
                                <input type="text" name="position" class="form-control" id="position"
                                    value="{{ $employee->position }}">
                            </div>

                            <div class="mb-3">
                                <label for="hire_date" class="form-label">Hire Date :</label>
                                <input type="text" name="hire_date" class="form-control" id="hire_date"
                                    value="{{ $employee->hire_date }}">
                            </div>

                            <div class="justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-4">Update</button>
                                <a href="{{ route('employees.index') }}"
                                    class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('#imagePreview');

            const fileReader = new FileReader();
            fileReader.readAsDataURL(image.files[0]);

            fileReader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
        }
    </script>
@endsection
