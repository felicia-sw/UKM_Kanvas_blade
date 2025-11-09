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
// Matches: GET /events/{id}/documentation (Show event documentation/gallery)
// Name: events.documentation
Route::get('/events/{id}/documentation', [EventController::class, 'showDocumentation'])->name('events.documentation');

// Art Gallery Routes (Uses ArtworkController)
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
// Name: login.form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Matches: GET /register
// Name: register.form
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');

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
    Route::resource('artworks', AdminArtworkController::class)->except(['show']);

    // Events Full CRUD
    Route::resource('events', AdminEventController::class)->except(['show']);

    // KEPT: Documentation: Top-level Index (View all documentation from all events)
    // Matches: GET /admin/documentation/all
    // Name: admin.documentation.index.all
    Route::get('documentation/all', [AdminDocumentationController::class, 'indexAll'])->name('documentation.index.all');

    // KEPT: Documentation: Top-level Create (GET form to choose event)
    // Matches: GET /admin/documentation/create
    // Name: admin.documentation.create.all
    Route::get('documentation/create', [AdminDocumentationController::class, 'createAll'])->name('documentation.create.all');

    // 💡 FIX: Dedicated POST route for global store (Calls storeAll)
    // This is required to make the global upload form work without a 404 error.
    // Matches: POST /admin/documentation/store-all
    // Name: admin.documentation.store.all
    Route::post('documentation/store-all', [AdminDocumentationController::class, 'storeAll'])->name('documentation.store.all');
    

    // Documentation Nested Resource (Event-specific CRUD)
    // This correctly defines the nested route: admin.events.documentation.*
    Route::resource('events.documentation', AdminDocumentationController::class)->except(['show']);
});