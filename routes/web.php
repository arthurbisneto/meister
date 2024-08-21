<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

// Route for the homepage to list tasks
Route::get('/', function () {
    $tasks = Task::all();
    return view('index', compact('tasks'));
});
// Route to update a task
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

// Route to display the form to create a new task
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

// Route to show the form for editing a task
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

// Route to handle the form submission and store the new task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Route to display the list of tasks (index)
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Optional: Route to display a specific task
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

// Route to delete a task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');  