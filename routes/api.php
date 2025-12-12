<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ProductController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController; // Pastikan ini ada


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// Protected Routes (Butuh Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Reservation List
    Route::get('/reservations', [ReservationController::class, 'index']);

    // Admin Products Management
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // ------------------------------------------------
    // CUSTOMER ORDER ROUTES (User Biasa)
    // ------------------------------------------------
    Route::post('/orders', [OrderController::class, 'store']);      // Bikin Order
    Route::get('/my-orders', [OrderController::class, 'index']);    // Lihat History Sendiri (Saya ubah jadi /my-orders biar lebih jelas)
    Route::get('/orders/{id}', [OrderController::class, 'show']);   // Lihat Detail 1 Order

    // ------------------------------------------------
    // ADMIN ORDER ROUTES (Khusus Admin)
    // ------------------------------------------------
    // Melihat SEMUA order dari semua user
    Route::get('/admin/orders', [OrderController::class, 'allOrders']); 
    
    // Update Status (pending -> process -> send -> completed)
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']); 
    
    // Hapus Order
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']); 
});