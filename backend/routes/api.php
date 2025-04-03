<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyMovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

// Login route
Route::post('/login', [AuthController::class, 'login']);

// Authenticated routes with Sanctum middleware (token-based authentication)
Route::middleware('auth:sanctum')->group(function () {
  // Logout route
  Route::post('/logout', [AuthController::class, 'logout']);

  // Products routes
  Route::get('/products', [ProductController::class, 'index']);

  Route::get('/products/{id}', [ProductController::class, 'show']);

  Route::post('/products', [ProductController::class, 'store']);

  Route::patch('/products/{id}', [ProductController::class, 'update']);

  Route::delete('/products/{id}', [ProductController::class, 'destroy']);

  // Sales routes
  Route::get('/sales', [SaleController::class, 'index']);

  Route::get('/sales/{id}', [SaleController::class, 'show']);

  Route::post('/sales', [SaleController::class, 'store']);

  Route::post('/sales-spun', [SaleController::class, 'storeSpun']);

  Route::delete('/sales/{id}', [SaleController::class, 'destroy']);


  // Daily Movements routes
  Route::get('/daily-movements', [DailyMovementController::class, 'index']);

  Route::get('/daily-movements/{id}', [DailyMovementController::class, 'show']);

  Route::get('/daily-movements/by-date/{date}', [DailyMovementController::class, 'showDate']);

  Route::post('/daily-movements', [DailyMovementController::class, 'store']);
});
