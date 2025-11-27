<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// routes/api.php

// Public routes (tidak perlu autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (perlu autentikasi dengan token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});