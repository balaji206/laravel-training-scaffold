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
    return view('dashboard');
});

Route::get('/mail-driver', function () {
    return config('mail.default');
});

Route::get('/test-mail', function () {

    Mail::raw('<h1>Resend working bro!</h1>', function ($message) {

        $message->to('balajier2006@gmail.com')
                ->subject('Laravel Resend Test');

    });

    return 'Mail Sent!';
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
    return 'dashboard working';
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




// Run: composer require laravel/breeze --dev
//      php artisan breeze:install blade
//      npm install && npm run dev
//      php artisan migrate

// Example: Route::middleware(['auth', 'role:admin'])->group(function () { ... });