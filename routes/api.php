<?php

use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DiscountUsageController;
use Illuminate\Support\Facades\Route;

Route::get('/discounts', [DiscountController::class, 'index']);
Route::post('/discounts', [DiscountController::class, 'store']);
Route::get('/discounts/{id}', [DiscountController::class, 'show']);
Route::put('/discounts/{id}', [DiscountController::class, 'update']);
Route::delete('/discounts/{id}', [DiscountController::class, 'destroy']);

Route::post('/apply-discount', [DiscountUsageController::class, 'applyDiscount']);
