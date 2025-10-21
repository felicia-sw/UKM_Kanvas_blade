<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtworkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\DocumentationController as AdminDocumentationController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/art-gallery', [ArtworkController::class, 'index'])->name('art_gallery');
Route::get('/artworks/{id}', [ArtworkController::class, 'show'])->name('artworks.show');



Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// login and register routes
// the get routes act as fallbacks/placeholders for laravel's authentication system
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// post ROUTES handle the form submkission from the modals 
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// logout requires a post request (e.g. from a button/form)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login Routes
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout'); // Added admin logout

    // Authenticated Admin Routes (Apply middleware later)
    // Route::middleware(['auth', 'admin'])->group(function () { // Add middleware later
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('artworks', [AdminArtworkController::class, 'index'])->name('artworks.index');
        // Add routes for create, store, edit, update, destroy later

        Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
        // Add routes for create, store, edit, update, destroy later

        Route::get('documentation', [AdminDocumentationController::class, 'index'])->name('documentation.index');
        // Add routes for create, store, edit, update, destroy later
    // });
});
