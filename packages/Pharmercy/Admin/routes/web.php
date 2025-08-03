<?php

use Illuminate\Support\Facades\Route;

// Package routes go here
Route::get('/admin', function () {
    return view('Admin::welcome');
});
