<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes — Laravel Training Scaffold
|--------------------------------------------------------------------------
| This file is intentionally minimal. You'll add routes day by day.
| Search the codebase for "TODO Day X" to find your daily tasks.
*/

Route::get('/', function () {
    return view('home');
});

// TODO Day 2: define resource routes for projects and tasks
//   - GET    /projects                      (index)
//   - GET    /projects/create               (create form)
//   - POST   /projects                      (store)
//   - GET    /projects/{project}            (show)
//   - GET    /projects/{project}/edit       (edit form)
//   - PUT    /projects/{project}            (update)
//   - DELETE /projects/{project}            (destroy)
//   - Same set for /tasks (nested under projects, e.g., /projects/{project}/tasks)
// Hint: Route::resource('projects', ProjectController::class);
// Wrap them in auth middleware (after Day 8): Route::middleware('auth')->group(function () { ... });

Route::resource('projects', ProjectController::class);

// Nested tasks under projects
Route::resource('projects.tasks', TaskController::class);


// TODO Day 8: install Breeze, then Breeze will add its own auth routes here
// Run: composer require laravel/breeze --dev
//      php artisan breeze:install blade
//      npm install && npm run dev
//      php artisan migrate

// TODO Day 9: protect admin-only routes with the CheckRole middleware
// Example: Route::middleware(['auth', 'role:admin'])->group(function () { ... });