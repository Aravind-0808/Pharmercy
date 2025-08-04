<?php

use Illuminate\Support\Facades\Route;
use Pharmercy\Admin\Http\Controllers\AdminController;

// Package routes go here
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');