<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShoppingItemController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ResendEmailVerificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

// Public API routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/resend-verification-email', [ResendEmailVerificationController::class, 'resend']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

    // User management
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);

    // Bills and payments
    Route::apiResource('bills', BillController::class);
    Route::patch('/bills/{bill}/pay', [BillController::class, 'markAsPaid']);
    Route::apiResource('payments', PaymentController::class);

    // Shopping and expenses
    Route::apiResource('shopping-items', ShoppingItemController::class);
    Route::apiResource('expenses', ExpenseController::class);
    Route::get('/expenses/summary', [ExpenseController::class, 'summary']);

    // Reports
    Route::get('/reports/expenses', [ReportController::class, 'expenseReport']);
    Route::get('/reports/monthly', [ReportController::class, 'monthlyReport']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
