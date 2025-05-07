<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,pending,completed',
            'priority' => 'required|in:none,low,medium,high',
            'due_date' => 'date|nullable',
        ]);

        $validated['user_id'] = auth()->id();

        Task::create($validated);

        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {

        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:not_started,in_progress,pending,completed',
            'priority' => 'required|in:none,low,medium,high',
            'due_date' => 'date|nullable',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task update successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task delete successfully');
    }

    public function toggleStatusAjax(Task $task)
    {

        if($task->status === 'completed'){
            $task->status = $task->previous_status ?? 'pending';
            $task->previous_status = null;
        }else{
            $task->previous_status = $task->status;
            $task->status = 'completed';
        }

        $task->save();

        return response()->json([
            'status' => $task->status,
            'message' => 'Task status updated successfully!',
        ]);
    }
}
