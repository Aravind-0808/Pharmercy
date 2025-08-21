<?php

use Illuminate\Support\Facades\Route;
use Pharmercy\Customer\Http\Controllers\AddressesController;
use Pharmercy\Customer\Http\Controllers\CartController;
use Pharmercy\Customer\Http\Controllers\CustomerController;
use Pharmercy\Customer\Http\Controllers\OrdersController;
use Pharmercy\Customer\Http\Controllers\PaymentController;
use Pharmercy\Customer\Http\Controllers\ProfileController;
use Pharmercy\Customer\Http\Controllers\UserWalletController;

// Package routes go here
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/checkout/{store_id}/{product_id}/{quantity}', [CustomerController::class, 'checkout'])->name('customer.checkout');
Route::get('/products/{store_id}', [CustomerController::class, 'product'])->name('customer.product')->middleware('auth');
Route::post('/checkout/store-address', [AddressesController::class, 'store'])->name('customer.checkout.storeAddress')->middleware('auth');
Route::post('/checkout/place-order', [OrdersController::class, 'store'])->name('customer.checkout.placeOrder')->middleware('auth');
Route::get('customer/orders', [OrdersController::class, 'index'])->name('customer.orders')->middleware('auth');
Route::post("/customer/cart-order", [CartController::class, 'cartorder'])->name('customer.cart-order')->middleware('auth'); 
Route::post('customer/orders-cancel/{id}', [OrdersController::class, 'cancelOrder'])->name('customer.orders.cancel')->middleware('auth');
Route::post('customer/orders-cancel-cod/{id}', [OrdersController::class, 'cancelcodOrder'])->name('customer.orders.cancel.cod')->middleware('auth');

Route::get('customer/profile', [ProfileController::class, 'index'])->name('customer.profile')->middleware('auth');
Route::put('customer/update-address/{id}', [AddressesController::class, 'update'])->name('customer.update-address')->middleware('auth');

Route::get('customer/cart', [CartController::class, 'index'])->name('customer.cart')->middleware('auth');
Route::post('customer/cart', [CartController::class, 'store'])->name('customer.cart.store')->middleware('auth');
Route::delete('customer/cart/{id}', [CartController::class, 'destroy'])->name('customer.cart.destroy')->middleware('auth');

Route::get('/payment/initiate/{order_id}', [PaymentController::class, 'initiate'])->name('payment.initiate');
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');

Route::get('customer/wallet', [UserWalletController::class, 'index'])->name('customer.wallet')->middleware('auth');

Route::get('/product/{id}', [CustomerController::class, 'viewProduct'])
    ->name('customer.product.view');



Route::get('/product-view', function () {
    return view('Customer::product-view');
})->middleware('auth');
