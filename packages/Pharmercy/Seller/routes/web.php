<?php

use Illuminate\Support\Facades\Route;

use Pharmercy\Seller\Http\Controllers\OrderController;
use Pharmercy\Seller\Http\Controllers\ProductsController;
use Pharmercy\Seller\Http\Controllers\SellerController;
use Pharmercy\Seller\Http\Controllers\StoreBankDetailsController;
use Pharmercy\Seller\Http\Controllers\StoreController;
use Pharmercy\Seller\Http\Controllers\WalletController;

// Package routes go here
Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard')->middleware('auth');
Route::get('/seller/product-table', [ProductsController::class, 'index'])->name('seller.product.table')->middleware('auth');
Route::get('/seller/wallet-table', [WalletController::class, 'index'])->name('seller.wallet.table')->middleware('auth');
Route::get('/seller/order-table', [OrderController::class, 'index'])->name('seller.order.table')->middleware('auth');
Route::get('/seller/generate-invoice/{orderId}', [SellerController::class, 'generate'])->name('seller.generate.invoice')->middleware('auth');

Route::post('/seller/withdraw', [WalletController::class, 'withdraw'])->name('seller.withdraw')->middleware('auth');
Route::get('/seller/withdrawal-request-table', [WalletController::class, 'getWithdrawalRequests'])->name('seller.withdrawal.request')->middleware('auth');

Route::post("/seller/add-bank-details", [StoreBankDetailsController::class, 'store'])->name('seller.add.bank.details')->middleware('auth');
Route::put("/seller/update-bank-details/{id}", [StoreBankDetailsController::class, 'update'])->name('seller.update.bank.details')->middleware('auth');


// Store CRUD routes
Route::middleware('auth')->prefix('sealler')->group(function () {
    Route::get('stores', [StoreController::class, 'index'])->name('seller.stores.index'); // Blade View
    Route::post('stores', [StoreController::class, 'store'])->name('seller.stores.store');
    Route::get('stores/{id}', [StoreController::class, 'show'])->name('seller.stores.show');
    Route::put('stores/{id}', [StoreController::class, 'update'])->name('seller.stores.update');
    Route::delete('stores/{id}', [StoreController::class, 'destroy'])->name('seller.stores.destroy');

    // Product CRUD routes
    Route::get('products/{store_id}', [ProductsController::class, 'index'])->name('seller.products.index');
    Route::post('products', [ProductsController::class, 'store'])->name('seller.products.store');
    Route::get('products/{id}', [ProductsController::class, 'show'])->name('seller.products.show');
    Route::put('products/{id}', [ProductsController::class, 'update'])->name('seller.products.update');
    Route::delete('products/{id}', [ProductsController::class, 'destroy'])->name('seller.products.destroy');
});
