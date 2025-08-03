<?php

use Illuminate\Support\Facades\Route;

// Package routes go here
Route::get('/', function () {
    return view('Web::welcome');
});
