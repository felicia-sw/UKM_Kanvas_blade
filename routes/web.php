<?php

use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('home');
})->name('home');

// About route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact route
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
