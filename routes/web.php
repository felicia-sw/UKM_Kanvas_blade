<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/event', function () {
    return view('event');
})->name('event');

Route::get('/art_gallery', function () {
    return view('art_gallery');
})->name('art_gallery');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
