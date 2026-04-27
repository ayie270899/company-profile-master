<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\Admin\PageController;
use App\Http\Controllers\Api\Admin\ServiceController;
use App\Http\Controllers\Api\Admin\PortfolioController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\ContactMessageController;
use App\Http\Controllers\Api\PublicController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES =====
Route::get('/public/home', [PublicController::class, 'home']);
Route::post('/public/contact', [PublicController::class, 'storeContact']);

// ===== AUTH ROUTES =====
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

// ===== PROTECTED ADMIN ROUTES =====
Route::middleware('auth:sanctum')->prefix('admin')->name('api.admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Pages
    Route::apiResource('pages', PageController::class)->except(['show']);

    // Services
    Route::apiResource('services', ServiceController::class)->except(['show']);

    // Portfolios
    Route::apiResource('portfolios', PortfolioController::class)->except(['show']);
    Route::delete('/portfolio-images/{image}', [PortfolioController::class, 'destroyImage'])
        ->name('portfolio-images.destroy');

    // Users
    Route::apiResource('users', UserController::class)->except(['show']);

    // Contact Messages
    Route::get('contact-messages', [ContactMessageController::class, 'index']);
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show']);
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy']);
});
