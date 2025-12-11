<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Support\Facades\Route;

// routes/api.php

// Public routes (tidak perlu autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Reservation: create is public so guests can book
Route::post('/reservations', [ReservationController::class, 'store']);

// Protected routes (perlu autentikasi dengan token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    // Protected: list reservations (for admin/authorized users)
    Route::get('/reservations', [ReservationController::class, 'index']);
});