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
        }

        .d-flex {
            height: 100vh;
        }

        #sidebar {
            position: absolute;
            top: 0;
            left: 0;
            width: 250px;
            /* Set the width of the sidebar */
            height: 100%;
            z-index: 1050;
            /* Ensure sidebar is above the navbar */
        }

        .navbar {
            z-index: 1000;
            /* Lower z-index to place navbar behind the sidebar */
            background-color: #5a9bd3 !important;
            /* Tambahkan !important */
            border-bottom: 1px solid #4a8ac4;
        }

        .navbar-nav .nav-link {
            color: white;
            /* Ubah warna teks link navbar menjadi putih */
        }

        .navbar-nav .nav-link:hover {
            color: #dfefff;
            /* Warna hover link di navbar */
        }

        .content {
            overflow-y: auto;
            margin-left: 250px;
            /* Adjust margin to the width of the sidebar */
            width: calc(100% - 250px);
            /* Adjust width to fill the remaining space */
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
                    <a class="nav-link" href="{{ route('payments.index') }}">Payments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('laundryItems.index') }}">Laundry Items</a>
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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color: #5a9bd3;">
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
            <!-- Page Content -->
            <div class="content flex-grow-1">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Styles -->
        <style>
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .d-flex {
                height: 100vh;
            }

            #sidebar {
                position: absolute;
                top: 0;
                left: 0;
                width: 250px;
                /* Set the width of the sidebar */
                height: 100%;
                z-index: 1050;
                /* Ensure sidebar is above the navbar */
            }

            .navbar {
                z-index: 1000;
                /* Lower z-index to place navbar behind the sidebar */
            }

            .content {
                overflow-y: auto;
                margin-left: 250px;
                /* Adjust margin to the width of the sidebar */
                width: calc(100% - 250px);
                /* Adjust width to fill the remaining space */
            }
        </style>
    </div>
</body>

</html>
