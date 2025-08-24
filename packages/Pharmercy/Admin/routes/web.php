<?php

use Illuminate\Support\Facades\Route;
use Pharmercy\Admin\Http\Controllers\AdminController;

// Package routes go here
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/store-table', [AdminController::class, 'storeTable'])->name('admin.store.table')->middleware('auth');
Route::get('/admin/product-table', [AdminController::class, 'productTable'])->name('admin.product.table')->middleware('auth');
Route::get('/admin/wallet-table', [AdminController::class, 'walletTable'])->name('admin.wallet.table')->middleware('auth');
Route::get('/admin/store-wallet-amount', [AdminController::class, 'storeWalletAmount'])->name('admin.store.wallet.amount')->middleware('auth');
Route::get('/admin/transaction-table', [AdminController::class, 'transactionTable'])->name('admin.transaction.table')->middleware('auth');
Route::get('/admin/order-table', [AdminController::class, 'orderTable'])->name('admin.order.table')->middleware('auth');
Route::get('/admin/withdrawal-request', [AdminController::class, 'withdrawalRequest'])->name('admin.withdrawal.request')->middleware('auth');
Route::put('admin/withdrawal-request/{id}', [AdminController::class, 'updateStatus'])->name('admin.withdrawal.update');
Route::get('/admin/bank-details', [AdminController::class, 'showBankDetails'])->name('admin.bank.details')->middleware('auth');
Route::get('/admin/labs-table', [AdminController::class, 'labTable'])->name('admin.labs.table')->middleware('auth');
Route::get('/admin/doctors-table', [AdminController::class, 'doctorTable'])->name('admin.doctors.table')->middleware('auth');