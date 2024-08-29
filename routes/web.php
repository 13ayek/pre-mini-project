<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

route::resources([
    'customers'=> CustomerController::class,
    'services' => ServiceController::class,
    'orders' => ServiceController::class,
    'payments' => ServiceController::class,
    'laundryItems' => ServiceController::class,
    'employees' => ServiceController::class,
    'employeesAssignments' => ServiceController::class,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
