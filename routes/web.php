<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeAssignmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LaundryItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
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
    'orders' => OrderController::class,
    'payments' => PaymentController::class,
    'laundryItems' => LaundryItemController::class,
    'employees' => EmployeeController::class,
    'employeeAssignments' => EmployeeAssignmentController::class,


]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
