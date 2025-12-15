<?php

use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
});

Route::middleware('guest')->group(function () {
    Route::post('/register', RegistrationController::class)->name('register')->middleware('throttle:6,1');
    Route::post('/login', [SessionController::class, 'store'])->name('login');
});
