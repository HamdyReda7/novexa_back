<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderRequestController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TestMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test-mail', [TestMailController::class, 'send']);

// Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Public Categories
Route::get('/categories/all', [CategoryController::class, 'index']);

// Public Products
Route::get('/projects/all', [ProjectController::class, 'index']);
Route::get('/all', [ProjectController::class, 'allindex']);
Route::get('/projects/show/{id}', [ProjectController::class, 'show']);

Route::post('/orders', [OrderRequestController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {

    // Profile
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);

    // Categories
    Route::post('/create/category', [CategoryController::class, 'store']);
    Route::post('/update/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/category/{id}', [CategoryController::class, 'destroy']);


    // projects
    Route::post('/create/project', [ProjectController::class, 'store']);
    Route::post('/update/project/{id}', [ProjectController::class, 'update']);
    Route::delete('/delete/project/{id}', [ProjectController::class, 'destroy']);


    // Orders
    Route::get('/orders/all', [OrderRequestController::class, 'index']);
    Route::get('/show/order/{id}', [OrderRequestController::class, 'show']);
    Route::delete('/delete/order/{id}', [OrderRequestController::class, 'destroy']);


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
