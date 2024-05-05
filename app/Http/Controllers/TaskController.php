<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function showAllTasks()
    {
        $tasks = Task::with('subtasks')->orderBy('id', 'asc')->get();
        return response()->json($tasks);
    }

    public function registerTask(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();
        return response()->json($task);
    }

    public function showTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

    public function updateTask($id, Request $request)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();

        return response()->json($task);
    }

    public function updateTaskStatus($id, Request $request)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->status = $request->status;

        $task->save();

        return response()->json($task);
    }

    public function updateDate($id, Request $request)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $due_date = Carbon::createFromFormat('d/m/Y', $request->due_date)->startOfDay();


        $task->due_date = $due_date;


        $task->save();

        $task = Task::with('subtasks')->find($id);

        return response()->json($task);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json('Deleted', 200);
    }

    public function showTasksOnDate()
    {
        $tasks = Task::with('subtasks')->where('due_date', '=', '2024-05-05')->get();
        return response()->json($tasks);
    }
    
    public function showTasksBeforeDate()
    {
        $tasks = Task::with('subtasks')->whereDate('due_date', '<', '2024-05-05')->get();
        return response()->json($tasks);
    }
}
