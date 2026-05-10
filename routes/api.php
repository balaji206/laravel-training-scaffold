<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;

Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});


/*
|--------------------------------------------------------------------------
| API Routes — Laravel Training Scaffold
|--------------------------------------------------------------------------
*/

// TODO Day 10: install Sanctum and build out the API
//
// Setup steps:
//   1. composer require laravel/sanctum
//   2. php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
//   3. php artisan migrate (creates personal_access_tokens table)
//   4. Add HasApiTokens trait to app/Models/User.php
//
// Endpoints to build:
//   POST   /api/login                   → return Sanctum token
//   POST   /api/logout                  → revoke token (auth:sanctum)
//   GET    /api/projects                → list logged-in user's projects (auth:sanctum)
//   POST   /api/projects                → create
//   GET    /api/projects/{project}      → show
//   PUT    /api/projects/{project}      → update
//   DELETE /api/projects/{project}      → destroy
//   Same set under /api/tasks
//
// All responses must use API Resources (php artisan make:resource ProjectResource)