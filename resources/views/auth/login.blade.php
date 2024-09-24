@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #94dff6;
            font-family: Arial, sans-serif;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            background: #fff;
        }

        .image-container {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            max-width: 400px;
        }

        .login-form {
            padding: 2rem;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .d-flex {
            margin-top: 1rem;
        }

        .text-primary:hover {
            text-decoration: underline;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
            box-shadow: 0px 0px 10px rgba(0, 91, 187, 0.5);
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card shadow">
                    <div class="row g-0 pt-5 pb-5 ps-5 pe-5">
                        <!-- Gambar kiri -->
                        <div class="col-md-6 image-container">
                            <img src="foto/maskot laundry.jpg" alt="Login Image">
                        </div>
                        <!-- Form login kanan -->
                        <div class="col-md-6">
                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter your email" value="{{ old('email') }}" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Enter your password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-grid mt-5 mb-3">
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('register') }}" class="text-primary">Don't have an account?
                                            Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
