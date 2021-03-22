<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\OrderDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'loggedInUser']);
});

Route::resource('products', ProductController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('orders', OrderController::class);
Route::resource('order_details', OrderDetailController::class);
Route::resource('supplier_products', SupplierProductController::class);