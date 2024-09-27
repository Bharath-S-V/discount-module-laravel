<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DiscountUsageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::resource('users', UserController::class);
Route::resource('bookings', BookingController::class);
Route::resource('discount_usages', DiscountUsageController::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');


Route::resource('admin/discounts', DiscountController::class);

Route::get('/', function () {
    return view('welcome');
});
