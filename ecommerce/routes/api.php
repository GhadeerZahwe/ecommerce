<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\TransactionController;

// Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

// Product routes
Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products', [ProductController::class, 'addProduct']);
Route::post('/products/update/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);

// Shopping Cart routes
Route::get('/cart', [ShoppingCartController::class, 'get_shopping_cart']);
Route::post('/cart', [ShoppingCartController::class, 'add_Shopping_Cart']);
Route::delete('/cart/{id}', [ShoppingCartController::class, 'delete_Shopping_Cart']);

Route::get('/transactions', [TransactionController::class, 'get_all_transactions']);

?>

