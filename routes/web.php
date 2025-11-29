<?php

// Import necessary Controller classes
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ArtworkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\NotificationController;
// Admin Controllers are aliased to avoid naming conflicts with public controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtworkController as AdminArtworkController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\DocumentationController as AdminDocumentationController;
use App\Http\Controllers\Admin\MerchandiseController as AdminMerchandiseController;
use App\Http\Controllers\Admin\IncomeExpenseController;


// ===============================================
// PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/events/{id}/documentation', [EventController::class, 'showDocumentation'])->name('events.documentation');


Route::get('/art-gallery', [ArtworkController::class, 'index'])->name('art_gallery');

Route::get('/artworks/{id}', [ArtworkController::class, 'show'])->name('artworks.show');

// Merchandise Page
Route::get('/merchandise', [MerchandiseController::class, 'index'])->name('merchandise');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ===============================================
// AUTHENTICATION ROUTES (User Login/Register/Logout)



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===============================================
// EVENT REGISTRATION ROUTES
Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});


// ===============================================
// ADMIN ROUTES

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Artworks Resource Routes (CRUD)
    Route::resource('artworks', AdminArtworkController::class)->except(['show']);

    // Events Full CRUD
    Route::resource('events', AdminEventController::class)->except(['show']);

    // Event Registrations
    Route::get('events/{event}/registrations', [AdminEventController::class, 'registrations'])->name('events.registrations');

    // Event Financial Management (Pemasukan & Pengeluaran)
    Route::get('events/{event}/finances', [IncomeExpenseController::class, 'recap'])->name('events.finances.recap');
    Route::get('events/{event}/finances/income/create', [IncomeExpenseController::class, 'createIncome'])->name('events.finances.income.create');
    Route::get('events/{event}/finances/expense/create', [IncomeExpenseController::class, 'createExpense'])->name('events.finances.expense.create');
    Route::post('events/{event}/finances', [IncomeExpenseController::class, 'store'])->name('events.finances.store');
    Route::get('events/{event}/finances/{incomeExpense}/edit', [IncomeExpenseController::class, 'edit'])->name('events.finances.edit');
    Route::put('events/{event}/finances/{incomeExpense}', [IncomeExpenseController::class, 'update'])->name('events.finances.update');
    Route::delete('events/{event}/finances/{incomeExpense}', [IncomeExpenseController::class, 'destroy'])->name('events.finances.destroy');

    
    Route::get('documentation/all', [AdminDocumentationController::class, 'indexAll'])->name('documentation.index.all');
    
    Route::get('documentation/create', [AdminDocumentationController::class, 'createAll'])->name('documentation.create.all');

    
    Route::post('documentation/store-all', [AdminDocumentationController::class, 'storeAll'])->name('documentation.store.all');
    
    Route::resource('events.documentation', AdminDocumentationController::class)->except(['show']);

    Route::resource('merchandise', AdminMerchandiseController::class);

    // Event Registration Management
    Route::patch('/registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])->name('registrations.update-status');
});