<?php

use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tasks
Route::get('/tasks', [TaskController::class, 'showAllTasks']);
Route::post('/tasks', [TaskController::class, 'registerTask']);
Route::get('/tasks/{id}', [TaskController::class, 'showTask']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::patch('/tasks/{id}', [TaskController::class, 'updateTaskStatus']);
Route::patch('/tasks/{id}/date', [TaskController::class, 'updateDate']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);
Route::get('/on-date', [TaskController::class, 'showTasksOnDate']);
Route::get('/before-date', [TaskController::class, 'showTasksBeforeDate']);

// Subtasks
Route::prefix('subtasks')->group(function () {
    Route::get('/', [SubtaskController::class, 'showAllSubtask']);
    Route::post('/', [SubtaskController::class, 'registerSubtask']);
    Route::get('/{id}', [SubtaskController::class, 'showSubtask']);
    Route::put('/{id}', [SubtaskController::class, 'updateSubtask']);
    Route::put('/{id}/status', [SubtaskController::class, 'updateSubtaskStatus']);
    Route::delete('/{id}', [SubtaskController::class, 'deleteSubtask']);
    Route::get('/search', [SubtaskController::class, 'search']);
    Route::get('/task/{task_id}', [SubtaskController::class, 'showTaskId']);
});
