<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// IMPORTS - AUTH & USER CONTROLLERS
// ==========================================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// ==========================================
// IMPORTS - FRONTEND CONTROLLERS
// ==========================================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TravelController as FrontTravelController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Controllers\Frontend\TourController as FrontTourController;

// ==========================================
// IMPORTS - ADMIN CONTROLLERS
// ==========================================
use App\Http\Controllers\Admin\TravelController as AdminTravelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\Admin\PaymentController;

// ==========================================
// MIDDLEWARE IMPORT (Laravel 11 Style)
// ==========================================
use App\Http\Middleware\EnsureRole;


/*
|--------------------------------------------------------------------------
| 1. AREA OTENTIKASI (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Auth Publik (User)
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Auth Khusus Admin
    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login']);
});

// Logout (Hanya untuk user yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


/*
|--------------------------------------------------------------------------
| 2. AREA PUBLIK (FRONTEND)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

// Travel Antar Kota
Route::prefix('travel')->name('travel.')->group(function () {
    Route::get('/', [FrontTravelController::class, 'index'])->name('index');
    Route::post('/search', [FrontTravelController::class, 'search'])->name('search');
});

// Carter Mobil
Route::prefix('rental')->name('rental.')->group(function () {
    Route::get('/', [RentalController::class, 'index'])->name('index');
    Route::get('/{car}', [RentalController::class, 'show'])->name('show');
});

// Paket Wisata
Route::prefix('tour')->name('tour.')->group(function () {
    Route::get('/', [FrontTourController::class, 'index'])->name('index');
    Route::get('/{slug}', [FrontTourController::class, 'show'])->name('show');
});


/*
|--------------------------------------------------------------------------
| 3. AREA USER (REQUIRES LOGIN)
|--------------------------------------------------------------------------
| Semua pengguna yang login (Role 1, 2, atau 3) bisa mengakses area ini
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard User
    Route::view('/dashboard', 'frontend.user.dashboard')->name('user.dashboard');

    // Proses Booking
    Route::post('/travel/{schedule}/book', [FrontTravelController::class, 'storeBooking'])->name('travel.book');
    Route::post('/rental/{car}/book', [RentalController::class, 'storeBooking'])->name('rental.book');
    Route::post('/tour/{package}/book', [FrontTourController::class, 'storeBooking'])->name('tour.book');

    // Checkout & Pembayaran
    Route::get('/checkout/{type}/{id}', function($type, $id) {
        return view('frontend.payment.checkout', compact('type', 'id'));
    })->name('payment.checkout');

});


/*
|--------------------------------------------------------------------------
| 4. AREA ADMIN PANEL (SUPERADMIN & ADMIN ONLY)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh Role ID 1 (Superadmin) dan 2 (Admin)
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', EnsureRole::class.':1,2'])->group(function () {

    // Dashboard Admin (Diambil dari AdminController bawaanmu)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen Hak Akses / User (Diambil dari UserController bawaanmu)
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);

    // Manajemen Travel Antar Kota (Jadwal)
    Route::resource('travel', AdminTravelController::class);

    // Manajemen Carter Mobil (Mobil & Driver)
    Route::resource('cars', CarController::class);
    Route::resource('drivers', DriverController::class);

    // Manajemen Paket Wisata
    Route::resource('tours', AdminTourController::class);

    // Manajemen Pembayaran
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::patch('/payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.updateStatus');

});
