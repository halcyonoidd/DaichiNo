<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVoucherController;
use App\Http\Controllers\Admin\AdminReservationController;

// Guest landing
Route::get('/', function () {
    return view('guestPage.landingGuest');
})->name('landingGuest');

// Guest-only auth pages
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('guestPage.login');
    })->name('login');

    Route::get('/register', function () {
        return view('guestPage.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Authenticated pages
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Customer pages
    Route::get('/menu', function () {
        $products = \App\Models\Product::where('is_available', true)->get();
        return view('custPage.menu', compact('products'));
    })->name('menu');

    Route::get('/about', function () {
        return view('custPage.about');
    })->name('about');

    Route::get('/home', function () {
        return view('custPage.landing');
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/cart', function () {
        return view('custPage.cart');
    })->name('cart');

    Route::get('/contact', function () {
        return view('custPage.contact');
    })->name('contact');

    Route::get('/reservation', function () {
        return view('custPage.reservation');
    })->name('reservation');

    Route::get('/voucher', function () {
        return view('custPage.voucher');
    })->name('voucher');

    // Admin routes (grouped for clarity)
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('adminPage.dashboard');
        })->name('dashboard');

        // User management
        Route::resource('users', AdminUserController::class);

        // Product management
        Route::resource('products', AdminProductController::class);

        // Voucher management
        Route::resource('vouchers', AdminVoucherController::class);

        // Reservation management
        Route::resource('reservations', AdminReservationController::class);
    });
});


