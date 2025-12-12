<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;

Route::get('/', function () {
    return view('guestPage.landingGuest');
});

Route::get('/menu', function () {
    return view('custPage.menu');
})->name('menu');

Route::get('/about', function () {
    return view('custPage.about');
})->name('about');

Route::get('/home', function () {
    return view('custPage.landing');
})->name('home');

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

