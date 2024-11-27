<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminServiceController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/Department', function () {
    return view('Department');
});

Route::get('/doctors', function () {
    return view('doctors');
});

Route::get('/single-blog', function () {
    return view('single-blog');
});

// Client and Provider Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Admin Login
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
    Route::post('/admin/login', [AuthenticatedSessionController::class, 'store']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class, 'redirectToDashboard'])->name('dashboard');
});

// Admin Protected Routes
//auth checks if the user is logging or not
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::resource('/users', AdminUserController::class);
    Route::put('/users/{id}/restore', [AdminUserController::class, 'restore'])->name('users.restore');
    Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/services', AdminServiceController::class);
    Route::resource('/bookings', AdminBookingController::class);
    Route::resource('/reviews', AdminReviewController::class);
    Route::put('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('reviews.updateStatus');

    // Reports
    Route::get('/reports', [AdminReportController::class, 'index'])->name('admin.reports');

    //admin search routes
    // Route::get('/users/search', [AdminUserController::class, 'search'])->name('users.search');
    // Route::get('/reviews/search', [AdminReviewController::class, 'search'])->name('reviews.search');
    // Route::get('/bookings/search', [AdminBookingController::class, 'search'])->name('bookings.search');

});

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//from breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/logout', [ProfileController::class, 'UserLogout'])->name('profile.logout');
});

require __DIR__.'/auth.php';
