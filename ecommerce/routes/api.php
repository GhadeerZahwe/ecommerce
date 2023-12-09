<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);


// Product routes
Route::get('/products', [ProductController::class, 'get_products']);
Route::post('/products', [ProductController::class, 'add_product']);
Route::post('/products/update/{id}', [ProductController::class, 'update_Product']);
Route::delete('/products/{id}', [ProductController::class, 'delete_Product']);
?>

