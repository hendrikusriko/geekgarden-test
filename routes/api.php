<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    //return Auth::user()->getRoleNames();
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');



Route::prefix('product/')->middleware(['auth:sanctum'])->group(function () { 
    Route::get('index',  [ProductController::class, 'index'])->middleware('role:user|admin');
    Route::post('create',  [ProductController::class, 'create'])->middleware('role:admin');
    Route::post('update/{id}',  [ProductController::class, 'update'])->middleware('role:admin');
    Route::get('delete/{id}',  [ProductController::class, 'delete'])->middleware('role:admin');
});

Route::prefix('cart/')->middleware(['auth:sanctum'])->group(function () { 
    Route::get('index',  [CartController::class, 'listCart'])->middleware('role:user');
    Route::post('add-to-cart',  [CartController::class, 'addToCart'])->middleware('role:user');
});

Route::prefix('order/')->middleware(['auth:sanctum'])->group(function () { 
    Route::post('checkout',  [OrderController::class, 'checkout'])->middleware('role:user');
    Route::get('my-order',  [OrderController::class, 'myOrder'])->middleware('role:user');
    Route::get('index',  [OrderController::class, 'index'])->middleware('role:admin');
});
