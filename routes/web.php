<?php

use App\Models\Task;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
/*
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});




Route::get('/admin', function () {
    return 'Admin Dashboard';
})->middleware(['auth', 'role:admin']);

Route::middleware('auth')->group(function () {
    Route::get('/completed-tasks', [TaskController::class, 'completedTasks'])->name('completed-tasks');
    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Web Routes — Laravel Training Scaffold
|--------------------------------------------------------------------------
| This file is intentionally minimal. You'll add routes day by day.
| Search the codebase for "TODO Day X" to find your daily tasks.
*/



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




// TODO Day 8: install Breeze, then Breeze will add its own auth routes here
// Run: composer require laravel/breeze --dev
//      php artisan breeze:install blade
//      npm install && npm run dev
//      php artisan migrate

// TODO Day 9: protect admin-only routes with the CheckRole middleware
// Example: Route::middleware(['auth', 'role:admin'])->group(function () { ... });