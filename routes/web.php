<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

/*-- Task Route --*/

Route::middleware(['auth'])->group(function () {

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name("tasks.update");

    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatusAjax'])->name('tasks.toggleStatusAjax');
});

require base_path('routes/auth.php');
