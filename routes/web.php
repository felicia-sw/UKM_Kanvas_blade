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
use App\Http\Controllers\CloudinaryTestController;

use App\Http\Controllers\Admin\IncomeExpenseController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DuesPaymentController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\MerchandiseOrderController;
use App\Http\Controllers\Admin\DuesPeriodController;
use App\Http\Controllers\Admin\RundownController;


use App\Http\Controllers\ExportController;

Route::get('/export/{eventId}', [ExportController::class, 'export'])->name('export.event');

// ===============================================
// CLOUDINARY TEST ROUTES
Route::get('/upload', [CloudinaryTestController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [CloudinaryTestController::class, 'upload'])->name('upload.post');


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

Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');

// ===============================================
// AUTHENTICATION ROUTES (User Login/Register/Logout)



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===============================================
// AUTHENTICATED USER ROUTES
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Event Registration
    Route::post('/events/{event}/register', [EventRegistrationController::class, 'store'])->name('events.register');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::patch('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

    // Dues Payment routes
    Route::get('/dues', [DuesPaymentController::class, 'index'])->name('dues.index');
    Route::get('/dues/{duesPeriod}/pay', [DuesPaymentController::class, 'create'])->name('dues.payment.create');
    Route::post('/dues/{duesPeriod}/pay', [DuesPaymentController::class, 'store'])->name('dues.payment.store');

    // Shopping Cart routes
    Route::get('/cart', [ShoppingCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{merchandise}', [ShoppingCartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cartItem}', [ShoppingCartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [ShoppingCartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');

    // Merchandise Order routes
    Route::get('/orders', [MerchandiseOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [MerchandiseOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [MerchandiseOrderController::class, 'store'])->name('orders.store');
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

    // Event Rundown Management
    Route::get('events/{event}/rundown', [RundownController::class, 'index'])->name('events.rundown.index');
    Route::get('events/{event}/rundown/create', [RundownController::class, 'create'])->name('events.rundown.create');
    Route::post('events/{event}/rundown', [RundownController::class, 'store'])->name('events.rundown.store');
    Route::get('events/{event}/rundown/{rundown}/edit', [RundownController::class, 'edit'])->name('events.rundown.edit');
    Route::put('events/{event}/rundown/{rundown}', [RundownController::class, 'update'])->name('events.rundown.update');
    Route::delete('events/{event}/rundown/{rundown}', [RundownController::class, 'destroy'])->name('events.rundown.destroy');

    // Dues Period Management
    Route::resource('dues', DuesPeriodController::class)->parameters([
        'dues' => 'duesPeriod'
    ]);
    Route::get('dues/{duesPeriod}/payments', [DuesPeriodController::class, 'show'])->name('dues.show');

    // Dues Payment Verification
    Route::patch('dues-payments/{payment}/verify', [DuesPaymentController::class, 'verify'])->name('dues-payments.verify');

    // Merchandise Order Management
    Route::get('orders', [MerchandiseOrderController::class, 'adminIndex'])->name('orders.index');
    Route::get('orders/{order}', [MerchandiseOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/verify-payment', [MerchandiseOrderController::class, 'verifyPayment'])->name('orders.verify-payment');
    Route::patch('orders/{order}/pickup-status', [MerchandiseOrderController::class, 'updatePickupStatus'])->name('orders.update-pickup-status');
});

    // --- TEMPORARY DEBUG ROUTE --- for "hasRole" issue
// Route::get('/debug-role', function () {
//     $user = \Illuminate\Support\Facades\Auth::user();
    
//     if (!$user) {
//         return "Not logged in! Please login first.";
//     }

//     return [
//         'User Class' => get_class($user),
//         'Has "hasRole" Method?' => method_exists($user, 'hasRole') ? 'YES' : 'NO',
//         'User Roles' => $user->roles->pluck('name'),
//         'Is Admin?' => $user->hasRole('Admin') ? 'YES' : 'NO',
//     ];
// });