<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;

Route::resource('users', UserController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('roles', RoleController::class);
Route::apiResource('bills', BillController::class);
Route::apiResource('payments', PaymentController::class);

Route::middleware('auth:sanctum')->group(function () {
    // Route::apiResource('roles', RoleController::class);
    // Route::apiResource('bills', BillController::class);
    // Route::apiResource('payments', PaymentController::class);
    Route::get('/logout', [AuthController::class, 'logout']);
});
