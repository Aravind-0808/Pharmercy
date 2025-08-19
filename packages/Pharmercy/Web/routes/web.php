<?php

use Illuminate\Support\Facades\Route;

// Package routes go here
Route::get('/', function () {
    return view('Web::index');
});

Route::get('/contact-us', function () {
    return view('Web::contact');
});

Route::get('/about-us', function () {
    return view('Web::about');
});

Route::get('/our-services', function () {
    return view('Web::services');
});
