<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'single'])->name('product.single');

Route::prefix('/cart')->controller(CartController::class)->group(function () {
    Route::get('/', 'cart')->name('cart');
    Route::post('/add/{product}', 'addToCart')->name('addToCart');

    Route::patch('/quantity/change', 'quantityChange');
    Route::delete('/delete/{cart}', 'deleteFromCart')->name('cart.destroy');
});
Route::post('payment', [PaymentController::class, 'payment'])->middleware('auth')->name('cart.payment');
Route::post('payment/handle', [PaymentController::class, 'handle'])->middleware('auth')->name('payment.handle');
Route::get('payment/{resnumber}/success', [PaymentController::class, 'success'])->middleware('auth')->name('payment.success');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
