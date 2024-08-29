<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

route::resources([
    'customers'=> CustomerController::class,
    
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
