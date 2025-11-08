<?php

// Import necessary Controller classes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtworkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers are aliased to avoid naming conflicts with public controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\DocumentationController as AdminDocumentationController;


// ===============================================
// PUBLIC ROUTES
// ===============================================

// Home Page Route
// Matches: GET /
// Name: home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Events Routes
// Matches: GET /events (Index page)
// Name: events
Route::get('/events', [EventController::class, 'index'])->name('events');
// Matches: GET /events/{id} (Show single event)
// Name: events.show
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Art Gallery Routes
// Matches: GET /art-gallery (Index page)
// Name: art_gallery
Route::get('/art-gallery', [ArtworkController::class, 'index'])->name('art_gallery');
// Matches: GET /artworks/{id} (Show single artwork)
// Name: artworks.show
Route::get('/artworks/{id}', [ArtworkController::class, 'show'])->name('artworks.show');


// Static Pages Routes
// Matches: GET /about
// Name: about
Route::get('/about', function () {
    return view('about');
})->name('about');
// Matches: GET /contact
// Name: contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ===============================================
// AUTHENTICATION ROUTES (User Login/Register/Logout)
// ===============================================

// GET routes act as fallbacks/placeholders for showing the login/registration forms/modals
// Matches: GET /login
// Name: login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Matches: GET /register
// Name: register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// POST ROUTES handle the form submission for login and registration
// Matches: POST /login (Handles form submission)
// Name: login
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Matches: POST /register (Handles form submission)
// Name: register
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Logout requires a POST request for security (e.g., from a button/form)
// Matches: POST /logout
// Name: logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===============================================
// ADMIN ROUTES
// ===============================================
// Route::prefix('admin') adds the '/admin' URL segment to all routes in the group. (e.g., /admin/dashboard)
// ->name('admin.') adds the 'admin.' prefix to all route names. (e.g., admin.dashboard)
// ->middleware(['auth', 'admin']) ensures only authenticated users with the 'admin' role can access these routes.
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard Route
    // Matches: GET /admin/dashboard
    // Name: admin.dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Artworks Resource Routes (CRUD)
    // Route::resource automatically defines:
    // GET /admin/artworks (index)   -> name: admin.artworks.index
    // GET /admin/artworks/create (create form) -> name: admin.artworks.create  <-- FIX for your error
    // POST /admin/artworks (store) -> name: admin.artworks.store
    // GET /admin/artworks/{id}/edit (edit form) -> name: admin.artworks.edit
    // PUT/PATCH /admin/artworks/{id} (update) -> name: admin.artworks.update
    // DELETE /admin/artworks/{id} (destroy) -> name: admin.artworks.destroy
    // ->except(['show']) excludes the default GET /admin/artworks/{id} route
    Route::resource('artworks', AdminArtworkController::class)->except(['show']);

    // Events Routes
    // Matches: GET /admin/events
    // Name: admin.events.index
    // Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
    // To enable CRUD: replace the line above with Route::resource('events', AdminEventController::class)->except(['show']);
    // Events Resource Routes (CRUD)
    // Route::resource automatically defines: index, create, store, edit, update, destroy
    Route::resource('events', AdminEventController::class)->except(['show']); 
    // Documentation Routes
    // Matches: GET /admin/documentation
    // Name: admin.documentation.index
    Route::resource('events.documentation', [AdminDocumentationController::class, 'index'])->except(['show','edit','update']);
    // To enable CRUD: replace the line above with Route::resource('documentation', AdminDocumentationController::class)->except(['show']);
});