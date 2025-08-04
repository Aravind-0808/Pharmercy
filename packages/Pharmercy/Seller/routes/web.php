<?php

use Illuminate\Support\Facades\Route;
use Pharmercy\Seller\Http\Controllers\SellerController;

// Package routes go here
Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard')->middleware('auth');