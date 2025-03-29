<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request) { //create Task
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'in:To Do,In Progress,Done'
        ]);
        $task = Task::create($validated);
        return response()->json([
            'message' => 'Task created successfully!',
            'task' => $task
        ], 201);
    }
     public function index() { //retrieve all tasks
        $tasks = Task::all();
        return response()->json([
            'message' => count($tasks) > 0 ? 'Tasks retrieved successfully!' : 'No tasks found.',
            'tasks' => $tasks
        ]);
    }
    public function update(Request $request, Task $task) { //update task status
        $task->update($request->only('status'));
        return response()->json([
            'message' => 'Task updated successfully!',
            'task' => $task
        ]);
    }
    public function destroy(Task $task) { //delete a task
        $task->delete();
        return response()->json([
        'message' => 'Task deleted successfully!'
        ], 200);
    }
}
