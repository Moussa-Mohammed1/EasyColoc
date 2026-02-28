<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('colocations', ColocationController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('categories', CategoryController::class);
});
