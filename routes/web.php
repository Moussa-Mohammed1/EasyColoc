<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController as AdminDashboard;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\ColocationController as AdminColocationController;

Route::get('/', function () {
    return view(view: 'welcome');
});

Route::get('/invitations/{token}', [InvitationController::class, 'accept'])->name('invitations.accept');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('colocations', ColocationController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('payments', PaymentController::class);

    Route::post('/invitations', [InvitationController::class, 'store'])->name('invitations.store');
    Route::post('/invitations/{token}', [InvitationController::class, 'process'])->name('invitations.process');
    Route::post('/member/remove', [UserController::class, 'remove'])->name('user.remove');
    Route::post('/colocations/{colocation}/status', [ColocationController::class, 'updateStatus'])->name('colocations.updateStatus');
    Route::post('/colocations/quit', [ColocationController::class, 'quit'])->name('colocations.quit');
    Route::middleware('isAdmin')
        ->group(function () {
            Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

            Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
            Route::post('/admin/users/{user}/ban', [AdminUserController::class, 'ban'])->name('admin.users.ban');
            Route::post('/admin/users/{user}/unban', [AdminUserController::class, 'unban'])->name('admin.users.unban');
            Route::get('/admin/colocations', [AdminColocationController::class, 'index'])->name('admin.colocations.index');
        });
});
