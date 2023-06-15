<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
    return Auth::user()->getRoleNames();
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');



Route::prefix('product/')->middleware(['can:user'])->group(function () { 
    Route::get('index',  [ProductController::class, 'index']);
    Route::post('create',  [ProductController::class, 'create']);
    Route::post('update/{id}',  [ProductController::class, 'update']);
    Route::get('delete/{id}',  [ProductController::class, 'delete']);
});

Route::prefix('cart/')->middleware(['can:admin|user'])->group(function () { 
    Route::get('index',  [CartController::class, 'listCart'])->middleware('can:user');
    Route::post('add-to-cart',  [CartController::class, 'addToCart'])->middleware('can:user');
});

Route::prefix('order/')->middleware(['can:admin|user'])->group(function () { 
    Route::post('checkout',  [OrderController::class, 'checkout']);
    Route::get('index',  [OrderController::class, 'index']);
});
