<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

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
