<?php

use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function () {
    return view('welcome');
});

Route::get('/tasks', [TaskController::class, 'showAllTasks']);
Route::post('/tasks', [TaskController::class, 'registerTask']);
Route::get('/tasks/{id}', [TaskController::class, 'showTask']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::patch('/tasks/{id}', [TaskController::class, 'updateTaskStatus']);
Route::patch('/tasks/{id}/date', [TaskController::class, 'updateDate']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);

