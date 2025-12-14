<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ProductController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReservationOfferController;


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::post('/reservations/availability', [ReservationController::class, 'checkAvailability']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
// Public: reservation offerings for customers
Route::get('/reservation-offers', [ReservationOfferController::class, 'index']);
Route::post('/payments/reservation', [PaymentController::class, 'createReservationPayment']);

// Protected Routes (requires Sanctum auth)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    // Reservation List
    Route::get('/reservations', [ReservationController::class, 'index']);

    // Admin Products Management
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Customer Orders
    Route::post('/orders', [OrderController::class, 'store']);      // Bikin Order
    Route::get('/my-orders', [OrderController::class, 'index']);    // Lihat History Sendiri
    Route::get('/orders/{id}', [OrderController::class, 'show']);   // Lihat Detail 1 Order

    //payement
    Route::post('/payments', [PaymentController::class, 'create']);

    // Admin Orders (view all)
    Route::get('/admin/orders', [OrderController::class, 'allOrders']); 
    
    // Update Status (pending -> process -> send -> completed)
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']); 
    
    // Hapus Order
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']); 
});