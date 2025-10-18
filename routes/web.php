<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtworkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('event');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/art-gallery', [ArtworkController::class, 'index'])->name('art_gallery');
Route::get('/artworks/{id}', [ArtworkController::class, 'show'])->name('artworks.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
