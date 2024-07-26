<?php

use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\OrderAssignmentController;
use App\Http\Controllers\Api\OrderCompletionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/couriers', [CourierController::class, 'store']);
    Route::get('/couriers/{courier}', [CourierController::class, 'show']);
    Route::patch('/couriers/{courier}', [CourierController::class, 'update']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/orders/assign', [OrderAssignmentController::class, 'store']);
    Route::post('/orders/complete', [OrderCompletionController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
