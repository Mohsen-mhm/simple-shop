<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('index');

Route::resource('users', UserController::class)->except(['show', 'destroy']);
Route::put('users/toggle-block/{user}', [UserController::class, 'toggleBlock'])->name('users.toggle.block');
Route::resource('products', ProductController::class)->except('show');
Route::resource('orders', OrderController::class)->except(['show', 'create', 'store', 'destroy']);
Route::resource('payments', PaymentController::class)->except('show');
