<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/art_gallery', function () {
    return view('art_gallery');
})->name('art_gallery');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
