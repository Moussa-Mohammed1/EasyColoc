<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view(view: 'welcome');
});

Route::get('/invitations/{token}', [InvitationController::class, 'accept'])->name('invitations.accept');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('colocations', ColocationController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('payments', PaymentController::class);
    
    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::post('/invitations/{token}', [InvitationController::class, 'process'])->name('invitations.process');
    Route::post('/member/remove', [UserController::class, 'remove'])->name('user.remove');
});
