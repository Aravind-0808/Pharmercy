<?php

use Illuminate\Support\Facades\Route;

// Package routes go here
Route::get('/customer', function () {
    return view('Customer::welcome');
});
