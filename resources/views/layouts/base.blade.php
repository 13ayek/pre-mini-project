<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Menghapus scrollbar dari body */
        }

        .d-flex {
            height: 100vh;
        }

        #sidebar {
            position: fixed;
            /* Mengubah dari absolute menjadi fixed */
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            z-index: 1050;
            overflow-y: auto;
            /* Menambahkan scroll jika konten sidebar terlalu panjang */
            background-color: #f8f9fa;
            /* Background untuk sidebar */
        }

        .navbar {
            z-index: 1000;
            background-color: #5a9bd3 !important;
            border-bottom: 1px solid #4a8ac4;
            position: fixed;
            /* Navbar juga harus fixed */
            top: 0;
            width: calc(100% - 250px);
            /* Lebar navbar disesuaikan dengan lebar konten */
            margin-left: 250px;
            /* Margin kiri sebesar lebar sidebar */
        }

        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-nav .nav-link:hover {
            color: #dfefff;
        }

        .content {
            margin-top: 56px;
            /* Menambahkan margin top sebesar tinggi navbar */
            margin-left: 250px;
            /* Margin kiri sebesar lebar sidebar */
            height: calc(100vh - 56px);
            /* Tinggi konten menyesuaikan layar dikurangi navbar */
            overflow-y: auto;
            /* Menambahkan scroll pada konten jika melebihi tinggi layar */
            width: calc(100% - 250px);
            /* Lebar konten disesuaikan dengan lebar sidebar */
            background-color: #e3f2fd;
            /* Contoh background untuk konten */
        }
    </style>

</head>

<body>

    <div id="app">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-light border-end shadow p-3 mb-5 bg-body-tertiary rounded">
            <div class="sidebar-header p-3 fs-2 fw-bold">
                <a class="navbar-brand" href="{{ url('home') }}">CleanDream</a>
            </div>
            <ul class="nav flex-column p-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('laundryItems.index') }}">Laundry Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employeeAssignments.index') }}">Employee Assignments</a>
                </li>
            </ul>
        </nav>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <!-- Add your navbar items here -->
                </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content -->
            <div class="d-flex">
                <div class="content flex-grow-1">
                    <div class="mt-4">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <main class="container">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </body>

    </html>

