<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::resource('tasks', TaskController::class);

use App\Models\Task;

Route::get('/', function () {
    $tasks = Task::all();
    return view('index', compact('tasks'));
});
