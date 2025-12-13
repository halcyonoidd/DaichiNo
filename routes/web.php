<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;

Route::get('/', function () {
    return view('guestPage.landingGuest');
});

Route::get('/menu', function () {
    $products = \App\Models\Product::where('is_available', true)
        ->groupBy('category')
        ->selectRaw('category, count(*) as total')
        ->pluck('category');
    
    $products = \App\Models\Product::where('is_available', true)->get();
    
    return view('custPage.menu', compact('products'));
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

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('adminPage.dashboard');
        })->name('admin.dashboard');
        
        // User management
        Route::resource('admin/users', AdminUserController::class, ['as' => 'admin']);
        
        // Product management
        Route::resource('admin/products', AdminProductController::class, ['as' => 'admin']);
    });
});


