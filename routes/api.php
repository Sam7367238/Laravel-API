<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\SessionController;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostController::class);
Route::post("/register", RegistrationController::class) -> name("register") -> middleware(["guest", "throttle:6,1"]);
Route::post("/login", [SessionController::class, "store"]) -> name("login") -> middleware("guest");